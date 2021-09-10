<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\Gallery;
use App\Model\GalleryImage;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public $rules = [
        'category' => 'required',
        'event_title' => 'required'
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list(Request $request)
    {
        //
        $data = Gallery::with('galleryImage')->where('status','=','Active')->where(['category' => $request->category])->get();   
        // dd($data);             
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

        $newGallery = Gallery::create([
            'category' => $request->category,
            'event_title' => $request->event_title,
            'location' => $request->location,
            'description' => $request->description,
            'date' => $request->date,
            'status' => 'Inactive'
            
        ]);
        // html_entity_decode($request->path);
        // dd(explode(",",$request->path));
        if ($request->path) {
            foreach (explode(",",$request->path) as $link) {
                $newGallery->galleryImage()->create([
                    'path' => $link
                ]);
            }
        } else {
            foreach($request->file('gallery_media') as $file){
                $name = time().'.'.$file->getClientOriginalName();
                $file->storeAs('Gallery Media', $name, 'public');

                $newGallery->galleryImage()->create([
                    'path' => $name
                ]);
            }
        }
        return $this->responseOut($newGallery);
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
        $data = Gallery::with('galleryImage')->where(['id' => $request->gallery_id])->get();
        // dd($data);
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
        $gallery = Gallery::where(['id' => $request->gallery_id])->first();
        // dd($gallery);
        if (!empty($gallery)) {
            $validator = Validator::make($request->all(), $this->rules);

            if ($validator->fails()) {
                return ['status' => "false",'msg' => $validator->messages()];
            }

           $newupdated =  $gallery->update([
                'category' => $request->category,
                'event_title' => $request->event_title,
                'location' => $request->location,
                'description' => $request->description,
                'date' => $request->date     
            ]);

            if ($request->file('gallery_media')) {
                $gallery_images = GalleryImage::where('gallery_id',$gallery->id)->get();
                foreach($gallery_images as $image){
                    Storage::delete('public/Gallery Media/'.$image->path);
                }
                $gallery->galleryImage()->delete();
                foreach($request->file('gallery_media') as $file){
                    $name = time().'.'.$file->getClientOriginalName();
                    $file->storeAs('Gallery Media', $name, 'public');

                    $gallery->galleryImage()->create([
                        'path' => $name
                    ]);
                }
            }


            if ($request->video_url) {
                $gallery->galleryImage()->delete();
                foreach ($request->video_url as $link) {
                    $gallery->galleryImage()->create([
                        'path' => $link
                    ]);
                }
            }
            if($newupdated<=0){
                return response()->json([
                    'code' => 400,
                    'message' => 'No Gallery Found !',
                    'data' => []
                ]);
            }

        return $this->responseOut($gallery);
        } else {
            return $this->responseOut($gallery);
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
                'message' => 'No Gallery Found !',
                'data' => []
            ]);
        }
    }
}
