<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\DetectionResult;
use DataTables;
use Illuminate\Support\Facades\DB;

class HistoryController extends Controller
{

    function fetch_data(Request $request)
    {
        
        if($request->ajax()){
            $dataQuery = DB::table('detection_results')->where('is_valid', 'accepted');

            if ($request->area != 'All') {
                $dataQuery->where('area', $request->area)->where('is_valid', 'accepted')->get();
            }

            if ($request->repair_progress != 'All') {
                $dataQuery->where('repair_progress', $request->repair_progress)->where('is_valid', 'accepted')->get();
            }

            if ($request->from_date!= '' && $request->to_date != '') {
                $dataQuery->whereBetween('created_at', array($request->from_date, $request->to_date))->where('is_valid', 'accepted')->get();
            }

            $data = $dataQuery->get();

            return datatables()->of($data)->make(true);
        }

        return view('history');

    }

    public function update(Request $request)
    {
        // Validate the input
        $request->validate([
            'id_deteksi' => 'required|integer|exists:detection_results,id_deteksi',
            'progress' => 'required|in:0%,50%,100%',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
    
        // Find the item by ID
        $item = DetectionResult::findorFail($request->id_deteksi);
    
        // Update the repair progress field
        $progress = $request->input('progress');
        $item->repair_progress = intval(str_replace('%', '', $progress));
    
        // Handle the image upload
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time().'_'.$file->getClientOriginalName();
            $path = $file->storeAs('uploads', $filename, 'public');
    
            if ($progress === '50%') {
                $item->fifty_pct_image_url = '/storage/' . $path;
            } elseif ($progress === '100%') {
                $item->onehud_pct_image_url = '/storage/' . $path;
            }
        }
    
        // Save the updated item to the database
        $item->save();
    
        // Return a success response
        return response()->json(['success' => 'Progress updated successfully']);
    }    
    
}