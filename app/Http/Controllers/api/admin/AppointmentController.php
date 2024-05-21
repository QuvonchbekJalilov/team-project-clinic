<?php

namespace App\Http\Controllers\api\admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\AppointmentResource;
use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $appointments = Appointment::paginate(10);

        return $this->response($appointments);
    }

    
    public function store(Request $request)
    {
        
    }

    
    public function show(Appointment $appointment)
    {
        $appt = Appointment::find($appointment);

        return $this->response($appt);
    }

    
   
    public function update(Request $request, appointment $appointment)
    {
        $appt = Appointment::find($appointment->id);

        $appt->status = $request->status;

        $appt->save();

        return $this->success('Appointment updated successfully', $appt);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Appointment $appointment)
    {
        $appointment->delete();

        return $this->success('Appointment deleted successfully');
    }
}
