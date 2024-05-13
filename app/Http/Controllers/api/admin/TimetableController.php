<?php

namespace App\Http\Controllers\api\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TimetableStoreRequest;
use App\Http\Requests\TimetableUpdateRequest;
use App\Http\Resources\TimetableResource;
use App\Models\Timetable;
use Illuminate\Http\Request;

class TimetableController extends Controller
{
    public function __construct(){
        $this->authorizeResource(Timetable::class, 'timetable');
    }
    
    public function index()
    {
        $timetables = Timetable::paginate(10);

        return $this->success('', $timetables);
    }

    
    public function store(TimetableStoreRequest $request)
    {
        $validate = $request->validated();

        $timetable = Timetable::create($validate);

        return $this->success('time table saved successfully', $timetable);
    }

    
    public function show(Timetable $timetable)
    {
        return $this->success('', new TimetableResource($timetable));
    }

    
    public function update(TimetableUpdateRequest $request, Timetable $timetable)
    {
        $validated = $request->validated();

        $timetable->update($validated);

        return $this->success('time table updated successfully', new TimetableResource($timetable));
    }

    
    public function destroy(Timetable $timetable)
    {
        $timetable->delete();

        return $this->success('time table deleted for doctors');
    }
}
