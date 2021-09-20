<?php

namespace App\Http\Controllers;

use App\Models\Megazine;
use Illuminate\Http\Request;
use Spatie\PdfToImage\Pdf;
use Illuminate\Filesystem\Filesystem as File;
use Image;


class MegazineController extends Controller
{
    public $rules = [
        'title' => 'required|alpha_dash',
        'category' => 'required',
        'megazine' => 'mimes:pdf'
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.megazine',['megazines' => Megazine::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('forms.create_megazine');
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
        $megazineName = "";
        if ($request->file('megazine')){
            $megazineName = $this->storeMedia($request->file('megazine'),$request->category,$request->title);
        }
        Megazine::create([
            'title' => $request->title,
            'category' => $request->category,
            'date' => $request->date,
            'path' => $megazineName,
            'status' => $request->status
        ]);
        return redirect()->route('megazine.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Megazine  $megazine
     * @return \Illuminate\Http\Response
     */
    public function show(Megazine $megazine)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Megazine  $megazine
     * @return \Illuminate\Http\Response
     */
    public function edit(Megazine $megazine)
    {
        // $megazine=Megazine::where('id',$id)->first();
        return view('forms.edit_megazine',['megazine' => $megazine]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Megazine  $megazine
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Megazine $megazine)
    {
        $request->validate($this->rules);
        $megazineName = $megazine->path;

        if ($request->title != $megazine->title && !$request->file('megazine')) {
            rename(public_path()."/megazines/".$megazine->category."/".$megazine->title,public_path()."/megazines/".$megazine->category."/".$request->title);
        } 

        if ($request->file('megazine')) {
            $file = new File;
            $file->deleteDirectory(public_path()."/megazines/".$megazine->category."/".$megazine->title);
            $megazineName = $this->storeMedia($request->file('megazine'),$request->category,$request->title);
        }

        $megazine->update([
            'title' => $request->title,
            'category' => $request->category,
            'date' => $request->date,
            'path' => $megazineName,
            'status' => $request->status
        ]);
        return redirect()->route('megazine.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Megazine  $megazine
     * @return \Illuminate\Http\Response
     */
    public function destroy(Megazine $megazine)
    {
        $file = new File;
        $file->deleteDirectory(public_path()."/megazines/".$megazine->category."/".$megazine->title);
        $megazine->delete();
        return redirect()->route('megazine.index');
    }

    public function storeMedia($mediaFile,$category,$title)
    {
        $mediaPath = public_path()."/megazines/".$category."/".$title;
        
        $megazineNameWithExtension = $mediaFile->getClientOriginalName();
        $megazineNameWithoutExtension = pathinfo($mediaFile->getClientOriginalName(),PATHINFO_FILENAME);
        $mediaFile->move($mediaPath,$megazineNameWithExtension);
        $megazinePdfPath = $mediaPath."/".$megazineNameWithExtension;

        if(!file_exists($mediaPath."/images//".$megazineNameWithoutExtension)){
            mkdir($mediaPath."/images//".$megazineNameWithoutExtension, 0777, true);
        }

        $originalImagesPath = $mediaPath."/images/".$megazineNameWithoutExtension;
        $pdf = new Pdf($megazinePdfPath);

        $pdf->setOutputFormat('jpeg')->saveImage($originalImagesPath."/".$megazineNameWithoutExtension."(%d)");   

        if(!file_exists($mediaPath."/resized//".$megazineNameWithoutExtension)){
            mkdir($mediaPath."/resized//".$megazineNameWithoutExtension, 0777, true);
        }

        $resizedImagesPath = $mediaPath."/resized/".$megazineNameWithoutExtension;

        $originalImages = array_diff(scandir($originalImagesPath), array('..', '.'));
        
        foreach ($originalImages as $key => $image) {
            $imgFile = Image::make($originalImagesPath."/".$image);  
            $imgFile->resize(1080, 1920)->save($resizedImagesPath.'/'.$key."_image_1080*1920");
            $imgFile->resize(480, 854)->save($resizedImagesPath.'/'.$key."_image_480*854");
            $imgFile->resize(720, 1280)->save($resizedImagesPath.'/'.$key."_image_720*1280");
        }

        return $megazineNameWithExtension;

    }
}
