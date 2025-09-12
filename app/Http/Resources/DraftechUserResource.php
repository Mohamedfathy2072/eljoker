<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DraftechUserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $local = app()->getLocale() ;

        
        return [
            'id' => $this->resource->id ?? null,
            'name' => $this->resource->name ?? '',
            'email' => $this->resource->email ?? null,
            'gender' => $this->resource->gender ?? '',
            'phone' => $this->resource->phone ?? '',
            'date_of_birth' => $this->resource->date_of_birth ?? '',
            'created_at' => $this->resource->created_at ?? null,
            'updated_at' => $this->resource->updated_at ?? null,
        ];
    }
}
