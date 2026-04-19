<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ContactController;

// --- Test API ---
Route::get('/test', function () {
    return response()->json(['success' => true, 'message' => 'API is working']);
});

// --- Products API ---
Route::get('/products', [ProductController::class, 'apiIndex']); // Get all products
Route::get('/products/{id}', [ProductController::class, 'show']); // Get single product
Route::get('/products/search', [ProductController::class, 'apiIndex']); // Use query param ?query=xxx

// --- Cart API ---
// These APIs will manage session-based cart for the app
Route::get('/cart', [ProductController::class, 'apiCart']); // Get cart
Route::post('/cart/add', [ProductController::class, 'apiAddToCart']); // Body: { "id": 1, "quantity": 1 }
Route::post('/cart/update', [ProductController::class, 'apiUpdateCart']); // Body: { "id": 1, "quantity": 2 }
Route::post('/cart/remove', [ProductController::class, 'apiRemoveFromCart']); // Body: { "id": 1 }

// --- Special Order API ---
Route::post('/products/special', [ProductController::class, 'apiSpecialOrder']); // Body: { "product_name": "...", "quantity": 1, "notes": "..." }

// --- Checkout API ---
Route::get('/checkout/cart', [CheckoutController::class, 'getCart']); // Get current cart
Route::post('/checkout/process', [CheckoutController::class, 'apiProcess']); // Submit order

Route::post('/contact/sendapi', [ContactController::class, 'sendapi']);

// --- Optional: Protected admin APIs ---
// If you want admin APIs, you can protect with auth:sanctum or auth middleware
// Route::middleware('auth:sanctum')->group(function() {
//     Route::post('/admin/products', [ApiProductController::class, 'store']);
//     Route::put('/admin/products/{product}', [ApiProductController::class, 'update']);
//     Route::delete('/admin/products/{product}', [ApiProductController::class, 'destroy']);
//     Route::post('/admin/products/upload-excel', [ApiProductController::class, 'uploadExcel']);
// });
