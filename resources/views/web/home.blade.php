@extends('web.layouts.master')
@section('content')
<section id="intro">
    <div class="container">
        <div class="row">
           <div class="span12">
            <!-- start flexslider -->
            <div class="flexslider">
                <ul class="slides">
                    @foreach($sliders as $slider)
                    <li>
                        <img data-src="/storage/slider/{{$slider->file_name}}" alt="" class="lazy" />
                    </li>
                    @endforeach
                </ul>
            </div>
            <!-- end flexslider -->
            <div class="blank10"></div>
            <div class="cta-box">
              <div class="cta-text">
                <p class="lead"> 
                    Direktorat Deposit Bahan Pustaka bertugas melaksanakan pengelolaan karya cetak dan karya rekam (KCKR), penyusunan Bibliografi Nasional Indonesia (BNI), Katalog Induk Nasional ( KIN ) serta literatur sekunder lainnya. Telah disahkan UU no.13 Tahun 2018 tentang Serah Simpan KCKR yang baru menjadi pengganti UU Deposit No. 4 Tahun 1990 sebagai dasar penghimpunan KCKR di Indonesia.
                </p>
                <a class="btn btn-large btn-rounded btn-color" href="/tentang">
                    <i class="icon-chevron-right"></i> Tentang Kami
                </a>
                <a class="btn btn-large btn-rounded btn-color" href="/UUsskckr">
                    <i class="icon-book"></i> UU SS KCKR
                </a>
            </div>
        </div>
    </div>
