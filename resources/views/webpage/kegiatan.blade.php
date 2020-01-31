@extends('webpage.layouts.app')
@section('content')
  <section class="bg-default section-md">
    <div class="container">
      <div class="row row-80">
        <div class="col-lg-7 col-xl-8 section-divided__main">
          <div class="section-sm">
            <section class="bg-default section-md" style="padding-top: 0px; margin-top:-50px">
              <div class="container" >
                <div class="row justify-content-xl-center row-50 text-center">
                  <div class="col-xl-9">
                    <h3>Kegiatan</h3>
                  </div>
                </div><br>

                <div class="row row-60">

                @foreach ($data as $data)
                  <div class="col-md-6 col-xl-4">
                    <article class="post-quote"><a href="/{{$data->slug}}" style="height: 300px;">
                      <div class="quote-centered">
                        <div class="quote-centered__text">
                          <p class="q" style="font-size:15px;">
                            <b>
                              {{substr(preg_replace('#<[^>]+>#', ' ', $data->title), 0, 50)}}
                              @if(strlen($data->title) > 50) ... @endif
                            </b>
                          </p>
                        </div>
                        <p style="font-size:13px;">
                          {{$data->speaker}}
                        </p>
                        <p>{{ date('d F Y', strtotime($data->date_start))}}</p>
                        <p>{{$data->place}}</p>
                      </div></a>
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
                  <a class="icon linear-icon-arrow-left text-left" href="/event?page={{$current_page - 1}}&search={{$search}}&type={{$type}}"><span> Sebelumnya</span></a>
                @endif
              </div>
              <div class="col-xl-6 text-right">
                @if ($current_page == "1" && $current_page == $last_page)
                @elseif ($current_page == "1" && $current_page != $last_page)
                  <a class="icon text-right" href="/event?page={{$current_page + 1}}&search={{$search}}&type={{$type}}"><span> Selanjutnya </span><span class="linear-icon-arrow-right"></span></a>
                @elseif ($current_page != "1" && $current_page == $last_page)
                @else
                  <a class="icon text-right" href="/event?page={{$current_page + 1}}&search={{$search}}&type={{$type}}"><span> Selanjutnya </span><span class="linear-icon-arrow-right"></span></a>
                @endif
              </div>
            </div>
          </div>

        </div>
        <div class="col-lg-5 col-xl-4 section-divided__aside section-divided__aside-left">
          <section class="section-sm section-style-1">
            <h6>Telusuri</h6>
            <form class="rd-search text-center" action="/event" method="GET">
              <div class="form-wrap form-wrap_icon linear-icon-magnifier">
                <select name="type" class="form-input">
                  <option value="" @if($type == "") selected @endif>Seluruh Kegiatan</option>
                  <option value="event" @if($type == "event") selected @endif>Agenda</option>
                  <option value="sub-direktorat-deposit" @if($type == "sub-direktorat-deposit") selected @endif>Sub Direktorat Deposit</option>
                  <option value="sub-direktorat-bibliography" @if($type == "sub-direktorat-bibliography") selected @endif>Sub Direktorat Bibliography</option>
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