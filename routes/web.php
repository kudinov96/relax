<?php

    use App\Http\Controllers\ChairController;
    use App\Http\Controllers\LogController;
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
});

Route::group(["prefix" => "chair"], function() {
    Route::get("/{chair}", [ChairController::class, "show"])->name("chair.show");
    Route::get("/{chair}/ready/{minutes}/{costs}", [ChairController::class, "ready"])->name("chair.ready");
    Route::get("/{chair}/success/{minutes}", [ChairController::class, "success"])->name("chair.success");
    Route::get("/{chair}/fail/payment", [ChairController::class, "failPayment"])->name("chair.fail.payment");
    Route::get("/{chair}/fail/chair", [ChairController::class, "failChair"])->name("chair.fail.payment");
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