</div>
</div>
</section>
<section>
    <div class="container">
        <div class="row">
            <div class="flexslider">
                <ul class="slides">
                    <li>
                        <div class="span4">
                            <div class="features">
                                <div class="icon">
                                    <i class="icon-bg-light icon-circled icon-barcode icon-5x active"></i>
                                </div>
                                <div class="features_content">
                                    <h3>ISBN</h3>
                                    <p class="left">
                                        ISBN (International Standard Book Number) adalah deretan angka 13 digit sebagai pemberi identifikasi unik secara internasional terhadap satu buku maupun produk seperti buku yang diterbitkan oleh penerbit.
                                    </p>
                                    <a href="https://isbn.perpusnas.go.id" target="_blank"><span  class="btn btn-primary btn-rounded" ><i class="icon-angle-right"></i> Go To Site</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="span4">
                            <div class="features">
                                <div class="icon">
                                    <i class="icon-bg-dark icon-circled icon-music icon-5x"></i>
                                </div>
                                <div class="features_content">
                                    <h3>ISMN</h3>
                                    <p class="left">
                                        International Standard Music Number (ISMN) adalah sistem internasional untuk membedakan ciptaan musik dan penciptanya. ISMN sangat berguna sebagai pengarsipan
                                    </p>
                                    <a href="https://ismn.perpusnas.go.id" target="_blank">  <span class="btn btn-primary btn-rounded" > <i class="icon-angle-right"></i> Go To Site</span></a>
                                </div>
                            </div>
                        </div>
                        <div class="span4">
                            <div class="features">
                                <div class="icon">
                                    <i class="icon-bg-purple icon-book icon-circled icon-book icon-5x" ></i>
                                </div>
                                <div class="features_content">
                                    <h3>BNI</h3>
                                    <p class="left">
                                        Bibliografi Nasional Indonesia (BNI) merupakan kumpulan data bibliografis terbitan atau publikasi yang diterbitkan di Indonesia. BNI berfungsi sebagai sarana kendali bibliografis (bibliographic control) di Indonesia. 
                                    </p>
                                    <a href="https://bni.perpusnas.go.id" target="_blank"> <span  class="btn btn-primary btn-rounded"><i class="icon-angle-right"></i> Go To Site</span></a>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="span4">
                            <div class="features">
                                <div class="icon">
                                    <i class="icon-bg-blue icon-circled icon-book icon-5x"></i>
                                </div>
                                <div class="features_content">
                                    <h3>KIN</h3>
                                    <p class="left">
                                        Katalog Induk Nasional (KIN) adalah sebuah pangkalan data katalog yang menghimpun data katalog dariperpustakaan provinsi, kabupaten/kota, universitas dan perpustakaan lainnya di seluruh Indonesia.
                                    </p>
                                    <a href="https://kin.perpusnas.go.id" target="_blank"> <span class="btn btn-primary btn-rounded"><i class="icon-angle-right"></i> Go To Site</span></a>
                                </div>
                            </div>
                        </div>
                        <div class="span4">
                            <div class="features">
                                <div class="icon">
                                    <i class="icon-bg-light icon-circled icon-sitemap icon-5x active"></i>
                                </div>
                                <div class="features_content">
                                    <h3>KIPI</h3>
                                    <p class="left">
                                        Katalog Induk Perpustakaan Indonesia (KIPI) adalah sebuah perangkat lunak yang dikembangkan bagi komunitas perpustakaan sebagai pangkalan data katalog.
                                    </p>
                                    <a href="https://demokipiv2.perpusnas.go.id" target="_blank">
                                        <span class="btn btn-primary btn-rounded" target="_blank"><i class="icon-angle-right"></i> Go To Site</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="span4">
                            <div class="features">
                                <div class="icon">
                                    <i class="icon-bg-green icon-circled icon-suitcase icon-5x"></i>
                                </div>
                                <div class="features_content">
                                    <h3>E-Deposit</h3>
                                    <p class="left">
                                        Sistem untuk penyerahan dan penghimpunan KCKR secara online
                                    </p>
                                    <a href="https://edeposit.perpusnas.go.id" target="_blank">    
                                        <span class="btn btn-primary btn-rounded" ><i class="icon-angle-right"></i> Go To Site</span></a>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="span4">
                                <div class="features">
                                    <div class="icon">
                                        <i class="icon-bg-dark icon-circled icon-facetime-video icon-5x"></i>
                                    </div>
                                    <div class="features_content">
                                        <h3>ISRC</h3>
                                        <p class="left">
                                            International Standart Record Code (ISRC) adalah kode pelacakan musik yang memverifikasi informasi rekaman terkait, termasuk nama artis, judul lagu, judul album, label nama, UPC (Universal Product Code). Kode ISRC digunakan untuk mengidentifikasi lagu individual di album
                                        </p>
                                        <a href="https://isrc.perpusnas.go.id" target="_blank"> <span class="btn btn-primary btn-rounded" target="_blank"><i class="icon-angle-right"></i> Go To Site</span></a>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<section style="background: #2B9CA2;;">
    <div class="container"> 
        <div class="row-fluid"> 
            <div class="span12">
                <span class="section-title uppercase white">Koleksi Deposit Terbaru</span>
                <div class="testmonial_slider">
                    <ul class="slides">
                        @foreach($depositNewest->chunk(6) as $depost4) 
                        <li>
                         @foreach($depost4->chunk(3) as $depost2)
                         <div class="row">

                            @foreach($depost2 as $data)
                            @php 
                            $cols = $data->collections->where('category_id',4);
                            if($cols->count() > 0){
                                $col = $cols->first();
                            }
                            $titles = $data->catalog_ruas->where('tag','245')->first()->value;
                            $isbns = $data->catalog_ruas->where('tag','020')->first();
                            $issns = $data->catalog_ruas->where('tag','022')->first();

                            $title = ""; $isbn=""; $issn="";
                            if(preg_match('/[$]a(.*?)[$]/', $titles, $match) == 1) 
                            {
                                $title = trim($match[1]);
                            } else if(preg_match('/[$]a(.*)/', $titles, $match) == 1) {
                                $title = trim($match[1]);
                            }  else {
                                $title = $data->title;
                            }
                            $title = str_replace(['/',':'], '',$title);

                            if($isbns){
                                if(preg_match('/[$]a(.*?)[$]/',$isbns->value, $match) == 1) 
                                {
                                    $isbn = trim($match[1]);
                                } else if(preg_match('/[$]a(.*)/', $isbns->value, $match) == 1) {
                                    $isbn = trim($match[1]);
                                }
                            }

                            if($issns){
                                if(preg_match('/[$]a(.*?)[$]/', $issns->value, $match) == 1) {
                                    $issn = trim($match[1]);
                                } else if(preg_match('/[$]a(.*)/', $issns->value, $match) == 1) {
                                    $issn = trim($match[1]);
                                }
                            }
                            @endphp
                            <div class="mini-layout fluid span4 ebook">
                                <div class="mini-layout-sidebar">
                                    @if($data->coverurl != null)
                                    <img class="lazy" data-src="https://opac.perpusnas.go.id/uploaded_files/sampul_koleksi/original/{{$data->worksheet->name}}/{{$data->coverurl}}" />
                                    @else
                                    <img class="lazy" data-src="https://opac.perpusnas.go.id/uploaded_files/sampul_koleksi/original/nophoto.jpg" />
                                    @endif
                                </div>
                                <div class="mini-layout-body white_section">
                                    <a href="/wajibserah/terbitan/{{$data->id}}">
                                        <h3>
                                            {{ $title }}
                                        </h3>
                                    </a>
                                    <p class="left">
                                        @if(!empty($col) && $col->master_publisher)
                                        <a href="/wajibserah/detail?id={{$col->publisher_id}}" style="color: rgba(255, 255, 255, 0.7)">
                                            {{$col->master_publisher->publisher_name}} - {{$col->publishyear}}
                                        </a>
                                        @endif 
                                        <br/>
                                        <i class="icon-info">{{ $data->worksheet->name }}</i>
                                        @if($isbn != "")
                                        <i class="icon-barcode"> ISBN {{ $isbn }} </i>
                                        @endif
                                        @if($issn != "")
                                        <i class="icon-barcode"> ISSN {{ $issn }} </i>
                                        @endif
                                        <i class="icon-book"> {{ $cols->count() }}  Copy  </i>
                                        <br/>
                                    Tgl Terima <span class="date"><i class="icon-calendar"></i> {{ $col->createdate }} </span> 
                                    </p>
                                </div>
                            </div>

                            @endforeach
                            </div>
                        @endforeach
                        </li>
                    @endforeach
                    </ul>
                </div>
            </div>
        </div>

    </div>
