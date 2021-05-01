<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class OnlyLeader
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
        $kelas = $request->route()->parameter('kelas');
        $kelasLeader = $kelas->leader()->first();

        if($kelasLeader->id === auth()->user()->id) {
            return $next($request);
        } else {
            return redirect()->route('classes.show', $kelas);
        }

        
    }
}
