<?php

use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\ResetSessionController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\IndexController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\MemberController;
use App\Models\Member;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\LanguageMiddleware;


Route::get('/', function () {
    return view('home');
});


Route::get('/progetti', function () {
    return view('progetti');
});

Route::get('/pubblicazioni', function () {
    return view('pubblicazioni');
});

Route::get('/resetpassword', function () {
    return view('mail.reset-password');
});

Route::middleware(['auth','role:admin'])->name('admin.')->prefix('admin')->group(function() {
    Route::get('/',[IndexController::class,'index'])->name('index');
    Route::resource('/roles',RoleController::class);
    Route::post('/roles/{role}/permissions', [RoleController::class, 'givePermission'])->name('roles.permissions');
    Route::delete('/roles/{role}/permissions/{permission}', [RoleController::class, 'revokePermission'])->name('roles.permissions.revoke');
    Route::resource('/permissions',PermissionController::class);
    Route::post('/permissions/{permission}/roles', [PermissionController::class, 'assignRole'])->name('permissions.roles');
    Route::delete('/permissions/{permission}/roles/{role}', [PermissionController::class, 'removeRole'])->name('permissions.roles.remove');
    Route::get('/users',[UserController::class,'index'])->name('users.index');
    Route::get('/users/{user}',[UserController::class,'show'])->name('users.show');
    Route::delete('/users/{user}',[UserController::class,'destroy'])->name('users.destroy');
    Route::post('/users/{user}/roles',[UserController::class,'assignRole'])->name('users.roles');
    Route::delete('/users/{user}/roles/{role}',[UserController::class,'removeRole'])->name('users.roles.remove');
    Route::post('/users/{user}/permissions',[UserController::class,'givePermission'])->name('users.permissions');
    Route::delete('/users/{user}/permissions/{permission}',[UserController::class,'revokePermission'])->name('users.permissions.revoke');
});


Route::post('/send', [ResetSessionController::class , 'store']);

Route::get('/register', [RegisteredUserController::class , 'create']);
Route::post('/register', [RegisteredUserController::class , 'store']);

Route::get('/login', [SessionController::class , 'create'])->name('login');
Route::post('/login', [SessionController::class , 'store']);

Route::post('/logout', [SessionController::class , 'destroy']);

Route::post('/language-switch', [LanguageController::class, 'languageSwitch'])->name('language.switch');
Route::get('/admin-layout', function () {
    return view('admin.layout');
})->name('admin.layout');



Route::get('/chisiamo',[MemberController::class,'index'])->name('chisiamo.index');
Route::middleware(['auth','role:teacher'])->name('chisiamo.')->prefix('chisiamo')->group(function() {
    Route::resource('/',MemberController::class);
    Route::get('/{member}/edit',[MemberController::class,'edit'])->name('edit');
    Route::put('/{member}/edit',[MemberController::class,'update'])->name('update');
    Route::delete('/{member}',[MemberController::class,'destroy'])->name('destroy');
    Route::post('/{member}/edit', [MemberController::class, 'assignCourse'])->name('corsi.assign');
    Route::delete('/{member}/edit/{course}', [MemberController::class, 'revokeCourse'])->name('corsi.revoke');
});


Route::get('/corsi',[CourseController::class,'index'])->name('corsi.index');
Route::middleware(['auth','role:teacher'])->name('corsi.')->prefix('corsi')->group(function() {
    Route::resource('/',CourseController::class);
    Route::get('/{course}/edit',[CourseController::class,'edit'])->name('edit');
    Route::put('/{course}/edit',[CourseController::class,'update'])->name('update');
    Route::delete('/{course}',[CourseController::class,'destroy'])->name('destroy');
    
});








