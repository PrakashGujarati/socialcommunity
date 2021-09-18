<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\BirthdayImport;
use App\Imports\BusinessImport;
use App\Imports\ContactImport;
use App\Imports\EducationImport;
use App\Imports\EmployeeImport;
use App\Imports\LateImport;
use App\Imports\CandidateImport;
use App\Imports\AnniversaryImport;

use Maatwebsite\Excel\Facades\Excel;

class ImportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        
        return view('setting.import');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function import(Request $request) 
    {
        if($request->type == 'Birthday'){

             Excel::import(new BirthdayImport,$request->file('file'));
        }
        elseif ($request->type == 'Business') {
            # code...
            Excel::import(new BusinessImport,$request->file('file'));
        }
        elseif ($request->type == 'Contacts') {
            # code...
            Excel::import(new ContactImport,$request->file('file'));
        }
        elseif ($request->type == 'Educations') {
            # code...
            Excel::import(new EducationImport,$request->file('file'));
        }
        elseif ($request->type == 'Employess') {
            # code...
            Excel::import(new EmployeeImport,$request->file('file'));
        }
        elseif ($request->type == 'Lates') {
            # code...
            Excel::import(new LateImport,$request->file('file'));
        }
        elseif ($request->type == 'Candidate') {
            # code...
            Excel::import(new CandidateImport,$request->file('file'));
        } 
        elseif ($request->type == 'Anniversary') {
            # code...
            Excel::import(new AnniversaryImport,$request->file('file'));
        }    
        else {
            return 'No Record Found';
        }
        return redirect()->route('import.index')->with('success', ' Record import Successfully.');;
    }
}
