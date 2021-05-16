<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller
{
    public $rules = [
        'first_name' => 'required',
        'office' => 'required',
        'category' => 'required',
        'contact' => 'required|numeric',
        'logo' => 'image|mimes:jpg,png,jpeg'
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.employees', ['employees' => Employee::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('forms.create_employee');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate($this->rules);
        $logo = '';
        if ($request->file()) {
            $logo = time().$request->file('logo')->getClientOriginalName();
            $request->file('logo')->storeAs('employee_logos', $logo, 'public');
        }
        Employee::create([
            'user_id' => 1,
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'office' => $request->office,
            'category' => $request->category,
            'designation' => $request->designation,
            'contact' => $request->contact,
            'email' => $request->email,
            'address' => $request->address,
            'logo' => $logo,
            'status' => $request->status,
            'done_by' => 1
        ]);
        return redirect()->route('employee.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        return view('forms.edit_employee', ['employee' => $employee]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        $request->validate($this->rules);
        if ($request->file('logo')) {
            Storage::delete('public/employee_logos/'.$employee->logo);
            $logo = $request->file('logo')->getClientOriginalName();
            $request->file('logo')->storeAs('employee_logos', $request->logo->getClientOriginalName(), 'public');
            $employee->update(['logo' => $logo]);
        }
        $employee->update([
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'office' => $request->office,
            'category' => $request->category,
            'designation' => $request->designation,
            'contact' => $request->contact,
            'email' => $request->email,
            'address' => $request->address,
            'status' => $request->status,
        ]);
        return redirect()->route('employee.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        Storage::delete('public/employee_logos/'.$employee->logo);
        $employee->delete();
        return redirect()->route('employee.index');
    }
}
