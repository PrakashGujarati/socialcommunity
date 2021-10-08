<?php

namespace App\Http\Controllers;

use App\Models\Anniversary;
use Illuminate\Http\Request;

class AnniversaryController extends Controller
{
    public $rules = [
        'name' => 'required',
        'marriage_date' => 'required',
        'picture' => 'mimes:jpeg,jpg,png'
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.anniversaries',['anniversaries' => Anniversary::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('forms.create_anniversary');
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

        $pictureName = "";

        if ($mediaFile = $request->file('picture')) {
            $pictureName = globallyStoreMedia($mediaFile,"/anniversary_pictures");
        }

        Anniversary::create([
            'name' => $request->name,
            'marriagedate' => $request->marriage_date,
            'time' => $request->time,
            'place' => $request->place,
            'wishes' => $request->wishes,
            'picture' => $pictureName,
            'status' => $request->status
        ]);

        return redirect()->route('anniversary.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Anniversary  $anniversary
     * @return \Illuminate\Http\Response
     */
    public function show(Anniversary $anniversary)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Anniversary  $anniversary
     * @return \Illuminate\Http\Response
     */
    public function edit(Anniversary $anniversary)
    {
        return view('forms.edit_anniversary',['anniversary' => $anniversary]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Anniversary  $anniversary
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Anniversary $anniversary)
    {
        $request->validate($this->rules);

        if ($mediaFile = $request->file('picture')) {
            globallyUpdateMedia($anniversary,$mediaFile,'/anniversary_pictures','picture');
        }

        $anniversary->update([
            'name' => $request->name,
            'marriagedate' => $request->marriage_date,
            'time' => $request->time,
            'place' => $request->place,
            'wishes' => $request->wishes,
            'status' => $request->status
        ]);

        return redirect()->route('anniversary.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Anniversary  $anniversary
     * @return \Illuminate\Http\Response
     */
    public function destroy(Anniversary $anniversary)
    {
        globallyDeleteMedia($anniversary,'/anniversary_pictures','picture');
        $anniversary->delete();
        return redirect()->route('anniversary.index');
    }
}
