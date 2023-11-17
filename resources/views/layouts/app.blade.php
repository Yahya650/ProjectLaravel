<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @if (Auth::check())
        <link rel="icon" href="{{ Storage::url(Auth::user()->profileImg) }}" type="image/png">
    @else
        <link rel="icon" href="{{ Storage::url('AcA2LnWL_400x400.jpg') }}" type="image/png">
    @endif


    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">

    <!-- Fonts -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link rel="stylesheet" href="{{ url('/css/style.css') }}">
    {{-- <link rel="stylesheet" href="{{ url('/css&js/bootstrap.min.css') }}"> --}}
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <script src="{{ url('/css&js/jquery-3.6.4.min.js') }}"></script>
    @yield('style')
    <style>
        .colored-toast.swal2-icon-success {
            background-color: #a5dc86 !important;
        }

        .colored-toast.swal2-icon-error {
            background-color: #f27474 !important;
        }

        .colored-toast.swal2-icon-warning {
            background-color: #f8bb86 !important;
        }

        .colored-toast.swal2-icon-info {
            background-color: #3fc3ee !important;
        }

        .colored-toast.swal2-icon-question {
            background-color: #87adbd !important;
        }

        .colored-toast .swal2-title {
            color: white;
        }

        .colored-toast .swal2-close {
            color: white;
        }

        .colored-toast .swal2-html-container {
            color: white;
        }

        .contentAjax {
            text-align: center;
        }

        /* * {
            border: 0;
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        } */

        :root {
            --hue: 223;
            --bg: hsl(var(--hue), 90%, 95%);
            --fg: hsl(var(--hue), 90%, 5%);
            /* font-size: calc(16px + (24 - 16) * (100vw - 320px) / (1280 - 320)); */
        }

        /* body {
            background-color: var(--bg);
            color: var(--fg);
            font: 1em/1.5 sans-serif;
            height: 100vh;
            display: grid;
            place-items: center;
            transition: background-color 0.3s;
        } */

        main {
            padding: 1.5em 0;
        }

        .sp {
            display: block;
            width: 20px;
            height: 20px;
            margin: 0 10px;
        }

        .sp__ring {
            stroke: hsla(var(--hue), 90%, 5%, 0.1);
            transition: stroke 0.3s;
        }

        .sp__worm1,
        .sp__worm2,
        .sp__worm2-1 {
            animation: worm1 5s ease-in infinite;
        }

        .sp__worm1 {
            transform-origin: 64px 64px;
        }

        .sp__worm2,
        .sp__worm2-1 {
            transform-origin: 22px 22px;
        }

        .sp__worm2 {
            animation-name: worm2;
            animation-timing-function: linear;
        }

        .sp__worm2-1 {
            animation-name: worm2-1;
            stroke-dashoffset: 175.92;
        }

        /* Dark theme */
        @media (prefers-color-scheme: dark) {
            :root {
                --bg: hsl(var(--hue), 90%, 5%);
                --fg: hsl(var(--hue), 90%, 95%);
            }

            .sp__ring {
                /* stroke: hsla(var(--hue), 90%, 95%, 0.1); */
            }
        }

        /* Animations */
        @keyframes worm1 {

            from,
            to {
                stroke-dashoffset: 0
            }

            12.5% {
                animation-timing-function: ease-out;
                stroke-dashoffset: -175.91;
            }

            25% {
                animation-timing-function: cubic-bezier(0, 0, 0.43, 1);
                stroke-dashoffset: -307.88;
            }

            50% {
                animation-timing-function: ease-in;
                stroke-dashoffset: -483.8;
            }

            62.5% {
                animation-timing-function: ease-out;
                stroke-dashoffset: -307.88;
            }

            75% {
                animation-timing-function: cubic-bezier(0, 0, 0.43, 1);
                stroke-dashoffset: -175.91;
            }
        }

        @keyframes worm2 {

            from,
            12.5%,
            75%,
            to {
                transform: rotate(0) translate(-42px, 0);
            }

            25%,
            62.5% {
                transform: rotate(0.5turn) translate(-42px, 0);
            }
        }

        @keyframes worm2-1 {
            from {
                stroke-dashoffset: 175.91;
                transform: rotate(0);
            }

            12.5% {
                animation-timing-function: cubic-bezier(0, 0, 0.42, 1);
                stroke-dashoffset: 0;
                transform: rotate(0);
            }

            25% {
                animation-timing-function: linear;
                stroke-dashoffset: 0;
                transform: rotate(1.5turn);
            }

            37.5%,
            50% {
                stroke-dashoffset: -175.91;
                transform: rotate(1.5turn);
            }

            62.5% {
                animation-timing-function: cubic-bezier(0, 0, 0.42, 1);
                stroke-dashoffset: 0;
                transform: rotate(1.5turn);
            }

            75% {
                animation-timing-function: linear;
                stroke-dashoffset: 0;
                transform: rotate(0);
            }

            87.5%,
            to {
                stroke-dashoffset: 175.92;
                transform: rotate(0);
            }
        }
    </style>
