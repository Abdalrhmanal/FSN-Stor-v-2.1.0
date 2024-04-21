
<?php

use Illuminate\Support\Facades\Auth;

class Contre
{
    public function getUnreadNotificationsCount()
    {
        $user = Auth::user();
        $unreadNotificationsCount = $user->unreadNotifications->count();
        return $unreadNotificationsCount;
    }
}
