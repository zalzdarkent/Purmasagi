<script type="text/javascript">
    // Toggle Pertemuan (Detail Page)
    function toggle(number) {
        const pertemuan = document.getElementById(`pertemuan-${number}`);
        const icon = document.getElementById(`pertemuan-icon-${number}`);

        pertemuan.classList.toggle('hidden');
        icon.classList.toggle('rotate-180');
    }

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


    // Scroll smooth
    function scrollToTop() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    };

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
