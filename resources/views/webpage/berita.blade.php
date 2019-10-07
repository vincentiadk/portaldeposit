@extends('webpage.layouts.app')
@section('content')
  <section class="bg-default section-md" style="padding-top: 0px; margin-top:20px">
    <div class="container">
      <div class="row row-80">
        <div class="col-lg-7 col-xl-8 section-divided__main">
          <div class="section-sm">
            <article class="post-classic">
              <div class="post-classic-title post-classic-title-icon linear-icon-star">
                <h5>Berita</h5>
              </div> 
              @foreach ($datas->data as $data)
              <div class="col-md-6 col-xl-10">
                <article class="post-slider post-minimal">
                  <!-- Owl Carousel-->
                  <div class="owl-carousel carousel-post-gallery carousel-slider-blog-post" data-autoplay="true" data-items="1" data-stage-padding="0" data-loop="false" data-margin="10px" data-mouse-drag="false" data-nav="true" data-dots="true" data-lightgallery="group">
                    @if(count($allgalerys) > 0)
                      <?php $counter = 0; ?>
                      @foreach($allgalerys as $allgalery)
                        @if($allgalery['foreign_id'] == $data['id'])
                          <div class="item">
                            <a class="img-thumbnail-variant-1" href="/storage/berita/berita{{$data['id']}}/{{$allgalery['file_name']}}" data-lightgallery="item">
                              <figure>
                                <img class="lazy" data-src="/storage/berita/berita{{$data['id']}}/{{$allgalery['file_name']}}" alt="" width="1200" height="800"/>
                              </figure>
                              <div class="caption"><span class="icon icon-lg linear-icon-magnifier"></span></div>
                            </a>
                          </div>
                          <?php $counter++; ?>
                        @endif
                      @endforeach
                      @if($counter == 0)
                        <div class="item">
                          <a class="img-thumbnail-variant-1" href="{{asset('webpage/images/noimage.png')}}" data-lightgallery="item">
                            <figure>
                              <img class="lazy" data-src="{{asset('webpage/images/noimage.png')}}" alt="" width="1200" height="800"/>
                            </figure>
                            <div class="caption"><span class="icon icon-lg linear-icon-magnifier"></span></div>
                          </a>
                        </div>
                      @endif
                    @else
                        <div class="item">
                          <a class="img-thumbnail-variant-1" href="{{asset('webpage/images/noimage.png')}}" data-lightgallery="item">
                            <figure>
                              <img class="lazy" data-src="{{asset('webpage/images/noimage.png')}}" alt="" width="1200" height="800"/>
                            </figure>
                            <div class="caption"><span class="icon icon-lg linear-icon-magnifier"></span></div>
                          </a>
                        </div>
                    @endif
                  </div>
                  <div class="post-classic-title">
                    <h6><a href="/{{$data['slug']}}"><b>{!!substr(preg_replace('#<[^>]+>#', ' ', $data['title']), 0, 60)!!}
                      @if(strlen($data['title']) > 60) ... @endif
                    </b></a>
                    </h6>
                  </div>
                  <div class="post-classic-body">
                    <p>{!! substr($data['description'],0,400)!!}<a href="/{{$data['slug']}}">Baca Selengkapnya</a></p>
                  </div>
                  <div class="post-meta">
                    <div class="group"><a href="gallery-post.html">
                        <time datetime="2017">{{$data['datetime']}}</time></a><span class="meta-author">{{$data['created_by']['name']}}</span>
                    </div>
                  </div>       
                </article>
              </div>
              <br><br>
              @endforeach
            </article>
          </div>

          <!-- Pagination-->
          <div class="row">
            <div align="left" class="col-lg-6 col-md-6 col-ls-m6 col-xs-6">
              @if ($datas->current_page >1)
                <a href="?page={{$datas->current_page-1}}@isset($datas->search)&search={{$datas->search}}&type={{$datas->type}}
                @endisset"><span class="icon linear-icon-arrow-left"> Sebelumnya</a>
              @endif
            </div>
            <div align="right" class="col-lg-6 col-md-6 col-ls-m6 col-xs-6">
              @if ($datas->current_page < $datas->last_page)
                <a href="?page={{$datas->current_page+1}}@isset($datas->search)&search={{$datas->search}}&type={{$datas->type}}
                @endisset">Selanjutnya <span class="icon linear-icon-arrow-right"></span></a>
              @endif
            </div>
          </div>
        </div>
        <div class="col-lg-5 col-xl-4 section-divided__aside section-divided__aside-left">
          <!-- Search-->
          <section class="section-sm section-style-1">
            <h6>Telusuri</h6>
            <!-- RD Search-->
            <form class="rd-search text-center" action="/news" method="GET">
              <div class="form-wrap form-wrap_icon linear-icon-magnifier">
                <select name="type" class="form-input">
                  <option value="" @if($datas->type == "") selected @endif>Seluruh Berita</option>
                  <option value="event" @if($datas->type == "event") selected @endif>Kegiatan</option>
                  <option value="deposit" @if($datas->type == "deposit") selected @endif>Deposit</option>
                </select>
              </div>
              <div class="form-wrap form-wrap_icon linear-icon-magnifier">
                <input class="form-input" type="text" name="search" autocomplete="off" placeholder="Telusuri Berita">
              </div>
              <button class="button button-primary" type="submit">Cari</button>
            </form>
            <br>
            @if ($datas->search != "")
              @if($datas->type != "")
                <span><b>Ditemukan <i>{{$datas->total}}</i> &nbsp;Berita didalam penelusuran {{$datas->type}} tentang <i>{{$datas->search}}</i></b></span>
                @else
                <span><b>Ditemukan <i>{{$datas->total}}</i> &nbsp;Publikasi didalam penelusuran tentang <i>{{$datas->search}}</i></b></span>
              @endif
            @elseif($datas->type != "")
              @if($datas->search != "")
                <span><b>Ditemukan <i>{{$datas->total}}</i> &nbsp;Berita didalam penelusuran {{$datas->type}} tentang <i>{{$datas->search}}</i></b></span>
              @else
                <span><b>Ditemukan <i>{{$datas->total}}</i> &nbsp;Berita didalam penelusuran {{$datas->type}}</i></b></span>
              @endif
            @endif
          </section>
        </div>
      </div>
    </div>
  </section>
@endsection
@section ('footer-link')
  <script type="text/javascript" src="{{asset('webpage/js/berita.js')}}"></script>
@endsection