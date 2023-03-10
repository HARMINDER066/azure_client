<script type="text/javascript" src="{{ asset('backend/files/bower_components/jquery/dist/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/files/bower_components/jquery-ui/jquery-ui.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/files/bower_components/popper.js/dist/umd/popper.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/files/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/files/bower_components/jquery-slimscroll/jquery.slimscroll.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/files/bower_components/modernizr/modernizr.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/files/bower_components/chart.js/dist/Chart.js') }}"></script>
<script src="{{ asset('backend/files/assets/pages/widget/amchart/amcharts.js') }}"></script>
<script src="{{ asset('backend/files/assets/pages/widget/amchart/serial.js') }}"></script>
<script src="{{ asset('backend/files/assets/pages/widget/amchart/light.js') }}"></script>
<script src="{{ asset('backend/files/assets/js/jquery.mCustomScrollbar.concat.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/files/assets/js/SmoothScroll.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/files/bower_components/pnotify/dist/pnotify.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/files/bower_components/pnotify/dist/pnotify.desktop.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/files/bower_components/pnotify/dist/pnotify.buttons.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/files/bower_components/pnotify/dist/pnotify.confirm.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/files/bower_components/pnotify/dist/pnotify.callbacks.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/files/bower_components/pnotify/dist/pnotify.animate.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/files/bower_components/pnotify/dist/pnotify.history.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/files/bower_components/pnotify/dist/pnotify.mobile.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/files/bower_components/pnotify/dist/pnotify.nonblock.js') }}"></script>
<script src="{{ asset('backend/files/assets/js/pcoded.min.js') }}"></script>
<script src="{{ asset('backend/files/assets/js/vartical-layout.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/files/assets/pages/dashboard/custom-dashboard.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/files/assets/js/script.min.js') }}"></script>
<script type="text/javascript">
      @if ( Session::has('success') )
            new PNotify({
            title: 'Success',
            text: "{{ session()->get('success')}}",
            icon: 'icofont icofont-info-circle',
            type: 'success'
      });
      @endif   
      @if ( Session::has('error') )
            new PNotify({
                  title: 'Error',
                  text: "{{ session()->get('error')}}",
                  icon: 'icofont icofont-info-circle',
                  type: 'error'
            });
      @endif


</script>

@stack('script')
