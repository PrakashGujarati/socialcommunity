<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\Storage;

class ContactController extends Controller
{
    public function index()
    {
        return view('pages.contact',['contacts' => Contact::all()]);
    }
    public function create()
    {
        return view('forms.create_contact');
    }
    public function store(request $request)
    {
        $picture = '';
        if ($request->file('picture')) {
            $picture = time().$request->file('picture')->getClientOriginalName();
            $request->file('picture')->storeAs('contacts', $picture, 'public');
        }
        Contact::create([
            'name' => $request->name,
            'designation' => $request->designation,
            'mobile' => $request->mobile,
            'email' => $request->email,
            'picture' => $picture,
            'status' => $request->status
        ]);
        return redirect()->route('contact.index');
    }
    public function edit($id)
    {
       $contact=Contact::where('id',$id)->first();
       return view('forms.edit_contact',compact('contact'));
    }
    public function update(request $request)
    {
        $contact = Contact::where('id',$request->id)->first();
        if ($request->file('picture')) {
            Storage::delete('public/contacts/'.$contact->path);
            $logo = time().$request->file('picture')->getClientOriginalName();
            $request->file('picture')->storeAs('contacts', $logo, 'public');
            $contact->update(['picture' => $logo]);
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
    public function delete($id)
    {
        $contact=Contact::where('id',$id)->delete();
        return redirect()->route('contact.index');
    }
}
