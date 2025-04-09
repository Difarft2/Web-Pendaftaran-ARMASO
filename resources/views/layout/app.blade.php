<!DOCTYPE html>
<html lang="en">

<head>
    @include('partials.header')
    <title>@yield('title', 'Default Title')</title>
    @include('partials.css')
</head>

<body>
    <main>
        @yield('content')
    </main>

    @include('partials.scripts')
</body>

</html>
