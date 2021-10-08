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
    <script>
    jQuery('.js-dataTable').dataTable({
            pageLength: 5,
            lengthMenu: [[5, 10, 20], [5, 10, 20]],
            autoWidth: false,
            "columns": [
                {"width": "80%"},
                {"width": "20%"}
            ]  
        });
        </script>
@endsection

@section('content')
    <!-- Page Content -->
    <div class="content">
        <!-- Dynamic Table Full -->
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">Dynamic Table <small>Persons</small></h3>
                <a href="{{route('megazine.create')}}" class="btn btn-outline-primary m-2">
                    <i class="bi bi-plus-lg"></i> Create Megazines
                </a>
            </div>
            @include('modals.megazine_modal')
            <div class="block-content block-content-full">
                <table class="table table-responsive table-bordered table-striped table-vcenter js-dataTable-full">
                    <thead>
                        <tr class="text-center">
                            <th scope="col">Title </th>
                            <th scope="col">Category</th>
                            <th scope="col">Date</th>
                            <th scope="col">Path</th>
                            <th scope="col">status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($megazines as $megazine)
                        <tr class="text-center">
                            <td>{{$megazine->title}}</td>
                            <td>{{$megazine->category}}</td>
                            <td>{{$megazine->date}}</td>
                            <td>{{$megazine->path}}</td>
                            <td>{{$megazine->status}}</td>
                            <td>
                                <div class="d-flex">
                                    <button type="button" class="btn btn-default mx-2" data-toggle="modal" data-target="#Modal-{{$megazine->id}}">
                                        <i class="bi bi-aspect-ratio"></i>
                                    </button>
                                    <a href="{{route('megazine.edit',$megazine)}}" class="btn btn-default mx-2">
                                        <i class="bi bi-pencil text-info"></i>
                                    </a>
                                    <form action="{{route('megazine.destroy',$megazine)}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-default mx-2">
                                            <i class="far fa-trash-alt text-danger"></i>
                                        </button>
                                    </form>
                                    <form action="{{route('changeStatus','Megazine')}}" method="post">
                                        @csrf
                                        <input type="hidden" name="id" value="{{$megazine->id}}">
                                        @if($megazine->status == "Active")
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
