<?php

namespace App\Http\Resources\Streamer;

use Illuminate\Http\Resources\Json\JsonResource;

class QuestionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "title" => $this->title,
            "slug" => $this->slug,
            "Answer_number"=>$this->answers()->count(),
            "created_at" => $this->created_at,
        ];
    }
}
