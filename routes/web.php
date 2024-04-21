<?php

use App\Http\Controllers\ActivationsimController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BalanceController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CodeManagementController;
use App\Http\Controllers\CodesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\InternationasimController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\SimCardController;
use App\Http\Controllers\SoldLineController;
use App\Http\Controllers\TransferController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\PasswordController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/profiles', function () {
    return view('profile.profile');
});
Route::get('/', function () {
    return view('welcome');
});
Route::get('/', [OfferController::class, 'indexdash']);

Route::get('/Contact', function () {
    return view('Contact');
});
Route::get('/payment', function () {
    return view('payment');
});
Route::get('/dashboard', function () {
    return view('dashboard', [
        'balanceHistory' => (new BalanceController())->showBalanceHistoryd(),

    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
// راوت لتحديث كلمة مرور المستخدم


Route::middleware('auth')->group(function () {
    Route::put('/users/{userId}/update-password', [PasswordController::class, 'updatePasswordAdmin'])->name('users.updatePassword');
    // عرض الصفحة التي تحتوي على نموذج تحديث كلمة المرور
    Route::get('/users/{userId}/edit-password', [PasswordController::class, 'showEditPasswordFormAdmin'])->name('users.showEditPasswordFormAdmin')->middleware('can:is-admin');
    Route::get('/users', [UsersController::class, 'showAllUsers'])->name('users.index');
    Route::get('/dashboard', [UsersController::class, 'showAllUsersd'])->name('users.index');
    Route::post('/users/{userId}/deactivate', [UsersController::class, 'toggleStatus'])->name('users.toggleStatus');

    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/{id}', [CategoryController::class, 'show'])->name('categories.show');
    Route::get('/categorie/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/categories/{id}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/categories/{id}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');

    Route::post('/categories/{category}/archive', [CategoryController::class, 'archive'])->name('categories.archive');
    Route::post('/categories/{category}/archivecate', [CategoryController::class, 'archivecate'])->name('categories.archivecate');
    Route::get('/archivedCategories', [CategoryController::class, 'archivedCategories'])->name('categories.archivedCategories');
    Route::get('/codes/category/{categoryId}', [CodesController::class, 'showCodesByCategory'])->name('codes.details');

    Route::get('/codes', [CodesController::class, 'index'])->name('codes.index');
    Route::get('/codes/{id}', [CodesController::class, 'show'])->name('codes.show');

    Route::get('/codes1/create', [CodesController::class, 'create'])->name('codes.create');
    Route::post('/codes', [CodesController::class, 'store'])->name('codes.store');


    Route::delete('/codes/{id}', [CodesController::class, 'destroy'])->name('codes.destroy');
    //Route::post('/add-to-code-record/{codeId}', [CodesController::class, 'addToCodeRecord'])->name('addtocoderecord.create');
    Route::get('/add-to-code-record/{codeId}', [CodesController::class, 'addToCodeRecord'])->name('addtocoderecord.create');
    // عرض كل الأكواد مع معلومات المستخدم الذي باع الكود
    Route::get('/user_sold_codes', [CodeManagementController::class, 'index'])->name('code_management.user_sold_codes')->middleware('can:is-admin');

    Route::get('/code_management', [CodeManagementController::class, 'userSoldCodes'])->name('code_management.index');
    Route::get('/code_management/{id}', [CodeManagementController::class, 'show'])->name('code_management.show');
    Route::get('/code_management/create', [CodeManagementController::class, 'create'])->name('code_management.create');
    Route::post('/code_management', [CodeManagementController::class, 'store'])->name('code_management.store');
    Route::get('/code_management/{id}/edit', [CodeManagementController::class, 'edit'])->name('code_management.edit');
    Route::put('/code_management/{id}', [CodeManagementController::class, 'update'])->name('code_management.update');
    Route::delete('/code_management/{id}', [CodeManagementController::class, 'destroy'])->name('code_management.destroy');
    // عرض تفاصيل سجل محدد
    Route::get('/code_management/{id}/details', [CodeManagementController::class, 'showDetails'])
        ->name('code_management.show_details');



    // عرض كل السيم كارد مع معلومات المستخدم الذي باع السيم كارد
    Route::get('/sim_cards', [SimCardController::class, 'index'])->name('sim_cards.index');

    // عرض تفاصيل سيم كارد محدد
    Route::get('/sim_cards/{id}', [SimCardController::class, 'show'])->name('sim_cards.show');
    // عرض نموذج إضافة سيم كارد
    Route::get('/sim_card1/create', [SimCardController::class, 'create'])->name('sim_card1.create');

    // حفظ السيم كارد المضاف
    Route::post('/sim_cards1', [SimCardController::class, 'store'])->name('sim_cards1.store');
    // عرض نموذج تعديل سيم كارد
    Route::get('/sim_cards/{id}/edit', [SimCardController::class, 'edit'])->name('sim_cards.edit');
    // تحديث السيم كارد المحدد
    Route::put('/sim_cards/{id}', [SimCardController::class, 'update'])->name('sim_cards.update');
    // حذف السيم كارد المحدد
    Route::delete('/sim_cards/{id}', [SimCardController::class, 'destroy'])->name('sim_cards.destroy');
    // عرض تفاصيل سيم كارد مباعة محددة
    Route::get('/sim_cards/{id}/details', [SimCardController::class, 'showDetails'])
        ->name('sim_cards.show_details');

    // في ملف التوجيه (web.php أو routes.php)

    // عرض كل الخطوط المباعة مع معلومات السيم كارد المتعلق بها
    Route::get('/sold_lines', [SoldLineController::class, 'index'])->name('sold_lines.index');
    Route::get('/solde_su', [SoldLineController::class, 'getAllSoldLinesWithUserName'])->name('sold_line.indexLU');

    // عرض تفاصيل خط مباع محدد
    Route::get('/sold_lines/{id}', [SoldLineController::class, 'getSoldLineDetails'])->name('sold_lines.details');
    // عرض نموذج إضافة خط مباع

    Route::get('/sold_lines/create/{serial_number}', [SoldLineController::class, 'create'])->name('sold_lines.create');
    Route::post('/sold_lines/{serial_number}', [SoldLineController::class, 'store'])->name('sold_lines.store');

    // عرض نموذج تعديل خط مباع
    Route::get('/sold_lines/{id}/edit', [SoldLineController::class, 'edit'])->name('sold_lines.edit');
    // تحديث الخط المباع المحدد
    Route::put('/sold_lines/{id}', [SoldLineController::class, 'update'])->name('sold_lines.update');
    // حذف الخط المباع المحدد
    Route::delete('/sold_lines/{id}', [SoldLineController::class, 'destroy'])->name('sold_lines.destroy');
    Route::get('/sold_line/details/{soldLineId}', [SoldLineController::class, 'getSoldLineDetails']);




    // Example in web.php or routes file
    Route::get('/balances', [BalanceController::class, 'index'])->name('balances.index');
    // عرض جميع الأرصدة

    // Route لعرض النموذج الذي يحتوي على اختيار المستخدم ونوع الرصيد والمبلغ
    Route::get('/balances/create', [BalanceController::class, 'create'])->name('balances.create');
    // Route لحفظ الرصيد بناءً على اختيارات المستخدم
    Route::post('/balances/store', [BalanceController::class, 'store'])->name('balances.store');

    Route::get('/balances/show/{userId}', [BalanceController::class, 'showBalanceHistory'])->name('balances.show');

    // عرض تفاصيل رصيد محدد
    Route::get('/dashboard', [BalanceController::class, 'showBalanceHistoryd'])->name('dashboard');
    // عرض نموذج تعديل رصيد
    // راوت لعرض نموذج التعديل
    Route::get('/balances/edit/{userId}', [BalanceController::class, 'edit'])->name('balances.edit');
    Route::put('/balances/update/{balance}', [BalanceController::class, 'update'])->name('balances.update');
    // حذف الرصيد
    Route::delete('/balances/{id}', [BalanceController::class, 'destroy'])->name('balances.destroy');

    // عرض جميع تفاصيل "تفعيل سيم"
    Route::get('/activation_sim', [ActivationsimController::class, 'index'])->name('activate_sims.index');
    // عرض نموذج إضافة "تفعيل سيم"
    Route::get('/activation_sim/create', [ActivationsimController::class, 'create'])->name('activate_sim.create');
    // حفظ بيانات "تفعيل سيم" الجديدة
    Route::post('/activation_sim', [ActivationsimController::class, 'store'])->name('activate_sim.store');
    // حذف "تفعيل سيم"
    Route::delete('/activation_sim/{activationSims}', [ActivationsimController::class, 'destroy'])->name('activate_sim.destroy');



    Route::get('/international_sims', [InternationasimController::class, 'index'])->name('activations.index');
    Route::get('/international_sims/create', [InternationasimController::class, 'create'])->name('activations.create');
    Route::post('/international_sims', [InternationasimController::class, 'store'])->name('activations.store');
    Route::delete('/international_sims/{internationalSim}', [InternationasimController::class, 'destroy'])->name('activations.destroy');
    Route::get('/international_sims/{id}', [InternationasimController::class, 'show'])->name('activations.show');


    Route::get('/offers', [OfferController::class, 'index'])->name('offers.index');

    Route::get('/offers/create', [OfferController::class, 'create'])->name('offers.create');
    Route::post('/offers', [OfferController::class, 'store'])->name('offers.store');
    Route::get('/offers/{id}', [OfferController::class, 'show'])->name('offers.show');
    Route::get('/offers/{id}/edit', [OfferController::class, 'edit'])->name('offers.edit');
    Route::put('/offers/{id}', [OfferController::class, 'update'])->name('offers.update');
    Route::delete('/offers/{id}', [OfferController::class, 'destroy'])->name('offers.destroy');


    Route::get('/admin/notifications/{notificationId}/send-new-notification', [AdminController::class, 'showNotificationDetailsAndSend'])->name('admin.showNotificationDetailsAndSend');
    Route::post('/admin/send-notification/{userId}', [AdminController::class, 'sendNotificationToUser'])->name('admin.sendNotificationToUser');
    Route::get('/admin/all-notifications', [AdminController::class, 'getAllNotifications'])->name('admin.getAllNotifications');
    Route::post('/admin/reject-notification/{notificationId}', [AdminController::class, 'rejectNotification'])
        ->name('admin.rejectNotification');
    Route::get('/user/notifications', [AdminController::class, 'getUserNotifications'])->name('user.notifications');
    Route::get('/dashboard', [AdminController::class, 'getNotifications'])->name('layouts.navigation');
    Route::post('/mark-as-read/{notificationId}', [AdminController::class, 'markAsRead'])->name('admin.markAsRead');

    Route::get('/transfers', [TransferController::class, 'index'])->name('transfers.index');
    Route::get('/transfersuser', [TransferController::class, 'indexuser'])->name('transfers.indexuser');
    Route::get('/transfers/create', [TransferController::class, 'create'])->name('transfers.create');
    Route::post('/transfers', [TransferController::class, 'store'])->name('transfers.store');
    Route::delete('/transfers/{id}', [TransferController::class, 'destroy'])->name('transfers.destroy');
});




/**************************************************
 ***       ما تبقى من مهام هي كالتالي    ********
 **************************************************
 **************************************************
 ***             * 20/1/2024 *                  ***
 **************************************************
 ***                THE END                 *******
 **************************************************/
