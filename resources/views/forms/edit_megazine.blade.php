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
                <h3 class="block-title">Edit <small>Megazine</small></h3>
                <a href="{{route('megazine.index')}}" class="btn btn-primary m-2">
                    <i class="bi bi-x-lg"></i>
                </a>
            </div>
                <form action="{{route('megazine.update',$megazine->id)}}" method="POST" enctype="multipart/form-data" class="shadow rounder p-5">
                    @csrf
                    @method('PUT')
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label class="form-label">Title</label>
                            <input name="title" type="text" class="form-control" placeholder="title" value="{{$megazine->title}}">
                            <small class="text-danger">
                                @error('title')
                                    <span class="text-red-500 text-xs"><i class="fa fa-bug"></i> {{ $message }}</span>
                                @enderror
                            </small>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="form-label">Category</label>
                            <input name="category" type="text" class="form-control" placeholder="Category" value="{{$megazine->category}}">
                            <small class="text-danger">
                                @error('category')
                                    <span class="text-red-500 text-xs"><i class="fa fa-bug"></i> {{ $message }}</span>
                                @enderror
                            </small>
                        </div>
                    </div>
                    <div class="form-row">
                    <div class="form-group col-md-6">
                            <label class="form-label">Date</label>
                            <input name="date" type="date" class="form-control" value="{{$megazine->date}}">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="form-label">Magazine Image</label>
                            <div class="custom-file">
                                <input type="file" name="megazine" class="custom-file-input" id="logoInput">
                                <label class="custom-file-label" for="logoInput">Choose Logo</label>
                            </div>
                            <small class="text-danger">
                                @error('path')
                                    <span class="text-red-500 text-xs"><i class="fa fa-bug"></i> {{ $message }}</span>
                                @enderror
                            </small>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="form-label">Status</label>
                            <select class="form-select form-control" name="status" aria-label="Default select example">
                                <option value="Active" {{$megazine->status == "Active" ?  'selected' : ''}} > Active</option>
                                <option value="Deactive" {{$megazine->status == "Deactive" ?  'selected' : ''}} > Deactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-primary my-5 mx-3">Update Megazine</button>
                        <a href="{{route('megazine.index')}}" class="btn btn-secondary my-5 mx-3">Cancel</a>
                    </div>
                </form>
        </div>
    </div>
    <!-- END Page Content -->
@endsection
