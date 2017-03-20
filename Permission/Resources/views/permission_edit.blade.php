@extends('layouts.backend-master')
@section('menu')
permission Edit
@stop
@section('content')
   <div class="row">

   	<div class="col-md-12 input">
   	<div class="panel panel-primary">
			<div class="panel-heading">Add New Group</div>
			<div class="panel-body" style="background-color: #f9f9f9;">
				<form method="post" action="{{url('permission/update/'.$permission['id'])}}" id="form1" name="form1">
			   		{!! csrf_field() !!}
					  <div class="form-group">
					    <label for="name">permission Name:</label>
					    <input type="text" class="form-control" name="name" id="name" value="{{$permission['name']}}" required>
					    @if ($errors->has('name'))
			               <span class="help-block" style="color: red;">
			                   <strong>{{ $errors->first('name') }}</strong>
			               </span>
			            @endif
					  </div>
					  
					  <button type="submit" class="btn btn-default">Submit</button>
				</form>
			</div>
		</div>
   		
   	</div>
</div>
@stop
