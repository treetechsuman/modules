@extends('layouts.backend-master')
@section('menu')
Events
@stop
@section('content')
<div class="row staff">
	<h4>Staff</h4>
	
	<div class="col-md-4 form" >
		<form class="form-horizontal" action="{{url('event/store_participent')}}" method="post">
		    {{csrf_field()}}
		      <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
		        <label class="control-label col-sm-4" for="name">Name:</label>
		        <div class="col-sm-8">
		          <input type="text" name="name" value="{{old('name')}}" class="form-control" id="name" placeholder="Enter Name" required="">
		          @if ($errors->has('name'))
		              <span class="help-block">
		                  <strong>{{ $errors->first('name') }}</strong>
		              </span>
		          @endif
		        </div>
		      </div>
		      <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
		        <label class="control-label col-sm-4" for="name">Address:</label>
		        <div class="col-sm-8">
		          <input type="text" name="address" value="{{old('address')}}" class="form-control" id="address" placeholder="Enter Address" required="">
		          @if ($errors->has('address'))
		              <span class="help-block">
		                  <strong>{{ $errors->first('address') }}</strong>
		              </span>
		          @endif
		        </div>
		      </div>
		      <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
		        <label class="control-label col-sm-4" for="address">Mobile:</label>
		        <div class="col-sm-8">
		          <input type="text" name="mobile" value="{{old('mobile')}}" class="form-control" id="mobile" placeholder="Enter Mobile No" required="">
		          @if ($errors->has('mobile'))
		              <span class="help-block">
		                  <strong>{{ $errors->first('mobile') }}</strong>
		              </span>
		          @endif
		        </div>
		      </div>
		      <div class="form-group{{ $errors->has('position') ? ' has-error' : '' }}">
		        <label class="control-label col-sm-4" for="position">Position:</label>
		        <div class="col-sm-8">
		              <div class="radio">
		                  <label><input type="radio" value="maneger" name="position">Maneger</label>
		                </div>
		                <div class="radio">
		                  <label><input type="radio" value="volunteer" name="position">Volunteer</label>
		                </div>
		                <div class="radio">
		                  <label><input type="radio" value="employee" name="position">Employee</label>
		            	</div>
		            	
		          @if ($errors->has('position'))
		              <span class="help-block">
		                  <strong>{{ $errors->first('position') }}</strong>
		              </span>
		          @endif
		        </div>
		      </div>
		      <input type="hidden" name="event_id" value="{{$event_id}}">
		      <input type="hidden" name="client_id" value="{{$client_id}}">
		      <input type="hidden" name="type" value="staff">
		      <div class="form-group">
		        <div class="col-sm-offset-2 col-sm-10">
		          <button type="submit" class="btn btn-success">Create</button>
		        </div>
		      </div>
      	</form>
	</div>
	<div class="col-md-8 ">
		<table class="table table-hover">
			<thead>
				<tr>
					<th>Name</th>
					<th>Position</th>
					<th>Address</th>
					<th>Mobile</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
			@foreach($participents as $participent)
				@if($participent['type']=='staff')
				<tr>
					<td>{{$participent['name']}}</td>
					<td>{{$participent['position']}}</td>
					<td>{{$participent['address']}}</td>
					<td>{{$participent['mobile']}}</td>									
					<td>
						<div class="btn-group">
							
							<a href="{{url('event/delete_participent/'.$participent['id'])}}" type="button" class="btn btn-danger btn-sm" data-toggle="tooltip" title="Delete Event"><span class="glyphicon glyphicon-remove"></span></a>


						</div>
					</td>
					
					</tr>
				@endif
			@endforeach
			</tbody>
		</table>	
	</div>
</div>

