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
							<input placeholder="Ketik Sesuatu.." type="text" name="search" class="input-medium search-query" value="{{$search}}">
							<button type="submit" class="btn btn-flat btn-color">Search</button>
						</form>
					</div>
				</aside>
			</div>
		</div>
		<div class="row">
		@foreach($data->chunk(15) as $dat6)
		<ul class="span3">
			@foreach($dat6 as $dat)
			<li>
				<a href="/wajibserah/detail?id={{$dat->publisher_id}}" style="color:#000">
						<p class="text-info" style="margin-top:5px;margin-bottom:0px"><strong>{{$dat['publisher_name']}}</strong></p>
						<span class="text-success">{{$dat['address1']}}</span>
						<span class="text-warning"> ( {{$dat->collections->count()}} Terbitan )</span>
				</a>
			</li>
			@endforeach	
		</ul>
		@endforeach
		<div class="span3">
			<h6>Wajib Serah Per Provinsi</h6><br>
            <table class="table">
                @foreach($kolprop as $kolprop)
                <tr>
                  <td><a href="/wajibserah?propinsi={{$kolprop->code}}">{{$kolprop->label}}</a></td>
                  <td><a href="/wajibserah?propinsi={{$kolprop->code}}">({{$kolprop->total}})</a></td>
                </tr>
                @endforeach
            </table>
		</div>
		</div>
		
		{{$data->links()}}
	</div>
</section>
@endsection