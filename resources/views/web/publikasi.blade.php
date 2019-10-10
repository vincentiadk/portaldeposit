@extends('web.layouts.master')
@section('content')
<section id="subintro">
	<div class="container">
		<div class="row">
			<div class="span12">
				<h3>Publikasi <strong> Deposit</strong></h3>
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
						<h4>Telusuri Publikasi Deposit</h4>
						<form class="form-search" action="/publication" method="GET" data>
							<select name="type" class="input-medium">
								<option value="" @if($type == "") selected @endif>Seluruh Publikasi</option>
								<option value="buletin_deposit" @if($type == "buletin_deposit") selected @endif>Buletin</option>
								<option value="direktori_penerbit" @if($type == "direktori_penerbit") selected @endif>Direktori Penerbit</option>
								<option value="kin" @if($type == "kin") selected @endif>KIN</option>
								<option value="kdt" @if($type == "kdt") selected @endif>KDT</option>
								<option value="bni" @if($type == "bni") selected @endif>BNI</option>
								<option value="prosiding" @if($type == "prosiding") selected @endif>Prosiding</option>
								<option value="kckr" @if($type == "daftar_kckr") selected @endif>KCKR</option>
								<option value="literatur_sekunder" @if($type == "literatur_sekunder") selected @endif>Literatur Sekunder</option>
							</select>
							<input placeholder="Ketik Sesuatu.." type="text" name="search" class="input-medium search-query" value="{{$search}}">
							<button type="submit" class="btn btn-flat btn-color">Search</button>
						</form>
					</div>
				</aside>
			</div>
		</div>
		@foreach($data->chunk(6) as $dat6)
		<div class="row-fluid">
			@foreach($dat6 as $pub)
			@php $image = $pub->images()->where("table_name","publication")->first(); @endphp
			<div class="span2">
				<a href="/publication/{{$pub->id}}">
					@if($image)
					<img data-src="/storage/deposit/deposit{{$pub->id}}/{{$image->file_name}}" class="lazy ebook" />
					@else
					<img data-src="https://opac.perpusnas.go.id/uploaded_files/sampul_koleksi/original/nophoto.jpg" class="lazy ebook" />
					@endif
					<p><strong>{{ $pub->title }}</strong></p>
				</a>
			</div>
			@endforeach
		</div>
		@endforeach
		{{$data->links()}}
	</div>
</section>
@endsection