<!DOCTYPE html>
<html lang="en">

    <head>
        @include('client.components.head')
    </head>

    <body class="flex min-h-screen flex-col bg-white">
        @include('client.components.navbar')

        <main class="flex-grow">
            @yield('container')
        </main>

        @include('client.components.footer')
        @include('client.components.script')
    </body>

</html>
