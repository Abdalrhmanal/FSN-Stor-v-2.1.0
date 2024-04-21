<?php

namespace App\Http\Controllers;
use App\Notifications\NewTransfer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

use App\Models\Transfer;
use App\Models\User;
use Illuminate\Http\Request;

class TransferController extends Controller
{
    public function index()
    {
        $transfers = Transfer::all();
        return view('transfers.index', compact('transfers'));
    }
    public function indexuser()
{
    $user_id = Auth::id(); // استخراج معرف المستخدم الحالي
    $transfers = Transfer::where('user_id', $user_id)->get();
    return view('transfers.index', compact('transfers'));
}
    public function create()
    {
        return view('transfers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'balance_code' => 'required|string',
            'line_number' => 'required|string',
        ]);

        $user = Auth::user();

        $transfer = Transfer::create([
            'user_id' => $user->id,
            'balance_code' => $request->balance_code,
            'line_number' => $request->line_number,
        ]);

        // إرسال إشعار للمسؤول
        $admin = User::where('role_id', 1)->first();
        if ($admin) {
            $admin->notify(new NewTransfer([
                'balance_code' => $transfer->balance_code,
                'line_number' => $transfer->line_number,
                'user_id' => $user->id,
                'transfer_id' => $transfer->id
            ]));
        }

        return redirect()->route('transfers.indexuser')->with('success', 'تمت إضافة التحويل بنجاح.');
    }

    public function destroy(Transfer $transfer)
    {
        if (Gate::allows('is-admin')) {
            // حذف سجل تفعيل سيم
            $transfer->delete();

            return redirect()->route('activate_sims.index')
                ->with('success', 'تم حذف تحويل رصيد عن بعد بنجاح');
        } else {
            return abort(403, 'Unauthorized action.');
        }
    }

}
