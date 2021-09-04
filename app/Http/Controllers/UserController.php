<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public $rules = [
        'role_id' => 'required|numeric',
        'first_name' => 'required',
        'email' => 'required|email|unique:App\Models\User,email',
        'password' => 'required|min:4|confirmed',
        'mobile_number' => 'required|numeric',
        'file' => 'mimes:jpeg,jpg,png',
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.users', ['users' => User::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('forms.create_user');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $profileName = '';
        $request->validate($this->rules);
        if ($request->file()) {
            $profileName = time().$request->file->getClientOriginalName();
            $request->file('file')->storeAs('user_profiles', $profileName, 'public');
        }
        User::create([
            'role_id' => $request->role_id,
            'email' => $request->email,
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'password' => $request->password,
            'mobile_number' => $request->mobile_number,
            'gender' => $request->gender,
            'birth_date' => $request->birth_date,
            'address' => $request->address,
            'city' => $request->city,
            'pincode' => $request->pincode,
            'picture' => $profileName
        ]);
        return redirect()->route('user.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $person
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('forms.edit_user', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $this->rules['email'] = '';
        $this->rules['password'] = '';
        $request->validate($this->rules);

        $request->password ? $user->update(['password' => $request->password]) : '';

        if ($request->file()) {
            Storage::delete('public/user_profiles/'.$user->picture);
            $profileName = time().$request->file->getClientOriginalName();
            $request->file('file')->storeAs('user_profiles', $profileName, 'public');
            $user->update(['picture' => $profileName]);
        }

        $user->update([
            'role_id' => $request->role_id,
            'fist_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'mobile_number' => $request->mobile_number,
            'gender' => $request->gender,
            'birth_date' => $request->birth_date,
            'address' => $request->address,
            'city' => $request->city,
            'pincode' => $request->pincode,
        ]);
        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        Storage::delete('public/user_profiles/'.$user->picture);
        $user->delete();
        return redirect()->route('user.index');
    }
}
