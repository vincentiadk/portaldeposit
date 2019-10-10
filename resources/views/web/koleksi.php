@extends('web.layouts.master')
@section('content')
<section id="subintro">
	<div class="container">
		<div class="row">
			<div class="span12">
				<h3>Direktori <strong> Koleksi</strong></h3>
			</div>
		</div>
	</div>
</section>
<section>
	<div class="container">
		<div class="row">
			<div class="span12">
				<aside>
					<div class="widget">
						<h4>Telusuri Koleksi KCKR</h4>
						<form class="form-search" action="/koleksi" method="GET" data>
							<select name="type" class="input-medium">
								<option value="" @if($type == "") selected @endif>Seluruh Koleksi</option>
								<option value="Pemerintah" @if($type == "Pemerintah") selected @endif>Pemerintah</option>
								<option value="Swasta" @if($type == "Swasta") selected @endif>Swasta</option>
							</select>
							<select name="propinsi" clas="input-medium">
								<option value="">Seluruh Propinsi</option>
								@foreach($props as $prop)
								<option value="{{$prop->code}}" @if($prop->code==$propinsi) selected @endif>{{$prop->namapropinsi}}</option>
								@endforeach
							</select>
							<input placeholder="Ketik Sesuatu.." type="text" name="search" class="input-medium search-query" value="{{$search}}">
							<button type="submit" class="btn btn-flat btn-color">Search</button>
						</form>
					</div>
				</aside>
			</div>
		</div>
		@foreach($data->chunk(4) as $dat4)
		<div class="row">
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
			<div class="mini-layout fluid span4 ebook">
				<div class="mini-layout-sidebar">
					@if($dat->coverurl != null)
					<img class="lazy" data-src="https://opac.perpusnas.go.id/uploaded_files/sampul_koleksi/original/{{$dat->worksheet->name}}/{{$dat->coverurl}}" />
					@else
					<img class="lazy" data-src="https://opac.perpusnas.go.id/uploaded_files/sampul_koleksi/original/nophoto.jpg" />
					@endif
				</div>
				<div class="mini-layout-body white_section">
					<a href="/wajibserah/terbitan/{{$dat->id}}">
						<h3>
							{{ $title }}
						</h3>
					</a>
					<p class="left">
						@if(!empty($col) && $col->master_publisher)
						<a href="/wajibserah/detail?id={{$col->publisher_id}}" style="color: rgba(255, 255, 255, 0.7)">
							{{$col->master_publisher->publisher_name}} - {{$data->publishyear}}
						</a>
						@endif 
						<br/>
						<i class="icon-info">{{ $data->worksheet->name }}</i>
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
	</div>
{{$data->links()}}
</section>
@endsection