<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
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
        $news_image = '';
        $data=[];
        if($request->hasfile('thumbnail'))
        {
             foreach($request->file('thumbnail') as $image)
             {
                 $name=$image->getClientOriginalName();
                 $image->move(public_path().'/image/',$name);
                $data[]=$name;  
             }
         }
         if ($request->file('news_image')) {
            $news_image = time().$request->file('news_image')->getClientOriginalName();
            $request->file('news_image')->storeAs('news_images', $news_image, 'public');
        }
        $thumbnail=implode(",", $data);

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
        $event=Event::where('id',$id)->first();
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
        $imageUpdate=null;
        if ($files=$request->file('thumbnail')) {
            foreach($files as $file){
             Storage::delete('public/thumbnails/'.$event->thumbnail);
             $thumbnailName = time().$file->getClientOriginalName();
             $file->storeAs('thumbnails', $thumbnailName, 'public');
            //$news->update(['thumbnail' => $thumbnailName]);
            $imageUpdate.=$thumbnailName.",";
            }
        }
        if ($request->file('news_image')) {
            Storage::delete('public/news_images/'.$event->news_image);
            $news_image = time().$request->file('news_image')->getClientOriginalName();
            $request->file('news_image')->storeAs('news_images', $news_image, 'public');
            $event->update(['news_image' => $news_image]);
        }
        if($imageUpdate != null)
        {
            
            $event->update([
                'headline' => $request->headline,
                'title' => $request->title,
                'category' => $request->category,
                'detail_report' => $request->detail_report,
                'reported_datetime' => $request->reported_datetime,
                'reference' => $request->reference,
                'status' => $request->status,
                'thumbnail'=>$imageUpdate
            ]);
        }
        else
        {
            $event->update([
                'headline' => $request->headline,
                'title' => $request->title,
                'category' => $request->category,
                'detail_report' => $request->detail_report,
                'reported_datetime' => $request->reported_datetime,
                'reference' => $request->reference,
                'status' => $request->status
            ]);
        }
            
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
        $event->delete();
        return redirect()->route('event.index');
    }
}
