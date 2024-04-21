<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use App\Models\User;
class PasswordController extends Controller
{
    /**
     * Update the user's password.
     */
    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validateWithBag('updatePassword', [
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);

        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        return back()->with('status', 'password-updated');
    }
    
    public function showEditPasswordFormAdmin($userId)
    {
        // احصل على المستخدم المطلوب
        $user = User::findOrFail($userId);

        // إرجاع النموذج مع بيانات المستخدم
        return view('auth.edit_password_form', compact('user'));
    }
    


public function updatePasswordAdmin(Request $request, $userId)
{
    // استخراج كلمة المرور الجديدة من الطلب
    $newPassword = $request->input('password');

    // احصل على المستخدم
    $user = User::findOrFail($userId);

    // تحديث كلمة المرور
    $user->password = Hash::make($newPassword); // تشفير كلمة المرور الجديدة
    $user->setRememberToken(null); // حذف التوكن
    $user->save();

    // إعادة توجيه مع رسالة النجاح
    return redirect()->route('users.index')->with('success', 'تم تحديث كلمة المرور بنجاح   .');
}

   
}
