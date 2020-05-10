<?php

namespace App\Http\Resources\Streamer;

use Illuminate\Http\Resources\Json\JsonResource;

class GroupResource extends JsonResource
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
            "description" => $this->description,
            "start" => $this->start,
            "end" => $this->end,
            "academic_year"=>$this->academic_year->title_en,
            "subject"=>$this->subject->title_en,
            "lesson"=>$this->lessons->count(),
//            "lesson"=>$this->lessons,
            "created_at" => $this->created_at,
        ];
    }
}
