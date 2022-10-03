<div class="navbar-area">
    <!-- topbar end-->
    <div class="topbar-area">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-7 align-self-center">
                    <div class="topbar-menu text-md-left text-center">
                        <ul class="align-self-center">
                            <li><a href="#">Author</a></li>
                            <li><a href="#">Advertisment</a></li>
                            <li><a href="#">Member</a></li>
                            <li><a href="#">Sitemap</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 col-md-5 mt-2 mt-md-0 text-md-right text-center">
                    <div class="topbar-social">
                        <div class="topbar-date d-none d-lg-inline-block"><i class="fa fa-calendar"></i> Saturday, October 7</div>
                        <ul class="social-area social-area-2">
                            <li><a class="facebook-icon" href="{{route('login-facebook')}}"><i class="fa fa-facebook"></i></a></li>
                            <li><a class="twitter-icon" href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a class="instagram-icon" href="#"><i class="fa fa-instagram"></i></a></li>
                            <li><a class="google-icon" href="{{route('login-google')}}"><i class="fa fa-google-plus"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="relative flex ">
        @if (Route::has('login'))
        <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
            @auth
            <a href="{{ url('/home') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Home</a>
            @else
            <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>

            @if (Route::has('register'))
            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
            @endif
            @endauth
        </div>
        @endif

    </div>



    <!-- navbar start -->
    <nav class="navbar navbar-expand-lg">
        <div class="container nav-container">
            <div class="responsive-mobile-menu">
                <div class="logo d-lg-none d-block">
                    <a class="main-logo" href="index.html"><img src="{{asset('img/logo.png')}}" alt="img"></a>
                </div>
                <button class="menu toggle-btn d-block d-lg-none" data-target="#nextpage_main_menu" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="icon-left"></span>
                    <span class="icon-right"></span>
                </button>
            </div>
            <div class="nav-right-part nav-right-part-mobile">
                <a class="search header-search" href="#"><i class="fa fa-search"></i></a>
            </div>
            <div class="collapse navbar-collapse" id="nextpage_main_menu">
                <ul class="navbar-nav menu-open">
                    <li class="current-menu-item">
                        <a href="/">Home</a>
                    </li>
                    <li class="current-menu-item">
                        <a href="#trending">Category Featured</a>
                    </li>

                    <li class="current-menu-item">
                        <a href="#grid">Posts New</a>
                    </li>

                </ul>
            </div>
            <div class="nav-right-part nav-right-part-desktop" style="margin-right: 500px;">
                <div class="menu-search-inner">
                    <input type="text" class="input-search-ajax" placeholder="Search For">
                    <button type="submit" class="submit-btn"><i class="fa fa-search"></i></button>
                </div>


                <div class="search-ajax-result">

                </div>

            </div>

        </div>
    </nav>
</div>