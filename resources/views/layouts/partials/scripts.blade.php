<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 2.1.4 -->
<script src="{{ asset('/plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
<!-- Bootstrap 3.3.2 JS -->
<script src="{{ asset('/js/bootstrap.min.js') }}" type="text/javascript"></script>
<!-- AdminLTE App -->
<script src="{{ asset('/js/app.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('/plugins/slimScroll/jquery.slimscroll.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('/plugins/fastclick/fastclick.min.js') }}" type="text/javascript"></script>
<!-- iCheck -->
<script src="{{ asset('/plugins/iCheck/icheck.min.js') }}" type="text/javascript"></script>
<!-- DataTables -->
<script src="{{ asset('/plugins/datatables/jquery.dataTables.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('/plugins/datatables/dataTables.bootstrap.min.js') }}" type="text/javascript"></script>
<!-- Select2 -->
<script src="{{asset('/plugins/select2/select2.min.js')}}" type="text/javascript" ></script>
<!-- Datepicker3 -->
<script src="{{asset('/plugins/datepicker/bootstrap-datepicker.js')}}" type="text/javascript" ></script>
<script src="{{asset('/plugins/datepicker/locales/bootstrap-datepicker.it.js')}}" type="text/javascript" ></script>
<!-- ClockPicker -->
<script src="{{asset('/plugins/clockpicker/clockpicker.min.js')}}" type="text/javascript" ></script>
<!-- wysightml5 -->
<script src="{{asset('/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}" type="text/javascript" ></script>
<!-- Tree-View -->
<script src="{{asset('/plugins/bootstrap-treeview/bootstrap-treeview.min.js')}}" type="text/javascript" ></script>
<!-- FullCalendar -->
<script src="{{asset('/plugins/moment/moment-with-locales.min.js')}}" type="text/javascript" >
    moment().locale('it');
</script>
<script src="{{asset('/plugins/fullcalendar/fullcalendar.min.js')}}" type="text/javascript" ></script>
<!-- Laravel -->
<script src="{{asset('/plugins/laravel/laravel.js')}}" type="text/javascript" ></script>


<script>
/*
* CheckBox
* -----------------------
* This plugin depends on iCheck plugin for checkbox and radio inputs
*
* @type plugin
* @usage $("#todo-widget").todolist( options );
*/
$(function () {
    $('input').iCheck({
    checkboxClass: 'icheckbox_square-blue',
    radioClass: 'iradio_square-blue',
    increaseArea: '20%' // optional
    });
});
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
    }
});
$(document).ready(function() {
    $('.select2').select2();
    //Date picker
    $('.datepicker').datepicker({
        autoclose: true,
        format: 'dd/mm/yyyy',
        language: 'it',
    });
});
</script>
