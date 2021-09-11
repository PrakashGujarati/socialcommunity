<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Notification;

class NotificationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $userdata = User::where('device_token','!=','')->get();
        // dd($userdata);
        return view('notification.index',compact('userdata'));
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
        $request->validate([
            'user_id' => 'required',
            'image' => 'mimes:jpeg,jpg,png'
        ]);
       
        
        if($request->user_id[0] != "0"){
                $new_name='';
                if($request->has('image'))
                {
                
                    $image = $request->file('image');

                    $url = public_path('upload/notifications/');
                    $originalPath = $url;
                    $name = time() . mt_rand(10000, 99999);
                    $new_name = $name . '.' . $image->getClientOriginalExtension();
                    $image->move($originalPath, $new_name);  
                    // dd($image); 
                }
                foreach ($request->user_id as $value) {
                    $user=User::find($value);
                    // send_notification($user->device_token,$request->message,$request->title);

                    $add = new Notification;
                    $add->device_id = $user->device_token;
                    $add->user_id = $value;
                    $add->title = $request->title;
                    $add->message = $request->message;
                    $add->image = $new_name;
                    $add->save();
                }
                return redirect()->route('notification.index')->with('success', 'Notification Send Successfully.');
            }else
            {
                $users = User::where('device_token','!=','')->get();
                $new_name='';
                if($request->has('image'))
                {
                
                    $image = $request->file('image');

                    $url = public_path('upload/notifications/');
                    $originalPath = $url;
                    $name = time() . mt_rand(10000, 99999);
                    $new_name = $name . '.' . $image->getClientOriginalExtension();
                    $image->move($originalPath, $new_name);   
                }
                foreach ($users as $user) {                    
                    // send_notification($user->device_token,$request->message,$request->title);
                    $add = new Notification;
                    $add->device_id = $user->device_token;
                    $add->user_id = $user->id;
                    $add->title = $request->title;
                    $add->message = $request->message;
                    $add->image = $new_name;
                    $add->save();
                }
                return redirect()->route('notification.index')->with('success', 'Notification Send Successfully.. to All Users');
            } 
        
        
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
}
