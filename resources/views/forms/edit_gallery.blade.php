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
                <h3 class="block-title">Create <small>Gallery</small></h3>
                <a href="{{route('gallery.index')}}" class="btn btn-primary m-2">
                    <i class="bi bi-x-lg"></i>
                </a>
            </div>
            <div class="copy d-none">
                <div class="control-group input-group" style="margin-top:10px">
                    <input type="text" name="video_url[]" class="form-control" placeholder="https://www...">
                    <div class="input-group-btn mx-2">
                        <button class="btn btn-default remove" type="button"><i class="glyphicon glyphicon-remove"></i> <i class="fas text-danger fa-times"></i></button>
                    </div>
                </div>
            </div>
            <div class="block-content block-content-full p-5">
                <form action="{{route('gallery.update',$gallery)}}" method="POST" enctype="multipart/form-data" class="shadow rounded p-5">
                    @csrf
                    @method('PUT')
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="form-label">Category</label><br>
                            <select class="browser-default custom-select" name="category" id="category">
                                <option value="" selected>select</option>
                                <option value="Images" >Images</option>
                                <option value="Videos" {{$gallery->category == "Videos" ?  'selected' : ''}}>Videos</option>
                            </select>
                            <small class="text-danger">
                                @error('category')
                                    <span class="text-red-500 text-xs"><i class="fa fa-bug"></i> {{ $message }}</span>
                                @enderror
                            </small>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label">Event Title</label>
                            <input name="event_title" type="text" class="form-control" placeholder="Title" value="{{$gallery->event_title}}">
                            <small class="text-danger">
                                @error('event_title')
                                    <span class="text-red-500 text-xs"><i class="fa fa-bug"></i> {{ $message }}</span>
                                @enderror
                            </small>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="form-label">Location</label>
                            <input name="location" type="text" class="form-control" placeholder="Location" value="{{$gallery->location}}">
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label">Date</label>
                            <input name="date" type="date" class="form-control" value="{{$gallery->date}}">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="form-label">Description</label>
                            <textarea class="form-control" rows="1" name="description" placeholder="Description...">{{$gallery->description}}</textarea>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label">Status</label>
                            <select class="form-select form-control" name="status" aria-label="Default select example">
                                <option value="Active" {{$gallery->status == "Active" ?  'selected' : ''}} > Active</option>
                                <option value="Deactive" {{$gallery->status == "Deactive" ?  'selected' : ''}} > Deactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="media">
                        {{-- <div class="justify-content-between col-12">
                            <label class="form-label">Video Links</label>
                            <div class="input-group control-group after-add-more">
                                <input type="text" name="video_url[]" class="form-control" placeholder="https://www...">
                                <div class="input-group-btn mx-2">
                                    <button type="button" class="btn btn-success add-more" type="button"><i class="glyphicon glyphicon-plus"></i> <i class="fas fa-plus-square"></i></button>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-primary my-5 mx-3">Update Gallery</button>
                        <a href="{{route('gallery.index')}}" class="btn btn-secondary my-5 mx-3">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- END Page Content -->
@endsection
@section('js_after')
<script>
    $(document).ready(function(){
        $("#category").change(function(){
            var categoryType = $("#category").val();
            if(categoryType == "Images"){
                $(".media").html('<div class="custom-file"><input type="file" name="gallery_media[]" class="custom-file-input" id="imageInput" multiple><label class="custom-file-label" id="inputLabel" for="imageInput">Choose Image</label</div>');
            }else{
                var html = '<div class="justify-content-between col-12">';
                html += '<label class="form-label">Video Links</label>';
                html += '<div class="input-group control-group after-add-more">';
                html += '<input type="text" name="video_url[]" class="form-control" placeholder="https://www...">';
                html += '<div class="input-group-btn mx-2">';
                html += '<button type="button" class="btn btn-success add-btn"  type="button"><i class="glyphicon glyphicon-plus"></i> <i class="fas fa-plus-square"></i></button>';
                html += '</div>';
                html += '</div>';
                html += '</div>';
                $(".media").html(html);
            }
        });
        $("body").on("click",".add-btn",function(){
            var newHtml = $(".copy").html();
            $(".after-add-more").after(newHtml);
        });

        $("body").on("click",".remove",function(){
            $(this).parents(".control-group").remove();
        });

    });
</script>
@endsection
