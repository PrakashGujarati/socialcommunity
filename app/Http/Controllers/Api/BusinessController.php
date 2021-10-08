<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Business;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BusinessController extends Controller
{
    public $rules = [
        'first_name' => 'required',
        'company' => 'required',
        'contact' => 'required|numeric',
        'logo' => 'image|mimes:jpg,png,jpeg',
        'visitingcard' => 'image|mimes:jpg,png,jpeg'
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        $data = Business::where('status','=','Active')->get();
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

        $logo = "";

        $visitingcard = "";

        if ($mediaFile = $request->file('logo')) {
            $logo = globallyStoreMedia($mediaFile,"/business_logos",true);
        }

        if ($mediaFile = $request->file('visitingcard')) {
            $visitingcard = globallyStoreMedia($mediaFile,"/business_visitingcards",true);
        }

        $newBusiness = Business::create([
            'user_id' => Auth::user()->id,
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'company' => $request->company,
            'category' => $request->category,
            'description' => $request->description,
            'contact' => $request->contact,
            'email' => $request->email,
            'address' => $request->address,
            'logo' => $logo,
            'visitingcard' => $visitingcard,
            'status' => 'Inactive',
            'done_by' => Auth::user()->id,
        ]);

        return $this->responseOut($newBusiness);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $data = Business::where(['id' => $request->business_id])->first();
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
        $business = Business::where(['id'=>$request->business_id,'user_id'=>Auth::user()->id])->first();

        if (!empty($business)) {

            $validator = Validator::make($request->all(), $this->rules);

            if ($validator->fails()) {
                return ['status' => "false",'msg' => $validator->messages()];
            }

            if ($mediaFile = $request->file('logo')) {
                globallyUpdateMedia($business,$mediaFile,'/business_logos','logo',true);
            }

            if ($mediaFile = $request->file('visitingcard')) {
                globallyUpdateMedia($business,$mediaFile,'/business_visitingcards','visitingcard',true);
            }

            $business->update([
                'first_name' => $request->first_name,
                'middle_name' => $request->middle_name,
                'last_name' => $request->last_name,
                'company' => $request->company,
                'category' => $request->category,
                'description' => $request->description,
                'contact' => $request->contact,
                'email' => $request->email,
                'address' => $request->address,
            ]);

            return $this->responseOut($business);
        } else {
            return $this->responseOut($business);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
                'message' => 'No Business Found !',
                'data' => []
            ]);
        }
    }
}
