<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CandidateController extends Controller
{
    public $rules = [
        'first_name' => 'required',
        'contact' => 'required|numeric',
        'picture' => 'mimes:jpeg,jpg,png'
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.candidates', ['candidates' => Candidate::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('forms.create_candidate');
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
        $pictureName = '';
        if ($request->file('picture')) {
            $pictureName = time().$request->file('picture')->getClientOriginalName();
            $request->file('picture')->storeAs('candidate_pictures', $pictureName, 'public');
        }
        Candidate::create([
            'user_id' => 1,
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'birth_date' => $request->birth_date,
            'birth_time' => $request->birth_time,
            'birth_place' => $request->birth_place,
            'height' => $request->height,
            'weight' => $request->weight,
            'education' => $request->education,
            'occupation' => $request->occupation,
            'father_name' => $request->father_name,
            'mother_name' => $request->mother_name,
            'brothers' => $request->brothers,
            'sisters' => $request->sisters,
            'father_occupation' => $request->father_occupation,
            'mother_occupation' => $request->mother_occupation,
            'father_contact' => $request->father_contact,
            'contact' => $request->contact,
            'email' => $request->email,
            'resident_address' => $request->resident_address,
            'native_address' => $request->native_address,
            'maternal' => $request->maternal,
            'maternal_place' => $request->maternal_place,
            'hobbies' => $request->hobbies,
            'expectations' => $request->expectations,
            'remark' => $request->remark,
            'picture' => $pictureName,
            'status' => $request->status,
            'done_by' => 1
        ]);
        return redirect()->route('candidate.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Candidate  $candidate
     * @return \Illuminate\Http\Response
     */
    public function show(Candidate $candidate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Candidate  $candidate
     * @return \Illuminate\Http\Response
     */
    public function edit(Candidate $candidate)
    {
        return view('forms.edit_candidate', ['candidate' => $candidate]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Candidate  $candidate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Candidate $candidate)
    {
        $request->validate($this->rules);
        if ($request->file('picture')) {
            Storage::delete('public/candidate_pictures/'.$candidate->picture);
            $pictureName = time().$request->file('picture')->getClientOriginalName();
            $request->file('picture')->storeAs('candidate_pictures', $pictureName, 'public');
            $candidate->update(['picture' => $pictureName]);
        }
        $candidate->update([
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'birth_date' => $request->birth_date,
            'birth_time' => $request->birth_time,
            'birth_place' => $request->birth_place,
            'height' => $request->height,
            'weight' => $request->weight,
            'education' => $request->education,
            'occupation' => $request->occupation,
            'father_name' => $request->father_name,
            'mother_name' => $request->mother_name,
            'brothers' => $request->brothers,
            'sisters' => $request->sisters,
            'father_occupation' => $request->father_occupation,
            'mother_occupation' => $request->mother_occupation,
            'father_contact' => $request->father_contact,
            'contact' => $request->contact,
            'email' => $request->email,
            'resident_address' => $request->resident_address,
            'native_address' => $request->native_address,
            'maternal' => $request->maternal,
            'maternal_place' => $request->maternal_place,
            'hobbies' => $request->hobbies,
            'expectations' => $request->expectations,
            'remark' => $request->remark,
            'status' => $request->status
        ]);
        return redirect()->route('candidate.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Candidate  $candidate
     * @return \Illuminate\Http\Response
     */
    public function destroy(Candidate $candidate)
    {
        Storage::delete('public/candidate_pictures/'.$candidate->picture);
        $candidate->delete();
        return redirect()->route('candidate.index');
    }
}
