<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DataController extends Controller
{
  public function collection()
  {
    $client = new \GuzzleHttp\Client();
    $res = $client->request('Get', get_variable()['url_perpus']."/collections/" [
        
    ]);

    $res = json_decode($res->getBody());
    return $res;
  }

  public function collectionById ($id)
  {
    $client = new \GuzzleHttp\Client();
      $res = $client->request('Get', get_variable()['url_perpus']."/collections/".$id [
          
      ]);

      $res = json_decode($res->getBody());
      return $res;
  }

  public function publisher()
  {
    $client = new \GuzzleHttp\Client();
    $res = $client->request('Get', get_variable()['url_perpus']."/publisher/" [
        
    ]);

    $res = json_decode($res->getBody());
    return $res;
  }

  public function publisherById($id)
  {
    $client = new \GuzzleHttp\Client();
    $res = $client->request('Get', get_variable()['url_perpus']."/publisher/".$id [
        
    ]);

    $res = json_decode($res->getBody());
    return $res;
  }

  public function collectionmedia()
  {
    $client = new \GuzzleHttp\Client();
    $res = $client->request('Get', get_variable()['url_perpus']."/collectionmedia/" [
        
    ]);

    $res = json_decode($res->getBody());
    return $res;
  }

  public function worksheet()
  {
    $client = new \GuzzleHttp\Client();
    $res = $client->request('Get', get_variable()['url_perpus']."/worksheet/" [
        
    ]);

    $res = json_decode($res->getBody());
    return $res;
  }

  public function publishlocation()
  {
    $client = new \GuzzleHttp\Client();
    $res = $client->request('Get', get_variable()['url_perpus']."/publishlocation/" [
        
    ]);

    $res = json_decode($res->getBody());
    return $res;
  }
}
