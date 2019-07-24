@extends('admin.layouts.app')
@section('content')
<div class="row">
  <div class="col-lg-12">
    <h2> Manajemen Komentar </h2>
  </div>
</div>
<hr />
<div class="row">
  <div class="col-lg-12">
    <div class="panel panel-default">
      <div class="panel-body">
        <div class="table-responsive">
          <div class="row">
          	<div class="col-sm-1">
          		<h5 style="font-weight: bold;">Jenis</h5>
          	</div>
            <div class="col-sm-11">
          		<h5 style="font-weight: bold;">: @if($type == "news") Berita @elseif($type == "event") Kegiatan @endif</h5>
            </div>
          </div>
          <div class="row">
          	<div class="col-sm-1">
          		<h5 style="font-weight: bold;">Judul</h5>
          	</div>
            <div class="col-sm-11">
          		<h5 style="font-weight: bold;">: {{$content->title}}</h5>
            </div>
          </div>
          <br>
          <hr>
          <table class="table table-striped" id="dataTables">
            <thead>
              <tr>
                <th width="1%">#</th>
                <th width="20%">Nama</th>
                <th width="10%">Tipe</th>
                <th>Komentar</th>
                <th width="10%">Status</th>
                <th width="10%">Pilihan</th>
              </tr>
            </thead>
            <tbody>
            	@if(count($data) > 0)
            		@php
            			$no = 1;
            		@endphp
	            	@foreach($data as $data)
	            		<tr>
	            			<td>{{$no}}</td>
	            			<td>{{$data->commentator_name}}</td>
	            			<td>{{$data->commentator_type}}</td>
	            			<td>{{$data->message}}</td>
	            			<td>
	            				@if($data->status == 1) Published
	            				@else Not Published
	            				@endif
	            			</td>
	            			<td>
	            				@if($data->status == 1) <button type="button" id="btn-update-batal-comment" class="btn btn-danger btn-sm"> Batalkan Publish</button>
	            				@else  <button type="button" id="btn-update-setuju-comment" class="btn btn-primary btn-sm"> Setujui Publish</button>
	            				@endif
	            			</td>
	            		</tr>
	            		@php
	            			$no++;
	            		@endphp
	            	@endforeach
            	@endif
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('add-js')
  <script>
    $(document).ready(function() 
    { 
    	$('#btn-update-batal-comment').on('click', updatebatal)
    	$('#btn-update-setuju-comment').on('click', updatesetuju)
    });

    function updatebatal(){
	    $.ajax({
	        type : "POST",       
	        url : "{{ url('/api') }}/comment/update/{{$type}}/0/{{$data->id}}",
	        dataType : "json",
	        data : {
	          "slug" : '{{$slug}}'       
	        }
	    }).done(function(response) {
	    	location.reload()
	    }).error(function(data) {
	    	alert("Terjadi Kesalahan Pada Server !")
	    });
	    return false;
    }

    function updatesetuju(){
	    $.ajax({
	        type : "POST",       
	        url : "{{ url('/api') }}/comment/update/{{$type}}/1/{{$data->id}}",
	        dataType : "json",
	        data : {
	          "slug" : '{{$slug}}'       
	        }
	    }).done(function(response) {
	    	location.reload()
	    }).error(function(data) {
	    	alert("Terjadi Kesalahan Pada Server !")
	    });
	    return false;
    }
  </script>
@endsection