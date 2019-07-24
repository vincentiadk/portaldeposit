@extends('admin.layouts.app')
@section('content')

    
<div class="row">
  <div class="col-lg-12">
    <h2> Detail Slider </h2>
  </div>
</div>

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
        <form action="/bo/slider/update" method="post" class="form-horizontal" enctype="multipart/form-data">
          @csrf
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
                      <div class="col-lg-3"><label class="btn"><img src="/storage/slider/{{$gal->file_name}}" class="img-thumbnail img-check"><input type="checkbox" name="delete_id[]" value="{{$gal->id}}" class="hidden checkbox-delete" autocomplete="off"></label></div>
                      @endforeach
                    </div>

                  </div>
                </div>
              </div>

            </div>
          </div>
               
          <div class="form-actions no-margin-bottom" style="text-align:center;">
            <input type="submit" value="Simpan" name="simpan" class="btn btn-primary simpan"/>
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

    $(".img-check").click(function(){
      $(this).toggleClass("check");
    });
    

  })
  
</script>
@endsection                    

@section('add-header')       
  <link rel="stylesheet" href="{{asset('admin/css/img-check.css')}}"/>
@endsection