<!DOCTYPE html>
<html lang="en">
    @include('pages/dinas/_partials/head')

    {{-- <body class="authentication-bg"> --}}
    <body style="
        background: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), url({{ asset('storage/images/bengkalis_bg.jpeg') }});
        background-repeat: no-repeat;
        background-size: cover;
    ">

        @yield('content')

        @include('pages/dinas/_partials/script')
        
    </body>
</html>