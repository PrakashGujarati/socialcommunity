<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\GalleryImage;
use Illuminate\Http\Request;
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
    public function index()
    {
        return view('pages.gallery',['galleries' => Gallery::with('galleryImages')->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('forms.create_gallery');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate($this->rules);

        $newGallery = Gallery::create([
            'category' => $request->category,
            'event_title' => $request->event_title,
            'location' => $request->location,
            'description' => $request->description,
            'date' => $request->date,
            'status' => $request->status
        ]);

        if ($request->video_url) {
            $newGallery->galleryImages()->create([                
                'path' => $request->video_url
            ]);
        } else {
            foreach($request->file('gallery_media') as $file){
                $name = time().'.'.$file->getClientOriginalName();
                $file->storeAs('Gallery Media', $name, 'public');
    
                $newGallery->galleryImages()->create([                    
                    'path' => $name
                ]);
            }
        }
        
        return redirect()->route('gallery.index');
        
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function show(Gallery $gallery)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function edit(Gallery $gallery)
    {
        return view('forms.edit_gallery',['gallery' => $gallery]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gallery $gallery)
    {
        $request->validate($this->rules);
        
        $gallery->update([
            'category' => $request->category,
            'event_title' => $request->event_title,
            'location' => $request->location,
            'description' => $request->description,
            'date' => $request->date,
            'status' => $request->status
        ]);
        
        return redirect()->route('gallery.index');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gallery $gallery)
    {
        $gallery_id = $gallery->id;
        $gallery_images = GalleryImage::where('gallery_id',$gallery_id)->get();
        foreach($gallery_images as $image){
            Storage::delete('public/Gallery Media/'.$image->path);
            $image->delete();
        }
        $gallery->delete();
        return redirect()->route('gallery.index');
    }
}
