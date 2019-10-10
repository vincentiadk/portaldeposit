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
            @foreach ($datas->data as $data)
            @php $image = $data->images()->where("table_name","news")->first()
            @endphp
            <article class="blog-post">
                <div class="post-heading">
                    <h3><a href="/{{$data['slug']}}">{!!$data->title!!}</a></h3>
                </div>
                <div class="row">
                    <div class="span3">
                        <div class="row-fluid">
                            <div class="span12 post-icon">
                                <i class="icon-bg-dark icon-circled icon-file icon-3x active"></i>
                                @if($image)
                                <img data-src="/storage/berita/berita{{$new->id}}/{{$image->file_name}}" class="lazy img-polaroid "  />
                                @else 
                                <img data-src="{{asset('/webpage/images/noimage.png')}}"  class="lazy lazy "  />
                                @endif
                            </div>
                            <ul class="span12 post-meta">
                                <li class="first"><i class="icon-calendar"></i><span>{{$data['datetime']}}</span></li>
                                <li><i class="icon-user"></i><span><a href="#">{{$data['created_by']['name']}}</a></span></li>
                                <li class="last"><i class="icon-tags"></i><span><a href="#">Design</a>, <a href="#">Blog</a>, <a href="#">Tutorial</a></span></li>
                            </ul>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="span5">
                      <p>
                         {!! substr($data['description'],0,400) !!}
                     </p>
                     <a href="/{{$data['slug']}}" class="btn btn-color btn-rounded">Read more</a>
                 </div>
             </div>
         </article>
         @endforeach
         <!-- end article 1 -->

         <div class="pagination">
            {{$datas->links()}}
            <ul>
              <li><a href="#">Prev</a></li>
              <li><a href="#">1</a></li>
              <li class="active"><a href="#">2</a></li>
              <li><a href="#">3</a></li>
              <li><a href="#">4</a></li>
              <li><a href="#">Next</a></li>
          </ul>
      </div>
  </div>

  <div class="span4">
      <aside>
        <div class="widget">
          <h4>Search widget</h4>
          <form class="form-search">
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