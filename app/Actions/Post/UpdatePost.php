<?php  
namespace App\Actions\Post;

use App\Models\Post;

class UpdatePost {
    public function execute($data, $post)
    {
        $post = Post::where('slug', $post)->first();
        $post->update(array_merge($data, ['updated_at' => now()]));
        return $post;
    } 
}