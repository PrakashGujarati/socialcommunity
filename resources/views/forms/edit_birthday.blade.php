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
                <h3 class="block-title">Edit <small>Birthday</small></h3>
                <a href="{{route('birthday.index')}}" class="btn btn-primary m-2">
                    <i class="bi bi-x-lg"></i>
                </a>
            </div>
                <form action="{{route('birthday.update', $birthday)}}" method="POST" enctype="multipart/form-data" class="shadow rounded p-5">
                    @csrf
                    @method('PUT')
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="form-label">Name</label>
                            <input name="name" type="text" class="form-control" placeholder="Name..." value="{{$birthday->name}}">
                            <small class="text-danger">
                                @error('name')
                                    <span class="text-red-500 text-xs"><i class="fa fa-bug"></i> {{ $message }}</span>
                                @enderror
                            </small>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label">Birth Date</label>
                            <input name="birthdate" type="date" class="form-control" value="{{$birthday->birthdate}}">
                            <small class="text-danger">
                                @error('birthdate')
                                    <span class="text-red-500 text-xs"><i class="fa fa-bug"></i> {{ $message }}</span>
                                @enderror
                            </small>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="form-label">Birth Time</label>
                            <input name="time" type="time" class="form-control" value="{{$birthday->time}}">
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label">Place</label>
                            <input name="place" type="text" class="form-control" placeholder="Birth Place" value="{{$birthday->place}}">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label class="form-label">Wishes</label>
                            <textarea class="form-control" rows="2" name="wishes" placeholder="Birthday Wishes...">{{$birthday->wishes}}</textarea>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="form-label">Picture</label>
                            <div class="custom-file">
                                <input type="file" name="picture" class="custom-file-input" id="pictureInput" accept="image/*" />
                                <label class="custom-file-label" for="pictureInput">Choose file</label>
                            </div>
                            <small class="text-danger">
                                @error('picture')
                                    <span class="text-red-500 text-xs"><i class="fa fa-bug"></i> {{ $message }}</span>
                                @enderror
                            </small>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label">Status</label>
                            <select class="form-select form-control" name="status" aria-label="Default select example">
                                <option value="Active" {{$birthday->status == "Active" ?  'selected' : ''}} > Active</option>
                                <option value="Deactive" {{$birthday->status == "Deactive" ?  'selected' : ''}} > Deactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-primary my-5 mx-3">Update Birthday</button>
                        <a href="{{route('birthday.index')}}" class="btn btn-secondary my-5 mx-3">Cancel</a>
                    </div>
                </form>
        </div>
    </div>
    <!-- END Page Content -->
@endsection
