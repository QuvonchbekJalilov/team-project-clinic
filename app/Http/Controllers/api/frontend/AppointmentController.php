<?php

namespace App\Http\Controllers\api\frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\AppointmentStoreRequest;
use App\Http\Requests\AppointmenUpdateRequest;
use App\Http\Resources\AppointmentResource;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AppointmentController extends Controller
{

    public function infoAppointments()
    {
        $user = auth()->user(); 

        if ($user) {
            $appointments = Appointment::where('user_id', $user->id)->get();
            if ($appointments->isEmpty()) {
                return $this->error('Appointments not found for this user');
            }

            return $this->response(AppointmentResource::collection($appointments));
        }

        return $this->error('User not authenticated');
    }
    public function store(Request $request)
    {
        $user = auth()->user()->id;
        $doctor = Doctor::findOrFail($request->doctor_id);

        $appointment = Appointment::create([
            'user_id' => $user,
            'doctor_id' => $doctor->id,
            'date' => $request->date,
        ]);

        return $this->success('Appointment created successfully', $appointment);
    }
}
