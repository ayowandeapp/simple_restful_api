<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Symfony\Component\HttpFoundation\Response;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = auth()->user()->posts;

        return response()->json($posts, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {

        $attributes = $request->validated();

        $post = auth()->user()->posts()->create($attributes);

        return response()->json($post, Response::HTTP_CREATED);


    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        if (auth()->user()->isNot($post->user)) {
            return response()->json('You are not authorized!', Response::HTTP_FORBIDDEN);
        }

        return response($post, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $attributes = $request->validated();

        $post->update($attributes);

        return response($post->refresh(), Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {

        if (auth()->user()->isNot($post->user)) {
            return response()->json('You are not authorized!', Response::HTTP_FORBIDDEN);
        }
        $response = $post->delete();

        return response($response, Response::HTTP_NO_CONTENT);
    }
}
