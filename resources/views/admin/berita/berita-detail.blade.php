@extends('admin.layouts.app')
@section('content')


<div class="row">
    <div class="col-lg-12">
        <h2> Detail Berita </h2>
    </div>
</div>

<hr />  
@if ($mode=='detail' && $comment > 0) 
<div class="row" align="right" style="margin: 10px;">
    <a href="/bo/comment/{{$data->slug}}" class="btn btn-primary btn-sm">Atur Komentar</a>
</div>
@endif

<div class="row">
  <div class="col-sm-12">
    <div class="panel panel-default">
      <div class="panel-body">
        @if (!empty(session('status')) && session('status') ==1)
        <div class="alert alert-success">
            <strong>Berhasil!</strong>
        </div>
        @elseif (!empty(session('status')) && session('status') ==0)
        <div class="alert alert-danger">
            <strong>Gagal!</strong>
        </div>
        @endif  
        @if (!empty(session('files_error')) && session('files_error')>0)
        <div class="alert alert-danger">
            <strong>{{session('files_error')}} file gagal diupload</strong>
        </div>
        @endif
        <form action="{{$action}}" method="post" class="form-horizontal" id="form1" enctype="multipart/form-data">
            @csrf
            <input type="hidden" id="id" name="id" class="form-control" value="{{$id ?? ''}}" readonly />
            <div class="form-group">
                <label class="control-label col-lg-2">Judul</label>
                <div class="col-lg-8">
                    <textarea id="title" name="title" class="form-control activator" readonly>{{$data->title ?? ''}}</textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-lg-2">Kategori</label>
                <div class="col-lg-8">
                    <select class="form-control activator" id="kategori" name="type" value="{{$data->type ?? 'event'}}" aria-describedby="basic-addon1" disabled>
                        <option value="news">Berita</option>
                        <option value="news_deposit">Deposit</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-lg-2">Deskripsi</label>
                <div class="col-lg-8">
                    <textarea name="description" id="description" class="form-control activator summernote" readonly>{{$data->description ?? ''}}</textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-lg-2">Komentar</label>
                <div class="col-lg-8">
                    <select class="form-control activator" id="is_comment" name="is_comment" value="{{$data->is_comment ?? '1'}}" aria-describedby="basic-addon1" disabled>
                        <option value="1">Diizinkan</option>
                        <option value="0">Tidak diizinkan</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-lg-2">Waktu Berita Dibuat</label>
                <div class="col-lg-8">
                    <input type="text" id="created_at" name="created_at" class="form-control activator input-date" value="{{$data->created_at ?? ''}}" readonly/>
                </div>
            </div>
            <!-- List File -->
            <div class="form-group">  
                <label class="control-label col-lg-2">Gambar</label>
                <div class="panel-group col-lg-8" id="accordion" role="tablist" aria-multiselectable="true">
                  <div class="panel panel-default hide-edit" >
                    <div class="panel-heading" role="tab" id="headingOne">
                        <h4 class="panel-title">
                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                Tambah gambar
                            </a>
                        </h4>
                    </div>
                    <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                      <div class="panel-body">
                        <div class="form-group">
                          <div class="col-lg-2 col-sm-4">
                            <button type="button" class="btn btn-primary" id="add-file">
                                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                            </button> 
                            <button type="button" class="btn btn-danger" id="remove-file">
                                <span class="glyphicon glyphicon-minus" aria-hidden="true"></span>
                            </button>
                        </div>
                        <div class="col-lg-10 col-sm-8 input-group" id='group-file'>
                            <input type="file" name='files[]'  class="form-control"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if($mode == 'detail')
        <div class="panel panel-default" id='list-file'>
            <div class="panel-heading" role="tab" id="headingTwo">
                <h4 class="panel-title">
                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        Daftar Gambar
                    </a>
                </h4>
            </div>
            <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                <div class="panel-body">

                    <label class="hide-edit" style="color:red">*Pilih gambar yg akan dihapus</label>
                    <div class="form-group">
                        @foreach($galeries as $gal)
                        <div class="col-lg-3"><label class="btn"><img src="/storage/berita/berita{{$data->id}}/{{$gal->file_name}}" class="img-thumbnail img-check"><input type="checkbox" name="delete_id[]" value="{{$gal->id}}" class="hidden checkbox-delete" autocomplete="off" disabled></label></div>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
        @endif
    </div>
