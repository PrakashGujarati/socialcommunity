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
                <h3 class="block-title">Create <small>News</small></h3>
                <a href="{{route('news.index')}}" class="btn btn-primary m-2">
                    <i class="bi bi-x-lg"></i>
                </a>
            </div>
            <div class="">
                <form action="{{route('news.update',$news)}}" method="POST" enctype="multipart/form-data" class="shadow rounded p-5">
                    @csrf
                    @method('PUT')
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label class="form-label">Headline</label>
                            <textarea name="headline" rows="2" class="form-control" placeholder="Headline...">{{$news->headline}}</textarea>
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
                            <input name="title" type="text" class="form-control" placeholder="News Title" value="{{$news->title}}">
                            <small class="text-danger">
                                @error('title')
                                    <span class="text-red-500 text-xs"><i class="fa fa-bug"></i> {{ $message }}</span>
                                @enderror
                            </small>
                        </div>
                        <div class="form-group col-md-4">
                            <label class="form-label">Category</label>
                            <input name="category" type="text" class="form-control" placeholder="News Category" value="{{$news->category}}">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label class="form-label">Detail Report</label>
                            <textarea name="detail_report" rows="3" class="form-control" placeholder="Detail Report...">{{$news->detail_report}}</textarea>
                        </div>
                    </div>
                    <div class="form-row">
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
                        <div class="form-group col-md-6">
                            <label class="form-label">News Image</label>
                            <div class="custom-file">
                                <input type="file" name="news_image" class="custom-file-input" id="imageInput">
                                <label class="custom-file-label" for="imageInput">Choose Image</label>
                            </div>
                            <small class="text-danger">
                                @error('news_image')
                                    <span class="text-red-500 text-xs"><i class="fa fa-bug"></i> {{ $message }}</span>
                                @enderror
                            </small>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="form-label">Reported datetime</label>
                            <input name="reported_datetime" type="datetime-local" class="form-control" value="{{$news->reported_datetime}}">
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label">Reference</label>
                            <input name="reference" type="text" class="form-control" placeholder="Reference" value="{{$news->reference}}">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="form-label">Status</label>
                            <select class="form-select form-control" name="status" aria-label="Default select example">
                                <option value="Active" {{$news->status == "Active" ?  'selected' : ''}} > Active</option>
                                <option value="Deactive" {{$news->status == "Deactive" ?  'selected' : ''}} > Deactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <button type="submit" class="btn btn-primary ml-1">Save</button>
                        <a href="{{route('news.index')}}" class="btn btn-secondary ml-3">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- END Page Content -->
@endsection
