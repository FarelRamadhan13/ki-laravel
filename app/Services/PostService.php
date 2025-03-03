<?php  
namespace App\Services;

use App\Models\Post;
use App\Models\User;

class PostService {

    public static function findAuthorById($id) : User
    {
        return User::findOrFail($id);
    }

    public static function findBySlug($slug)
    {
        return Post::where('slug', $slug)->get();
    }

}