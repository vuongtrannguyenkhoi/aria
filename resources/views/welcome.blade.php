<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta charset="utf-8">
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width">
    <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
    <!-- build:css(.) styles/vendor.css -->
    <!-- bower:css -->
    <!-- endbower -->
    <!-- endbuild -->
    <link rel="stylesheet" href="{{ url('app/styles/bootstrap.min.css') }}">
    <!-- build:css(.tmp) styles/main.css -->
    <link rel="stylesheet" href="{{ url('app/styles/main.css') }}">
    <!-- endbuild -->
</head>
<body ng-app="publicApp">
<!--[if lte IE 8]>
<p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->

<!-- Add your site or application content here -->

<div ng-include="'app/views/header.html'"></div>

<div class="container">
    <div ui-view></div>
</div>

<!-- build:js(.) scripts/vendor.js -->
<!-- bower:js -->
<script src="{{url('bower_components/jquery/dist/jquery.js')}}"></script>
<script src="{{url('bower_components/angular/angular.js')}}"></script>
<script src="{{url('app/plugins/redactor/redactor.js')}}"></script>
<script src="{{url('app/plugins/redactor/fontfamily.js')}}"></script>
<script src="{{url('app/plugins/redactor/textdirection.js')}}"></script>
<script src="{{url('app/plugins/redactor/fullscreen.js')}}"></script>
<script src="{{url('app/plugins/redactor/fontcolor.js')}}"></script>
<script src="{{url('app/plugins/redactor/imagemanager.js')}}"></script>
<script src="{{url('app/plugins/kendo/kendo.all.min.js')}}"></script>
<script src="{{url('app/scripts/plugins/angular-file-upload.min.js')}}"></script>
<script src="{{url('bower_components/angular-cookies/angular-cookies.js')}}"></script>
<script src="{{url('bower_components/bootstrap/dist/js/bootstrap.js')}}"></script>
<script src="{{url('bower_components/masonry/dist/masonry.pkgd.min.js')}}"></script>
<script src="{{url('bower_components/angular-ui-router/release/angular-ui-router.js')}}"></script>
<script src="{{url('bower_components/angular-animate/angular-animate.min.js')}}"></script>
<script src="{{url('bower_components/angular-redactor/angular-redactor.js')}}"></script>
<script src="{{url('bower_components/angular-loading-bar/build/loading-bar.min.js')}}"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.4.4/underscore-min.js"></script>
<script src="{{url('bower_components/restangular/dist/restangular.min.js')}}"></script>
<script src="{{url('bower_components/angular-sanitize/angular-sanitize.min.js')}}"></script>
<script src="{{url('bower_components/datatables/media/js/jquery.dataTables.min.js')}}"></script>
<script src="{{url('bower_components/angular-datatables/dist/angular-datatables.min.js')}}"></script>
<script src="{{url('bower_components/angular-datatables/dist/plugins/bootstrap/angular-datatables.bootstrap.min.js')}}"></script>
<!-- endbower -->
<!-- endbuild -->

<!-- build:js({.tmp,app}) scripts/scripts.js -->
<script src="{{url('app/scripts/app.js')}}"></script>
<script src="{{url('app/scripts/controllers/main.js')}}"></script>
<script src="{{url('app/scripts/app.config.js')}}"></script>
<script src="{{ url('app/scripts/directives/validateEquals.js') }}"></script>
<script src="{{ url('app/scripts/services/tokenservice.js') }}"></script>
<script src="{{ url('app/scripts/controllers/register.js') }}"></script>
<script src="{{ url('app/scripts/controllers/header.js') }}"></script>
<script src="{{ url('app/scripts/controllers/login.js') }}"></script>
<script src="{{ url('app/scripts/controllers/logout.js') }}"></script>
<script src="{{ url('app/scripts/controllers/jobs.js') }}"></script>
<script src="{{ url('app/scripts/services/authtoken.js') }}"></script>
<script src="{{ url('app/scripts/services/authinterceptor.js') }}"></script>
<script src="{{ url('app/scripts/services/auth.js') }}"></script>
<!-- endbuild -->
</body>
</html>
