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

    public function index(Request $request)
    {
        $postQuery = Doctor::query();

        if ($request->filled('first_name')) {
            $postQuery->whereHas('user', function ($query) use ($request) {
                $query->where('first_name', 'like', "%" . $request->input('first_name') . "%");
            });
        }

        if ($request->filled('last_name')) {
            $postQuery->whereHas('category', function ($query) use ($request) {
                $query->where('last_name', 'like', "%" . $request->input('last_name') . "%");
            });
        }

        $posts = $postQuery->paginate(5);

        return $this->response($posts);
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
        return $this->response($doctor);
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
