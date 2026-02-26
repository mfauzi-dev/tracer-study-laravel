<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Tracer Study</title>
    <link rel="icon" href="data:,">

    <!-- General CSS Files -->
    @include('includes.backend.style')

    @stack('addon-style')

    <!-- Start GA -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-94034622-3');
    </script>
    <!-- /END GA -->
</head>

<body>
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            @include('includes.backend.navbar')

            @include('includes.backend.sidebar.' . Auth::user()->role_as)

            <!-- Main Content -->

            <div class="main-content">
                <section class="section">

                    @yield('content')

                </section>
            </div>
            @include('includes.backend.footer')
        </div>
    </div>

    <!-- General JS Scripts -->
    @include('includes.backend.script')
</body>

</html>
