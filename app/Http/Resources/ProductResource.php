<?php

namespace App\Http\Resources;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        return [  
            'id' => $this->id,
            'name'=> $this->name,
            'description'=> $this->description,
            'price'=>$this->price,
            'image_url'=>asset('storage/' . $this->image), //Generate url for image
            'category'=>new CategoryResource($this->whenLoaded('category')), // Load Category if it is available
            'created_at'=>$this->created_at?->format('Y:m:d H:i:s'),
            'updated_at'=>$this->updated_at?->format('Y:m:d H:i:s'),
        ];
    }
}
