<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\MidtransNotificationController;
use App\Http\Controllers\Admin\DashboardController;



Route::get('/', function () {
    return view('welcome');
});

Route::get('/tentang', function () {
    return view('tentang');

});

Route::get('/sapa/{nama}', function ($nama) {
    return "Halo, $nama! Selamat datang di Cuy toko.";
});

Route::get('/kategori/{nama?}', function ($nama = 'Selamat berbelanja') {
    return "Menampilkan Cuy toko: $nama";
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// ========================================
// FILE: routes/web.php (tambahan untuk admin)
// ========================================

// ================================================
// ROUTE KHUSUS ADMIN
// ================================================
// middleware(['auth', 'admin']) = Harus login DAN harus admin
// prefix('admin')               = Semua URL diawali /admin
// name('admin.')                = Semua nama route diawali admin.
// ================================================

Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // /admin/dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');
        // ↑ Nama lengkap route: admin.dashboard
        // ↑ URL: /admin/dashboard

        // CRUD Produk: /admin/products, /admin/products/create, dll
        Route::resource('/products', AdminProductController::class);
        // ↑ resource() membuat 7 route sekaligus:
        // - GET    /admin/products          → index   (admin.products.index)
        // - GET    /admin/products/create   → create  (admin.products.create)
        // - POST   /admin/products          → store   (admin.products.store)
        // - GET    /admin/products/{id}     → show    (admin.products.show)
        // - GET    /admin/products/{id}/edit→ edit    (admin.products.edit)
        // - PUT    /admin/products/{id}     → update  (admin.products.update)
        // - DELETE /admin/products/{id}     → destroy (admin.products.destroy)
});

// ========================================
// FILE: routes/web.php (tambahan untuk Google OAuth)
// ========================================

use App\Http\Controllers\Auth\GoogleController;

// ================================================
// GOOGLE OAUTH ROUTES
// ================================================
// Route ini diakses oleh browser, tidak perlu middleware auth
// ================================================

Route::controller(GoogleController::class)->group(function () {
    // ================================================
    // ROUTE 1: REDIRECT KE GOOGLE
    // ================================================
    // URL: /auth/google
    // Dipanggil saat user klik tombol "Login dengan Google"
    // ================================================
    Route::get('/auth/google', 'redirect')
        ->name('auth.google');

    // ================================================
    // ROUTE 2: CALLBACK DARI GOOGLE
    // ================================================
    // URL: /auth/google/callback
    // Dipanggil oleh Google setelah user klik "Allow"
    // URL ini HARUS sama dengan yang didaftarkan di Google Console!
    // ================================================
    Route::get('/auth/google/callback', 'callback')
        ->name('auth.google.callback');
});
// ================================================
// FILE: routes/web.php
// FUNGSI: Definisi semua route website
// ================================================


// ================================================
// HALAMAN PUBLIK (Tanpa Login)
// ================================================

// Homepage
Route::get('/', [HomeController::class, 'index'])->name('home');

// Katalog Produk
Route::get('/products', [CatalogController::class, 'index'])->name('catalog.index');
Route::get('/products/{slug}', [CatalogController::class, 'show'])->name('catalog.show');


// ================================================
// HALAMAN YANG BUTUH LOGIN (Customer)
// ================================================

Route::middleware('auth')->group(function () {
    // Keranjang Belanja
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::patch('/cart/{item}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/{item}', [CartController::class, 'remove'])->name('cart.remove');

    // Wishlist
    Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
    Route::post('/wishlist/toggle/{product}', [WishlistController::class, 'toggle'])->name('wishlist.toggle');

    // Checkout
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');

    // Pesanan Saya
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');

    // Profil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// ================================================
// HALAMAN ADMIN (Butuh Login + Role Admin)
// ================================================

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Produk CRUD

    // Kategori CRUD
    Route::resource('categories', AdminCategoryController::class);

    // Manajemen Pesanan
    Route::get('/orders', [AdminOrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [AdminOrderController::class, 'show'])->name('orders.show');
    Route::patch('/orders/{order}/status', [AdminOrderController::class, 'updateStatus'])->name('orders.updateStatus');

     Route::resource('categories', CategoryController::class)->except(['show']); // Kategori biasanya tidak butuh show detail page

    // Produk
    Route::resource('products', ProductsController::class)->except(['show']);
});


// ================================================
// AUTH ROUTES (dari Laravel UI)
// ================================================

// routes/web.php

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // Kategori
    Route::resource('categories', CategoryController::class)->except(['show']); // Kategori biasanya tidak butuh show detail page

    // Produk
    Route::resource('products', ProductController::class);

    // Route tambahan untuk AJAX Image Handling (jika diperlukan)
    // ...
});

Route::middleware('auth')->group(function() {
    Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
    Route::post('/wishlist/toggle/{product}', [WishlistController::class, 'toggle'])->name('wishlist.toggle');
});
Auth::routes();


use App\Services\MidtransService;

Route::get('/debug-midtrans', function () {
    // Cek apakah config terbaca
    $config = [
        'merchant_id'   => config('midtrans.merchant_id'),
        'client_key'    => config('midtrans.client_key'),
        'server_key'    => config('midtrans.server_key') ? '***SET***' : 'NOT SET',
        'is_production' => config('midtrans.is_production'),
    ];

    // Test buat dummy token
    try {
        $service = new MidtransService();

        // Buat dummy order untuk testing
        $dummyOrder = new \App\Models\Order();
        $dummyOrder->order_number = 'TEST-' . time();
        $dummyOrder->total_amount = 10000;
        $dummyOrder->shipping_cost = 0;
        $dummyOrder->shipping_name = 'Test User';
        $dummyOrder->shipping_phone = '08123456789';
        $dummyOrder->shipping_address = 'Jl. Test No. 123';
        $dummyOrder->user = (object) [
            'name'  => 'Tester',
            'email' => 'test@example.com',
            'phone' => '08123456789',
        ];
        // Dummy items
        $dummyOrder->items = collect([
            (object) [
                'product_id'   => 1,
                'product_name' => 'Produk Test',
                'price'        => 10000,
                'quantity'     => 1,
            ],
        ]);

        $token = $service->createSnapToken($dummyOrder);

        return response()->json([
            'status'  => 'SUCCESS',
            'message' => 'Berhasil terhubung ke Midtrans!',
            'config'  => $config,
            'token'   => $token,
        ]);

    } catch (\Exception $e) {
        return response()->json([
            'status'  => 'ERROR',
            'message' => $e->getMessage(),
            'config'  => $config,
        ], 500);
    }
});

Route::middleware('auth')->group(function () {
    // ... routes lainnya

    // Payment Routes
    Route::get('/orders/{order}/pay', [PaymentController::class, 'show'])
        ->name('orders.pay');
    Route::get('/orders/{order}/success', [PaymentController::class, 'success'])
        ->name('orders.success');
    Route::get('/orders/{order}/pending', [PaymentController::class, 'pending'])
        ->name('orders.pending');
});

// routes/web.php

// ============================================================
// MIDTRANS WEBHOOK
// Route ini HARUS public (tanpa auth middleware)
// Karena diakses oleh SERVER Midtrans, bukan browser user
// ============================================================
Route::post('midtrans/notification', [MidtransNotificationController::class, 'handle'])
    ->name('midtrans.notification');
