<?php

namespace App\Http\Controllers\Tugas;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class PostController extends Controller
{
    public static function currentUser() {
        $response = Http::acceptJson()->withToken(session('api_token'))->get('http://ki-laravel.test/api/users/single');
        
        $user = $response->json()['data'];
        unset($user['posts']);

        return (object) $user;
    }

    public function index()
    {
        $token = session('api_token');
        if (!$token) {
            return to_route('login')->withErrors('Harap login terlebih dahulu');
        }

        $posts = Http::acceptJson()->withToken($token)->get('http://ki-laravel.test/api/posts');

        $posts = $posts->json()['data'];
        return view('posts.index', [
            'posts' => $posts,
        ]);

        // dd(self::currentUser());
    }

    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request)
    {
        $validated = $request->validated();
        $image = $request->file('image');
        unset($validated['image']);
        $response = Http::acceptJson()
            ->withToken(session('api_token'))
            ->attach(
                'image',                            //nama field
                fopen($image->getRealPath(), 'r'), //buka file sebagai resource
                $image->hashName()                 // nama file
            )
            ->post('http://ki-laravel.test/api/posts', $validated);

        // return dd($response->status() ,$response->body());
        return to_route('posts.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($post)
    {
        $post = Http::acceptJson()->withToken(session('api_token'))->get('http://ki-laravel.test/api/posts/'.$post);
        $post = $post->json()['data'][0];
        return view('posts.show', [
            'post' => (object) $post
        ]);
        // dd($post);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($post)
    {
        $post = Http::acceptJson()
            ->withToken(session('api_token'))
            ->get('http://ki-laravel.test/api/posts/'.$post);
        $post = $post->json()['data'][0];
        return view('posts.edit', [
            'post' => (object) $post
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostRequest $request, $post)
    {
        $validated = $request->validated();
        if($request->hasFile('image')) {

            $image = $request->file('image');
            unset($validated['image']);

            $response = Http::acceptJson()
                ->withToken(session('api_token'))
                ->attach(
                    'image',
                    fopen($image->getRealPath(), 'r'),
                    $image->hashName()
                )
                ->withHeaders([
                    'X-HTTP-Method-Override' => 'PUT'
                ])
                ->post('http://ki-laravel.test/api/posts/'.$post, $validated);
        } else {

            $response = Http::acceptJson()
                ->withToken(session('api_token'))
                ->put('http://ki-laravel.test/api/posts/'.$post, $validated);
        }

        // dd($response->status(), $response->body());
        return to_route('posts.show', $post);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($post)
    {
        $response = Http::acceptJson()->withToken(session('api_token'))->delete('http://ki-laravel.test/api/posts/'.$post);
        // dd($response->body());
        return to_route('posts.index');
    }
}
