<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class testresource extends JsonResource
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
            "country" =>  217,
            "first_name" => 'firas baccouch',
            "last_name" =>  'ahmed',
            "email" => 'firasbaccouch5@gmail.com',
            "state" => 'kebili',
            "city" =>  'douz',
            "zip_code" => 4513,
            "phone" =>  9291156254,
            "street_address" =>  'douz awlad salma',
        ];
    }
}
