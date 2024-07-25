<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminLogin;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminSection;
use App\Models\Admin;
use App\Http\Controllers\AdminServiceController;
use App\Http\Middleware\AdminMiddleware;

Route::get('/', function () {
    return view('welcome');
});
Route::get('admin/login',[AdminLogin::class,'login'])->name('admin.login');
Route::post('admin/login',[AdminLogin::class,'checkLogin'])->name('admin.check');
Route::middleware(AdminMiddleware::class)->group(function () {
Route::get('admin/dashboard',[AdminController::class,'index'])->name('admin.dashboard');
Route::resource('admin/dashboard/section',AdminSection::class);
Route::get('admin/dashboard/setting',[AdminController::class,'ViewAccount'])->name('admin.setting');
Route::put('admin/dashboard/setting',[AdminController::class,'EditAccount'])->name('admin.edit.account');
Route::get('admin/dashboard/service',[AdminServiceController::class,'index'])->name('admin.view.service');
Route::get('admin/dashboard/service/create',[AdminServiceController::class,'create'])->name('admin.service.create');
Route::post('admin/dashboard/service/create',[AdminServiceController::class,'store'])->name('admin.service.store');
Route::get('admin/dashboard/service/{id}/update',[AdminServiceController::class,'edit'])->name('admin.service.edit');
Route::put('admin/dashboard/service/{id}/update',[AdminServiceController::class,'update'])->name('admin.service.update');
Route::delete('admin/dashboard/service/{id}/delete',[AdminServiceController::class,'delete'])->name('admin.service.delete');
Route::get('admin/dashboard/section/Archive',[AdminSection::class,'show'])->name('admin.show.archive');
Route::get('admin/dashboard/service/Archive',[AdminServiceController::class,'show'])->name('admin.service.show.archive');
Route::get('admin/dashboard/section/Archive/Restore/{id}',[AdminSection::class,'Restore'])->name('admin.section.Archive.Restore');
Route::get('admin/dashboard/service/Archive/Restore/{id}',[AdminServiceController::class,'Restore'])->name('admin.service.Archive.Restore');
Route::get('admin/dashboard/section/Archive/Delete/{id}',[AdminSection::class,'ForceDelete'])->name('admin.section.Archive.ForceDelete');
Route::get('admin/dashboard/service/Archive/Delete/{id}',[AdminServiceController::class,'ForceDelete'])->name('admin.service.Archive.ForceDelete');
Route::get('adminlogout',[AdminLogin::class,'logout'])->name('adminlogout');
});
