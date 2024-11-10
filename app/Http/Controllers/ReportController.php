<?php

namespace App\Http\Controllers;

use App\Models\Well;
use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil semua data wells
        $wells = Well::all();

        // Kirim data wells ke view
        return view('report.index', compact('wells'));
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
        // Validasi dan simpan data laporan
        $validated = $request->validate([
            'well_id' => 'required|exists:wells,id',
            'well_reading_id' => 'required|exists:well_readings,id',
            'value' => 'required|numeric',
        ]);

        // Simpan data laporan ke database
        Report::create($validated);

        return redirect()->route('reports.index')->with('success', 'Report created successfully');
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
