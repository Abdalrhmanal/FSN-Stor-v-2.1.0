<?php

namespace App\Providers;

use App\Models\Balance;
use App\Models\Category;
use App\Models\Code;
use App\Models\Coderecord;
use App\Models\Notifications;
use App\Models\Simcard;
use App\Providers\Soldline;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->definePolicies();

        Gate::define('is-admin', function ($user) {
            return optional($user->role)->name === 'Admin';
        });

        view()->composer('*', function ($view) {
            $data = [];
            // جلب عدد التفعيلات الكلي وتخزينه في المتغير العام
            $user = Auth::user();
            if ($user) {
                $data['totalActivations'] = $user->activationSims()->count();
                $data['totalInternational'] = $user->internationalSims()->count();
                //$data['totalline'] = $user->simCards()->count();
                $data['totalLines'] = $user->simCards()->whereDoesntHave('soldLines')->count();

                $data['totalNotifications'] = $user->unreadNotifications()->count();
                $data['totalcodes'] = $user->codeRecords()->count();
                $data['totalUsers'] = User::count();
                $data['totalCoderecord'] = Coderecord::count();
                $data['totalCodes'] = Code::count();
                $data['totalCategory'] = Category::count();
                $data['AllNotifications'] = Notifications::count();
                if ($user->role_id == 2) {
                    $data['creditBalanceUser'] = Balance::where('user_id', $user->id)->pluck('credit_balance')->sum();
                }
            }
            $view->with($data);
        });
    }

    protected function definePolicies()
    {
        // تعريف الصلاحيات هنا إذا لزم الأمر
    }
}
