@extends('webpage.layouts.app')
@section('content')
@php $col = $data->collections->where('noinduk_deposit','!=',null); @endphp
<section class="breadcrumbs-custom">
  <div class="container">
    <div class="breadcrumbs-custom__inner">
      <p class="breadcrumbs-custom__title">Detail Terbitan</p>
      <ul class="breadcrumbs-custom__path">
        <li><a href="#">Home</a></li>
        <li><a href="{{url('wajibserah')}}">Wajib Serah</a></li>
        <li><a href="{{url('wajibserah/detail?id='.$col->first()->publisher_id)}}">Detail Wajib Serah</a></li>
        <li class="active">Detail Terbitan</li>
      </ul>
    </div>
  </div>
</section>

<section class="bg-default section-md" style="padding:0px">
  <div class="container">
    <div class="row row-80 col-md-12">
      <section class="section-sm">
        <div class="row flex-md-row-reverse row-30">
          <div class="col-md-8" style="text-align: justify; text-justify: inter-word;">
            <h5><a href="{{url('/wajibserah/terbitan/'.$data->id)}}"><b>{{$data->title}}</b></a></h5>
           @if($data->catalog_ruas->where('tag',520)->first())
            <p>{!!str_replace('$a','',$data->catalog_ruas->where('tag',520)->first()->value)!!}</p>
            @endif
            <p>No Deposit : {!!$col->first()->noinduk_deposit!!}</p>
            <button class="button button-primary">Eksemplar  : {!!$col->count()!!}</button>
          </div>
          <div class="col-md-4">
            @if($data->coverurl != null)
              <figure><img class="lazy" data-src="https://opac.perpusnas.go.id/uploaded_files/sampul_koleksi/original/{{$data->worksheet->name}}/{{$data->coverurl}}" alt="" width="300" height="400"/>
              </figure>
            @else
              <figure><img class="lazy" data-src="https://opac.perpusnas.go.id/uploaded_files/sampul_koleksi/original/nophoto.jpg" alt="" width="300" height="400"/>
              </figure>
            @endif
          </div>
        </div>
      </section>
    </div>
  </div>
</section>

<section class="section-md bg-default">
  <div class="container">
    <div class="row row-60">
      <div class="col-sm-12">
        <!-- Bootstrap tabs-->
        <div class="tab-content text-left">
          <div class="tab-pane fade show active">
            <h5>Additional Information</h5>
            <table class="table-product-info">
              <tr>
                <td>Year</td>
                <td>{{$data->publishyear}}</td>
              </tr>
              <tr>
                <td>Penulis</td>
                <td>{{$data->author}}</td>
              </tr>
              <tr>
                <td>Penerbit</td>
                <td><a href="/wajibserah/detail?id={{$col->first()->master_publisher->publisher_id}}">@if($col->first()->master_publisher){{$col->first()->master_publisher->publisher_name}}@endif</a></td>
              </tr>
              <tr>
                <td>ISBN / ISSN</td>
                <td>{{$data->isbn}}</td>
              </tr>
              <tr>
                <td>Edisi Serial</td>
                <td>{{$data->edisiserial}}</td>
              </tr>
              <tr>
                <td>Edisi</td>
                <td>{{$data->edition}}</td>
              </tr>
              <tr>
                <td>Jenis Koleksi</td>
                <td>{{$data->worksheet->name}}</td>
              </tr>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection