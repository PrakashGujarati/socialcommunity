@extends('layouts.backend')

@section('css_before')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<style>
table {
    table-layout:fixed;
}

label.error {
         color: #dc3545;
         
    }

td{
    overflow:hidden;    
    text-overflow: ellipsis;
    white-space: normal !important;
}
</style>
@endsection

@section('content')
    <!-- Page Content -->
    <div class="content">
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">Send Notification</h3>
                @if(session()->has('success'))
	        		<div class="row mb-3">
	        			<div class="col-lg-12">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
						        {{ session()->get('success') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
						    </div>
						</div>
					</div>
				@endif
            </div>
            <div class="block-content block-content-full p-5">
                <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data"  id="import_form" class="shadow rounded p-5">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-lg-8">
                            <label class="form-label">Table Name</label>
                            <div class="form-control-wrap">
                                <select name="type" class="form-control" id="table_data"  value="">
								<option value="0">-- Select Table --</option>		                            
		                        <option value="Birthday">Birthday</option>
                                <option value="Business">Business</option>
                                <option value="Contacts">Contacts</option>
                                <option value="Educations">Educations</option>
                                <option value="Employess">Employess</option>
                                <option value="Lates">Lates</option>
                                <option value="Candidate">Candidate</option>
		                        <option value="Anniversary">Anniversary</option>       
                                </select>
                                
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-row">
                       
                    <div class="form-group col-lg-4">
			                <label class="form-label">Select data</label>
		                    <input type="file" name="file" id="file" class="form-control" value=""> 
		                    <div class="form-control-wrap">
		                        
		                    </div>
		            </div>
		                <div class="form-group col-lg-4">
		                	
		                </div>
                   
                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-primary my-5 mx-3">Import Data</button>
                            
                        </div>
                </form>
            </div>
        </div>
    </>
    <!-- END Page Content -->
@endsection
@section('js_after')

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
<script type="text/javascript">

	
</script>

@endsection