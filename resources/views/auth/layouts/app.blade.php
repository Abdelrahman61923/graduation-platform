<!doctype html>
<html lang="{{ app()->getLocale() }}"
    dir = "{{ app()->getLocale() == "ar" ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }} | @yield('title')</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('assets/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/webfonts') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/bootstrap.css') }}">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/select2.css') }}">
    @yield('styles')
</head>
<style>
    .alert-success {
        color: #3c763d;
        background-color: #dff0d8;
        border-color: #d6e9c6;
        margin-bottom: 14px;
        padding: 10px;
    }

    body {
        background-image: url(../assets/images/logo/un.jpg);
        background-size: cover;
        background-position: center;
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
    }

    .circle::before {
        content: "";
        position: absolute;
        background-color: #FFFFFF;
        width: 170px;
        height: 150px;
        border-radius: 50%;
        top: 140px;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: -1;
    }

    form img {
        width: 180px;
        margin: -40px 0px 0px 40px;
        margin-bottom: 10px;
    }
</style>

<body>
    @yield('content')

    <script src="{{ asset('assets/js/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/select2/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/js/select2/select2-custom.js') }}"></script>
    <script src="{{ asset('assets/js/Auth/master.js') }}"></script>
    <script>
        function password_show_hide(field_id, show_eye_id, hide_eye_id) {
            var x = document.getElementById(field_id);
            var show_eye = document.getElementById(show_eye_id);
            var hide_eye = document.getElementById(hide_eye_id);
            hide_eye.classList.remove("d-none");
            if (x.type === "password") {
                x.type = "text";
                show_eye.style.display = "none";
                hide_eye.style.display = "block";
            } else {
                x.type = "password";
                show_eye.style.display = "block";
                hide_eye.style.display = "none";
            }
        }
    </script>
</body>

</html>
