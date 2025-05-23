document.querySelectorAll('.rating-stars .star').forEach(star => {
        star.addEventListener('click', function () {
            const value = this.getAttribute('data-value');
            document.getElementById('rating-value').value = value;

            const stars = this.parentElement.querySelectorAll('.star');
            stars.forEach(s => {
                s.classList.remove('selected');
                if (s.getAttribute('data-value') <= value) {
                    s.classList.add('selected');
                }
            });
        });
    });