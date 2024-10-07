<script>
    function toggle(faqNumber) {
        const answer = document.getElementById(`faq-answer-${faqNumber}`);
        const icon = document.getElementById(`faq-icon-${faqNumber}`);

        answer.classList.toggle('hidden');
        icon.classList.toggle('rotate-180');
    }
</script>
