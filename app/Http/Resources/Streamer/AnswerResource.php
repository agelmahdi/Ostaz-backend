<?php

namespace App\Http\Resources\Streamer;

use Illuminate\Http\Resources\Json\JsonResource;

class AnswerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        if($this->right==1){
            $type="True";
        }else{
            $type="False";
        }

        return [
            "title" => $this->title,
            "slug" => $this->slug,
            "type"=>$type
        ];
    }
}
