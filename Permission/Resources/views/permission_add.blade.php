@extends('layouts.backend-master')
@section('menu')
permission Add
@stop
@section('content')
   <div class="row">

   	<div class="col-md-12 input">
   	<div class="panel panel-primary">
			<div class="panel-heading">Add New Permission</div>
			<div class="panel-body" style="background-color: #f9f9f9;">
				<form method="post" action="{{url('permission/store')}}">
			   		{!! csrf_field() !!}
					  <div class="form-group">
					    <label for="name">Permission Name:</label>
					    <input type="text" class="form-control" name="name" id="name" value="{{old('name')}}" required>
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
