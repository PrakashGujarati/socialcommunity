<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Name;

class NameController extends Controller
{
    public function index()
    {
        return view('pages.name', ['nams' => Name::all()]);
    }
    public function create()
    {
        return view('forms.create_name');
    }
    public function store(request $request)
    {
        $user=new Name;
        $user->name=$request->first_name;
        $user->save();
        return redirect()->route('name.index');
    }
    public function edit($id)
    {
       $names=Name::where('id',$id)->first();
       return view('forms.edit_name',compact('names'));
    }
    public function update(request $request)
    {
         $user=Name::find($request->id);
         $user->name=$request->first_name;
         $user->save();
         return redirect()->route('name.index');
    }
    public function delete($id)
    {
        $names=Name::where('id',$id)->delete();
        return redirect()->route('name.index');
    }

}
