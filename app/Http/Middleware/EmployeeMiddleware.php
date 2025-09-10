<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EmployeeMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(!auth()->user() || auth()->user()->role != 'employee')
        {
            //Не работает редирект при попытке зайти не под админом
            return redirect()->route('index')->withErrors(['message' => 'У Вас нет прав для доступа к данному контенту']);
        }
        
        return $next($request);
    }
}
