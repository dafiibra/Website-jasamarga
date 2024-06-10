<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\DataHasilDeteksi;
use DataTables;
use Illuminate\Support\Facades\DB;

class HistoryController extends Controller
{

    function fetch_data(Request $request)
    {
        
        if($request->ajax()){
            $dataQuery = DB::table('data_hasil_deteksi')->where('is_valid', 'approved');

            if ($request->area != 'All') {
                $dataQuery->where('area', $request->area)->where('is_valid', 'approved')->get();
            }

            if ($request->repair_progress != 'All') {
                $dataQuery->where('repair_progress', $request->repair_progress)->where('is_valid', 'approved')->get();
            }

            if ($request->from_date!= '' && $request->to_date != '') {
                $dataQuery->whereBetween('created_at', array($request->from_date, $request->to_date))->where('is_valid', 'approved')->get();
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
            'id_deteksi' => 'required|string|exists:data_hasil_deteksi,id_deteksi',
            'progress' => 'required|in:0%,50%,100%',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
    
        // Find the item by ID
        $item = DataHasilDeteksi::findorFail($request->id_deteksi);
    
        // Update the repair progress field
        $progress = $request->input('progress');
        $item->repair_progress = intval(str_replace('%', '', $progress));
    
        // Handle the image upload
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time().'_'.$file->getClientOriginalName();
            
    
            if ($progress === '50%') {
                $path = $file->storeAs('uploads/fiftypct', $filename, 'public');
                $item->fifty_pct_image_url = '/storage/' . $path;
            } elseif ($progress === '100%') {
                $path = $file->storeAs('uploads/onehudpct', $filename, 'public');
                $item->onehud_pct_image_url = '/storage/' . $path;
            }
        }
    
        // Save the updated item to the database
        $item->save();

        // update the updated_at
        $item->touch();
    
        // Return a success response
        return response()->json(['success' => 'Progress updated successfully']);
    }    
    
}