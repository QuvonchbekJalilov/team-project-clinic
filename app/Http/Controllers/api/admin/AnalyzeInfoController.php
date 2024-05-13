<?php

namespace App\Http\Controllers\api\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AnalyzeInfoStoreRequest;
use App\Http\Requests\AnalyzeInfoUpdateRequest;
use App\Models\analyze;
use Illuminate\Http\Request;

class AnalyzeInfoController extends Controller
{
    public function __construct(){
        $this->authorizeResource(analyze::class, 'analyze');
    }
    
    public function index()
    {
        $analyzes = analyze::paginate(10);
        return $this->response($analyzes);
    }

   
    public function store(AnalyzeInfoStoreRequest $request)
    {
        $validated = $request->validated();

        $analyze = analyze::create($validated);
        return $this->success('', $analyze);
    }
    
    public function show(analyze $analyze)
    {
        $info = analyze::find($analyze->id);
        return $this->response($info);
    }

    public function update(AnalyzeInfoUpdateRequest $request, analyze $analyze)
    {
        $validated = $request->validated();

        $info = $analyze->update($validated);

        return $this->success('analyze info updated successfully', $info);
    }

    
    public function destroy(analyze $analyze)
    {
        $analyze->delete();

        return $this->success('analyze info deleted successfully');
    }
}
