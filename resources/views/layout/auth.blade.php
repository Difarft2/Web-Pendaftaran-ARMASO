<!DOCTYPE html>
<html lang="en">

<head>
    @include('partials.header')
    <title>@yield('title')</title>
    @include('partials.css') <!-- CSS -->
</head>

<body class="auth">
    @include('sweetalert::alert')
    @include('components.logo')
    <main>
        @yield('content')
    </main>

    @include('components.footer')

    @include('partials.scripts') <!-- JavaScript -->
</body>

</html>