</head>

<body style="@yield('bg_color')">
    <svg xmlns="http://www.w3.org/2000/svg" class="d-none">
        <symbol id="check-circle-fill" viewBox="0 0 16 16">
            <path
                d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
        </symbol>
        <symbol id="info-fill" viewBox="0 0 16 16">
            <path
                d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
        </symbol>
        <symbol id="exclamation-triangle-fill" viewBox="0 0 16 16">
            <path
                d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
        </symbol>
    </svg>

    @include('layouts._header')

    @if (session('messageErr'))
        <script>
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "{{ session('messageErr') }}",
                footer: '<strong>Try again, If not working try in other time<strong>'
            });
        </script>
    @endif


    <section class="container">
        <div class="contentAjax">
            @if (session('success'))
                <div class="m-2">
                    <script>
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-right',
                            iconColor: 'white',
                            customClass: {
                                popup: 'colored-toast',
                            },
                            showConfirmButton: false,
                            timer: 4000,
                            timerProgressBar: true,
                        })
                        Toast.fire({
                            icon: 'success',
                            title: "{{ session('success') }}",
                        })
                    </script>
                </div>
            @endif
            @if (Auth::check() && Auth::user()->email_verified_at === null)
                <div class="m-2">
                    <script>
                        Swal.fire({
                            title: "Verify Your Email",
                            text: "Please Verify Your Email if you want try all features",
                            icon: "warning"
                        });
                    </script>
                </div>
            @endif


            @if (session('resent'))
                <div class="alert alert-success" role="alert">
                    {{ __('A fresh verification link has been sent to your email address.') }}
                </div>
            @endif
            @auth
                @if (Auth::user()->email_verified_at == null)
                    <div class="alert alert-warning" role="alert">
                        <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                            @csrf
                            <button type="submit"
                                class="btn btn-link alert-link p-0 m-0 align-baseline">{{ __('Verify your email') }}</button>.
                        </form>
                        For get all features
                    </div>
                @endif
            @endauth
        </div>
        @yield('content')
    </section>

    @include('layouts._footer')

    @yield('script')
    <script>
        $(document).ready(function() {
            document.onclick = () => {
                document.getElementById('suggestions').classList.add('d-none')
            }
            $('#s').on('keyup', function() {
                if ($('#s').val() != "") {
                    $('#suggestions').removeClass('d-none')
                    $('#suggestions ul').empty()
                    $('#loadingCircl').show()
                    $.ajax({
                        type: 'GET',
                        url: '/computers/searchajax',
                        data: {
                            _token: '{{ csrf_token() }}',
                            q: $('#s').val(),
                        },
                        success: function(data) {
                            $('#loadingCircl').hide()

                            $('#suggestions ul').empty()
                            if (data == "") {
                                $('#suggestions ul').append(
                                    `<li> Opse!, We not found this Computer </li>`)
                            }
                            data.forEach(element => {
                                $('#suggestions ul').append(
                                    `<a href="/computers/${btoa(element.id)}"><li>${element.nameComputer}</li></a>`
                                );
                            });
                        },
                        error: function(jqXHR, textStatus, errorThrown) {

                            alert(errorThrown)
                        }
                    });
                } else {
                    $('#suggestions').addClass('d-none')
                    $('#suggestions ul').empty()
                }
            });
        });
    </script>
</body>



</html>
