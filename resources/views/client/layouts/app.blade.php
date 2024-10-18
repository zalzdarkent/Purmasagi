<!DOCTYPE html>
<html class="h-full bg-white">

    <head>
        @include('client.components.head')
    </head>

    <body class="flex h-full min-h-screen flex-col bg-white">
        @include('client.components.navbar')

        <main class="flex-grow pt-16">
            @yield('container')
        </main>

        @include('client.components.footer')
        @include('client.components.script')
    </body>

</html>
