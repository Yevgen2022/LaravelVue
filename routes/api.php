<?php

use Illuminate\Support\Facades\Route;

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
