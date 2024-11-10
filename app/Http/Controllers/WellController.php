<?php

namespace App\Http\Controllers;

use App\Models\Well;
use Illuminate\Http\Request;

class WellController extends Controller
{
    // Menampilkan semua wells
    public function index()
    {
        $wells = Well::all();
        return view('wells.index', compact('wells'));
    }

    // Menampilkan form untuk membuat well baru
    public function create()
    {
        return view('wells.create');
    }

    // Menyimpan well baru ke database
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:wells|max:255',
        ]);

        Well::create($validated);

        return redirect()->route('wells.index')->with('success', 'Well created successfully.');
    }

    // Menampilkan satu well berdasarkan id
    public function show(Well $well)
    {
        return view('wells.show', compact('well'));
    }

    // Menampilkan form edit untuk well
    public function edit(Well $well)
    {
        return view('wells.edit', compact('well'));
    }

    // Memperbarui data well di database
    public function update(Request $request, Well $well)
    {
        $request->validate([
            'name' => 'required|max:255|unique:wells,name,' . $well->id,
        ]);

        $well->update($request->all());

        return redirect()->route('wells.index')->with('success', 'Well updated successfully.');
    }

    // Menghapus data well dari database
    public function destroy(Well $well)
    {
        $well->delete();

        return redirect()->route('wells.index')->with('success', 'Well deleted successfully.');
    }
}
