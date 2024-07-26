<nav class="custom-navbar navbar navbar navbar-expand-md navbar-dark bg-dark fixed-top"
    arial-label="Furni navigation bar">

    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">Roab<span>.</span></a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsFurni"
            aria-controls="navbarsFurni" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsFurni">
            <ul class="custom-navbar-nav navbar-nav ms-auto mb-2 mb-md-0">
                <li><a class="nav-link" href="{{ route('home') }}">Trang chủ</a></li>
                <li><a class="nav-link" href="{{ route('shop') }}">Sản phẩm</a></li>
                <li><a class="nav-link" href="{{ route('cart') }}"><img
                            src="{{ asset('images/cart.svg') }}"></a></li>


                <p class="nav-link">
                    @if (Route::has('login'))
                        @auth

                            <a class="nav-link" href="{{ url('/home') }} ">
                                <div class="dropdown">
                                    <a href="" class="d-block link-body-emphasis text-decoration-none"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <div class="font-small text-base text-white dark:text-gray-200">
                                            {{ Auth::user()->name }}</div>
                                    </a>
                                    <ul class="dropdown-menu text-small">
                                        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600 ">
                                            <div class=" space-y-1">
                                                @if (Auth::user()->role == 'admin')
                                                    <a href="{{ route('admin') }}"
                                                        class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600 text-center">Trang
                                                        quản trị</a>

                                                        @else
                                                    <x-responsive-nav-link :href="route('profile.edit')">
                                                        {{ __('Hồ sơ') }}
                                                    </x-responsive-nav-link>
                                                @endif
                                                <br>


                                                <!-- Authentication -->
                                                <form method="POST" action="{{ route('logout') }}">
                                                    @csrf
                                                    <x-responsive-nav-link :href="route('logout')"
                                                        onclick="event.preventDefault();
                                                                            this.closest('form').submit();">
                                                        {{ __('Đăng xuất') }}
                                                    </x-responsive-nav-link>
                                                </form>

                                            </div>
                                        </div>

                                    </ul>
                            </a>
                        @else
                            <li><a href="{{ route('login') }}"
                                    class="nav-link rounded-md px-3 py-2 ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                                    Đăng nhập
                                </a></li>

                            @if (Route::has('register'))
                                <li><a href="{{ route('register') }}"
                                        class="nav-link rounded-md px-3 py-2 ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                                        Đăng kí
                                    </a></li>
                            @endif
                        @endauth

                    @endif
                    </li>


            </ul>
        </div>
    </div>

</nav>
