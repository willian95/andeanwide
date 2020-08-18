<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class VerificationLevelOne
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
        $user = Auth::user();
        if(isset($user->verificationLevel) && $user->verificationLevel >= 1 ){
            return $next($request);
        }
        return redirect()->route('panel.user.verify');
    }
}
