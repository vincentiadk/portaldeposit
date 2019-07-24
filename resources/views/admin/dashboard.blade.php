@extends('admin.layouts.app')
@section('content')
<div class="row">
  <div class="col-lg-12">
    <h2> Beranda </h2>
  </div>
</div>

<hr/>
<div class="row">
  <div class="col-lg-12">
    <div class="panel panel-default">
      <div class="panel-body">
         <div class="row">
            <div class="col-lg-12">
               <div class="panel panel-default">
                    <div class="panel-heading">
                      <i class="icon-bell"></i> Informasi
                    </div>
                    <div class="panel-body">
                      
                <div class="row" style="text-align: center;">
                    <a class="quick-btn" href="#">
                        <i class="icon-bullhorn icon-2x"></i>
                        <span> Berita</span>
                        <span class="label label-danger">{{$countnews}}</span>
                    </a>
                    <a class="quick-btn" href="#">
                        <i class="icon-retweet icon-2x"></i>
                        <span>Wajib Serah</span>
                        <span class="label btn-metis-4">{{$totws}}</span>
                    </a>
                    <a class="quick-btn" href="#">
                        <i class="icon-retweet icon-2x"></i>
                        <span>Koleksi</span>
                        <span class="label btn-metis-4">{{$totcol}}</span>
                    </a>
                    <a class="quick-btn" href="#">
                        <i class="icon-envelope icon-2x"></i>
                        <span>Publikasi</span>
                        <span class="label label-success">{{$countpub}}</span>
                    </a>
                    <a class="quick-btn" href="#">
                        <i class="icon-calendar icon-2x"></i>
                        <span>Kegiatan</span>
                        <span class="label label-warning">{{$countevent}}</span>
                    </a>
                    <a class="quick-btn" href="#">
                        <i class="icon-book icon-2x"></i>
                        <span>Pedoman</span>
                        <span class="label btn-metis-4">{{$countpedoman}}</span>
                    </a>
                    <a class="quick-btn" href="#">
                        <i class="icon-cogs icon-2x"></i>
                        <span>Peraturan</span>
                        <span class="label btn-metis-4">{{$countperaturan}}</span>
                    </a>
                </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
          <div class="col-lg-12">
               <div class="panel panel-default" style="height: 60%">
                    <div class="panel-heading">
                      <i class="icon-bell"></i> Statistik Wajib Serah
                    </div>
                    <div class="panel-body">
                      <div class="col-lg-2"></div>
                      <div class="col-lg-8">
                        <div class="wrapper"><canvas id="chart-0" style="display: block; width: 732px; height: 366px;"></canvas></div>
                      </div>
                    </div>
                </div>
          </div>
        </div>
        <div class="row">
            <div class="col-lg-12 table-responsive">
               <div class="panel panel-default" style="height: 60%">
                    <div class="panel-heading">
                      <i class="icon-bell"></i> Jadwal Kegiatan
                    </div>
                    <div class="panel-body">
                      <table class="table table-bordered sortableTable responsive-table" style="margin:auto">    
                        <thead>
                          <tr>
                            <th width="20%">Waktu</th>
                            <th width="20%">Pembicara</th>
                            <th width="40%">Tema</th>
                            <th width="30%">Tempat</th>
                          </tr>
                        </thead>
                        @foreach ($event as $data) 
                        <tbody>
                          <tr>
                            <td>{{ date('d F Y', strtotime($data->date_start))}}</td>
                            <td>{{$data->speaker}}</td>
                            <td>{{$data->title}}</td>
                            <td>{{$data->place}}</td>
                          </tr>
                        </tbody>
                        @endforeach
                      </table>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection


@section('add-header')
  <link href="http://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet" />
  <link rel="stylesheet" type="text/css" href="{{asset('webpage/chart/style.css')}}">
  <script src="{{asset('webpage/chart/Chart.min.js')}}"></script>
  <script src="{{asset('webpage/chart/utils.js')}}"></script>
@endsection

@section('add-js')
  <script src="http://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
  <script>
    var DATA_COUNT = 12;
    var utils = Samples.utils;
    utils.srand (110);

    function colorize (opaque, ctx) 
    {
      var v = ctx.dataset.data[ctx.dataIndex];
      var c = v < -50 ? '#D60000'
        : v < 0 ? '#F46300'
        : v < 50 ? '#0358B6'
        : '#44DE28';
      return opaque ? c : utils.transparentize(c, 1 - Math.abs(v / 150));
    }

    function generateData() 
    {
      return utils.numbers({
        count: DATA_COUNT,
        min: 0,
        max: 100
      });
    }

    var data = 
    {
      labels: utils.months({count: DATA_COUNT}),
      datasets: [{
        data: generateData()
      }]
    };

    var options = 
    {
      legend: false,
      tooltips: false,
      elements: {
        rectangle: {
          backgroundColor: colorize.bind (null, false),
          borderColor: colorize.bind (null, true),
          borderWidth: 2
        }
      }
    };

    var chart = new Chart('chart-0', {
      type: 'bar',
      data: data,
      options: options
    });

    // eslint-disable-next-line no-unused-vars
    function randomize() 
    {
      chart.data.datasets.forEach(function (dataset) {
        dataset.data = generateData();
      });
      chart.update();
    }

    // eslint-disable-next-line no-unused-vars
    function addDataset() 
    {
      chart.data.datasets.push({
        data: generateData()
      });
      chart.update();
    }

    // eslint-disable-next-line no-unused-vars
    function removeDataset() 
    {
      chart.data.datasets.shift();
      chart.update();
    }
  </script>
@endsection