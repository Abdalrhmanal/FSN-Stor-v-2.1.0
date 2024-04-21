<?php

// AdminController.php

namespace App\Http\Controllers;

use App\Models\Activationsim;
use App\Models\Coderecord;
use App\Models\Internationalsim;
use App\Models\Soldline;
use App\Models\Transfer;
use App\Models\User;
use App\Notifications\ActivationSimAccepted;
use App\Notifications\ActivationSimRejected;
use App\Notifications\InternationalRejected;
use App\Notifications\NewTransfer;
use App\Notifications\TransfeRejected;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class AdminController extends Controller
{

    public function showNotificationDetailsAndSend($notificationId)
    {
        $notification = DatabaseNotification::findOrFail($notificationId);
        $notification->markAsRead();

        return view('adminN.send_notification', compact('notification'));
    }

    public function sendNotificationToUser(Request $request, $userId)
    {
        $request->validate([
            'message' => 'required|string',
        ]);

        $user = User::findOrFail($userId);

        Notification::send($user, new ActivationSimAccepted([
            'message' => $request->input('message')
        ]));

        $unreadNotifications = auth()->user()->unreadNotifications;
        $readNotifications = auth()->user()->readNotifications;

        return view('adminN.notifications', compact('unreadNotifications', 'readNotifications'))
            ->with('success', 'Notification sent successfully!');
    }

    public function rejectNotification($notificationId)
    {
        try {
            $notification = DatabaseNotification::findOrFail($notificationId);

            if (!isset($notification->data['user_id'])) {
                return redirect()->route('admin.getAllNotifications')->with('error', 'لا يوجد user_id في بيانات الإشعار');
            }

            $user = User::find($notification->data['user_id']);

            if (!$user) {
                return redirect()->route('admin.getAllNotifications')->with('error', 'المستخدم غير موجود');
            }

            $notificationType = $notification->type;

            // Handle notification rejection based on its type
            $this->handleNotification($user, $notificationType);

            $notification->markAsRead();

            return redirect()->route('admin.getAllNotifications')->with('success', 'تم رفض الطلب !');
        } catch (ModelNotFoundException $exception) {
            return redirect()->route('admin.getAllNotifications')->with('error', 'الإشعار غير موجود');
        }
    }

    public function handleNotification(User $user, string $notificationType)
    {
        switch ($notificationType) {
            case 'App\Notifications\InternationalsimAdd':
                Internationalsim::where('user_id', $user->id)->delete();
                // خصم سعر الكود من رصيد المستخدم
                $totalCreditBalance = $user->balance->sum('credit_balance');
                $user->balance->credit_balance += 170;
                $user->balance->save();
                Notification::send($user, new InternationalRejected(['message' => 'تم رفض طلبك']));

                break;
            case 'App\Notifications\ActivationSimeAdd':
                Activationsim::where('user_id', $user->id)->delete();
                Notification::send($user, new ActivationSimRejected(['message' => 'تم رفض طلبك']));

                break;
            case 'App\Notifications\NewTransfer':
                Transfer::where('user_id', $user->id)->delete();
                Notification::send($user, new TransfeRejected(['message' => 'تم رفض طلبك']));

                break;
        }

    }
    // public function rejectNotification($notificationId)
    // {
    //     try {
    //         $notification = DatabaseNotification::findOrFail($notificationId);

    //         // Check if user_id is set in the notification data
    //         if (isset($notification->data['user_id'])) {
    //             $user = User::find($notification->data['user_id']);

    //             if ($user) {
    //                 if ($notification->type === 'App\Notifications\Internationalsim') {
    //                     Internationalsim::where('user_id', $user->id)->delete();
    //                     Notification::send($user, new ActivationSimRejected(['message' => 'تم رفض طلبك']));
    //                     $notification->markAsRead();

    //                     return redirect()->route('admin.getAllNotifications')->with('success', 'تم رفض الطلب !');
    //                 } elseif ($notification->type === 'App\Notifications\ActivationSimeAdd') {
    //                     Activationsim::where('user_id', $user->id)->delete();
    //                     Notification::send($user, new ActivationSimRejected(['message' => 'تم رفض طلبك']));
    //                     $notification->markAsRead();
    //                     return redirect()->route('admin.getAllNotifications')->with('success', 'تم رفض الطلب !');

    //                 }elseif ($notification->type === 'App\Notifications\NewTransfer') {
    //                     NewTransfer::where('user_id', $user->id)->delete();
    //                     Notification::send($user, new ActivationSimRejected(['message' => 'تم رفض طلبك']));
    //                     $notification->markAsRead();
    //                     return redirect()->route('admin.getAllNotifications')->with('success', 'تم رفض الطلب !');
    //                 }
    //             } else {
    //                 return redirect()->route('admin.getAllNotifications')->with('error', 'المستخدم غير موجود');
    //             }
    //         } else {
    //             return redirect()->route('admin.getAllNotifications')->with('error', 'لا يوجد user_id في بيانات الإشعار');
    //         }
    //     } catch (ModelNotFoundException $exception) {
    //         return redirect()->route('admin.getAllNotifications')->with('error', 'الإشعار غير موجود');
    //     }
    // }

    public function getAllNotifications()
    {
        // Check if the user is authenticated
        if (auth()->check()) {
            // User is authenticated
            $unreadNotifications = auth()->user()->unreadNotifications;
            $readNotifications = auth()->user()->readNotifications;
        } else {
            // User is not authenticated, handle accordingly
            $unreadNotifications = collect();
            $readNotifications = collect();
        }

        return view('adminN.notifications', compact('unreadNotifications', 'readNotifications'));
    }


    public function getUserNotifications()
    {
        if (auth()->check()) {
            // User is authenticated
            $user = auth()->user(); // استخدم الدالة auth() مباشرة للحصول على المستخدم المسجل الحالي
            $unreadNotifications = $user->unreadNotifications;
            $readNotifications = $user->readNotifications;
        } else {
            // User is not authenticated, handle accordingly
            $unreadNotifications = collect();
            $readNotifications = collect();
        }

        return view('user.notifications', compact('unreadNotifications', 'readNotifications'));
    }

    public function getNotifications()
    {
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

        return view('dashboard', compact('unreadNotifications', 'readNotifications'));
    }
    // في كونترولر NotificationsController أو حسب اسم الكونترولر الخاص بك
    public function markAsRead($notificationId)
    {
        $notification = auth()->user()->unreadNotifications()->find($notificationId);

        if ($notification) {
            $notification->markAsRead();
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false]);
    }
}
