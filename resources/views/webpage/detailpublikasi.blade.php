@extends('webpage.layouts.app')
@section('content')
  <section class="breadcrumbs-custom">
    <div class="container">
      <div class="breadcrumbs-custom__inner">
        <p class="breadcrumbs-custom__title">Detail Publikasi</p>
        <ul class="breadcrumbs-custom__path">
          <li><a href="#">Home</a></li>
          <li><a href="{{url('publication')}}">Publikasi Deposit</a></li>
          <li class="active">Detail Publikasi</li>
        </ul>
      </div>
    </div>
  </section>

  <section class="bg-default section-md" style="padding:20px">
    <div class="container">
      <div class="row row-70 flex-lg-row-reverse">
        <div class="col-lg-7 col-xl-8 section-divided__main section-divided__main-left">
          <!-- Post classic-->
          <div class="section-sm">
            <article class="post-classic">
              <div class="post-classic-title post-classic-title-icon" style="padding-left:0px">
                <h5><b>{{$data->title}}</b></h5>
              </div>
            </article>
            <article class="post-quote">
              <a href="quote-post.html">
                <!-- Quote centered-->
                <div class="quote-centered">
                  <div class="quote-centered__text">
                    <p class="q">Abstrak</p>
                  </div>
                  <p class="quote-centered__cite">{!!$data->description!!}</p>
                </div>
              </a>
            </article>
          </div>
        </div>
        <div class="col-lg-5 col-xl-4 section-divided__aside section__aside-left">
          <!-- About-->
          <section class="section-sm">
            <div class="thumbnail-classic-minimal">
              @if($galerys != null)
                <img class="lazy" data-src="/storage/deposit/deposit{{$data->id}}/{{$galerys->file_name}}" alt="" width="210" height="210"/>
              @else
                <img class="lazy" data-src="https://inlis.perpusnas.go.id/inlisnew/uploaded_files/sampul_koleksi/original/nophoto.jpg" alt="" width="210" height="210"/>
              @endif
            </div>
          </section>
        </div>
      </div>
    </div>
    <br><br>

    <div class="container">
      <div class="row row-70">
        <div class="col-lg-5 col-xl-6 ">
          <div class="row row-60">
            <div class="col-sm-12">
              <!-- Bootstrap tabs-->
              <div class="tab-content text-left" style="border-top:none">
                <div class="tab-pane fade show active">
                  <h5>Additional Information</h5>
                  <table class="table-product-info">
                    <tr>
                      <td>Pengarang</td>
                      <td>{{$data->author}}</td>
                    </tr>
                    <tr>
                      <td>Penerbit</td>
                      <td>{{$data->publisher}}</td>
                    </tr>
                    <tr>
                      <td>Tahun Terbit</td>
                      <td>{{$data->publishyear}}</td>
                    </tr>
                    <tr>
                      <td>Edisi</td>
                      <td>{{$data->edition}}</td>
                    </tr>
                    <tr>
                      <td>Worksheet</td>
                      <td>{{$data->worksheet}}</td>
                    </tr>
                    <tr>
                      <td>Jenis Publikasi</td>
                      <td>{{$data->type}}</td>
                    </tr>
                    <tr>
                  </table>                
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-7 col-xl-6 ">
          <div align="center" style="padding-top:70px">
            <embed src="/storage/pdf/{{$data->files}}" width="80%" height="600">
          </div>
        </div>
      </div>  
    </div>
  </section>

@endsection