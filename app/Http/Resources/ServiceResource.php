<?php 

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\App;

class ServiceResource extends JsonResource
{
    public function toArray($request)
    {
        $data = [
            'id' => $this->id,
            'image' => $this->image,
        ];

        if (App::getLocale() == 'ru') {
            $data['title'] = $this->title_ru;
            $data['description'] = $this->description_ru;
        } else {
            $data['title'] = $this->title_uz;
            $data['description'] = $this->description_uz;
        }

        return $data;
    }
}
