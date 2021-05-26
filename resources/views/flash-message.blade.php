
@if ($message = Session::get('add_event_success'))
    @php $route = Route::currentRouteName(); @endphp
    @if($route=="admin.upcoming_event")
    <script>
    swal({
    title: "",
    text: "Please add Tickets to event",
    icon: "warning",
    button: "Ok",
    closeOnClickOutside: false
    });
    </script>
    @endif
@endif

@if ($message = Session::get('success'))
      <script>
           var type='success';
           Lobibox.notify(type, {
           size: 'mini',
           title: type,
           msg: "{{$message}}"
            });
      </script>
@elseif($message = Session::get('error'))
      <script>
           var type='error';
           Lobibox.notify(type, {
           size: 'mini',
           title: type,
           msg: "{{$message}}"
            });
      </script>
@endif

<!-- @if ($message = Session::get('success'))
<div class="alert alert-success alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button> 
        <strong>{{ $message }}</strong>
</div>
@endif


@if ($message = Session::get('error'))
<div class="alert alert-danger alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button> 
        <strong>{{ $message }}</strong>
</div>
@endif -->

@if ($message = Session::get('warning'))
<div class="alert alert-warning alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button> 
    <strong>{{ $message }}</strong>
</div>
@endif

@if ($message = Session::get('info'))
<div class="alert alert-info alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button> 
    <strong>{{ $message }}</strong>
</div>
@endif

<!-- @if ($errors->any())
<div class="alert alert-danger">
    <button type="button" class="close" data-dismiss="alert">×</button>
        @foreach($errors->all() as $error)
            <strong><div>{{ $error }}</div></strong>
        @endforeach
</div>
@endif -->