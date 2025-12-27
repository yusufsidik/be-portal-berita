<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NewsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        return [
            'title' => $this->title,
            'slug' => $this->slug,
            'thumbnail' => $this->thumbnail,
            'content' => $this->content,
            'is_featured' => $this->is_featured,
            'category' => optional($this->category)->title,
            'author' => optional($this->author)->name,
            'created_at' => $this->created_at
        ];
    }
}
