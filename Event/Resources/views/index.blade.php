@extends('layouts.backend-master')
@section('menu')
Events
@stop
@section('content')
<div class="row">
	<div class="col-md-12">	
	<a href="{{url('/event/create')}}" class="btn btn-success">Add new Event</a>	
		<table class="table table-hover">
			<thead>
				<tr>
					<th>Title</th>
					<th>Date</th>
					<!-- <th>Time</th>
					<th>Address</th> -->
					<th>Venue</th>
					<th>Status</th>
					<th>Recurrence</th>
					<th>Recurrence Interval</th>
					<th>Action</th>
					<th>Add</th>
				</tr>
			</thead>
			<tbody>
			@foreach($events as $event)
				<tr>
					<td>{{$event['event_title']}}</td>
					<td>{{$event['start_date']}} <b>-to-</b> {{$event['end_date']}}</td>
					<!-- <td>{{$event['start_time']}} <b>-to-</b> {{$event['end_time']}}</td> -->
					<!-- <td>{{$event['address']}}</td> -->
					<td>{{$event['venue']}}</td>
					<td>{{$event['status']}}</td>					
					<td>{{$event['recurring']}}</td>					
					<td>{{$event['recurring_remarks']}}</td>					
					<td>
						<div class="btn-group">
							<a href="{{url('event/single-view/'.$event['id'])}}" type="button" class="btn btn-info btn-xs" data-toggle="tooltip" title="Delete Event"><span class="glyphicon glyphicon-eye-open"></span></a>

							<a href="{{url('event/edit/'.$event['id'])}}" type="button" class="btn btn-primary btn-xs" data-toggle="tooltip" title="Update Event info"><span class="glyphicon glyphicon-edit"></span></a>
							
							<a href="{{url('event/delete/'.$event['id'])}}" type="button" class="btn btn-danger btn-xs" data-toggle="tooltip" title="Delete Event"><span class="glyphicon glyphicon-remove"></span></a>
						</div>
					</td>
					<td>
						<div class="btn-group">
							<a href="{{url('event/add_participent/'.$event['id'].'/'.$event['client_id'])}}" type="button" class="btn btn-success btn-xs" data-toggle="tooltip" title="Delete Event"><span class="glyphicon glyphicon-eye-open"></span>   View Participent</a>
							<a href="{{url('event/add_image/'.$event['id'].'/'.$event['client_id'])}}" type="button" class="btn btn-primary btn-xs" data-toggle="tooltip" title="Delete Event"><span class="glyphicon glyphicon-user"></span>   Add Image</a>
							<a href="{{url('event/add_form/'.$event['id'].'/'.$event['client_id'])}}" type="button" class="btn btn-info btn-xs" data-toggle="tooltip" title="Delete Event"><span class="glyphicon glyphicon-cicle"></span>   Add Form</a>

						</div>
					</td>
						
					</tr>
			@endforeach
			</tbody>
		</table>		
	</div>
</div>
@stop