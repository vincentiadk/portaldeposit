@extends('web.layouts.master')
@section('content')

<section id="subintro">
    <div class="container">
        <div class="row">
            <div class="span4">
                <h3>Berita <strong> Direktorat Deposit Bahan Pustaka</strong></h3>
            </div>
        </div>
    </div>
</section>

<section id="maincontent">
  <div class="container">
    <div class="row">
      <div class="span8">
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
            <div class="span5">
                <p>
                    @if(strlen($new->description) > 400)
                    {!! substr($new['description'],0,400)  !!} ...
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

<div class="span4">
    <aside>
        <div class="widget">
            <h4>Search widget</h4>
            <form class="form-search">
                <div class="form-control">
                    <select name="type" class="form-input">
                        <option value="" @if($datas['type'] == "") selected @endif>Seluruh Berita</option>
                        <option value="event" @if($datas['type'] == "event") selected @endif>Kegiatan</option>
                        <option value="deposit" @if($datas['type'] == "deposit") selected @endif>Deposit</option>
                    </select>
                </div>
                <input placeholder="Type something" type="text" class="input-medium search-query">
                <button type="submit" class="btn btn-flat btn-color">Search</button>
            </form>
        </div>
        <div class="widget">
            <h4>Video widget</h4>
            <div class="video-container">

            </div>
        </div>
        <div class="widget">
            <h4>Categories</h4>
            <ul class="cat">
                <li><a href="#">Web design (114)</a></li>
                <li><a href="#">Internet news (15)</a></li>
                <li><a href="#">Tutorial and tips (20)</a></li>
                <li><a href="#">Design trends (15)</a></li>
                <li><a href="#">Online business (10)</a></li>
            </ul>
        </div>
        <div class="widget">
            <h4>Recent posts</h4>
            <ul class="recent-posts">
                <li><a href="#"><img src="assets/img/dummies/post-50.jpg" alt="" /> Lorem ipsum dolor sit amet munere commodo ut nam</a>
                    <div class="clear">
                    </div>
                    <span class="date"><i class="icon-calendar"></i> 6 March, 2013</span>
                    <span class="comment"><i class="icon-comment"></i> 4 Comments</span>
                </li>
                <li><a href="#"><img src="assets/img/dummies/post-50.jpg" alt="" /> Sea nostrum omittantur ne mea malis nominavi insolens</a>
                    <div class="clear">
                    </div>
                    <span class="date"><i class="icon-calendar"></i> 6 March, 2013</span>
                    <span class="comment"><i class="icon-comment"></i> 2 Comments</span>
                </li>
                <li><a href="#"><img src="assets/img/dummies/post-50.jpg" alt="" /> Eius graece recusabo no pri odio tale quo id, mea at saepe</a>
                    <div class="clear">
                    </div>
                    <span class="date"><i class="icon-calendar"></i> 4 March, 2013</span>
                    <span class="comment"><i class="icon-comment"></i> 12 Comments</span>
                </li>
                <li><a href="#"><img src="assets/img/dummies/post-50.jpg" alt="" /> Malorum deserunt at nec usu ad graeco elaboraret at rebum</a>
                    <div class="clear">
                    </div>
                    <span class="date"><i class="icon-calendar"></i> 3 March, 2013</span>
                    <span class="comment"><i class="icon-comment"></i> 3 Comments</span>
                </li>
            </ul>
        </div>
        <div class="widget">
            <h4>Tags</h4>
            <ul class="tags">
              <li><a href="#">Tutorial</a></li>
              <li><a href="#">Tricks</a></li>
              <li><a href="#">Design</a></li>
              <li><a href="#">Trends</a></li>
              <li><a href="#">Online</a></li>
          </ul>
      </div>
  </aside>
</div>
</div>
</div>
</section>
@endsection