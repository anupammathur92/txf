<?php
namespace App\Http\Middleware;
use Closure;
use Route;
use Auth;
class CheckTokenid
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
        $tokenid = md5(json_encode($request->all()));
        if($request->header("TOKENID")!=$tokenid){
            $response = ['status'=>false,'message'=>'Invalid request','data'=>[]];
            return response()->json($response);
        }
        return $next($request);
    }
}