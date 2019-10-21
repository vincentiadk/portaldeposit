@extends('admin.layouts.blank')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <h2> Catalog </h2>
    </div>
</div>
<hr />
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="dataTables">
                        <thead>
                            <tr>
                                <th width="1%">#</th>
                                <th>Judul</th>
                                <th width="10%">Impresum</th>
                                <th width="10%">ISBN/ISSN</th>
                               
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
            ajax: '{{ url("/bo/abstract/listCat") }}',
            dom: 'lBfrtip',
            buttons : ['csv','excel','print','reset','reload'],
            columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', searchable:false, orderable:false},
            { data: 'title', name: 'title' },
            { data: 'impresum', name: 'impresum', searchable:false, orderable:false },
            { data: 'isbn', name: 'isbn' },
           
            { data: 'action', name: 'action', searchable:false, orderable:false }

            ]
        });
    });
</script>
@endsection