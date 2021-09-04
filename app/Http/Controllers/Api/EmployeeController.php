<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Auth;
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
    public function list()
    {
        $data = Employee::all();
        return $this->responseOut($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), $this->rules);

        if ($validator->fails()) {
            return ['status' => "false",'msg' => $validator->messages()];
        }
        $logo = '';
        if ($request->file()) {
            $logo = time().$request->file('logo')->getClientOriginalName();
            $request->file('logo')->storeAs('employee_logos', $logo, 'public');
        }
        $newEmployee = Employee::create([
            'user_id' => Auth::user()->id,
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
            'status' => 'Active',
            'done_by' => Auth::user()->id
        ]);
        return $this->responseOut($newEmployee);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $data = Employee::where(['id' => $request->employee_id])->first();
        return $this->responseOut($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $employee = Employee::where(['id'=>$request->employee_id,'user_id'=>Auth::user()->id])->first();

        if (!empty($employee)) {
            $validator = Validator::make($request->all(), $this->rules);

            if ($validator->fails()) {
                return ['status' => "false",'msg' => $validator->messages()];
            }

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
            ]);
            return $this->responseOut($employee);
        } else {
            return $this->responseOut($employee);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function responseOut($data)
    {
        if (!empty($data)) {
            return response()->json([
                'code' => 200,
                'message' => 'success',
                'data' => $data
            ]);
        } else {
            return response()->json([
                'code' => 400,
                'message' => 'No Employee Found !',
                'data' => []
            ]);
        }
    }
}
