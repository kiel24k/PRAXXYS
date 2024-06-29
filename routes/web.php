<?php

use App\Http\Controllers\ApiController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Auth/Login', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified',])
    ->group(function () {
        Route::get('/dashboard', function () {
            return Inertia::render('List');
        });

        Route::get('/create_product_view', function () {
            return Inertia::render('CreateProduct');
        });

        //Laravel HTTP Routing API
        Route::get('/all_product_list', [ApiController::class, 'allProductList'])
            ->middleware('auth:sanctum');

        Route::get('/productCategory/{category}', [ApiController::class, 'productCategory'])
            ->middleware('auth:sanctum');

        Route::get('/product_search/{search}', [ApiController::class, 'productSearch'])
            ->middleware('auth:sanctum');

        Route::get('/remove_product/{id}', [ApiController::class, 'removeProduct'])
            ->middleware('auth:sanctum');

        Route::post('/create_product', [ApiController::class, 'createProduct'])
            ->middleware('auth:sanctum');

        Route::get('/update_product_view/{id}', [ApiController::class, 'updateProductView'])
            ->middleware('auth:sanctum');

        Route::post('/update_product/{id}', [ApiController::class, 'updateProduct'])
        ->middleware('auth:sanctum');;

        //Bonus objective: Create a Video Player Vue component
        Route::get('/video/{video}', [ApiController::class, 'test'])
        ->middleware('auth:sanctum');;
    });
