<script type="text/javascript">
    // Toggle Pertemuan (Detail Page)
    function toggle(number) {
        const pertemuan = document.getElementById(`pertemuan-${number}`);
        const icon = document.getElementById(`pertemuan-icon-${number}`);

        pertemuan.classList.toggle('hidden');
        icon.classList.toggle('rotate-180');
    }

    const modal = document.getElementById('default-modal');
    const video = document.getElementById('courseVideo');

    // Autoplay
    function playVideo() {
        setTimeout(() => {
            video.play();
        }, 1000);
    }

    // Stop video on background
    function stopVideo() {
        video.pause();
        video.currentTime = 0;
        modal.classList.add('hidden');
    }

    // Scroll Up Button
    window.onscroll = function() {
        const scrollBtn = document.getElementById('scrollUpBtn');
        if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
            scrollBtn.classList.remove('hidden');
        } else {
            scrollBtn.classList.add('hidden');
        }
    };

    // Scroll smooth
    document.getElementById('scrollUpBtn').onclick = function() {
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
