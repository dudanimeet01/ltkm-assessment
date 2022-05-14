<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>{{Config::get('app.name')}}</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
        name='viewport' />

    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />

    <link href="{{url('assets/css/bootstrap.min.css')}}" rel="stylesheet" />
    <link href="{{url('assets/css/light-bootstrap-dashboard.css?v=2.0.0')}}" rel="stylesheet" />
    <link href="{{url('assets/css/demo.css')}}" rel="stylesheet" />
</head>

<body>
    <div class="wrapper">
        @include('layouts.side_bar')
        <div class="main-panel">
            <div class="content">
                <div class="container-fluid">
                    @yield('content')

                </div>
            </div>
        </div>
    </div>
</body>
<script src="{{url('assets/js/core/jquery.3.2.1.min.js')}}" type="text/javascript"></script>
<script src="{{url('assets/js/core/popper.min.js')}}" type="text/javascript"></script>
<script src="{{url('assets/js/core/bootstrap.min.js')}}" type="text/javascript"></script>
<script src="{{url('assets/js/plugins/bootstrap-notify.js')}}"></script>
<script src="{{url('assets/js/light-bootstrap-dashboard.js')}}?v=2.0.0 " type="text/javascript"></script>
<script src="{{url('assets/js/demo.js')}}" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js">
</script>


<script>
    $(document).ajaxStart(function() {
        $.LoadingOverlay("show",{
            image : "{{url('assets/img/loader.png')}}",
            imageAnimation : "1500ms rotate_right" 
        });
    });
    
    $(document).ajaxStop(function() {
      $.LoadingOverlay("hide");
    });
    
    @if(Session::has('success_msg'))
    $(document).ready(function() {
        demo.showNotification("{{Session::get('success_msg')}}",'success');
    });
    @endif
    
    @if(Session::has('error_msg'))
    $(document).ready(function() {
        demo.showNotification("{{Session::get('error_msg')}}",'danger');
    });
    @endif

</script>
@stack('scripts')

</html>