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
                <form action="{{route('notification.store')}}" method="POST" enctype="multipart/form-data"  id="notification_form" class="shadow rounded p-5">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-lg-12">
                            <label class="form-label">Device Id</label>
                            <div class="form-control-wrap">
                                <select name="user_id[]" class="form-control" id="user_id" multiple="multiple" value="">
								<option value="0">-- Select All Users --</option>
		                            @foreach($userdata as $user)
		                            	@if($user->first_name )
		                                <option value="{{ $user->id }}">{{ $user->first_name }}</option>
		                                @endif
		                            @endforeach
                                </select>
                                @error('user_id')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-row">

                        <div class="form-group col-lg-4">
                            <label class="form-label">Title</label>
                            <input type="text" name="title" id="title" class="form-control" value=""> 
		                    <div class="form-control-wrap">
		                        @error('title')
		                            <span class="text-danger" role="alert">
		                                <strong>{{ $message }}</strong>
		                            </span>
		                        @enderror
		                    </div>
                        </div>
                    
                    

                        <div class="form-group col-lg-8">
                            <label class="form-label">Message</label>
                            <input type="text" name="message" id="message" class="form-control" value=""> 
		                    <div class="form-control-wrap">
		                        @error('message')
		                            <span class="text-danger" role="alert">
		                                <strong>{{ $message }}</strong>
		                            </span>
		                        @enderror
		                    </div>
                        </div>
                    </div>
                    <div class="form-row">
                       
                    <div class="form-group col-lg-4">
			                <label class="form-label">Select Image</label>
		                    <input type="file" name="image" id="file" class="form-control" value=""> 
		                    <div class="form-control-wrap">
		                        @error('file')
		                            <span class="text-danger" role="alert">
		                                <strong>{{ $message }}</strong>
		                            </span>
		                        @enderror
		                    </div>
		                </div>
		                <div class="form-group col-lg-4">
		                	<img id="thumbnail_preview" src="#" alt="your image" class="thumbnail mt-1" height="100" />
		                </div>
                   
                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-primary my-5 mx-3">Send Notification</button>
                        
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

	$(document).ready(function() {
       $("#user_id").select2({
            tags: true,
            tokenSeparators: [',', ' ']
        })
       $('#thumbnail_preview').css('display','none');
    });	

$(document).ready(function () {
    
    $('#notification_form').validate({
         rules: {
            user_id : "required",           
            title : "required",
            message : "required",	

        },
        messages: {
        	user_id : "Please select device id.",        	
        	title : "Please enter title.",
            message : "Please enter message.",
        },
    });
});

$("#file").change(function() {
    $('#thumbnail_preview').css('display','block');
  	readThumbnail(this);
});

function readThumbnail(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    
    reader.onload = function(e) {
      $('#thumbnail_preview').attr('src', e.target.result);
    }
    
    reader.readAsDataURL(input.files[0]); // convert to base64 string
  }
}

</script>

@endsection