@extends('webpage.layouts.app')
@section('content')
  <section class="bg-default section-md">
    <div class="container">
      <div class="row">
        <div class="col-sm-12 text-center">
          <h4 class="heading-decorated">Tentang Kami</h4>
        </div>
      </div>
      <section class="section-md bg-default">
        <div class="container">
          <div class="row row-50 justify-content-md-center justify-content-lg-start">
            <div class="col-md-12 col-lg-12">
              @if(count($data) > 0)
              <article class="blurb blurb-circle">
                <div class="unit flex-sm-row unit-spacing-md">
                  <div class="unit__left">
                    <div class="blurb-circle__icon"><span class="icon linear-icon-flag3"></span></div>
                  </div>
                  <div class="unit__body">
                      @foreach ($data as $data)
                        <p class="heading-6 blurb__title">{{$data->title}}</p>
                        <p>
                          {!!$data->description!!}
                        </p>
                      @endforeach
                  </div>
                </div>
              </article>
              @endif
            </div>
          </div>
        </div>
      </section>
    </div>
  </section>
@endsection