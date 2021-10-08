<?php

namespace App\Http\Controllers;

use App\Models\Birthday;
use Illuminate\Http\Request;

class BirthdayController extends Controller
{
    public $rules = [
        'name' => 'required',
        'birthdate' => 'required',
        'picture' => 'mimes:jpeg,jpg,png'
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.birthdays',['birthdays'=>Birthday::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('forms.create_birthday');
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
            $pictureName = globallyStoreMedia($mediaFile,"/birthday_pictures");
        }

        Birthday::create([
            'name' => $request->name,
            'birthdate' => $request->birthdate,
            'time' => $request->time,
            'place' => $request->place,
            'wishes' => $request->wishes,
            'picture' => $pictureName,
            'status' => $request->status
        ]);

        return redirect()->route('birthday.index');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Birthday  $birthday
     * @return \Illuminate\Http\Response
     */
    public function show(Birthday $birthday)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Birthday  $birthday
     * @return \Illuminate\Http\Response
     */
    public function edit(Birthday $birthday)
    {
        return view('forms.edit_birthday',['birthday' => $birthday]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Birthday  $birthday
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Birthday $birthday)
    {
        $request->validate($this->rules);

        if ($mediaFile = $request->file('picture')) {
            globallyUpdateMedia($birthday,$mediaFile,'/birthday_pictures','picture');
        }

        $birthday->update([
            'name' => $request->name,
            'birthdate' => $request->birthdate,
            'time' => $request->time,
            'place' => $request->place,
            'wishes' => $request->wishes,
            'status' => $request->status
        ]);

        return redirect()->route('birthday.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Birthday  $birthday
     * @return \Illuminate\Http\Response
     */
    public function destroy(Birthday $birthday)
    {
        globallyDeleteMedia($birthday,'/birthday_pictures','picture');
        $birthday->delete();
        return redirect()->route('birthday.index');
    }
}
