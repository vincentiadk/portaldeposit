@extends('webpage.layouts.app')
@section('content')
  <section class="bg-default section-md">
    <div class="container">
      <div class="row" style="margin-top:0px;">
        <div class="col-sm-12 text-center">
          <h4 class="heading-decorated">FAQ</h4>
        </div>
      </div>
      <section class="section-md bg-default">
        <div class="container">
          <div id="accordion" role="tablist">
            @if(count($data) > 0)
            <?php $counter = 1; ?>
            @foreach ($data as $data)
              <!-- Bootstrap card-->
              <div class="card card-custom">
                <div class="card-custom-heading" id="accordionHeading{{$counter}}" role="tab">
                  <h5 class="card-custom-title"><a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#accordionCollapse{{$counter}}" aria-controls="accordionCollapse1">{{$data->title}}</a>
                  </h5>
                </div>
                <div class="card-custom-collapse collapse" id="accordionCollapse{{$counter}}" role="tabpanel" aria-labelledby="accordionHeading{{$counter}}">
                  <div class="card-custom-body">
                    <p>{!!$data->description!!}</p>
                  </div>
                </div>
              </div>
              <?php $counter++; ?>
            @endforeach
            @endif
          </div>
        </div>
      </section>
    </div>
  </section>
@endsection