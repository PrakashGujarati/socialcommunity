<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Late;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class LateController extends Controller
{
    public $rules = [
        'first_name' => 'required',
        'late_date' => 'required',
        'picture' => 'mimes:jpeg,jpg,png',
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        $data = Late::where('status','=','Active')->get();
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
    
        if ($mediaFile = $request->file('picture')) {
            $mediaPath = public_path()."/late_pictures";
            $pictureName = time().".".$mediaFile->getClientOriginalExtension();
            $mediaFile->move($mediaPath,$pictureName);
        }

        $newLate = Late::create([
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'late_date' => $request->late_date,
            'birth_date' => $request->birth_date,
            'gujarati_savant' => $request->gujarati_savant,
            'address' => $request->address,
            'shradhhanjali' => $request->shradhhanjali,
            'notifications' => $request->notifications,
            'contact' => $request->contact,
            'picture' => $pictureName,
            'status' => 'Inactive',
            'done_by' => Auth::user()->id
        ]);

        return $this->responseOut($newLate);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $data = Late::where(['id'=>$request->late_id])->first();
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
        $late = Late::where(['id'=>$request->late_id,'done_by'=>Auth::user()->id])->first();

        if (!empty($late)) {
            $validator = Validator::make($request->all(), $this->rules);
            if ($validator->fails()) {
                return ['status' => "false",'msg' => $validator->messages()];
            }

            if ($mediaFile = $request->file('picture')) {
                $mediaPath = public_path()."/late_pictures";
                ($late->picture && file_exists($mediaPath."/".$late->picture)) ? unlink($mediaPath."/".$late->picture) : "";
                $pictureName = time().".".$mediaFile->getClientOriginalExtension();
                $mediaFile->move($mediaPath,$pictureName);
                $late->update(['picture' => $pictureName]);
            }

            $late->update([
                'first_name' => $request->first_name,
                'middle_name' => $request->middle_name,
                'last_name' => $request->last_name,
                'late_date' => $request->late_date,
                'birth_date' => $request->birth_date,
                'gujarati_savant' => $request->gujarati_savant,
                'address' => $request->address,
                'shradhhanjali' => $request->shradhhanjali,
                'notifications' => $request->notifications,
                'contact' => $request->contact,
            ]);

            return $this->responseOut($late);

        } else {

            return $this->responseOut($late);

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
                'message' => 'No Late Found !',
                'data' => []
            ]);
        }
    }
}
