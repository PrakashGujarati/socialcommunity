<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\Megazine;


class MegazineController extends Controller
{
    public $rules = [
        'title' => 'required',
        'category' => 'required'
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        //
        $data = Megazine::where('status','=','Active')->get();                
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
        
        if ($files = $request->file('path')) {
            $destinationPath = 'file/'; 
            $profilefile = time().".". $files->getClientOriginalExtension();
      
                if ($files->getClientMimeType() !== 'application/pdf')
                {   
                    return ['status' => "false",'msg' => 'The path must be a file of type: pdf'];
                }
               
                if($files->getSize() > 3145728 ){

                    return ['status' => "false",'msg' => 'The pdf must be a file of size less than 10 mb'];
                }
            $files->move($destinationPath, $profilefile);
                
            $insert['file'] = "$profilefile";
                
            }

        $magazines = Megazine::create([
            'title' =>$request->title,
            'category' => $request->category,
            'date' => $request->date,
            'path' => $profilefile,
            'status' => 'Inactive'            
        ]);
        return $this->responseOut($magazines);
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
        $data = Megazine::where(['id' => $request->megazine_id])->first();
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
    public function update(Request $request, $id)
    {
        //
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
                'message' => 'No Magazine Found !',
                'data' => []
            ]);
        }
    }
}
