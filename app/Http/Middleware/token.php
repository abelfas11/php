<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class token
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {      
        $token = $request->header('token');
        if ($token == 'token'){
            return $next($request);
        }else{
            return response()->json(['massage'=>'not valid token']);
        }
        return $next($request);
    }
}
