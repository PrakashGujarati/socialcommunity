@extends('layouts.backend')

@section('css_before')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
@endsection

@section('content')
    <!-- Page Content -->
    <div class="content">
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">Edit <small>User</small></h3>
                 <a href="{{route('user.index')}}" class="btn btn-primary m-2 float-right">
                    <i class="bi bi-x-lg"></i>
                </a>
            </div>
            <div class="block-content block-content-full p-5">
                <form action="{{route('user.update',$user)}}" method="POST" enctype="multipart/form-data" class="shadow rounded p-5">
                    @csrf
                    @method('PUT')
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="form-label">Email address</label>
                            <input name="email" type="email" class="form-control" placeholder="Enter email" value="{{$user->email}}" readonly>
                            <small class="text-danger">
                                @error('email')
                                    <span class="text-red-500 text-xs"><i class="fa fa-bug"></i> {{ $message }}</span>
                                @enderror
                            </small>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label class="form-label">First Name</label>
                            <input name="first_name" type="text" class="form-control" placeholder="First Name" value="{{$user->first_name}}">
                            <small class="text-danger">
                                @error('first_name')
                                    <span class="text-red-500 text-xs"><i class="fa fa-bug"></i> {{ $message }}</span>
                                @enderror
                            </small>
                        </div>
                        <div class="form-group col-md-4">
                            <label class="form-label">Middle Name</label>
                            <input name="middle_name" type="text" class="form-control" placeholder="Middle Name" value="{{$user->middle_name}}">
                        </div>
                        <div class="form-group col-md-4">
                            <label class="form-label">Last Name</label>
                            <input name="last_name" type="text" class="form-control" placeholder="Last Name" value="{{$user->last_name}}">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="form-label">Password</label>
                            <input name="password" type="password" class="form-control" placeholder="New Password">
                            <small class="text-danger">
                                @error('password')
                                    <span class="text-red-500 text-xs"><i class="fa fa-bug"></i> {{ $message }}</span>
                                @enderror
                            </small>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="form-label">Mobile Number</label>
                            <input name="mobile_number" type="tel" class="form-control" placeholder="Mobile Number" value="{{$user->mobile_number}}">
                            <small class="text-danger">
                                @error('mobile_number')
                                    <span class="text-red-500 text-xs"><i class="fa fa-bug"></i> {{ $message }}</span>
                                @enderror
                            </small>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label">Gender</label><br>
                            <select class="browser-default custom-select" name="gender">
                                <option value="">Select Gender</option>
                                <option value="Male" {{$user->gender == "Male" ?  'selected' : ''}} > Male</option>
                                <option value="Female" {{$user->gender == "Female" ?  'selected' : ''}} > Female</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="form-label">Birth Date</label>
                            <input name="birth_date" type="date" class="form-control" max="{{date('Y-m-d')}}" value="{{$user->birth_date}}">
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label">Role Id</label>
                            <input name="role_id" type="role_id" class="form-control" placeholder="Roll Id" value="{{$user->role_id}}">
                                <small class="text-danger">
                                    @error('role_id')
                                        <span class="text-red-500 text-xs"><i class="fa fa-bug"></i> {{ $message }}</span>
                                    @enderror
                                </small>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="form-label">Address</label>
                            <textarea class="form-control" rows="1" name="address" placeholder="Address..." >{{$user->address}}</textarea>
                        </div>
                        <div class="form-group col-md-3">
                            <label class="form-label">City</label>
                            <input type="text" name="city" class="form-control" placeholder="City" value="{{$user->city}}">
                        </div>
                        <div class="form-group col-md-3">
                            <label class="form-label">Pincode</label>
                            <input type="number" name="pincode" class="form-control" placeholder="xxxxxx" value="{{$user->pincode}}">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label class="form-label">Picture</label>
                            <div class="custom-file">
                                <input type="file" name="file" class="custom-file-input" id="pictureInput">
                                <label class="custom-file-label" for="pictureInput">Choose file</label>
                                <small class="text-danger">
                                    @error('file')
                                        <span class="text-red-500 text-xs"><i class="fa fa-bug"></i> {{ $message }}</span>
                                    @enderror
                                </small>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-primary my-5 mx-3">Update User</button>
                        <a href="{{route('user.index')}}" class="btn btn-secondary my-5 mx-3">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- END Page Content -->
@endsection
