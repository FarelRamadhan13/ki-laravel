<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Services\PostService;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'image' => $this->image,
            'title' => $this->title,
            'slug' => $this->slug,
            'user_id' => $this->user_id,
            'author' => PostService::findAuthorById($this->user_id)->name,
            'created_at' => $this->created_at,
            'description' => $this->description,
        ];
    }
}