<div class="row participent">
	<h4>Participent</h4>
	
	<div class="col-md-4 form">
		<form class="form-horizontal" action="{{url('event/store_participent')}}" method="post">
		    {{csrf_field()}}
		      <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
		        <label class="control-label col-sm-4" for="name">Name:</label>
		        <div class="col-sm-8">
		          <input type="text" name="name" value="{{old('name')}}" class="form-control" id="name" placeholder="Enter Name" required="">
		          @if ($errors->has('name'))
		              <span class="help-block">
		                  <strong>{{ $errors->first('name') }}</strong>
		              </span>
		          @endif
		        </div>
		      </div>
		      <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
		        <label class="control-label col-sm-4" for="name">Address:</label>
		        <div class="col-sm-8">
		          <input type="text" name="address" value="{{old('address')}}" class="form-control" id="address" placeholder="Enter Address" required="">
		          @if ($errors->has('address'))
		              <span class="help-block">
		                  <strong>{{ $errors->first('address') }}</strong>
		              </span>
		          @endif
		        </div>
		      </div>
		      <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
		        <label class="control-label col-sm-4" for="address">Mobile:</label>
		        <div class="col-sm-8">
		          <input type="text" name="mobile" value="{{old('mobile')}}" class="form-control" id="mobile" placeholder="Enter Mobile No" required="">
		          @if ($errors->has('mobile'))
		              <span class="help-block">
		                  <strong>{{ $errors->first('mobile') }}</strong>
		              </span>
		          @endif
		        </div>
		      </div>
		      <div class="form-group{{ $errors->has('position') ? ' has-error' : '' }}">
		        <label class="control-label col-sm-4" for="position">Position:</label>
		        <div class="col-sm-8">
		              <div class="radio">
		                  <label><input type="radio" value="organizer" name="position">Organizer</label>
		                </div>
		                <div class="radio">
		                  <label><input type="radio" value="attendees" name="position">Attendees</label>
		                </div>
		                <div class="radio">
		                  <label><input type="radio" value="partner" name="position">Partner</label>
		            	</div>
		            	<div class="radio">
		                  <label><input type="radio" value="broker" name="position">Broker</label>
		            	</div>
		          @if ($errors->has('position'))
		              <span class="help-block">
		                  <strong>{{ $errors->first('position') }}</strong>
		              </span>
		          @endif
		        </div>
		      </div>
		      <input type="hidden" name="event_id" value="{{$event_id}}">
		      <input type="hidden" name="client_id" value="{{$client_id}}">
		      <input type="hidden" name="type" value="participent">
		      <div class="form-group">
		        <div class="col-sm-offset-2 col-sm-10">
		          <button type="submit" class="btn btn-success">Create</button>
		        </div>
		      </div>
      	</form>
	</div>
	<div class="col-md-8">
		<table class="table table-hover">
			<thead>
				<tr>
					<th>Name</th>
					<th>Position</th>
					<th>Address</th>
					<th>Mobile</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
			@foreach($participents as $participent)
				@if($participent['type']=='participent')
				<tr>
					<td>{{$participent['name']}}</td>
					<td>{{$participent['position']}}</td>
					<td>{{$participent['address']}}</td>
					<td>{{$participent['mobile']}}</td>									
					<td>
						<div class="btn-group">
							<!-- <a href="{{url('event/single-view/')}}" type="button" class="btn btn-info btn-xs" data-toggle="tooltip" title="Delete Event"><span class="glyphicon glyphicon-eye-open"></span></a> -->

							<!-- <a href="{{url('event/edit/')}}" type="button" class="btn btn-primary btn-xs" data-toggle="tooltip" title="Update Event info"><span class="glyphicon glyphicon-edit"></span></a> -->
							
							<a href="{{url('event/delete_participent/'.$participent['id'].'/'.$participent['event_id'].'/'.$participent['client_id'])}}" type="button" class="btn btn-danger btn-sm" data-toggle="tooltip" title="Delete Event"><span class="glyphicon glyphicon-remove"></span></a>


						</div>
					</td>
					
					</tr>
				@endif
			@endforeach
			</tbody>
		</table>	
	</div>
</div>
@stop