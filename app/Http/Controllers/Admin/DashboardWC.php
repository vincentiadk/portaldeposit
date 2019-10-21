<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\News;
use App\Publication;
use App\Event;
use App\Rule;
use App\Collection;
use App\Master_publisher;

class DashboardWC extends Controller
{
    public function dashboard(){
    	$user = Auth::user();

        $total = Collection::where('category_id', 4);
        $totalws = Master_publisher::query();

        $totws = Master_publisher::count();
        $totcol =Collection::where('category_id',4)->count();

    	if ($user->group_id == 0) {
	    	$countnews = News::count();
	    	$countpub = Publication::count();
	    	$countevent = Event::count();
	    	$countpedoman = Rule::count();
	    	$countperaturan = Rule::where('type', 'peraturan')->count();
    	}
    	else{
	    	$countnews = News::where('created_by', $user->id)->count(); 
	    	$countpub = Publication::where('created_by', $user->id)->count();
	    	$countevent = Event::where('created_by', $user->id)->count();
	    	$countpedoman = Rule::where('type', 'pedoman')->where('created_by', $user->id)->count();
	    	$countperaturan =Rule::where('type', 'peraturan')->where('created_by', $user->id)->count();
    	}
    	$event = $this->eventNewest();

    	return view('admin.dashboard')->with(['event' => $event, 'countpedoman' => $countpedoman, 'countperaturan' => $countperaturan, 'countevent' => $countevent, 'countpub' => $countpub, 'countnews' => $countnews, 'totcol' => $totcol, 'totws' => $totws]);
    }

  private function eventNewest()
  {
    $data = Event::where('status', 'published')->orderby('created_at', 'desc')->take(5)->get();
    return $data;
	}
}
