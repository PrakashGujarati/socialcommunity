<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Megazine;
use Illuminate\Support\Facades\Storage;

class MegazineController extends Controller
{
    public function index()
    {
        return view('pages.megazine',['megazines' => Megazine::all()]);
    }
    public function create()
    {
        return view('forms.create_megazine');
    }
    public function store(request $request)
    {
        $megazine = '';
        if ($request->file('megazine')) {
            $megazine = time().$request->file('megazine')->getClientOriginalName();
            $request->file('megazine')->storeAs('megazines', $megazine, 'public');
        }
        Megazine::create([
            'title' => $request->title,
            'category' => $request->category,
            'date' => $request->date,
            'path' => $megazine,
            'status' => $request->status
        ]);
        return redirect()->route('megazine.index');
    }
    public function edit($id)
    {
       $megazine=Megazine::where('id',$id)->first();
       return view('forms.edit_megazine',compact('megazine'));
    }
    public function update(request $request)
    {
        $megazine = Megazine::where('id',$request->id)->first();
        if ($request->file('megazine')) {
            Storage::delete('public/megazines/'.$megazine->path);
            $logo = time().$request->file('megazine')->getClientOriginalName();
            $request->file('megazine')->storeAs('megazines', $logo, 'public');
            $megazine->update(['path' => $logo]);
        }
        Megazine::where('id',$request->id)->update([
            'title' => $request->title,
            'category' => $request->category,
            'date' => $request->date,
            'status' => $request->status
        ]);
        return redirect()->route('megazine.index');
    }
    public function delete($id)
    {
        $megazine=Megazine::where('id',$id)->delete();
        return redirect()->route('megazine.index');
    }
}
