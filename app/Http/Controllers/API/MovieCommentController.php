<?php

namespace App\Http\Controllers\API;

use App\Models\Movie;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\CommentFormRequest;

class MovieCommentController extends Controller
{
    /**
     * create a new comment for the movie
     */
    public function store(CommentFormRequest $request, $movie_id)
    {
        // $comment = new Comment();
        // $comment->movie_id = $movie_id;
        // $comment->commenter_name = $request->input('commenter_name');
        // $comment->commenter_email = $request->input('commenter_email');
        // $comment->comment_text = $request->input('comment_text');
        // $comment->save();

        $movie = Movie::find($movie_id);
        $comment = new Comment($request->validated());

        $movie->comments()->save($comment);

        return new JsonResponse(
            data: $comment,
            status: JsonResponse::HTTP_OK
        );
    }
}
