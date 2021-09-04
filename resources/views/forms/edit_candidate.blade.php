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
                <h3 class="block-title">Create <small>Candidate</small></h3>
                <a href="{{route('candidate.index')}}" class="btn btn-primary m-2">
                    <i class="bi bi-x-lg"></i>
                </a>
            </div>
            <div class="block-content block-content-full p-5">
                <form action="{{route('candidate.update',$candidate)}}" method="POST" enctype="multipart/form-data" class="shadow rounded p-5">
                    @csrf
                    @method('PUT')
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label class="form-label">First Name</label>
                            <input name="first_name" type="text" class="form-control" placeholder="First Name" value="{{$candidate->first_name}}">
                            <small class="text-danger">
                                @error('first_name')
                                    <span class="text-red-500 text-xs"><i class="fa fa-bug"></i> {{ $message }}</span>
                                @enderror
                            </small>
                        </div>
                        <div class="form-group col-md-4">
                            <label class="form-label">Middle Name</label>
                            <input name="middle_name" type="text" class="form-control" placeholder="Middle Name" value="{{$candidate->middle_name}}">
                        </div>
                        <div class="form-group col-md-4">
                            <label class="form-label">Last Name</label>
                            <input name="last_name" type="text" class="form-control" placeholder="Last Name" value="{{$candidate->last_name}}">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label class="form-label">Birth Date</label>
                            <input name="birth_date" type="date" class="form-control" value="{{$candidate->birth_date}}">
                        </div>
                        <div class="form-group col-md-4">
                            <label class="form-label">Birth Time</label>
                            <input name="birth_time" type="time" class="form-control" value="{{$candidate->birth_time}}">
                        </div>
                        <div class="form-group col-md-4">
                            <label class="form-label">Birth Place</label>
                            <input name="birth_place" type="text" class="form-control" value="{{$candidate->birth_place}}">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="form-label">Height</label>
                            <input name="height" type="text" class="form-control" placeholder="Height" value="{{$candidate->height}}">
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label">Weight</label>
                            <input name="weight" type="text" class="form-control" placeholder="Weight" value="{{$candidate->weight}}">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="form-label">Education</label>
                            <input name="education" type="text" class="form-control" placeholder="Education" value="{{$candidate->education}}">
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label">Occupation</label>
                            <input name="occupation" type="text" class="form-control" placeholder="Occupation" value="{{$candidate->occupation}}">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="form-label">Father Name</label>
                            <input name="father_name" type="text" class="form-control" placeholder="Father Name" value="{{$candidate->father_name}}">
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label">Mother Name</label>
                            <input name="mother_name" type="text" class="form-control" placeholder="Mother Name" value="{{$candidate->mother_name}}">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="form-label">Father Occupation</label>
                            <input name="father_occupation" type="text" class="form-control" placeholder="Father Occupation" value="{{$candidate->father_occupation}}">
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label">Mother Occupation</label>
                            <input name="mother_occupation" type="text" class="form-control" placeholder="Mother Occupation" value="{{$candidate->mother_occupation}}">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-5">
                            <label class="form-label">Father Contact</label>
                            <input name="father_contact" type="text" class="form-control" placeholder="Father Contact" value="{{$candidate->father_contact}}">
                            <small class="text-danger">
                                @error('father_contact')
                                    <span class="text-red-500 text-xs"><i class="fa fa-bug"></i> {{ $message }}</span>
                                @enderror
                            </small>
                        </div>
                        <div class="form-group col-md-4">
                            <label class="form-label">Brothers</label>
                            <input name="brothers" type="number" class="form-control" value="{{$candidate->brothers}}">
                        </div>
                        <div class="form-group col-md-3">
                            <label class="form-label">Sisters</label>
                            <input name="sisters" type="number" class="form-control" value="{{$candidate->sisters}}">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="form-label">Email address</label>
                            <input name="email" type="email" class="form-control" placeholder="Enter email" value="{{$candidate->email}}">
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label">Contact Number</label>
                            <input name="contact" type="tel" class="form-control" placeholder="Contact Number" value="{{$candidate->contact}}">
                            <small class="text-danger">
                                @error('contact')
                                    <span class="text-red-500 text-xs"><i class="fa fa-bug"></i> {{ $message }}</span>
                                @enderror
                            </small>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="form-label">Resident Address</label>
                            <textarea class="form-control" rows="2" name="resident_address" placeholder="Resident Address...">{{$candidate->resident_address}}</textarea>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label">Native Address</label>
                            <textarea class="form-control" rows="2" name="native_address" placeholder="Native Address...">{{$candidate->native_address}}</textarea>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="form-label">Maternal</label>
                            <textarea class="form-control" rows="1" name="maternal" placeholder="Maternal Details">{{$candidate->maternal}}</textarea>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label">Maternal place</label>
                            <input name="maternal_place" type="text" class="form-control" placeholder="place" value="{{$candidate->maternal_place}}">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="form-label">Hobbies</label>
                            <textarea class="form-control" rows="1" name="hobbies" placeholder="Hobbies">{{$candidate->hobbies}}</textarea>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label">Expectations</label>
                            <textarea class="form-control" rows="1" name="expectations" placeholder="Expectations">{{$candidate->expectations}}</textarea>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="form-label">Remark</label>
                            <textarea class="form-control" rows="1" name="remark" placeholder="Remark">{{$candidate->remark}}</textarea>
                        </div>
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
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label class="form-label">Status</label>
                            <select class="form-select form-control" name="status" aria-label="Default select example">
                                <option value="Active" {{$candidate->status == "Active" ?  'selected' : ''}} > Active</option>
                                <option value="Deactive" {{$candidate->status == "Deactive" ?  'selected' : ''}} > Deactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-primary my-5 mx-3">Update Candidate</button>
                        <a href="{{route('candidate.index')}}" class="btn btn-secondary my-5 mx-3">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </>
    <!-- END Page Content -->
@endsection