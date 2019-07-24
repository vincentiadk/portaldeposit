@extends('webpage.layouts.app')
@section('header-link')
  <!-- <link rel="stylesheet" type="text/css" href="{{asset('webpage/chart/style.css')}}"> -->
  <script src="{{asset('webpage/chart/Chart.min.js')}}"></script>
  <script src="{{asset('webpage/chart/utils.js')}}"></script>
@endsection
@section('content')
  <section class="bg-default section-md">
    <div class="container">
      <div class="row row-80">
        <div class="col-lg-7 col-xl-8 section-divided__main">
          <div class="section-sm">
            <section class="bg-default section-md" style="padding-top: 0px;">
              <div class="container" >
                <div class="row">
                  <div class="col-sm-12 text-center">
                    <h4 class="heading-decorated">Statistik Wajib Serah</h4>
                  </div>
                </div>
                <div class="row row-60">
                  <div class="wrapper">
                    <canvas id="chart" style="display: block; width: 732px; height: 366px;"></canvas>
                  </div>
                </div>
              </div>
            </section>
          </div>
            <form class="rd-search text-center" action="/statistik/download" method="GET" data-search-live="rd-search-results-live">
            <!-- <input type="text" name="toDate" autocomplete="off" value="{{$toDate}}" hidden>
            <input type="text" name="fromDate" autocomplete="off" value="{{$fromDate}}" hidden> -->
            <input type="type" name="type" autocomplete="off" value="{{$type}}" hidden>
            <button class="button button-primary" name="all" type="submit" style="width: 100%">Download Statistik <i class="fa fa-file-excel-o"></i></button>
          </form>
        </div>
        <div class="col-lg-5 col-xl-4 section-divided__aside section-divided__aside-left">
          <section class="section-sm section-style-1">
            <h6>Telusuri</h6>
            <form class="rd-search" action="" method="GET" data-search-live="rd-search-results-live">
              <div class="form-wrap form-wrap_icon">
                <select name='type' class="form-input">
                  <option value="publisher" 
                  @if($type=='publisher') 
                  selected @endif>Publisher</option>
                  <option value="region" 
                  @if($type=='region')
                  selected @endif>Wilayah</option>
                </select>
              </div>
              
              <!-- <div class="form-wrap form-wrap_icon ">
                <label>From :</label>
                <input name="fromDate" value="{{$fromDate}}" type="date" class="form-input" required><br>
                <label>To :</label>
                <input name="toDate" value="{{$toDate}}" type="date" class="form-input" required>
              </div> -->
              <button class="button button-primary" type="submit">Cari <i class="fa fa-search"></i></button><br><br><br>            
            </form>
          </section>
         
        </div>
      </div>
    </div>
  </section>

  <script type="text/javascript">
    var array = @json($data);
    var utils = Samples.utils;
    var value = [];
    var label = [];
    var i;
    for (i = 0; i < array.length; ++i) {
      value.push(array[i].total);
      label.push(array[i].label)
    }
    console.log(label);
    var data = {
        labels: label,
        datasets: [{
            label: 'Data ',
            data: value,
            borderWidth: 1
        }]
    }
    var options = 
    {
      legend: false,
      elements: {
        rectangle: {
          backgroundColor: colorize.bind (null, false),
          borderColor: colorize.bind (null, true),
          borderWidth: 2
        }
      }
    };

    function colorize (opaque, ctx) 
    {
      var v = ctx.dataset.data[ctx.dataIndex];
      var c = v < 1000 ? '#D60000'
        : v < 5000 ? '#F46300'
        : v < 10000 ? '#0358B6'
        : '#44DE28';
      return opaque ? c : utils.transparentize(c, 1 - Math.abs(v / 150));
    }

    var chart = new Chart('chart', {
      type: 'bar',
      data: data,
      options: options
    });
  </script>
@endsection