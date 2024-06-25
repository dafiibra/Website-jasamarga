<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\DataHasilDeteksi;
use DataTables;
use Illuminate\Support\Facades\DB;
use Spatie\ImageOptimizer\OptimizerChainFactory;
use Illuminate\Support\Facades\Auth;


class ValidationController extends Controller
{
    function fetch_data(Request $request)
    {
        $user = session('user');

        if($request->ajax()){
            $dataQuery = DB::table('data_hasil_deteksi')->where('is_valid', 'requested');

            if ($request->area != 'All') {
                $dataQuery->where('area', $request->area)->where('is_valid', 'requested')->get();
            }

            if ($request->from_date!= '' && $request->to_date != '') {
                $dataQuery->whereBetween('created_at', array($request->from_date, $request->to_date))->where('is_valid', 'requested')->get();
            }

            $data = $dataQuery->get();

            return datatables()->of($data)->make(true);
        }

        return view(('validation'), compact('user'));

    }

    public function approveResult($id_deteksi)
    {
        $user = session('user');
        $result = DataHasilDeteksi::findOrFail($id_deteksi);
        $result->is_valid = "approved";
        $result->validated_by = $user->username;
        $result->validated_timestamp = now();   
        $result->save();
        $result->touch();
        
        return response()->json(['success' => true]);
    }

    public function rejectResult($id_deteksi)
    {
        $user = session('user');
        $result = DataHasilDeteksi::findOrFail($id_deteksi);
        $result->is_valid = "rejected";
        $result->validated_by = $user->username;
        $result->validated_timestamp = now();
        $result->save();
        $result->touch();
        return response()->json(['success' => true]);
    }
}
