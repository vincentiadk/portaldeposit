@extends('web.layouts.master')
@section('content')
<section id="subintro">
	<div class="container">
		<div class="row">
			<div class="span12">
				<h3>Direktori <strong> Wajib Serah</strong></h3>
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
						<h4>Telusuri Wajib Serah</h4>
						<form class="form-search" action="/wajibserah" method="GET" data>
							<select name="type" class="input-medium">
								<option value="" @if($type == "") selected @endif>Seluruh Wajib Serah</option>
								<option value="Pemerintah" @if($type == "Pemerintah") selected @endif>Pemerintah</option>
								<option value="Swasta" @if($type == "Swasta") selected @endif>Swasta</option>
							</select>
							<select name="propinsi" clas="input-medium">
								<option value="">Seluruh Propinsi</option>
								@foreach($props as $prop)
								<option value="{{$prop->code}}" @if($prop->code==$propinsi) selected @endif>{{$prop->namapropinsi}}</option>
								@endforeach
							</select>
							<input placeholder="Ketik Sesuatu.." type="text" class="input-medium search-query" value="{{$search}}">
							<button type="submit" class="btn btn-flat btn-color">Search</button>
						</form>
					</div>
				</aside>
			</div>
		</div>
		@foreach($data->chunk(6) as $dat6)
		<div class="row-fluid">
			@foreach($dat6 as $dat)
			<a href="/wajibserah/detail?id={{$dat->publisher_id}}">
				<div class="span2">
					<p><strong>{{$dat['publisher_name']}}</strong></p>
					<p>{{$dat['address1']}}</p>
				</div>
			</a>
			@endforeach
		</div>
		@endforeach
		{{$data->links()}}
	</div>
</section>
@endsection