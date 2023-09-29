<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()->all()
            ], 422);
        }

        $request['password'] = Hash::make($request->get('password'));
        $request['remember_token'] = Str::random(10);
        $user = User::create($request->toArray());

        $token = $user->createToken('My Token')->accessToken;
        $response = ['token' => $token];


        return response()->json($response, 200);
    }

    public function login(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            $response = ['errors' => $validator->errors()->all()];
            return response()->json($response, 422);
        }

        $credentials = $request->only(['email', 'password']);

        $user = User::where('email', $request->email)->first();

        if ($user) {
            if (Auth::attempt($credentials)) {
                $token = $user->createToken('My Token')->accessToken;
                $response = ['token' => $token];

                return response()->json($response, 200);
            } else {
                return response()->json(['message' => "The credentials do not match with the record!"], 422);
            }
        } else {
            $response = ['message' => 'User not found'];
            return response()->json($response, 404);
        }
    }

    public function logout(Request $request): JsonResponse
    {
        $token = $request->user()->token();
        $token->revoke();
        $response = ['message' => 'You have successfully logged out'];
        return response()->json($response, 200);
    }
}
