<?php

namespace App\Http\Controllers;

use App\Models\Simcard;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;


class SimCardController extends Controller
{

    public function index()
    {
        // 1. تأكيد مستخدم مسجل الدخول
        if (Auth::check()) {
            // 2. جلب معرف المستخدم الحالي
            $userId = Auth::id();

            // 3. استخدام المعرف لجلب الخطوط التي لم يتم تسجيلها في جدول المبيعات
            $simCards = Simcard::where('user_id', $userId)
                ->whereNotExists(function ($query) {
                    $query->select(DB::raw(1))
                        ->from('soldlines')
                        ->whereRaw('soldlines.simcard_id = simcards.id');
                })
                ->get();

            return view('sim_card.index', compact('simCards'));
        } else {
            // يمكنك إضافة رسالة خطأ أو توجيه المستخدم إلى صفحة تسجيل الدخول
            return redirect()->route('login')->with('error', 'يجب تسجيل الدخول أولاً.');
        }
    }


    public function show($id)
    {
        // عرض تفاصيل سيم كارد محدد
        $simCard = Simcard::with('user')->findOrFail($id);
        return view('sim_card.show', compact('simCard'));
    }
    public function showDetails($id)
    {
        // عرض تفاصيل سيم كارد مباعة محددة
        $simCard = Simcard::findOrFail($id);

        return view('sim_card.show_details', compact('simCard'));
    }

    public function create()
    {
        if (Gate::allows('is-admin')) {
            $users = User::all(); // افتراضي أن لديك نموذج User لتمثيل المستخدمين
            return view('sim_card.create', compact('users'));
        } else {
            return abort(403, 'Unauthorized action.');
        }
    }

    public function store(Request $request)
    {
        // افحص البيانات المدخلة
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'file' => 'required|mimes:txt',
            'price' => 'required|numeric',
        ]);

        $file = $request->file('file'); // تم تغيير هنا
        $user_id = $request->input('user_id');
        $price = $request->input('price');

        // التحقق من وجود الملف
        if (!$file || !$file->isValid()) {
            return redirect()->back()->with('error', 'يرجى اختيار ملف صحيح.');
        }

        // قراءة المحتوى من الملف النصي
        $content = file_get_contents($file->path());

        // تحويل المحتوى إلى مصفوفة من الأرقام التسلسلية
        $serialNumbers = explode("\n", $content);

        try {
            // استخدام DB::transaction لتأكيد التخزين الناجح للجميع أو فشله
            DB::transaction(function () use ($serialNumbers, $user_id, $price) {
                foreach ($serialNumbers as $serialNumber) {
                    // التحقق من أن الرقم التسلسلي غير فارغ
                    $serialNumber = trim($serialNumber);
                    if ($serialNumber !== '') {
                        Simcard::create([
                            'serial_number' => $serialNumber,
                            'user_id' => $user_id,
                            'price' => $price,
                            // أي حقول إضافية يمكن إضافتها حسب الحاجة
                        ]);
                    }
                }
            });

            // إذا تمت العملية بنجاح، قم بإظهار النموذج مع رسالة نجاح
            return redirect()->route('sim_card1.create')->with('success', 'تمت إضافة الأرقام التسلسلية بنجاح.');
        } catch (\Exception $e) {
            // إذا حدث خطأ، قم بإظهار النموذج مع رسالة خطأ
            return redirect()->route('sim_card1.create')->with('error', 'حدث خطأ أثناء إضافة الأرقام التسلسلية.');
        }
    }


    public function edit($id)
    {
        // عرض نموذج تعديل سيم كارد
        $simCard = Simcard::findOrFail($id);
        return view('sim_card.edit', compact('simCard'));
    }

    public function update(Request $request, $id)
    {
        // تحديث السيم كارد المحدد
        $request->validate([
            'serial_number' => 'required|unique:sim_cards,serial_number,' . $id,
            // أي حقول إضافية يمكن تحديثها حسب الحاجة
        ]);

        $simCard = Simcard::findOrFail($id);
        $simCard->update($request->all());

        return redirect()->route('sim_cards.index')
            ->with('success', 'تم تحديث السيم كارد بنجاح');
    }

    public function destroy($id)
    {
        if (Gate::allows('is-admin')) {
            // حذف السيم كارد المحدد
            $simCard = Simcard::findOrFail($id);
            $simCard->delete();

            return redirect()->route('sim_cards.index')
                ->with('success', 'تم حذف السيم كارد بنجاح');
        } else {
            return abort(403, 'Unauthorized action.');
        }
    }
}
