@extends('layouts.backend-master')
@section('menu')
{{$event['event_title']}}
@stop
@section('content')
<div class="row">
	<div class="col-md-12">	
		<table class="table table-hover">
			<thead>
				<tr>
					<th>Title</th>
					<th>Starts On</th>
					<th>Edns On</th>
					<th>Time</th>
					<th>Address</th>
					<th>Venue</th>
					<th>Status</th>
					<th>Recurrence</th>
					<th>Recurrence Interval</th>
					<th>Description</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>{{$event['event_title']}}</td>
					<td>{{$event['start_date']}}</td>
					<td>{{$event['end_date']}}</td>
					<td>{{$event['start_time']}} - {{$event['end_time']}}</td>
					<td>{{$event['address']}}</td>
					<td>{{$event['venue']}}</td>
					<td>{{$event['status']}}</td>					
					<td>{{$event['recurring']}}</td>					
					<td>{{$event['recurring_remarks']}}</td>					
					<td>{{$event['description']}}</td>					
					<td>
						<div class="btn-group">

							<a href="{{url('event/edit/'.$event['id'])}}" type="button" class="btn btn-primary btn-xs" data-toggle="tooltip" title="Update Event info"><span class="glyphicon glyphicon-edit"></span></a>
							
							<a href="{{url('event/delete/'.$event['id'])}}" type="button" class="btn btn-danger btn-xs" data-toggle="tooltip" title="Delete Event"><span class="glyphicon glyphicon-remove"></span></a>


						</div>
					</td>
						
					</tr>
			</tbody>
			</table>		
	</div>
</div>
@stop