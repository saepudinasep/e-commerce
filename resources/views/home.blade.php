<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Warung Coding ! E-Commerce</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="dark">
        <div class="container">
            <a class="navbar-brand" href="/">Mukicik</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="home.php">Home</a>
                    </li>
                    @if (Auth::check())
                        @php
                            $userRole = Auth::user()->role;
                        @endphp

                        @if ($userRole === 'admin')
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    Product
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="">Insert</a></li>
                                    <li><a class="dropdown-item" href="">Update</a></li>
                                </ul>
                            </li>
                        @elseif ($userRole === 'pelanggan')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('product') }}">Product</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="">Keranjang</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('product') }}">Product</a>
                        </li>
                    @endif

                </ul>
                <ul class="navbar-nav d-flex">
                    @if (Auth::check())
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Hi, {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                                </li>
                            </ul>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Register</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                    @endif

                </ul>
            </div>
        </div>
    </nav>
    <!-- End Navbar -->

    <div class="container mt-4 mb-4">
        <div class="row">
            <div class="col-md-4">
                <img src="img/home.jpg" alt="Guitar" srcset="" class="img-home" />
            </div>
            <div class="col-md-8">
                <h1 class="font-title">Mukicik</h1>
                <h3>
                    An innovative music selling store with competitive prices <br />
                    It's never this cheap to shop in music !
                </h3>
                <a href="register.php" class="btn btn-primary btn-lg" type="button">
                    Be a New Member
                </a>
            </div>
        </div>
    </div>

    <!-- Menampilkan data product tertinggi -->
    <div class="container">
        <h2 class="mb-3">Top 6 Products</h2>
        <!-- Product cards -->
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3" id="productContainer">
            @foreach ($products as $product)
                <div class="col-md-2 mb-4 product-card">
                    <div class="card shadow-sm">
                        <img src="assets/uploads/{{ $product->image }}" class="card-img-top img-product"
                            alt="{{ $product->name }}">
                        <div class="card-body">
                            <a href="{{ route('product.show', $product->id) }}" class="text-decoration-none">
                                <h5 class="card-title">{{ $product->name }}</h5>
                            </a>
                            {{-- <p class="card-text">{{ $product->CategoryName }}</p> --}}
                            <p class="card-text color-star">{{ $product->rating }} <i class="bi bi-star-fill"></i></p>
                            <p class="card-text">Rp. {{ number_format($product->price, 0, ',', '.') }}</p>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>

    <footer class="pt-3 mt-4 text-body-secondary border-top">
        <div class="container">&copy; 2016 - Mukicik</div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
