<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dashboard;
use App\Models\Inspeksi;
use App\Models\DataHasilDeteksi;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $currentYear = Carbon::now()->year;
    
        $inspeksi = Inspeksi::whereYear('tanggal_inspeksi', $currentYear)->get();
        $inspeksiIds = $inspeksi->pluck('id_inspeksi');
        $dataHasilDeteksi = DataHasilDeteksi::whereIn('id_inspeksi', $inspeksiIds)->get();
    
        $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        $totalTemuan = array_fill(0, 12, 0);
        $verified = array_fill(0, 12, 0);
        $accuracy = array_fill(0, 12, 0);
        $precision = array_fill(0, 12, 0);
        $recall = array_fill(0, 12, 0);
    
        foreach ($inspeksi as $inspeksiItem) {
            $monthIndex = Carbon::parse($inspeksiItem->tanggal_inspeksi)->month - 1;
            $monthTotalTemuan = $dataHasilDeteksi->where('id_inspeksi', $inspeksiItem->id_inspeksi)->count();
            $monthVerified = $dataHasilDeteksi->where('id_inspeksi', $inspeksiItem->id_inspeksi)->where('is_valid', 'accepted')->count();
            $totalTemuan[$monthIndex] += $monthTotalTemuan;
            $verified[$monthIndex] += $monthVerified;
    
            $monthJumlahPothole = $inspeksi->where('id_inspeksi', $inspeksiItem->id_inspeksi)->sum('jumlah_pothole');
            $accuracy[$monthIndex] = $monthJumlahPothole > 0 ? number_format(($monthTotalTemuan / $monthJumlahPothole) * 100, 2) : 0;
            $precision[$monthIndex] = $monthTotalTemuan > 0 ? number_format(($monthVerified / $monthTotalTemuan) * 100, 2) : 0;
            $recall[$monthIndex] = $monthJumlahPothole > 0 ? number_format(($monthVerified / $monthJumlahPothole) * 100, 2) : 0;
        }
    
        $data = [
            'totalTemuanModel' => array_sum($totalTemuan),
            'truePothole' => array_sum($verified),
            'akurasiModel' => number_format(array_sum($accuracy) / count(array_filter($accuracy, fn($value) => $value != 0)), 2),
            'precision' => number_format(array_sum($precision) / count(array_filter($precision, fn($value) => $value != 0)), 2),
            'recall' => number_format(array_sum($recall) / count(array_filter($recall, fn($value) => $value != 0)), 2),
            'months' => $months,
            'totalTemuan' => $totalTemuan,
            'verified' => $verified,
            'accuracy' => $accuracy,
            'precision' => $precision,
            'recall' => $recall,
        ];
    
        return view('dashboard', compact('data'));
    }
    
        public function filterData(Request $request)
    {
        try {
            $startDate = Carbon::parse($request->input('start_date'));
            $endDate = Carbon::parse($request->input('end_date'));
            $area = $request->input('area');
    
            \Log::info('Filter inputs', ['start_date' => $startDate, 'end_date' => $endDate, 'area' => $area]);
    
            $inspeksi = Inspeksi::whereBetween('tanggal_inspeksi', [$startDate, $endDate])
                                ->where('area', $area)
                                ->get();
    
            \Log::info('Inspeksi data', ['inspeksi' => $inspeksi]);
    
            $inspeksiIds = $inspeksi->pluck('id_inspeksi');
            $dataHasilDeteksi = DataHasilDeteksi::whereIn('id_inspeksi', $inspeksiIds)->get();
    
            \Log::info('Data Hasil Deteksi', ['dataHasilDeteksi' => $dataHasilDeteksi]);
    
            $filteredMonths = [];
            $totalTemuan = [];
            $verified = [];
            $accuracy = [];
            $precision = [];
            $recall = [];
    
            foreach ($inspeksi as $inspeksiItem) {
                $month = Carbon::parse($inspeksiItem->tanggal_inspeksi)->format('F');
                if (!in_array($month, $filteredMonths)) {
                    $filteredMonths[] = $month;
                }
    
                $monthTotalTemuan = $dataHasilDeteksi->where('id_inspeksi', $inspeksiItem->id_inspeksi)->count();
                $monthVerified = $dataHasilDeteksi->where('id_inspeksi', $inspeksiItem->id_inspeksi)->where('is_valid', 'accepted')->count();
    
                $totalTemuan[] = $monthTotalTemuan;
                $verified[] = $monthVerified;
                
                $monthJumlahPothole = $inspeksi->where('id_inspeksi', $inspeksiItem->id_inspeksi)->sum('jumlah_pothole');
                $accuracy[] = $monthJumlahPothole > 0 ? number_format(($monthTotalTemuan / $monthJumlahPothole) * 100, 2) : 0;
                $precision[] = $monthTotalTemuan > 0 ? number_format(($monthVerified / $monthTotalTemuan) * 100, 2) : 0;
                $recall[] = $monthJumlahPothole > 0 ? number_format(($monthVerified / $monthJumlahPothole) * 100, 2) : 0;
            }
    
            $metrics = [
                'totalTemuanModel' => array_sum($totalTemuan),
                'truePothole' => array_sum($verified),
                'akurasiModel' => number_format(array_sum($accuracy) / count(array_filter($accuracy, fn($value) => $value != 0)), 2),
                'precision' => number_format(array_sum($precision) / count(array_filter($precision, fn($value) => $value != 0)), 2),
                'recall' => number_format(array_sum($recall) / count(array_filter($recall, fn($value) => $value != 0)), 2),
                'months' => $filteredMonths,
                'totalTemuan' => $totalTemuan,
                'verified' => $verified,
                'accuracy' => $accuracy,
                'precision' => $precision,
                'recall' => $recall,
            ];
    
            return response()->json($metrics);
        } catch (\Exception $e) {
            \Log::error('Error filtering data: ' . $e->getMessage());
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }
    
}
