<?php 

namespace App\Http\Resources;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\App;

class DoctorResource extends JsonResource
{
    public function toArray($request)
    {
        $data = [
            'id' => $this->id,
            'email' => $this->email,
            'telegram_url' => $this->telegram_url,
            'instagram_url' => $this->instagram_url,
            'cost' => $this->cost,
            'experience' => $this->experience,
            'image' => $this->image,
            'service_id' => new ServiceResource(Service::find($this->service_id)),
        ];

        if (App::getLocale() == 'ru') {
            $data['first_name'] = $this->first_name_ru;
            $data['last_name'] = $this->last_name_ru;
        } else {
            $data['first_name'] = $this->first_name_uz;
            $data['last_name'] = $this->last_name_uz;
        }

        return $data;
    }
}
