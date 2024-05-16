<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetectionResult;

class ValidationController extends Controller
{
    function show()
    {
        $res = DetectionResult::all();
        return view('validation', ['results'=>$res]);
    }
}
