@extends('layouts.backend')

@section('css_before')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css') }}">

@endsection

@section('css_after')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/AlertifyJS/1.13.1/css/alertify.min.css ">
<style>
    .media-image{
        height:150px;
        width:150px;
        border:2px solid black;
        border-radius:50%;
    }
</style>
@endsection

@section('js_after')
    <!-- Page JS Plugins -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/AlertifyJS/1.13.1/alertify.min.js"></script>
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
        function removeMedia(id,divId){
            var mediaId = id;
            $.ajax({
                data : {
                    'id' : mediaId
                },
                url: "{{route('removeMediaImage')}}",
                type: "GET",
                success: function() {
                    $("#"+divId).remove();
                    alertify.set('notifier','position', 'top-center');
                    alertify.error("Media Removed..!");
                }
            });
        }
    </script>
@endsection

@section('content')
    <!-- Page Content -->
    <div class="content">
        <!-- Dynamic Table Full -->
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">Dynamic Table <small>Galleries</small></h3>
                <a href="{{route('gallery.create')}}" class="btn btn-outline-primary m-2">
                    <i class="bi bi-plus-lg"></i> Create Gallery
                </a>
            </div>
            @include('modals.gallery_modal')
            <div class="block-content block-content-full">
                <table class="table table-responsive table-bordered table-striped table-vcenter js-dataTable-full">
                    <thead>
                        <tr class="text-center">
                            <th scope="col">Id</th>
                            <th scope="col">category</th>
                            <th scope="col">Event Title</th>
                            <th scope="col">Location</th>
                            <th scope="col">Description</th>
                            <th scope="col">Date</th>
                            <th scope="col">Status</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($galleries as $gallery)
                        <tr class="text-center">
                            <td>{{$gallery->id}}</td>
                            <td>{{$gallery->category}}</td>
                            <td>{{$gallery->event_title}}</td>
                            <td>{{$gallery->location}}</td>
                            <td>{{$gallery->description}}</td>
                            <td>{{$gallery->date}}</td>
                            <td>{{$gallery->status}}</td>
                            <td>
                                <div class=" d-flex">
                                    <button type="button" class="btn btn-default mx-2" data-toggle="modal" data-target="#Modal-{{$gallery->id}}">
                                        <i class="bi bi-aspect-ratio"></i>
                                    </button>
                                    <a href="{{route('gallery.edit',$gallery)}}" class="btn btn-default mx-2">
                                        <i class="bi bi-pencil text-info"></i>
                                    </a>
                                    <form action="{{route('gallery.destroy',$gallery)}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-default mx-2">
                                            <i class="far fa-trash-alt text-danger"></i>
                                        </button>
                                    </form>
                                    <form action="{{route('changeStatus','gallery')}}" method="post">
                                        @csrf
                                        <input type="hidden" name="id" value="{{$gallery->id}}">
                                        @if($gallery->status == "Active")
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
