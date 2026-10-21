<?php
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\orderController;
use App\Http\Controllers\PromoController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProfileController;
use App\Models\cart;
use App\Models\Category;
use App\Models\order;
use Illuminate\Support\Facades\Route;
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/produk', [ProdukController::class, 'index'])->name('produk');
Route::get('/produk/detail/{id}', [ProdukController::class, 'detail'])->name('produk.detail');
Route::get('/produk/asin', [ProdukController::class, 'asin'])->name('produk.asin');
Route::get('/produk/manis', [ProdukController::class, 'manis'])->name('produk.manis');
Route::get('/category', [CategoryController::class, 'index'])->name('category');
Route::get('/promo', [PromoController::class, 'index'])->name('promo');
Route::get('/member/login',[UserController::class, 'member'])->name('member-login');
Route::get('/regis',[MemberController::class,'CreateMember'])->name('member-create');
Route::post('/regis/create',[MemberController::class,'regis'])->name('regis.post');
Route::post('/member/auth',[UserController::class, 'authMember'])->name('member-auth');
Route::middleware(['Member'])->group(function(){
    Route::get('/profile', [ProfileController::class,'index'])->name('profile');
    Route::get('/profile/edit/{id}', [ProfileController::class,'edit'])->name('profile-edit');
    Route::post('/profile/update/{id}', [ProfileController::class,'update'])->name('profile-update');

    Route::get('/cart', [CartController::class, 'index'])->name('cart');
    Route::get('/promo/add-to-cart/{id}/{discount}', [CartController::class, 'addPromoToCart'])->name('promo.addToCart');
    Route::post('/cart/store/{id}',[CartController::class,'store'])->name('cart.store');
    Route::post('/cart/delete/{id}',[CartController::class,'delete'])->name('cart.delete');
    Route::get('/checkout', [CartController::class, 'checkout'])->name('cart.checkout');

    Route::get('/payment/{id}',[InvoiceController::class,'payment'])->name('payment');
    Route::post('/payment/{id}',[InvoiceController::class,'confirm'])->name('index.confirm');
    Route::get('/invoice/detail',[InvoiceController::class,'detail'])->name('invoice.detail');
    Route::get('/invoice',[InvoiceController::class, 'index'])->name('invoices');

});
Route::get('/member/logout',[UserController::class, 'logoutMember'])->name('member-logout');

Route::middleware(['Admin'])->group(function(){
    Route::get('/admin',[AdminController::class, 'dashboard'])->name('dasboard-admin');
    Route::get('/admin/detail',[InvoiceController::class,'admin_invoice'])->name('invoice.detailadmin');
    Route::get('/admin/invoice',[InvoiceController::class, 'admin'])->name('admin.invoices');
    Route::post('/invoice/update/{id}',[InvoiceController::class, 'update'])->name('admin-invoices-update');

    Route::get('/admin/produk', [AdminController::class, 'produk'])->name('admin-produk');
    Route::get('/admin/produk/create', [ProdukController::class, 'create'])->name('produk-create');
    Route::post('/admin/produk/create', [ProdukController::class, 'store'])->name('produk-create-post');
    Route::get('/admin/produk/delete/{id}',[ProdukController::class, 'delete'])->name('produk.delete');
    Route::get('/admin/produk/edit/{id}',[ProdukController::class, 'edit'])->name('produk.edit');
    Route::post('/admin/produk/edit/{id}',[ProdukController::class, 'update'])->name('produk.update');

    Route::get('/admin/category',[AdminController::class, 'category'])->name('admin.category');
    Route::get('/admin/category/create',[CategoryController::class, 'create'])->name('admin.category.create');
    Route::post('/admin/category/create',[CategoryController::class, 'store'])->name('admin.category.post');
    Route::get('/admin/category/delete/{id}',[CategoryController::class, 'delete'])->name('admin.category.delete');
    Route::get('/admin/category/edit/{id}',[CategoryController::class, 'edit'])->name('admin.category.edit');
    Route::post('/admin/category/edit/{id}',[CategoryController::class, 'update'])->name('admin.category.update');

    Route::get('/admin/member',[AdminController::class, 'member'])->name('admin.member');
    Route::get('/admin/member/create',[memberController::class, 'create'])->name('adminmc');
    Route::post('/admin/member/create',[memberController::class, 'store'])->name('adminm.post');
    Route::get('/admin/member/delete/{id}',[memberController::class, 'delete'])->name('admin.member.delete');
    Route::get('/admin/member/edit/{id}',[memberController::class, 'edit'])->name('admin.member.edit');
    Route::post('/admin/member/update/{id}',[memberController::class, 'update'])->name('admin.member.update');

    Route::get('/admin/promo',[AdminController::class, 'promo'])->name('admin-promo');
    Route::get('/admin/promo/create',[PromoController::class, 'create'])->name('admin-promo-create');
    Route::post('/admin/promo/create',[PromoController::class, 'store'])->name('admin-promo-post');
    Route::get('/admin/promo/edit/{id}',[PromoController::class, 'edit'])->name('admin-promo-edit');
    Route::post('/admin/promo/edit/{id}',[PromoController::class, 'update'])->name('admin-promo-update');
    Route::get('/admin/promo/delete{id}',[PromoController::class, 'delete'])->name('admin-promo-delete');
});
Route::get('/admin/login',[UserController::class, 'index'])->name('admin-login');
Route::get('/admin/logout',[UserController::class, 'logout'])->name('admin-logout');
Route::post('/admin/auth',[UserController::class, 'auth'])->name('admin.auth');
// Route::get('/', function () {
//     return view('welcome');
// });
