<?php

namespace App\Http\Controllers;

use App\Models\Business;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BusinessController extends Controller
{
    public $rules = [
        'first_name' => 'required',
        'company' => 'required',
        'contact' => 'required|numeric',
        'logo.*' => 'mimes:jpg,png,jpeg',
        'visitingcard.*' => 'mimes:jpg,png,jpeg'
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.businesses', ['businesses' => Business::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('forms.create_business');
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

        $logo = "";

        $visitingcard = "";

        if ($mediaFile = $request->file('logo')) {
            $logo = globallyStoreMedia($mediaFile,"/business_logos",true);
        }

        if ($mediaFile = $request->file('visitingcard')) {
            $visitingcard = globallyStoreMedia($mediaFile,"/business_visitingcards",true);
        }

        Business::create([
            'user_id' => 1,
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'company' => $request->company,
            'category' => $request->category,
            'description' => $request->description,
            'contact' => $request->contact,
            'email' => $request->email,
            'address' => $request->address,
            'logo' => $logo,
            'visitingcard' => $visitingcard,
            'status' => $request->status,
            'done_by' => 1
        ]);

        return redirect()->route('business.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Business  $business
     * @return \Illuminate\Http\Response
     */
    public function show(Business $business)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Business  $business
     * @return \Illuminate\Http\Response
     */
    public function edit(Business $business)
    {
        return view('forms.edit_business', ['business' => $business]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Business  $business
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Business $business)
    {
        $request->validate($this->rules);

        if ($mediaFile = $request->file('logo')) {
            globallyUpdateMedia($business,$mediaFile,'/business_logos','logo',true);
        }

        if ($mediaFile = $request->file('visitingcard')) {
            globallyUpdateMedia($business,$mediaFile,'/business_visitingcards','visitingcard',true);
        }

        $business->update([
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'company' => $request->company,
            'category' => $request->category,
            'description' => $request->description,
            'contact' => $request->contact,
            'email' => $request->email,
            'address' => $request->address,
            'status' => $request->status
        ]);

        return redirect()->route('business.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Business  $business
     * @return \Illuminate\Http\Response
     */
    public function destroy(Business $business)
    {
        globallyDeleteMedia($business,'/business_logos','logo',true);
        globallyDeleteMedia($business,'/business_visitingcards','visitingcard',true);
        $business->delete();
        return redirect()->route('business.index');
    }
}
