<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="/frontUi/img/favicon.ico" rel="icon">

    <script type="text/javascript"
		src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{config('midtrans.client_key')}}">
    </script>

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">  

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="/frontUi/lib/animate/animate.min.css" rel="stylesheet">
    <link href="/frontUi/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="/frontUi/css/style.css" rel="stylesheet">    
</head>

<body>
    <!-- Topbar Start -->
    <div class="container-fluid">
        <div class="row align-items-center bg-light py-3 px-xl-5 d-none d-lg-flex">
            <div class="col-lg-4">
                <a href="/" class="text-decoration-none">
                    <span class="h1 text-uppercase text-primary bg-dark px-2">Minsu</span>
                    <span class="h1 text-uppercase text-dark bg-primary px-2 ml-n1">.id</span>
                </a>
            </div>
            <div class="col-lg-4 col-6 text-left">
                <form action="/products/search" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Cari Produk..." name="keyword" id="keyword">
                        <div class="input-group-append">
                            <button class="input-group-text bg-transparent text-primary" type="submit"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-4 col-6 text-right">
                <p class="m-0">Customer Service</p>
                <h5 class="m-0">+012 345 6789</h5>
            </div>
        </div>
    </div>
    <!-- Topbar End -->

    <!-- Navbar Start -->
    <div class="container-fluid bg-dark mb-30">
        <div class="row px-xl-5">
            <div class="col-lg-3 d-none d-lg-block">
                <a class="btn d-flex align-items-center justify-content-between bg-primary w-100" data-toggle="collapse" href="#navbar-vertical" style="height: 65px; padding: 0 30px;">
                    <h6 class="text-dark m-0"><i class="fa fa-bars mr-2"></i>Kategori</h6>
                    <i class="fa fa-angle-down text-dark"></i>
                </a>                                                       
                <form action="" method="get">
                <nav class="collapse position-absolute navbar navbar-vertical navbar-light align-items-start p-0 bg-light" id="navbar-vertical" style="width: calc(100% - 30px); z-index: 999;">
                    <div class="navbar-nav w-100" name="category" id="category">
                        @foreach($listCategories as $category)
                            <a href="#" class="nav-item nav-link" data-category="{{ $category->category_name }}">{{ $category->category_name }}</a>
                        @endforeach                    
                    </div>
                </nav>
            </form>
            </div>
            <div class="col-lg-9">
                <nav class="navbar navbar-expand-lg bg-dark navbar-dark py-3 py-lg-0 px-0">
                    <a href="" class="text-decoration-none d-block d-lg-none">
                        <span class="h1 text-uppercase text-dark bg-light px-2">Minsu</span>
                        <span class="h1 text-uppercase text-light bg-primary px-2 ml-n1">.id</span>
                    </a>
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                        <div class="navbar-nav mr-auto py-0">
                            <a href="/" class="nav-item nav-link active">Beranda</a>
                            <a href="/products" class="nav-item nav-link">Produk</a>
                            <a href="contact.html" class="nav-item nav-link">Kontak</a>
                            <div class="lg-wd">
                                @if (!auth()->guard('customer')->user())
                                    <a href="/customer/login" class="nav-item nav-link ml-auto">Masuk</a>
                                @else
                                    <div class="nav-item dropdown mr-auto">
                                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Akun <i class="fa fa-angle-down mt-1"></i></a>
                                        <div class="dropdown-menu bg-primary rounded-0 border-0 m-0">
                                            <a href="/customer/account/{{auth()->guard('customer')->user()->id}}" class="dropdown-item">Akun Saya</a>
                                            <a href="/customer/transaction/history" class="dropdown-item">Riwayat Transaksi</a>
                                            <a href="/customer/logout" class="dropdown-item">Keluar</a>
                                        </div>
                                    </div>    
                                @endif
                            </div>
                        </div>
                        <div class="sm-wd">
                            @if (!auth()->guard('customer')->user())
                                <a href="/customer/login" class="nav-item nav-link ml-auto">Masuk</a>
                            @else
                                <div class="nav-item dropdown ml-auto">
                                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Akun <i class="fa fa-angle-down mt-1"></i></a>
                                    <div class="dropdown-menu bg-primary rounded-0 border-0 m-0">
                                        <a href="/customer/account/{{auth()->guard('customer')->user()->id}}" class="dropdown-item">Akun Saya</a>
                                        <a href="/customer/transaction/history" class="dropdown-item">Riwayat Transaksi</a>
                                        <a href="/customer/logout" class="dropdown-item">Keluar</a>
                                    </div>
                                </div>    
                            @endif
                        </div>
                        <div class="navbar-nav py-0 d-none d-lg-block">                            
                            @if (!auth()->guard('customer')->user())
                                <a href="/customer/login" class="btn px-0 ml-3">
                                    <i class="fas fa-shopping-cart text-primary"></i>
                                    <span class="badge text-secondary border border-secondary rounded-circle" style="padding-bottom: 2px;"></span>
                                </a>
                            @else
                                <a href="/customer/cart" class="btn px-0 ml-3">
                                    <i class="fas fa-shopping-cart text-primary"></i>
                                    <span class="badge text-secondary border border-secondary rounded-circle" style="padding-bottom: 2px;"></span>
                                </a>
                            @endif
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
    <!-- Navbar End -->

    @yield('dashboardPage')
    @yield('detailProductPage')
    @yield('productPage')
    @yield('listProductByCategory')
    @yield('loginFrontPage')
    @yield('registerFrontPage')
    @yield('cartPage')
    @yield('customerAccount')
    @yield('checkoutAddressPage')
    @yield('trasactionPage')
    @yield('historyTrasactionPage')

    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-secondary mt-5 pt-5">
        <div class="row px-xl-5 pt-5">
            <div class="col-lg-4 col-md-12 mb-5 pr-3 pr-xl-5">
                <h5 class="text-secondary text-uppercase mb-4">Hubungi Kami</h5>
                {{-- <p class="mb-4">Kontak Layanan Pelanggan</p> --}}
                <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i>123 Street, New York, USA</p>
                <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>info@example.com</p>
                <p class="mb-0"><i class="fa fa-phone-alt text-primary mr-3"></i>+012 345 67890</p>
            </div>
            <div class="col-lg-8 col-md-12">
                <div class="row">
                    <div class="col-md-4 mb-5">
                        <h5 class="text-secondary text-uppercase mb-4">Links</h5>
                        <div class="d-flex flex-column justify-content-start">
                            <a class="text-secondary mb-2" href="/"><i class="fa fa-angle-right mr-2"></i>Beranda</a>
                            <a class="text-secondary mb-2" href="/products"><i class="fa fa-angle-right mr-2"></i>Produk</a>
                            <a class="text-secondary" href="#"><i class="fa fa-angle-right mr-2"></i>Kontak</a>
                        </div>
                    </div>
                    <div class="col-md-4 mb-5">
                        <h5 class="text-secondary text-uppercase mb-4">Akun Saya</h5>
                        <div class="d-flex flex-column justify-content-start">
                            <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Login</a>
                            <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Daftar</a>
                        </div>
                    </div>
                    <div class="col-md-4 mb-5">
                        <h5 class="text-secondary text-uppercase mb-4">Berlangganan</h5>
                        <form action="">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Masukan Email">
                                <div class="input-group-append">
                                    <button class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                        <h6 class="text-secondary text-uppercase mt-4 mb-3">Follow Us</h6>
                        <div class="d-flex">
                            <a class="btn btn-primary btn-square mr-2" href="#"><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-primary btn-square mr-2" href="#"><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-primary btn-square mr-2" href="#"><i class="fab fa-linkedin-in"></i></a>
                            <a class="btn btn-primary btn-square" href="#"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row border-top mx-xl-5 py-4" style="border-color: rgba(256, 256, 256, .1) !important;">
            <div class="col-md-6 px-xl-0">
                <p class="mb-md-0 text-center text-md-left text-secondary">
                    &copy; <a class="text-primary" href="#">Domain</a>. 2023 All Rights Reserved.
                </p>
            </div>
            <div class="col-md-6 px-xl-0 text-center text-md-right">
                <img class="img-fluid" src="/frontUi/img/payments.png" alt="">
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="/frontUi/lib/easing/easing.min.js"></script>
    <script src="/frontUi/lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Contact Javascript File -->
    <script src="/frontUi/mail/jqBootstrapValidation.min.js"></script>
    <script src="/frontUi/mail/contact.js"></script>

    <!-- Template Javascript -->
    <script src="/frontUi/js/main.js"></script>
</body>
</html>