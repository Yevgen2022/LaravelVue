<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Person\StoreController;
use App\Http\Controllers\Person\IndexController;

/*
 * API маршрути
 *
 * Всі маршрути, які знаходяться в цьому файлі, будуть оброблятися
 * через API middleware, що вмикає перевірку токенів або CORS, якщо вони налаштовані.
 */

Route::get('/example', function () {
    return response()->json([
        'message' => 'Hello from the API!',
    ]);
});

Route::prefix('people')->group(function () {
    Route::post('/', StoreController::class);
    Route::get('/', IndexController::class);
});

