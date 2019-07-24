<?php

namespace App\Http\Controllers\webpage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Rule;

class PedomanController extends Controller
{
  public function pedoman()
  {
    $data = $this->pedomans();
    return view('webpage.pedomandanperaturan2')->with(['datas' => $data]);
  }
  
  private function pedomans()
  {
    $data = Rule::where('type', '!=', 'tentang')->where('type', '!=', 'faq')->get();
    return $data;
  }
  
  public function detailpedoman($slug)
  {
    $data = $this->getdetail($slug);
    return view('webpage.detailpedoman')->with(['datas' => $data]);
  }

  private function getdetail($slug){
    $newslug = "rule/".$slug;
    $data = Rule::where('slug', $newslug)->first();

    return $data;
  }
}

?>