<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;
use Response;

use App\Publication;
use App\Galery;
use App\User;

class PublicationController extends Controller
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

    $query_search = strtolower($search['value']);

    $data_filtered = Publication::orderBy('created_at', 'desc');

    if ($user->group_id != 0) {
      $data_filtered = $data_filtered->where('created_by', $user->id);
    }

    if ($request->type == "all") $data_filtered = $data_filtered;
    else $data_filtered = $data_filtered->where('type', $request->type);

    if(!empty($query_search)) 
    {
      $data_filtered = $data_filtered->where(function($query) use ($query_search) {
                          $query->orwhere(DB::Raw('lower(title)'), 'like', '%'.$query_search.'%')
                              ->orwhere(DB::Raw('lower(author)'), 'like', '%'.$query_search.'%')
                              ->orwhere(DB::Raw('lower(publisher)'), 'like', '%'.$query_search.'%');
                      });
    }

    $total_filtered = $data_filtered->count();
    $data_filtered = $data_filtered->take($length)->skip($start)->get();
    $total_request = Publication::count();
    
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
      $temp = array(
        $no,
        $item["title"],
        $item["author"],
        $item["publisher"],
        $item["publishyear"],
        $item["type"],
        $item["is_status"],
        "<a href='/bo/deposit/terbitan-deposit/detail/".$item['id']."' class='btn btn-xs btn-default btn-edit'><i class='fa fa-edit'></i> Detail</a>"
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

    $data['data'] = Publication::all();

    return response()->json($data, $this->successStatus);
  }

  public function getById(Request $request)
  {
    $user = Auth::user();
    $http_host = $request->getSchemeAndHttpHost();

    $data['data'] = Publication::where('id', $request->id)->first();

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
      "author" => $req["author"],
      "city" => $req["city"],
      "publisher" => $req["publisher"],
      "publishyear" => $req["publishyear"],
      "edition" => $req["edition"],
      "worksheet" => $req["worksheet"],
      "description" => $req["description"],
      //"files" => $req["files"],
      "is_status" => $req["is_status"],
      "created_by" => $user->id,
      "created_at" => now()
    ];

    $data["id"] = Publication::insertGetId($array_to_input);

    if ($request->hasfile('images')) 
    {
      $images = $request->file->getClientOriginalName();
      $images = time().'_'.$images;
      $request->file->storeAs('/public/galery',$images);

      $array_to_input2 = [
        "table_name" => 'publications',
        "foreign_id" => $data['id'],
        "file_name" => $images,
        "created_by" => $user->id,
        "created_at" => now()
      ];

      $data["galery_id"] = Galery::insertGetId([$array_to_input2]);
    }

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

  public function image()
  {
    return response()->download(storage_path('app\public\galery\\' . "1552743630_Untitled-3.png"));
  }

  public function updateById(Request $request)
  {
    $user = Auth::user();
    $http_host = $request->getSchemeAndHttpHost();
    $req = $request->json()->all();

    $array_to_input = [
      "type" => $req["type"],
      "title" => $req["title"],
      "author" => $req["author"],
      "city" => $req["city"],
      "publisher" => $req["publisher"],
      "publishyear" => $req["publishyear"],
      "edition" => $req["edition"],
      "worksheet" => $req["worksheet"],
      "description" => $req["description"],
      //"files" => $req["files"],
      "is_status" => $req["is_status"],
      "updated_by" => $user->id,
      "updated_at" => now()
    ];

    Publication::where('id', $req['id'])->update($array_to_input);

    $data["message"] = "success";
    return response()->json($data, $this->successStatus);
  }

  public function deleteById(Request $request)
  {
    $user = Auth::user();
    $http_host = $request->getSchemeAndHttpHost();
    $req = $request->json()->all();

    $array_to_input = [
      "is_status" => "not_published",
      "deleted_by" => $user->id,
      "deleted_at" => now()
    ];

    Publication::where('id', $req['id'])->update($array_to_input);

    $data["message"] = "success";
    return response()->json($data, $this->successStatus);
  }

  public function newest()
  {
    $data = Publication::orderby('created_at', 'desc')->take(10)->get();

    return response()->json($data, $this->successStatus);
  }

  public function getCount()
  {
    return count(Publication::all());
  }

  public function getByPage(Request $req)
  {
    $data = Publication::orderBy('created_at', 'desc');
    if ($req->type != "") $data->where('type', $req->type);

    $data->where(function($query) use ($req) {
        $query->orwhere('title', 'like', '%'.$req->search.'%')
            ->orwhere('author', 'like', '%'.$req->search.'%')
            ->orwhere('publisher', 'like', '%'.$req->search.'%');
    });
  
    return $data->paginate(10);
  }
}
