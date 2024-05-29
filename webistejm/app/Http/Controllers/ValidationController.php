<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\DetectionResult;
use DataTables;
use Illuminate\Support\Facades\DB;

class ValidationController extends Controller
{

    function fetch_data(Request $request)
    {
        
        if($request->ajax()){
            $dataQuery = DB::table('detection_results')->where('is_valid', 'requested');

            if ($request->area != 'All') {
                $dataQuery->where('area', $request->area)->where('is_valid', 'requested')->get();
            }

            if ($request->from_date!= '' && $request->to_date != '') {
                $dataQuery->whereBetween('created_at', array($request->from_date, $request->to_date))->where('is_valid', 'requested')->get();
            }

            $data = $dataQuery->get();

            return datatables()->of($data)->make(true);
        }

        return view('validation');

    }

    public function approveResult($id_deteksi)
    {
        $result = DetectionResult::findOrFail($id_deteksi);
        $result->is_valid = "accepted";
        $result->save();

        return response()->json(['success' => true]);
    }

    public function rejectResult($id_deteksi)
    {
        $result = DetectionResult::findOrFail($id_deteksi);
        $result->is_valid = "declined";
        $result->save();

        return response()->json(['success' => true]);
    }
}
