<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use Validator;
use Illuminate\Support\Facades\Auth;


class EventController extends Controller
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
        //
        $data = Event::where('status','=','Active')->get();
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
        //
        $validator = Validator::make($request->all(), $this->rules);

        if ($validator->fails()) {
            return ['status' => "false",'msg' => $validator->messages()];
        }

        $thumbnail = '';

        $news_image = '';

        if ($mediaFile = $request->file('thumbnail')) {
            $thumbnail = globallyStoreMedia($mediaFile,"/event_thumbnails",true);
        }

        if ($mediaFile = $request->file('news_image')) {
            $news_image = globallyStoreMedia($mediaFile,"/event_news_images",true);
        }

        $newEvents = Event::create([
            'headline' => $request->headline,
            'title' => $request->title,
            'category' => $request->category,
            'detail_report' => $request->detail_report,
            'thumbnail' => $thumbnail,
            'news_image' => $news_image,
            'reported_datetime' => $request->reported_datetime,
            'reference' => $request->reference,
            'status' => 'Inactive',
            'done_by' => Auth::user()->id
        ]);
        return $this->responseOut($newEvents);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        //
        $data = Event::where(['id'=>$request->event_id])->first();
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
        //
        $event = Event::where(['id'=>$request->event_id,'done_by'=>Auth::user()->id])->first();

        if (!empty($events)) {

            $validator = Validator::make($request->all(), $this->rules);

            if ($validator->fails()) {
                return ['status' => "false",'msg' => $validator->messages()];
            }

            if ($mediaFile = $request->file('thumbnail')) {
                globallyUpdateMedia($event,$mediaFile,'/event_thumbnails','thumbnail',true);
            }

            if ($mediaFile = $request->file('news_image')) {
                globallyUpdateMedia($event,$mediaFile,'/event_news_images','news_image',true);
            }

            $events->update([
                'headline' => $request->headline,
                'title' => $request->title,
                'category' => $request->category,
                'detail_report' => $request->detail_report,
                'reported_datetime' => $request->reported_datetime,
                'reference' => $request->reference,
            ]);

            return $this->responseOut($event);

        } else {

            return $this->responseOut($event);

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
                'code' => 404,
                'message' => 'No Event Found !',
                'data' => []
            ]);
        }
    }
}
