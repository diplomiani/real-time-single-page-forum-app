<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReplyResource extends JsonResource
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
            'user' => $this->user->name,
            'user_id' => $this->user_id,
            'reply' => $this->body,
            'id' => $this->id,
            'question_slug' => $this->question->slug,
            'created_at' => $this->created_at->diffForHumans(),
        ];
    }
}
