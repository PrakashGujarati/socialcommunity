 @foreach ($employees as $employee)
<div class="modal fade" id="Modal-{{$employee->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    {{$employee->first_name.' '.$employee->middle_name.' '.$employee->last_name}}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="p-1">
                    <div class="row my-3">
                        <div class="col-md-12">
                            <label class="form-label">Full Name :
                                <span class="font-weight-normal">{{$employee->first_name.' '.$employee->middle_name.' '.$employee->last_name}}</span>
                            </label>
                        </div>
                    </div>
                    <div class="row my-3">
                        <div class="col-md-6">
                            <label class="form-label">Office :
                                <span class="font-weight-normal">{{$employee->office}}</span>
                            </label>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Category :
                                <span class="font-weight-normal">{{$employee->category}}</span>
                            </label>
                        </div>
                    </div>
                    <hr class="modal-devider">
                    <div class="row my-3">
                        <div class="col-md-12">
                            <label class="form-label">Designation :
                                <span class="font-weight-normal">{{$employee->designation}}</span>
                            </label>
                        </div>
                    </div>
                    <hr class="modal-devider">
                    <div class="row my-3">
                        <div class="col-md-6">
                            <label class="form-label">Contact Number :
                                <span class="font-weight-normal">{{$employee->contact}}</span>
                            </label>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Email :
                                <span class="font-weight-normal">{{$employee->email}}</span>
                            </label>
                        </div>
                    </div>
                    <div class="row my-3">
                        <div class="col-md-12">
                            <label class="form-label">Address :
                                <span class="font-weight-normal">{{$employee->address}}</span>
                            </label>
                        </div>
                    </div>
                    <hr class="modal-devider">
                    <div class="row my-3">
                        <div class="col-md-6">
                            <label class="form-label">Status :
                                <span class="font-weight-normal">{{$employee->status}}</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <a href="{{route('employee.edit',$employee)}}">
                    <button type="button" class="btn btn-primary">Edit Employee</button>
                </a>
            </div>
        </div>
    </div>
</div>
@endforeach
