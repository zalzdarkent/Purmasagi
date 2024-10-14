<script>
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
</script>
