<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class isGuest
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
            //cek apakah ada hostory login di authnya, kalau ada dibolehin lanjut akses laman
            if (Auth::check()){
                 //kalau gaada history login bakal diarahin lagi ke login dengan pesan
            return redirect('/todo')->withErrors(['notAllowed'=>'Anda sudah login!']);
        }
        return $next($request);
            }
    
           
    }
    
            
            

