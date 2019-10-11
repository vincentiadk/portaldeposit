@extends('web.layouts.master')
@section('content')
@php 
$cols = $detail->collections->where('noinduk_deposit','!=',null);
if($cols->count() > 0){
    $col = $cols->first();
}
$titles = $detail->catalog_ruas->where('tag','245')->first()->value;
$isbns = $detail->catalog_ruas->where('tag','020')->first();
$issns = $detail->catalog_ruas->where('tag','022')->first();

$title = ""; $isbn=""; $issn="";
if(preg_match('/[$]a(.*?)[$]/', $titles, $match) == 1) {
    $title = trim($match[1]);
} else if(preg_match('/[$]a(.*)/', $titles, $match) == 1) {
    $title = trim($match[1]);
}  else {
    $title = $detail->title;
}
$title = str_replace(['/',':'], '',$title);

if($isbns){
    if(preg_match('/[$]a(.*?)[$]/',$isbns->value, $match) == 1) {
        $isbn = trim($match[1]);
    } else if(preg_match('/[$]a(.*)/', $isbns->value, $match) == 1) {
        $isbn = trim($match[1]);
    }
}

if($issns){
    if(preg_match('/[$]a(.*?)[$]/', $issns->value, $match) == 1) {
        $issn = trim($match[1]);
    } else if(preg_match('/[$]a(.*)/', $issns->value, $match) == 1) {
        $issn = trim($match[1]);
    }
}
@endphp
<section id="subintro">
  <div class="container">
    <div class="row">
      <div class="span12">
        <h3>{{$title}}</strong></h3>
    </div>
</div>
</div>
</section>
<section id="maincontent">
    <div class="container">
        <div class="row">
            <div class="span12">
                <div class="row-fluid">
                    <div class="span8">
                        <aside>
                            <div class="widget">
                                <h4>Detail Koleksi</h4>
                                <ul class="project-detail">
                                    <li><label>Judul : </label> {{$detail->publisher_name}}</li>
                                    <li><label>Penerbit : </label> {{$detail->address1}}</li>
                                    <li><label>Jenis : </label> {{$detail->city}}</li>
                                    @if($isbn != "")
                                    <li> <label> ISBN : </label>{{ $isbn }} ></li>
                                    @endif
                                    @if($issn != "")
                                    <li> <label> ISSN : </label>{{ $issn }} </li>
                                    @endif
                                    <li><label>Provinsi : </label>{{$detail->propinsi->namapropinsi}}</li>
                                    <li><label>Jumlah Terbitan : </label>{{$total}}</li>
                                </ul>
                            </div>
                        </aside>
                    </div>
                    <div class="span4">
                        <aside>
                            <div class="widget">
                                @if($detail->coverurl != null)
                                <img class="lazy" data-src="https://opac.perpusnas.go.id/uploaded_files/sampul_koleksi/original/{{$detail->worksheet->name}}/{{$detail->coverurl}}" />
                                @else
                                <img class="lazy" data-src="https://opac.perpusnas.go.id/uploaded_files/sampul_koleksi/original/nophoto.jpg" />
                                @endif
                            </div>
                        </aside>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection