@extends('webpage.layouts.app')
@section('content')
  <section class="breadcrumbs-custom">
    <div class="container">
      <div class="breadcrumbs-custom__inner">
        <p class="breadcrumbs-custom__title">Detail Wajib Serah</p>
        <ul class="breadcrumbs-custom__path">
          <li><a href="#">Home</a></li>
          <li><a href="{{url('wajibserah')}}">Wajib Serah</a></li>
          <li class="active">Detail Wajib Serah</li>
        </ul>
      </div>
    </div>
  </section>

  <section class="bg-default section-md" style="padding:20px">
  <div class="container">
    <div class="row row-80">
      <div class="col-lg-7 col-xl-9 section-divided__main">
        <div class="section-sm">
          <article class="post-classic">
            <div class="post-classic-title post-classic-title-icon linear-icon-star">
              <h5><a href="#">Detail Penerbit</a></h5>
            </div>
          </article>
          <div class="row row-60 flex-lg-row-reverse" style="margin-top: 0px;">
            <div class="col-lg-12 col-xl-12">
              <section class="section-sm">
                <table class="table-product-info">
                  <tbody>
                    <tr>
                      <td>Penerbit</td>
                      <td>{{$detail->publisher_name}}</td>
                    </tr>
                    <tr>
                      <td>Alamat</td>
                      <td>{{$detail->address1}}</td>
                    </tr>
                    <tr>
                      <td>Kota</td>
                      <td>{{$detail->city}}</td>
                    </tr>
                    <tr>
                      <td>Provinsi</td>
                      <td>{{$detail->propinsi->namapropinsi}}</td>
                    </tr>
                    <tr>
                      <td>Jumlah Terbitan</td>
                      <td>{{$total}}</td>
                    </tr>
                  </tbody>
                </table>
              </section>
            </div>
          </div>
        </div>
        <div class="section-sm">
          <article class="post-classic">
            <div class="post-classic-title post-classic-title-icon linear-icon-star">
              <h5><a href="image-post.html">Daftar Terbitan</a></h5>
            </div>
            <div class="row row-60">
              @foreach ($data as $dat)
              <div class="col-md-6 col-xl-3">
                <article class="post-slider post-minimal">
                  <div class="owl-carousel carousel-post-gallery carousel-slider-blog-post" data-autoplay="true" data-items="1" data-stage-padding="0" data-loop="false" data-margin="10px" data-mouse-drag="false" data-nav="true" data-dots="true" data-lightgallery="group">
                    <div class="item"><a class="img-thumbnail-variant-1" href="https://opac.perpusnas.go.id/uploaded_files/sampul_koleksi/original/{{$dat->worksheet->name}}/{{$dat->coverurl}}" data-lightgallery="item">
                      @if($dat->coverurl != null)
                        <figure><img style="min-height:250px; max-height:250px" class="lazy" data-src="https://opac.perpusnas.go.id/uploaded_files/sampul_koleksi/original/{{$dat->worksheet->name}}/{{$dat->coverurl}}" alt="" width="1200" height="800"/>
                        </figure>
                      @else
                        <figure><img style="min-height:250px; max-height:250px" class="lazy" data-src="https://opac.perpusnas.go.id/uploaded_files/sampul_koleksi/original/nophoto.jpg" alt="" width="1200" height="800"/>
                        </figure>
                      @endif
                      <div class="caption"><span class="icon icon-lg linear-icon-magnifier"></span></div></a>
                    </div>
                  </div>
                  <div class="post-classic-title">
                    <h6 style="font-size:15px;">
                      <a href="/wajibserah/terbitan/{{$dat->id}}">
                        <b>{{substr(preg_replace('#<[^>]+>#', ' ', $dat['title']), 0, 45)}}
                            @if(strlen($dat['title']) > 45) ... @endif
                        </b>
                      </a>
                    </h6>
                    <p style="font-size:13px;">Th Terbit : {{$dat->publishyear}} <br>
                    @if(!$dat->isbn=="")
                    @if(str_contains($dat->isbn,'ISSN'))
                    {{$dat->isbn}}
                    @else
                    ISBN : {{$dat->isbn}}</p>
                    @endif
                    
                    @endif
                  </div>
                </article>
              </div>
              @endforeach

            </div>
          </article>
        </div>
        <!-- Pagination-->
        <div class="section-sm">
            <div class="row">
              <div class="col-xl-6">
                @if ($current_page == "1")
                @else
                  <a class="icon linear-icon-arrow-left text-left" href="/wajibserah?page={{$current_page - 1}}&search={{$search}}&id={{$id}}"><span> Sebelumnya</span></a>
                @endif
              </div>
              <div class="col-xl-6 text-right">
                @if ($current_page == "1" && $current_page == $last_page)
                @elseif ($current_page == "1" && $current_page != $last_page)
                  <a class="icon text-right" href="/wajibserah/detail?page={{$current_page + 1}}&search={{$search}}&id={{$id}}"><span> Selanjutnya </span><span class="linear-icon-arrow-right"></span></a>
                @elseif ($current_page != "1" && $current_page == $last_page)
                @else
                  <a class="icon text-right" href="/wajibserah/detail?page={{$current_page + 1}}&search={{$search}}&id={{$id}}"><span> Selanjutnya </span><span class="linear-icon-arrow-right"></span></a>
                @endif
                {{$data->links()}}
              </div>
            </div>
        </div>
      </div>
      
      <div class="col-lg-5 col-xl-3 section-divided__aside section-divided__aside-left">
        <section class="section-sm section-style-1">
          <h6>Telusuri</h6>
          <form class="rd-search text-center" action="/wajibserah/detail" method="GET" data-search-live="rd-search-results-live">
            <div class="form-wrap form-wrap_icon linear-icon-magnifier">
                <input class="form-input" type="text" name="id" autocomplete="off" value="{{$id}}" hidden>
                <input class="form-input" type="text" name="search" autocomplete="off" value="{{$search}}" placeholder="Telusuri Wajib Serah">
            </div>
            <button class="button button-primary" type="submit">Cari <i class="fa fa-search"></i></button>
          </form>
            <br>
            @if ($search != "")
              <span><b>Ditemukan <i>{{$count}}</i> &nbsp;Wajib serah didalam penelusuran tentang <i>{{$search}}</i></b></span>
            @endif
        </section>

        <hr>

        <section class="section-sm section-style-1">
          <h6>Download Data Terbitan</h6>
          <form class="rd-search text-center" action="/wajibserah/download" method="GET" data-search-live="rd-search-results-live">
            <div class="row">
                <select class="form-input" name="month">
                  <option value="01">Januari</option>
                  <option value="02">Februari</option>
                  <option value="03">Maret</option>
                  <option value="04">April</option>
                  <option value="05">Mei</option>
                  <option value="06">Juni</option>
                  <option value="07">Juli</option>
                  <option value="08">Agustus</option>
                  <option value="09">September</option>
                  <option value="10">Oktober</option>
                  <option value="11">November</option>
                  <option value="12">Desember</option>
                </select>
            </div>
            <div class="row">
                <input type="text" name="ids" autocomplete="off" value="{{$id}}" hidden>
                <input type="type" name="type" autocomplete="off" value="filter" hidden>
                <input class="form-input" type="text" name="year" autocomplete="off" value="2019">
            </div>
            <button class="button button-primary" name="filter" type="submit" style="width: 100%;">Download <i class="fa fa-file-excel-o"></i></button>
          </form>
          <form class="rd-search text-center" action="/wajibserah/download" method="GET" data-search-live="rd-search-results-live">
            <input type="text" name="ids" autocomplete="off" value="{{$id}}" hidden>
            <input type="type" name="type" autocomplete="off" value="all" hidden>
            <button class="button button-primary" name="all" type="submit" style="width: 100%">Download Seluruh Terbitan <i class="fa fa-file-excel-o"></i></button>
          </form>
        </section>
      </div>
    </div>
  </div>
  </section>

@endsection