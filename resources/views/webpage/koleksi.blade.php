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
                    <h3>Koleksi Wajib Serah</h3>
                  </div>
                </div><br>
                <div class="row row-60">
                  @foreach ($data as $dat)
                  <div class="col-md-6 col-xl-3">
                    <article class="post-slider post-minimal">
                      <div class="owl-carousel carousel-post-gallery carousel-slider-blog-post" data-autoplay="true" data-items="1" data-stage-padding="0" data-loop="false" data-margin="10px" data-mouse-drag="false" data-nav="true" data-dots="true" data-lightgallery="group">
                        @if($dat->coverurl != null)
                          <div class="item"><a class="img-thumbnail-variant-1" href="https://opac.perpusnas.go.id/uploaded_files/sampul_koleksi/original/{{$dat->worksheet->name}}/{{$dat->coverurl}}" data-lightgallery="item">
                              <figure><img style="min-height:250px; max-height:250px" class="lazy" data-src="https://opac.perpusnas.go.id/uploaded_files/sampul_koleksi/original/{{$dat->worksheet->name}}/{{$dat->coverurl}}" alt="" width="1200" height="800"/>
                              </figure>
                            <div class="caption"><span class="icon icon-lg linear-icon-magnifier"></span></div></a>
                          </div>
                        @else
                          <div class="item"><a class="img-thumbnail-variant-1" href="https://opac.perpusnas.go.id/uploaded_files/sampul_koleksi/original/nophoto.jpg" data-lightgallery="item">
                              <figure><img style="min-height:250px; max-height:250px" class="lazy" data-src="https://opac.perpusnas.go.id/uploaded_files/sampul_koleksi/original/nophoto.jpg" alt="" width="1200" height="800"/>
                              </figure>
                            <div class="caption"><span class="icon icon-lg linear-icon-magnifier"></span></div></a>
                          </div>
                        @endif
                      </div>
                      <div class="post-classic-title">
                        <h6 style="font-size:15px;">
                          <a href="/wajibserah/terbitan/{{$dat->id}}">
                            <b>{{substr(preg_replace('#<[^>]+>#', ' ', $dat['title']), 0, 45)}}
                                @if(strlen($dat['title']) > 45) ... @endif
                            </b>
                          </a>
                        </h6>
                      </div>
                      <div class="post-meta">
                        <div class="group">
                          <p style="font-size:13px;">
                            <time datetime="2017">{{$dat->publishyear}}</time><br>
                           @if($dat->collections->where('noinduk_deposit','!=',null)->first()->master_publisher) <a href="/wajibserah/detail?id={{$dat->collections->where('noinduk_deposit','!=',null)->first()->master_publisher->publisher_id}}">{{$dat->collections->where('noinduk_deposit','!=',null)->first()->master_publisher->publisher_name}}</a>
                           @endif
                          </p>

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

                {{$data->links()}}
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-5 col-xl-3 section-divided__aside section-divided__aside-left">
          <section class="section-sm section-style-1">
            <h6>Telusuri</h6>
            <form class="rd-search text-center" action="/koleksi" method="GET" data-search-live="rd-search-results-live">
              <div class="form-wrap form-wrap_icon linear-icon-magnifier">
                <select name="type" class="form-input">
                  <option value="" @if($type == "") selected @endif>Seluruh Koleksi</option>
                  <option value="Pemerintah" @if($type == "Pemerintah") selected @endif>Pemerintah</option>
                  <option value="Swasta" @if($type == "Swasta") selected @endif>Swasta</option>
                </select>
              </div>
              <div class="form-wrap form-wrap_icon linear-icon-magnifier">
                  <input class="form-input" type="text" name="search" autocomplete="off" value="{{$search}}" placeholder="Telusuri Koleksi">
              </div>
              <button class="button button-primary" type="submit">Cari</button>
            </form>
            <br>
            @if ($search != "")
              @if($type != "")
                <span><b>Ditemukan <i>{{$count}}</i> &nbsp;Koleksi didalam penelusuran {{$type}} tentang <i>{{$search}}</i></b></span>
                @else
                <span><b>Ditemukan <i>{{$count}}</i> &nbsp;Koleksi didalam penelusuran tentang <i>{{$search}}</i></b></span>
              @endif
            @elseif($type != "")
              @if($search != "")
                <span><b>Ditemukan <i>{{$count}}</i> &nbsp;Koleksi didalam penelusuran {{$type}} tentang <i>{{$search}}</i></b></span>
              @else
                <span><b>Ditemukan <i>{{$count}}</i> &nbsp;Koleksi didalam penelusuran {{$type}}</i></b></span>
              @endif
            @endif
          </section>
        </div>
      </div>
    </div>
  </section>
@endsection