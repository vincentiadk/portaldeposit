@extends('web.layouts.master')
@section('content')
@php 
$cols = $data->collections->where('category_id',4);
if($cols->count() > 0){
    $col = $cols->first();
}
$titles = $data->catalog_ruas->where('tag','245')->first()->value;
$isbns = $data->catalog_ruas->where('tag','020')->first();
$issns = $data->catalog_ruas->where('tag','022')->first();
$abstracts = $data->catalog_ruas->where('tag','520')->first();

$title = ""; $isbn=""; $issn=""; $abstract="";
if(preg_match('/[$]a(.*?)[$]/', $titles, $match) == 1) {
    $title = trim($match[1]);
} else if(preg_match('/[$]a(.*)/', $titles, $match) == 1) {
    $title = trim($match[1]);
}  else {
    $title = $data->title;
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
if($abstracts){
    if(preg_match('/[$]a(.*?)[$]/',$abstracts->value, $match) == 1) {
        $abstract = trim($match[1]);
    } else if(preg_match('/[$]a(.*)/', $abstracts->value, $match) == 1) {
        $abstract = trim($match[1]);
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
                    <div class="span4">
                        <aside>
                            <div class="widget">
                                <h4>Cover</h4>
                                @if($data->coverurl != null)
                                <img class="lazy" data-src="https://opac.perpusnas.go.id/uploaded_files/sampul_koleksi/original/{{$data->worksheet->name}}/{{$data->coverurl}}" />
                                @else
                                <img class="lazy" data-src="https://opac.perpusnas.go.id/uploaded_files/sampul_koleksi/original/nophoto.jpg" />
                                @endif
                            </div>
                        </aside>
                    </div>
                    @if($data->worksheet->id==13)
                    @php 
                    $arrBerkala = DB::select(DB::raw('select edisiserial, count(edisiserial) as jumlah,acquireddate from collections where catalog_id='.$data->id.' and category_id=4 and edisiserial is not null group by edisiserial,acquireddate union all select edisiserial, count(1),acquireddate from collections where catalog_id='.$data->id.' and category_id=4 and edisiserial is null group by edisiserial,acquireddate order by edisiserial')); 
                    @endphp
                    <div class="span4">
                        <aside>
                            <div class="widget">
                                <h4>Detail Koleksi</h4>
                                <ul class="project-detail">
                                    <li><label>Judul : </label> {{$title}}</li>
                                    <li><label>Penerbit : </label>  <a href="/wajibserah/detail?id={{$col->master_publisher->publisher_id}}">{{$col->master_publisher->publisher_name}}</a></li>
                                    <li><label>Tahun Terbit : </label> {{$col->publishyear}}</li>
                                    <li><label>Lokasi Terbit : </label>{{$col->master_publisher->propinsi->namapropinsi}}, {{$col->master_publisher->city}}</li>
                                    <li><label>Jenis : </label> {{$data->worksheet->name}}</li>
                                    @if($isbn != "")
                                    <li> <label> ISBN : </label>{{ $isbn }} </li>
                                    @endif
                                    @if($issn != "")
                                    <li> <label> ISSN : </label>{{ $issn }} </li>
                                    @endif
                                    
                                    <li><label>Jumlah Eksempelar Deposit : </label>{{ $cols->count() }}  Copy</li>
                                </ul>
                            </div>
                            @if(strlen($abstract) > 5)
                            <div class="widget">
                                <h4>Abstrak</h4>
                                <p>{{$abstract}}</p>
                            </div>
                            @endif
                        </aside>
                    </div>
                    <div class="span4">
                        <aside>
                            <div class="widget">
                                <h4>Edisi</h4>
                                <div class="accordion" id="edisi">
                                <div class="accordion-group">
                                  <div class="accordion-heading">
                                    <a class="accordion-toggle active" data-toggle="collapse" data-parent="#edisi" href="#collapseOne">
                                        <i class="icon-caret-right"></i> Daftar Edisi </a>
                                    </div>
                                    <div id="collapseOne" class="accordion-body collapse">
                                        <div class="accordion-inner">
                                        <ul class="project-detail">
                                            @foreach($arrBerkala as $berkala)
                                            @if($berkala->edisiserial=="")
                                        <li> Edisi tidak diketahui : {{$berkala->jumlah}} copy  </li>
                                            @else
                                        <li> {{$berkala->edisiserial}} : {{$berkala->jumlah}} copy </li>
                                            @endif
                                            @endforeach
                                    </ul>
                                    </div>
                                    </div>
                                </div>
                                </div>    
                            </div>
                           
                        </aside>
                    </div>
                    @else
                     <div class="span8">
                        <aside>
                            <div class="widget">
                                <h4>Detail Koleksi</h4>
                                <ul class="project-detail">
                                    <li><label>Judul : </label> {{$title}}</li>
                                    <li><label>Penerbit : </label> <a href="/wajibserah/detail?id={{$col->master_publisher->publisher_id}}">{{$col->master_publisher->publisher_name}}</a></li>
                                    <li><label>Tahun Terbit : </label> {{$col->publishyear}}</li>
                                    <li><label>Lokasi Terbit : </label>{{$col->master_publisher->propinsi->namapropinsi}}, {{$col->master_publisher->city}}</li>
                                    <li><label>Jenis : </label> {{$data->worksheet->name}}</li>
                                    @if($isbn != "")
                                    <li> <label> ISBN : </label>{{ $isbn }} </li>
                                    @endif
                                    @if($issn != "")
                                    <li> <label> ISSN : </label>{{ $issn }} </li>
                                    @endif
                                    
                                    <li><label>Jumlah Eksempelar Deposit : </label>{{ $cols->count() }}  Copy</li>
                                </ul>
                            </div>
                            @if(strlen($abstract) > 5)
                            <div class="widget">
                                <h4>Abstrak</h4>
                                <p>{{$abstract}}</p>
                            </div>
                            @endif
                        </aside>
                    </div>
                    @endif
                   

                </div>
            </div>
        </div>
    </div>
</section>
@endsection