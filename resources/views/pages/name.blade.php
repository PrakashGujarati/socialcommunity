@extends('layouts.backend')

@section('css_before')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css') }}">
@endsection
@section('css_after')
table {
  width: 100%;
}
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
        // Init full DataTable
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
                <a href="{{route('name.create')}}" class="btn btn-outline-primary m-2">
                    <i class="bi bi-plus-lg"></i> Create Name
                </a>
            </div>
            
            <div class="block-content block-content-full">
                <table class="table table-bordered table-striped table-vcenter js-dataTable">
                    <thead>
                        <tr class="text-center">
                            <th scope="col">Full Name</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @if(count($nams) > 0)
                                 @foreach($nams as $names)
                                            <tr>
                                              <td>{{$names->name}}</td>
                                              <td style="text-align:center">
                                                <a href="{{route('name.edit',$names->id)}}" class="btn btn-primary btn-shadow font-weight-bold mr-2">Edit</a>
                                                <a href="{{route('name.delete',$names->id)}}" data-route="{{route('name.delete',$names->id)}}" class="btn btn-danger btn-shadow font-weight-bold mr-2 deleteCustomer">Delete</a>
                                              </td> 
                                            </tr>
                                          @endforeach
                                          @else
                                          <tr><td colspan="8" align="center">No record found</td></tr>
                                           @endif
                      
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- END Page Content -->
@endsection