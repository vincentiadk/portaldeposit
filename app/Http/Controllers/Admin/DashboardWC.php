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

        $total = Collection::where('noinduk_deposit', '!=', null)->paginate(1);
        $totalws = Master_publisher::paginate(1);

        $totws = $totalws->total();
        $totcol = $total->total();

    	if ($user->group_id == 0) {
	    	$countnews = count(News::all());
	    	$countpub = count(Publication::all());
	    	$countevent = count(Event::all());
	    	$countpedoman = count(Rule::where('type', 'pedoman')->get());
	    	$countperaturan = count(Rule::where('type', 'peraturan')->get());
    	}
    	else{
	    	$countnews = count(News::where('created_by', $user->id)->get());
	    	$countpub = count(Publication::where('created_by', $user->id)->get());
	    	$countevent = count(Event::where('created_by', $user->id)->get());
	    	$countpedoman = count(Rule::where('type', 'pedoman')->where('created_by', $user->id)->get());
	    	$countperaturan = count(Rule::where('type', 'peraturan')->where('created_by', $user->id)->get());
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
