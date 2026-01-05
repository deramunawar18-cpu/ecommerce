<?php

namespace App\Http\Controllers;
// app/Http/Controllers/OrderController.php


use App\Models\Order;
use Illuminate\Http\Request;
use App\Services\MidtransService;

class OrderController extends Controller
{
    /**
     * Menampilkan daftar pesanan milik user yang sedang login.
     */
    public function index()
    {
        // PENTING: Jangan gunakan Order::all() !
        // Kita hanya mengambil order milik user yg sedang login menggunakan relasi hasMany.
        // auth()->user()->orders() akan otomatis memfilter: WHERE user_id = current_user_id
        $orders = auth()->user()->orders()
            ->with(['items.product']) // Eager Load nested: Order -> OrderItems -> Product
            ->latest() // Urutkan dari pesanan terbaru
            ->paginate(10);

        return view('orders.index', compact('orders'));
    }

    /**
     * Menampilkan detail satu pesanan.
     */
    public function show(Order $order, MidtransService $midtransService)
    {
        // 1. Authorize (Security Check)
        // User A TIDAK BOLEH melihat pesanan User B.
        // Kita cek apakah ID pemilik order sama dengan ID user yang login.
        if ($order->user_id !== auth()->id()) {
            abort(403, 'Anda tidak memiliki akses ke pesanan ini.');
        }

        // WAJIB load relasi yang dipakai Midtrans
        $order->load(['items.product', 'user']);

        // BUAT SNAP TOKEN JIKA PENDING & BELUM ADA
        if ($order->status === 'pending' && !$order->snap_token) {
            $snapToken = $midtransService->createSnapToken($order);
            $order->update(['snap_token' => $snapToken]);
        }

        return view('orders.show', compact('order'));
    }

    /**
     * Menampilkan halaman status pembayaran sukses.
     */
    public function success(Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(403, 'Anda tidak memiliki akses ke pesanan ini.');
        }
        return view('orders.success', compact('order'));
    }

    /**
     * Menampilkan halaman status pembayaran pending.
     */
    public function pending(Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(403, 'Anda tidak memiliki akses ke pesanan ini.');
        }
        return view('orders.pending', compact('order'));
    }
}
