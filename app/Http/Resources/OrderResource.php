<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'photo' => 'frontend/images/package/box-flat.png',
           'order_number' => $this->order_number,
           'status' => $this->status,
           'created_at' => $this->created_at,
           'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
           "Sub_Total" => $this->data['purchases']['Sub_Total'],
           "Total"=> $this->data['purchases']['Total'],
           "count"=> $this->data['purchases']['count'],
           'data' => $this->data['purchases']['Cart_Data'][0],
       ];
    }
    
}
