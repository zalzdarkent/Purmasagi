<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default"
    data-assets-path="../assets/" data-template="vertical-menu-template-free">

<head>
    @include('admin.include.head')
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->

            <aside id="layout-menu" class="layout-menu bg-menu-theme menu menu-vertical">
                <div class="app-brand demo">
                    <img src="{{ asset('assets/img/favicon/logo.svg') }}" class="img-fluid" style="height: 2rem;"
                        alt="Purmasagi Logo" />
                    <span class="app-brand-text demo text-body fw-bolder ms-2"
                        style="text-transform:capitalize !important;">{{ env('APP_NAME') }}</span>

                    <a href="javascript:void(0);"
                        class="layout-menu-toggle menu-link text-large d-block d-xl-none ms-auto">
                        <i class="bx bx-chevron-left bx-sm align-middle"></i>
                    </a>
                </div>

                <div class="menu-inner-shadow"></div>

                @include('admin.include.menu')
            </aside>
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->

                <nav class="layout-navbar container-xxl navbar-expand-xl navbar-detached align-items-center bg-navbar-theme navbar"
                    id="layout-navbar">
                    @include('admin.include.navbar')
                </nav>

                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->

                    @yield('container')
                    <!-- / Content -->

                    <!-- Footer -->
                    <footer class="content-footer bg-footer-theme footer">
                        @include('admin.include.footer')
                    </footer>
                    <!-- / Footer -->

                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    @include('admin.include.script')
    <script>
        document.addEventListener('keydown', function(event) {
            // Cek jika tombol Ctrl dan U ditekan
            if (event.ctrlKey && event.key === 'u') {
                event.preventDefault(); // Mencegah aksi default
                Swal.fire({
                    icon: 'warning',
                    title: 'Oops...',
                    text: 'Akses ke sumber halaman tidak diizinkan!',
                    confirmButtonText: 'OK'
                });
            }
        });

        // Membuat overlay pesan
        const overlay = document.createElement('div');
        overlay.style.position = 'fixed';
        overlay.style.top = '0';
        overlay.style.left = '0';
        overlay.style.width = '100%';
        overlay.style.height = '100%';
        overlay.style.backgroundColor = 'rgba(255, 0, 0, 0.8)'; // Warna overlay merah dengan transparansi
        overlay.style.color = 'white';
        overlay.style.textAlign = 'center';
        overlay.style.padding = '20px';
        overlay.style.zIndex = '9999';
        overlay.style.display = 'none'; // Sembunyikan overlay secara default

        // Menambahkan teks ke overlay
        const message = document.createElement('div');
        message.innerText = 'Hacker jangan menyerang!!';
        message.style.marginTop = '20%'; // Posisikan pesan di tengah
        message.style.fontSize = '24px'; // Ukuran font
        overlay.appendChild(message);
        document.body.appendChild(overlay);

        // Fungsi untuk mendeteksi pembukaan Developer Tools
        function detectDevTools() {
            const threshold = 160; // Threshold untuk tinggi dev tools
            const isDevToolsOpen = window.outerWidth - window.innerWidth > threshold ||
                window.outerHeight - window.innerHeight > threshold;

            // Tampilkan atau sembunyikan overlay
            if (isDevToolsOpen) {
                overlay.style.display = 'flex'; // Tampilkan overlay
                overlay.style.justifyContent = 'center'; // Pusatkan isi overlay
                overlay.style.alignItems = 'center'; // Pusatkan isi overlay
            } else {
                overlay.style.display = 'none'; // Sembunyikan overlay
            }
        }

        // Memeriksa pembukaan Developer Tools setiap 500ms
        setInterval(detectDevTools, 500);
    </script>
    <script>
        console.log('%cBerhenti!', 'color: red; font-size: 30px; font-weight: bold;');
        console.log('%cHacker jangan menyerang!!!', 'color: red; font-size: 30px; font-weight: bold;');
        console.log('%cIni adalah fitur browser yang ditujukan untuk developer. Jika seseorang meminta Anda menyalin-menempel sesuatu di sini untuk mengaktifkan fitur Purmasagi atau "meretas" akun seseorang, itu adalah penipuan dan akan memberinya akses ke akun Purmasagi Anda.', 'font-size: 18px; color: white;');
        console.log('%cLihat https://github.com/zalzdarkent untuk informasi selengkapnya.', 'font-size: 16px; color: white;');
    </script>
</body>

</html>
