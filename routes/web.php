<?php

    use App\Http\Controllers\ChairController;
    use App\Http\Controllers\LogController;
use App\Http\Controllers\LogStatusController;
use App\Http\Controllers\OrderController;
    use App\Http\Controllers\PaymentController;
    use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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


Route::group(["middleware" => ['auth', 'verified']], function() {
    Route::get('logs', [LogController::class, "index"])->name("log.index");
    Route::get('logs/{item}', [LogController::class, "show"])->name("log.show");

    Route::get('logs-status', [LogStatusController::class, "index"])->name("log-status.index");
    Route::get('logs-status/{item}', [LogStatusController::class, "show"])->name("log-status.show");

    Route::get('orders', [OrderController::class, "index"])->name("order.index");
    Route::get('orders/{item}', [OrderController::class, "show"])->name("order.show");
});

Route::group(["prefix" => "chair"], function() {
    Route::get("/{deviceId}", [ChairController::class, "show"])->name("chair.show");
    Route::get("/{deviceId}/ready/{minutes}/{costs}", [ChairController::class, "ready"])->name("chair.ready");
    Route::get("/{deviceId}/success/{minutes}", [ChairController::class, "success"])->name("chair.success");
    Route::get("/{deviceId}/ready/{minutes}/{costs}/redirect", [PaymentController::class, "paymentRedirect"])->name("payment.redirect");
    Route::get("/{deviceId}/fail/payment", [ChairController::class, "failPayment"])->name("chair.fail.payment");
    Route::get("/{order}/fail/chair", [ChairController::class, "failChair"])->name("chair.fail.chair");

    Route::get("/{order}/payment/accept", [PaymentController::class, "paymentAccept"])->name("payment.accept");

    Route::post("/{order}/payment/callback", [PaymentController::class, "callbackPayment"])->name("payment.callback");
    Route::get("/{order}/payment/callback", [PaymentController::class, "callbackPayment"]);
});

/*Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');*/

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    //Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
