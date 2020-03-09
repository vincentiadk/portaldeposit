@extends('web.layouts.master')
@section('content')
<section id="subintro">
	<div class="container">
		<div class="row">
			<div class="span12">
				<h3>{{$datas->title}}</strong></h3>
			</div>
		</div>
	</div>
</section>
<section id="maincontent">
	<div class="container">
		<div class="row">

			<div class="span8">
				<!-- start article full post -->
				<article class="blog-post">
					<div class="clearfix">
					</div>
					@if(count($galerys) > 0)
					<div class="flexslider">
						<ul class="slides">
							@foreach($galerys as $slider)
							<li>
								<img data-src="/storage/berita/berita{{$datas->id}}/{{$slider->file_name}}" alt="{{$datas->title}}" class="lazy" />
							</li>
							@endforeach
						</ul>
					</div>
					@endif

					<div class="row">
						<div class="span2">
							<div class="post-icon">
								<i class="icon-bg-dark icon-circled icon-file icon-3x active"></i>
							</div>
							<ul class="post-meta">
								<li class="first"><i class="icon-calendar"></i><span>{{$datas->created_at}}</span></li>
								<li><i class="icon-list-alt"></i><span><a href="#">{{count($comments)}} komentar</a></span></li>
								<li class="last"><i class="icon-user"></i><span><a href="#">{{$datas->createdBy->name}}</a></span></li>
							</ul>
							<div class="clearfix">
							</div>
						</div>
						<div class="span6">
							{!!$datas->description!!}
						</div>

					</div>
				</article>

				<!-- end article full post -->
				<h4>{{count ($comments)}} komentar</h4>
				<ul class="media-list">
					@foreach ($comments as $comment)
					<li class="media">
						<a class="pull-left" href="#">
							<img class="img-circle" src="assets/img/small-avatar.png" alt="" />
						</a>
						<div class="media-body">
							<h5 class="media-heading"><a href="#">{{$comment->commentator_name}}</a></h5>
							<span>3 June, 2013</span>
							<p>
								{{$comment->message}}
							</p>
							<a href="#" class="btn btn-color btn-rounded">Reply</a>
						</div>
					</li>
					@endforeach
				</ul>
				<div class="comment-post">
					<h4>Leave a comment</h4>
					<form action="" method="post" class="comment-form" name="comment-form" action="/comment/submit">
						{{csrf_field()}}
						<input type="text" name="relation_id" id="relation_id" class="hidden" hidden value="{{$datas->id}}">
						<input type="text" name="relation_name" id="relation_name" class="hidden" hidden value="news">
						<div class="row">
							<div class="span4">
								<label>Nama <span>*</span></label>
								<input type="text" placeholder="Your name" name="name" />
							</div>
							<div class="span4">
								<label>Email <span>*</span></label>
								<input type="email" placeholder="Your email" name="email" />
							</div>
							<div class="span8">
								<label>Nomor Telepon</label>
								<input type="text" placeholder="Your website url" name="phone" />
							</div>
							<div class="span8">
								<label>Comment <span>*</span></label>
								<textarea rows="9" placeholder="Your comment" name="message"></textarea>
								<button class="btn btn-color btn-rounded" type="submit">Submit</button>
							</div>
						</div>
					</form>
				</div>
			</div>

			<div class="span4">
				<aside>
					<div class="widget">
						<h4>Berita Lainnya</h4>
						<ul class="recent-posts">
							@foreach($otherNews as $new)
							@php $image = $new->images()->where("table_name","news")->first(); @endphp
							<li><a href="/{{$new->slug}}">
                                @if($image)
                                <img data-src="/storage/berita/berita{{$new->id}}/{{$image->file_name}}" class="lazy" alt="{{$new->title}}" style="width:50px; height:50px;" />
                                @else 
                                <img data-src="{{asset('/webpage/images/noimage.png')}}"  class="lazy" style="width:50px; height:50px;" alt="{{$new->title}}"/>
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
		</div>
	</div>
</section>
@endsection