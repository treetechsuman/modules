@extends('layouts.backend-master')
@section('menu')
permission View
@stop
@section('content')
<div class="row">

   <div class="col-md-12">
   		<a type="button" href="{{url('permission/create')}}" class="btn btn-success pull-right">Add New permission </a>
   		<table class="table table-bordered" style="background-color: #f9f9f9;">
			<thead>
			    <tr>
			        <th>Permission Name</th>
			    </tr>
			    </thead>
			    <tbody>
			    @foreach($permissions as $permission)
			    
				<tr>
			      	<td>{{$permission['name']}}</td>
			       
			        <td width="100">
			        	
			        	<a href="{{url('/permission/delete/'.$permission['id'])}}" type="button" class="btn btn-danger btn-xs pull-right"><span class="glyphicon glyphicon-trash"></span></a>
			        	<a href="{{url('/permission/edit/'.$permission['id'])}}" type="button" class="btn btn-primary btn-xs pull-right"><span class="glyphicon glyphicon-edit"></span></a>
					</td>
		        </tr>
				@endforeach
		    </tbody>
		</table>
   </div>
</div>
@stop