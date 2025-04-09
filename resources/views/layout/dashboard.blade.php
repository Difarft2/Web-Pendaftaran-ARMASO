<!DOCTYPE html>
<html lang="en">

<head>
    @include('partials.header')
    <title>@yield('title', 'Default Title')</title>
    @include('partials.css') <!-- CSS -->
</head>

<body id="page-top">
    @include('sweetalert::alert')
    <div id="wrapper">
        @include('components.sidenav')
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                @include('components.navbar')
                @yield('content')
                @include('components.footer2')
            </div>
        </div>
    </div>
    @include('partials.scripts') <!-- JavaScript -->
</body>

</html>
