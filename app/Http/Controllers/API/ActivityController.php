<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\Activity;
use App\User;

class ActivityController extends Controller
{
  public $successStatus = 200;
  public $errorStatus = 400;

  public function getList(Request $request)
  {
    $user = User::where('id', $request->id)->first();
    $http_host = $request->getSchemeAndHttpHost();

    $start = $request->input('start');
    $length = $request->input('length');
    $search = $request->input('search');
    $url = $request->input('url');
    $query_search = $search['value'];

    $data_filtered = Activity::orderBy('created_at', 'desc');

    if ($user->group_id != 0) {
      $data_filtered = $data_filtered->where('created_by', $user->id);
    }

    if ($request->type == "all") $data_filtered = $data_filtered;
    else $data_filtered = $data_filtered->where('type', $request->type);

    if(!empty($query_search)) 
    {
      $data_filtered = $data_filtered->where(function($query) use ($query_search) {
                          $query->orwhere('title', 'like', '%'.$query_search.'%')
                              ->orwhere('type', 'like', '%'.$query_search.'%')
                              ->orwhere('description', 'like', '%'.$query_search.'%');
                      });
    }

    $total_filtered = $data_filtered->count();
    $data_filtered = $data_filtered->take($length)->skip($start)->get();
    $total_request = Activity::count();
    
    $data['data'] = $this->generate_array_list($data_filtered, $url);
    $data['recordsTotal'] = $total_request;
    $data['recordsFiltered'] = $total_filtered;
    
    return response()->json($data);
  }

  private function generate_array_list($data, $url) 
  {
    $return = [];
    $no = 1;

    foreach($data as $item) 
    {
      $status = '';

      if ($item['is_status'] == 0) $status = 'Belum Dipublikasi';
      else if ($item['is_status'] == 1) $status = 'Dipublikasi';
      else if ($item['is_status'] == 2) $status = 'Dihapus';

      $temp = array(
          $no,
          $item["title"],
          $item["type"],
          $item["description"],
          $status,
          "<a href='/bo/rule/detail/".$item['id']."' class='btn btn-xs btn-default btn-edit'><i class='fa fa-edit'></i> Detail</a>"
      );
      array_push($return, $temp);
      $no++;
    }
    return $return;
  }

  public function getAll(Request $request)
  {
    $user = Auth::user();
    $http_host = $request->getSchemeAndHttpHost();

    $data['data'] = Activity::all();

    return response()->json($data, $this->successStatus);
	}

  public function getById(Request $request)
  {
    $user = Auth::user();
    $http_host = $request->getSchemeAndHttpHost();
    $req = $request->json()->all();

    $data['data'] = Activity::where('id', $req['id'])->first();

    return response()->json($data, $this->successStatus);
	}
}
