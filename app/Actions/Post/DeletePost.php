<?php  
namespace App\Actions\Post;

use App\Models\Post;

class DeletePost {
    public function execute($data)
    {
        Post::find($data[0]->id)->delete();
        return $data[0];
    }
}