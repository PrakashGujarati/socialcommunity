<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\Education;

class EducationController extends Controller
{
    public $rules = [
        'name' => 'required',
        'qualification' => 'required',
        'note' => 'required',
        'gender' => 'required',
        'picture' => 'mimes:jpeg,jpg,png'
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        //
        $data = Education::where('status','=','Active')->get();
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

        $pictureName = "" ;

        if ($mediaFile = $request->file('picture')) {
            $pictureName = globallyStoreMedia($mediaFile,"/education_pictures");
        }
        
        $newEducation = Education::create([
            'name' => $request->name,
            'qualification' => $request->qualification,            
            'picture' => $pictureName,
            'note' => $request->note,
            'gender' => $request->gender,
            'status' => 'Inactive'
            
        ]);

        return $this->responseOut($newEducation);
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
        $data = Education::where(['id' => $request->education_id])->first();
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
        $education = Education::where(['id'=>$request->education_id])->first();

        if (!empty($education)) {

            $validator = Validator::make($request->all(), $this->rules);

            if ($validator->fails()) {
                return ['status' => "false",'msg' => $validator->messages()];
            }

            if ($mediaFile = $request->file('picture')) {
                globallyUpdateMedia($education,$mediaFile,'/education_pictures','picture');
            }  
           
            $education->update([
                'name' => $request->name,
                'qualification' => $request->qualification,            
                'picture' => $pictureName,
                'note' => $request->note,
                'gender' => $request->gender
            ]);

            return $this->responseOut($education);

        } else {
            return $this->responseOut($education);
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
                'message' => 'No Education Found !',
                'data' => []
            ]);
        }
    }
}
