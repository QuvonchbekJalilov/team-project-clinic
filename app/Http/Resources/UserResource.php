<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        $user = $this->resource;
        
        if (!$user) {
            return [];
        }

        return [
            'unique_id' => $user->unique_id,
            'full_name' => $user->first_name . " " . $user->last_name,
            'phone_number' => $user->phone_number,
            'email' => $user->email,
            'image' => $user->image
        ];
    }
}
