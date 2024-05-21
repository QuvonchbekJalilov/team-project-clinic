<?php

namespace App\Http\Resources;

use App\Models\Doctor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AppointmentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $user = User::find($this->user_id);
        $doctor = Doctor::find($this->doctor_id);
        return [
            'user' => new UserResource($user),
            'doctor' => new DoctorResource($doctor),
            'date' => $this->date,
        ];
    }
}
