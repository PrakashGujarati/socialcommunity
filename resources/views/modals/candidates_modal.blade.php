@foreach ($candidates as $candidate)
<div class="modal fade" id="Modal-{{$candidate->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    {{$candidate->first_name.' '.$candidate->middle_name.' '.$candidate->last_name}}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <div class="modal-body">
            <div class="p-1">
                <div class="row my-3">
                    <div class="col-md-4">
                        <label class="form-label">
                            First Name : <span class="font-weight-normal">{{$candidate->first_name}}</span>
                        </label>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Middle Name :
                            <span class="font-weight-normal">{{$candidate->middle_name}}</span>
                        </label>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Last Name :
                            <span class="font-weight-normal">{{$candidate->last_name}}</span>
                        </label>
                    </div>
                </div>
                <div class="row my-3">
                    <div class="col-md-4">
                        <label class="form-label">Birth Date :
                            <span class="font-weight-normal">{{$candidate->birth_date}}</span>
                        </label>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Birth Time :
                            <span class="font-weight-normal">{{$candidate->birth_time}}</span>
                        </label>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Birth Place :
                            <span class="font-weight-normal">{{$candidate->birth_place}}</span>
                        </label>
                    </div>
                </div>
                <div class="row my-3">
                    <div class="col-md-4">
                        <label class="form-label">Height :
                            <span class="font-weight-normal">{{$candidate->height}}</span>
                        </label>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Weight :
                            <span class="font-weight-normal">{{$candidate->weight}}</span>
                        </label>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Education :
                            <span class="font-weight-normal">{{$candidate->education}}</span>
                        </label>
                    </div>
                </div>
                <div class="row my-3">
                    <div class="col-md-6">
                        <label class="form-label">Occupation :
                            <span class="font-weight-normal">{{$candidate->occupation}}</span>
                        </label>
                    </div>
                </div>
                <hr class="modal-devider">
                <div class="row my-3">
                    <div class="col-md-4">
                        <label class="form-label">Father Name :
                            <span class="font-weight-normal">{{$candidate->father_name}}</span>
                        </label>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Father Occupation :
                            <span class="font-weight-normal">{{$candidate->father_occupation}}</span>
                        </label>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Father Contact :
                            <span class="font-weight-normal">{{$candidate->father_contact}}</span>
                        </label>
                    </div>
                </div>
                <div class="row my-3">
                    <div class="col-md-4">
                        <label class="form-label">Mother Name :
                            <span class="font-weight-normal">{{$candidate->mother_name}}</span>
                        </label>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Brothers :
                            <span class="font-weight-normal">{{$candidate->brothers}}</span>
                        </label>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Sisters :
                            <span class="font-weight-normal">{{$candidate->sisters}}</span>
                        </label>
                    </div>
                </div>
                <div class="row my-3">
                    <div class="col-md-6">
                        <label class="form-label">Mother Occupation :
                            <span class="font-weight-normal">{{$candidate->mother_occupation}}</span>
                        </label>
                    </div>
                </div>
                <hr class="modal-devider">
                <div class="row my-3">
                    <div class="col-md-6">
                        <label class="form-label">Email address :
                            <span class="font-weight-normal">{{$candidate->email}}</span>
                        </label>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Contact Number :
                            <span class="font-weight-normal">{{$candidate->contact}}</span>
                        </label>
                    </div>
                </div>
                <div class="row my-3">
                    <div class="col-md-6">
                        <label class="form-label">Resident Address :
                            <span class="font-weight-normal">{{$candidate->resident_address}}</span>
                        </label>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Native Address :
                            <span class="font-weight-normal">{{$candidate->native_address}}</span>
                        </label>
                    </div>
                </div>
                <hr class="modal-devider">
                <div class="row my-3">
                    <div class="col-md-6">
                        <label class="form-label">Maternal :
                            <span class="font-weight-normal">{{$candidate->maternal}}</span>
                        </label>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Maternal place :
                            <span class="font-weight-normal">{{$candidate->maternal_place}}</span>
                        </label>
                    </div>
                </div>
                <div class="row my-3">
                    <div class="col-md-6">
                        <label class="form-label">Hobbies :
                            <span class="font-weight-normal">{{$candidate->hobbies}}</span>
                        </label>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Expectations :
                            <span class="font-weight-normal">{{$candidate->expectations}}</span>
                        </label>
                    </div>
                </div>
                <div class="row my-3">
                    <div class="col-md-6">
                        <label class="form-label">Remark :
                            <span class="font-weight-normal">{{$candidate->remark}}</span>
                        </label>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Status :
                            <span class="font-weight-normal">{{$candidate->status}}</span>
                        </label>
                    </div>
                </div>
                <hr class="modal-devider">
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <a href="{{route('candidate.edit',$candidate)}}">
                <button type="button" class="btn btn-primary">Edit Details</button>
            </a>
        </div>
        </div>
    </div>
</div>
@endforeach
