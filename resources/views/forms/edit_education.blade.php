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
                <h3 class="block-title">Update <small>Education</small></h3>
                <a href="{{route('education.index')}}" class="btn btn-primary m-2">
                    <i class="bi bi-x-lg"></i>
                </a>
            </div>
            <form action="{{route('education.update',$education->id)}}" method="POST" enctype="multipart/form-data" class="shadow rounded p-5">
                    @csrf
                    @method('PUT')
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="form-label">Name</label>
                            <input name="name" type="text" class="form-control" placeholder="Name"  value="{{$education->name}}">
                            <small class="text-danger">
                                @error('name')
                                    <span class="text-red-500 text-xs"><i class="fa fa-bug"></i> {{ $message }}</span>
                                @enderror
                            </small>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="form-label">Qualification</label>
                            <input name="qualification" type="text" class="form-control" placeholder="qualification" value="{{$education->qualification}}">
                            <small class="text-danger">
                                @error('qualification')
                                    <span class="text-red-500 text-xs"><i class="fa fa-bug"></i> {{ $message }}</span>
                                @enderror
                            </small>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="form-label">Picture</label>
                            <div class="custom-file">
                                <input type="file" name="picture" class="custom-file-input" id="cardInput">
                                <label class="custom-file-label" for="cardInput">Choose Newsimage</label>
                            </div>
                            <small class="text-danger">
                                @error('picture')
                                    <span class="text-red-500 text-xs"><i class="fa fa-bug"></i> {{ $message }}</span>
                                @enderror
                            </small>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="form-label">Note</label>
                            <input name="note" type="text" class="form-control" placeholder="note" value="{{$education->note}}">
                            <small class="text-danger">
                                @error('note')
                                    <span class="text-red-500 text-xs"><i class="fa fa-bug"></i> {{ $message }}</span>
                                @enderror
                            </small>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="form-label">Gender</label>
													<span class="text-danger">*</span></label><br>
													<input type="radio" @if($education->gender == 'Male') checked @endif name="gender" class="form-input-control-control" value="Male" checked="" />
													<label class="form-control-label">Male</label>
													<input type="radio" @if($education->gender == 'Female') checked @endif name="gender" class="form-input-control" value="Female" />
													<label class="form-control-label">Female</label>
                           <small class="text-danger">
                                @error('gender')
                                    <span class="text-red-500 text-xs"><i class="fa fa-bug"></i> {{ $message }}</span>
                                @enderror
                            </small>
                        </div>
                </div>
                 <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="form-label">Status</label>
                            <select class="form-select form-control" name="status" aria-label="Default select example">
                            <option value="Active" {{$education->status == "Active" ?  'selected' : ''}} > Active</option>
                                <option value="Deactive" {{$education->status == "Deactive" ?  'selected' : ''}} > Deactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-primary my-5 mx-3">Create education</button>
                        <a href="{{route('education.index')}}" class="btn btn-secondary my-5 mx-3">Cancel</a>
                    </div>
                </form>
        </div>
    </div>
    <!-- END Page Content -->
@endsection
