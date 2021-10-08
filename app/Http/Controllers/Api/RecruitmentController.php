<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Recruitment;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class RecruitmentController extends Controller
{
    public $rules = [
        'headline' => 'required',
        'title' => 'required',
        'skills' => 'required',
        'thumbnail' => 'mimes:jpeg,jpg,png'
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        $data = Recruitment::where('status','=','Active')->get();
        $data = appendDomainOnPath($data,'thumbnail',true);
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

        $thumbnailName = "";

        if ($validator->fails()) {
            return ['status' => "false",'msg' => $validator->messages()];
        }

        if ($mediaFile = $request->file('thumbnail')) {
            $thumbnailName = globallyStoreMedia($mediaFile,"/recruitment_thumbnails");
        }

        $newRecruitment = Recruitment::create([
            'headline' => $request->headline,
            'title' => $request->title,
            'category' => $request->category,
            'description' => $request->description,
            'skills' => $request->skills,
            'education_quailification' => $request->education_quailification,
            'thumbnail' => $thumbnailName,
            'reference_url' => $request->reference_url,
            'reported_datetime' => $request->reported_datetime,
            'status' => 'Inactive',
            'done_by' => Auth::user()->id
        ]);

        return $this->responseOut($newRecruitment);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $data = Recruitment::where(['id' => $request->recruitment_id])->first();
        $data = appendDomainOnPath($data,'thumbnail');
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
        $recruitment = Recruitment::where(['id'=>$request->recruitment_id,'done_by'=>Auth::user()->id])->first();

        if (!empty($recruitment)) {
            $validator = Validator::make($request->all(), $this->rules);

            if ($validator->fails()) {
                return ['status' => "false",'msg' => $validator->messages()];
            }

            if ($mediaFile = $request->file('thumbnail')) {
                globallyUpdateMedia($recruitment,$mediaFile,'/recruitment_thumbnails','thumbnail');
            }

            $recruitment->update([
                'headline' => $request->headline,
                'title' => $request->title,
                'category' => $request->category,
                'description' => $request->description,
                'skills' => $request->skills,
                'education_quailification' => $request->education_quailification,
                'reference_url' => $request->reference_url,
                'reported_datetime' => $request->reported_datetime,
            ]);

            return $this->responseOut($recruitment);

        } else {
            return $this->responseOut($recruitment);
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
                'message' => 'No Recruitment Found !',
                'data' => []
            ]);
        }
    }
}
