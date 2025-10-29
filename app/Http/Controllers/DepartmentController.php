<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departments = Department::orderBy('nama_departemen')->paginate(5);
        $employees = Employee::orderBy('nama_lengkap')->get(); 

        return view('departments.index', compact('departments', 'employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         return view('departments.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_departemen' => 'required|string|max:100',
            'deskripsi' => 'string|nullable',
        ]);
        Department::create($request->all());
        return redirect()->route('departments.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Department $department)
    {
      $department->load('employees'); 
      $employeesInDepartment = $department->employees;

      return view('departments.show', compact('department', 'employeesInDepartment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
         $department = Department::find($id);
        return view('departments.edit',compact('department'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         $request->validate([
            'nama_departemen' => 'required|string|max:100',
            'deskripsi' => 'string|nullable',
        ]);
        $department = Department::findOrFail($id);
        $department->update($request->only([
            'nama_departemen',
            'deskripsi'
        ]));
        return redirect()->route('departments.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $department = Department::find($id);
        $department->delete();
        return redirect()->route('departments.index');
    }
}
