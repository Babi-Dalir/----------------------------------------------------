<?php

use App\Http\Controllers\Seller\SellerProductController;
use App\Http\Controllers\Seller\SellerTransactionController;
use Illuminate\Support\Facades\Route;

Route::get('seller_products', [SellerProductController::class, 'sellerProducts'])->name('seller.products');
Route::get('seller_transactions', [SellerTransactionController::class, 'sellerTransactions'])->name('seller.transactions');

Route::get('seller_create_product', [SellerProductController::class, 'sellerCreateProduct'])->name('seller.create.product');
Route::post('seller_store_product', [SellerProductController::class, 'sellerStoreProduct'])->name('seller.store.product');

//Route::get('product_guaranties/{id}', [ProductGuarantyController::class, 'index'])->name('product.guaranties');
//Route::get('create_product_guaranties/{product_id}', [ProductGuarantyController::class, 'create'])->name('create.product.guaranties');
//Route::post('store_product_guaranties/{product_id}', [ProductGuarantyController::class, 'store'])->name('store.product.guaranties');
//Route::get('edit_product_guaranties/{id}/{product_id}', [ProductGuarantyController::class, 'edit'])->name('edit.product.guaranties');
//Route::put('update_product_guaranties/{id}/{product_id}', [ProductGuarantyController::class, 'update'])->name('update.product.guaranties');
