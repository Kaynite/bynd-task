<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class PostController extends Controller
{
    public function public (): AnonymousResourceCollection
    {
        $posts = auth('sanctum')->user()->posts()->wherePublic()->latest('id')->paginate(20);

        return PostResource::collection($posts);
    }

    public function private (): AnonymousResourceCollection
    {
        $posts = auth('sanctum')->user()->posts()->wherePrivate()->latest('id')->paginate(20);

        return PostResource::collection($posts);
    }

    public function store(PostRequest $request): PostResource
    {
        $post = auth('sanctum')->user()->posts()->create($request->validated());

        return PostResource::make($post);
    }

    public function show(Post $post)
    {
        $this->authorize('manage', $post);

        return PostResource::make($post);
    }

    public function update(PostRequest $request, Post $post): PostResource
    {
        $this->authorize('manage', $post);

        $post->update($request->validated());

        return PostResource::make($post);
    }

    public function destroy(Post $post): Response
    {
        $this->authorize('manage', $post);

        $post->delete();

        return response()->noContent();
    }
}
