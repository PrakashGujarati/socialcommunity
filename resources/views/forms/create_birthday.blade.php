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
                <h3 class="block-title">Create <small>Birthday</small></h3>
                <a href="{{route('birthday.index')}}" class="btn btn-primary m-2">
                    <i class="bi bi-x-lg"></i>
                </a>
            </div>
            <div class="block-content block-content-full p-5">
                <form action="{{route('birthday.store')}}" method="POST" class="shadow rounded p-5">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="form-label">Name</label>
                            <input name="name" type="text" class="form-control" placeholder="Name...">
                            <small class="text-danger">
                                @error('name')
                                    <span class="text-red-500 text-xs"><i class="fa fa-bug"></i> {{ $message }}</span>
                                @enderror
                            </small>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label">Birth Date</label>
                            <input name="birth_date" type="date" class="form-control" >
                            <small class="text-danger">
                                @error('birth_date')
                                    <span class="text-red-500 text-xs"><i class="fa fa-bug"></i> {{ $message }}</span>
                                @enderror
                            </small>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="form-label">Birth Time</label>
                            <input name="time" type="time" class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label">Place</label>
                            <input name="place" type="text" class="form-control" placeholder="Birth Place">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label class="form-label">Wishes</label>
                            <textarea class="form-control" rows="2" name="wishes" placeholder="Birthday Wishes..."></textarea>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="form-label">Status</label>
                            <select class="form-select form-control" name="status" aria-label="Default select example">
                                <option value="Active" selected>Active</option>
                                <option value="Deactive">Deactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-primary my-5 mx-3">Create Birthday</button>
                        <a href="{{route('birthday.index')}}" class="btn btn-secondary my-5 mx-3">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- END Page Content -->
@endsection
