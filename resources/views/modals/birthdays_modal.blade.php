@foreach ($birthdays as $birthday)
<div class="modal fade" id="Modal-{{$birthday->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    {{$birthday->name}}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="p-1">
                    <div class="row">
                        <div class="col-md-6">
                            <label class="form-label">Name :
                                <span class="font-weight-normal">{{$birthday->name}}</span>
                            </label>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Birth Date :
                                <span class="font-weight-normal">{{$birthday->birthdate}}</span>
                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label class="form-label">Birth Time :
                                <span class="font-weight-normal">{{$birthday->time}}</span>
                            </label>
                        </div>
                    </div>
                    <hr class="modal-devider">
                    <div class="row">
                        <div class="col-md-12">
                            <label class="form-label">Birth Place :
                                <span class="font-weight-normal">{{$birthday->place}}</span>
                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label class="form-label">Wishes :
                                <span class="font-weight-normal">{{$birthday->wishes}}</span>
                            </label>
                        </div>
                    </div>
                    <hr class="modal-devider">
                    <div class="row">
                        <div class="col-md-6">
                            <label class="form-label">Status :
                                <span class="font-weight-normal">{{$birthday->status}}</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <a href="{{route('birthday.edit',$birthday)}}">
                    <button type="button" class="btn btn-primary">Edit Details</button>
                </a>
            </div>
        </div>
    </div>
</div>
@endforeach
