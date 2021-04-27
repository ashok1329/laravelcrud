@extends('layouts.master')   
@section('title', 'User Details')
@section('header')
    @extends('layouts.header') 
@stop  
@section('content')

<div class="container">
    <div class="">
        <h1>User Details:---</h1>
    	<a href="{{ url('/register') }}"><button class="btn btn-success insrtbtn">Insert User</button></a>
    </div>
    @if (\Session::has('status'))
    <div class="alert alert-success msg" id="msg">
        <ul>
          <li>{!! \Session::get('status') !!}</li>
        </ul>
    </div>
    @endif
    <div class="msg"></div>
    <table class="table table-bordered data-table">
	    <thead>
	        <tr>
	           <th>No</th>
	            <th>Name</th>
	            <th>Email</th>
	            <th width="100px">Action</th>
	        </tr>
	    </thead>
    <tbody>
    </tbody>
	</table>
</div>
 <script type="text/javascript">
/* Yajra Data Table */
  	$(function () {
	    var table = $('.data-table').DataTable({
	        processing: true,
	        serverSide: true,
	        ajax: "/",
	        columns: [
		        {data: 'id', name: 'id'},
		        {data: 'name', name: 'name'},
		        {data: 'email', name: 'email'},
		     	{data: 'action', name: 'action', orderable: false, searchable: false},
	        ]
	    });
  	});
/* Message Time Out */
   	setTimeout(function(){
  		$('.msg').remove();
	}, 5000);
/* Delete User */
	$(document).on('click','.delete_user',function(){
  		var id=$(this).data("id");
	    $.ajaxSetup({
	        headers: {
	            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        }
	    });
		if(confirm("Are you sure you want to delete this?")){

    $.ajax(
    {
	    url: "delete/"+id,
	    type: 'get',
	    dataType: "JSON",
	    data: { "id": id },
	    success: function (response)
	    {
	      if(response.success == 'true'){
			$("#delete_"+id).fadeTo("slow",1.0, function(){
			$('#delete_'+id).closest("tr").remove();
			})
			$('.msg').append(response.msg);
	      }
	    },
	    error: function(xhr) {
	     console.log(xhr.responseText); // this line will save you tons of hours while debugging
	    // do something here because of error
	   }
    });
  }
});
 </script>
 @stop
 @section('footer')
    @extends('layouts.footer') 
 @stop 