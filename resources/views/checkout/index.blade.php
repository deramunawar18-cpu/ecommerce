{{-- resources/views/checkout/index.blade.php --}}

@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h1 class="h2 fw-bold mb-4">Checkout</h1>

    <form action="{{ route('checkout.store') }}" method="POST">
        @csrf
        <div class="row g-4">

            {{-- Form Alamat --}}
            <div class="col-lg-8">
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <h2 class="h5 fw-semibold mb-4">Informasi Pengiriman</h2>

                        <div class="mb-3">
                            <label for="name" class="form-label fw-medium">Nama Penerima</label>
                            <input type="text"
                                   class="form-control @error('name') is-invalid @enderror"
                                   id="name"
                                   name="name"
                                   value="{{ old('name', auth()->user()->name) }}"
                                   required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label fw-medium">Nomor Telepon</label>
                            <input type="text"
                                   class="form-control @error('phone') is-invalid @enderror"
                                   id="phone"
                                   name="phone"
                                   value="{{ old('phone') }}"
                                   required>
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="address" class="form-label fw-medium">Alamat Lengkap</label>
                            <textarea class="form-control @error('address') is-invalid @enderror"
                                      id="address"
                                      name="address"
                                      rows="3"
                                      required>{{ old('address') }}</textarea>
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            {{-- Order Summary --}}
            <div class="col-lg-4">
                <div class="card shadow-sm sticky-top" style="top: 1rem;">
                    <div class="card-body">
                        <h2 class="h5 fw-semibold mb-4">Ringkasan Pesanan</h2>

                        <div class="mb-4" style="max-height: 15rem; overflow-y: auto;">
                            @foreach($cart->items as $item)
                                <div class="d-flex justify-content-between align-items-start mb-3">
                                    <span class="small">{{ $item->product->name }} x {{ $item->quantity }}</span>
                                    <span class="fw-medium small">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</span>
                                </div>
                            @endforeach
                        </div>

                        <hr>

                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <span class="h6 fw-bold mb-0">Total</span>
                            <span class="h6 fw-bold mb-0">Rp {{ number_format($cart->items->sum('subtotal'), 0, ',', '.') }}</span>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 py-2 fw-semibold">
                            Buat Pesanan
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </form>
</div>
@endsection
