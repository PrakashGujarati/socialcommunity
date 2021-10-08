@foreach ($contacts as $contact)
<div class="modal fade" id="Modal-{{$contact->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    {{$contact->name}}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="p-1">
                    <div class="row">
                        <div class="col-md-12">
                            <label class="form-label">Name :
                                <span class="font-weight-normal">{{$contact->name}}</span>
                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label class="form-label">Mobile :
                                <span class="font-weight-normal">{{$contact->mobile}}</span>
                            </label>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Email :
                                <span class="font-weight-normal">{{$contact->email}}</span>
                            </label>
                        </div>
                    </div>
                    <hr class="modal-devider">
                    <div class="row">
                        <div class="col-md-12">
                            <label class="form-label">Designation :
                                <span class="font-weight-normal">{{$contact->designation}}</span>
                            </label>
                        </div>
                    </div>
                    <hr class="modal-devider">
                    <div class="row">
                        <div class="col-md-6">
                            <label class="form-label">Status :
                                <span class="font-weight-normal">{{$contact->status}}</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <a href="{{route('contact.edit',$contact)}}">
                    <button type="button" class="btn btn-primary">Edit Details</button>
                </a>
            </div>
        </div>
    </div>
</div>
@endforeach
