<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\News;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
    public function list()
    {
        $data = News::where('status','=','Active')->get();
        $data = appendDomainOnPath($data,'thumbnail',true,true);
        $data = appendDomainOnPath($data,'news_image',true,true);
        return $this->responseOut($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), $this->rules);

        if ($validator->fails()) {
            return ['status' => "false",'msg' => $validator->messages()];
        }

        $thumbnailName = "";
        $imageName = "";

        if ($mediaFile = $request->file('thumbnail')) {
            $thumbnailName = globallyStoreMedia($mediaFile,"/news_thumbnails");
        }

        if($mediaFile = $request->file('news_image')){
            $imageName = globallyStoreMedia($mediaFile,"/news_images");
        }

        $newNews = News::create([
            'headline' => $request->headline,
            'title' => $request->title,
            'category' => $request->category,
            'detail_report' => $request->detail_report,
            'thumbnail' => $thumbnailName,
            'news_image' => $imageName,
            'reported_datetime' => $request->reported_datetime,
            'reference' => $request->reference,
            'status' => 'Inactive',
            'done_by' => Auth::user()->id
        ]);
        return $this->responseOut($newNews);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $data = News::where(['id'=>$request->news_id])->first();
        $data = appendDomainOnPath($data,'thumbnail',false,true);
        $data = appendDomainOnPath($data,'news_image',false,true);
        return $this->responseOut($data);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $news = News::where(['id'=>$request->news_id,'done_by'=>Auth::user()->id])->first();

        if (!empty($news)) {

            $validator = Validator::make($request->all(), $this->rules);

            if ($validator->fails()) {
                return ['status' => "false",'msg' => $validator->messages()];
            }

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
            ]);

            return $this->responseOut($news);

        } else {
            return $this->responseOut($news);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function responseOut($data)
    {
        if (!empty($data)) {
            return response()->json([
                'code' => 200,
                'message' => 'success',
                'data' => $data
            ]);
        } else {
            return response()->json([
                'code' => 400,
                'message' => 'No News Found !',
                'data' => []
            ]);
        }
    }
}
