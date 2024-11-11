<?php

namespace App\Http\Controllers;

use App\Models\Well;
use App\Models\WellReading;
use Illuminate\Http\Request;

class WellReadingController extends Controller
{
    public function index()
    {
        $wellReadings = WellReading::all();
        $wells = Well::all();
        return view('well_readings.index', compact('wellReadings', 'wells'));
    }
    public function create(Well $well)
    {
        return view('well_readings.create', compact('well'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'well_id' => 'required|exists:wells,id',
            'tag' => 'nullable|string|max:255',
            'description' => 'required|string|max:255',
            'unit' => 'required|string|max:255',
        ]);
        // dd($validated);

        WellReading::create($validated);

        return redirect()->route('readings.index')->with('success', 'Reading created successfully.');
    }

    public function show(Well $well, WellReading $wellReading)
    {
        return view('well_readings.show', compact('well', 'wellReading'));
    }

    public function edit(WellReading $wellReading)
    {
        
        $well = $wellReading->well;
        return view('well_readings.edit', compact('well', 'wellReading'));
    }

    public function update(Request $request, WellReading $wellReading)
    {
        $validated = $request->validate([
            'tag' => 'nullable|string|max:255',
            'description' => 'required|string|max:255',
            'unit' => 'required|string|max:255',
        ]);

        $wellReading->update($validated);

        return redirect()->route('readings.index')->with('success', 'Reading updated successfully.');
    }

    public function destroy($id)
    {
        $wellReading = WellReading::findOrFail($id);

        $wellReading->delete();

        return redirect()->route('readings.index')->with('success', 'Reading deleted successfully.');
    }
}
