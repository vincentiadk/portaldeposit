<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->

<!-- BEGIN HEAD -->
<head>
  <meta charset="UTF-8" />
  <title>Login Page</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
  <!--[if IE]>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <![endif]-->
  <!-- GLOBAL STYLES -->
  <!-- PAGE LEVEL STYLES -->
  <link rel="stylesheet" href="{{asset('admin/plugins/bootstrap/css/bootstrap.css')}}" />
  <link rel="stylesheet" href="{{asset('admin/css/login.css')}}" />
  <link rel="stylesheet" href="{{asset('admin/plugins/magic/magic.css')}}" />
  <!-- END PAGE LEVEL STYLES -->
  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
  <![endif]-->
</head>
    <!-- END HEAD -->

    <!-- BEGIN BODY -->
<body >
  <!-- PAGE CONTENT --> 
  <div class="container">
    <div class="panel panel-default col-sm-6 col-sm-offset-3" style="background-color: #1E6F92">
      <div class="panel-body">
        <div class="text-center">
          <img src="{{asset('admin/img/logo.png')}}" id="logoimg" alt=" Logo" />
        </div>
        <div class="tab-content">
          <div id="login" align="center" class="tab-pane active">
            @if($errors->any())
              <p class="text-muted text-center btn-block btn btn-danger btn-rect">Username atau Password Salah</p>
            @endif


            <form action="{{ route('login') }}" method="post" class="form-signin">
              @csrf
              <input type="text" placeholder="Username" name="username" value="{{ old('email') }}" class="form-control" required />
              <input type="password" placeholder="Password" name="password" class="form-control" required />
              <button class="btn text-muted text-center" style="background-color: rgb(1, 53, 88);" type="submit"><span style="color:white">Sign in</span></button>
            </form>   
          </div>
          <div id="forgot" class="tab-pane">
            <form action="index.html" class="form-signin" method="post">
                <p class="text-muted text-center btn-block btn btn-primary btn-rect">Enter your valid e-mail</p>
                <input type="email" name="email" required="required" placeholder="Your E-mail"  class="form-control" />
                <br />
                <button class="btn text-muted text-center btn-success" type="submit">Recover Password</button>
            </form>
          </div>
        </div>
        <div class="text-center">
          <ul class="list-inline">
            <li><a class="text-muted" href="#login" data-toggle="tab">Login</a></li>
            <li><a class="text-muted" href="#forgot" data-toggle="tab">Forgot Password</a></li>
          </ul>
         </div>
      </div>
    </div>
  </div>
  <!--END PAGE CONTENT -->        
  <!-- PAGE LEVEL SCRIPTS -->
  <script src="{{asset('admin/plugins/jquery-2.0.3.min.js')}}"></script>
  <script src="{{asset('admin/plugins/bootstrap/js/bootstrap.js')}}"></script>
  <script src="{{asset('admin/js/login.js')}}"></script>
  <!--END PAGE LEVEL SCRIPTS -->
</body>
<!-- END BODY -->
</html>
