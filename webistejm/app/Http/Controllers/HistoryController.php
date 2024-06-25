<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\DataHasilDeteksi;
use DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class HistoryController extends Controller
{
    function fetch_data(Request $request)
    {
        $user = session('user');

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

        return view(('history'), compact('user'));

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
            $path = '';
    
            if ($progress === '50%') {
                $path = $file->storeAs('uploads/fiftypct', $filename, 'public');
                $item->fifty_pct_image_url = '/storage/' . $path;
                $item->fifty_pct_update_timestamp = now();
            } elseif ($progress === '100%') {
                $path = $file->storeAs('uploads/onehudpct', $filename, 'public');
                $item->onehud_pct_image_url = '/storage/' . $path;
                $item->onehud_pct_update_timestamp = now();
            }

            if ($path) {
                $this->compressImage($file, $path);
            }
        }
    
        // Save the updated item to the database
        $item->save();

        // update the updated_at
        $item->touch();
    
        // Return a success response
        return response()->json(['success' => 'Progress updated successfully']);
    }
    
    private function compressImage($file, $path)
{
    // Get the full path to the stored image
    $fullPath = storage_path('app/public/' . $path);

    // Create an image resource from the file
    $src = imagecreatefromjpeg($file->getRealPath());

    // Get image dimensions
    $width = imagesx($src);
    $height = imagesy($src);

    // Create a new image with desired dimensions
    $tmp = imagecreatetruecolor($width, $height);

    // Copy and resize part of an image with resampling
    imagecopyresampled($tmp, $src, 0, 0, 0, 0, $width, $height, $width, $height);

    // Save the compressed image
    imagejpeg($tmp, $fullPath, 50);

    // Free up memory
    imagedestroy($src);
    imagedestroy($tmp);
}

}