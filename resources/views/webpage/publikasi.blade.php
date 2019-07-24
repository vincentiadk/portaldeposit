@extends('webpage.layouts.app')
@section('content')
  <section class="bg-default section-md">
    <div class="container">
      <div class="row row-80">
        <div class="col-lg-7 col-xl-9 section-divided__main">
          <div class="section-sm">
            <section class="bg-default section-md" style="padding-top: 0px; margin-top:-50px">
              <div class="container" >
                <div class="row justify-content-xl-center row-50 text-center">
                  <div class="col-xl-9">
                    <h3>Publikasi Deposit</h3>
                  </div>
                </div><br>
                <div class="row row-60">
                  @foreach ($data as $data)
                  <div class="col-md-6 col-xl-3">
                    <article class="post-slider post-minimal">
                      <div class="owl-carousel carousel-post-gallery carousel-slider-blog-post" data-autoplay="true" data-items="1" data-stage-padding="0" data-loop="false" data-margin="10px" data-mouse-drag="false" data-nav="true" data-dots="true" data-lightgallery="group">
                        @php
                          $temp = 0;
                        @endphp
                        @foreach($allgalerys as $allgalery)
                          @if($allgalery->foreign_id == $data->id)
                            <div class="item"><a class="img-thumbnail-variant-1" href="/storage/deposit/deposit{{$data->id}}/{{$allgalery->file_name}}" data-lightgallery="item">
                              <figure><img style="min-height:250px; max-height:250px" class="lazy" data-src="/storage/deposit/deposit{{$data->id}}/{{$allgalery->file_name}}" alt="" width="1200" height="800"/>
                              </figure>
                              <div class="caption"><span class="icon icon-lg linear-icon-magnifier"></span></div></a>
                            </div>
                          @php
                            $temp = 1;
                          @endphp
                          @endif
                        @endforeach
                        @if($temp == 0)
                          <div class="item"><a class="img-thumbnail-variant-1" href="https://inlis.perpusnas.go.id/inlisnew/uploaded_files/sampul_koleksi/original/nophoto.jpg" data-lightgallery="item">
                            <figure><img style="min-height:250px; max-height:250px" class="lazy" data-src="https://inlis.perpusnas.go.id/inlisnew/uploaded_files/sampul_koleksi/original/nophoto.jpg" alt="" width="1200" height="800"/>
                            </figure>
                            <div class="caption"><span class="icon icon-lg linear-icon-magnifier"></span></div></a>
                          </div>
                          @endif
                        
                      </div>
                      <div class="post-classic-title">
                        <h6 style="font-size:15px;">
                          <a href="/publication/{{$data->id}}">
                            <b>
                              {{substr(preg_replace('#<[^>]+>#', ' ', $data->title), 0, 45)}}
                              @if(strlen($data['title']) > 45) ... @endif
                            </b>
                          </a>
                        </h6>
                      </div>
                      <div class="post-meta">
                        <div class="group">
                          <!-- <a href="/publication/{{$data->id}}">
                            <time datetime="2017">{{$data->publishyear}}</time>
                          </a><br> -->
                          <a class="meta-author" href="/publication/{{$data->id}}">{{$data->publisher}}</a>
                        </div>
                      </div>
                    </article>
                  </div>
                  @endforeach
                </div>
              </div>
            </section>
          </div>

          <!-- Pagination-->
          <div class="section-sm">
            <div class="row">
              <div class="col-xl-6">
                @if ($current_page == "1")
                @else
                  <a class="icon linear-icon-arrow-left text-left" href="/publication?page={{$current_page - 1}}&search={{$search}}&type={{$type}}"><span> Sebelumnya</span></a>
                @endif
              </div>
              <div class="col-xl-6 text-right">
                @if ($current_page == "1" && $current_page == $last_page)
                @elseif ($current_page == "1" && $current_page != $last_page)
                  <a class="icon text-right" href="/publication?page={{$current_page + 1}}&search={{$search}}&type={{$type}}"><span> Selanjutnya </span><span class="linear-icon-arrow-right"></span></a>
                @elseif ($current_page != "1" && $current_page == $last_page)
                @else
                  <a class="icon text-right" href="/publication?page={{$current_page + 1}}&search={{$search}}&type={{$type}}"><span> Selanjutnya </span><span class="linear-icon-arrow-right"></span></a>
                @endif
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-5 col-xl-3 section-divided__aside section-divided__aside-left">
          <section class="section-sm section-style-1">
            <h6>Telusuri</h6>
            <form class="rd-search text-center" action="/publication" method="GET">
              <div class="form-wrap form-wrap_icon linear-icon-magnifier">
                <select name="type" class="form-input">
                  <option value="" @if($type == "") selected @endif>Seluruh Publikasi</option>
                  <option value="buletin_deposit" @if($type == "buletin_deposit") selected @endif>Buletin</option>
                  <option value="direktori_penerbit" @if($type == "direktori_penerbit") selected @endif>Direktori Penerbit</option>
                  <option value="kin" @if($type == "kin") selected @endif>KIN</option>
                  <option value="kdt" @if($type == "kdt") selected @endif>KDT</option>
                  <option value="bni" @if($type == "bni") selected @endif>BNI</option>
                  <option value="prosiding" @if($type == "prosiding") selected @endif>Prosiding</option>
                  <option value="kckr" @if($type == "daftar_kckr") selected @endif>KCKR</option>
                  <option value="literatur_sekunder" @if($type == "literatur_sekunder") selected @endif>Literatur Sekunder</option>
                </select>
              </div>
              <div class="form-wrap form-wrap_icon linear-icon-magnifier">
                  <input class="form-input" type="text" name="search" autocomplete="off" value="{{$search}}" placeholder="Telusuri Publikasi">
              </div>
              <button class="button button-primary" type="submit">Cari</button>
            </form>
            <br>
            @if ($search != "")
              @if($type != "")
                <span><b>Ditemukan <i>{{$count}}</i> &nbsp;Publikasi didalam penelusuran {{$type}} tentang <i>{{$search}}</i></b></span>
                @else
                <span><b>Ditemukan <i>{{$count}}</i> &nbsp;Publikasi didalam penelusuran tentang <i>{{$search}}</i></b></span>
              @endif
            @elseif($type != "")
              @if($search != "")
                <span><b>Ditemukan <i>{{$count}}</i> &nbsp;Publikasi didalam penelusuran {{$type}} tentang <i>{{$search}}</i></b></span>
              @else
                <span><b>Ditemukan <i>{{$count}}</i> &nbsp;Publikasi didalam penelusuran {{$type}}</i></b></span>
              @endif
            @endif
          </section>
        </div>
      </div>
    </div>
  </section>
@endsection
<!-- @section('footer-link')
<script type="text/javascript" src="{{asset('webpage/js/publikasi.js')}}"></script>
@endsection -->