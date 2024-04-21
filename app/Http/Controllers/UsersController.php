<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\View;


class UsersController extends Controller
{
    public function showAllUsers()
    {
        if (Gate::allows('is-admin')) {
            $users = User::all();
            
            return view('Delegates.index', compact('users'));
        } else {
            return abort(403, 'Unauthorized action.');
        }
    }
    public function showAllUsersd()
    {
        if (Gate::allows('is-admin')) {
            $users = User::all();
            return view('Delegates.index', compact('users'));
        } else {
            return abort(403, 'Unauthorized action.');
        }
    }
    public function toggleStatus(Request $request, $userId)
    {
        $user = User::findOrFail($userId);
        $isActive = $user->is_active;

        // تبديل قيمة الحالة
        $newStatus = !$isActive;

        // تحديث الحالة في قاعدة البيانات
        $user->is_active = $newStatus;
        $user->save();


        // إعداد رسالة النجاح
        $message = $newStatus ?  'تم إعادة تفعيل حساب المستخدم بنجاح.':'تم إيقاف تفعيل حساب المستخدم بنجاح.' ;

        // إعادة توجيه مع رسالة النجاح
        return redirect()->route('users.index')->with('success', $message);
    }
}
