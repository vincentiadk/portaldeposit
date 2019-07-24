@extends('webpage.layouts.app')
@section('content')
  <section class="bg-default section-md">
    <div class="container">
      <div class="row">
        <div class="col-sm-12 text-center">
          <h4 class="heading-decorated">Detail Koleksi </h4>
        </div>
      </div>
      <div class="row row-70 flex-lg-row-reverse">
        <div class="col-lg-7 col-xl-8 section-divided__main section-divided__main-left">
          <!-- Post classic-->
          <div class="section-sm">
            <article class="post-classic">
              <div class="post-classic-title post-classic-title-icon linear-icon-star">
                <h5><a href="image-post.html">Judul Terbitan</a></h5>
              </div>
            </article>
            <article class="post-quote">
              <a href="quote-post.html">
                <!-- Quote centered-->
                <div class="quote-centered">
                  <svg class="quote-centered__mark" version="1.1" baseprofile="tiny" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="30.234px" height="23.484px" viewbox="0 0 30.234 23.484" xml:space="preserve">
                    <g>
                      <path d="M12.129,0v1.723c-2.438,0.891-4.348,2.291-5.73,4.201c-1.383,1.911-2.074,3.897-2.074,5.959              c0,0.445,0.07,0.773,0.211,0.984c0.093,0.141,0.199,0.211,0.316,0.211c0.117,0,0.293-0.082,0.527-0.246              c0.75-0.539,1.699-0.809,2.848-0.809c1.336,0,2.519,0.545,3.551,1.635c1.031,1.09,1.547,2.385,1.547,3.885              c0,1.57-0.592,2.953-1.775,4.148c-1.184,1.195-2.619,1.793-4.307,1.793c-1.969,0-3.668-0.809-5.098-2.426              C0.715,19.441,0,17.274,0,14.555c0-3.164,0.972-6,2.918-8.508C4.863,3.539,7.933,1.524,12.129,0z M29.039,0v1.723              c-2.438,0.891-4.348,2.291-5.73,4.201c-1.383,1.911-2.074,3.897-2.074,5.959c0,0.445,0.07,0.773,0.211,0.984              c0.094,0.141,0.199,0.211,0.316,0.211s0.293-0.082,0.527-0.246c0.75-0.539,1.699-0.809,2.848-0.809c1.336,0,2.52,0.545,3.551,1.635              s1.547,2.385,1.547,3.885c0,1.57-0.592,2.953-1.775,4.148s-2.619,1.793-4.307,1.793c-1.969,0-3.668-0.809-5.098-2.426              s-2.145-3.785-2.145-6.504c0-3.164,0.973-6,2.918-8.508C21.773,3.539,24.844,1.524,29.039,0z"></path>
                    </g>
                  </svg>
                  <div class="quote-centered__text">
                    <p class="q">Abstrak</p>
                  </div>
                  <p class="quote-centered__cite">Abstrak dibuat oleh</p>
                </div>
              </a>
            </article>
          </div>
        </div>
        <div class="col-lg-5 col-xl-4 section-divided__aside section__aside-left">
          <!-- About-->
          <section class="section-sm">
            <h6>About</h6>
            <div class="thumbnail-classic-minimal">
                <img class="rounded-circle" src="{{asset('webpage/images/buku.jpg')}}" alt="" width="210" height="210"/>
            </div>
          </section>
        </div>
      </div>
    </div>
    <br><br>
    <div class="container" style="margin-left:150px">
      <div class="row row-50">
        <div class="col-lg-12 col-xl-12 section-divided__main">
          <!-- Categories-->
          <section class="section-sm">
            <ul class="list-xxs small">
              <li><a href="#">Tahun</a></li>
              <li><a href="#">Pengarang</a></li>
              <li><a href="#">Penerbit</a></li>
              <li><a href="#">ISBN</a></li>
              <li><a href="#">Jenis Terbitan</a></li>
            </ul>
          </section>
        </div>
      </div>
    </div>
  </section>
@endsection