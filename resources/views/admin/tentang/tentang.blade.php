@extends('admin.layouts.app')
@section('content')

  <div class="row">
    <div class="col-lg-12">
      <h2 > Manajemen Tentang </h2>
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
          <form action="{{$action}}" method="post" class="form-horizontal">
            @csrf
            <input type="hidden" id="id" name="id" class="form-control" value="{{$data->id ?? ''}}" readonly />
            <div class="form-group">
              <label class="control-label col-lg-2">Deskripsi</label>
              <div class="col-lg-8">
                <textarea name="description" id="description" class="form-control summernote">{{$data->description ?? ''}}</textarea>
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

              <div class="form-actions no-margin-bottom" style="text-align:center;">
                @if($data != null)
                  <input type="submit" value="Update" name="update" class="btn btn-primary"/>
                @else
                  <input type="submit" value="Simpan" name="simpan" class="btn btn-primary"/>
                @endif
                <button type="button" class="btn btn-danger simpan" id="cancel">Cancel</button>
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
      $('#cancel').on('click', reloaddata);
    })

    function create_summernote() {
      $(".summernote").summernote({
          height: 300,
      });
    }

    function reloaddata(){
      location.reload()
    }
 </script>
 @endsection
                    
                    