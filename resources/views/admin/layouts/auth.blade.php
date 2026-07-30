<!doctype html>
<html class="no-js" lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Iw Portfolio:: @yield('title')</title>
    <!-- <link rel="icon" href="{{ url('/') }}/public/admin/dist/assets/images/Logo_lafit.png" type="image/x-icon"> -->
    <link rel="icon" href="{{ url('/') }}/public/marhabafashion.png" type="image/x-icon">

    @stack('styles')

    <!-- project css file  -->
    <link rel="stylesheet" href="{!! asset('public/admin/ebazar.style.min.css') !!}">

    @stack('custom_styles')
</head>

<body>
    <div id="ebazar-layout" class="theme-blue">

        <!-- main body area -->
        <div class="main p-2 py-3 p-xl-5 ">

            <!-- Body: Body -->
            <div class="body d-flex p-0 p-xl-5">
                @yield('content')
            </div>

        </div>

    </div>

    <!-- Jquery Core Js -->
    <script src="{!! asset('public/admin/dist/assets/bundles/libscripts.bundle.js') !!}"></script>
    @stack('scripts')
    @stack('custom_scripts')
</body>

</html>