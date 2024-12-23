<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Well;
use App\Models\Report;
use Carbon\CarbonPeriod;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        // Ambil semua laporan tanpa filter user_id
        $reports = Report::orderBy('created_at', 'desc')->get();

        // Tentukan rentang waktu (awal dan akhir bulan)
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();

        // Ambil laporan yang dibuat dalam bulan ini berdasarkan report_date
        $reportsForMonth = Report::whereBetween('report_date', [$startOfMonth, $endOfMonth])
            ->orderBy('report_date', 'asc')
            ->get();

        // Ambil semua well_readings terurut berdasarkan `description`
        $wellReadings = Well::with([
            'wellReadings' => function ($query) {
                $query->orderBy('description', 'asc');
            },
        ])->get();

        // Filter berdasarkan `well_reading`
        $selectedWellReading = $request->input('well_reading');
        if ($selectedWellReading) {
            $reportsForMonth = $reportsForMonth->where('well_reading_id', $selectedWellReading);
        }

        // Akumulasi nilai `value` per tanggal dalam bulan ini berdasarkan report_date
        $dailyReports = [];
        foreach (CarbonPeriod::create($startOfMonth, $endOfMonth) as $date) {
            $formattedDate = $date->format('Y-m-d');
            $dailyReports[$formattedDate] = 0;
        }

        // Isi data dengan nilai report per tanggal berdasarkan report_date
        foreach ($reportsForMonth as $report) {
            $date = $report->report_date->format('Y-m-d'); // Gunakan report_date
            $dailyReports[$date] += $report->value;
        }

        // Persiapkan data untuk chart
        $chartLabels = array_keys($dailyReports);
        $chartValues = array_values($dailyReports);

        // Kirim data ke view
        return view('dashboard.home', compact('reports', 'wellReadings', 'selectedWellReading', 'reportsForMonth', 'chartLabels', 'chartValues'));
    }
}
