<!DOCTYPE html>
<html class="h-full bg-white">

    <head>
        @include('client.components.head')
    </head>

    <body class="flex h-full min-h-screen flex-col bg-white">
        @include('client.components.navbar')

        <main class="flex-grow">
            @yield('container')
        </main>

        @include('client.components.footer')
        @include('client.components.script')
        <!--Start of Tawk.to Script-->

<!--End of Tawk.to Script-->
    </body>

</html>
