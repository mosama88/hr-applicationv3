<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectToDashboard
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // إذا كان المستخدم مسجلاً دخوله (مستخدم موثوق)
        if (Auth::guard('admin')->check()) {
            // إذا حاول الوصول إلى الصفحة الرئيسية '/'، يتم توجيهه إلى لوحة التحكم
            if ($request->is('/')) {
                return redirect()->route('dashboard.index');
            }
        }
        // إذا كان المستخدم غير مسجل دخوله (زائر)
        else {
            // إذا حاول الوصول إلى صفحة الدخول '/' أو أي صفحة تحتوي على 'dashboard'
            if ($request->is('dashboard*') || $request->is('/')) {
                return redirect()->route('login');
            }
        }

        return $next($request);
    }
}