<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
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
        return view('pages.event' , ['events' => Event::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('forms.create_event');
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
            $thumbnail = globallyStoreMedia($mediaFile,"/event_thumbnails",true);
        }

        if ($mediaFile = $request->file('news_image')) {
            $news_image = globallyStoreMedia($mediaFile,"/event_news_images",true);
        }

        Event::create([
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

        return redirect()->route('event.index');

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
        $event = Event::where('id',$id)->first();
        return view('forms.edit_event',compact('event'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Event $event)
    {

        $request->validate($this->rules);

        if ($mediaFile = $request->file('thumbnail')) {
            globallyUpdateMedia($event,$mediaFile,'/event_thumbnails','thumbnail',true);
        }

        if ($mediaFile = $request->file('news_image')) {
            globallyUpdateMedia($event,$mediaFile,'/event_news_images','news_image',true);
        }

        $event->update([
            'headline' => $request->headline,
            'title' => $request->title,
            'category' => $request->category,
            'detail_report' => $request->detail_report,
            'reported_datetime' => $request->reported_datetime,
            'reference' => $request->reference,
            'status' => $request->status
        ]);

        return redirect()->route('event.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        globallyDeleteMedia($event,'/event_thumbnails','thumbnail',true);
        globallyDeleteMedia($event,'/event_news_images','news_image',true);
        $event->delete();
        return redirect()->route('event.index');
    }
}
