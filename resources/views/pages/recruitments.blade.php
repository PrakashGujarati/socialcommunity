@extends('layouts.backend')

@section('css_before')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css') }}">
@endsection
@section('js_after')
    <!-- Page JS Plugins -->
    <script src="{{ asset('js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/buttons/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/buttons/buttons.print.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/buttons/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/buttons/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/buttons/buttons.colVis.min.js') }}"></script>

    <!-- Page JS Code -->
    <script src="{{ asset('js/pages/tables_datatables.js') }}"></script>
@endsection

@section('content')
    <!-- Page Content -->
    <div class="content">
        <!-- Dynamic Table Full -->
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">Dynamic Table <small>Recruitments</small></h3>
                <a href="{{route('recruitment.create')}}" class="btn btn-outline-primary m-2">
                    <i class="bi bi-plus-lg"></i> Create Recruitments
                </a>
            </div>
            @include('modals.recruitments_modal')
            <div class="block-content block-content-full">
                <table class="table table-responsive table-bordered table-striped table-vcenter js-dataTable-full">
                    <thead>
                        <tr class="text-center">
                            <th scope="col">Title</th>
                            <th scope="col">Skills</th>
                            <th scope="col">Reference Url</th>
                            <th scope="col">Reported Date-Time</th>
                            <th scope="col">Thumbnail</>
                            <th scope="col">Status</th>
                            <th scope="col">Done By</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($recruitments as $recruitment)
                        <tr class="text-center">
                            <td>{{$recruitment->title}}</td>
                            <td>{{$recruitment->skills}}</td>
                            <td>{{$recruitment->reference_url}}</td>
                            <td>{{$recruitment->reported_datetime}}</td>
                            <td>
                            @if($recruitment->thumbnail)
                                <img class="border rounded" src="{{asset('thumbnail/'.$recruitment->thumbnail)}}" height="60">
                            @else
                                <img class="border rounded" src="https://donatepoints.aircanada.com/img/no_image_available.jpg" height="60">
                            @endif
                            </td>
                            <td>{{$recruitment->status}}</td>
                            <td>{{$recruitment->done_by}}</td>
                            <td>
                                <div class="d-flex">
                                    <button type="button" class="btn btn-default mx-2" data-toggle="modal" data-target="#Modal-{{$recruitment->id}}">
                                        <i class="bi bi-aspect-ratio"></i>
                                    </button>
                                    <a href="{{route('recruitment.edit',$recruitment)}}" class="btn btn-default mx-2">
                                        <i class="bi bi-pencil text-info"></i>
                                    </a>
                                    <form action="{{route('recruitment.destroy',$recruitment)}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-default mx-2">
                                            <i class="far fa-trash-alt text-danger"></i>
                                        </button>
                                    </form>
                                    <form action="{{route('changeStatus','recruitment')}}" method="post">
                                        @csrf
                                        <input type="hidden" name="id" value="{{$recruitment->id}}">
                                        @if($recruitment->status == "Active")
                                        <button type="submit" class="btn btn-default mx-2" data-toggle="tooltip" title="click to Deactive">
                                            <i class="fas fa-eye-slash text-danger"></i>
                                        </button>
                                        @else
                                        <button type="submit" class="btn btn-default mx-2" data-toggle="tooltip" title="click to Active">
                                            <i class="fas fa-eye text-success"></i>
                                        </button>
                                        @endif
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- END Page Content -->
@endsection
