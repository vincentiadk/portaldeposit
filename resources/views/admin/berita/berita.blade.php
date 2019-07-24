@extends('admin.layouts.app')
@section('content')
<div class="row">
  <div class="col-lg-12">
    <h2> Berita </h2>
  </div>
</div>
<hr />
<div class="row">
  <div class="col-lg-12">
    <div class="panel panel-default">
      <div class="panel-body">
        <div class="table-responsive">
          @if (!empty(session('status')) && session('status') ==1)
          <div class="alert alert-success">
            <strong>Berhasil!</strong>
          </div>
        @elseif (!empty(session('status')) && session('status') ==0)
          <div class="alert alert-danger">
            <strong>Gagal!</strong>
          </div>
        @endif  
          <div class="form-group row">
            <div class="col-sm-9">
              <a href="/bo/berita/tambah" class="btn btn-primary btn-sm">Tambah</a>
            </div>
            <div class="input-group col-sm-3">
              <div class="input-group-addon">Kategori</div>
              <select class="form-control" id="kategori" aria-describedby="basic-addon1">
                <option value="all" selected>Semua</option>
                <option value="news">Berita</option>
                <option value="deposit">Deposit</option>
              </select>
            </div>
          </div>
          <hr>
          <table class="table table-striped" id="dataTables">
            <thead>
              <tr>
                <th width="1%">#</th>
                <th>Judul</th>
                <th width="10%">Kategori</th>
                <th width="10%">Status</th>
                <th width="10%">Creator</th>
                <th width="10%"></th>
              </tr>
            </thead>
            <tbody></tbody>
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
      var t= $('#dataTables').DataTable({
        "columnDefs": [{
          "searchable": false,
          "orderable": false,
          "targets": 0
        }],
        "order": [[ 1, 'asc' ]],
        "processing": true,
        "serverSide": true,
        "ajax": {
          "url": "/api/news/getList",
          "data" : function ( d ) {
            return $.extend( {}, d, {
              "type": $('#kategori').val(),
              "id" : '{{Auth::user()->id}}'
            } 
          )}
        }
      });
      t.on( 'draw.dt', function () {
        var PageInfo = $('#dataTables').DataTable().page.info();
        t.column(0, { page: 'current' }).nodes().each( function (cell, i) {
          cell.innerHTML = i + 1 + PageInfo.start;
        });
      });

      $( "#kategori" ).change(function() {
          t.ajax.reload();
      });
    });
  </script>
@endsection