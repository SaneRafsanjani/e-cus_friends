<?php

use App\Http\Controllers\Admin\ComplaintController as AdminComplaintController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\User\ComplaintController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [ComplaintController::class, 'create'])->name('complaint.create');
Route::post('/complaint/store', [ComplaintController::class, 'store'])->name('complaint.store');
Route::get('/complaint/search', [ComplaintController::class, 'show'])->name('complaint.show');

Route::middleware(['auth', 'isadmin'])->group(function () {
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

    Route::get('/admns/complaint/inbox', [AdminComplaintController::class, 'indexInbox'])->name('admin.complaint.inbox');



    Route::get('/admns/complaint/inbox/show/{id}', [AdminComplaintController::class, 'show_superadmin'])->name('admin.complaint.inbox.show');

    // Route::post('/admns/complaint/petugas/store', [AdminComplaintController::class ])->name('admin.complaint.petugas.store');

    Route::get('/admns/complaint/follow-up', [AdminComplaintController::class])->name('admin.complaint.followup');
    // Route::get('/admns/complaint/follow-up/show/{id}', [AdminComplaintController::class, 'show'])->name('admin.complaint.followup.show');

    // Route::get('/admns/complaint/news/{id}', [AdminComplaintController::class, 'createNews'])->name('admin.complaint.news');
    // Route::post('/admns/complaint/store/news', [AdminComplaintController::class, 'storeNews'])->name('admin.complaint.news.store');

    Route::post('/admin/complaint/update', [AdminComplaintController::class ])->name('admin.complaint.update');

    Route::get('/admns/complaint/report', [ReportController::class, 'index'])->name('admin.complaint.report');
    Route::post('/admns/complaint/report/ex', [ReportController::class, 'report'])->name('admin.complaint.report.ex');

    Route::post('/admns/complaint/start_proceed', [AdminComplaintController::class ])->name('admin.complaint.start');
    Route::post('/admns/complaint/end_proceed', [AdminComplaintController::class ])->name('admin.complaint.end');
});

Route::get('/get-regency', [Controller::class, 'getRegency'])->name('get.regency');
Route::get('/get-district', [Controller::class, 'getDistrict'])->name('get.district');
Route::get('/get-village', [Controller::class, 'getVillage'])->name('get.village');

Route::middleware(['guest'])->group(function () {
    Route::get('/login-admns', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login-admns', [AuthenticatedSessionController::class, 'store']);
});

Route::get('/storage-link', function () {
    Artisan::call('storage:link');
});
