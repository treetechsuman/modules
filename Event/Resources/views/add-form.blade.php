@extends('layouts.backend-master')
@section('menu')
Assign Form
@stop
@section('content')

<div class="row">
	<div class="col-md-4">
	<form method="post" action="{{url('event/assign_form')}}">
	{{csrf_field()}}
		<select name="form_id" class="form-control">
		@foreach($forms as $form)
			<option value="{{$form['id']}}">{{$form['title']}}</option>
		@endforeach
		</select>
		<input type="hidden" name="client_id" value="{{$client_id}}">
		<input type="hidden" name="event_id" value="{{$event_id}}">
		<button type="submit" class="btn btn-default" value="">Submit</button>
	</form>
	</div>

	<div class="col-md-8">
		<table class="table table-hover">
			<thead>
				<tr>
					<th>Event ID</th>
					<th>Form ID</th>
					<th>Status</th>
					<th>Change Status</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
			@foreach($myForms as $form)
				<tr>
					<td>{{$form['event_id']}}</td>
					<td>{{$form['form_id']}}</td>
					<td>{{$form['status']}}</td>
					<td>
						<form class="change_status" action="{{url('event/change_status_of_assigned_form')}}" method="post">
							<input type="hidden" name="id" value="{{$form['id']}}">
							{{csrf_field()}}
							@if($form['status'] == 'active')
								<input type="checkbox" name="check" class="check" checked> This is Active
							@endif
							@if($form['status'] == 'inactive')
								<input type="checkbox" name="check" class="check">
							@endif
						</form>
					</td>									
					<td>
						<div class="btn-group">
							<a href="{{url('form/submitted-from-value/'.$form['form_id'])}}" type="button" class="btn btn-info btn-xs" data-toggle="tooltip" title="Form value"><span class="glyphicon glyphicon-eye-open"></span></a>
							<a href="{{url('event/delete_form/'.$form['id'])}}" type="button" class="btn btn-danger btn-sm" data-toggle="tooltip" title="Delete Event"><span class="glyphicon glyphicon-remove"></span></a>


						</div>
					</td>
				</tr>
			@endforeach
			</tbody>
		</table>
	</div>
</div>
<script>
	$(document).on('change','.check',function(){
		$(this).parent().submit();
	})
</script>
@stop