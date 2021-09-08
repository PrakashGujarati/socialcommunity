<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employment;
use Validator;
use Illuminate\Support\Facades\Auth;

class EmploymentController extends Controller
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
        $data = Employment::where('status','=','Active')->get();
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
       
        if ($request->hasFile('thumbnail')){
            $file = $request->file('thumbnail');
            $extension = $file->getClientOriginalExtension();
            $thumbnialName = time().'.'.$extension;
            $path = public_path().'/employment_thumbnail';
            $uplaod = $file->move($path,$thumbnialName);   
        }    

        if ($request->hasFile('news_image')){
        $file = $request->file('news_image');
           $extension = $file->getClientOriginalExtension();
           $news_image = time().'.'.$extension;
           $path = public_path().'/employment_newsImage';
           $uplaod = $file->move($path,$news_image);       
        }    

        $newEmployments = Employment::create([
            'headline' => $request->headline,
            'title' => $request->title,
            'category' => $request->category,
            'detail_report' => $request->detail_report,
            'thumbnail' => $thumbnialName,
            'news_image' => $news_image,
            'reported_datetime' => $request->reported_datetime,
            'reference' => $request->reference,
            'status' => 'Inactive',
            'done_by' => Auth::user()->id
        ]);
        return $this->responseOut($newEmployments);
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
        $data = Employment::where(['id'=>$request->employment_id])->first();
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
        $employments = Employment::where(['id'=>$request->employment_id,'done_by'=>Auth::user()->id])->first();
        if (!empty($employments)) {
            $validator = Validator::make($request->all(), $this->rules);
            if ($validator->fails()) {
                return ['status' => "false",'msg' => $validator->messages()];
            }
            if ($request->hasFile('thumbnail')){
                $file = $request->file('thumbnail');
                $extension = $file->getClientOriginalExtension();
                $thumbnialName = time().'.'.$extension;
                $path = public_path().'/employment_thumbnail';
                $uplaod = $file->move($path,$thumbnialName);
                $employments->update(['thumbnail' => $thumbnialName]);  

            }  
            if ($request->hasFile('news_image')){
                $file = $request->file('news_image');
                  $extension = $file->getClientOriginalExtension();
                  $news_image = time().'.'.$extension;
                  $path = public_path().'/employment_newsImage';
                  $uplaod = $file->move($path,$news_image);  
                  $employments->update(['news_image' => $news_image]);      
               }
            $employments->update([
                'headline' => $request->headline,
                'title' => $request->title,
                'category' => $request->category,
                'detail_report' => $request->detail_report,
                'reported_datetime' => $request->reported_datetime,
                'reference' => $request->reference,
            ]);
            return $this->responseOut($employments);
        } else {
            return $this->responseOut($employments);
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
                'message' => 'No Employment Found !',
                'data' => []
            ]);
        }
    }
}
