<?php

namespace App\Http\Controllers;

use App\Models\Late;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LateController extends Controller
{
    public $rules = [
        'first_name' => 'required',
        'late_date' => 'required',
        'picture' => 'mimes:jpeg,jpg,png',
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.lates', ['lates' => Late::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('forms.create_late');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pictureName = '';
        $request->validate($this->rules);
        if ($request->file('picture')) {
            $pictureName = time().$request->file('picture')->getClientOriginalName();
            $request->file('picture')->storeAs('late_pictures', $pictureName, 'public');
        }
        Late::create([
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'late_date' => $request->late_date,
            'birth_date' => $request->birth_date,
            'gujarati_savant' => $request->gujarati_savant,
            'address' => $request->address,
            'shradhhanjali' => $request->shradhhanjali,
            'notifications' => $request->notifications,
            'contact' => $request->contact,
            'picture' => $pictureName,
            'status' => $request->status,
            'done_by' => 1
        ]);
        return redirect()->route('late.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Late  $late
     * @return \Illuminate\Http\Response
     */
    public function show(Late $late)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Late  $late
     * @return \Illuminate\Http\Response
     */
    public function edit(Late $late)
    {
        return view('forms.edit_late', ['late' => $late]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Late  $late
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Late $late)
    {
        $request->validate($this->rules);
        if ($request->file('picture')) {
            Storage::delete('public/late_pictures/'.$late->picture);
            $pictureName = time().$request->file('picture')->getClientOriginalName();
            $request->file('picture')->storeAs('late_pictures', $pictureName, 'public');
            $late->update(['picture' => $pictureName]);
        }
        $late->update([
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'late_date' => $request->late_date,
            'birth_date' => $request->birth_date,
            'gujarati_savant' => $request->gujarati_savant,
            'address' => $request->address,
            'shradhhanjali' => $request->shradhhanjali,
            'notifications' => $request->notifications,
            'contact' => $request->contact,
            'status' => $request->status,
        ]);
        return redirect()->route('late.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Late  $late
     * @return \Illuminate\Http\Response
     */
    public function destroy(Late $late)
    {
        Storage::delete('public/late_pictures/'.$late->picture);
        $late->delete();
        return redirect()->route('late.index');
    }
}
