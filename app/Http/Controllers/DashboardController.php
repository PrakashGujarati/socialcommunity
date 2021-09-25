<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('index');
    }
    public function getdata(Request $request)
    {
        if ($request->ajax()) {
            $data = array([               
                'name' => 'Sarvaiya ravindra dineshbhai',
                'address' => 'Lunivav Gondal Rajkot',
                'marital_status' => 'Married',
                'organization_and_address' => 'Shree Lunivan Primary school',
                'department_name' => 'Education',
                'destination'=> 'Upper pri teacher',
                'type_of_service' => 'Government',
                'mobile' => '9558414314'
            ]);
            return DataTables::of($data)
                    ->addIndexColumn()
                    // ->addColumn('action', function($row){
     
                    //        $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">View</a>';
    
                    //         return $btn;
                    // })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        
        return view('users');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function history()
    {
        //
        return view('history');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function contact()
    {
        //
        return view('contact');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getGallery()
    {
        //
        return view('gallery');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function blog()
    {
        //
        return view('blog');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function employee_records()
    {
        //
        return view('employee_table');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function event()
    {
        //
        return view('Pastevent');
    }

    public function committe()
    {
        //
        return view('committe');
    }
}
