@extends('webpage.layouts.app')
@section('content')
<section class="breadcrumbs-custom">
  <div class="container">
    <div class="breadcrumbs-custom__inner">
      <p class="breadcrumbs-custom__title">Pedoman dan Peraturan</p>
      <ul class="breadcrumbs-custom__path">
        <li><a href="#">Home</a></li>
        <li class="active">Pedoman dan Peraturan</li>
      </ul>
    </div>
  </div>
</section>

<section class="section-lg bg-default" style="padding:10px">
  <div class="container">
    <!-- Bootstrap tabs-->
    <div class="tabs-custom tabs-horizontal" id="tabs-1">
      <!-- Nav tabs-->
      <ul class="nav nav-custom nav-custom-tabs">
        <li class="nav-item"><a class="nav-link active" href="#tabs-1-1" data-toggle="tab">Pedoman</a></li>
        <li class="nav-item"><a class="nav-link" href="#tabs-1-2" data-toggle="tab">Peraturan</a></li>
      </ul>
    </div>
    <div class="tab-content text-left">
      <div class="tab-pane fade show active" id="tabs-1-1">
        <h5>Pedoman</h5>
        <?php $no2 = 1; ?>
        @foreach ($datas as $data)
          @if ($data['type'] == "pedoman")
            <p>{{$no2}}. <a href="/{{$data->slug}}"> <u>{{$data->title}}</u></a></p>
          <?php $no2++; ?>
            <!-- @if($data->files != "" || $data->files != null)
              <p><a href="/storage/pdf/{{$data->files}}">Download Dokumen</a></p>
            @endif -->
          @endif
        @endforeach
      </div>
      <div class="tab-pane fade" id="tabs-1-2">
        <h5>Peraturan</h5>
        <?php $no1 = 1; ?>
        @foreach ($datas as $data)
          @if ($data['type'] == "peraturan")
            <p>{{$no1}}. <a href="/{{$data->slug}}"> <u>{{$data->title}}</u></a></p>
            @if($data->files != "" || $data->files != null)
              <p><a href="/storage/pdf/{{$data->files}}">Download Dokumen</a></p>
            @endif
            <?php $no1++; ?>
          @endif
        @endforeach
        <!-- <p>Welcome to our wonderful world. We sincerely hope that each and every user entering our website will find exactly what he/she is looking for. With advanced features of activating account and new login widgets, you will definitely have a great experience of using our web page. It will tell you lots of interesting things about our company, its products and services, highly professional staff and happy customers.</p>
        <h5>Details</h5>
        <ul class="list-marked">
          <li>10 Reasons to Buy Monstroid<sup>2</sup>.</li>
          <li>Getting to another  level of design</li>
        </ul> -->
      </div>
    </div>
  </div>
</section>


@endsection