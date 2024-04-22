<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

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
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
    <link href="{{ asset('css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('webfonts') }}" rel="stylesheet">
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
        background-image: url(../images/un.jpg);
        background-size: cover;
        background-position: center;
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
    }

    .container {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin-top: 70px;
        padding-top: 128px;
        position: relative;
        width: 440px;
        /* Adjust the width as per your preference */
        max-width: 60%;
        /* Ensure it doesn't overflow on smaller screens */
        height: auto;
        /* Allow height to adjust based on content */
        background-color: #ffffff;
        border: 2px solid #ccc;
        /* Added border */
        border-radius: 15px;
        /* Added border-radius */
    }

    .my-form input:focus {
        outline: none;
    }

    .circle {
        position: absolute;
        top: -50px;
        left: 50%;
        transform: translateX(-50%);
        background-color: #ffffff;
        width: 130px;
        height: 130px;
        border-radius: 50%;
        z-index: 100;
    }

    .circle img {
        width: 100px;
        height: 100px;
        border-radius: 5px;
        margin-left: 25px;
        margin-top: 10px;
        left: 50%;
    }

    .name {
        text-align: center;
        position: absolute;
        top: 50px;
        color: #fff;
        font-size: 25px;
        font-weight: bold;
    }

    .my-form .validationMessage {
        margin-bottom: 15px;
        color: red;
        font-size: 16px;
        margin-top: 10px;
    }

    .error-message {
        color: red;
        font-size: 0.8em;
        margin-top: 5px;
        display: none;
    }

    .form-group {
        margin-bottom: 1rem;
    }

    .form-control {
        width: 100%;
    }

    .my-form .form-outline {
        margin-bottom: 25px;
        /* Add space between input fields */
        margin-top: -29px;
        /* Move the input fields above by 29px */
    }

    /* Add hover effect for buttons */
    .login-button:hover {
        background-color: #007bff;
        color: #fff;
    }

    /* Add style for forgot password link */
    .admin-link {
        color: #007bff;
        text-decoration: none;
        font-size: 14px;
    }

    .admin-link:hover {
        text-decoration: underline;
    }

    /* Style for register link */
    .dont-have-account a {
        color: #007bff;
        text-decoration: none;
        font-weight: bold;
    }

    .dont-have-account a:hover {
        text-decoration: underline;
    }

    /* Style the submit button */
    .login-button {
        width: 100%;
        padding: 10px 0;
        border: none;
        border-radius: 5px;
        background-color: #007bff;
        color: #fff;
        font-size: 16px;
        cursor: pointer;
    }

    /* Style the forgot password link */
    .forgot-password {
        text-align: right;
        font-size: 14px;
        margin-top: 10px;
    }

    /* Style the register link */
    .register-link {
        text-align: center;
        font-size: 14px;
        margin-top: 20px;
    }

    /* Add margin to bottom of register link */
    .register-link a {
        margin-left: 5px;
    }

    /* Adjust the position of the name */
    .name {
        top: 15px;
        font-size: 20px;
    }

    /* Adjust the position of the validation message */
    .my-form .validationMessage {
        font-size: 14px;
    }

    /* Media query for mobile devices */
    @media (max-width: 768px) {
        .container {
            width: 90%;
            /* Adjust the width for mobile devices */
            max-width: unset;
            /* Remove max-width for mobile devices */
        }
    }
</style>

<body>
    @yield('content')

    {{-- @include('sweetalert::alert') --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}
    <script src="{{ asset('assets/js/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/select2/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/js/select2/select2-custom.js') }}"></script>
    <script src="{{ asset('assets/js/Auth/master.js') }}"></script>
</body>

</html>
