<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
      
            'name' => $this->name?$this->name:$this->name_en,
            'slug' => $this->slug,
            'discription' => $this->discription?$this->discription:$this->discription_en,
            'price' => $this->price,
            'thumbnail' => $this->thumbnail,
            'qantite' => $this->qantite,
            'discount' => $this->category->discount==null?$this->discount:$this->category->discount,
            'category' => [
                "name"=>$this->category->name,
                "slug"=>$this->category->slug,
               "icon"=>$this->category->icon,
            ],
            'reviewStar' => $this->review($this->review),
            'reviewcount' => $this->review->count(),
        ];
    }
    public function review($review)
    {
       if (empty($review)) {
         return 0;
       }else{
        $reviewsStar=0;
        foreach ($review as $value) {
           $reviewsStar = $reviewsStar + $value->star;
        }
        if ( $review->count() >=1) {
           $reviewsStar = $reviewsStar/ $review->count();
        }
        return $reviewsStar; 
       }
    }


}
