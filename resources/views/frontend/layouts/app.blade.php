<!DOCTYPE html>
<html lang="en">

<head>
    @include('frontend.layouts.partials.head')
</head>

<body>

    <x-Frontend.Navbar></x-Frontend.Navbar>
    <!-- END nav -->

    @yield('content')

    {{-- footer --}}
    <x-Frontend.Footer></x-Frontend.Footer>


    <!-- loader -->
    <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
            <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
            <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4"
                stroke-miterlimit="10" stroke="#F96D00" />
        </svg></div>



    @include('frontend.layouts.partials.scripts')
</body>

</html>
