
      <header class="page-header">
        <!-- RD Navbar-->
        <div class="rd-navbar-wrap" style="height:124px;">
          <nav class="rd-navbar rd-navbar-default" data-layout="rd-navbar-fixed" data-sm-layout="rd-navbar-fixed" data-sm-device-layout="rd-navbar-fixed" data-md-layout="rd-navbar-fixed" data-md-device-layout="rd-navbar-fixed" data-lg-device-layout="rd-navbar-static" data-lg-layout="rd-navbar-static" data-xl-device-layout="rd-navbar-static" data-xl-layout="rd-navbar-static" data-xxl-device-layout="rd-navbar-static" data-xxl-layout="rd-navbar-static" data-stick-up-clone="false" data-sm-stick-up="true" data-md-stick-up="true" data-lg-stick-up="true" data-md-stick-up-offset="115px" data-lg-stick-up-offset="35px" style="padding: 0px;background-color: rgb(75, 140, 168)">
            <!-- RD Navbar Top Panel-->
            <div class="rd-navbar-top-panel rd-navbar-top-panel-dark" style="padding-bottom: 0px; max-width:1900px">
              <div class="rd-navbar-top-panel__main">
                <div class="rd-navbar-top-panel__toggle rd-navbar-fixed__element-1 rd-navbar-static--hidden" data-rd-navbar-toggle=".rd-navbar-top-panel__main"><span></span></div>
                <div class="rd-navbar-top-panel__content" style="background-color: rgb(1, 53, 89); padding-right: 20px"> 
                  <div class="rd-navbar-top-panel__left">
                    <ul class="rd-navbar-items-list">
                    </ul>
                  </div>
                  <div class="rd-navbar-top-panel__right">
                    <ul class="list-inline-xxs">
                      <li><a class="icon icon-xxs icon-gray-darker fa fa-facebook" href="#"></a></li>
                      <li><a class="icon icon-xxs icon-gray-darker fa fa-twitter" href="#"></a></li>
                      <li><a class="icon icon-xxs icon-gray-darker fa fa-google-plus" href="#"></a></li>
                      <li><a class="icon icon-xxs icon-gray-darker fa fa-vimeo" href="#"></a></li>
                      <li><a class="icon icon-xxs icon-gray-darker fa fa-youtube" href="#"></a></li>
                      <li><a class="icon icon-xxs icon-gray-darker fa fa-pinterest-p" href="#"></a></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
            <div class="rd-navbar-inner rd-navbar-search-wrap" style="background-color: rgb(75, 140, 168); padding-left: 20px; padding-right: 20px;">
              <!-- RD Navbar Panel-->
              <div class="rd-navbar-panel rd-navbar-search-lg_collapsable">
                <button class="rd-navbar-toggle" data-rd-navbar-toggle=".rd-navbar-nav-wrap"><span></span></button>
                <!-- RD Navbar Brand-->
                <div class="rd-navbar-brand"><a class="brand-name" href="{{url('/')}}"><img src="{{asset('webpage/images/deposit.png')}}" alt="" width="232" height="68"/></a></div>
              </div>
              <!-- RD Navbar Nav-->
              <div class="rd-navbar-nav-wrap rd-navbar-search_not-collapsable">
                <!-- RD Navbar Nav-->
                <div class="rd-navbar__element rd-navbar-search_collapsable">
                  <button class="rd-navbar-search__toggle rd-navbar-fixed--hidden" data-rd-navbar-toggle=".rd-navbar-search-wrap"></button>
                </div>
                <!-- RD Search-->
                <div class="rd-navbar-search rd-navbar-search_toggled rd-navbar-search_not-collapsable">
                  <form class="rd-search" action="search-results.html" method="GET" data-search-live="rd-search-results-live">
                    <div class="form-wrap">
                      <input class="form-input" id="rd-navbar-search-form-input" type="text" name="s" autocomplete="off">
                      <label class="form-label" for="rd-navbar-search-form-input">Enter keyword</label>
                      <div class="rd-search-results-live" id="rd-search-results-live"></div>
                    </div>
                    <button class="rd-search__submit" type="submit"></button>
                  </form>
                  <div class="rd-navbar-fixed--hidden">
                    <button class="rd-navbar-search__toggle" data-custom-toggle=".rd-navbar-search-wrap" data-custom-toggle-disable-on-blur="true"></button>
                  </div>
                </div>
                <div class="rd-navbar-search_collapsable">
                  <ul class="rd-navbar-nav" >
                    <!-- <li class="active" ><a href="{{url('/')}}" style="color: white">Beranda</a></li> -->
                    <li><a href="{{url('/news')}}" style="color: white">Berita</a></li>
                    <li><a href="#" style="color: white">Wajib Serah</a>
                        <ul class="rd-navbar-dropdown">
                            <li><a href="{{url('/wajibserah')}}">Direktori Wajib Serah</a></li>
                            <li><a href="{{url('/wajibserah/statistik')}}">Statistik</a></li>
                        </ul>
                    </li>
                    <li><a href="#" style="color: white">Koleksi</a>
                        <ul class="rd-navbar-dropdown">
                            <li><a href="{{url('/koleksi')}}">Direktori Koleksi</a></li>
                            <li><a href="{{url('/koleksi/statistik')}}">Statistik</a></li>
                        </ul>
                    </li>
                    <li><a href="{{url('/publication')}}" style="color: white">Publikasi Deposit</a></li>
                    <li><a href="{{url('/event')}}" style="color: white">Kegiatan</a></li>
                    <li><a href="{{url('/rule')}}" style="color: white">Pedoman dan Peraturan</a></li>
                    @if(Auth::user())
                    <li><a href="{{url('/bo')}}" style="color: white">Back Office</a></li>
                    @endif
                  </ul>
                </div>
              </div>
            </div>
          </nav>
        </div>
      </header>