<?php

use App\Http\Controllers\Admin\ComplaintController as AdminComplaintController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\User\ComplaintController;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\Admin\ComplaintController;

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
Route::get('/complaint/search/show', [ComplaintController::class, 'search'])->name('complaint.search');

Route::middleware(['auth', 'isadmin'])->group(function () {
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

    Route::get('/admns/complaint/inbox', [AdminComplaintController::class, 'indexInbox'])->name('admin.complaint.inbox');

    Route::get('/admns/complaint/inbox/show/{id}', [AdminComplaintController::class, 'show_superadmin'])->name('admin.complaint.inbox.show');


    // Route::get('/complaint/edit/{id}', [AdminComplaintController::class, 'edit_complaint'])->name('admin.complaint.edit');

    // Route::get('/complaint/{id}/edit', 'ComplaintController@edit_complaint')->name('admin.complaint.edit');
    // Route::post('/complaint/{id}/update', 'ComplaintController@update_complaint')->name('admin.complaint.update');


    Route::get('/complaint/{id}/edit', [AdminComplaintController::class, 'edit_complaint'])->name('admin.complaint.edit');

    Route::put('/admin/complaint/update/{id}', [AdminComplaintController::class, 'update_complaint'])->name('admin.complaint.update');



    Route::get('/complaint/delete/{id}', [AdminComplaintController::class, 'delete_complaint'])->name('admin.complaint.delete');







    // Route::post('/admns/complaint/petugas/store', [AdminComplaintController::class, 'storePetugas'])->name('admin.complaint.petugas.store');

    Route::get('/admns/complaint/report', [ReportController::class, 'index'])->name('admin.complaint.report');
    Route::post('/admns/complaint/report/ex', [ReportController::class, 'report'])->name('admin.complaint.report.ex');

    // Route::post('/admns/complaint/export', [AdminComplaintController::class, 'reportAnnualy'])->name('admin.complaint.export');
    // Route::get('/admns/complaint/print/{id}', [AdminComplaintController::class, 'print'])->name('admin.complaint.print');
    // Route::get('/admns/complaint/download/ev/{id}', [AdminComplaintController::class, 'evidenceDownload'])->name('admin.complaint.ev.download');
    // Route::get('/admns/complaint/download/ne/{id}', [AdminComplaintController::class, 'newsDownload'])->name('admin.complaint.ne.download');
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
