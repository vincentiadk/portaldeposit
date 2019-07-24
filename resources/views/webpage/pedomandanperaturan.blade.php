@extends('webpage.layouts.app')
@section('content')
  <section class="bg-default section-md">
    <div class="container">
      <div class="row">
        <div class="col-sm-12 text-center">
          <h4 class="heading-decorated">Pedoman Dan Peraturan </h4>
        </div>
      </div>
      <div class="row row-90">
        <div class="col-lg-12 col-xl-12 section-divided__main">
          <section class="section-md bg-default">
            <div class="container">
              <div id="accordion" role="tablist">

                <div class="card card-custom card-classic">
                  <div class="card-custom-heading" id="accordionHeading1" role="tab">
                    <h5 class="card-custom-title"><a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#accordionCollapse1" aria-controls="accordionCollapse1">Peraturan</a></h5>
                  </div>
                  <div class="card-custom-collapse collapse" id="accordionCollapse1" role="tabpanel" aria-labelledby="accordionHeading1">
                    <?php $no1 = 1; ?>   
                      @foreach ($datas as $data)
                        @if ($data['type'] == "peraturan") 
                          <div class="card-custom-body" style="margin-left:40px">
                            <p class="quote-default__cite"><a href="/{{$data->slug}}">{{$no1}}. <u>{{$data->title}}</u></a></p>
                            @if($data->files != "" || $data->files != null)
                              <p><a href="/storage/pdf/{{$data->files}}">Download Dokumen</a></p>
                            @endif
                          </div>
                          <?php $no1++; ?>
                        @endif
                      @endforeach
                  </div>
                </div>      
                <div class="card card-custom card-classic">
                  <div class="card-custom-heading" id="accordionHeading2" role="tab">
                    <h5 class="card-custom-title"><a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#accordionCollapse2" aria-controls="accordionCollapse2">Pedoman</a>
                    </h5>
                  </div>
                  <div class="card-custom-collapse collapse" id="accordionCollapse2" role="tabpanel" aria-labelledby="accordionHeading2">
                    <?php $no2 = 1; ?>
                      @foreach ($datas as $data)
                        @if ($data['type'] == "pedoman") 
                          <div class="card-custom-body" style="margin-left:40px">
                            <p class="quote-default__cite"><a href="/{{$data->slug}}">{{$no2}}. <u>{{$data->title}}</u></a></p>
                            @if($data->files != "" || $data->files != null)
                              <p><a href="/storage/pdf/{{$data->files}}">Download Dokumen</a></p>
                            @endif
                          </div>
                          <?php $no2++; ?>
                        @endif
                      @endforeach
                  </div>
                </div>

              </div>
            </div>
          </section>
        </div>
        <!-- <div class="col-lg-5 col-xl-4 section-divided__aside section-divided__aside-left">
          <section class="section-sm section-style-1">
            <h6>Search</h6>
            <form class="rd-search rd-mailform-inline-flex text-center" action="search-results.html" method="GET" data-search-live="rd-search-results-live">
              <div class="form-wrap form-wrap_icon linear-icon-magnifier">
                <label class="form-label" for="rd-search-form-input">Enter keyword</label>
                <input class="form-input" id="rd-search-form-input" type="text" name="s" autocomplete="off">
              </div>
              <button class="button button-primary" type="submit">Go!</button>
            </form>
          </section>
        </div> -->
      </div>
    </div>
  </section>
@endsection