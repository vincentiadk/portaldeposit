<div class="media user-media well-small">
  <a class="user-link" href="#">
    <img class="media-object img-thumbnail user-img" alt="User Picture" src="{{asset('admin/img/image.png')}}" width="70px" />
  </a>
  <br />
  <div class="media-body">
    <h5 class="media-heading"> {{Auth::user()->name}}</h5>
    <ul class="list-unstyled user-info"> 
      <li>
        <h5>
          @if(Auth::user()->group_id == 0) <b>Admin</b>
          @else <b>Staff</b>
          @endif
        </h5>
      </li>
    </ul>
  </div>
  <br />
</div>

<ul id="menu" class="collapse">
	<li class="panel">
    <a href="/bo/" >
      <i class="icon-home"></i> Dashboard
    </a>                   
  </li>
  <li class="panel">
    <a href="/bo/profile/edit" >
      <i class="icon-user"></i> Profil
    </a>                   
  </li>
  <li class="panel">
    <a href="/bo/berita" >
      <i class="icon-bullhorn"></i> Berita
    </a>
  </li>
  <li class="panel">
    <a href="/bo/deposit/terbitan-deposit" >
      <i class="icon-share"></i> Publikasi Deposit
    </a>                   
  </li>
  <li class="panel ">
    <a href="/bo/kegiatan/agenda">  
      <i class="icon-calendar"></i> Kegiatan
    </a>
  </li>
  @if(Auth::user()->group_id == 0)
  <li class="panel">
    <a href="/bo/pedoman" >
      <i class="icon-book"></i> Pedoman & Peraturan  
    </a>                   
  </li>
  <li class="panel">
    <a href="#" >
      <i class="icon-archive"></i> Laporan
    </a>                   
  </li>
  <li class="panel">
    <a href="/bo/user" >
      <i class="icon-group"></i> Manajemen User
    </a>                   
  </li>
  <li class="panel ">
    <a href="#" data-parent="#menu" data-toggle="collapse" class="accordion-toggle" data-target="#component-nav-pengaturan">
      <i class="icon-tasks"> </i> Manajemen Data
      <span class="pull-right">
        <i class="icon-angle-left"></i>
      </span>
    </a>
    <ul class="collapse" id="component-nav-pengaturan">  
      <li class=""><a href="/bo/slider"><i class="icon-angle-right"></i> Slider </a></li>
      <li class=""><a href="/bo/tentang" ><i class="icon-angle-right"></i> Tentang</a></li>
      <li class=""><a href="/bo/faq" ><i class="icon-angle-right"></i> FAQ</a></li>
    </ul>
  </li>
  @endif
  <li class="panel">
    <a href="/" >
      <i class="icon-signin"></i> Halaman Website
    </a>                   
  </li>
  <li class="panel">
    <a href="/logout" >
      <i class="icon-signout"></i> Logout
    </a>                   
  </li>
</ul>