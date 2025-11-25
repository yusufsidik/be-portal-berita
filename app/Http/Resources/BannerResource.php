<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BannerResource extends JsonResource
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
            'news_id' => $this->news_id,
            'news' => [
                'title' => optional($this->news)->title,
                'slug' => optional($this->news)->slug,
                'thumbnail' => optional($this->news)->thumbnail,
                'content' => optional($this->news)->content
            ]
        ];
    }
}
