<?php

namespace App\Http\Controllers\api\frontend;

use App\Http\Controllers\Controller;
use App\Http\Resources\DoctorResource;
use App\Http\Resources\ServiceResource;
use App\Models\Doctor;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class PageController extends Controller
{
    public function doctorInfo()
    {
        $doctors = Doctor::paginate(10);
        return $this->response(DoctorResource::collection($doctors));
    }

    public function serviceInfo()
    {
        $services = Service::paginate(10);
        return $this->response(ServiceResource::collection($services));
    }
}
