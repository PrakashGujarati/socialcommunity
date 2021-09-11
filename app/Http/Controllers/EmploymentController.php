<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employment;
use Illuminate\Support\Facades\Storage;

class EmploymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.employment' , ['employments' => Employment::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('forms.create_employment');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $news_image = '';
        $data=[];
        if($request->hasfile('thumbnail'))
        {
             foreach($request->file('thumbnail') as $image)
             {
                 $name=$image->getClientOriginalName();
                 $image->move(public_path().'/image/',$name);
                $data[]=$name;  
             }
         }
         if ($request->file('news_image')) {
            $news_image = time().$request->file('news_image')->getClientOriginalName();
            $request->file('news_image')->storeAs('news_images', $news_image, 'public');
        }
        $thumbnail=implode(",", $data);

        Employment::create([
            'headline' => $request->headline,
            'title' => $request->title,
            'category' => $request->category,
            'detail_report' => $request->detail_report,
            'thumbnail' => $thumbnail,
            'news_image' => $news_image,
            'reported_datetime' => $request->reported_datetime,
            'reference' => $request->reference,
            'status' => $request->status,
            'done_by' => 1
        ]);
        return redirect()->route('employment.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employment=Employment::where('id',$id)->first();
        return view('forms.edit_employment',compact('employment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Employment $employment)
    {
        $imageUpdate=null;
        if ($files=$request->file('thumbnail')) {
            foreach($files as $file){
             Storage::delete('public/thumbnails/'.$employment->thumbnail);
             $thumbnailName = time().$file->getClientOriginalName();
             $file->storeAs('thumbnails', $thumbnailName, 'public');
            //$news->update(['thumbnail' => $thumbnailName]);
            $imageUpdate.=$thumbnailName.",";
            }
        }
        if ($request->file('news_image')) {
            Storage::delete('public/news_images/'.$employment->news_image);
            $news_image = time().$request->file('news_image')[0]->getClientOriginalName();
            $request->file('news_image')[0]->storeAs('news_images', $news_image, 'public');
            $employment->update(['news_image' => $news_image]);
        }
        if($imageUpdate != null)
        {
            
            $employment->update([
                'headline' => $request->headline,
                'title' => $request->title,
                'category' => $request->category,
                'detail_report' => $request->detail_report,
                'reported_datetime' => $request->reported_datetime,
                'reference' => $request->reference,
                'status' => $request->status,
                'thumbnail'=>$imageUpdate
            ]);
        }
        else
        {
            $employment->update([
                'headline' => $request->headline,
                'title' => $request->title,
                'category' => $request->category,
                'detail_report' => $request->detail_report,
                'reported_datetime' => $request->reported_datetime,
                'reference' => $request->reference,
                'status' => $request->status
            ]);
        }
            
        return redirect()->route('employment.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employment $employment)
    {
        $employment->delete();
        return redirect()->route('employment.index');
    }
}
