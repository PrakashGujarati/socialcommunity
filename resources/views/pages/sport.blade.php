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
                <a href="{{route('sport.create')}}" class="btn btn-outline-primary m-2">
                    <i class="bi bi-plus-lg"></i> Create Sports
                </a>
            </div>
            <div class="block-content block-content-full">
                <table class="table table-responsive table-bordered table-striped table-vcenter js-dataTable-full">
                    <thead>
                        <tr class="text-center">
                            <th scope="col">Headline</th>
                            <th scope="col">Title</th>
                            <th scope="col">Category</th>
                            <th scope="col">Detail_report</th>
                            <th scope="col">Thumbnail</th>
                            <th scope="col">News_image</th>
                            <th scope="col">Reported_datetime</th>
                            <th scope="col">Reference</th>
                            <th scope="col">Status</th>
                            <th scope="col">done_by</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($sports as $sport)
                        <tr class="text-center">
                            <td>{{$sport->headline}}</td>
                            <td>{{$sport->title}}</td>
                            <td>{{$sport->category}}</td>
                            <td>{{$sport->detail_report}}</td>
                            <td>
                                @if($sport->thumbnail)
                                    <img class="border rounded" src="{{asset('image/'.$sport->thumbnail)}}" height="60">
                                @else
                                    <img class="border rounded" src="https://donatepoints.aircanada.com/img/no_image_available.jpg" height="60">
                                @endif
                            </td>
                            <td>
                                @if($sport->news_image)
                                    <img class="border rounded" src="{{asset('news_images/'.$sport->news_image)}}" height="60">
                                @else
                                    <img class="border rounded" src="https://donatepoints.aircanada.com/img/no_image_available.jpg" height="60">
                                @endif
                            </td>
                            <td>{{$sport->reported_datetime}}</td>
                            <td>{{$sport->reference}}</td>
                            <td>{{$sport->status}}</td>
                            <td>{{$sport->done_by}}</td>
                            <td>
                            <div class="d-flex">
                            <a href="{{route('sport.edit',$sport)}}" class="btn btn-primary mx-2">
                                        <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{route('sport.destroy',$sport)}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger mx-2">
                                            <i class="bi bi-archive-fill"></i>
                                        </button>
                                    </form>
                            </td>  
                            <div>     
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- END Page Content -->
@endsection
