<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Illuminate\Contracts\Auth\Guard;


class Admin
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
        if($this->rol==6){
          return $next($request);
        }else{
          return redirect('/');
        }
    }
}
