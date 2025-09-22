<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class BrandResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        if(config('app.app') === 'Eljoker') {
            return [
                'id' => $this->id,
                'name' => $this->name,
                'image' => $this->image ? asset('storage/' . $this->image) : null,
            ];
        } else {
            return [
                'id' => $this->id,
                'name' => $this->name,
                'image_url' => $this->image ? Storage::url($this->image) : null,
            ];
        }
    }
}
