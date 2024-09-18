<?php

use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Site\CartController;
use App\Http\Controllers\Site\CheckoutController;
use App\Http\Controllers\Site\ShopController;
use App\Http\Controllers\Site\WishlistController;
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

#APLICACAO DO CUPOM DE DESCONTO
Route::post('/cart/apply-coupon', [CartController::class, 'apply_coupon_code'])->name('cart.coupon.apply');
Route::delete('/cart/remove-coupon', [CartController::class, 'remove_coupon_code'])->name('cart.coupon.remove');


#LISTA DE DESEJOS/FAVORITOS
Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
Route::post('/wishlist/add', [WishlistController::class, 'add_to_wishlist'])->name('wishlist.add');
Route::delete('/wishlist/item/remove/{rowId}', [WishlistController::class, 'remove_item'])->name('wishlist.item.remove');
Route::delete('/wishlist/clear', [WishlistController::class, 'empty_wishlist'])->name('wishlist.items.clear');
Route::post('/wishlist/move-to-cart/{rowId}', [WishlistController::class, 'move_to_cart'])->name('wishlist.move.to.cart');

#CHECKOUT
Route::get('/checkout', [CheckoutController::class, 'checkout'])->name('cart.checkout');
Route::post('/place-an-order', [CheckoutController::class, 'place_an_order'])->name('cart.place.an.order');
Route::get('/order-confirmation', [CheckoutController::class, 'order_confirmation'])->name('cart.order.confirmation');

#CONTA DO USUÁRIO FINAL (CONSUMIDOR)
Route::middleware(['auth'])->group(function() {
    Route::get('/account-dashboard', [UserController::class, 'index'])->name('user.index');
});

Route::middleware(['auth', AuthAdmin::class])->group(function() {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');

    //MARCAS
    Route::get('/admin/brands', [BrandController::class, 'brands'])->name('admin.brands');
    Route::get('/admin/brand/create', [BrandController::class, 'brand_create'])->name('admin.brand.create');
    Route::post('/admin/brand/store', [BrandController::class, 'brand_store'])->name('admin.brand.store');
    Route::get('/admin/brand/edit/{id}', [BrandController::class, 'brand_edit'])->name('admin.brand.edit');
    Route::put('/admin/brand/update', [BrandController::class, 'brand_update'])->name('admin.brand.update');
    Route::delete('/admin/brand/{id}/delete', [BrandController::class, 'brand_delete'])->name('admin.brand.delete');

    //CATEGORIAS
    Route::get('/admin/categories', [CategoryController::class, 'categories'])->name('admin.categories');
    Route::get('/admin/category/create', [CategoryController::class, 'category_create'])->name('admin.category.create');
    Route::post('/admin/category/store', [CategoryController::class, 'category_store'])->name('admin.category.store');
    Route::get('/admin/category/edit/{id}', [CategoryController::class, 'category_edit'])->name('admin.category.edit');
    Route::put('/admin/category/update', [CategoryController::class, 'category_update'])->name('admin.category.update');
    Route::delete('/admin/category/{id}/delete', [CategoryController::class, 'category_delete'])->name('admin.category.delete');

    //PRODUTOS
    Route::get('/admin/products', [ProductController::class, 'products'])->name('admin.products');
    Route::get('/admin/product/create', [ProductController::class, 'product_create'])->name('admin.product.create');
    Route::post('/admin/product/store', [ProductController::class, 'product_store'])->name('admin.product.store');
    Route::get('/admin/product/edit/{id}', [ProductController::class, 'product_edit'])->name('admin.product.edit');
    Route::put('/admin/product/update', [ProductController::class, 'product_update'])->name('admin.product.update');
    Route::delete('/admin/product/{id}/delete', [ProductController::class, 'product_delete'])->name('admin.product.delete');

    //CUPONS DE DESCONTO
    Route::get('/admin/coupons', [CouponController::class, 'coupons'])->name('admin.coupons');
    Route::get('/admin/coupon/create', [CouponController::class, 'coupon_create'])->name('admin.coupon.create');
    Route::post('/admin/coupon/store', [CouponController::class, 'coupon_store'])->name('admin.coupon.store');
    Route::get('/admin/coupon/edit/{id}', [CouponController::class, 'coupon_edit'])->name('admin.coupon.edit');
    Route::put('/admin/coupon/update', [CouponController::class, 'coupon_update'])->name('admin.coupon.update');
    Route::delete('/admin/coupon/{id}/delete', [CouponController::class, 'coupon_delete'])->name('admin.coupon.delete');
  
    //PEDIDOS (ORDERS)
    Route::get('/admin/orders', [OrderController::class, 'orders'])->name('admin.orders');
    Route::get('/admin/order/{order_id}/show', [OrderController::class, 'order_show'])->name('admin.order.show');
});


#############   ----------- CONTINUA PRÓXIMO VIDEO 33   ########################