@extends('webpage.layouts.app')
@section('content')
  <section class="bg-default section-md">
    <div class="container">
      <div class="row">
        <div class="col-sm-12 text-center">
          <h4 class="heading-decorated">Detail Pedoman dan Peraturan </h4>
        </div>
      </div>
      <div class="section-sm">
        <article class="post-classic">
          <div class="post-classic-title post-classic-title-icon linear-icon-star">
            <h5><a href="#">{{$datas->title}}</a></h5>
          </div>
          <div>
            {!!$datas->description!!}
          </div>
        </article><br><br>
        <div align="center">
          @if($datas->files != null)
            <embed src="/storage/pdf/{{$datas->files}}" width="80%" height="600">
          @endif
        </div>
      </div>
    </div>
  </section>
@endsection