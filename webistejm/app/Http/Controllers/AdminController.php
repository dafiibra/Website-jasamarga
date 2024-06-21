<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\inspektor;
use App\Models\LogActivity;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function approve(Request $request, $id)
    {
        $inspektor = inspektor::findOrFail($id);
        $inspektor->status = 'approved';
        $inspektor->accepted_by = auth()->user()->username;
        $inspektor->accepted_timestamp = now();
        $inspektor->save();

        return response()->json(['message' => 'User approved']);
    }

    public function reject(Request $request, $id)
    {
        $inspektor = inspektor::findOrFail($id);
        $inspektor->status = 'rejected';
        $inspektor->rejected_by = auth()->user()->username;
        $inspektor->rejected_timestamp = now();
        $inspektor->save();

        return response()->json(['message' => 'User rejected']);
    }

    public function viewUsers()
    {
        $users = inspektor::where('status', 'approved')->get();
        return response()->json($users);
    }

    public function viewLoginActivity()
    {
        $activities = LogActivity::all();
        return response()->json($activities);
    }
}
