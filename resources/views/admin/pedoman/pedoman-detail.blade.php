@extends('admin.layouts.app')
@section('content')

  <div class="row">
    <div class="col-lg-12">
      <h2 > Detail Pedoman Dan Peraturan </h2>
    </div>
  </div>

  <hr /> 

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
          @endisset
          <form action="{{$action}}" method="post" class="form-horizontal" id="form1" enctype="multipart/form-data">
            @csrf
            <input type="hidden" id="id" name="id" class="form-control" value="{{$id ?? ''}}" readonly />
            <div class="form-group">
              <label class="control-label col-lg-2">Jenis</label>
              <div class="col-lg-8">
                <select class="form-control activator" id="type" name="type" aria-describedby="basic-addon1" disabled>
                  <option value="pedoman" @if($mode == 'detail' && $data->type == 'pedoman') selected @endif>Pedoman</option>
                  <option value="peraturan" @if($mode == 'detail' && $data->type == 'peraturan') selected @endif>Peraturan</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-lg-2">Judul</label>
              <div class="col-lg-8">
                <input type="text" id="title" name="title" class="form-control activator" value="{{$data->title ?? ''}}" readonly required/>
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
                <select class="form-control activator" id="is_comment" name="is_comment"  aria-describedby="basic-addon1" disabled>
                  <option value="1" @if(isset($data) && $data->is_comment == "1") selected @endif>Diizinkan</option>
                  <option value="0" @if(isset($data) && $data->is_comment == "0") selected @endif>Tidak Diizinkan</option>
                </select>
              </div>
            </div>

            <div class="form-group" id='dokumen'>
              <label class="control-label col-lg-2">Dokumen</label>
              <div class="col-lg-8">
                <input type="file" name='dokumen' class="form-control" class="form-control" />
              </div>
            </div>
            @if($mode=='detail' && $data->files != null)
            <div class="form-group">
              <label class="control-label col-lg-2">Tampilan Dokumen</label>
              <div class="col-lg-8" align="center">
                  <embed width="80%" height="600" src="/storage/pdf/{{$data->files}}"></embed>
              </div>
            </div>
            @endif


            @if($mode=='detail') 
            <div class="form-group">
              <label class="control-label col-lg-2">Status</label>
              <div class="col-lg-8">
                <p class="control-label" style="float: left;">{{$data->is_status ?? ''}}</p>
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
                @if($mode=='detail') 
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
      create_summernote();

      if ('{{$mode}}' == 'detail') 
      {
        $('.summernote').summernote('disable');
        $(".simpan").hide()
        $("#dokumen").hide();

        $('#delete').click(function(){
         $('#form1').attr('action', '/bo/pedoman/delete');
        });

        $("#ubah").click(function(){
            $(".simpan").show();
            $("#ubah").hide();
            $(".activator").prop("readonly", false);
            $("#type").prop('disabled', false);
            $("#is_comment").prop('disabled', false);
            $('.summernote').summernote('enable');
            $("#dokumen").show();
        })

        $("#cancel").click(function(){
            location.reload();
        })
      }
      else
      {
        $(".simpan").show();
        $(".activator").prop("readonly", false);
        $("#type").prop('disabled', false);
        $("#is_comment").prop('disabled', false);
      }
    })

  function create_summernote() {
    $(".summernote").summernote({
        height: 300,
    });
  }
 </script>
 @endsection
                    
                    