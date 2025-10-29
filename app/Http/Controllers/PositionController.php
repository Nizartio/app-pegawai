<?php

namespace App\Http\Controllers;

use App\Models\Position;
use App\Models\Employee;
use Illuminate\Http\Request;


class PositionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $positions = Position::orderBy('nama_jabatan')->paginate(5);

        return view('positions.index', compact('positions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('positions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_jabatan' => 'required|string|max:100',
            'gaji_pokok' => 'required|numeric|between:0,99999999.99'
        ]);
        Position::create($request->all());
        return redirect()->route('positions.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Position $position)
    {
      $position->load('employees'); 
      $employeesInPosition = $position->employees;

      return view('positions.show', compact('position', 'employeesInPosition'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $position = Position::find($id);
        return view('positions.edit', compact('position'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_jabatan' => 'required|string|max:100',
            'gaji_pokok' => 'required|numeric|between:0,99999999.99'
        ]);
        $position = Position::findOrFail($id);
        $position->update($request->only([
            'nama_jabatan',
            'gaji_pokok'
        ]));
        return redirect()->route('positions.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $position = Position::find($id);
        $position->delete();
        return redirect()->route('positions.index');
    }
}
