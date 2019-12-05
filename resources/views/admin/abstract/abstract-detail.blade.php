@extends('admin.layouts.app')
@section('content')
@php 
if($data->id=="") { 
$id = "new"; 
$mode="tambah"; 
} else { 
$id= $data->id; 
$mode="detail"; 
} 
@endphp
<style>
.lds-hourglass {
  display: inline-block;
  position: relative;
  width: 64px;
  height: 64px;
}
.lds-hourglass:after {
  content: " ";
  display: block;
  border-radius: 50%;
  width: 0;
  height: 0;
  margin: 6px;
  box-sizing: border-box;
  border: 26px solid #ccc;
  border-color: #ccc transparent #ccc transparent;
  animation: lds-hourglass 1.2s infinite;
}
@keyframes lds-hourglass {
  0% {
    transform: rotate(0);
    animation-timing-function: cubic-bezier(0.55, 0.055, 0.675, 0.19);
  }
  50% {
    transform: rotate(900deg);
    animation-timing-function: cubic-bezier(0.215, 0.61, 0.355, 1);
  }
  100% {
    transform: rotate(1800deg);
  }
}

</style>
<div class="row">
    <div class="col-lg-12">
      <h2> Detail Abstract </h2>
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
                @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>{{$errors->first()}}</strong>
                </div>
                @endif
                
                <form action="/bo/abstract/detail/{{$id}}" method="post" class="form-horizontal" id="form1" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="id" name="id" class="form-control" value="{{$id ?? ''}}" readonly />
                    <input type="hidden" id="catalog_id" name="catalog_id" class="form-control" value="{{$data->catalog_id ?? ''}}" readonly />
                    <div class="form-group">
                        <label class="control-label col-lg-2">ISBN</label>
                        <div class="col-lg-6">
                            <input type="text" id="isbn" name="isbn" class="form-control" @if($mode=='detail') readonly @endif required value="{{$data->isbn ?? ''}}">
                        </div>
                        @if($mode=='tambah')
                        <div class="col-lg-2">
                            <a class="btn btn-primary" id="searchISBN">Search ISBN</a>
                        </div>
                        @endif
                        <div class="lds-hourglass" id="lds-hourglass" style="display:none">
                    <div></div>            </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-lg-2">Judul</label>
                        <div class="col-lg-8">
                            <textarea id="title" name="title" class="form-control activator" readonly required>{{$data->title ?? ''}}</textarea>
                        </div>
                    </div>
                     <div class="form-group">
                        <label class="control-label col-lg-2">Author</label>
                        <div class="col-lg-8">
                            <textarea id="author" name="author" class="form-control" readonly required>{{$data->author ?? ''}}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-lg-2">Publisher</label>
                        <div class="col-lg-8">
                            <input type="text" id="publisher" class="form-control" readonly value={{$data->publisher ?? ''}}>
                        </div>
                    </div>
                     <div class="form-group">
                        <label class="control-label col-lg-2">Publish Year</label>
                        <div class="col-lg-8">
                            <input type="text" id="publishyear" class="form-control" readonly value={{$data->publishyear ?? ''}}>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-lg-2">Abstract</label>
                        <div class="col-lg-8">
                            <textarea name="abstract" id="abstract" class="form-control activator summernote" readonly>{{$data->abstract ?? ''}}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-lg-2">Keywords</label>
                        <div class="col-lg-8">
                            <textarea id="keywords" name="keywords" class="form-control activator" readonly>{{$data->keywords ?? ''}}</textarea>
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
                                            @foreach($data->images as $gal)
                                            <div class="col-lg-3"><label class="btn"><img src="/storage/abstract/{{$gal->file_name}}" class="img-thumbnail img-check"><input type="checkbox" name="delete_id[]" value="{{$gal->id}}" class="hidden checkbox-delete" autocomplete="off" disabled></label></div>
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
        if ('{{$mode}}' == 'detail') {
            $('.summernote').summernote('disable');
            $(".simpan").hide();
            $("#kategori").val("{{$data->type ?? 'event'}}");
            $("#is_comment").val("{{$data->is_comment ?? '1'}}");
            $(".hide-edit").hide();

            $('#delete').click(function(){
                if(confirm('Apa Anda yakin akan menghapus abstract ini?')){      
                    $('#form1').attr('action', '/bo/abstract/delete');
                };
            });

            $("#ubah").click(function() {
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

            $("#cancel").click(function() {
                location.reload();
            })
        }  else  {
            $(".simpan").show();
            $("#kategori").prop('disabled', false);
            $("#is_comment").prop('disabled', false);
        }
        $('#searchISBN').on("click",function(){
            if($('#isbn').val().trim().length == 0) {
                 alert('Masukkan ISBN');
            }else {
                $(".activator").prop("readonly", true);
                $('.summernote').summernote('disable');
                $('#lds-hourglass').css('display','block');
                $.ajax({
                    type: "GET",
                    url:'/bo/abstract/getCatalog/'+$('#isbn').val().trim(),
                    dataType: 'json',    
                    success: function(data) {
                        if(Object.prototype.toString.call(data)==='[object Object]'){
                            $('.summernote').summernote('enable');
                            $('#isbn').val(data.isbn);
                            $('#title').val(data.title);
                            $('#author').val(data.author);
                            $('#publishyear').val(data.publishyear);
                            $('#publisher').val(data.publisher);
                            $('.summernote').summernote('code','<p><br></p>');
                            $('.summernote').summernote('insertText',data.abstract);
                            $(".activator").prop("readonly", false);
                        } else {
                            alert(data);
                        }
                        $('#lds-hourglass').css('display','none');
                    },
                    completed :function(data){
                    }
                });
            }
        });



    })

    function create_summernote() {
        $(".summernote").summernote({
            height: 300,
            callbacks:{
                onPaste: function(e){
                    var buffertext = (( e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
                    e.preventDefault();
                    document.execCommand('insertText',false,buffertext);
                }
            }
        });
         $('#abstract').summernote('disable');
    }


</script>
@endsection

@section('add-header')       
<link rel="stylesheet" href="{{asset('admin/css/img-check.css')}}"/>
@endsection
