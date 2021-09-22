<?php

namespace App\Http\Controllers;

use App\Models\News;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    public $rules = [
        'headline' => 'required',
        'title' => 'required',
        
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.news', ['newses' => News::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('forms.create_news');
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
        $data1=[];
        if($request->hasfile('news_image'))
        {
           foreach($request->file('news_image') as $image)
           {
               $name=$image->getClientOriginalName();
               $image->move(public_path().'/image/',$name);
               $data1[]=$name;  
           }
        }
        $thumbnailName=implode(",", $data);
        $news_image=implode(",", $data1);

        News::create([
            'headline' => $request->headline,
            'title' => $request->title,
            'category' => $request->category,
            'detail_report' => $request->detail_report,
            'thumbnail' => $thumbnailName,
            'news_image' => $news_image,
            'reported_datetime' => $request->reported_datetime,
            'reference' => $request->reference,
            'status' => $request->status,
            'done_by' => 1
        ]);
        return redirect()->route('news.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function show(News $news)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function edit(News $news)
    {
        return view('forms.edit_news', ['news' => $news]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, News $news)
    {
        $request->validate($this->rules);
        $imageUpdate=null;
        if ($files=$request->file('thumbnail')) {
            foreach($files as $file){
             Storage::delete('public/thumbnails/'.$news->thumbnail);
             $thumbnailName = time().$file->getClientOriginalName();
             $file->storeAs('thumbnails', $thumbnailName, 'public');
            //$news->update(['thumbnail' => $thumbnailName]);
            $imageUpdate.=$thumbnailName.",";
            }
        }
        if ($request->file('news_image')) {
            Storage::delete('public/news_images/'.$news->news_image);
            $news_image = time().$request->file('news_image')[0]->getClientOriginalName();
            $request->file('news_image')[0]->storeAs('news_images', $news_image, 'public');
            $news->update(['news_image' => $news_image]);
        }
        if($imageUpdate != null)
        {
            
            $news->update([
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
            $news->update([
                'headline' => $request->headline,
                'title' => $request->title,
                'category' => $request->category,
                'detail_report' => $request->detail_report,
                'reported_datetime' => $request->reported_datetime,
                'reference' => $request->reference,
                'status' => $request->status
            ]);
        }
            
        return redirect()->route('news.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function destroy(News $news)
    {
        Storage::delete('public/thumbnails/'.$news->thumbnail);
        Storage::delete('public/news_images/'.$news->news_image);
        $news->delete();
        return redirect()->route('news.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */


    public function changeStatus($id)
    {
        $news = News::where('id',$id)->first();
        $news->update([
            'status' => $news->status == "Active" ? "Deactive" : "Active"
        ]);
        return redirect()->route('news.index');
    }
}
