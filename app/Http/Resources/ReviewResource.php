<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReviewResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'star' => $this->star,
            'comment' => $this->comment,
            'username' => $this->user->first_name .' '.$this->user->last_name,
            'created_at' => $this->updated_at->format('Y-m-d H:i:s'),
            'user_id' => $this->user_id,
        ];
    }
}
