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
                <h3 class="block-title">Edit <small>Recruitement</small></h3>
                <a href="{{route('recruitment.index')}}" class="btn btn-primary m-2">
                    <i class="bi bi-x-lg"></i>
                </a>
            </div>
            <div class="block-content block-content-full p-5">
                <form action="{{route('recruitment.update',$recruitment)}}" method="POST" enctype="multipart/form-data" class="shadow rounded p-5">
                    @csrf
                    @method('PUT')
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="form-label">Headline</label>
                            <textarea name="headline" rows="2" class="form-control" placeholder="Headline...">{{$recruitment->headline}}</textarea>
                            <small class="text-danger">
                                @error('headline')
                                    <span class="text-red-500 text-xs"><i class="fa fa-bug"></i> {{ $message }}</span>
                                @enderror
                            </small>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-8">
                            <label class="form-label">Title</label>
                            <input name="title" type="text" class="form-control" placeholder="Title" value="{{$recruitment->title}}">
                            <small class="text-danger">
                                @error('title')
                                    <span class="text-red-500 text-xs"><i class="fa fa-bug"></i> {{ $message }}</span>
                                @enderror
                            </small>
                        </div>
                        <div class="form-group col-md-4">
                            <label class="form-label">Category</label>
                            <input name="category" type="text" class="form-control" placeholder="Category" value="{{$recruitment->category}}">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label class="form-label">Description</label>
                            <textarea name="description" rows="3" class="form-control" placeholder="Description...">{{$recruitment->description}}</textarea>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="form-label">Skills</label>
                            <input name="skills" type="text" class="form-control" placeholder="Skills" value="{{$recruitment->skills}}">
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label">Education Qualification</label>
                            <input name="education_quailification" type="text" class="form-control" placeholder="Education Qualification" value="{{$recruitment->education_quailification}}">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="form-label">Reported datetime</label>
                            <input name="reported_datetime" type="datetime-local" class="form-control" value="{{$recruitment->reported_datetime}}">
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label">Thumbnail</label>
                            <div class="custom-file">
                                <input type="file" name="thumbnail" class="custom-file-input" id="thumbnailInput">
                                <label class="custom-file-label" for="thumbnailInput">Choose Thumbnail</label>
                            </div>
                            <small class="text-danger">
                                @error('thumbnail')
                                    <span class="text-red-500 text-xs"><i class="fa fa-bug"></i> {{ $message }}</span>
                                @enderror
                            </small>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="form-label">Reference Url</label>
                            <input name="reference_url" type="text" class="form-control" placeholder="Reference Url" value="{{$recruitment->reference_url}}">
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label">Status</label>
                            <select class="form-select form-control" name="status" aria-label="Default select example">
                                <option value="Active" {{$recruitment->status == "Active" ?  'selected' : ''}} > Active</option>
                                <option value="Deactive" {{$recruitment->status == "Deactive" ?  'selected' : ''}} > Deactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-primary my-5 mx-3">Update Recruitement</button>
                        <a href="{{route('recruitment.index')}}" class="btn btn-secondary my-5 mx-3">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- END Page Content -->
@endsection