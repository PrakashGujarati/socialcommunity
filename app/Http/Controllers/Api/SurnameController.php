<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\Surname;

class SurnameController extends Controller
{
    public $rules = [
        'name' => 'required'
       
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        //
        $data = Surname::all();
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
       
        
        $newSurname = Surname::create([
            'name' => $request->name
        ]);
        return $this->responseOut($newSurname);
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
        $surname = Surname::where(['id'=>$request->surname_id])->first();

        if (!empty($surname)) {
            $validator = Validator::make($request->all(), $this->rules);

        if ($validator->fails()) {
            return ['status' => "false",'msg' => $validator->messages()];
        }   
        
        $surname->update([
            'name' => $request->name
        ]);
        return $this->responseOut($surname);
        } else {
            return $this->responseOut($surname);
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
                'message' => 'No Surname Found !',
                'data' => []
            ]);
        }
    }
}
