@extends('webpage.layouts.app')
@section('content')
  <!-- Swiper-->
  <!-- <section>
    <div class="swiper-container swiper-slider swiper-slider_fullwidth bg-gray-dark" data-simulate-touch="false" data-loop="true" data-autoplay="5000" style="height:50vh;" >
      <div class="swiper-wrapper">
        @foreach($sliders as $slider)
        <div class="swiper-slide" data-slide-bg="/storage/slider/{{$slider->file_name}}">
          <div class="swiper-slide-caption text-right">
            <div class="container">
              <div class="row justify-content-center justify-content-xxl-end">
                <div class="col-lg-10 col-xxl-7">
                </div>
              </div>
            </div>
          </div>
        </div>
        @endforeach
      </div>
      <div class="swiper-pagination"></div>
      <div class="swiper-button-prev linear-icon-chevron-left"></div>
      <div class="swiper-button-next linear-icon-chevron-right"></div>
    </div>
  </section> -->

  <section class="section-lg bg-default" style="padding-top: 0px; padding-bottom: 0px;">
      <div class="swiper-container swiper-slider swiper-slider-custom" data-simulate-touch="false" data-loop="true" data-autoplay="5000" style="height:50vh;">
        <div class="swiper-wrapper">
          @foreach($sliders as $slider)
          <div class="swiper-slide" data-slide-bg="/storage/slider/{{$slider->file_name}}">
            <div class="swiper-slide-caption"></div>
          </div>
          @endforeach
          <!-- <div class="swiper-slide" data-slide-bg="{{asset('webpage/images/slider2.jpg')}}">
            <div class="swiper-slide-caption"></div>
          </div>
          <div class="swiper-slide" data-slide-bg="{{asset('webpage/images/slider3.jpg')}}">
            <div class="swiper-slide-caption"></div>
          </div>
          <div class="swiper-slide" data-slide-bg="{{asset('webpage/images/slide-4.jpg')}}">
            <div class="swiper-slide-caption"></div>
          </div>
          <div class="swiper-slide" data-slide-bg="{{asset('webpage/images/slide-5.jpg')}}">
            <div class="swiper-slide-caption"></div>
          </div> -->
        </div>
        <!-- Swiper Pagination-->
        <div class="swiper-pagination"></div>
        <div class="swiper-button-prev linear-icon-chevron-left"></div>
        <div class="swiper-button-next linear-icon-chevron-right"></div>
      </div>
  </section>



  <section class="section-xl bg-gray-lighter text-center" style="padding-top:50px">
    <div class="container">
      <div class="row justify-content-xl-center row-50">
        <div class="col-xl-9">
          <h3>Koleksi Deposit Terbaru</h3>
        </div>
      </div><br>
      <div class="row row-60">
        <div class="owl-carousel" data-items="1" data-sm-items="2" data-xl-items="6" data-dots="true" data-nav="false" data-stage-padding="15" data-margin="30" data-mouse-drag="false" data-loop="true" data-autoplay="true">
          @foreach ($koleksi as $data) 
          @php $col = $data->collections->where('noinduk_deposit','!=',null)->first();  @endphp
          <div class="owl-item pricing-table">
            <article class="post-classic post-minimal " style="width:100%;">
              @if($data->coverurl != null)
                <img class="lazy" data-src="https://opac.perpusnas.go.id/uploaded_files/sampul_koleksi/original/{{$data->worksheet->name}}/{{$data->coverurl}}" style="min-height:200px; max-height:200px; min-width:160px; max-width:160px"/>
              @else
                <img class="lazy" data-src="https://opac.perpusnas.go.id/uploaded_files/sampul_koleksi/original/nophoto.jpg" style="min-height:200px; max-height:200px; min-width:160px; max-width:160px"/>
              @endif
              <div class="post-classic-title" style="height: 36px;">
                <p style="text-align: left; font-size:13px ;">
                  <a href="/wajibserah/terbitan/{{$data->id}}">
                    <b>{{substr(preg_replace('#<[^>]+>#', ' ', $data['title']), 0, 30)}}
                        @if(strlen($data['title']) > 30)... @endif
                    </b>
                  </a>
                </p>
              </div>
              <div class="post-meta" style="height: 36px;"> 
                <div class="group" style="text-align: justify; font-size:12px">
                  <p class="post-classic-body"> 
                     @if(!empty($col) && $col->master_publisher)
                    <a href="/wajibserah/detail?id={{$col->publisher_id}}">
                     
                      {{substr(preg_replace('#<[^>]+>#', ' ', $col->master_publisher->publisher_name), 0, 30)}},
                        @if(strlen($col->master_publisher->publisher_name) > 30) ... @endif
                        {{$data->publishyear}}
                       
                    </a>
                     @endif
                  </p>
                </div>
              </div>
            </article>
          </div>
          @endforeach
        </div>
      </div>  
    </div>
  </section>

  <section class="section-xl bg-default text-center" style="padding-top:50px">
    <div class="container">
      <div class="row justify-content-xl-center row-50">
        <div class="col-xl-9">
          <h3>Berita Terbaru</h3>
        </div>
      </div><br>
      <div class="row row-50">
        @foreach ($news as $news)
        <div class="col-md-6 col-lg-4">
          <div class="thumb thumb-corporate">
            <div class="owl-carousel carousel-post-gallery carousel-slider-blog-post" data-autoplay="true" data-items="1" data-stage-padding="0" data-loop="false" data-margin="10px" data-mouse-drag="false" data-nav="true" data-dots="true" data-lightgallery="group">
              @if(count($allgalerys) > 0)
                <?php $counter = 0; ?>
                @foreach($allgalerys as $allgalery)
                  @if($allgalery->foreign_id == $news->id)
                    <div class="item">
                      <a class="img-thumbnail-variant-1" href="/storage/berita/berita{{$news->id}}/{{$allgalery->file_name}}" data-lightgallery="item">
                        <figure>
                          <img class="lazy" data-src="/storage/berita/berita{{$news->id}}/{{$allgalery->file_name}}" alt="" style="min-height:200px; max-height:200px"/>
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
                        <img class="lazy" data-src="{{asset('webpage/images/noimage.png')}}" alt="" style="min-height:200px; max-height:200px"/>
                      </figure>
                      <div class="caption"><span class="icon icon-lg linear-icon-magnifier"></span></div>
                    </a>
                  </div>
                @endif
              @else
                  <div class="item">
                    <a class="img-thumbnail-variant-1" href="{{asset('webpage/images/noimage.png')}}" data-lightgallery="item">
                      <figure>
                        <img class="lazy" data-src="{{asset('webpage/images/noimage.png')}}" alt="" style="min-height:200px; max-height:200px"/>
                      </figure>
                      <div class="caption"><span class="icon icon-lg linear-icon-magnifier"></span></div>
                    </a>
                  </div>
              @endif
            </div>
            <div class="thumb-corporate__caption">
              <p class="thumb__title"><a href="/{{$news->slug}}"><b>{!!substr(preg_replace('#<[^>]+>#', ' ', $news->title), 0, 50)!!}...</b></a></p>
              <div class="post-meta">
                <div class="group"><a href="/{{$news->slug}}">
                  <time datetime="2017">{{$news->datetime}}</time></a><span class="meta-author">{{$news->created_by}}</span>
                </div>
              </div>
              <p style="text-align:left">{!!substr(preg_replace('#<[^>]+>#', ' ', $news->description), 0, 300)!!} &nbsp;&nbsp;&nbsp;<a href="/{{$news->slug}}">Baca selengkapnya...</a></p>
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </section>

  <section class="section-xl bg-gray-lighter text-center" style="padding-top:50px">
    <div class="container">
      <div class="row justify-content-xl-center row-50">
        <div class="col-xl-9">
          <h3>Jadwal Kegiatan</h3>
        </div>
      </div><br>         
      <div class="row row-50">
        <div class="col-md-12 col-xl-9 " style="margin:auto">
          <table class="demo-table3" style="margin:auto">    
            <thead>
              <tr>
                <th width="20%">Waktu</th>
                <th width="20%">Pembicara</th>
                <th width="40%">Tema</th>
                <th width="30%">Tempat</th>
              </tr>
            </thead>
            @foreach ($event as $data) 
            <tbody>
              <tr>
                <td><a href="/{{$data->slug}}">{{ date('d F Y', strtotime($data->datetime))}}</a></td>
                <td>{{$data->speaker}}</td>
                <td>{{$data->title}}</td>
                <td>{{$data->place}}</td>
              </tr>
            </tbody>
            @endforeach
          </table>
        </div>  
      </div>
    </div>
  </section>
@endsection