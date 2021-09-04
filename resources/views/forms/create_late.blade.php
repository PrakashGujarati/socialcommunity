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
                <h3 class="block-title">Create <small>Late</small></h3>
                <a href="{{route('late.index')}}" class="btn btn-primary m-2">
                    <i class="bi bi-x-lg"></i>
                </a>
            </div>
            <div class="block-content block-content-full p-5">
                <form action="{{route('late.store')}}" method="POST" enctype="multipart/form-data" class="shadow rounded p-5">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label class="form-label">First Name</label>
                            <input name="first_name" type="text" class="form-control" placeholder="First Name">
                            <small class="text-danger">
                                @error('first_name')
                                    <span class="text-red-500 text-xs"><i class="fa fa-bug"></i> {{ $message }}</span>
                                @enderror
                            </small>
                        </div>
                        <div class="form-group col-md-4">
                            <label class="form-label">Middle Name</label>
                            <input name="middle_name" type="text" class="form-control" placeholder="Middle Name">
                        </div>
                        <div class="form-group col-md-4">
                            <label class="form-label">Last Name</label>
                            <input name="last_name" type="text" class="form-control" placeholder="Last Name">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="form-label">Late Date</label>
                            <input name="late_date" type="date" class="form-control">
                            <small class="text-danger">
                                @error('late_date')
                                    <span class="text-red-500 text-xs"><i class="fa fa-bug"></i> {{ $message }}</span>
                                @enderror
                            </small>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label">Birth Date</label>
                            <input name="birth_date" type="date" class="form-control">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="form-label">Contact</label>
                            <input name="contact" type="tel" class="form-control" placeholder="Contact">
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label">Gujarati Savant</label>
                            <input name="gujarati_savant" type="text" class="form-control" placeholder="Savant">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label class="form-label">Shradhhanjali</label>
                            <button type="button" ></button>
                            <textarea class="form-control" name="shradhhanjali" placeholder="Shradhhanjali..."></textarea>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="form-label">Address</label>
                            <textarea class="form-control" rows="2" name="address" placeholder="Address..."></textarea>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label">Notifications</label>
                            <textarea class="form-control" rows="2" name="notifications" placeholder="Notifications..."></textarea>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="form-label">Picture</label>
                            <div class="custom-file">
                                <input type="file" name="picture" class="custom-file-input" id="pictureInput">
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
                                <option value="Active" selected>Active</option>
                                <option value="Deactive">Deactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-primary my-5 mx-3">Create Late</button>
                        <a href="{{route('late.index')}}" class="btn btn-secondary my-5 mx-3">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="//cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('shradhhanjali');
    </script>
    <!-- END Page Content -->
@endsection
