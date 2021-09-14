<?php

namespace App\Http\Controllers;

use App\Models\Doner;
use Illuminate\Http\Request;

class DonerController extends Controller
{
    public $rules = [
        'title' => 'required',
        'description' => 'required',
        'type' => 'required'
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.doners',['doners' => Doner::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('forms.create_doner');
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
        Doner::create([
            'title' => $request->title,
            'description' => $request->description,
            'type' => $request->type,
            'status' => $request->status
        ]);
        return redirect()->route('doner.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Doner  $doner
     * @return \Illuminate\Http\Response
     */
    public function show(Doner $doner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Doner  $doner
     * @return \Illuminate\Http\Response
     */
    public function edit(Doner $doner)
    {
        return view('forms.edit_doner',['doner' => $doner]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Doner  $doner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Doner $doner)
    {
        $request->validate($this->rules);
        $doner->update([
            'title' => $request->title,
            'description' => $request->description,
            'type' => $request->type,
            'status' => $request->status
        ]);
        return redirect()->route('doner.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Doner  $doner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Doner $doner)
    {
        $doner->delete();
        return redirect()->route('doner.index');
    }
}
