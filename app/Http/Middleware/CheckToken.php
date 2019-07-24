<?php

namespace App\Http\Middleware;

use Closure;

class CheckToken
{
  /**
   * Handle an incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure  $next
   * @return mixed
   */
  public function handle($request, Closure $next) 
  {
    $token = session()->get('token');
    if(!empty($token)) 
    {
      return $next($request);
    }
    else return redirect(url('/login'));
  }
}
