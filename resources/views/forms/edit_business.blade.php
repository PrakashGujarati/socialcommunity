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
                <h3 class="block-title">Edit <small>Business</small></h3>
                <a href="{{route('business.index')}}" class="btn btn-primary m-2">
                    <i class="bi bi-x-lg"></i>
                </a>
            </div>
                <form action="{{route('business.update',$business)}}" method="POST" enctype="multipart/form-data" class="shadow rounder p-5">
                    @csrf
                    @method('PUT')
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label class="form-label">First Name</label>
                            <input name="first_name" type="text" class="form-control" placeholder="First Name" value="{{$business->first_name}}">
                            <small class="text-danger">
                                @error('first_name')
                                    <span class="text-red-500 text-xs"><i class="fa fa-bug"></i> {{ $message }}</span>
                                @enderror
                            </small>
                        </div>
                        <div class="form-group col-md-4">
                            <label class="form-label">Middle Name</label>
                            <input name="middle_name" type="text" class="form-control" placeholder="Middle Name" value="{{$business->middle_name}}">
                            <small class="text-danger">
                                @error('middle_name')
                                    <span class="text-red-500 text-xs"><i class="fa fa-bug"></i> {{ $message }}</span>
                                @enderror
                            </small>
                        </div>
                        <div class="form-group col-md-4">
                            <label class="form-label">Last Name</label>
                            <input name="last_name" type="text" class="form-control" placeholder="Last Name" value="{{$business->last_name}}">
                            <small class="text-danger">
                                @error('last_name')
                                    <span class="text-red-500 text-xs"><i class="fa fa-bug"></i> {{ $message }}</span>
                                @enderror
                            </small>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="form-label">Company</label>
                            <input name="company" type="text" class="form-control" placeholder="Company" value="{{$business->company}}">
                            <small class="text-danger">
                                @error('company')
                                    <span class="text-red-500 text-xs"><i class="fa fa-bug"></i> {{ $message }}</span>
                                @enderror
                            </small>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label">Category</label>
                            <input name="category" type="text" class="form-control" placeholder="Category" value="{{$business->category}}">
                            <small class="text-danger">
                                @error('category')
                                    <span class="text-red-500 text-xs"><i class="fa fa-bug"></i> {{ $message }}</span>
                                @enderror
                            </small>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-control" placeholder="Business Description...">{{$business->description}}</textarea>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="form-label">Contact Number</label>
                            <input name="contact" type="tel" class="form-control" placeholder="Contact Number" value="{{$business->contact}}">
                            <small class="text-danger">
                                @error('contact')
                                    <span class="text-red-500 text-xs"><i class="fa fa-bug"></i> {{ $message }}</span>
                                @enderror
                            </small>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label">Email</label><br>
                            <input name="email" type="email" class="form-control" placeholder="Email Address" value="{{$business->email}}">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="form-label">Address</label>
                            <textarea class="form-control" rows="2" name="address" placeholder="Address...">{{$business->address}}"</textarea>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="form-label">Logo</label>
                            <div class="custom-file">
                                <input type="file" name="logo" class="custom-file-input" id="logoInput">
                                <label class="custom-file-label" for="logoInput">Choose Logo</label>
                            </div>
                            <small class="text-danger">
                                @error('logo')
                                    <span class="text-red-500 text-xs"><i class="fa fa-bug"></i> {{ $message }}</span>
                                @enderror
                            </small>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label">Visiting Card</label>
                            <div class="custom-file">
                                <input type="file" name="visitingcard" class="custom-file-input" id="cardInput">
                                <label class="custom-file-label" for="cardInput">Choose Logo</label>
                            </div>
                            <small class="text-danger">
                                @error('visitingcard')
                                    <span class="text-red-500 text-xs"><i class="fa fa-bug"></i> {{ $message }}</span>
                                @enderror
                            </small>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="form-label">Status</label>
                            <select class="form-select form-control" name="status" aria-label="Default select example">
                                <option value="Active" {{$business->status == "Active" ?  'selected' : ''}} > Active</option>
                                <option value="Deactive" {{$business->status == "Deactive" ?  'selected' : ''}} > Deactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-primary my-5 mx-3">Update Business</button>
                        <a href="{{route('business.index')}}" class="btn btn-secondary my-5 mx-3">Cancel</a>
                    </div>
                </form>
        </div>
    </div>
    <!-- END Page Content -->
@endsection
