<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PasswordChangedMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // التحقق مما إذا كان المستخدم مسجل الدخول وليس null
        if (Auth::check() && Auth::user()->password_changed_at) {
            // تسجيل الخروج
            Auth::logout();

            // إعادة توجيه المستخدم إلى صفحة تسجيل الدخول مع رسالة توضح سبب تسجيل الخروج
            return redirect('/login')->with('warning', 'تم تغيير كلمة المرور، يجب تسجيل الدخول مرة أخرى.');
        }

        return $next($request);
    }
}
