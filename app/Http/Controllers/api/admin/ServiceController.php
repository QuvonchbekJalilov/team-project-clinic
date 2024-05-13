<?php

namespace App\Http\Controllers\api\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceStoreRequest;
use App\Http\Requests\ServiceUpdateRequest;
use App\Models\Service;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    public function __construct(){
        $this->authorizeResource(Service::class,'service');
    }

    public function index()
    {
        $services = Service::paginate(20);

        return $this->response($services);
    }


    public function store(ServiceStoreRequest $request)
    {
        $service = $request->validated();
        

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('service/' . time(), 'public');
        }

        $service = Service::create([
            'title_uz' => $request->title_uz,
            'title_ru' => $request->title_ru,
            'description_uz' => $request->description_uz,
            'description_ru' => $request->description_ru,
            'image' => $path
        ]);

        return $this->success('service successfully stored', $service);
    }


    public function show(Service $service)
    {
        $service = Service::find($service->id);

        return $this->response($service);
    }



    public function update(ServiceUpdateRequest $request, Service $service)
    {
        $validate = $request->validated();
        
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('service/' . time(), 'public');
        }
        $validate['image'] = $path ?? $service->image;

        $service->update($validate);

        return $this->success('service successfully updated', $service);
    }


    public function destroy(Service $service)
    {

        $doc = Service::find($service->id);
        $doc->delete();
        if ($service->image) {
            Storage::delete($service->image);
        }
        return $this->success('service successfully destroyed');
    }
}
