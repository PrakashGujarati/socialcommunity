<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\Contact;

class ContactController extends Controller
{
    public $rules = [
        'name' => 'required',
        'designation' => 'required',
        'mobile' => 'required',
        'email' => 'required|email',
        'picture' => 'image|mimes:jpg,png,jpeg'
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        //
        $data = Contact::where('status','=','Active')->get();
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

        $pictureName = "";

        if ($validator->fails()) {
            return ['status' => "false",'msg' => $validator->messages()];
        }

        if ($mediaFile = $request->file('picture')) {
            $pictureName = globallyStoreMedia($mediaFile,"/contact_pictures");
        }

        $newContact = Contact::create([
            'name' => $request->name,
            'designation' => $request->designation,
            'mobile' => $request->mobile,
            'email' => $request->email,
            'picture' => $pictureName,
            'status' => 'Inactive'

        ]);
        return $this->responseOut($newContact);
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
        $data = Contact::where(['id' => $request->contact_id])->first();
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
        $contact = Contact::where(['id'=>$request->contact_id])->first();

        if (!empty($contact)) {

            $validator = Validator::make($request->all(), $this->rules);

        if ($validator->fails()) {
            return ['status' => "false",'msg' => $validator->messages()];
        }

        if ($mediaFile = $request->file('picture')) {
            globallyUpdateMedia($contact,$mediaFile,'/contact_pictures','picture');
        }

        $contact->update([
            'name' => $request->name,
            'designation' => $request->designation,
            'mobile' => $request->mobile,
            'email' => $request->email,
            'picture' => $pictureName


        ]);
        return $this->responseOut($contact);
        } else {
            return $this->responseOut($contact);
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
                'message' => 'No Contact Found !',
                'data' => []
            ]);
        }
    }
}
