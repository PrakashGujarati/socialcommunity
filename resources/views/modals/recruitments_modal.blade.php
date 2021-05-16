@foreach ($recruitments as $recruitment)
<div class="modal fade" id="Modal-{{$recruitment->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    {{$recruitment->title}}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="p-1">
                    <div class="row my-3">
                        <div class="col-md-6">
                            <label class="form-label">Headline :
                                <span class="font-weight-normal">{{$recruitment->headline}}</span>
                            </label>
                        </div>
                    </div>
                    <div class="row my-3">
                        <div class="col-md-8">
                            <label class="form-label">Title :
                                <span class="font-weight-normal">{{$recruitment->title}}</span>
                            </label>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Category :
                                <span class="font-weight-normal">{{$recruitment->category}}</span>
                            </label>
                        </div>
                    </div>
                    <hr class="modal-devider">
                    <div class="row my-3">
                        <div class="col-md-12">
                            <label class="form-label">Description :<br>
                                <span class="font-weight-normal">{{$recruitment->description}}</span>
                            </label>
                        </div>
                    </div>
                    <hr class="modal-devider">
                    <div class="row my-3">
                        <div class="col-md-6">
                            <label class="form-label">Skills :
                                <span class="font-weight-normal">{{$recruitment->skills}}</span>
                            </label>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Education Qualification :
                                <span class="font-weight-normal">{{$recruitment->education_quailification}}</span>
                            </label>
                        </div>
                    </div>
                    <div class="row my-3">
                        <div class="col-md-6">
                            <label class="form-label">Reported datetime :
                                <span class="font-weight-normal">{{$recruitment->reported_datetime}}</span>
                            </label>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Reference Url :
                                <span class="font-weight-normal">{{$recruitment->reference_url}}</span>
                            </label>
                        </div>
                    </div>
                    <hr class="modal-devider">
                    <div class="row my-3">
                        <div class="col-md-6">
                            <label class="form-label">Status :
                                <span class="font-weight-normal">{{$recruitment->status}}</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <a href="{{route('recruitment.edit',$recruitment)}}">
                    <button type="button" class="btn btn-primary">Edit Recruitment</button>
                </a>
            </div>
        </div>
    </div>
</div>
@endforeach
