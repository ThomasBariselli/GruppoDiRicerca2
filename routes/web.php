<?php

use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\ResetSessionController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CourseGuestController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\IndexController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\MemberGuestController;
use App\Http\Controllers\PubbGuestController;
use App\Http\Controllers\PubbController;
use App\Http\Controllers\ProjectGuestController;
use App\Http\Controllers\ProjectController;
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


Route::middleware(['auth','can:edit-member'])->name('chisiamo.')->prefix('chisiamo')->group(function() {
    Route::resource('/',MemberController::class);
    Route::post('/create',[MemberController::class,'create'])->name('create');
    Route::post('/create/store',[MemberController::class,'store'])->name('store');
    Route::get('/{member}/edit',[MemberController::class,'edit'])->name('edit');
    Route::put('/{member}',[MemberController::class,'update'])->name('update');
    Route::delete('/{member}',[MemberController::class,'destroy'])->name('destroy');
    Route::post('/{member}/edit', [MemberController::class, 'assignCourse'])->name('corsi.assign');
    Route::delete('/{member}/edit/{course}', [MemberController::class, 'revokeCourse'])->name('corsi.revoke');
});

Route::get('/chisiamo',[MemberGuestController::class,'index'])->name('chisiamo.index');
Route::resource('/chisiamo',MemberGuestController::class);

Route::middleware(['auth','can:edit-course'])->name('corsi.')->prefix('corsi')->group(function() {
    Route::resource('/',CourseController::class);
    Route::post('/create',[CourseController::class,'create'])->name('create');
    Route::post('/create/store',[CourseController::class,'store'])->name('store');
    Route::get('/{course}/edit',[CourseController::class,'edit'])->name('edit');
    Route::put('/{course}',[CourseController::class,'update'])->name('update');
    Route::delete('/{course}',[CourseController::class,'destroy'])->name('destroy');
    Route::post('/{course}/edit', [CourseController::class, 'assignMember'])->name('chisiamo.assign');
    Route::delete('/{course}/edit/{member}', [CourseController::class, 'revokeMember'])->name('chisiamo.revoke');
    
});

Route::get('/corsi',[CourseGuestController::class,'index'])->name('corsi.index');
Route::resource('/corsi',CourseGuestController::class);

Route::get('/account', function () {
    return view('account');
});
Route::put('/account/{user}', [AccountController::class , 'update'])->name('account');
Route::put('/cambiopwd/{user}', [AccountController::class , 'updatePwd'])->name('cambiopwd');


Route::middleware(['auth','can:edit-publication'])->name('pubblicazioni.')->prefix('pubblicazioni')->group(function() {
    Route::resource('/',PubbController::class);
    Route::post('/create',[PubbController::class,'create'])->name('create');
    Route::post('/create/store',[PubbController::class,'store'])->name('store');
    Route::get('/{publication}/edit',[PubbController::class,'edit'])->name('edit');
    Route::put('/{publication}',[PubbController::class,'update'])->name('update');
    Route::delete('/{publication}',[PubbController::class,'destroy'])->name('destroy');
    Route::post('/{publication}/edit', [PubbController::class, 'assignMember'])->name('members.assign');
    Route::delete('/{publication}/edit/{member}', [PubbController::class, 'revokeMember'])->name('members.revoke');
    
});

Route::get('/pubblicazioni',[PubbGuestController::class,'index'])->name('pubblicazioni.index');
Route::resource('/pubblicazioni',PubbGuestController::class);

Route::middleware(['auth','can:edit-project'])->name('progetti.')->prefix('progetti')->group(function() {
    Route::resource('/',ProjectController::class);
    Route::post('/create',[ProjectController::class,'create'])->name('create');
    Route::post('/create/store',[ProjectController::class,'store'])->name('store');
    Route::get('/{project}/edit',[ProjectController::class,'edit'])->name('edit');
    Route::put('/{project}',[ProjectController::class,'update'])->name('update');
    Route::delete('/{project}',[ProjectController::class,'destroy'])->name('destroy');
    Route::post('/{project}/edit', [ProjectController::class, 'assignMember'])->name('members.assign');
    Route::delete('/{project}/edit/{member}', [ProjectController::class, 'revokeMember'])->name('members.revoke');
    
});

Route::get('/progetti',[ProjectGuestController::class,'index'])->name('progetti.index');
Route::resource('/progetti',ProjectGuestController::class);






