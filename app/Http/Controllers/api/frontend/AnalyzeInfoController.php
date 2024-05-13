<?php

namespace App\Http\Controllers\api\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnalyzeInfoController extends Controller
{
    public function getInfo($unique_id){
        $analyzes = DB::table('analyzes')->where('user_unique_id', $unique_id)->get();
        
        return $this->success('',$analyzes);
    }
}
