<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImportCodesRequest;
use App\Models\Category;
use App\Models\Code;
use App\Models\Coderecord;
use Illuminate\Http\Request;
use Psy\Readline\Hoa\Console;
use Illuminate\Support\Facades\Gate;


class CodesController extends Controller
{
    public function index()
    {
        // عرض كل الأكواد
        $codes = Code::all();
        return view('codes.index', compact('codes'));
    }

    public function show($id)
    {
        // عرض كود محدد
        $code = Code::findOrFail($id);
        return view('codes.show', compact('code'));
    }
    public function showCodesByCategory($categoryId)
    {
        // استرجاع الفئة المحددة
        $category = Category::findOrFail($categoryId);

        // استرجاع الأكواد التي تنتمي إلى الفئة المحددة
        $codes = Code::where('category_id', $categoryId)->get();

        return view('codes.details', compact('category', 'codes'));
    }


public function addToCodeRecord($codeId)
{
    // احصل على الكود المحدد
    $code = Code::findOrFail($codeId);

    // احصل على المستخدم الحالي
    $user = auth()->user();
    $totalCreditBalance = $user->balance->sum('credit_balance');

    // التحقق من أن رصيد المستخدم كافٍ لشراء الكود
    if ($totalCreditBalance >= $code->category->price) {
        try {
            // إضافة الكود إلى سجل الأكواد
            CodeRecord::create([
                'user_id' => $user->id,
                'code_id' => $code->id,
            ]);

            // خصم سعر الكود من رصيد المستخدم
            $user->balance->credit_balance -= $code->category->price;
            $user->balance->save();

            // تحديث حالة الشراء في جدول الأكواد
            $code->update(['purchased' => true]);

            // عرض رسالة النجاح والرابط
            return redirect()->back()->with('success', 'تم شراء الكود بنجاح.')->with('code_purchased', true);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'حدث خطأ أثناء عملية الشراء: ' . $e->getMessage());
        }
    } else {
        return redirect()->with('error', 'لا يوجد رصيد كافٍ لشراء هذا الكود.');
    }
}



    public function create()
    {
        if (Gate::allows('is-admin')) {
        $categories = Category::all();

        if ($categories->isEmpty()) {
            return redirect()->route('categories.create')->with('error', 'يجب إضافة فئات أولاً.');
        }

        return view('codes.create', compact('categories'));
    } else {
        return abort(403, 'Unauthorized action.');
    }
    }

    public function store(ImportCodesRequest $request)
    {
        $file = $request->file('file');
        $category_id = $request->input('category_id');
        $price = $request->input('price',0);

        // التحقق من وجود الملف
        if (!$file) {
            return redirect()->route('codes.create')->with('error', 'يجب اختيار ملف الأكواد.');
        }

        // قراءة المحتوى من الملف النصي
        $content = file_get_contents($file->path());

        // تحويل المحتوى إلى مصفوفة من الأكواد
        $codes = explode("\n", $content);

        // حفظ الأكواد في جدول الأكواد
        foreach ($codes as $code) {
            Code::create([
                'code' => $code,
                'category_id' => $category_id,
                'price' => $price,
            ]);
        }

        return redirect()->route('codes.create')->with('success', 'تمت إضافة الأكواد بنجاح.');
    }



    public function destroy($id)
    {
        if (Gate::allows('is-admin')) {
        $code = Code::findOrFail($id);
        $code->delete();

        return redirect()->route('codes.details')
            ->with('success', 'تم حذف الكود بنجاح');
        } else {
            return abort(403, 'Unauthorized action.');
        }
    }
}
