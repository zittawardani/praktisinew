<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VerifyEmailController;
use App\Http\Controllers\MemberController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [HomeController::class, 'index']);

// Route::get('user/register', [UserController::class, 'register']);
// Route::get('user/login', [UserController::class, 'login']);
// Route::get('user/registration-success', [UserController::class, 'regi']);


Route::group(['prefix' => 'user/'], function () {
    Route::get("register", [UserController::class, "register"]);
    Route::post("process-register", [UserController::class, "processRegister"]);
    Route::get("register-success/{id}", [UserController::class, "registerSuccess"]);

    // next week
    Route::get("login", [UserController::class, "login"])->name("login");
    Route::post("process-login", [UserController::class, "processLogin"]);

    // log out
    Route::get("process-logout", [UserController::class, "processLogout"]);
});

// Proses Verifikasi email
Route::get('/email/verify/{id}/{hash}', [VerifyEmailController::class, 'verify'])
    ->middleware(['throttle:6,1']) // 6 eksekusi per IP setiap 1 menit
    ->name('verification.verify');

// Resend New Verification Email
Route::get('/email/verification/{id}', function ($id) {
    $user = User::where("id", $id)->first();

    $user->sendEmailVerificationNotification();

    return redirect("user/register-success/$id")->withSuccess("Link berhasil di kirim kan kembali!");
})->middleware(['throttle:6,1'])->name('verification.send');

// route member
Route::get('/member', [MemberController::class, 'card'])->middleware(['auth', 'check-access:0']);
Route::get('/member/list', [MemberController::class, 'list'])->middleware(['auth', 'check-access:1']);