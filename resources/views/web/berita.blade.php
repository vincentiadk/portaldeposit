@extends('web.layouts.master')
@section('content')

<section id="subintro">
    <div class="container">
        <div class="row">
            <div class="span12">
                <h3>Berita <strong> Direktorat vdk</strong></h3>
            </div>
        </div>
    </div>
</section>

<section id="maincontent">
    <div class="container">
        <div class="row">
            <div class="span12">
                <aside>
                    <div class="widget">
                        <h4>Telusuri Berita</h4>
                        <form class="form-search" action="/news" method="GET">
                            <select name="type" class="input-medium">
                                <option value="" @if($datas['type'] == "") selected @endif>Seluruh Berita</option>
                                <option value="event" @if($datas['type'] == "event") selected @endif>Kegiatan</option>
                                <option value="deposit" @if($datas['type'] == "deposit") selected @endif>Deposit</option>
                            </select>
                            <input placeholder="Type something" type="text" class="input-medium search-query">
                            <button type="submit" class="btn btn-flat btn-color">Search</button>
                        </form>
                    </div>
                </aside>
            </div>
        </div>
        <div class="row">
            <div class="span12">
                <!-- start article 1 -->
                @foreach ($newest as $new)
                @php $image = $new->images()->where("table_name","news")->first()
                @endphp
                <article class="blog-post">
                    <div class="post-heading">
                        <h3><a href="/{{$new['slug']}}">{!!$new->title!!}</a></h3>
                    </div>
                    <div class="row">
                        <div class="span3">
                            <div class="row-fluid">
                                <div class="span12 post-icon">
                                    @if($image)
                                    <img data-src="/storage/berita/berita{{$new->id}}/{{$image->file_name}}" class="lazy img-polaroid "  />
                                    @else 
                                    <img data-src="{{asset('/webpage/images/noimage.png')}}"  class="lazy lazy "  />
                                    @endif
                                </div>
                                <ul class="span12 post-meta">
                                    <li class="first"><i class="icon-calendar"></i><span>{{$new->datetime}}</span></li>
                                    @if($new->createdBy)
                                    <li><i class="icon-user"></i><span><a href="#">{{$new->createdBy->name}}</a></span></li>
                                    @endif
                                    <li class="last"><i class="icon-tags"></i><span><a href="#">Design</a>, <a href="#">Blog</a>, <a href="#">Tutorial</a></span></li>
                                </ul>
                            </div>
                            <div class="clear"></div>
                        </div>
                        <div class="span9">
                            <p>
                                @if(strlen($new->description) > 500)
                                {!! substr($new['description'],0,500)  !!} ...
                                @else 
                                {!! $new->description !!}
                                @endif
                            </p>
                            <a href="/{{$new['slug']}}" class="btn btn-color btn-rounded">Read more</a>
                        </div>
                    </div>
                </article>
                @endforeach
                <!-- end article 1 -->
                {{ $newest->links() }}
            </div>


        </div>
    </div>
</section>
@endsection