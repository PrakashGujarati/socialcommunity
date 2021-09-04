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

        $thumbnailName = '';
        $news_image = '';
        if ($request->file('thumbnail')) {
            $thumbnailName = time().$request->file('thumbnail')->getClientOriginalName();
            $request->file('thumbnail')->storeAs('thumbnails', $thumbnailName, 'public');
        }
        if ($request->file('news_image')) {
            $news_image = time().$request->file('news_image')->getClientOriginalName();
            $request->file('news_image')->storeAs('news_images', $news_image, 'public');
        }

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
        if ($request->file('thumbnail')) {
            Storage::delete('public/thumbnails/'.$news->thumbnail);
            $thumbnailName = time().$request->file('thumbnail')->getClientOriginalName();
            $request->file('thumbnail')->storeAs('thumbnails', $thumbnailName, 'public');
            $news->update(['thumbnail' => $thumbnailName]);
        }
        if ($request->file('news_image')) {
            Storage::delete('public/news_images/'.$news->news_image);
            $news_image = time().$request->file('news_image')->getClientOriginalName();
            $request->file('news_image')->storeAs('news_images', $news_image, 'public');
            $news->update(['news_image' => $news_image]);
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
        Storage::delete('public/thumbnails/'.$news->thumbnail);
        Storage::delete('public/news_images/'.$news->news_image);
        $news->delete();
        return redirect()->route('news.index');
    }
}
