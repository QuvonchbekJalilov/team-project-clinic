<?php

namespace App\Http\Controllers\Api\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    public function index(Request $request)
    {
        $locale = $request->locale ?? "ru";
        App::setLocale($locale);
        Session::put('locale', $locale);

        return response()->json(['message' => 'Language changed to ' . App::getLocale()]);
    }
}
