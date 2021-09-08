@foreach ($galleries as $gallery)
<div class="modal fade" id="Modal-{{$gallery->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    {{$gallery->event_title}}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <div class="modal-body">
            <div class="p-1">
                <div class="row my-3">
                    <div class="col-md-4">
                        <label class="form-label">Category :
                            <span class="font-weight-normal">{{$gallery->category}}</span>
                        </label>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Location :
                            <span class="font-weight-normal">{{$gallery->location}}</span>
                        </label>
                    </div>
                </div>
                <div class="row my-3">
                    <div class="col-md-12">
                        <label class="form-label">Description :
                            <span class="font-weight-normal">{{$gallery->description}}</span>
                        </label>
                    </div>
                </div>
                <hr class="modal-devider">
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <a href="{{route('gallery.edit',$gallery)}}">
                <button type="button" class="btn btn-primary">Edit Details</button>
            </a>
        </div>
        </div>
    </div>
</div>
@endforeach
