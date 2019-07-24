<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\Region;

class RegionController extends Controller
{
  public $successStatus = 200;

  public function getAll (Request $request)
  {
    $user = Auth::user();
    $http_host = $request->getSchemeAndHttpHost();

    $data['data'] = Region::all();

    return response()->json($data, $this->successStatus);
	}

  public function getById (Request $request)
  {
    $user = Auth::user();
    $http_host = $request->getSchemeAndHttpHost();
    $req = $request->json()->all();

    $data['data'] = Region::where('id', $req['id'])->first();

    return response()->json($data, $this->successStatus);
	}
}
