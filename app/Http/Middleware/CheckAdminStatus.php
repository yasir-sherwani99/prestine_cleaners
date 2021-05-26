<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class CheckAdminStatus
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
        if (Auth::guard('admin')->check())
        {
            if(Auth()->guard('admin')->user()->status == 0)
            {
                auth()->logout();

                $request->session()->invalidate();
                $message = 'Your account is disabled. For more information or activate your account, please contact Prestine Administration.';
                return redirect('/admin_panel/login')->withAlert($message);
            }
            else
            {
              //  return redirect('dashboard');
                return $next($request);
            }
        }
    }
}
