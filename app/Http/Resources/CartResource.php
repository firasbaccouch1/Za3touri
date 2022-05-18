<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
      return  [
        'product_id' => $this->product_id,
        "quantity" => $this->quantity,
        'product' => [
            'name' => $this->product->name,
            'slug' => $this->product->slug,
            'discription' => $this->product->discription,
            'price' => $this->product->price,
            'thumbnail' => $this->product->thumbnail,
            'discount' => $this->product->category->discount==null?$this->product->discount:$this->product->category->discount,
            'category' => [
                    'name' => $this->product->category->name,
                    'slug' => $this->product->category->slug,
                    'icon' => $this->product->category->icon,
                    ]
             ]
        ];
    }
}
