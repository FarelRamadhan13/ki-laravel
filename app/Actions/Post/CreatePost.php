<?php  

namespace App\Actions\Post;

use App\Models\Post;
use Illuminate\Support\Str;

class CreatePost 
{
    public function execute($data) : Post
    {
        $post = Post::create([
            'user_id' => auth()->user()->id,
            'title' => $data['title'],
            'slug' => Str::slug($data['title']),
            'description' => $data['description'],
            'image' => $data['image']
        ]);

        return $post;
    }
}