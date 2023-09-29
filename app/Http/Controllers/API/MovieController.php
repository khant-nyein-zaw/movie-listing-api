<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\MovieFormRequest;
use App\Http\Resources\MovieDetailResource;
use App\Models\Movie;
use App\Traits\RelatedMoviesTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PDF;

class MovieController extends Controller
{
    use RelatedMoviesTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $movies = Movie::with(['comments'])->get();

        return new JsonResponse(
            data: $movies,
            status: JsonResponse::HTTP_OK
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MovieFormRequest $request)
    {
        $genres = implode(',', $request->input('genres'));
        $tags = implode(',', $request->validated('tags'));

        $data = [
            'title' => $request->input('title'),
            'summary' => $request->input('summary'),
            'author' => $request->input('author'),
            'genres' => $genres,
            'tags' => $tags,
            'imdb_rating' => $request->input('imdb_rating'),
        ];

        if ($request->hasFile('cover_image')) {
            // store the image in storage and returns the image name
            $coverImage = $this->storeImage($request);
            $data['cover_image_url'] = url("storage/$coverImage");
            $data['cover_image_name'] = $coverImage;
        }

        $movie = Movie::create($data);
        $this->calRelevence($movie);

        return new JsonResponse(
            data: $movie,
            status: JsonResponse::HTTP_OK
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $movie = Movie::findOrFail($id);

        // $this->calRelevence($movie);

        return new MovieDetailResource($movie);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MovieFormRequest $request, string $id)
    {
        $genres = implode(',', $request->input('genres'));
        $tags = implode(',', $request->input('tags'));

        $data = [
            'title' => $request->input('title'),
            'summary' => $request->input('summary'),
            'author' => $request->input('author'),
            'genres' => $genres,
            'tags' => $tags,
            'imdb_rating' => $request->input('imdb_rating'),
        ];

        if ($request->hasFile('cover_image')) {
            // store the image in storage and returns the image name
            $coverImage = $this->storeImage($request, $id);
            $data['cover_image_url'] = url("storage/$coverImage");
            $data['cover_image_name'] = $coverImage;
        }

        $movie = Movie::findOrFail($id);
        $this->calRelevence($movie);
        $movie->update($data);

        return new JsonResponse(
            data: $movie,
            status: JsonResponse::HTTP_OK
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $movie = Movie::findOrFail($id);

        if ($movie->cover_image_name) {
            Storage::delete('public/' . $movie->cover_image_name);
        }
        $movie->delete();

        return new JsonResponse(
            data: $movie,
            status: JsonResponse::HTTP_OK
        );
    }

    // store movie cover image in storage
    private function storeImage($request, int $id = null)
    {
        $newFileName = uniqid() . "_" . $request->file('cover_image')->getClientOriginalName();

        if ($id) { // delete old cover image in storage if exists
            $filename = Movie::where('id', $id)->pluck('cover_image')->first();
            Storage::delete('public/' . $filename);
        }

        $request->file('cover_image')->storeAs('public', $newFileName);
        return $newFileName;
    }
}
