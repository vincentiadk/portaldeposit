<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;

use Validator;

use App\User;

class UserController extends Controller
{
  public $successStatus = 200;
  public $errorStatus = 400;

  public function login(Request $request)
  {
    $data = $request->json()->all();
    $email = $data["email"];
    $password = $data["password"];

    if(Auth::attempt(['email' => $email, 'password' => $password]))
    {
      $user = Auth::user();
      $success['token'] =  $user->createToken('nApp')->accessToken;
      $success['message'] =  0;
      return response()->json(['success' => $success], $this->successStatus);
    }
    else
    {
      $success['message'] =  1;
      return response()->json(['success' => $success], $this->successStatus);
    }
  }

  public function register(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'name' => 'required',
      'email' => 'required|email',
      'password' => 'required',
      'c_password' => 'required|same:password',
    ]);

    if ($validator->fails()) 
    {
      return response()->json(['error'=>$validator->errors()], 401);            
    }

    $input = $request->all();
    $input['password'] = bcrypt($input['password']);
    $user = User::create($input);
    $success['token'] =  $user->createToken('nApp')->accessToken;
    $success['name'] =  $user->name;

    return response()->json(['success'=>$success], $this->successStatus);
  }

  public function detail()
  {
    $user = Auth::user();
    return response()->json(['success' => $user], $this->successStatus);
  }

  public function getAll(Request $request)
  {
    $user = Auth::user();
    $http_host = $request->getSchemeAndHttpHost();

    $data['data'] = User::all();

    return response()->json($data, $this->successStatus);
  }

  public function getById(Request $request)
  {
    $user = Auth::user();
    $http_host = $request->getSchemeAndHttpHost();

    $data['data'] = User::where('id', $request->id)->first();

    return response()->json($data, $this->successStatus);
  }

  public function updateById(Request $reques)
  {
    $user = Auth::user();
    $http_host = $request->getSchemeAndHttpHost();
    $req = $request->json()->all();

    $dataUpdate = [
      'name' => $req['name'],
      'email' => $req['email'],
      'password' => $req['password'],
      'updated_by' => $user->id,
      'updated_at' => now()
    ];

    $update = User::where('id', $req['id']) ->update($dataUpdate);

    if ($update == 1) 
    {
      $data = true;
      return response()->json($data, $this->successStatus);
    }
    else
    {
      $data = false;
      return response()->json($data, 400);
    }
  }

  public function deleteById(Request $request)
  {
    $user = Auth::user();
    $http_host = $request->getSchemeAndHttpHost();
    $req = $request->json()->all();

    User::where('id', $req['id'])->delete();

    $data = true;
    return response()->json($data, $this->successStatus);
  }

  public function getList(Request $request)
  {

    $start = $request->input('start');
    $length = $request->input('length');
    $search = $request->input('search');
    $url = $request->input('url');
    $query_search = strtolower($search['value']);

    $data_filtered = User::orderBy('name', 'asc');

    if(!empty($query_search)) {
      $data_filtered = $data_filtered->where(function($query) use ($query_search) {
        $query->orwhere(DB::Raw('lower(name)'), 'like', '%'.$query_search.'%');
      });
    }

    $total_filtered = $data_filtered->count();
    $data_filtered = $data_filtered->take($length)->skip($start)->get();
    $total_request = User::count();
    
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

      if ($item['is_active'] == 0) $status = 'Aktif';
      else if ($item['is_active'] == 1) $status = 'Non Aktif';

      $temp = array(
        $no,
        $item["name"],
        $item["nip"],
        $item["email"],
        $status,
        "<a href='/bo/user/detail/".$item['id']."' class='btn btn-xs btn-default btn-edit'><i class='fa fa-edit'></i> Detail</a>"
      );
      array_push($return, $temp);
      $no++;
    }
    return $return;
  }

  public function forgotPassword($email)
  {
    if (User::where('email',$email)->exists()) 
    {
      $user = User::where('email',$email)->first();
    }
    else {return 0;}

    try 
    {
      $id = encrypt($user->id.'|'.strtotime('+1 day'));
    } 
    catch (Exception $e) 
    {
      return 0;
    }
    return $this->sendmail($user, $id);
  }

  public function sendmail ()
  {
    $data = ['name' => 'fandaasdefaey'];
    Mail::send('mail', $data, function($message)
    {
        $message->to('chtakun7@gmail.com')->subject('Welcome!');
        // $message->from('pos@mitrakreasindo.com', 'Mitra System');
    });
    return 1;
  }

  public function sendmail2 ($user, $id){
    $data = ['name' => $user->individualId->name, 'id' => $id];
    Mail::send('systems.veryfication', $data, function($message) use ($user)
    {
        $message->to($user->email)->subject('Welcome!');
        $message->from('pos@mitrakreasindo.com', 'Mitra System');
    });
    return 1;
  }

  public function resendPassword($id)
  {
    try 
    {
      $id = decrypt($id);
      $id = explode('|', $id);
      $date = (int)$id[1];
      $id = $id[0];
    } 
    catch (Exception $e) 
    {
      return 2;
    }

    if (User::where('id', $id)->exists()) 
    {
      $user = User::find($id);
      if (strtotime('now')>$date) 
      {
        return 4;
      }
      else
      {
        $pw =Str::random(10);
        $user->password = bcrypt($pw);
        $user->save();
        return 1;
      }
    }
    else { return 3; }
  }
}