<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Darryldecode\Cart\CartCondition;
use Darryldecode\Cart\Cart;


class FormOrderAccess
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



        if (!\Cart::session(Session::getId())->isEmpty()) {
            return $next($request);
        }
        abort(404);



    }
}
