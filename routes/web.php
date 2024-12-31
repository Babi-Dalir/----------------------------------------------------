<?php

use App\Http\Controllers\FrontEnd\HomeController;
use App\Http\Controllers\FrontEnd\PaymentController;
use App\Http\Controllers\FrontEnd\ProductController;
use App\Http\Controllers\FrontEnd\ProfileController;
use Illuminate\Support\Facades\Route;
use PHPUnit\Framework\Attributes\Group;

require __DIR__ . '/auth.php';

//-- Main Routs --//
// Route::get('/',[panelController::class, 'index'])->name('panel');

Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/payment/callback', [PaymentController::class, 'callback'])->name('callback');

Route::get('/product_details/{slug}', [ProductController::class, 'singleProduct'])->name('single.product');
Route::get('/main/{main_category_slug}', [ProductController::class, 'mainCategoryProductList'])->name('main.category.product.list');
Route::get('/search/{sub_category_slug}/{child_category_slug?}', [ProductController::class, 'searchCategoryProductList'])->name('search.category.product.list');
Route::get('/compare_products/[{product_id1}/{product_id2}]', [ProductController::class, 'compareProducts'])->name('compare.products');

Route::middleware('auth')->group(function(){

    Route::get('/cart', [HomeController::class, 'cart'])->name('user.cart');
    Route::get('/shopping', [HomeController::class, 'shopping'])->name('user.shopping');
    Route::get('/shopping_payment', [HomeController::class, 'shoppingPayment'])->name('user.shopping.payment');

    Route::get('/payment', [PaymentController::class, 'payment'])->name('payment');

    Route::get('/product/comment/{product_id}', [ProductController::class, 'productComment'])->name('product.comment');
    Route::get('/profile', [ProfileController::class, 'profile'])->name('profile');
    Route::post('/profile_update', [ProfileController::class, 'profileUpdate'])->name('profile.update');
    Route::get('/profile/orders', [ProfileController::class, 'profileOrders'])->name('profile.orders');
    Route::get('/profile/order_details/{order_id}', [ProfileController::class, 'profileOrderDetails'])->name('profile.order.details');
    Route::get('/profile/favorites', [ProfileController::class, 'profileFavorites'])->name('profile.favorites');
    Route::get('/profile/comments', [ProfileController::class, 'profileComments'])->name('profile.comments');
    Route::get('/profile/addresses', [ProfileController::class, 'profileAddresses'])->name('profile.addresses');
    Route::get('/profile/user_company', [ProfileController::class, 'profileUserCompany'])->name('profile.user.company');
    Route::post('/profile/seller_update', [ProfileController::class, 'profileSellerUpdate'])->name('profile.seller.update');

});

