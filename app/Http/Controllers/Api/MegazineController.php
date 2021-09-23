<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\Megazine;
use Spatie\PdfToImage\Pdf;
use Illuminate\Filesystem\Filesystem as File;

use Image;


class MegazineController extends Controller
{
    public $rules = [
        'title' => 'required',
        'category' => 'required',
        'megazine' => 'mimes:pdf'
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

        $megazineName = "";
        $imagesData = "";

        if ($request->file('path')){
            $megazineName = $request->file('path')->getClientOriginalName();
            $imagesData = $this->storeMedia($request->file('path'),$request->category,$request->title);
        }

        $magazines = Megazine::create([
            'title' =>$request->title,
            'category' => $request->category,
            'date' => $request->date,
            'path' => $megazineName,
            'resized_images' => $imagesData,
            'status' => 'Inactive'            
        ]);
        $magazines->resized_images = json_decode($magazines->resized_images,true);
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
        $data->resized_images = json_decode($data->resized_images,true);
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

    public function storeMedia($mediaFile,$category,$title)
    {
        $mediaPath = public_path()."/megazines/".$category."/".$title;
        
        $megazineNameWithExtension = $mediaFile->getClientOriginalName();
        $megazineNameWithoutExtension = pathinfo($mediaFile->getClientOriginalName(),PATHINFO_FILENAME);
        $mediaFile->move($mediaPath,$megazineNameWithExtension);
        $megazinePdfPath = $mediaPath."/".$megazineNameWithExtension;

        if(!file_exists($mediaPath."/images")){
            mkdir($mediaPath."/images", 0777, true);
        }

        $originalImagesPath = $mediaPath."/images";
        $pdf = new Pdf($megazinePdfPath);

        $pdf->setOutputFormat('jpeg')->saveImage($originalImagesPath."/".$megazineNameWithoutExtension."(%d)");   

        if(!file_exists($mediaPath."/resized")){
            mkdir($mediaPath."/resized", 0777, true);
        }

        $resizedImagesPath = $mediaPath."/resized";

        $originalImages = array_diff(scandir($originalImagesPath), array('..', '.'));
        $imagesData = [];
        foreach ($originalImages as $key => $image) {
            $imgFile = Image::make($originalImagesPath."/".$image);  
            $imgFile->resize(1080, 1920)->save($resizedImagesPath.'/'.$key."_image_1080*1920");
            $imgFile->resize(480, 854)->save($resizedImagesPath.'/'.$key."_image_480*854");
            $imgFile->resize(720, 1280)->save($resizedImagesPath.'/'.$key."_image_720*1280");
            array_push($imagesData,[
                '1080*1920' => $key."_image_1080*1920.jpeg",
                '480*854' => $key."_image_480*854.jpeg",
                '720*1280' => $key."_image_720*1280.jpeg"
            ]);
        }
        return json_encode($imagesData,true);
    }
}
