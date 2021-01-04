<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NewsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => ucfirst($this->title),
            'author' => $this->author->fullName,
            'article' => $this->article,
            'is_published' => (bool) $this->is_published,
            'published_at' => $this->created_at->format('jS M Y g:i a'),
        ];
    }
}
