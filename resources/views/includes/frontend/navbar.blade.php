<div class="container">
    <nav class="row navbar navbar-expand-lg navbar-light bg-white">
        <a class="navbar-brand" href="#">
            <img src="{{ asset('frontend/image/logo2.png') }}" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto mr-3">
                <li class="nav-item mx-md-2">
                    <a class="nav-link active" href="#">Home</a>
                </li>
                <li class="nav-item mx-md-2">
                    <a class="nav-link" href="#location">Location</a>
                </li>
                <li class="nav-item mx-md-2">
                    <a class="nav-link" href="#about">About</a>
                </li>

                <!-- mobile button -->
                <a href="{{ route('login') }}" class="form-inline d-sm-block d-md-none">
                    <button class="btn btn-login my-2 my-sm-0">
                        Masuk
                    </button>
                </a>

                <!-- Desktop Button -->
                <a href="{{ route('login') }}" class="form-inline my-2 my-lg-0 d-none d-md-block">
                    <button class="btn btn-login btn-navbar-right my-2 my-sm-0 px-4">
                        Login
                    </button>
                </a>
            </ul>
        </div>
    </nav>
</div>
