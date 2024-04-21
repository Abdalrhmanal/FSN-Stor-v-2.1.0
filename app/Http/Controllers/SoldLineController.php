<?php

namespace App\Http\Controllers;

use App\Models\Simcard;
use App\Models\Soldline;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class SoldLineController extends Controller
{
    public function index()
    {
        if(Auth::user()->role_id == 1){
            $soldLines = Soldline::all();
            return view('sold_lines.index', compact('soldLines'));
        }elseif(Auth::user()->role_id == 2){
             if (Auth::check()) {
            // المستخدم مسجل الدخول
            $user = Auth::user();

            $soldLines = Soldline::with(['simcard.user']) // تضمين علاقة المستخدم من جدول simcard
                ->whereHas('simcard', function ($query) use ($user) {
                    $query->where('user_id', $user->id);
                })
                ->get();
            // قم بتحويل المستخدم إلى صفحة HTML لعرض الخطوط المباعة
            return view('sold_lines.index', compact('soldLines'));
        } else {
            return redirect()->route('login');
        }

        } else {
            // المستخدم غير مسجل الدخول
            return redirect()->route('login')->with('error', 'يرجى تسجيل الدخول');
        }
    }

    public function getAllSoldLinesWithUserName()
    {
        if (Auth::check()) {

            // استرجاع جميع الخطوط المباعة مع معلومات المستخدم، وترتيبها حسب الوقت
            $soldLines = Soldline::with(['simcard.user'])
                ->orderBy('created_at', 'desc')
                ->get();

            // استرجاع جميع المستخدمين - اذا كانوا مستخدمين في القالب
            $users = User::all();

            return view('sold_lines.user_sold_sim', compact('soldLines', 'users'));
        } else {
            return abort(403, 'Unauthorized action.');
        }
    }


    public function show($id)
    {
        // عرض تفاصيل خط مباع محدد
        $soldLine = Soldline::with('simCard')->findOrFail($id);
        return view('sold_lines.show', compact('soldLine'));
    }
    public function getSoldLineDetails($soldLineId)
    {
        $soldLine = Soldline::find($soldLineId);

        if (!$soldLine) {
            return response()->json(['error' => 'Sold line not found'], 404);
        }

        $serialNumber = $soldLine->simCard->serial_number;
        $username = $soldLine->simCard->user->name;
        $price = $soldLine->simCard->price;
        $id = $soldLine->id;
        $saleDate = $soldLine->created_at;

        // تصحيح مسار الصور
        $firstImage = asset($soldLine->first_image); // استخدم $soldLine->first_image بدلاً من $soldLine->simCard->first_image
        $secondImage = asset($soldLine->second_image); // استخدم $soldLine->second_image بدلاً من $soldLine->simCard->second_image

        return view('sold_lines.details', [
            'serial_number' => $serialNumber,
            'name' => $username,
            'price' => $price,
            'id' => $id,
            'sale_date' => $saleDate,
            'first_image' => $firstImage,
            'second_image' => $secondImage,
        ]);
    }



    public function create($serialNumber)
    {
        $simCard = Simcard::where('serial_number', $serialNumber)->first();

        if (!$simCard) {
            return redirect()->route('sold_lines.index')->with('error', 'السيم كارد غير موجود');
        }

        return view('sold_lines.create', compact('simCard'));
    }

    public function store(Request $request, $serialNumber)
    {
    // البحث عن بيانات بطاقة الـ SIM باستخدام رقم التسلسل
    $simCard = Simcard::where('serial_number', $serialNumber)->firstOrFail();

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

    // التحقق من فشل الفلديشن
    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }
        // التحقق من وجود الصور وأنها غير فارغة
        if ($request->hasFile('first_image') && $request->hasFile('second_image')) {
            $first_image = $request->file('first_image');
            $second_image = $request->file('second_image');

            // تحقق من أن الصور غير فارغة وصالحة
            if ($first_image->isValid() && $second_image->isValid()) {
                // تحديد اسم الملف
                $imageName1 = 'first_' . time() . '.' . $first_image->getClientOriginalExtension();
                $imageName2 = 'second_' . time() . '.' . $second_image->getClientOriginalExtension();


                // تحديد المسار للحفظ
                $imagePath = public_path('images');
                $imagePath = str_replace('public', 'public_html', $imagePath);

                // نقل الصور إلى مجلد "images" في مجلد "public"
                $first_image->move($imagePath, $imageName1);
                $second_image->move($imagePath, $imageName2);

                // تحديث حقل "sold" في جدول SimCard
                $simCard->update(['sold' => true]);

                // إنشاء سجل جديد في جدول SoldLine
                Soldline::create([
                    'first_image' => 'images/' . $imageName1,
                    'second_image' => 'images/' . $imageName2,
                    'simcard_id' => $simCard->id,
                    // يمكنك إضافة حقول إضافية حسب الحاجة
                ]);

                return redirect()->route('sold_lines.index')->with('success', 'تم بيع الخط بنجاح');
            } else {
                return redirect()->back()->withErrors(['يرجى تحميل صورتين صالحتين']);
            }
        }

        return redirect()->back()->with('error', 'يرجى تحميل صورتين');
    }



    public function edit($id)
    {
        // عرض نموذج تعديل خط مباع
        $soldLine = Soldline::findOrFail($id);
        return view('sold_lines.edit', compact('soldLine'));
    }

    public function update(Request $request, $id)
    {
        // تحديث الخط المباع المحدد
        $request->validate([
            'line_number' => 'required|unique:sold_lines,line_number,' . $id,
            'sim_card_id' => 'required|exists:sim_cards,id',
            // أي حقول إضافية يمكن تحديثها حسب الحاجة
        ]);

        $soldLine = Soldline::findOrFail($id);
        $soldLine->update($request->all());

        return redirect()->route('sold_lines.index')
            ->with('success', 'تم تحديث الخط المباع بنجاح');
    }

    public function destroy($id)
    {
        // حذف الخط المباع المحدد
        $soldLine = Soldline::findOrFail($id);
        $soldLine->delete();

        return redirect()->route('sold_lines.index')
            ->with('success', 'تم حذف الخط المباع بنجاح');
    }
}
