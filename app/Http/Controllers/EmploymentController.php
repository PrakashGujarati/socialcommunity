<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employment;
use Illuminate\Support\Facades\Storage;

class EmploymentController extends Controller
{
    public $rules = [
        'headline' => 'required',
        'title' => 'required',
        'thumbnail.*' => 'mimes:jpeg,jpg,png',
        'news_image.*' => 'mimes:jpeg,jpg,png'
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.employment' , ['employments' => Employment::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('forms.create_employment');
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

        $news_image = "";

        $thumbnail = "";

        if ($mediaFile = $request->file('thumbnail')) {
            $thumbnail = globallyStoreMedia($mediaFile,"/employment_thumbnails",true);
        }

        if($mediaFile = $request->file('news_image')){
            $news_image = globallyStoreMedia($mediaFile,"/employment_images",true);
        }

        Employment::create([
            'headline' => $request->headline,
            'title' => $request->title,
            'category' => $request->category,
            'detail_report' => $request->detail_report,
            'thumbnail' => $thumbnail,
            'news_image' => $news_image,
            'reported_datetime' => $request->reported_datetime,
            'reference' => $request->reference,
            'status' => $request->status,
            'done_by' => 1
        ]);

        return redirect()->route('employment.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Employment $employment)
    {
        return view('forms.edit_employment',['employment' => $employment]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Employment $employment)
    {

        $request->validate($this->rules);

        if ($mediaFile = $request->file('thumbnail')) {
            globallyUpdateMedia($employment,$mediaFile,'/employment_thumbnails','thumbnail',true);
        }

        if ($mediaFile = $request->file('news_image')) {
            globallyUpdateMedia($employment,$mediaFile,'/employment_images','news_image',true);
        }

        $employment->update([
            'headline' => $request->headline,
            'title' => $request->title,
            'category' => $request->category,
            'detail_report' => $request->detail_report,
            'reported_datetime' => $request->reported_datetime,
            'reference' => $request->reference,
            'status' => $request->status
        ]);

        return redirect()->route('employment.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employment $employment)
    {
        globallyDeleteMedia($employment,'/employment_thumbnails','thumbnail',true);
        globallyDeleteMedia($employment,'/employment_images','news_image',true);

        $employment->delete();
        return redirect()->route('employment.index');
    }
}
