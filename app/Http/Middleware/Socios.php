<?php

namespace App\Http\Middleware;
use Illuminate\Contracts\Auth\Guard;
use Auth;

use Closure;

class Socios
{
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
        $this->rol = Auth::user()->rol_id;

    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
      if($this->rol>=1){
        return $next($request);
      }else{
        return redirect('/home');
      }
    }
}
