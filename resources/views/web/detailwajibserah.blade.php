@extends('web.layouts.master')
@section('content')
<section id="subintro">
	<div class="container">
		<div class="row">
			<div class="span12">
				<h3>{{$detail->publisher_name}}</strong></h3>
			</div>
		</div>
	</div>
</section>
<section id="maincontent">
	<div class="container">
		<div class="row">
			<div class="span8">
				<div class="row-fluid">
					<div class="span12">
						<aside>
							<div class="widget">
								<h4>Detail Wajib Serah</h4>
								<ul class="project-detail">
									<li><label>Nama :</label> {{$detail->publisher_name}}</li>
									<li><label>Alamat :</label> {{$detail->address1}}</li>
									<li><label>Kota :</label> {{$detail->city}}</li>
									<li><label>Provinsi :</label>{{$detail->propinsi->namapropinsi}}</li>
									<li><label>Jumlah Terbitan :</label>{{$total}}</li>
								</ul>
							</div>
						</aside>
					</div>
				</div>
				@foreach($data->chunk(4) as $dat4)
				<div class="row-fluid">
					@foreach($dat4 as $dat)
					@php 
						$cols = $dat->collections->where('noinduk_deposit','!=',null);
						if($cols->count() > 0){
							$col = $cols->first();
						}
						$titles = $dat->catalog_ruas->where('tag','245')->first()->value;
						$isbns = $dat->catalog_ruas->where('tag','020')->first();
						$issns = $dat->catalog_ruas->where('tag','022')->first();

						$title = ""; $isbn=""; $issn="";
						if(preg_match('/[$]a(.*?)[$]/', $titles, $match) == 1) 
						{
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
					@endphp
					<div class="mini-layout fluid span3 ebook">
						<div class="mini-layout-sidebar">
							@if($dat->coverurl != null)
							<img class="lazy" data-src="https://opac.perpusnas.go.id/uploaded_files/sampul_koleksi/original/{{$dat->worksheet->name}}/{{$dat->coverurl}}" />
							@else
							<img class="lazy" data-src="https://opac.perpusnas.go.id/uploaded_files/sampul_koleksi/original/nophoto.jpg" />
							@endif
						</div>
						<div class="mini-layout-body">
							<a href="/wajibserah/terbitan/{{$dat->id}}" >
								<h3 style="color:#000">
									{{ $title }}
								</h3>
							</a>
							<p class="left"  style="color:#000">
								@if(!empty($col) && $col->master_publisher)
								<a href="/wajibserah/detail?id={{$col->publisher_id}}"  style="color:#000">
									{{$col->master_publisher->publisher_name}} - {{$dat->publishyear}}
								</a>
								@endif 
								<br/>
								<i class="icon-info">{{ $dat->worksheet->name }}</i>
								@if($isbn != "")
								<i class="icon-barcode"> ISBN {{ $isbn }} </i>
								@endif
								@if($issn != "")
								<i class="icon-barcode"> ISSN {{ $issn }} </i>
								@endif
								<i class="icon-book"> {{ $cols->count() }}  Copy  </i>
								<br/>
								Tgl Terima <span class="date"><i class="icon-calendar"></i> {{ $col->createdate }} </span> 
							</p>
						</div>
					</div>
					@endforeach
				</div>
				@endforeach
				{{$data->links()}}
			</div>
			<div class="span4">
				<aside>
					<div class="widget">
						<h4>Telusuri Wajib Serah</h4>
						<form class="form-search" action="/wajibserah/detail" method="GET" data>
							<select name="type" class="input-medium">
								<option value="" @if($type == "") selected @endif>Seluruh Koleksi</option>
								<option value="Pemerintah" @if($type == "Pemerintah") selected @endif>Pemerintah</option>
								<option value="Swasta" @if($type == "Swasta") selected @endif>Swasta</option>
							</select>
							<input placeholder="Ketik Sesuatu.." type="text" name="search" class="input-medium search-query" value="{{$search}}">
							<button type="submit" class="btn btn-flat btn-color">Search</button>
						</form>
					</div>
					<div class="widget">
						<h4>Download Data Terbitan</h4>
						<form class="form-search" action="/wajibserah/download" method="GET">
							<div class="row">
								<select class="input-medium" name="month">
									<option value="01">Januari</option>
									<option value="02">Februari</option>
									<option value="03">Maret</option>
									<option value="04">April</option>
									<option value="05">Mei</option>
									<option value="06">Juni</option>
									<option value="07">Juli</option>
									<option value="08">Agustus</option>
									<option value="09">September</option>
									<option value="10">Oktober</option>
									<option value="11">November</option>
									<option value="12">Desember</option>
								</select>
							</div>
							<div class="row">
								<input type="text" name="ids" autocomplete="off" value="{{$id}}" hidden>
								<input type="type" name="type" autocomplete="off" value="filter" hidden>
								<input class="input-medium" type="text" name="year" autocomplete="off" value="2019">
							</div>
							<button class="btn btn-info" name="filter" type="submit" style="width: 100%;">Download <i class="icon-file-excel-o"></i></button>
						</form>
						<form class="form-search" action="/wajibserah/download" method="GET" data-search-live="rd-search-results-live">
							<input type="text" name="ids" autocomplete="off" value="{{$id}}" hidden>
							<input type="type" name="type" autocomplete="off" value="all" hidden>
							<button class="btn btn-info" name="all" type="submit" style="width: 100%">Download Seluruh Terbitan <i class="fa fa-file-excel-o"></i></button>
						</form>
					</div>
				</aside>
			</div>
		</div>
	</div>
</section>
@endsection