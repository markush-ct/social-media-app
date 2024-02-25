<?php

namespace App\Http\Controllers;

use App\Http\Requests\Post\StorePostRequest;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $data['user_id'] = auth()->user()->id;

        Post::create($data);

        return back()->with('status', ['success' => 'Your post has been published successfully!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StorePostRequest $request, Post $post): RedirectResponse
    {
        // Check if the authenticated user is the owner of the post
        if ($request->user()->id !== $post->user_id) {
            // Return response with unauthorized status code
            return back()->with('status', ['error' => 'Unauthorized!']);
        }

        $post->update($request->all());

        return back()->with('status', ['success' => 'Your post has been updated successfully!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
