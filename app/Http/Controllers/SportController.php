<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sport;
use Illuminate\Support\Facades\Storage;

class SportController extends Controller
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
        return view('pages.sport' , ['sports' => Sport::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('forms.create_sport');
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

        $thumbnail = '';

        $news_image = '';

        if ($mediaFile = $request->file('thumbnail')) {
            $thumbnail = globallyStoreMedia($mediaFile,"/sport_thumbnails",true);
        }

        if ($mediaFile = $request->file('news_image')) {
            $news_image = globallyStoreMedia($mediaFile,"/sport_news_images",true);
        }

        sport::create([
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

        return redirect()->route('sport.index');

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
    public function edit($id)
    {
        $sport = Sport::where('id',$id)->first();
        return view('forms.edit_sport',compact('sport'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Sport $sport)
    {
        $request->validate($this->rules);

        if ($mediaFile = $request->file('thumbnail')) {
            globallyUpdateMedia($sport,$mediaFile,'/sport_thumbnails','thumbnail',true);
        }

        if ($mediaFile = $request->file('news_image')) {
            globallyUpdateMedia($sport,$mediaFile,'/sport_news_images','news_image',true);
        }

        $sport->update([
            'headline' => $request->headline,
            'title' => $request->title,
            'category' => $request->category,
            'detail_report' => $request->detail_report,
            'reported_datetime' => $request->reported_datetime,
            'reference' => $request->reference,
            'status' => $request->status
        ]);

        return redirect()->route('sport.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sport $sport)
    {
        globallyDeleteMedia($sport,'/sport_thumbnails','thumbnail',true);
        globallyDeleteMedia($sport,'/sport_news_images','news_image',true);
        $sport->delete();
        return redirect()->route('sport.index');
    }
}
