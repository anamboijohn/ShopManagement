<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CropAndStoreController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RecordController;
use App\Models\Product;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('auth.login');
});

Route::view('invoice', 'products.invoice');

Route::get('invoice/index', [CartController::class, 'invoice'])->name('invoice.index');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('product', ProductController::class);
    Route::get('/dashboard', [ProductController::class, 'dashboard'])->name('dashboard');
    Route::get('/crop', [CropAndStoreController::class, 'crop'])->name('crop');
    Route::get('/products/all', [ProductController::class, 'index'])->name('products.index');
    Route::get('product/{product}/stock-form', function (Product $product) {
        return view('products.add-to-stock-form', ['product' => $product]);
    })->name('product.stock');
    Route::patch('products/{product}', [ProductController::class, 'stock'])->name('product.stockUpdate');

    Route::get('expiry-notice', [ProductController::class, 'notice'])->name('product.notice');

    //Cart features

    Route::get('cart', [CartController::class, 'cartList'])->name('cart.list');
    Route::post('cart', [CartController::class, 'addToCart'])->name('cart.store');
    Route::post('update-cart', [CartController::class, 'updateCart'])->name('cart.update');
    Route::post('remove', [CartController::class, 'removeCart'])->name('cart.remove');
    Route::post('clear', [CartController::class, 'clearAllCart'])->name('cart.clear');
    Route::post('sell', [CartController::class, 'sell'])->name('cart.sell');


    //Records
    Route::get('records/all', [RecordController::class, 'index'])->name('records.index');

    //Pdf
    Route::get('generate-pdf', [RecordController::class, 'generatePDF'])->name('pdf');
});

// Route::get('/test', function () {
//    return view('records.index');
// });

require __DIR__ . '/auth.php';
