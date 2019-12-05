<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Str;

class UserWC extends Controller
{
    function userView () 
    {
        return view('admin.user.user');
    }

    function userTambahView () 
    {
        return view('admin.user.user-detail')->with(["mode"=>"tambah","action"=>"/bo/user/tambah"]);
    }

    function userDetailView ($id) 
    {
        $data = User::where('id', $id)->first();
        return view('admin.user.user-detail')->with(["id"=>$id, 'data'=>$data,"mode"=>"detail","action"=>"/bo/user/update"]);
    }

    function userUpdate(Request $request) 
    {
        $req=$request->all();
        $req = $this->setup_data($req);
        if(strlen($req['password']) > 5 ){
            if($req['password'] == $req['kpassword']){
                $req['password'] = bcrypt($req['password']);
                unset($req['kpassword']);
            }
            unset($req['password']);
        } else {
            unset($req['password']);
            unset($req['kpassword']);
        }
        $req['updated_by'] = Auth::user()->id;
        $req['updated_at'] = now();
        if (User::where('id', $req['id'])->update($req) == 1) 
        {
            return back()->with("status",1);    
        } else{
            return back()->with("status",0);
        }
    }

    function userTambah(Request $request) 
    {
        $req = $request->all();
        $req = $this->setup_data($req);
        unset($req['id']);
        $req['created_by'] = Auth::user()->id;
        $req['created_at'] = now();
        $req['group_id'] = 1;
        $pass = Str::random(6);
        $req['password'] = bcrypt($pass);
        $data = ['name'=>$req['name'],'email'=>$req['email'],'pass'=>$pass]; 
        if (User::insert($req)) {
            $this->sendmail($data);
            return back()->with("status",1);    
        }

        return back()->with("status",0);
    }

    function setup_data($req)
    {
        unset($req['simpan']);
        unset($req['simpanpub']);
        unset($req['_token']);
        return $req;
    }

    function forgot_password(Request $request)
    {
        $req = $request->all();

        $user = User::where('email', $req['email'])->first();

        $req['name'] = $user->name;

        $pass = Str::random(6);
        $data = ['name'=>$req['name'],'email'=>$req['email'],'pass'=>$pass]; 

        $res = $this->reset_password($data);

        if ($res == 1) {
            User::where('email', $req['email'])->update(['password' => bcrypt($pass)]);
            return back()->with("status",1);
        }
        return back()->with("status",0);

    }

    public function reset_password ($data)
    {

        Mail::send('mail-resetpass', $data, function($message) use($data)
        {
            $message->to($data['email'])->subject('Akun Perpustakaan Nasional Republik Indonesia');
        });
        return 1;
    }

    public function sendmail ($data)
    {

        Mail::send('mail-regis', $data, function($message) use($data)
        {
            $message->to($data['email'])->subject('Akun Portal Deposit Perpustakaan Nasional Republik Indonesia');
        });
        return 1;
    }

}
