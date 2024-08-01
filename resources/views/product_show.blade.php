<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Products | Warung Coding</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('/assets/css/style.css') }}">
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
                        <a class="nav-link" href="/">Home</a>
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
                                <a class="nav-link active" aria-current="page" href="{{ route('product') }}">Product</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="">Keranjang</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{ route('product') }}">Product</a>
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
                                <li>
                                    <a class="dropdown-item" href="#"
                                        onclick="event.preventDefault(); confirmLogout();">
                                        Logout
                                    </a>
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


    <div class="container mt-5">
        <div class="row">
            <!-- Product Detail Card -->
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <img src="{{ $product->image }}" class="card-img-top" alt="{{ $product->name }}">
                    <div class="card-body">
                        <h1 class="card-title">{{ $product->name }}</h1>
                        <p class="card-text">{{ $product->description }}</p>
                        <p class="card-text"><strong>Rp. {{ number_format($product->price, 0, ',', '.') }}</strong></p>

                        <!-- Add to Cart Form -->
                        <form action="" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="quantity" class="form-label">Quantity</label>
                                <input type="number" class="form-control" id="quantity" name="quantity" value="1"
                                    min="1" required>
                            </div>
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <button type="submit" class="btn btn-success">Add to Cart</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Related Products and Back Button -->
            <div class="col-md-4">
                <!-- Back Button -->
                <a href="{{ route('product') }}" class="btn btn-secondary">Back to Products</a>

                <!-- Related Products -->
                <h4 class="mb-3 mt-3">Related Products</h4>
                <div class="row row-cols-1 row-cols-md-2 g-3">
                    @foreach ($relatedProducts as $relatedProduct)
                        <div class="col-md-6">
                            <div class="card">
                                <img src="{{ $relatedProduct->image }}" class="card-img-top"
                                    alt="{{ $relatedProduct->name }}">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $relatedProduct->name }}</h5>
                                    <p class="card-text">Rp. {{ number_format($relatedProduct->price, 0, ',', '.') }}
                                    </p>
                                    <a href="{{ route('product.show', $relatedProduct->id) }}"
                                        class="btn btn-primary">View Details</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>


    <footer class="pt-3 mt-4 text-body-secondary border-top">
        <div class="container">&copy; {{ date('Y') }} - Mukicik</div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
