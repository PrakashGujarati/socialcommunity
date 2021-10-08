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
                <h3 class="block-title">Dynamic Table <small>Birthdays</small></h3>
                <a href="{{route('birthday.create')}}" class="btn btn-outline-primary m-2">
                    <i class="bi bi-plus-lg"></i> Create Birthdays
                </a>
            </div>
            @include('modals.birthdays_modal')
            <div class="block-content block-content-full">
                <table class="table table-responsive table-bordered table-striped table-vcenter js-dataTable-full">
                    <thead>
                        <tr class="text-center">
                            <th scope="col">Name</th>
                            <th scope="col">Birth Date</th>
                            <th scope="col">Time</th>
                            <th scope="col">Place</th>
                            <th scope="col">Picture</th>
                            <th scope="col">Wishes</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($birthdays as $birthday)
                        <tr class="text-center">
                            <td>{{$birthday->name}}</td>
                            <td>{{$birthday->birthdate}}</td>
                            <td>{{$birthday->time}}</td>
                            <td>{{$birthday->place}}</td>
                            <td>
                                @if($birthday->picture)
                                    <img class="border rounded" src="{{url($birthday->picture)}}" height="60">
                                @else
                                    <img class="border rounded" src="https://e7.pngegg.com/pngimages/456/700/png-clipart-computer-icons-avatar-user-profile-avatar-heroes-logo.png" height="60">
                                @endif
                            </td>
                            <td>{{$birthday->wishes}}</td>
                            <td>{{$birthday->status}}</td>
                            <td>
                                <div class="d-flex">
                                    <button type="button" class="btn btn-default mx-1" data-toggle="modal" data-target="#Modal-{{$birthday->id}}">
                                        <i class="bi bi-aspect-ratio"></i>
                                    </button>
                                    <a href="{{route('birthday.edit',$birthday)}}" class="btn btn-default mx-1">
                                        <i class="bi bi-pencil text-info"></i>
                                    </a>
                                    <form action="{{route('birthday.destroy',$birthday)}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-default mx-1">
                                            <i class="fas fa-trash-alt text-danger"></i>
                                        </button>
                                    </form>
                                    <form action="{{route('changeStatus','Birthday')}}" method="post">
                                        @csrf
                                        <input type="hidden" name="id" value="{{$birthday->id}}">
                                        @if($birthday->status == "Active")
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
