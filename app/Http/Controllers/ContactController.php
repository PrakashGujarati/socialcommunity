<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public $rules = [
        'name' => 'required',
        'designation' => 'required',
        'mobile' => 'required',
        'email' => 'required|email',
        'picture' => 'image|mimes:jpg,png,jpeg'
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.contact',['contacts' => Contact::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('forms.create_contact');
    
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

        if ($mediaFile = $request->file('picture')) {
            $pictureName = globallyStoreMedia($mediaFile,"/contact_pictures");
        }

        Contact::create([
            'name' => $request->name,
            'designation' => $request->designation,
            'mobile' => $request->mobile,
            'email' => $request->email,
            'picture' => $pictureName,
            'status' => $request->status
        ]);
        return redirect()->route('contact.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $contact)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function edit(Contact $contact)
    {
        return view('forms.edit_contact',['contact' => $contact]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contact $contact)
    {

        $request->validate($this->rules);

        if ($mediaFile = $request->file('picture')) {
            globallyUpdateMedia($contact,$mediaFile,'/contact_pictures','picture');
        }

        Contact::where('id',$request->id)->update([
            'name' => $request->name,
            'designation' => $request->designation,
            'mobile' => $request->mobile,
            'email' => $request->email,
            'status' => $request->status
        ]);
        return redirect()->route('contact.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact)
    {
        globallyDeleteMedia($contact,'/contact_pictures','picture');
        $contact->delete();
        return redirect()->route('contact.index');
    }
}
