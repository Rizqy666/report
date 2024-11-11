<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Well;
use App\Models\Report;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil semua laporan tanpa filter user_id
        $reports = Report::orderBy('created_at', 'desc')->get();

        // Tentukan rentang waktu (awal dan akhir bulan)
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();

        // Ambil laporan yang dibuat dalam bulan ini
        $reportsForMonth = Report::whereBetween('created_at', [$startOfMonth, $endOfMonth])
            ->orderBy('created_at', 'asc')
            ->get();

        // Akumulasi nilai `value` per tanggal dalam bulan ini
        $dailyReports = [];
        foreach (CarbonPeriod::create($startOfMonth, $endOfMonth) as $date) {
            $formattedDate = $date->format('Y-m-d');
            $dailyReports[$formattedDate] = 0;
        }

        // Isi data dengan nilai report per tanggal
        foreach ($reportsForMonth as $report) {
            $date = $report->created_at->format('Y-m-d');
            $dailyReports[$date] += $report->value;
        }

        // Persiapkan data untuk chart
        $chartLabels = array_keys($dailyReports);
        $chartValues = array_values($dailyReports);

        $wells = Well::all();

        // Kirim data ke view
        return view('report.index', compact('reports', 'wells', 'reportsForMonth', 'chartLabels', 'chartValues'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->input('data');

        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Please log in to submit a report.');
        }

        $userId = auth()->user()->id;

        $lastReport = Report::where('user_id', $userId)->latest()->first();

        // Batasan waktu 2 jam untuk pengisian report
        if ($lastReport && $lastReport->created_at->diffInHours(now()) < 2) {
            return back()->with('error', 'You can only submit a report every 2 hours.');
        }

        // Looping untuk menyimpan setiap laporan yang di-input
        foreach ($data as $wellId => $readings) {
            foreach ($readings as $readingId => $values) {
                Report::create([
                    'well_id' => $values['well_id'],
                    'well_reading_id' => $values['well_reading_id'],
                    'value' => $values['value'],
                    'report_date' => Carbon::now()->toDateString(), // Set tanggal laporan ke tanggal hari ini
                    'user_id' => $userId,
                ]);
            }
        }

        return redirect()->route('reports.index')->with('success', 'Report submitted successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Report $report)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Report $report)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Report $report)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Report $report)
    {
        //
    }
}
