<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Comment;
use App\News;
use App\Event;

class CommentWC extends Controller
{
	public function getComment(Request $request){
		if ($request->type == "news") {
			$content = News::where('slug', 'like', '%'.$request->slug.'%')->first();
			$data = Comment::where('relation_name', 'news')->where('relation_id', $content->id)->get();
		}
		else if ($request->type == "event") {
			$content = Event::where('slug', 'like', '%'.$request->slug.'%')->first();
			$data = Comment::where('relation_name', 'event')->where('relation_id', $content->id)->get();
		}
		return view('admin.comment.comment')->with(['type' => $request->type, 'slug' => $request->slug, 'data' => $data, 'content' =>$content]);
	}
}
