<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sport;
use Illuminate\Support\Facades\Storage;

class SportController extends Controller
{
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
        $sport=Sport::where('id',$id)->first();
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
        $imageUpdate=null;
        if ($files=$request->file('thumbnail')) {
            foreach($files as $file){
             Storage::delete('public/thumbnails/'.$sport->thumbnail);
             $thumbnailName = time().$file->getClientOriginalName();
             $file->storeAs('thumbnails', $thumbnailName, 'public');
            //$news->update(['thumbnail' => $thumbnailName]);
            $imageUpdate.=$thumbnailName.",";
            }
        }
        if ($request->file('news_image')) {
            Storage::delete('public/news_images/'.$sport->news_image);
            $news_image = time().$request->file('news_image')->getClientOriginalName();
            $request->file('news_image')->storeAs('news_images', $news_image, 'public');
            $sport->update(['news_image' => $news_image]);
        }
        if($imageUpdate != null)
        {
            
            $sport->update([
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
            $sport->update([
                'headline' => $request->headline,
                'title' => $request->title,
                'category' => $request->category,
                'detail_report' => $request->detail_report,
                'reported_datetime' => $request->reported_datetime,
                'reference' => $request->reference,
                'status' => $request->status
            ]);
        }
            
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
        $sport->delete();
        return redirect()->route('sport.index');
    }
}
