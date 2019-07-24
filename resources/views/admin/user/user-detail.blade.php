@extends('admin.layouts.app')
@section('content')

  <div class="row">
    <div class="col-lg-12">
      <h2 > Manajemen User </h2>
    </div>
  </div>

  <hr /> 

  <div class="row">
    <div class="col-sm-12">
      <div class="panel panel-default">
        <div class="panel-body">
          @if (!empty(session('status')) && session('status') == 1)
            <div class="alert alert-success">
              <strong>Berhasil!</strong>
            </div>
          @elseif (!empty(session('status')) && session('status') == 0)
            <div class="alert alert-danger">
              <strong>Gagal!</strong>
            </div>
          @endisset
          <form action="{{$action}}" method="post" class="form-horizontal">
            @csrf
            <input type="hidden" id="id" name="id" class="form-control" value="{{$id ?? ''}}" readonly />
            <div class="form-group">
              <label class="control-label col-lg-2">NIP</label>
              <div class="col-lg-8">
                <input type="text" id="nip" name="nip" class="form-control" value="{{$data->nip ?? ''}}" readonly>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-lg-2">Nama</label>
              <div class="col-lg-8">
                <input type="text" id="name" name="name" class="form-control" value="{{$data->name ?? ''}}" readonly/>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-lg-2">Email</label>
              <div class="col-lg-8">
                  <input type="text" id="email" name="email" class="form-control" value="{{$data->email ?? ''}}" readonly/>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-lg-2">Status</label>
              <div class="col-lg-8">
                <select class="form-control activator" id="is_active" name="is_active" value="{{$data->is_active ?? '0'}}" aria-describedby="basic-addon1" disabled>
                    <option value="0">Aktif</option>
                    <option value="1">Non Aktif</option>
                  </select>
              </div>
            </div>
            
            <div class="form-actions no-margin-bottom" style="text-align:center;">
              <input type="submit" value="Simpan" class="btn btn-primary simpan"  style="display: none"/>
              @if ($mode=='detail') 
                <button type="button" class="btn btn-primary" id="ubah" style="display: none">Ubah</button>
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
    if ('{{$mode}}' == 'detail') 
    {
      $(".simpan").hide()
      $("#ubah").show()
      $("#is_active").val("{{$data->is_active ?? '0'}}");

      $("#ubah").click(function(){
          $(".simpan").show();
          $("#ubah").hide();
          $(".form-control").prop("readonly", false);
          $("#is_active").prop('disabled', false);
      })

      $("#cancel").click(function(){
          location.reload();
      })
    }
    else
    {
      $(".simpan").show();
      $(".form-control").prop("readonly", false);
      $("#is_active").prop('disabled', false);
    }
 	})
 </script>
 @endsection
                    
                    