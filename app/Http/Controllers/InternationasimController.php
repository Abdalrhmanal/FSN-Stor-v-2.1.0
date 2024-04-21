<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;

use App\Models\Internationalsim;
use App\Notifications\InternationalsimAdd;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InternationasimController extends Controller
{
    public function index()
    {
        if(Auth::user()->role_id == 1){
            // استرجاع جميع تفعيلات السيم الدولية
            $internationalSims = Internationalsim::all();
            return view('activations.index', compact('internationalSims'));
        }elseif(Auth::user()->role_id == 2){
            $user = auth()->user();

            if ($user) {
            $internationalSims = $user->internationalSims()->get();

            return view('activations.index', compact('internationalSims'));
            }
        } else {
            return redirect()->route('login');
        }

    }
    public function show($id)
{
    // ابحث عن التفعيل باستخدام المعرف المعطى
    $activation = Internationalsim::findOrFail($id);

    // اعرض عرض الصفحة لعرض تفاصيل التفعيل
    return view('activations.show', compact('activation'));
}




    public function create()
    {
        // عرض نموذج إضافة تفعيل سيم دولية
        return view('activations.create');
    }

    public function store(Request $request)
{
    $validator = Validator::make($request->all(), [
        'first_image' => 'required|image|mimes:jpeg,png,jpg,gif',
        'second_image' => 'required|image|mimes:jpeg,png,jpg,gif',
    ], [
        'first_image.required' => 'يرجى تحميل الصورة الأولى',
        'first_image.image' => 'يجب أن تكون الصورة الأولى ملف صورة',
        'first_image.mimes' => 'تنسيق الصورة الأولى يجب أن يكون jpeg، png، jpg، أو gif',
        'second_image.required' => 'يرجى تحميل الصورة الثانية',
        'second_image.image' => 'يجب أن تكون الصورة الثانية ملف صورة',
        'second_image.mimes' => 'تنسيق الصورة الثانية يجب أن يكون jpeg، png، jpg، أو gif',
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }
    // استخراج معرف المستخدم الحالي
    $userId = Auth::id();
    $user = auth()->user();
    $totalCreditBalance = $user->balance->sum('credit_balance');
    if ($totalCreditBalance >= 170) {
    try {
    // حفظ بيانات تفعيل سيم دولية جديدة في قاعدة البيانات
    $data = $request->all();
    $data['user_id'] = $userId;

    // تحميل الصور وحفظ المعلومات في قاعدة البيانات
    $internationalSim = new Internationalsim($data);

    if ($request->hasFile('first_image')) {
        // تحديد اسم الملف
        $firstImageName = time() . '.' . $request->file('first_image')->getClientOriginalExtension();

        // تحديد المسار للحفظ
        $firstImagePath = public_path('images');
        $firstImagePath = str_replace('public', 'public_html', $firstImagePath);

        // حفظ الصورة
        $request->file('first_image')->move($firstImagePath, $firstImageName);

        // حفظ اسم الصورة في قاعدة البيانات
        $internationalSim->first_image = 'images/' . $firstImageName;
    }

    if ($request->hasFile('second_image')) {
        // تحديد اسم الملف
        $secondImageName = time() . '_' . $request->file('second_image')->getClientOriginalExtension();

        // تحديد المسار للحفظ
        $secondImagePath = public_path('images');
        $secondImagePath = str_replace('public', 'public_html', $secondImagePath);
        // حفظ الصورة
        $request->file('second_image')->move($secondImagePath, $secondImageName);

        // حفظ اسم الصورة في قاعدة البيانات
        $internationalSim->second_image = 'images/' . $secondImageName;
    }
            // خصم سعر الكود من رصيد المستخدم
            $user->balance->credit_balance -= 170;
            $user->balance->save();
    $internationalSim->save();
    
    // إرسال إشعار للمستخدم الإداري
    $adminUser = \App\Models\User::where('role_id', 1)->first();
    if ($adminUser) {
        $adminUser->notify(new InternationalsimAdd([
            'serial_number' => $internationalSim->serial_number,
            'first_image' => $internationalSim->first_image,
            'second_image' => $internationalSim->second_image,
            'user_id' => $userId,
            'internationalSim_id' => $internationalSim->id
        ]));
    }

    return redirect()->route('activations.index')
        ->with('success', 'تمت إضافة تفعيل سيم دولي بنجاح');
    } catch (\Exception $e) {
            return redirect()->back()->with('error', 'حدث خطأ أثناء عملية الشراء: ' . $e->getMessage());
        }
    } else {
        return redirect()->with('error', 'لا يوجد رصيد كافٍ لشراء تفعيل خط دولي .');
    }
}



    public function destroy(Internationalsim $internationalSim)
    {
        // حذف سجل تفعيل سيم دولية
        $internationalSim->delete();

        return redirect()->route('activations.index')
            ->with('success', 'تم حذف تفعيل سيم دولية بنجاح');
    }
}
