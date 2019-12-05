<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Direktorat Deposit Bahan Pustaka</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Clean responsive bootstrap website template">
  <meta name="author" content="">
  <!-- styles -->
  <link href="/assets/css/bootstrap.css" rel="stylesheet">
  <link href="/assets/css/bootstrap-responsive.css" rel="stylesheet">
  <link href="/assets/css/docs.css" rel="stylesheet">
  <link href="/assets/css/prettyPhoto.css" rel="stylesheet">
  <link href="/assets/js/google-code-prettify/prettify.css" rel="stylesheet">
  <link href="/assets/css/flexslider.css" rel="stylesheet">
  <link href="/assets/css/refineslide.css" rel="stylesheet">
  <link href="/assets/css/font-awesome.css" rel="stylesheet">
  <link href="/assets/css/animate.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:400italic,400,600,700" rel="stylesheet">
  <link href='https://fonts.googleapis.com/css?family=Oswald:400,700,300' rel='stylesheet' type='text/css'>
  <link href="/assets/css/style.css" rel="stylesheet">
  <link href="/assets/color/color1.css" rel="stylesheet">

  <!-- fav and touch icons -->
  <link rel="shortcut icon" href="/assets/ico/favicon.ico">
  <link rel="apple-touch-icon-precomposed" sizes="144x144" href="/assets/ico/apple-touch-icon-144-precomposed.png">
  <link rel="apple-touch-icon-precomposed" sizes="114x114" href="/assets/ico/apple-touch-icon-114-precomposed.png">
  <link rel="apple-touch-icon-precomposed" sizes="72x72" href="/assets/ico/apple-touch-icon-72-precomposed.png">
  <link rel="apple-touch-icon-precomposed" href="/assets/ico/apple-touch-icon-57-precomposed.png">

  <!-- =======================================================
    Theme Name: Plato
    Theme URL: https://bootstrapmade.com/plato-responsive-bootstrap-website-template/
    Author: BootstrapMade.com
    Author URL: https://bootstrapmade.com
    ======================================================= -->
</head>

<body>
    @include('web.layouts.header')
    @yield('content')
    <!-- footer   
       ================================================== -->
      @include('web.layouts.footer')
      <script src="/assets/js/jquery.js"></script>
      <script src="/assets/js/modernizr.js"></script>
      <script src="/assets/js/jquery.easing.1.3.js"></script>
      <script src="/assets/js/google-code-prettify/prettify.js"></script>
      <script src="/assets/js/bootstrap.js"></script>
      <script src="/assets/js/jquery.prettyPhoto.js"></script>
      <script src="/assets/js/portfolio/jquery.quicksand.js"></script>
      <script src="/assets/js/portfolio/setting.js"></script>
      <script src="/assets/js/hover/jquery-hover-effect.js"></script>
      <script src="/assets/js/jquery.flexslider.js"></script>
      <script src="/assets/js/classie.js"></script>
      <script src="/assets/js/cbpAnimatedHeader.min.js"></script>
      <script src="/assets/js/jquery.refineslide.js"></script>
      <script src="/assets/js/jquery.ui.totop.js"></script>
       <!-- Template Custom Javascript File -->
      <script src="/assets/js/custom.js"></script>
      <script type="text/javascript" src="/assets/js/jquery.lazy.min.js"></script>
      <script type="text/javascript" src="/assets/js/jquery.lazy.plugins.min.js"></script>
      <script>
        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            'Accept': 'application/json'
        }
    });
        $(function() {
            $('.lazy').lazy();
        });
    </script>
    @yield('script')
</body>

</html>
