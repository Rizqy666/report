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
    // public function index()
    // {
    //     // Ambil semua laporan tanpa filter user_id
    //     $reports = Report::orderBy('created_at', 'desc')->get();

    //     // Tentukan rentang waktu (awal dan akhir bulan)
    //     $startOfMonth = Carbon::now()->startOfMonth();
    //     $endOfMonth = Carbon::now()->endOfMonth();

    //     // Ambil laporan yang dibuat dalam bulan ini berdasarkan report_date
    //     $reportsForMonth = Report::whereBetween('report_date', [$startOfMonth, $endOfMonth])
    //         ->orderBy('report_date', 'asc')  // Menggunakan report_date untuk urutan
    //         ->get();

    //     // Akumulasi nilai `value` per tanggal dalam bulan ini
    //     $dailyReports = [];
    //     foreach (CarbonPeriod::create($startOfMonth, $endOfMonth) as $date) {
    //         $formattedDate = $date->format('Y-m-d');
    //         $dailyReports[$formattedDate] = 0;
    //     }

    //     // Isi data dengan nilai report per tanggal berdasarkan report_date
    //     foreach ($reportsForMonth as $report) {
    //         $date = $report->report_date->format('Y-m-d');  // Gunakan report_date
    //         $dailyReports[$date] += $report->value;
    //     }
    //     // dd($dailyReports);
    //     // Persiapkan data untuk chart
    //     $chartLabels = array_keys($dailyReports);
    //     $chartValues = array_values($dailyReports);

    //     $wells = Well::all();

    //     // Kirim data ke view
    //     return view('report.index', compact('reports', 'wells', 'reportsForMonth', 'chartLabels', 'chartValues'));
    // }
    public function index()
    {
        // Tentukan rentang waktu (awal dan akhir bulan)
        $startOfMonth = Carbon::now()->startOfMonth()->format('Y-m-d');
        $endOfMonth = Carbon::now()->endOfMonth()->format('Y-m-d');

        // Ambil laporan yang dibuat dalam bulan ini berdasarkan report_date
        $reportsForMonth = Report::whereBetween('report_date', [$startOfMonth, $endOfMonth])
            ->orderBy('report_date', 'asc') // Urutkan berdasarkan report_date
            ->get();

        // Akumulasi nilai `value` per tanggal dalam bulan ini berdasarkan report_date
        $dailyReports = [];
        foreach (CarbonPeriod::create($startOfMonth, $endOfMonth) as $date) {
            $formattedDate = $date->format('Y-m-d');
            $dailyReports[$formattedDate] = 0;
        }

        // Isi data dengan nilai report per tanggal berdasarkan report_date
        foreach ($reportsForMonth as $report) {
            $date = Carbon::parse($report->report_date)->format('Y-m-d'); // Pastikan format tanggalnya benar
            $dailyReports[$date] += $report->value; // Akumulasi nilai berdasarkan tanggal
        }

        // Debug data yang akan dikirim ke view
        // dd($dailyReports); // Pastikan data sesuai dengan harapan

        // Persiapkan data untuk chart
        $chartLabels = array_keys($dailyReports);
        $chartValues = array_values($dailyReports);

        // Ambil semua wells
        $wells = Well::all();

        // Kirim data ke view
        return view('report.index', compact('reportsForMonth', 'chartLabels', 'chartValues', 'wells'));
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
        // produksi
        // $data = $request->input('data');

        // if (!auth()->check()) {
        //     return redirect()->route('login')->with('error', 'Please log in to submit a report.');
        // }

        // $userId = auth()->user()->id;

        // $lastReport = Report::where('user_id', $userId)->latest()->first();

        // // Batasan waktu 2 jam untuk pengisian report
        // if ($lastReport && $lastReport->created_at->diffInHours(now()) < 2) {
        //     return back()->with('error', 'You can only submit a report every 2 hours.');
        // }

        // // Looping untuk menyimpan setiap laporan yang di-input
        // foreach ($data as $wellId => $readings) {
        //     foreach ($readings as $readingId => $values) {
        //         Report::create([
        //             'well_id' => $values['well_id'],
        //             'well_reading_id' => $values['well_reading_id'],
        //             'value' => $values['value'],
        //             'report_date' => Carbon::now()->toDateString(), // Set tanggal laporan ke tanggal hari ini
        //             'user_id' => $userId,
        //         ]);
        //     }
        // }

        // return redirect()->route('reports.index')->with('success', 'Report submitted successfully.');

        // Deploy
        // Validasi input
        // dd($request->all());
        $validatedData = $request->validate([
            'report_date' => 'required|date', // Ambil tanggal dari user
            'data.*.*.well_id' => 'required|integer',
            'data.*.*.well_reading_id' => 'required|integer',
            'data.*.*.value' => 'required|numeric',
        ]);

        // Gunakan tanggal yang di-input user
        $reportDate = $validatedData['report_date'];

        foreach ($validatedData['data'] as $readings) {
            foreach ($readings as $values) {
                Report::create([
                    'well_id' => $values['well_id'],
                    'well_reading_id' => $values['well_reading_id'],
                    'value' => $values['value'],
                    'report_date' => $reportDate, // Pastikan pakai tanggal dari user
                    'user_id' => auth()->id(),
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
