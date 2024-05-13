<?php

namespace App\Http\Resources;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DoctorResource extends JsonResource
{
    
    public function toArray(Request $request)
    {
        return [
            'id' => $this->id,
            'first_name_uz' => $this->first_name_uz,
            'first_name_ru' => $this->first_name_ru,
            'last_name_uz' => $this->last_name_uz,
            'last_name_ru' => $this->last_name_ru,
            'email' => $this->email,
            'telegram_url' => $this->telegram_url,
            'instagram_url' => $this->instagram_url,
            'cost' => $this->cost,
            'experience' => $this->experience,
            'image' => $this->image,
            'service_id' => new ServiceResource(Service::find($this->service_id)),
        ];
    }
}
