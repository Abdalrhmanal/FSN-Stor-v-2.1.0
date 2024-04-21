<?php

namespace App\Http\Controllers;

use App\Models\Code;
use App\Models\Coderecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CodeManagementController extends Controller
{
    public function index()
{
    // عرض جميع الأكواد التي باعها جميع المستخدمين
    $codes = Coderecord::getAllCodes();
    return view('code_management.user_sold_codes', compact('codes'));
}

public function userSoldCodes()
{
    // احصل على المستخدم الحالي
    $user = Auth::user();

    // جلب جميع السجلات من جدول Coderecord التابعة للمستخدم الحالي
    $coderecords = $user->coderecords()->with('code.category')->get();

    return view('code_management.index', compact('coderecords'));
}




    public function show($id)
    {
        // عرض تفاصيل كود محدد
        $code = Code::with('user')->findOrFail($id);
        return view('code_management.show', compact('code'));
    }
    public function showDetails($id)
    {
        // عرض تفاصيل سجل محدد مع معلومات الفئة والمستخدم
        $code = Code::with('category', 'user')->findOrFail($id);
        return view('code_management.show_details', compact('code'));
    }

    public function create()
    {
        // عرض نموذج إضافة كود
        return view('code_management.create');
    }

    public function store(Request $request)
    {
        // حفظ الكود المضاف
        $request->validate([
            'code' => 'required|unique:codes',
            'type' => 'required',
            'price' => 'required',
            // أي حقول إضافية يمكن إضافتها حسب الحاجة
        ]);

        Code::create($request->all());

        return redirect()->route('code_management.index')
            ->with('success', 'تمت إضافة الكود بنجاح');
    }

    public function edit($id)
    {
        // عرض نموذج تعديل كود
        $code = Code::findOrFail($id);
        return view('code_management.edit', compact('code'));
    }

    public function update(Request $request, $id)
    {
        // تحديث الكود المحدد
        $request->validate([
            'code' => 'required|unique:codes,code,' . $id,
            'type' => 'required',
            'price' => 'required',
            // أي حقول إضافية يمكن تحديثها حسب الحاجة
        ]);

        $code = Code::findOrFail($id);
        $code->update($request->all());

        return redirect()->route('code_management.index')
            ->with('success', 'تم تحديث الكود بنجاح');
    }

    public function destroy($id)
    {
        // حذف الكود المحدد
        $code = Code::findOrFail($id);
        $code->delete();

        return redirect()->route('code_management.index')
            ->with('success', 'تم حذف الكود بنجاح');
    }
}
