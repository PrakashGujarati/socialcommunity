@foreach ($businesses as $business)
<div class="modal fade" id="Modal-{{$business->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    {{$business->first_name.' '.$business->middle_name.' '.$business->last_name}}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="p-1">
                    <div class="row">
                        <div class="col-md-12">
                            <label class="form-label">Full Name :
                                <span class="font-weight-normal">{{$business->first_name.' '.$business->middle_name.' '.$business->last_name}}</span>
                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label class="form-label">Company :
                                <span class="font-weight-normal">{{$business->company}}</span>
                            </label>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Category :
                                <span class="font-weight-normal">{{$business->category}}</span>
                            </label>
                        </div>
                    </div>
                    <hr class="modal-devider">
                    <div class="row">
                        <div class="col-md-12">
                            <label class="form-label">Description :
                                <span class="font-weight-normal">{{$business->description}}</span>
                            </label>
                        </div>
                    </div>
                    <hr class="modal-devider">
                    <div class="row d-flex">
                        <div class="col-md-6">
                            <label class="form-label">Contact Number :
                                <span class="font-weight-normal">{{$business->contact}}</span>
                            </label>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Email :
                                <span class="font-weight-normal">{{$business->email}}</span>
                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label class="form-label">Address :
                                <span class="font-weight-normal">{{$business->address}}</span>
                            </label>
                        </div>
                    </div>
                    <hr class="modal-devider">
                    <div class="row">
                        <div class="col-md-6">
                            <label class="form-label">Status :
                                <span class="font-weight-normal">{{$business->status}}</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <a href="{{route('business.edit',$business)}}">
                    <button type="button" class="btn btn-primary">Edit Details</button>
                </a>
            </div>
        </div>
    </div>
</div>
@endforeach
