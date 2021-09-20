<!DOCTYPE html>
<html lang="en">
    @include('fixed.header')
    <body>
        @include('fixed.nav')
        @yield('content')
        @include('fixed.footer')
        @include('fixed.scripts')
    </body>
</html>
