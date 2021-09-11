<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\Anniversary;
class AnniversaryController extends Controller
{
    public $rules = [
        'name' => 'required',
        'marriagedate' => 'required',
        'time' => 'required',
        'place' => 'required',
        'wishes' => 'required'
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        //
        $data = Anniversary::where('status','=','Active')->get();
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
        
        $newAnniversary = Anniversary::create([           
            'name' => $request->name,
            'marriagedate' => $request->marriagedate,
            'time' => $request->time,
            'place' => $request->place,
            'wishes' => $request->wishes,
            'status' => 'Inactive'
            
        ]);
        return $this->responseOut($newAnniversary);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show( Request $request)
    {
        //
        $data = Anniversary::where(['id' => $request->anniversary_id])->first();
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
        $anniversarys = Anniversary::where(['id'=>$request->anniversary_id])->first();
        if (!empty($anniversarys)) {
            $validator = Validator::make($request->all(), $this->rules);
            if ($validator->fails()) {
                return ['status' => "false",'msg' => $validator->messages()];
            }
           
            $anniversarys->update([                      
                    'name' => $request->name,
                    'marriagedate' => $request->marriagedate,
                    'time' => $request->time,
                    'place' => $request->place,
                    'wishes' => $request->wishes
            
            ]);
            return $this->responseOut($anniversarys);
        } else {
            return $this->responseOut($anniversarys);
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
                'message' => 'No Anniversary Found !',
                'data' => []
            ]);
        }
    }
}
