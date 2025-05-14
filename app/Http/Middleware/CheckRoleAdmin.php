<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRoleAdmin
{
    public function handle(Request $request, Closure $next)
    {   
        if(!$request->user()){
            return redirect('dang-nhap');
        }

        return $next($request);  // Proceed to the next middleware/route
    }
}