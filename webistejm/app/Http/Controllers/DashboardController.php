<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dashboard;

class DashboardController extends Controller
{
    public function index()
    {
        $detections = Dashboard::all();
        $data = [
            'totalTemuan' => [400, 450, 550, 600, 650, 580],
            'verified' => [300, 400, 520, 580, 600, 560],
            'months' => ['January', 'February', 'March', 'April', 'May', 'June'],
            'accuracy' => 98,
            'precision' => 95,
            'recall' => 93
        ];

        return view('dashboard', compact('data'), ['detections' => $detections]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'area' => 'required',
            'file' => 'required|file|max:2048',
        ]);
    }
}
