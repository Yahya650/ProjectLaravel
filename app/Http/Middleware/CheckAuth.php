<?php

namespace App\Http\Middleware;

use App\Models\Computer;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckAuth
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
        $id = $request->route('computer') / 789456654987;
        if (Computer::find($id)) {
            if (Computer::find($id)->user_id != Auth::id()) {
                return redirect()->route('404', 'error');
            }
        } else {
            return redirect()->route('404', 'error404');
        }
        return $next($request);
    }
}
