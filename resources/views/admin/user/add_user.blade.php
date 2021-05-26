@extends('layouts.admin')
@section('content')
        <div class="page-title col-sm-12">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h1 class="h3 m-0">Add User</h1>
                </div>
                <div class="col-md-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Add User</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="row">
                <div class="col-lg-12 col-md-4 mb-4">
                    <form class="box bg-white" method="POST" action="{{ route('admin.store_user') }}">
                    @csrf
                        <div class="box-row flex-wrap">
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label>Full Name</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="full_name" autocomplete="off" value="{{ old('full_name') }}">
                                    </div>
                                    @if($errors->has('full_name'))
                                      <span class="error" style="color:red;font-size:15px">{{$errors->first('full_name')}}</span>
                                   @endif
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label> Date of Birth </label>
                                    <div class="input-group" id="dob" data-target-input="nearest">
                                        <input type="text" name="dob" class="form-control datepicker datetimepicker-input" value="{{ old('dob') }}" placeholder="Date of Birth" data-target="#dob" data-toggle="datetimepicker">
                                    </div>
                                    @if($errors->has('dob'))
                                      <span class="error" style="color:red;font-size:15px">{{$errors->first('dob')}}</span>
                                   @endif
                                </div>
                                    <!-- <div class="input-group">
                                        <input type="text" class="form-control datetimepicker-input" name="dob" value="{{ old('dob') }}" readonly="readonly"  id="dob" data-toggle="datetimepicker" data-target="#dob">
                                    </div> -->
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label>Email</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="email" value="{{ old('email') }}">
                                    </div>
                                    @if($errors->has('email'))
                                      <span class="error" style="color:red;font-size:15px">{{$errors->first('email')}}</span>
                                   @endif
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label>Country Code & Mobile Number</label>
                                    <div class="input-group">
                                        <select name="country_code" class="form-control col-sm-3">
                                            @if(!$country_codes->isEmpty())
                                                @foreach($country_codes as $country_code)
                                                    <option
                                                    @if(old('country_code')=='' && $country_code->phonecode=="+971")
                                                        selected
                                                    @elseif($country_code->phonecode==old('country_code'))
                                                        selected
                                                    @endif
                                                    value="{{ $country_code->phonecode }}">{{ $country_code->phonecode }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <input type="number" min="0" minlength="4" maxlength="12" class="form-control col-sm-9" id="mob_no" name="mob_no" autocomplete="off" value="{{ old('mob_no') }}">
                                    </div>
                                    @if($errors->has('country_code'))
                                      <span class="error" style="color:red;font-size:15px">{{$errors->first('country_code')}}</span>
                                   @endif
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label>Gender</label>
                                    <div class="input-group">
                                        <select name="gender" class="form-control">
                                            <option {{ old('gender') == 'male' ? "selected" : "" }} value="male">Male</option>
                                            <option {{ old('gender') == 'female' ? "selected" : "" }} value="female">Female</option>
                                        </select>
                                    </div>
                                    @if($errors->has('gender'))
                                      <span class="error" style="color:red;font-size:15px">{{$errors->first('gender')}}</span>
                                   @endif
                                </div>
                            </div>
                            <div class="col-md-12 mb-3 text-center">
                                <a href="{{ route('admin.list_user') }}" class="btn light">Cancel</a>
                                <button type="submit" class="btn">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
<script type="text/javascript">
$(function() {
  var dateFormat = "DD-MM-YYYY";
  var CurrDate = "<?php echo date('d-m-Y'); ?>";
  var MinDate = "01-06-2018";
  var MaxDate = "<?php echo date('d-m-Y'); ?>" ;
  
  dateCurr = moment(CurrDate, dateFormat);
  dateMin = moment(MinDate, dateFormat);
  dateMax = moment(MaxDate, dateFormat);
  
  $("#dob").datetimepicker({
    format: dateFormat,
    date: dateCurr,
    maxDate: dateMax,
  });
});
</script>
@endsection