</div>

@if($mode == 'detail')
<div class="form-group">
    <label class="control-label col-lg-2">Status</label>
    <div class="col-lg-8">
        <p class="control-label" style="float: left;">{{$data->status ?? ''}}</p>
    </div>
</div>
<div class="form-group">
    <label class="control-label col-lg-2">Dibuat Oleh</label>
    <div class="col-lg-8">
        <p class="control-label" style="float: left;">{{$data->createdBy->name ?? ''}}</p>
    </div>
</div>
<div class="form-group">
    <label class="control-label col-lg-2">Diupdate Oleh</label>
    <div class="col-lg-8">
        <p class="control-label" style="float: left;">{{$data->updatedBy->name ?? ''}}</p>
    </div>
</div>
<div class="form-group">
    <label class="control-label col-lg-2">Dibuat Tanggal</label>
    <div class="col-lg-8">
        <p class="control-label" style="float: left;">{{$data->created_at ?? ''}}</p>
    </div>
</div>
<div class="form-group">
    <label class="control-label col-lg-2">Diupdate Tanggal</label>
    <div class="col-lg-8">
        <p class="control-label" style="float: left;">{{$data->updated_at ?? ''}}</p>
    </div>
</div>
@endif      
<div class="form-actions no-margin-bottom" style="text-align:center;">
    <input type="submit" value="Simpan" name="simpan" class="btn btn-primary simpan"  style="display: none"/>
    <input type="submit" value="Simpan & Published" name="simpanpub" class="btn btn-primary simpan"  style="display: none"/>
    @if ($mode=='detail') 
    <button type="button" class="btn btn-primary detail" id="ubah">Ubah</button>
    <input type="submit" value="Hapus" name="delete" id="delete" class="btn btn-danger detail"/>
    <button type="button" class="btn btn-danger simpan" id="cancel" style="display: none">Cancel</button>
    @endif
</div>
</form>
</div>
</div>
</div>
</div>
@endsection

@section('add-js')
<script type="text/javascript">
  $(document).ready(function() {

    $("#add-file").click(function(){
      $("#group-file").append('<input type="file" name="files[]"  class="form-control"/>')
  });

    $("#remove-file").click(function(){
      $('#group-file').children().last().remove();
  });

    create_summernote();
    create_datepicker();
    if ('{{$mode}}' == 'detail') 
    {
      $('.summernote').summernote('disable');
      $(".simpan").hide();
      $("#kategori").val("{{$data->type ?? 'event'}}");
      $("#is_comment").val("{{$data->is_comment ?? '1'}}");
      $(".hide-edit").hide();

      $('#delete').click(function(){
         if(confirm('Apa Anda yakin akan menghapus abstract ini?')){  
           $('#form1').attr('action', '/bo/berita/delete');
       }
   });

      $("#ubah").click(function()
      {
        $('.summernote').summernote('enable');
        $(".simpan").show();
        $(".detail").hide();
        $(".activator").prop("readonly", false);
        $("#kategori").prop('disabled', false);
        $("#is_comment").prop('disabled', false);
        $(".checkbox-delete").prop('disabled', false);
        $(".hide-edit").show();

        $(".img-check").click(function(){
          $(this).toggleClass("check");
      });

    })

      $("#cancel").click(function()
      {
        location.reload();
    })
  }
  else
  {
      $(".simpan").show();
      $(".activator").prop("readonly", false);
      $("#kategori").prop('disabled', false);
      $("#is_comment").prop('disabled', false);
  }



})

  function create_summernote() {
    $(".summernote").summernote({
      height: 300,
  });
}
function create_datepicker() {
  $(".input-date").datetimepicker({
    format: 'YYYY-MM-DD HH:mm:ss'
  });
}


</script>
@endsection

@section('add-header')       
<link rel="stylesheet" href="{{asset('admin/css/img-check.css')}}"/>
@endsection
