<?php
namespace App\Http\Middleware;
use Closure;
use Route;
use Auth;
class CheckStatus
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
        if(auth()->user()->status != 0){
            return $next($request);
        }else{
            Auth::guard('front')->logout();
            return redirect()->route("front-login")->with('error','You have been de-activated by admin');
        }
    }
}