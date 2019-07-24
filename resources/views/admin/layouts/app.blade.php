<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->

  <!-- BEGIN HEAD-->
  <head>
    @include ('admin.layouts.header')
  </head>
  <!-- END  HEAD-->
  <!-- BEGIN BODY-->
  <body class="padTop53 " >
    <!-- MAIN WRAPPER -->
    <div id="wrap">
      <!-- HEADER SECTION -->
      <div id="top" style="margin-bottom: 30px">
        <nav class="navbar navbar-inverse navbar-fixed-top " style="padding-top: 10px;padding-bottom: 10px; background-color:#1E6F92">
          <a data-original-title="Show/Hide Menu" data-placement="bottom" data-tooltip="tooltip" class="accordion-toggle btn btn-primary btn-sm visible-xs" data-toggle="collapse" href="#menu" id="menu-toggle">
            <i class="icon-align-justify"></i>
          </a>
          <!-- LOGO SECTION -->
          <header class="navbar-header">
            <a href="{{url('/')}}" class="navbar-brand">
            <img src="{{asset('admin/img/logo.png')}}" alt="" /></a>
          </header>
          <!-- END LOGO SECTION -->
        </nav>
      </div>
      <!-- END HEADER SECTION -->
      <!-- MENU SECTION -->
      <div id="left">
        @include('admin.layouts.menu')
      </div>
      <!--END MENU SECTION -->
      <!--PAGE CONTENT -->
      <div id="content">
        <div class="inner" style="min-height:1200px;">
          @yield('content')
          <hr />
        </div>
      </div>
      <!--END PAGE CONTENT -->
    </div>
    <!--END MAIN WRAPPER -->
    <!-- FOOTER -->
    <div id="footer">
      <p>Deposit Perpustakaan Nasional &nbsp;2019&nbsp;</p>
    </div>
    <!--END FOOTER -->
    <!-- GLOBAL SCRIPTS -->
    <script src="{{asset('admin/plugins/jquery-2.0.3.min.js')}}"></script>
    <script src="{{asset('admin/plugins/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('admin/plugins/modernizr-2.6.2-respond-1.1.0.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.8/summernote.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    
    @yield('add-js')
    <!-- END GLOBAL SCRIPTS -->
  </body>
  <!-- END BODY-->
</html>
