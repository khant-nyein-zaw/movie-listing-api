<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Movie;
use Illuminate\Database\Eloquent\ModelNotFoundException;
class UserController extends Controller
{
    //

    public function getPublicProfile( $id)
    {
           try {
            $user = User::findOrFail($id);
            return response()->json(['user'=>$user]);
            
            } catch (ModelNotFoundException $e) {
             return response()->json(['error' => 'User not found'], 404);
            
             }

    }

}
