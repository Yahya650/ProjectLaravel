<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Computer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckOwnerPc
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
        $id = $request->route('id') / 789456654987;
        if (Computer::find($id) && Computer::find($id)->user_id != Auth::id()) {
            return redirect()->route('404', 'error');
        }
        return $next($request);
    }
}
