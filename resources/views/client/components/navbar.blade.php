<nav class="fixed start-0 top-0 z-20 w-full border-b border-gray-200 bg-white dark:border-gray-600 dark:bg-gray-900">
    <div class="mx-auto flex max-w-screen-xl flex-wrap items-center justify-between p-4">
        <a href="/" class="flex items-center space-x-3 rtl:space-x-reverse">
            <img src="../assets/img/favicon/client-icon.svg" class="h-8" alt="Purmasagi Logo" />
        </a>
        <div class="flex space-x-3 rtl:space-x-reverse md:order-2 md:space-x-0">
            {{-- User icon --}}
            {{-- <button type="button"
                class="flex rounded-full bg-gray-800 text-sm focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600 md:me-0"
                id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown"
                data-dropdown-placement="bottom">
                <span class="sr-only">Open user menu</span>
                <img class="h-8 w-8 rounded-full" src="" alt="user photo">
            </button> --}}
            <div class="space-x-3 pt-2 md:pt-0">
                <a href="/login"
                    class="rounded-md px-3.5 py-2.5 text-center text-sm font-semibold text-indigo-600 shadow-sm outline outline-1 outline-indigo-600 hover:bg-gray-100 focus:outline-none focus:ring-4 focus:ring-indigo-300">
                    Masuk
                </a>
                <a href="/register"
                    class="rounded-md bg-indigo-600 px-3.5 py-2.5 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus:outline-none focus:ring-4 focus:ring-indigo-300">
                    Daftar
                </a>
            </div>

            {{-- Dropdown menu --}}
            <div class="z-50 my-4 hidden list-none divide-y divide-gray-100 rounded-lg bg-white text-base shadow dark:divide-gray-600 dark:bg-gray-700"
                id="user-dropdown">
                <div class="px-4 py-3">
                    <span class="block text-sm text-gray-900 dark:text-white">Bonnie Green</span>
                    <span class="block truncate text-sm text-gray-500 dark:text-gray-400">name@flowbite.com</span>
                </div>
                <ul class="py-2" aria-labelledby="user-menu-button">
                    <li>
                        <a href="#"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-600 dark:hover:text-white">Profil</a>
                    </li>
                    <li>
                        <a href="#" -
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-600 dark:hover:text-white">Keluar
                        </a>
                    </li>
                </ul>
            </div>
            {{-- Hamburger --}}
            <button data-collapse-toggle="navbar-sticky" type="button"
                class="inline-flex h-10 w-10 items-center justify-center rounded-lg p-2 text-sm text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600 md:hidden"
                aria-controls="navbar-sticky" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <svg class="h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 17 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M1 1h15M1 7h15M1 13h15" />
                </svg>
            </button>
        </div>

        {{-- Navigation --}}
        <div class="hidden w-full items-center justify-between md:order-1 md:flex md:w-auto" id="navbar-sticky">
            <ul
                class="mt-4 flex flex-col gap-y-4 rounded-lg border border-gray-100 bg-gray-50 p-4 font-medium rtl:space-x-reverse dark:border-gray-700 dark:bg-gray-800 md:mt-0 md:flex-row md:space-x-8 md:border-0 md:bg-white md:p-0 md:dark:bg-gray-900">
                <li>
                    <a href="/"
                        class="{{ request()->fullUrlIs(url('/')) ? 'text-indigo-600' : 'text-gray-900' }} block hover:underline"
                        aria-current="page">Beranda</a>
                </li>
                <li>
                    <a href="/courses"
                        class="{{ request()->fullUrlIs(url('/courses')) ? 'text-indigo-600' : 'text-gray-900' }} block hover:underline">Kelas</a>
                </li>
                <li>
                    <a href="/teachers"
                        class="{{ request()->fullUrlIs(url('/teachers')) ? 'text-indigo-600' : 'text-gray-900' }} block hover:underline">Guru</a>
                </li>
                <li>
                    <a href="/activities"
                        class="{{ request()->fullUrlIs(url('/activities')) ? 'text-indigo-600' : 'text-gray-900' }} block hover:underline">Aktivitas</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
