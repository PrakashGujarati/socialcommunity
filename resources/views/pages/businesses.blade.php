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
                <h3 class="block-title">Dynamic Table <small>Persons</small></h3>
                <a href="{{route('business.create')}}" class="btn btn-outline-primary m-2">
                    <i class="bi bi-plus-lg"></i> Create Business
                </a>
            </div>
            @include('modals.businesses_modal')
            <div class="block-content block-content-full">
                <table class="table table-responsive table-bordered table-striped table-vcenter js-dataTable-full">
                    <thead>
                        <tr class="text-center">
                            <th scope="col">User Id</th>
                            <th scope="col">Full Name</th>
                            <th scope="col">Company</th>
                            <th scope="col">Contact</th>
                            <th scope="col">Logo</th>
                            <th scope="col">Visiting Card</th>
                            <th scope="col">Status</th>
                            <th scope="col">Done By</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($businesses as $business)
                        <tr class="text-center">
                            <td>{{$business->user_id}}</td>
                            <td>{{$business->first_name.' '.$business->middle_name.' '.$business->last_name}}</td>
                            <td>{{$business->company}}</td>
                            <td>{{$business->contact}}</td>
                            <td>
                                @if($business->logo)
                                    <img class="border rounded" src="{{asset('business_logo/'.$business->logo)}}" height="60">
                                @else
                                    <img class="border rounded" src="https://donatepoints.aircanada.com/img/no_image_available.jpg" height="60">
                                @endif
                            </td>
                            <td>
                                @if($business->visitingcard)
                                    <img class="border rounded" src="{{asset('visiting_card/'.$business->visitingcard)}}" height="60">
                                @else
                                    <img class="border rounded" src="https://donatepoints.aircanada.com/img/no_image_available.jpg" height="60">
                                @endif
                            </td>
                            <td>{{$business->status}}</td>
                            <td>{{$business->done_by}}</td>
                            <td>
                                <div class="d-flex">
                                    <button type="button" class="btn btn-info mx-1" data-toggle="modal" data-target="#Modal-{{$business->id}}">
                                        <i class="bi bi-aspect-ratio"></i>
                                    </button>
                                    <a href="{{route('business.edit',$business)}}" class="btn btn-primary mx-1">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{route('business.destroy',$business)}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger mx-1">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
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
