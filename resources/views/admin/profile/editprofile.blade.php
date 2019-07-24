@extends('admin.layouts.app')
@section('content')
  <div class="row">
    <div class="col-lg-12">
      <h2 > Profile </h2>
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
        @endif  
        @if (!empty(session('files_error')) && session('files_error')>0)
          <div class="alert alert-danger">
            <strong>{{session('files_error')}} file gagal diupload</strong>
          </div>
        @endif
          <form action="/bo/profile/update" method="post" class="form-horizontal" enctype="multipart/form-data">
            @csrf
            <input type="hidden" id="id" name="id" class="form-control" value="{{$datas->id}}" readonly />
            <div class="form-group">
              <label class="control-label col-lg-3">Nama</label>
              <div class="col-lg-8">
                <input type="text" id="name" name="name" class="form-control activator" value="{{$datas->name ?? ''}}"/>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-lg-3">Email</label>
              <div class="col-lg-8">
                <input type="text" id="email" name="email" class="form-control activator" value="{{$datas->email ?? ''}}"/>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-lg-3">Nip</label>
              <div class="col-lg-8">
                <input type="text" id="nip" name="nip" class="form-control activator" value="{{$datas->nip ?? ''}}"/>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-lg-3">Hak Akses</label>
              <div class="col-lg-8">
                <input type="text" class="form-control activator" @if($datas->group_id == '0') value="Admin" @else value="Staff" @endif readonly/>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-lg-3">Password **</label>
              <div class="col-lg-8">
                <input type="text" id="password" name="password" class="form-control activator" value=""/>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-lg-3">Konfirmasi Password **</label>
              <div class="col-lg-8">
                <input type="text" id="copassword" name="copassword" class="form-control activator" value=""/>
              </div>
            </div>
            <div>
              ** Isi data jika ingin mangubah password
            </div>

            <div class="form-actions no-margin-bottom" style="text-align:center;">
              <button type="submit" id="submit" class="btn btn-primary">Simpan</button>
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
      $('#copassword').on('keyup', check);
    });

    function check(){
      if($('#password').val() == $('#copassword').val() && $('#copassword').val() != ""){
        $('#submit').prop('disabled', false);
      }
      else if ($('#copassword').val() == "" && $('#password').val() == "") {
        $('#submit').prop('disabled', false);
      }
      else{
        $('#submit').prop('disabled', true);
      }
    }
 </script>
 @endsection
               