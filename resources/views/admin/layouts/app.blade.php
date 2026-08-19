<!doctype html>
<html class="no-js" lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Iw Portfolio:: @yield('title')</title>
    

    @stack('styles')

    <!-- project css file  -->
   
    @include('admin.includes.headerUrl')
    @stack('custom_styles')
</head>

<body>
    <div id="ebazar-layout" class="theme-blue">

        @auth
        @if(Auth::user()->role == 1)
        @include('admin.includes.sidebar')
        @endif
        @endauth
        <!-- main body area -->
        <div class="main px-lg-4 px-md-4">


            @include('admin.includes.header')

            <!-- Body: Body -->
            <div class="body d-flex py-3">
                @yield('content')
            </div>

            @yield('footer')

           

            @stack('modals')

        </div>

    </div>

    <!-- Jquery Core Js -->
    <script src="{!! asset('public/admin/assets/bundles/libscripts.bundle.js') !!}"></script>
    @stack('scripts')
    <!-- Jquery Page Js -->
    <script src="{!! asset('public/admin/assets/js/template.js') !!}"></script>
    @stack('custom_scripts')
</body>

</html>