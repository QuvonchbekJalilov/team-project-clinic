<?php

namespace App\Http\Controllers\api\frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\AppointmentStoreRequest;
use App\Http\Requests\AppointmenUpdateRequest;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AppointmentController extends Controller
{

    public function infoAppointments()
    {
        $user = auth()->user()->id;

        $appoitnments = Appointment::all();
        foreach ($appoitnments as $appointment) {
            if ($user == $appointment->user_id) {
                $info = DB::table('appointments')->where('user_id', $user)->get();
                return $this->response($info);
            }
        }
        return $this->error('Appointment not found');
    }
    public function store(Request $request)
    {
        $user = auth()->user()->id;
        $doctor = Doctor::findOrFail($request->doctor_id);
        $service = Service::findOrFail($request->service_id);

        $appointment = Appointment::create([
            'user_id' => $user,
            'doctor_id' => $doctor->id,
            'service_id' => $service->id,
            'date' => $request->date,
        ]);

        return $this->success('Appointment created successfully', $appointment);
    }

}
