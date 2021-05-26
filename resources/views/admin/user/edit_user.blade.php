@extends('layouts.admin')
@section('content')
        <div class="page-title col-sm-12">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h1 class="h3 m-0">Edit User</h1>
                </div>
                <div class="col-md-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit User</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="row">
                <div class="col-lg-12 col-md-4 mb-4">
                    <form class="box bg-white" method="POST" action="{{ route('admin.update_user') }}">
                    @csrf
                    <input type="hidden" name="update_id" value="{{ $user_details->id }}">
                        <div class="box-row flex-wrap">
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label>Full Name</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="full_name" autocomplete="off" value="{{ $user_details->full_name }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label> Date of Birth</label>
                                    <div class="input-group" id="edit_dob" data-target-input="nearest">
                                        <input type="text" name="dob" id="edit_dob_el" class="form-control datepicker datetimepicker-input" placeholder="Date of Birth" data-target="#edit_dob" data-toggle="datetimepicker"  value="{{ date('d-m-Y',strtotime($user_details->dob)) }}">
                                    </div>
                                </div>
                                    <!-- <div class="input-group">
                                        <input type="text" class="form-control datetimepicker-input" name="dob" value="{{ old('dob') }}" readonly="readonly"  id="dob" data-toggle="datetimepicker" data-target="#dob">
                                    </div> -->
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label>Email</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="email" value="{{ $user_details->email }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label>Mobile Number</label>
                                    <div class="input-group">
                                        <select name="country_code" class="form-control col-sm-3">
                                            @if(!$country_codes->isEmpty())
                                                @foreach($country_codes as $country_code)
                                                    <option
                                                    @if($country_code->phonecode==$user_details->country_code)
                                                        selected
                                                    @endif
                                                    value="{{ $country_code->phonecode }}">{{ $country_code->phonecode }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <input type="number" min="0" minlength="4" maxlength="12" class="form-control col-sm-9" id="mob_no" name="mob_no" autocomplete="off" value="{{ $user_details->mob_no }}">
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label>DOB</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="dob" value="{{ date('d-m-Y',strtotime($user_details->dob)) }}" readonly="readonly">
                                    </div>
                                </div>
                            </div> -->
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label>Gender</label>
                                    <div class="input-group">
                                        <select name="gender" class="form-control">
                                            <option
                                            @if($user_details->gender=="male")
                                                selected
                                            @endif
                                             value="male">Male</option>
                                            <option 
                                            @if($user_details->gender=="female")
                                                selected
                                            @endif
                                            value="female">Female</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 mb-3 text-center">
                                <a type="submit" href="{{ route('admin.list_user') }}" class="btn light">Cancel</a>
                                <button type="submit" class="btn">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
<script type="text/javascript">
$(function() {
  var dateFormat = "DD-MM-YYYY";
  var CurrDate = "<?php echo date('d-m-Y',strtotime($user_details->dob)); ?>";
  var MinDate = "01-06-2018";
  var MaxDate = "<?php echo date('d-m-Y'); ?>";
  
  dateCurr = moment(CurrDate, dateFormat);
  dateMin = moment(MinDate, dateFormat);
  dateMax = moment(MaxDate, dateFormat);
  
  $("#edit_dob").datetimepicker({
    format: dateFormat,
    date: dateCurr,
    maxDate: dateMax,
  });
});
</script>
@endsection