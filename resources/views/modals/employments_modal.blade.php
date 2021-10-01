@foreach ($employments as $employment)
    <div class="modal fade" id="Modal-{{$employment->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        {{$employment->title}}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="p-1">
                        <div class="row my-12">
                            <div class="col-md-6">
                                <label class="form-label">Headline :
                                    <span class="font-weight-normal">{{$employment->headline}}</span>
                                </label>
                            </div>
                        </div>
                        <div class="row my-12">
                            <div class="col-md-8">
                                <label class="form-label">Title :
                                    <span class="font-weight-normal">{{$employment->title}}</span>
                                </label>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Category :
                                    <span class="font-weight-normal">{{$employment->category}}</span>
                                </label>
                            </div>
                        </div>
                        <hr class="modal-devider">
                        <div class="row my-3">
                            <div class="col-md-12">
                                <label class="form-label">Detail Report : <br>
                                    <span class="font-weight-normal">{{$employment->detail_report}}</span>
                                </label>
                            </div>
                        </div>
                        <hr class="modal-devider">
                        <div class="row my-3">
                            <div class="col-md-6">
                                <label class="form-label">Reported datetime :
                                    <span class="font-weight-normal">{{$employment->reported_datetime}}</span>
                                </label>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Reference :
                                    <span class="font-weight-normal">{{$employment->reference}}</span>
                                </label>
                            </div>
                        </div>
                        <hr class="modal-devider">
                        <div class="row my-3">
                            <div class="col-md-6">
                                <label class="form-label">Status :
                                    <span class="font-weight-normal">{{$employment->status}}</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <a href="{{route('employment.edit',$employment)}}">
                        <button type="button" class="btn btn-primary">Edit Employment</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endforeach
