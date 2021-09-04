@foreach ($lates as $late)
<div class="modal fade" id="Modal-{{$late->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    {{$late->first_name.' '.$late->middle_name.' '.$late->last_name}}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="p-1">
                    <div class="row my-3">
                        <div class="col-md-6">
                            <label class="form-label">Full Name :
                                <span class="font-weight-normal">
                                    {{$late->first_name.' '.$late->middle_name.' '.$late->last_name}}
                                </span>
                            </label>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Late Date :
                                <span class="font-weight-normal">
                                    {{$late->late_date}}
                                </span>
                            </label>
                        </div>
                    </div>
                    <div class="row my-3">
                        <div class="col-md-6">
                            <label class="form-label">Birth Date :
                                <span class="font-weight-normal">
                                    {{$late->birth_date}}
                                </span>
                            </label>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Contact :
                                <span class="font-weight-normal">
                                    {{$late->contact}}
                                </span>
                            </label>
                        </div>
                    </div>
                    <div class="row my-3">
                        <div class="col-md-6">
                            <label class="form-label">Gujarati Savant :
                                <span class="font-weight-normal">
                                    {{$late->gujarati_savant}}
                                </span>
                            </label>
                        </div>
                    </div>
                    <hr class="modal-devider">
                    <div class="row my-3">
                        <div class="col-md-12">
                            <label class="form-label">Shradhhanjali :<br><br>
                                <span class="font-weight-normal">
                                        {!! $late->shradhhanjali !!}
                                </span>
                            </label>
                        </div>
                    </div>
                    <hr class="modal-devider">
                    <div class="row my-3">
                        <div class="col-md-6">
                            <label class="form-label">Address :
                                <span class="font-weight-normal">
                                    {{$late->address}}
                                </span>
                            </label>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Notifications :
                                <span class="font-weight-normal">
                                    {{$late->notifications}}
                                </span>
                            </label>
                        </div>
                    </div>
                    <hr class="modal-devider">
                    <div class="row my-3">
                        <div class="col-md-6">
                            <label class="form-label">Status :
                                <span class="font-weight-normal">
                                    {{$late->status}}
                                </span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <a href="{{route('late.edit',$late)}}">
                    <button type="button" class="btn btn-primary">Edit Details</button>
                </a>
            </div>
        </div>
    </div>
</div>
@endforeach
