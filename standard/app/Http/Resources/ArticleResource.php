<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
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
            'content' => $this->resource->content,
            'headline' => $this->resource->headline,
            'status' => $this->resource->status,
            'category' => $this->resource->category,
            'priority' => $this->resource->priority,
            'author' => $this->resource->author,
            'created_at' => $this->resource->created_at,
            'created_by' => $this->resource->created_by,
            'num_views' => $this->resource->num_views
        ];
    }
}
