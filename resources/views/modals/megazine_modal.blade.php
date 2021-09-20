@foreach ($megazines as $megazine)
<div class="modal fade" id="Modal-{{$megazine->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    {{$megazine->title}}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <div class="modal-body">
            <div class="p-1">
                <div class="row my-3">
                    <div class="col-md-6">
                        <label class="form-label">Title :
                            <span class="font-weight-normal">{{$megazine->title}}</span>
                        </label>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Category :
                            <span class="font-weight-normal">{{$megazine->category}}</span>
                        </label>
                    </div>
                </div>
                <div class="row my-3">
                    <div class="col-md-6">
                        <label class="form-label">date :
                            <span class="font-weight-normal">{{$megazine->date}}</span>
                        </label>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Path :
                            <span class="font-weight-normal">{{$megazine->path}}</span>
                        </label>
                    </div>
                </div>
                <hr class="modal-devider">
                <div class="row my-3">
                    <div class="col-md-6">
                        <label class="form-label">Status :
                            <span class="font-weight-normal">{{$megazine->status}}</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <a href="{{route('megazine.edit',$megazine)}}">
                <button type="button" class="btn btn-primary">Edit Details</button>
            </a>
        </div>
        </div>
    </div>
</div>
@endforeach
