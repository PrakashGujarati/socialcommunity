@extends('frontend.main')
@section('page_head')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
@endsection
@section('content')

<div class="container pt-5 pb-5">
	<div class="row">
		
		<div class="col-md-10">
			
		<table class="table table-bordered data-table" id="data-table">
        <thead>
            <tr>
                <!-- <th>No</th> -->
                <th>Name</th>
                <th>Address</th>
				<th>Marital Status</th>
				<th>Organization and Address</th>
				<th>Department Name</th>
				<th>Destination</th>
				<th>Type of Service</th>
				<th width="100px">Mobile</th>
				
            </tr>
        </thead>
        <tbody>
			</tbody>
		</table>
		<button type="button" class="btn btn-submit btn-lg">Submit Your Details</button>
	</div>
</div>
</div>
@endsection

@section('page_script')
<script type="text/javascript">
  $(function () {
    
    var table = $('#data-table').DataTable({
        processing: true,
        serverSide: true,
		scrollX: true,
        ajax: "{{route('employee_data.index')}}",
        columns: [
            
            {data: 'name', name: 'name'},
            {data: 'address', name: 'address'},			
            {data: 'marital_status', name: 'marital_status'},
			{data: 'organization_and_address', name: 'organization_and_address'},
			{data: 'department_name', name: 'department_name'},
			{data: 'destination', name: 'destination'},
			{data: 'type_of_service', name: 'type_of_service'},
			{data: 'mobile', name: 'mobile',orderable: false, searchable: false},
			
        ]
    });
    
  });
</script>
@endsection
	