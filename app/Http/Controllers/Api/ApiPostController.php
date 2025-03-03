<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Services\PostService;
use App\Actions\Post\CreatePost;
use App\Actions\Post\DeletePost;
use App\Actions\Post\UpdatePost;
use App\Http\Requests\PostRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use Illuminate\Support\Facades\Storage;

class ApiPostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::all();

        return $this->success(
            PostResource::collection($posts)
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request, CreatePost $createPost)
    {
        $validated = $request->validated();
        $image = $request->file('image');
        $validated['image'] = $image->getClientOriginalName();

        if($createPost->execute($validated)) {

            $image->storeAs('posts/', $validated['image'], 'public');

            return $this->success(
                message: "Success to add new post",
                data: $validated
            );
        }

        return $this->error(
            message: "Failed to add new post"
        );
    }

    /**
     * Display the specified resource.
     */
    public function show($post)
    {
        $post = PostService::findBySlug($post);

        return $this->success(
            PostResource::collection($post)
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostRequest $request, $post, UpdatePost $updatePost)
    {
        $validated = $request->validated();
        $postData = PostService::findBySlug($post);

        if($request->hasFile('image')) {

            $image = $request->file('image');
            $validated['image'] = $image->getClientOriginalName();

            $image->storeAs('posts/', $validated['image'], 'public');
            Storage::disk('public')->delete('posts/'.$postData[0]->image);
        }

        if($postData = $updatePost->execute($validated, $post))
            return $this->success(
                message: "Successful to update the article",
                data: PostResource::collection(collect([$postData]))
            );
        
        return $this->error(
            message: 'Failed to update the article'
        );

        return response()->json(['GAGAL' => $validated]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($post, DeletePost $deletePost)
    {
        $post = PostService::findBySlug($post);
        $deletePost->execute($post);
        
        Storage::disk('public')->delete('posts/'.$post[0]->image);

        return $this->success(
            message: 'Successful to delete the article',
            data: [
                'article' => $post
            ]
        );
    }
}
