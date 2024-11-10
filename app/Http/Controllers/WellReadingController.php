<?php

namespace App\Http\Controllers;

use App\Models\Well;
use App\Models\WellReading;
use Illuminate\Http\Request;

class WellReadingController extends Controller
{
    // Menampilkan semua readings untuk well tertentu
    public function index()
    {
        $wellReadings = WellReading::all();
        $wells = Well::all();
        return view('well_readings.index', compact('wellReadings', 'wells'));
    }

    // Menampilkan form untuk membuat reading baru
    public function create(Well $well)
    {
        return view('well_readings.create', compact('well'));
    }

    // Menyimpan reading baru ke database
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'well_id' => 'required|exists:wells,id', // Validasi well_id
            'tag' => 'required|string|max:255',
            'start_date' => 'required|date',
        ]);
        // dd($validated);
        // Membuat WellReading baru
        WellReading::create($validated);

        // Redirect kembali dengan pesan sukses
        return redirect()->route('readings.index')->with('success', 'Reading created successfully.');
    }

    // Menampilkan satu reading berdasarkan id
    public function show(Well $well, WellReading $wellReading)
    {
        return view('well_readings.show', compact('well', 'wellReading'));
    }

    // Menampilkan form edit untuk reading
    public function edit(Well $well, WellReading $wellReading)
    {
        return view('well_readings.edit', compact('well', 'wellReading'));
    }

    // Memperbarui data reading di database
    public function update(Request $request, Well $well, WellReading $wellReading)
    {
        $request->validate([
            'parameter' => 'required|string',
            'value' => 'required|numeric',
            'timestamp' => 'required|date',
        ]);

        $wellReading->update($request->all());

        return redirect()
            ->route('well_readings.index', $well->id)
            ->with('success', 'Reading updated successfully.');
    }

    // Menghapus data reading dari database
    public function destroy(Well $well, WellReading $wellReading)
    {
        $wellReading->delete();

        return redirect()
            ->route('well_readings.index', $well->id)
            ->with('success', 'Reading deleted successfully.');
    }
}
