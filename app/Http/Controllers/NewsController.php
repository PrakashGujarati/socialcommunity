<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    public $rules = [
        'headline' => 'required',
        'title' => 'required',
        'thumbnail' => 'mimes:jpeg,jpg,png',
        'news_image' => 'mimes:jpeg,jpg,png'
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

        $thumbnailName = "";
        $imageName = "";

        if ($mediaFile = $request->file('thumbnail')) {
            $thumbnailName = globallyStoreMedia($mediaFile,"/news_thumbnails");
        }

        if($mediaFile = $request->file('news_image')){            
            $imageName = globallyStoreMedia($file,"/news_images");          
        }

        News::create([
            'headline' => $request->headline,
            'title' => $request->title,
            'category' => $request->category,
            'detail_report' => $request->detail_report,
            'thumbnail' => $thumbnailName,
            'news_image' => $imageName,
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

        if ($mediaFile = $request->file('thumbnail')) {
            globallyUpdateMedia($news,$mediaFile,'/news_thumbnails','thumbnail');
        }

        if ($mediaFile = $request->file('news_image')) {
            globallyUpdateMedia($news,$mediaFile,'/news_images','news_image');
        }
        
        $news->update([
            'headline' => $request->headline,
            'title' => $request->title,
            'category' => $request->category,
            'detail_report' => $request->detail_report,
            'reported_datetime' => $request->reported_datetime,
            'reference' => $request->reference,
            'status' => $request->status
        ]);
          
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
        globallyDeleteMedia($news,'/news_thumbnails','thumbnail');
        globallyDeleteMedia($news,'/news_images','news_image');

        $news->delete();
        return redirect()->route('news.index');
    }
}
