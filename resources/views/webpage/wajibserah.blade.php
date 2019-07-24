@extends('webpage.layouts.app')
@section('content')
  <section class="bg-default section-md">
    <div class="container">
      <div class="row row-80">
        <div class="col-lg-7 col-xl-9 section-divided__main">
          <div class="section-sm">
            <section class="section-xl bg-default" style="padding-top: 0px; margin-top:-50px">
              <div class="container" >
                <div class="row justify-content-xl-center row-50 text-center">
                  <div class="col-xl-9">
                    <h3>Wajib Serah</h3>
                  </div>
                </div><br>
                <div class="row row-60">
                  @foreach($data as $dat)
                  <div class="col-md-6 col-xl-3">
                    <article class="post-quote"><a href="/wajibserah/detail?id={{$dat->publisher_id}}" style="height: 250px;">
                      <div class="quote-centered">
                        <div class="quote-centered__text">
                          <p class="q" style="font-size:15px;">
                            <b>
                              {{substr(preg_replace('#<[^>]+>#', ' ', $dat['publisher_name']), 0, 30)}}
                              @if(strlen($dat['publisher_name']) > 30) ... @endif
                            </b>
                          </p>
                        </div>
                        <p class="quote-centered__cite" style="font-size:13px;">
                          {{substr(preg_replace('#<[^>]+>#', ' ', $dat['address1']), 0, 40)}}
                          @if(strlen($dat['address1']) > 40) ... @endif
                        </p>
                        <p>{{$dat->city}}</p>
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
                  <a class="icon linear-icon-arrow-left text-left" href="/wajibserah?page={{$current_page - 1}}&search={{$search}}&type={{$type}}"><span> Sebelumnya</span></a>
                @endif
              </div>
              <div class="col-xl-6 text-right">
                @if ($current_page == "1" && $current_page == $last_page)
                @elseif ($current_page == "1" && $current_page != $last_page)
                  <a class="icon text-right" href="/wajibserah?page={{$current_page + 1}}&search={{$search}}&type={{$type}}"><span> Selanjutnya </span><span class="linear-icon-arrow-right"></span></a>
                @elseif ($current_page != "1" && $current_page == $last_page)
                @else
                  <a class="icon text-right" href="/wajibserah?page={{$current_page + 1}}&search={{$search}}&type={{$type}}"><span> Selanjutnya </span><span class="linear-icon-arrow-right"></span></a>
                @endif
                {{$data->links()}}
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-5 col-xl-3 section-divided__aside section-divided__aside-left">
          <section class="section-sm section-style-1">
            <h6>Telusuri</h6>
            <form class="rd-search text-center" action="/wajibserah" method="GET" data-search-live="rd-search-results-live">
              <div class="form-wrap form-wrap_icon linear-icon-magnifier">
                <select name="type" class="form-input">
                  <option value="" @if($type == "") selected @endif>Seluruh Wajib Serah</option>
                  <option value="Pemerintah" @if($type == "Pemerintah") selected @endif>Pemerintah</option>
                  <option value="Swasta" @if($type == "Swasta") selected @endif>Swasta</option>
                </select>
              </div>
              <div class="form-wrap form-wrap_icon linear-icon-magnifier">
                <select name="propinsi" clas="form-input">
                  <option value="">Seluruh Propinsi</option>
                  @foreach($props as $prop)
                  <option value="{{$prop->code}}" @if($prop->code==$propinsi) selected @endif>{{$prop->namapropinsi}}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-wrap form-wrap_icon linear-icon-magnifier">
                <input class="form-input" type="text" name="search" autocomplete="off" value="{{$search}}" placeholder="Telusuri Wajib Serah">
              </div>
              <button class="button button-primary" type="submit">Cari</button>
            </form>
            <br>
            @if($search !="" || $type != "" || $propinsi !="")
            <span><b>Ditemukan <i>{{$count}}</i> Wajib serah didalam penelusuran {{$type}} 
              {{$propinsi}}
            @if($search !="") tentang <i>{{$search}}</i> @endif</b></span>
            @endif
           
          </section>
          <hr>
          <section class="section-sm section-style-1">
            <h6>Wajib Serah Per Provinsi</h6><br>
            <table>
                @foreach($kolprop as $kolprop)
                <tr>
                  <td><a href="/wajibserah/?propinsi={{$kolprop->code}}">{{$kolprop->label}}</a></td>
                  <td><a href="/wajibserah/?propinsi={{$kolprop->code}}">({{$kolprop->total}})</a></td>
                </tr>
                @endforeach
            </table>
          </section>
        </div>
      </div>
    </div>
  </section>
@endsection