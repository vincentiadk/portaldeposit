<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\Page;

class PageController extends Controller
{
  public $successStatus = 200;
  public $errorStatus = 400;

  public function getList(Request $request)
  {
    $user = Auth::user();
    $http_host = $request->getSchemeAndHttpHost();

    $start = $request->input('start');
    $length = $request->input('length');
    $search = $request->input('search');
    $url = $request->input('url');
    $query_search = $search['value'];

    $data_filtered = Page::orderBy('created_at', 'desc');

    if(!empty($query_search)) 
    {
      $data_filtered = $data_filtered->where(function($query) use ($query_search) {
                          $query->orwhere('title', 'like', '%'.$query_search.'%')
                              ->orwhere('author', 'like', '%'.$query_search.'%')
                              ->orwhere('publisher', 'like', '%'.$query_search.'%');
                      });
    }

    $total_filtered = $data_filtered->count();
    $data_filtered = $data_filtered->take($length)->skip($start)->get();
    $total_request = Page::count();
    
    $data['data'] = $this->generate_array_list($data_filtered, $url);
    $data['recordsTotal'] = $total_request;
    $data['recordsFiltered'] = $total_filtered;
    
    return response()->json($data);
  }

  private function generate_array_list($data, $url)
  {
    $return = [];
    $no = 1;

    foreach ($data as $item) 
    {
      $status = '';

      if ($item['is_status'] == 0) $status = 'Belum Dipublikasi';
      else if ($item['is_status'] == 1) $status = 'Dipublikasi';
      else if ($item['is_status'] == 2) $status = 'Dihapus';

      $temp = array(
          $no,
          $item["title"],
          $item["author"],
          $item["publisher"],
          $item["publishyear"],
          $item["type"],
          $status,
          "<a href='/Page/detail/".$item['id']."' class='btn btn-xs btn-default btn-edit'><i class='fa fa-edit'></i> Detail</a>"
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
    $req = $request->json()->all();

    $data['data'] = Page::all();

    return response()->json($data, $this->successStatus);
  }

  public function getById(Request $request)
  {
    $user = Auth::user();
    $http_host = $request->getSchemeAndHttpHost();
    $req = $request->json()->all();

    $data['data'] = Page::where('id', $req['id'])->first();

    return response()->json($data, $this->successStatus);
	}

  public function save(Request $request)
  {
    $user = Auth::user();
    $http_host = $request->getSchemeAndHttpHost();
    $req = $request->json()->all();

    $array_to_input = [
      "type" => $req["type"],
      "title" => $req["title"],
      "slug" => $req["slug"],
      "datetime" => $req["datetime"],
      "description" => $req["description"],
      "status" => "not published",
      "info" => $req["info"],
      "created_by" => $user->id,
      "created_at" => now()
    ];

    $data["id"] = InsertGetId([$array_to_input]);

    if ($data["id"] != NULL) 
    {
      $data["message"] = "success";
      return response()->json($data, $this->successStatus);
    }
    else
    {
      $data["message"] = "error";
      return response()->json($data, $this->errorStatus);
    }
  }

  public function updateById(Request $request)
  {
    $user = Auth::user();
    $http_host = $request->getSchemeAndHttpHost();
    $req = $request->json()->all();

    $array_to_input = [
      "type" => $req["type"],
      "title" => $req["title"],
      "slug" => $req["slug"],
      "datetime" => $req["datetime"],
      "description" => $req["description"],
      "status" => "not published",
      "info" => $req["info"],
      "updated_by" => $user->id,
      "updated_at" => now()
    ];

    Page::where('id', $req['id'])->update($array_to_input);

    $data["message"] = "success";
    return response()->json($data, $this->successStatus);
  }

  public function deleteById(Request $request)
  {
    $user = Auth::user();
    $http_host = $request->getSchemeAndHttpHost();
    $req = $request->json()->all();

    $array_to_input = [
      "status" => "deleted",
      "deleted_by" => $user->id,
      "deleted_at" => now()
    ];

    Page::where('id', $req['id'])->update($array_to_input);

    $data["message"] = "success";
    return response()->json($data, $this->successStatus);
  }
}