</section>

<section>
    <div class="container">
        <div class="row">
            <div class="span4">
                <span class="section-title uppercase">Berita Terbaru</span>
                <aside>
                    <div class="widget">
                        <ul class="recent-posts">
                            @foreach($news as $new)
                            @php $image = $new->images()->where("table_name","news")->first()
                            @endphp
                            <li><a href="/{{$new->slug}}">
                                @if($image)
                                <img data-src="/storage/berita/berita{{$new->id}}/{{$image->file_name}}" class="lazy" style="width:50px; height:50px;" alt="{{$new->title}}" />
                                @else 
                                <img data-src="{{asset('/webpage/images/noimage.png')}}"  class="lazy" style="width:50px; height:50px;" alt="{{$new->title}}" />
                                @endif
                                {{ $new->title }}</a>
                                <div class="clear">
                                </div>
                                <span class="date"><i class="icon-calendar"></i> {{$new->datetime}}</span>
                                <span class="comment"><i class="icon-user"></i> {{$new->createdBy->name}}</span>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </aside>
            </div>
            <div class="span8">
                <span class="section-title uppercase">Abstrak</span>
                <div class="testmonial_slider" style="height:auto">
                    <ul class="slides">
                        @foreach($abstracts as $abstract)
                        @php
                        $col = getDetailCatalogById($abstract->catalog_id);
                        @endphp
                        <li>
                            <div class="testimonial_item mini-layout fluid">
                                <div class="mini-layout-sidebar hidden-phone ">
                                    @if($abstract->images()->count() > 0)
                                    <img data-src="/storage/abstract/{{$abstract->images->first()->file_name}}" class="lazy img-polaroid">
                                    @else
                                    <img class="lazy" data-src="https://opac.perpusnas.go.id/uploaded_files/sampul_koleksi/original/nophoto.jpg" />
                                    @endif
                                    {{$abstract->all}}
                                </div>
                                <div class="mini-layout-body">
                                    <h4>{{$abstract->title}}</h4>
                                    {!!$abstract->abstract!!}
                                    <span class="author">Abstrak oleh  {{$abstract->createdBy->name}} <small><i>{{$abstract->created_at}}</i></small></span>
                                    <span class="occupation">
                                        ISBN : {{$abstract->isbn}}<br/>
                                        Penerbit : {{$col->publisher}}<br/>
                                        Tahun Terbit  : {{$col->publishyear}}<br/>
                                        Kepengarangan  : {{$col->author}}
                                    </span>
                                   
                                    
                                </div>
                            </div>
                            <!-- end testmonial -->
                        </li>
                        @endforeach
                    </ul>
                    <!-- end testmonial slider -->
                </div>
                <div class="blank"></div>


            </div>
        </div>
    </div>
</section>
<section>
    <span class="section-title uppercase text-center white" style="background: #684962;padding: 20px 0px;">Publikasi Deposit</span>
    <div class="container">
        <div class="row">
            @foreach($publication as $pub)
            @php $image = $pub->images()->where("table_name","publication")->first(); @endphp
            <div class="span2">
                <a href="/publication/{{$pub->id}}">
                    @if($image)
                    <img data-src="/storage/deposit/deposit{{$pub->id}}/{{$image->file_name}}" class="lazy ebook" />
                    @else
                    <img data-src="https://opac.perpusnas.go.id/uploaded_files/sampul_koleksi/original/nophoto.jpg" class="lazy ebook" />
                    @endif
                    <p><strong>{{ $pub->title }}</strong></p>
                </a>
            </div>
            @endforeach
        </div>
        <div class="row text-center">
            <a href="/publication" class="btn btn-primary btn-rounded btn-large"> Lihat Semua Publikasi</a>
        </div>
    </div>
</section>
@endsection
