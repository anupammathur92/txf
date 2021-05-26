<script type="text/javascript">
  let autocomplete;
  function initAutocomplete(){
    autocomplete = new google.maps.places.Autocomplete(
      document.getElementById('venue_address'),{
        fields: ["address_components", "geometry", "icon", "name"]
      });
  }
</script>
<script async
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD0lEWnbKTRtwlCkw9ZmkFYsZTGxkJ4juU&libraries=places&callback=initAutocomplete&fields=geometry">
</script>
    <script type="text/javascript">
function setArtistPopularity(artist_id,popularity_val){
    if(artist_id!='' && popularity_val!=''){
        $.ajax({
            url: "{{ route('admin.update_artist_popularity') }}",
            method: "POST",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: { artist_id:artist_id,popularity_val:popularity_val },
            success: function(resp){
                if(resp.response=="fail"){
                    alert(resp.message);
                }else{
                    alert(resp.message);
                    window.location.reload();
                }
            },
            error: function(){
                alert('erro');
            }
        });
    }else{
        alert("Something went wrong");
    }
}
$(function() {
    var dateFormat = "DD-MM-YYYY";
    var CurrDate = "<?php if(old('dob') && old('dob')!=''){ echo date('d-m-Y',strtotime(old('dob'))); }else{ echo date('d-m-Y'); } ?>";
    var MinDate = "01-06-2018";
    var MaxDate = "<?php echo date('d-m-Y'); ?>" ;

    dateCurr = moment(CurrDate, dateFormat);
    var day = new Date(dateCurr);
    var nextDay = new Date(day);
    nextDay.setDate(day.getDate() + 1);
    datenext = moment(nextDay, dateFormat);
    dateMin = moment(MinDate, dateFormat);
    dateMax = moment(MaxDate, dateFormat);

    $("#dob").datetimepicker({
        format: dateFormat,
        date: dateCurr,
        maxDate: dateMax,
    });

    var event_date_MinDate = "<?php echo date('d-m-Y'); ?>";
    var event_date_MaxDate =  "31-12-2050";

    event_date_dateMin = moment(event_date_MinDate, dateFormat);
    event_date_dateMax = moment(event_date_MaxDate, dateFormat);

    $("#event_date").datetimepicker({
        format: dateFormat,
        date: datenext,
        minDate: datenext,
        maxDate: event_date_dateMax,
    });

    $("#event_time").datetimepicker({
        format: 'HH:mm'
    });
    $("#event_end_time").datetimepicker({
        format: 'HH:mm'
    });
    $("#edit_event_time").datetimepicker({
        format: 'HH:mm'
    });
});

window.onload = () => {
    const dob = document.getElementById('dob');
    dob.onpaste = e => e.preventDefault();
}
window.onload = () => {
    const edit_dob = document.getElementById('edit_dob');
    edit_dob.onpaste = e => e.preventDefault();
}
window.onload = () => {
    const event_date = document.getElementById('event_date');
    event_date.onpaste = e => e.preventDefault();
}
window.onload = () => {
    const event_time = document.getElementById('event_time');
    event_time.onpaste = e => e.preventDefault();
}
window.onload = () => {
    const event_time = document.getElementById('event_end_time');
    event_time.onpaste = e => e.preventDefault();
}
window.onload = () => {
    const edit_event_date = document.getElementById('edit_event_date');
    edit_event_date.onpaste = e => e.preventDefault();
}
window.onload = () => {
    const edit_event_time = document.getElementById('edit_event_time');
    edit_event_time.onpaste = e => e.preventDefault();
}

$("#dob").keypress(function(event) {event.preventDefault();});
$("#edit_dob").keypress(function(event) {event.preventDefault();});
$("#event_date").keypress(function(event) {event.preventDefault();});
$("#event_date_el").keypress(function(event) {event.preventDefault();});
$("#event_time_el").keypress(function(event) {event.preventDefault();});
$("#event_end_time_el").keypress(function(event) {event.preventDefault();});
$("#edit_event_date_el").keypress(function(event) {event.preventDefault();});
    </script>
    <script type='text/javascript'>
        $(document).ready(function(){
            $('#dataTable').DataTable();
            $(".js-example-basic-multiple").select2({
                placeholder: "Select artists",
            });
        });

    $("#video").on("click",function(){
        $("#video_embed_code").val("");
        $("#videoDiv").show();
        $("#imageDiv").hide();
    });
    $("#image").on("click",function(){
        $("#imageDiv").show();
        $("#videoDiv").hide();
    });

        CKEDITOR.replace('content',
        {
            customConfig : 'config.js',
            toolbar : 'simple'
        });

        $(function () {
            // $(".main-content").niceScroll({
            //     cursoropacitymin: 1,
            //     cursorcolor: '#6e8cb6',
            //     cursorborder: 'none',
            //     horizrailenabled: false,
            //     scrollspeed: 400,
            // });
            // $(".niceScroll").niceScroll({
            //     cursoropacitymin: 1,
            //     cursorcolor: '#6e8cb6',
            //     cursorborder: 'none',
            //     horizrailenabled: false,
            // });
            // $(".boxScroll").niceScroll(".wrap",{
            //     cursoropacitymin: 1,
            //     cursorcolor: '#6e8cb6',
            //     cursorborder: 'none',
            //     horizrailenabled: false,
            // });
            $('input[name="dates"]').daterangepicker({
                "startDate": "01/03/2020",
                "endDate": "01/09/2020",
                opens: 'left'
            });
            /*$('input[name="dob"]').daterangepicker({
                singleDatePicker: true,
                opens: 'left',
                locale: {
                  format: 'DD-MM-YYYY'
                }
            });*/
        });
    </script>
    <script type="text/javascript" src="{{ asset('public/js/front/daterangepicker.min.js') }}"></script>
    <script>
    $(function() {
        $('input[name="event_date_ranges"]').daterangepicker({
        autoUpdateInput: false,
        locale: {
            format: 'DD-MM-YYYY',
            cancelLabel: 'Clear'
        }
        });
        $('input[name="event_date_ranges"]').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('DD-MM-YYYY') + ' _ ' + picker.endDate.format('DD-MM-YYYY'));
        });

        $('input[name="event_date_ranges"]').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
        });

    });
   </script>