<?php

use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Site\CartController;
use App\Http\Controllers\Site\ShopController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AuthAdmin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

#AUTENTICAÇÃO
Auth::routes();

#SITE ABERTO / SEM MIDDLEWARE
Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');
Route::get('/shop/{product_slug}', [ShopController::class, 'product_show'])->name('shop.product.show');

#CARRINHO DE COMPRAS
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'add_to_cart'])->name('cart.add');
Route::put('/cart/increase-quantity/{rowId}', [CartController::class, 'increase_cart_quantity'])->name('cart.qty.increase');
Route::put('/cart/decrease-quantity/{rowId}', [CartController::class, 'decrease_cart_quantity'])->name('cart.qty.decrease');
Route::delete('/cart/remove/{rowId}', [CartController::class, 'remove_item'])->name('cart.item.remove');
Route::delete('/cart/remove', [CartController::class, 'empty_cart'])->name('cart.empty');

#CONTA DO USUÁRIO FINAL (CONSUMIDOR)
Route::middleware(['auth'])->group(function() {
    Route::get('/account-dashboard', [UserController::class, 'index'])->name('user.index');
});

Route::middleware(['auth', AuthAdmin::class])->group(function() {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');

    //BRANDS
    Route::get('/admin/brands', [BrandController::class, 'brands'])->name('admin.brands');
    Route::get('/admin/brand/create', [BrandController::class, 'brand_create'])->name('admin.brand.create');
    Route::post('/admin/brand/store', [BrandController::class, 'brand_store'])->name('admin.brand.store');
    Route::get('/admin/brand/edit/{id}', [BrandController::class, 'brand_edit'])->name('admin.brand.edit');
    Route::put('/admin/brand/update', [BrandController::class, 'brand_update'])->name('admin.brand.update');
    Route::delete('/admin/brand/{id}/delete', [BrandController::class, 'brand_delete'])->name('admin.brand.delete');

    //CATEGORIES
    Route::get('/admin/categories', [CategoryController::class, 'categories'])->name('admin.categories');
    Route::get('/admin/category/create', [CategoryController::class, 'category_create'])->name('admin.category.create');
    Route::post('/admin/category/store', [CategoryController::class, 'category_store'])->name('admin.category.store');
    Route::get('/admin/category/edit/{id}', [CategoryController::class, 'category_edit'])->name('admin.category.edit');
    Route::put('/admin/category/update', [CategoryController::class, 'category_update'])->name('admin.category.update');
    Route::delete('/admin/category/{id}/delete', [CategoryController::class, 'category_delete'])->name('admin.category.delete');

    //PRODUCTS
    Route::get('/admin/products', [ProductController::class, 'products'])->name('admin.products');
    Route::get('/admin/product/create', [ProductController::class, 'product_create'])->name('admin.product.create');
    Route::post('/admin/product/store', [ProductController::class, 'product_store'])->name('admin.product.store');
    Route::get('/admin/product/edit/{id}', [ProductController::class, 'product_edit'])->name('admin.product.edit');
    Route::put('/admin/product/update', [ProductController::class, 'product_update'])->name('admin.product.update');
    Route::delete('/admin/product/{id}/delete', [ProductController::class, 'product_delete'])->name('admin.product.delete');
});


#############   ----------- CONTINUA PRÓXIMO VIDEO __   ########################