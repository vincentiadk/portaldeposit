
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->

<!-- BEGIN HEAD-->
<head>
	<meta charset="UTF-8" />
	<meta content="width=device-width, initial-scale=1.0" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
<!--[if IE]>
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<![endif]-->
<!-- GLOBAL STYLES -->
<!-- GLOBAL STYLES -->
<link rel="stylesheet" href="{{asset('admin/plugins/bootstrap/css/bootstrap.css')}}" />
<link rel="stylesheet" href="{{asset('admin/css/main.css')}}"/>
<link rel="stylesheet" href="{{asset('admin/css/theme.css')}}"/>
<link rel="stylesheet" href="{{asset('admin/css/MoneAdmin.css')}}"/>
<link rel="stylesheet" href="{{asset('admin/plugins/Font-Awesome/css/font-awesome.css')}}"/>
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.8/summernote.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css"/>
<link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet" />
</head>

<body>
	@yield('content')
</body>

<script src="{{asset('admin/plugins/jquery-2.0.3.min.js')}}"></script>
<script src="{{asset('admin/plugins/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{asset('admin/plugins/modernizr-2.6.2-respond-1.1.0.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.8/summernote.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
 @yield('add-js')
</html>
