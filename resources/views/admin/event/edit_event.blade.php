@extends('layouts.admin')
@section('content')
        <div class="page-title col-sm-12">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h1 class="h3 m-0">Edit Event</h1>
                </div>
                <div class="col-md-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit Event</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="row">
                <div class="col-lg-12 col-md-4 mb-4">
                    <form class="box bg-white" method="POST" action="{{ route('admin.update_event') }}" enctype="multipart/form-data">
                    @csrf
                        <input type="hidden" name="update_id" value="{{ $event_details->id }}">
                        <div class="box-row flex-wrap">
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label>Event Name</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="event_name" autocomplete="off" value="{{ $event_details->event_name }}">
                                    </div>
                                    @if($errors->has('event_name'))
                                      <span class="error" style="color:red;font-size:15px">{{$errors->first('event_name')}}</span>
                                   @endif
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label>Venue Name</label>
                                    <div class="input-group">
                                        <select name="venue_id" id="venue_id" class="form-control">
                                            @if(!$venues->isEmpty())
                                                @foreach($venues as $venue)
                                                    <option
                                                    @if($venue->id==$event_details->venue_id)
                                                        selected
                                                    @endif
                                                     value="{{ $venue->id }}">{{ $venue->venue_name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    @if($errors->has('venue_id'))
                                       <span class="error" style="color:red;font-size:15px">{{$errors->first('venue_id')}}</span>
                                      @endif
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label>Category Name</label>
                                    <div class="input-group">
                                        <select name="category_id" id="category_id" class="form-control">
                                            @if(!$categories->isEmpty())
                                                @foreach($categories as $category)
                                                    <option
                                                        @if($category->id==$event_details->category_id)
                                                            selected
                                                        @endif
                                                    value="{{ $category->id }}">{{ $category->category_name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                        @if($errors->has('category_id'))
                                         <span class="error" style="color:red;font-size:15px">{{$errors->first('category_id')}}</span>
                                        @endif
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label> Event Date </label>
                                    <div class="input-group" id="edit_event_date" data-target-input="nearest">
                                        <input type="text" name="event_date" id="edit_event_date_el" class="form-control datepicker datetimepicker-input" placeholder="Event Date" data-target="#edit_event_date" data-toggle="datetimepicker">
                                    </div>
                                    @if($errors->has('event_date'))
                                      <span class="error" style="color:red;font-size:15px">{{$errors->first('event_date')}}</span>
                                   @endif
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label> Event Start Time </label>
                                    <div class="input-group" id="edit_event_time" data-target-input="nearest">
                                        <input type="text" name="event_time" id="event_time_el" class="form-control datepicker datetimepicker-input" placeholder="Event Time" data-target="#edit_event_time" data-toggle="datetimepicker" value="{{ $event_details->event_time }}">
                                    </div>
                                    @if($errors->has('event_time'))
                                      <span class="error" style="color:red;font-size:15px">{{$errors->first('event_time')}}</span>
                                   @endif
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label> Event End Time </label>
                                    <div class="input-group" id="event_end_time" data-target-input="nearest">
                                        <input type="text" name="event_end_time" id="event_end_time_el" class="form-control datepicker datetimepicker-input" placeholder="Event Time" data-target="#event_end_time" data-toggle="datetimepicker" value="{{ $event_details->event_end_time }}">
                                    </div>
                                    @if($errors->has('event_end_time'))
                                      <span class="error" style="color:red;font-size:15px">{{$errors->first('event_end_time')}}</span>
                                   @endif
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label>Artists</label>
                                    <div class="input-group">
                                        <select name="artist_id[]" class="js-example-basic-multiple form-control" multiple="multiple">
                                            @if(!$artists->isEmpty())
                                                @foreach($artists as $artist)
                                                    <option 
                                                        @if(in_array($artist->id,$event_artists))
                                                            selected
                                                        @endif
                                                    value="{{ $artist->id }}">{{ $artist->artist_name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                <label>Logo (Max. Allowed Size: 60px x 40px)</label>
                                    <div class="upload-btn">
                                        <input id="event_logo" type="file" name="event_logo">
                                        <label class="btn btn-primary" for="event_logo">Event Logo</label>
                                    </div>
                                    @if($errors->has('event_logo'))
                                      <span class="error" style="color:red;font-size:15px">{{$errors->first('event_logo')}}</span>
                                   @endif
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                <label>Header (Max. Allowed Size: 440px x 240px)</label>
                                    <div class="upload-btn">
                                        <input id="event_header_image" type="file" name="event_header_image">
                                        <label class="btn btn-primary" for="event_header_image">Event Header Image</label>
                                    </div>
                                    @if($errors->has('event_header_image'))
                                      <span class="error" style="color:red;font-size:15px">{{$errors->first('event_header_image')}}</span>
                                   @endif
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label>Organizer</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="organizer" autocomplete="off" value="{{ $event_details->organizer }}">
                                    </div>
                                    @if($errors->has('organizer'))
                                      <span class="error" style="color:red;font-size:15px">{{$errors->first('organizer')}}</span>
                                   @endif
                                </div>
                            </div>
                            <div class="col-md-12 mb-6">
                                <div class="form-group">
                                    <label>Description</label>
                                    <div class="input-group">
                                        <textarea class="form-control" name="description">{{ $event_details->description }}</textarea>
                                    </div>
                                    @if($errors->has('description'))
                                      <span class="error" style="color:red;font-size:15px">{{$errors->first('description')}}</span>
                                   @endif
                                </div>
                            </div>
                            <div class="col-md-12 mb-3 text-center">
                                <a href="{{ route('admin.upcoming_event') }}" class="btn light">Cancel</a>
                                <button type="submit" class="btn">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
<script type="text/javascript">
$(function() {
  var dateFormat = "DD-MM-YYYY";
  var CurrDate = "<?php echo date('d-m-Y',strtotime($event_details->event_date)); ?>";
  var MinDate = "<?php echo date('d-m-Y'); ?>";
  var MaxDate = "31-12-2050";
  
  dateCurr = moment(CurrDate, dateFormat);
  dateMin = moment(MinDate, dateFormat);
  dateMax = moment(MaxDate, dateFormat);
  
  $("#edit_event_date").datetimepicker({
    format: dateFormat,
    date: dateCurr,
    maxDate: dateMax,
  });
});
</script>
@endsection