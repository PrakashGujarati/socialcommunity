<?php

namespace App\Http\Controllers;

use App\Models\Surname;
use Illuminate\Http\Request;

class SurnameController extends Controller
{
    public $rules = [
        'surname' => 'required'
    ];
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.surnames', ['surnames' => Surname::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('forms.create_surname');
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

        Surname::create(['surname' => $request->surname]);

        return redirect()->route('surname.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Surname  $surname
     * @return \Illuminate\Http\Response
     */
    public function show(Surname $surname)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Surname  $surname
     * @return \Illuminate\Http\Response
     */
    public function edit(Surname $surname)
    {
        return view('forms.edit_surname', ['surname' => $surname]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Surname  $surname
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Surname $surname)
    {
        $request->validate($this->rules);

        $surname->update([
            'surname' => $request->surname
        ]);

        return redirect()->route('surname.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Surname  $surname
     * @return \Illuminate\Http\Response
     */
    public function destroy(Surname $surname)
    {
        $surname->delete();
        return redirect()->route('surname.index');
    }
}
