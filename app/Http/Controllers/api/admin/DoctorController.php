<?php

namespace App\Http\Controllers\api\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\DoctorStoreRequest;
use App\Http\Requests\DoctorUpdateRequest;
use App\Http\Resources\DoctorResource;
use App\Models\Doctor;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DoctorController extends Controller
{
    public function __construct(){
        $this->authorizeResource(Doctor::class, 'doctor');
    }

    public function index()
    {
        $doctors = Doctor::paginate(20);

        return $this->response($doctors);
    }



    public function store(DoctorStoreRequest $request)
    {
        $service = Service::find($request->service_id);
        $doctor = $request->validated();
        if ($request->hasFile('image')){
            $path = $request->file('image')->store('doctor/'.time(),'public');
        }

        $doctor['image'] = $path ?? null;
        $doctor['service_id'] = $service->id;
        
        $doc = Doctor::create($doctor);

        return $this->success('Doctor store successfully', $doc);
    }

    
    public function show(Doctor $doctor)
    {
        $doctor = Doctor::find($doctor->id);
        return $this->response(new DoctorResource($doctor));
    }

    
    public function update(DoctorUpdateRequest $request, Doctor $doctor)
    {
        $validate = $request->validated();

        if($request->hasFile('image')){
            Storage::delete($doctor->image);
            $path = $request->file('image')->store('doctor/'.time(),'public');
        }

        $validate['image'] = $path ?? $doctor->image;

        $doctor->update($validate);

        return $this->success('Doctor update successfully', $doctor);
    }

    
    public function destroy(Doctor $doctor)
    {
        if($doctor->image){
            Storage::delete($doctor->image);
        }

        $doctor->delete();

        return $this->success('Doctor destroy successfully');
    }
}
