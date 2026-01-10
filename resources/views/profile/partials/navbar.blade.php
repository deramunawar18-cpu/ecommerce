{{-- ================================================
     FILE: resources/views/partials/navbar.blade.php
     FUNGSI: Navigation bar untuk customer (Modern Design)
     ================================================ --}}

<style>
    /* Modern Navbar Styles */
    .modern-navbar {
        background: rgba(255, 255, 255, 0.95) !important;
        backdrop-filter: blur(10px);
        box-shadow: 0 2px 20px rgba(0, 0, 0, 0.08) !important;
        border-bottom: 1px solid rgba(230, 126, 34, 0.1);
        transition: all 0.3s ease;
    }

    .modern-navbar.scrolled {
        background: rgba(255, 255, 255, 0.98) !important;
        box-shadow: 0 4px 30px rgba(0, 0, 0, 0.12) !important;
    }

    /* Brand Logo */
    .navbar-brand {
        font-weight: 900 !important;
        font-size: 1.5rem !important;
        background: linear-gradient(135deg, #e67e22, #d35400);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        transition: all 0.3s ease;
        letter-spacing: -0.5px;
    }

    .navbar-brand:hover {
        transform: scale(1.05);
    }

    .navbar-brand i {
        background: linear-gradient(135deg, #e67e22, #d35400);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        font-size: 1.8rem;
        animation: heartbeat 1.5s ease-in-out infinite;
    }

    @keyframes heartbeat {
        0%, 100% { transform: scale(1); }
        25% { transform: scale(1.1); }
        50% { transform: scale(1); }
    }

    /* Modern Search Bar */
    .modern-search {
        position: relative;
        max-width: 500px;
        width: 100%;
    }

    .modern-search .form-control {
        border-radius: 50px;
        border: 2px solid #f0f0f0;
        padding: 12px 50px 12px 24px;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        background: #f8f9fa;
    }

    .modern-search .form-control:focus {
        background: white;
        border-color: #e67e22;
        box-shadow: 0 0 0 4px rgba(230, 126, 34, 0.1);
        transform: translateY(-2px);
    }

    .modern-search .btn {
        position: absolute;
        right: 5px;
        top: 50%;
        transform: translateY(-50%);
        border-radius: 50%;
        width: 40px;
        height: 40px;
        padding: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #e67e22, #d35400);
        border: none;
        transition: all 0.3s ease;
    }

    .modern-search .btn:hover {
        transform: translateY(-50%) scale(1.1);
        box-shadow: 0 4px 15px rgba(230, 126, 34, 0.4);
    }

    /* Nav Links */
    .navbar-nav .nav-link {
        font-weight: 600;
        color: #2c3e50 !important;
        padding: 8px 16px !important;
        border-radius: 12px;
        transition: all 0.3s ease;
        position: relative;
        margin: 0 4px;
    }

    .navbar-nav .nav-link:hover {
        background: rgba(230, 126, 34, 0.1);
        color: #e67e22 !important;
        transform: translateY(-2px);
    }

    .navbar-nav .nav-link i {
        font-size: 1.1rem;
    }

    /* Icon Badge Styles */
    .icon-badge {
        position: relative;
        display: inline-block;
        padding: 8px 12px;
        border-radius: 12px;
        transition: all 0.3s ease;
    }

    .icon-badge:hover {
        background: rgba(230, 126, 34, 0.1);
        transform: scale(1.1);
    }

    .icon-badge i {
        font-size: 1.3rem;
        color: #2c3e50;
    }

    .icon-badge .badge {
        position: absolute;
        top: -5px;
        right: -5px;
        min-width: 20px;
        height: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.65rem;
        font-weight: 700;
        border: 2px solid white;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
    }

    /* User Dropdown */
    .user-dropdown-toggle {
        background: linear-gradient(135deg, #f8f9fa, #e9ecef);
        border-radius: 50px;
        padding: 6px 16px 6px 6px !important;
        border: 2px solid transparent;
        transition: all 0.3s ease;
    }

    .user-dropdown-toggle:hover {
        border-color: #e67e22;
        background: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .user-dropdown-toggle img {
        border: 2px solid white;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }

    .user-dropdown-toggle:hover img {
        border-color: #e67e22;
    }

    /* Dropdown Menu */
    .dropdown-menu {
        border-radius: 16px;
        border: none;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
        padding: 12px;
        margin-top: 12px;
        min-width: 220px;
    }

    .dropdown-item {
        border-radius: 10px;
        padding: 10px 16px;
        font-weight: 600;
        transition: all 0.2s ease;
        margin-bottom: 4px;
    }

    .dropdown-item:hover {
        background: rgba(230, 126, 34, 0.1);
        color: #e67e22;
        transform: translateX(5px);
    }

    .dropdown-item i {
        width: 20px;
        text-align: center;
    }

    /* Auth Buttons */
    .btn-auth-login {
        color: #2c3e50;
        font-weight: 600;
        padding: 8px 20px;
        border-radius: 12px;
        transition: all 0.3s ease;
    }

    .btn-auth-login:hover {
        background: rgba(230, 126, 34, 0.1);
        color: #e67e22;
    }

    .btn-auth-register {
        background: linear-gradient(135deg, #e67e22, #d35400);
        color: white !important;
        font-weight: 700;
        padding: 10px 24px;
        border-radius: 50px;
        border: none;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(230, 126, 34, 0.3);
    }

    .btn-auth-register:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 20px rgba(230, 126, 34, 0.4);
    }

    /* Mobile Toggle */
    .navbar-toggler {
        border: none;
        padding: 8px 12px;
        border-radius: 10px;
        transition: all 0.3s ease;
    }

    .navbar-toggler:focus {
        box-shadow: 0 0 0 3px rgba(230, 126, 34, 0.2);
    }

    .navbar-toggler:hover {
        background: rgba(230, 126, 34, 0.1);
    }

    /* Mobile Menu */
    @media (max-width: 991px) {
        .modern-search {
            margin: 16px 0;
        }

        .navbar-nav {
            padding: 16px 0;
        }

        .navbar-nav .nav-link {
            margin: 4px 0;
        }

        .user-dropdown-toggle {
            width: 100%;
            justify-content: flex-start;
        }
    }
</style>

<nav class="navbar navbar-expand-lg navbar-light modern-navbar sticky-top">
    <div class="container">
        {{-- Logo & Brand --}}
        <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
            <i class="bi bi-bag-heart-fill me-2"></i>
            <span>Kaos distro kece</span>
        </a>

        {{-- Mobile Toggle --}}
        <button class="navbar-toggler" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarMain">
            <span class="navbar-toggler-icon"></span>
        </button>

        {{-- Navbar Content --}}
        <div class="collapse navbar-collapse" id="navbarMain">
            {{-- Search Form --}}
            <form class="d-flex mx-auto modern-search"
                  action="{{ route('catalog.index') }}" method="GET">
                <div class="position-relative w-100">
                    <input type="text" name="q"
                           class="form-control"
                           placeholder="Cari kaos distro favorit kamu..."
                           value="{{ request('q') }}">
                    <button class="btn btn-primary" type="submit">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
            </form>

            {{-- Right Menu --}}
            <ul class="navbar-nav ms-auto align-items-lg-center">
                {{-- Katalog --}}
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('catalog.index') }}">
                        <i class="bi bi-grid-3x3-gap me-1"></i>
                        <span>Katalog</span>
                    </a>
                </li>

                @auth
                    {{-- Wishlist --}}
                    <li class="nav-item">
                        <a class="nav-link icon-badge" href="{{ route('wishlist.index') }}">
                            <i class="bi bi-heart-fill" style="color: #e74c3c;"></i>
                            @if(auth()->user()->wishlists()->count() > 0)
                                <span class="badge rounded-pill bg-danger">
                                    {{ auth()->user()->wishlists()->count() }}
                                </span>
                            @endif
                        </a>
                    </li>

                    {{-- Cart --}}
                    <li class="nav-item">
                        <a class="nav-link icon-badge" href="{{ route('cart.index') }}">
                            <i class="bi bi-cart3-fill" style="color: #e67e22;"></i>
                            @php
                                $cartCount = auth()->user()->cart?->items()->count() ?? 0;
                            @endphp
                            @if($cartCount > 0)
                                <span class="badge rounded-pill bg-primary">
                                    {{ $cartCount }}
                                </span>
                            @endif
                        </a>
                    </li>

                    {{-- User Dropdown --}}
                    <li class="nav-item dropdown ms-2">
                        <a class="nav-link dropdown-toggle d-flex align-items-center user-dropdown-toggle"
                           href="#" id="userDropdown"
                           data-bs-toggle="dropdown">
                            <img src="{{ auth()->user()->avatar_url }}"
                                 class="rounded-circle"
                                 width="36" height="36"
                                 alt="{{ auth()->user()->name }}">
                            <span class="d-none d-lg-inline ms-2 fw-bold" style="color: #2c3e50;">
                                {{ Str::limit(auth()->user()->name, 15) }}
                            </span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                    <i class="bi bi-person-fill me-2"></i> Profil Saya
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('orders.index') }}">
                                    <i class="bi bi-bag-check-fill me-2"></i> Pesanan Saya
                                </a>
                            </li>
                            @if(auth()->user()->isAdmin())
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item text-primary" href="{{ route('admin.dashboard') }}">
                                        <i class="bi bi-speedometer2 me-2"></i> Admin Panel
                                    </a>
                                </li>
                            @endif
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">
                                        <i class="bi bi-box-arrow-right me-2"></i> Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    {{-- Guest Links --}}
                    <li class="nav-item">
                        <a class="nav-link btn-auth-login" href="{{ route('login') }}">
                            <i class="bi bi-box-arrow-in-right me-1"></i> Masuk
                        </a>
                    </li>
                    <li class="nav-item ms-2">
                        <a class="btn btn-auth-register" href="{{ route('register') }}">
                            <i class="bi bi-person-plus me-1"></i> Daftar
                        </a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

{{-- Optional: Add scroll effect with JavaScript --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const navbar = document.querySelector('.modern-navbar');

        window.addEventListener('scroll', function() {
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });
    });
</script>
