<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\DetectionResult;
use DB;

class ValidationController extends Controller
{
    function show()
    {
        $res = DetectionResult::all();
        $areas = DetectionResult::pluck('area');
        $uniqueAreas = $areas->unique();
        return view('validation', ['results'=>$res, 'areas'=>$uniqueAreas]);
    }

    function fetch_data(Request $request){
        if($request->ajax()){
            $dataQuery = DB::table('detection_results');

            if ($request->area != 'All') {
                $dataQuery->where('area', $request->area)->get();
            }

            if ($request->from_date!= '' && $request->to_date != '') {
                $dataQuery->whereBetween('created_at', array($request->from_date, $request->to_date))->get();
            }

            $data = $dataQuery->orderBy('created_at', 'desc')->get();
            
            echo json_encode($data);
        }
    }
}
