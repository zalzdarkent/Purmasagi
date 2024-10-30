<script type="text/javascript">
    // Toggle Pertemuan (Detail Page)
    function toggle(number) {
        const pertemuan = document.getElementById(`pertemuan-${number}`);
        const icon = document.getElementById(`pertemuan-icon-${number}`);

        pertemuan.classList.toggle('hidden');
        icon.classList.toggle('rotate-180');
    }

    // Show Modal in Content Page
    function showMedia(filePath, type) {
        const modal = document.getElementById('default-modal');
        const mediaContent = document.getElementById('media-content');

        modal.classList.add('hidden');

        if (type === 'video') {
            mediaContent.innerHTML = `
                <video id="courseVideo" class="w-full rounded-lg border bg-gray-200" controls autoplay>
                    <source src="${filePath}" type="video/mp4">
                    Mohon maaf, video tidak dapat ditampilkan. Silakan coba lagi nanti.
                </video>
                <a href="${filePath}" download class="mt-4 flex rounded-lg bg-indigo-600 px-5 py-2.5 text-center text-xs md:text-sm font-medium text-white hover:bg-indigo-500 focus:outline-none focus:ring-4 focus:ring-indigo-300 w-fit">
                    Unduh Video
                </a>
            `;

        } else if (type === 'image') {
            mediaContent.innerHTML = `
                <img src="${filePath}" class="max-w-full h-auto rounded-lg shadow-lg" alt="Image" />
                <a href="${filePath}" download class="mt-4 flex rounded-lg bg-indigo-600 px-5 py-2.5 text-center text-xs md:text-sm font-medium text-white hover:bg-indigo-500 focus:outline-none focus:ring-4 focus:ring-indigo-300 w-fit">
                    Unduh Gambar
                </a>
            `;
        }
    }

    // Stop video on background
    function stopVideo() {
        const video = document.getElementById('courseVideo');

        video.pause();
        video.currentTime = 0;
    }

    // Scroll smooth
    function scrollToTop() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    };

    // Scroll Up Button (Home)
    if (window.location.pathname === '/') {
        window.onscroll = function() {
            const scrollBtn = document.getElementById('scrollUpBtn');
            if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
                scrollBtn.classList.remove('hidden');
            } else {
                scrollBtn.classList.add('hidden');
            }
        };
    } else {
        window.onscroll = null;
    }

    // Search course
    if (window.location.pathname === '/courses') {
        document.getElementById('search').addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            const courses = document.querySelectorAll('.course-card');

            courses.forEach(course => {
                const title = course.querySelector('h5').innerText.toLowerCase();
                const description = course.querySelector('p').innerText.toLowerCase();

                if (title.includes(searchTerm) || description.includes(searchTerm)) {
                    course.style.display = '';
                } else {
                    course.style.display = 'none';
                }
            });
        });
    }

    // Show & Hide Password (Register and Profile Page)
    if (window.location.pathname === '/profile' || window.location.pathname === '/register') {
        const passwordInput = document.getElementById('password');
        const togglePassword = document.getElementById('togglePassword');
        const eye = document.getElementById('eye');
        const eyeSlash = document.getElementById('eyeSlash');

        togglePassword.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            eye.classList.toggle('hidden');
            eyeSlash.classList.toggle('hidden');
        });

        const passwordConfirmationInput = document.getElementById('password_confirmation');
        const toggleConfirmPassword = document.getElementById('toggleConfirmPassword');
        const eyeConfirm = document.getElementById('eyeConfirm');
        const eyeSlashConfirm = document.getElementById('eyeSlashConfirm');

        toggleConfirmPassword.addEventListener('click', function() {
            const type = passwordConfirmationInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordConfirmationInput.setAttribute('type', type);
            eyeConfirm.classList.toggle('hidden');
            eyeSlashConfirm.classList.toggle('hidden');
        });

        function validatePassword() {
            const password = document.getElementById('password').value;
            const passwordError = document.getElementById('passwordError');
            if (password.length < 6) {
                passwordError.textContent = 'Password harus memiliki minimal 8 karakter.';
            } else {
                passwordError.textContent = '';
            }
        }

        function validatePasswordConfirmation() {
            const password = document.getElementById('password').value;
            const passwordConfirmation = document.getElementById('password_confirmation').value;
            const passwordConfirmationError = document.getElementById('passwordConfirmationError');
            if (password !== passwordConfirmation) {
                passwordConfirmationError.textContent = 'Konfirmasi password tidak sesuai.';
            } else {
                passwordConfirmationError.textContent = '';
            }
        }
    }

    // Show & Hide Password (Login Page)
    if (window.location.pathname === '/login/siswa') {

        const passwordInput = document.getElementById('password');
        const togglePassword = document.getElementById('togglePassword');
        const eye = document.getElementById('eye');
        const eyeSlash = document.getElementById('eyeSlash');

        togglePassword.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            eye.classList.toggle('hidden');
            eyeSlash.classList.toggle('hidden');
        });
    }

    // TNC Modal (Register Page)
    if (window.location.pathname === '/register') {
        const modalToggle = document.querySelector('[data-modal-toggle="tnc-modal"]');
        const modal = document.getElementById('tnc-modal');

        modalToggle.addEventListener('click', () => {
            const isHidden = modal.getAttribute('aria-hidden') === 'true';
            modal.setAttribute('aria-hidden', !isHidden);
            modal.classList.toggle('hidden', isHidden);
            modal.classList.toggle('flex', isHidden);
        });

        // Close modal on button click
        modal.querySelectorAll('[data-modal-hide]').forEach(button => {
            button.addEventListener('click', () => {
                modal.setAttribute('aria-hidden', 'true');
                modal.classList.add('hidden');
            });
        });
    }

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

    // var Tawk_API = Tawk_API || {},
    //     Tawk_LoadStart = new Date();
    // (function() {
    //     var s1 = document.createElement("script"),
    //         s0 = document.getElementsByTagName("script")[0];
    //     s1.async = true;
    //     s1.src = 'https://embed.tawk.to/671192512480f5b4f58f3f72/1iaeb68rs';
    //     s1.charset = 'UTF-8';
    //     s1.setAttribute('crossorigin', '*');
    //     s0.parentNode.insertBefore(s1, s0);
    // })();
</script>
<!--Start of Tawk.to Script-->
{{-- <script type="text/javascript">
    var Tawk_API = Tawk_API || {},
        Tawk_LoadStart = new Date();
    (function() {
        var s1 = document.createElement("script"),
            s0 = document.getElementsByTagName("script")[0];
        s1.async = true;
        s1.src = 'https://embed.tawk.to/671192512480f5b4f58f3f72/1iaea7411';
        s1.charset = 'UTF-8';
        s1.setAttribute('crossorigin', '*');
        s0.parentNode.insertBefore(s1, s0);
    })();
</script> --}}
<!--End of Tawk.to Script-->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
