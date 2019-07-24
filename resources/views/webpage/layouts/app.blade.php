<!DOCTYPE html>
<html class="wide wow-animation" lang="en">
  <head>
    <!-- Site Title-->
    <title>Home</title>
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="{{asset('webpage/css/style-2ee03.css')}}"/>
    <link rel="stylesheet" href="{{asset('webpage/css/style-3ee03.css')}}"/> 

    <link rel="stylesheet" type="text/css" href="{{asset('webpage/css/fontawesome.css')}}">
    <link rel="stylesheet" href="{{asset('webpage/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('webpage/css/style.css')}}">

    <script type="text/javascript">
      document.addEventListener("DOMContentLoaded", function() {
      var lazyloadImages = document.querySelectorAll("img.lazy");    
      var lazyloadThrottleTimeout;
      
      function lazyload () {
        if(lazyloadThrottleTimeout) {
          clearTimeout(lazyloadThrottleTimeout);
        }    
        
        lazyloadThrottleTimeout = setTimeout(function() {
            var scrollTop = window.pageYOffset;
            lazyloadImages.forEach(function(img) {
                if(img.offsetTop < (window.innerHeight + scrollTop)) {
                  img.src = img.dataset.src;
                  img.classList.remove('lazy');
                }
            });
            if(lazyloadImages.length == 0) { 
              document.removeEventListener("scroll", lazyload);
              window.removeEventListener("resize", lazyload);
              window.removeEventListener("orientationChange", lazyload);
            }
        }, 20);
      }
      
      document.addEventListener("scroll", lazyload);
      window.addEventListener("resize", lazyload);
      window.addEventListener("orientationChange", lazyload);
    });
    </script>

    @yield('header-link')
		<!--[if lt IE 10]>
    <div style="background: #212121; padding: 10px 0; box-shadow: 3px 3px 5px 0 rgba(0,0,0,.3); clear: both; text-align:center; position: relative; z-index:1;"><a href="http://windows.microsoft.com/en-US/internet-explorer/"><img src="images/ie8-panel/warning_bar_0000_us.jpg" border="0" height="42" width="820" alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today."></a></div>
    <script src="js/html5shiv.min.js"></script>
		<![endif]-->
    <!-- <style>
      img {
        display: block;
        margin-left: auto;
        margin-right: auto;
      }
    </style> -->
  </head>
  <body>
    <!-- <div id="page-loader">
      <div class="cssload-container">
        <div class="cssload-speeding-wheel"></div>
      </div>
    </div> -->
    <!-- Page-->
    <div class="page">

    @include('webpage.layouts.header')

    @yield('content')

    @include('webpage.layouts.footer')

    </div>
    <!-- Global Mailform Output-->
    <div class="snackbars" id="form-output-global"></div>
    <!-- Javascript-->

    <script type="text/javascript">
        var config = {
            baseurl : "{{ url('/') }}",
            apiurl : "{{ url('/api') }}"
        };
    </script>
    <script src="{{asset('webpage/js/core.min.js')}}"></script>
    <script src="{{asset('webpage/js/script.js')}}"></script>
    @yield('footer-link')
    
   <script type="text/javascript">
    $(document).ready(function() 
    {
      $("#form-saran").on('submit', submit_saran);
    });

    function submit_saran()
    {
      $.ajax({
          type : "POST",       
          url : config.apiurl + "/saran/submit",
          dataType : "json",
          data : {
            "name" : $('#form-saran').find("#saran-name").val(),
            "message" : $('#form-saran').find("#saran-message").val(),
            "email" : $('#form-saran').find("#saran-email").val()         
          },
          beforeSend: function() {
              $("#form-saran").find(".loading").show();
              $("#form-saran").find(".submit").hide();
          }
      }).done(function(response) {
        location.reload()
      }).error(function(data) {
          $('#form-saran').find(".alert_placeholder").html("Saran Gagal Dikirim !");

          $("#form-saran").find(".loading").hide();
          $("#form-saran").find(".submit").show();
      });
      return false;
    }
   </script>
  </body>
</html>