<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\Birthday;


class BirthdayController extends Controller
{
    public $rules = [
        'name' => 'required',
        'birthdate' => 'required',
        'picture' => 'mimes:jpeg,jpg,png',
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        //
        $data = Birthday::where('status','=','Active')->get();
        $data = appendDomainOnPath($data,'picture',true);
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

        $pictureName = "";

        if ($mediaFile = $request->file('picture')) {
            $pictureName = globallyStoreMedia($mediaFile,"/birthday_pictures");
        }

        $newBirthday = Birthday::create([
            'name' => $request->name,
            'birthdate' => $request->birthdate,
            'time' => $request->time,
            'place' => $request->place,
            'wishes' => $request->wishes,
            'picture' => $pictureName,
            'status' => 'Inactive'

        ]);

        return $this->responseOut($newBirthday);
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
        $data = Birthday::where(['id' => $request->birthday_id])->first();
        $data = appendDomainOnPath($data,'picture');
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
        $birthdays = Birthday::where(['id'=>$request->birthday_id])->first();
        if (!empty($birthdays)) {

            $validator = Validator::make($request->all(), $this->rules);

            if ($validator->fails()) {
                return ['status' => "false",'msg' => $validator->messages()];
            }

            if ($mediaFile = $request->file('picture')) {
                globallyUpdateMedia($birthday,$mediaFile,'/birthday_pictures','picture');
            }

            $birthdays->update([
                'name' => $request->name,
                'birthdate' => $request->birthdate,
                'time' => $request->time,
                'place' => $request->place,
                'wishes' => $request->wishes

            ]);
            return $this->responseOut($birthdays);
        } else {
            return $this->responseOut($birthdays);
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
                'message' => 'No Birthday Found !',
                'data' => []
            ]);
        }
    }
}
