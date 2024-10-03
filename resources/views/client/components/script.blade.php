<script>
    const carousel = document.getElementById('carousel');
    const dots = document.querySelectorAll('.dot');
    const totalSlides = carousel.children.length;
    let currentIndex = 0;

    function moveToSlide(index) {
        carousel.style.transform = `translateX(-${index * 100}%)`;
        updateDots(index);
    }

    function updateDots(index) {
        dots.forEach((dot, dotIndex) => {
            if (dotIndex === index) {
                dot.classList.remove('bg-gray-300');
                dot.classList.add('bg-blue-500');
            } else {
                dot.classList.remove('bg-blue-500');
                dot.classList.add('bg-gray-300');
            }
        });
    }

    setInterval(() => {
        currentIndex = (currentIndex + 1) % totalSlides;
        moveToSlide(currentIndex);
    }, 3000);

    dots.forEach((dot, index) => {
        dot.addEventListener('click', () => {
            currentIndex = index;
            moveToSlide(currentIndex);
        });
    });

    function toggleFAQ(faqNumber) {
        const answer = document.getElementById(`faq-answer-${faqNumber}`);
        const icon = document.getElementById(`faq-icon-${faqNumber}`);

        answer.classList.toggle('hidden');
        icon.classList.toggle('rotate-180');
    }
</script>
