<?php

namespace App\Http\Middleware;

use App\Enums\CompanyStatus;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();
        //$user->hasRole(['مدیر کل','فروشنده'])
             //dd($user->seller);
        if ($user->is_admin){
            return $next($request);
        }else if($user->seller  ? $user->seller->status===CompanyStatus::Active->value : null){
            return $next($request);
        }else{
            return redirect()->route('home');
        }
    }
}
