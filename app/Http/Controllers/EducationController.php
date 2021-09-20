<?php

namespace App\Http\Controllers;

use App\Models\Education;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EducationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.education' , ['educations' => Education::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('forms.create_education');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $picture = '';
        if ($request->file('picture')) {
            $picture = time().$request->file('picture')->getClientOriginalName();
            $request->file('picture')->storeAs('picture', $picture, 'public');
        }

        Education::create([
            'name' => $request->name,
            'qualification' => $request->qualification,
            'picture' => $picture,
            'note' => $request->note,
            'gender' => $request->gender,
            'status' => $request->status,
            'done_by' => 1
        ]);
        return redirect()->route('education.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Education  $education
     * @return \Illuminate\Http\Response
     */
    public function show(Education $education)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Education  $education
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $education=Education::where('id',$id)->first();
        return view('forms.edit_education',compact('education'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Education  $education
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Education $education)
    {
        if ($request->file('picture')) {
            Storage::delete('public/visiting_cards/'.$education->picture);
            $picture = time().$request->file('picture')->getClientOriginalName();
            $request->file('picture')->storeAs('visiting_cards', $picture, 'public');
            $education->update(['picture' => $picture]);
        }
        $education->update([
            'name' => $request->name,
            'qualification' => $request->qualification,
            'note' => $request->note,
            'gender' => $request->gender,
            'status' => $request->status,
            'done_by' => 1
        ]);
        return redirect()->route('education.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Education  $education
     * @return \Illuminate\Http\Response
     */
    public function destroy(Education $education)
    {
        $education->delete();
        return redirect()->route('education.index');
    }
}