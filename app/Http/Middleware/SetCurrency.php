<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class SetCurrency
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        //die("Cookie Check");
        /*if($request->cookie('selected_currency') == null){
            $currencyCookie = cookie("selected_currency",'usd',43800);
            //dd($currencyCookie);
            //$response->withCookie($currencyCookie);
            return Cookie::queue($currencyCookie);
        }else{
            die("Cookie is set");
        }*/
        if($this->hasCookie('selected_currency')){
            return $next($request);
        }else{
            $this->makeMyCookie();
            return $next($request);
        }
        
    }

    protected function makeMyCookie()
    {
        //dd(Cookie::make('selected_currency', 'usd', 43800));
        return Cookie::queue(Cookie::make('selected_currency', 'usd', 43800,'/',null,null,false));
    }

    protected function hasCookie($cookie_name)
    {
        $cookie_exist = Cookie::get($cookie_name);
        return ($cookie_exist) ? true : false;
    }
}
