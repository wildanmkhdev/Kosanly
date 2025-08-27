<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('assets/output.css') }}" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
</head>

<body>
    <div id="Content-Container"
        class="relative flex flex-col w-full max-w-full lg:max-w-none min-h-screen mx-auto lg:mx-0 bg-white overflow-x-hidden">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="{{ asset('assets/js/index.js') }}"></script>
    <script src="js/details.js"></script>
    @yield('scripts')
</body>
