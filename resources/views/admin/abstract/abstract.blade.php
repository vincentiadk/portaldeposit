@extends('admin.layouts.app')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <h2> Abstract </h2>
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
                            <a href="/bo/abstract/tambah" class="btn btn-primary btn-sm">Tambah</a>
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
                                <th width="10%">Keywords</th>
                                <th width="10%">Create At</th>
                                <th width="10%">Creator</th>
                                <th width="10%">Action</th>
                            </tr>
                        </thead>
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
        $('#dataTables').DataTable({
            processing: true,
            serverSide: true,
            order: [[1, "desc" ]],
            ajax: '{{ url("/bo/abstract/list") }}',
            dom: 'lBfrtip',
            buttons : ['csv','excel','print','reset','reload'],
            columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex'},
            { data: 'title', name: 'title' },
            { data: 'keywords', name: 'keywords' },
            { data: 'created_at', name: 'created_at' },
            { data: 'created_by', name: 'created_by' },
            { data: 'action', name: 'action' }

            ]
        });
    });
</script>
@endsection