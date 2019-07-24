@extends('webpage.layouts.app')
@section('content')
  <section class="breadcrumbs-custom">
    <div class="container">
      <div class="breadcrumbs-custom__inner">
        <p class="breadcrumbs-custom__title">Detail Kegiatan</p>
        <ul class="breadcrumbs-custom__path">
          <li><a href="#">Home</a></li>
          <li><a href="{{url('event')}}">Kegiatan</a></li>
          <li class="active">Detail Kegiatan</li>
        </ul>
      </div>
    </div>
  </section>


  <section class="bg-default section-md" style="padding-top:20px">
    <div class="main" >
      <div class="container">
        <div class="row">
          <div class="col-sm-9 animation animated-menu-5">
              <h5 class="heading-decorated heading-decorated_center"><b>{{$data->title}}</b></h5>
              <div class="post-meta" style="margin-top:0px">
                <div class="group">
                  <time>{{ date('d F Y', strtotime($data->date_start))}}</time><a class="meta-author" href="#"></a><a href="#">{{count($comment)}} komentar</a>
                </div>
              </div>
              <div style="text-align:justify">
                  @if(count($galerys) > 0)
                    @foreach($galerys as $galery)
                    <div class="col-sm-5" style="float:left; padding: 5px 40px 20px 0px; ">
                      <img style="min-height:200px; max-height:200px" class="lazy" data-src="/storage/event/event{{$data->id}}/{{$galery->file_name}}"/>
                    </div>
                    @endforeach
                  @else
                    <div class="col-sm-6" style="float:left; padding: 5px 40px 20px 0px; ">
                      <img style="min-height:200px; max-height:200px" class="lazy" data-src="{{asset('webpage/images/noimage.png')}}">
                    </div>
                  @endif
                  <br>
                  <div>
                    <table class="table-product-info">
                      <tr>
                        <td>Tema</td>
                        <td>{{$data->title}}</td>
                      </tr>
                      <tr>
                        <td>Jadwal Event</td>
                        <td>{{ date('d F Y', strtotime($data->date_start))}}</td>
                      </tr>
                      <tr>
                        <td>Pembicara</td>
                        <td>{{$data->speaker}}</td>
                      </tr>
                      <tr>
                        <td>Partisipan</td>
                        <td>{{$data->participant}}</td>
                      </tr>
                      <tr>
                        <td>Tempat</td>
                        <td>{{$data->place}}</td>
                      </tr>
                      <tr>
                    </table>
                  </div>
              </div>

              <div class="col-sm-12 row">
                <section class="section-sm">
                  <h5>{{count ($comment)}} komentar</h5>
                  @foreach ($comment as $comment)
                  <div class="box-comment">
                    <div class="unit flex-sm-row unit-spacing-md">
                      <div class="unit__left">
                        <div class="box-comment__icon"><span class="icon linear-icon-man"></span></div>
                      </div>
                      <div class="unit__body">
                        <div class="box-comment__body">
                          <div class="box-comment__header">
                            <div class="box-comment__header-left">
                              <p class="box-comment__title">{{$comment->commentator_name}}</p>
                              <time datetime="2017">{{ date('d F Y', strtotime($comment->created_at))}}</time>
                            </div>
                          </div>
                          <p>{{$comment->message}}</p>
                        </div>
                      </div>
                    </div>
                  </div>
                  @endforeach
                </section>
              </div>

              <div>
                <section class="section-sm">
                  <h5>Tinggalkan Komentar</h5>
                  <form class="rd-mailform rd-mailform_style-1 text-left" id="form-comment">
                    <input type="text" name="relation_id" id="relation_id" class="hidden" hidden value="{{$data->id}}">
                    <input type="text" name="relation_name" id="relation_name" class="hidden" hidden value="event">

                    <div class="form-wrap form-wrap_icon linear-icon-man">
                      <input class="form-input" id="contact-name" type="text" name="name" data-constraints="@Required">
                      <label class="form-label" for="contact-name">Nama</label>
                    </div>
                    <div class="form-wrap form-wrap_icon linear-icon-envelope">
                      <input class="form-input" id="contact-email" type="email" name="email" data-constraints="@Email @Required">
                      <label class="form-label" for="contact-email">Email</label>
                    </div>
                    <div class="form-wrap form-wrap_icon linear-icon-telephone">
                      <input class="form-input" id="contact-phone" type="text" name="phone" data-constraints="@Numeric">
                      <label class="form-label" for="contact-phone">Nomor Telepon</label>
                    </div>
                    <div class="form-wrap form-wrap_icon linear-icon-feather">
                      <textarea class="form-input" id="contact-message" name="message" data-constraints="@Required"></textarea>
                      <label class="form-label" for="contact-message">Pesan</label>
                    </div>
                    <br>
                    <p class="alert_placeholder" style="font-weight: bold;"></p>
                    <div class="cssload-speeding-wheel loading" style="display: none;"></div>
                    <button class="button button-primary" type="submit">KIRIM</button>
                  </form>
                </section>
            </div>

          </div>

          <div class="col-sm-3 margin-bottom-40 animation animated-menu-6 section-divided__aside section-divided__aside-left">
            <p style="font-size:20px;"><b>Kegiatan lainnya</b></p>
            @foreach($otherEvent as $otherEvent)
              <div class="row padding-20 padding-top-25">
                <p class="txt-13"><b><b>Berita</b></b> - {{ date('d F Y', strtotime($otherEvent->datetime))}}</p>
                <a href="#">
                  @if(count($allgalerys) > 0)
                    <?php $counter = 0; ?>
                    @foreach($allgalerys as $allgalery)
                      @if($allgalery->foreign_id == $otherEvent->id)
                          <img style="min-height:150px; max-height:150px" class="lazy" data-src="/storage/event/event{{$otherEvent->id}}/{{$allgalery->file_name}}">
                        <?php $counter++; ?>
                      @endif
                    @endforeach
                    @if($counter == 0)
                      <img style="min-height:150px; max-height:150px" class="lazy" data-src="{{asset('webpage/images/noimage.png')}}" >
                    @endif
                  @else
                    <img style="min-height:150px; max-height:150px" class="lazy" data-src="{{asset('webpage/images/noimage.png')}}">
                  @endif
                </a><br>
                <h6 class="txt-blue txt-left" style="font-size:13px">
                  <a href="/{{$otherEvent->slug}}">
                    <b>{{substr(preg_replace('#<[^>]+>#', ' ', $otherEvent['title']), 0, 50)}}
                      @if(strlen($otherEvent['title']) > 50) ... @endif
                    </b>
                  </a> 
                </h6>               
                <div style="bo"></div>
              </div>
            @endforeach
          </div>
          

        </div>   
      </div>
    </div>
  </section>

@endsection
@section('footer-link')
 <script type="text/javascript">
  $(document).ready(function() 
  {
    $("#form-comment").on('submit', submit_comment);
  });

  function submit_comment()
  {
    $.ajax({
        type : "POST",       
        url : config.apiurl + "/comment/submit",
        dataType : "json",
        data : {
          "name" : $('#form-comment').find("#contact-name").val(),
          "message" : $('#form-comment').find("#contact-message").val(),
          "email" : $('#form-comment').find("#contact-email").val(),
          "relation_id" : $('#form-comment').find("#relation_id").val(),
          "relation_name" : $('#form-comment').find("#relation_name").val()          
        },
        beforeSend: function() {
            $("#form-comment").find(".loading").show();
            $("#form-comment").find(".submit").hide();
        }
    }).done(function(response) {
      location.reload()
    }).error(function(data) {
        $('#form-comment').find(".alert_placeholder").html("Komentar Gagal Dikirim !");

        $("#form-comment").find(".loading").hide();
        $("#form-comment").find(".submit").show();
    });
    return false;
  }
 </script>
@endsection