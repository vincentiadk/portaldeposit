@extends('admin.layouts.app')
@section('content')
  <div class="row">
    <div class="col-lg-12">
      <h2> Manajemen User </h2>
    </div>
  </div>
  <hr />
  <div class="row">
    <div class="col-lg-12">
      <div class="panel panel-default">
        <div class="panel-body">
          <div class="table-responsive">
            @if (!empty($status) && $status == 1)
              <div class="alert alert-success">
                <strong>Berhasil!</strong>
              </div>
            @elseif (!empty($status) && $status == 0)
              <div class="alert alert-danger">
                <strong>Gagal!</strong>
              </div>
            @endif
            <div class="form-group row">
              <div class="col-sm-9">
                <a href="/bo/user/tambah" class="btn btn-primary btn-sm">Tambah</a>
              </div>
            </div>
            <hr>
            <table class="table table-striped" id="dataTables">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Nama</th>
                  <th>Nip</th>
                  <th>Email</th>
                  <th>Status</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
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
      $(document).ready(function() {
        var t= $('#dataTables').DataTable( {
          "columnDefs": [ {
              "searchable": false,
              "orderable": false,
              "targets": 0
          } ],
          "order": [[ 1, 'asc' ]],
          "processing": true,
          "serverSide": true,
          "ajax": {
            "url": "/api/user/getList"            
          }
        });

        t.on( 'draw.dt', function () {
            var PageInfo = $('#dataTables').DataTable().page.info();
              t.column(0, { page: 'current' }).nodes().each( function (cell, i) {
                cell.innerHTML = i + 1 + PageInfo.start;
            } );
        } );

       
      });
  </script>
@endsection