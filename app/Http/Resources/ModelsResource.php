<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ModelsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $locale = app()->getLocale();
        
        return [
            'id' => $this->id,
            'name' => $this->getTranslation('name', $locale),
            'brand' => $this->whenLoaded('brand', function () use ($locale) {
                return [
                    'id' => $this->brand->id,
                    'name' => $this->brand->getTranslation('name', $locale),
                    'image' => $this->brand->image ? asset('storage/' . $this->brand->image) : null
                ];
            }),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
