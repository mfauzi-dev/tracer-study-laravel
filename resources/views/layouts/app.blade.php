<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tracer Study</title>
    <link rel="icon" href="data:,">

    @include('includes.frontend.style')


    @stack('addon-style')
</head>

<body>
    @include('includes.frontend.navbar')

    @yield('content')

    @include('includes.frontend.script')

    @stack('addon-script')
</body>

</html>
