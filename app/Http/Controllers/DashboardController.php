<?php

namespace App\Http\Controllers;

use App\Models\Balance;
use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboardData()
    {
        $unreadNotifications = $this->getNotifications();
        $balanceData = $this->showBalanceHistoryd();
        $offers = $this->indexdash();

        return view('dashboard', compact('unreadNotifications', 'balanceData', 'offers'));
    }

    public function getNotifications()
    {
        // احتفظ بالبيانات ولا تقم بإعادة العرض
        $unreadNotifications = collect();
        $readNotifications = collect();

        if (auth()->check()) {
            $user = auth()->user();

            if ($user->role_id == 1) {
                // Role 1 logic
                $unreadNotifications = $user->unreadNotifications;
                $readNotifications = $user->readNotifications;
            } elseif ($user->role_id == 2) {
                // Role 2 logic
                $unreadNotifications = $user->unreadNotifications;
                $readNotifications = $user->readNotifications;
            }
        }

        // ارجع البيانات
        return compact('unreadNotifications', 'readNotifications');
    }

    public function showBalanceHistoryd()
    {
    $user = Auth::user();

    // احصل على جميع عمليات الرصيد المرتبطة بالمستخدم مع البيانات التاريخية
    $transactions = Balance::where('user_id', $user->id)
        ->orderBy('created_at', 'desc')
        ->get();

    // مصفوفة لتخزين البيانات
    $dataDebit = [];
    $dataCredit = [];
    $categories = [];

    // ملء المصفوفات
    foreach ($transactions as $transaction) {
        $categories[] = $transaction->created_at->format('Y-m-d H:i:s');
        $dataDebit[] = $transaction->debit_balance;
        $dataCredit[] = $transaction->credit_balance;
    }

    // احسب الرصيد الإجمالي في عمود debit_balance
    $debitBalance = array_sum($dataDebit);

    // احسب الرصيد الإجمالي في عمود credit_balance
    $creditBalance = $transactions->isEmpty() ? 0 : array_sum($dataCredit);

    // جمع الرصيد الإجمالي (متغير جديد)
    $totalBalance = $creditBalance - $debitBalance;

    return view('balances.show', [
        'transactions' => $transactions,
        'debitBalance' => $debitBalance,
        'creditBalance' => $creditBalance,
        'totalBalance' => $totalBalance,
        'dataDebit' => json_encode($dataDebit),
        'dataCredit' => json_encode($dataCredit),
        'categories' => json_encode($categories),
    ]);
}


    public function indexdash()
    {
        $offers = Offer::all();
        return view('dashboard', compact('offers'));
    }
}
