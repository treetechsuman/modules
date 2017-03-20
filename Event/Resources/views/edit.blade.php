@extends('layouts.backend-master')
@section('menu')
Update Event info
@stop
@section('content')
<div class="row">
  <div class="col-md-6">
    <form class="form-horizontal" action="{{url('event/update/'.$event['id'])}}" method="post">
    {{csrf_field()}}
      <div class="form-group{{ $errors->has('event_title') ? ' has-error' : '' }}">
        <label class="control-label col-sm-4" for="name">Title:</label>
        <div class="col-sm-8">
          <input type="text" name="event_title" value="{{$event['event_title']}}" class="form-control" id="event_title" placeholder="Enter event_title" required="">
          @if ($errors->has('event_title'))
              <span class="help-block">
                  <strong>{{ $errors->first('event_title') }}</strong>
              </span>
          @endif
        </div>
      </div>
      <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
        <label class="control-label col-sm-4" for="name">Description:</label>
        <div class="col-sm-8">
          <input type="text" name="description" value="{{$event['description']}}"  class="form-control" id="description" placeholder="Enter description" required="">
          @if ($errors->has('description'))
              <span class="help-block">
                  <strong>{{ $errors->first('description') }}</strong>
              </span>
          @endif
        </div>
      </div>
      <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
        <label class="control-label col-sm-4" for="address">Address:</label>
        <div class="col-sm-8">
          <input type="text" name="address" value="{{$event['address']}}"  class="form-control" id="address" placeholder="Enter address" required="">
          @if ($errors->has('address'))
              <span class="help-block">
                  <strong>{{ $errors->first('address') }}</strong>
              </span>
          @endif
        </div>
      </div>
      <div class="form-group{{ $errors->has('venue') ? ' has-error' : '' }}">
        <label class="control-label col-sm-4" for="venue">Venue:</label>
        <div class="col-sm-8">
          <input type="text" name="venue" value="{{$event['venue']}}"  class="form-control" id="venue" placeholder="Enter venue" required="">
          @if ($errors->has('venue'))
              <span class="help-block">
                  <strong>{{ $errors->first('venue') }}</strong>
              </span>
          @endif

        </div>
      </div>
      <div class="form-group{{ $errors->has('start_date') ? ' has-error' : '' }}">
        <label class="control-label col-sm-4" for="start_date">Starts From:</label>
        <div class="col-sm-8">
          <input type="date" name="start_date" value="{{$event['start_date']}}"  class="form-control" id="start_date" placeholder="Enter start_date">
          @if ($errors->has('start_date'))
              <span class="help-block">
                  <strong>{{ $errors->first('start_date') }}</strong>
              </span>
          @endif

        </div>
      </div>
      <div class="form-group{{ $errors->has('end_date') ? ' has-error' : '' }}">
        <label class="control-label col-sm-4" for="end_date">Ends On:</label>
        <div class="col-sm-8">
          <input type="date" name="end_date" value="{{$event['end_date']}}"  class="form-control" id="end_date" placeholder="Enter end_date">
          @if ($errors->has('end_date'))
              <span class="help-block">
                  <strong>{{ $errors->first('end_date') }}</strong>
              </span>
          @endif
        </div>
      </div>

      <div class="form-group{{ $errors->has('start_time') ? ' has-error' : '' }}">
        <label class="control-label col-sm-4" for="start_time">Start At:</label>
        <div class="col-sm-8">
          <input type="text" name="start_time" value="{{$event['start_time']}}" class="form-control" id="start_time" placeholder="Enter Start Time">
          @if ($errors->has('start_time'))
              <span class="help-block">
                  <strong>{{ $errors->first('start_time') }}</strong>
              </span>
          @endif
        </div>
      </div>
      <div class="form-group{{ $errors->has('end_time') ? ' has-error' : '' }}">
        <label class="control-label col-sm-4" for="end_time">Ends At:</label>
        <div class="col-sm-8">
          <input type="text" name="end_time" value="{{$event['end_time']}}" class="form-control" id="end_time" placeholder="Enter End Time">
          @if ($errors->has('end_time'))
              <span class="help-block">
                  <strong>{{ $errors->first('end_time') }}</strong>
              </span>
          @endif
        </div>
      </div>
      <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
        <label class="control-label col-sm-4" for="status">Status:</label>
        <?php 
        //echo $event['status'];
          $option1 = '';
          $option2 = '';
          $option3 = '';
          if($event['status']=='upcomming'){
            $option1 = 'checked';
          }elseif($event['status']=='running'){
            $option2 = 'checked';
          }elseif($event['status']=='finished'){
            $option3 = 'checked';
          }else{}
         ?>
        <div class="col-sm-8">
              <div class="radio">
                  <label><input type="radio" value="upcomming" name="status" <?php echo $option1; ?>>Upcomming</label>
                </div>
                <div class="radio">
                  <label><input type="radio" value="running" name="status" <?php echo $option2; ?>>Running</label>
                </div>
                <div class="radio">
                  <label><input type="radio" value="finished" name="status" <?php echo $option3; ?>>Finished</label>
            </div>
          @if ($errors->has('status'))
              <span class="help-block">
                  <strong>{{ $errors->first('status') }}</strong>
              </span>
          @endif
        </div>
      </div>
      <div class="form-group{{ $errors->has('recurring') ? ' has-error' : '' }}">
        <label class="control-label col-sm-4" for="recurring">Recurrence:</label>
        <?php 
        //echo $event['recurring'];
          $option1 = '';
          $option2 = '';
          if($event['recurring']=='yes'){
            $option1 = 'checked';
          }elseif($event['recurring']=='no'){
            $option2 = 'checked';
          }else{}
         ?>
        <div class="col-sm-8">
              <div class="radio">
                  <label><input type="radio" value="yes" name="recurring" <?php echo $option1; ?>>Yes</label>
                </div>
                <div class="radio">
                  <label><input type="radio" value="no" name="recurring" <?php echo $option2; ?>>No</label>
                </div>
          @if ($errors->has('recurring'))
              <span class="help-block">
                  <strong>{{ $errors->first('recurring') }}</strong>
              </span>
          @endif
        </div>
      </div>
     <div class="form-group{{ $errors->has('recurring_remarks') ? ' has-error' : '' }}">
        <label class="control-label col-sm-4" for="recurring_remarks">Recurrence Remarks:</label>
        <div class="col-sm-8">
          <input type="text" name="recurring_remarks" value="{{$event['recurring_remarks']}}" class="form-control" id="recurring_remarks" placeholder="Enter Interval">
          @if ($errors->has('recurring_remarks'))
              <span class="help-block">
                  <strong>{{ $errors->first('recurring_remarks') }}</strong>
              </span>
          @endif
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <button type="submit" class="btn btn-success">Update</button>
        </div>
      </div>
    </form>
  </div>
  
</div>

@stop