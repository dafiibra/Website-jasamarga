<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\inspektor;
use App\Models\LogActivity;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    public function approve($username)
    {
        $user = session('user');
        Log::info('User from session:', (array) $user); // Log session content
        $inspektor = inspektor::findOrFail($username);
        $inspektor->status = 'approved';
        $inspektor->accepted_by = $user->username;
        $inspektor->accepted_timestamp = now();
        $inspektor->save();

        Log::info('Inspektor before save:', $inspektor->toArray()); // Log model before save
        $inspektor->save();
        Log::info('Inspektor after save:', $inspektor->toArray()); // Log model after save

        return response()->json(['message' => 'User approved']);
    }

    public function reject($id)
    {
        $user = session('user');
        Log::info('User from session:', (array) $user); // Log session content
        $inspektor = inspektor::findOrFail($id);
        $inspektor->status = 'rejected';
        $inspektor->rejected_by = $user->username;
        $inspektor->rejected_timestamp = now();
        $inspektor->save();

        Log::info('Inspektor before save:', $inspektor->toArray()); // Log model before save
        $inspektor->save();
        Log::info('Inspektor after save:', $inspektor->toArray()); // Log model after save


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
