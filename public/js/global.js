
//Tailwind CSS Customize Color Theme
tailwind.config = {
    theme: {
        extend: {
            colors: {
                'custom-gray': '#1f1f1f',
                'custom-yellow': '#E9BB3F',
                'custom-yellow-dark': '#FDD835',
                'custom-yellow-darker': '#f7ca00ff',
                'custom-yellow-light': '#fcf2c8ff',
                'custom-light-gray': '#F6F6F6',
                'custom-dark-gray': '#979797',
            }
        }
    }
}

// Product Category Button
document.addEventListener('DOMContentLoaded', function () {
    // Product Category Button
    document.querySelectorAll('.category-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            // Remove active state from all buttons
            document.querySelectorAll('.category-btn').forEach(b => {
                b.classList.remove('bg-custom-yellow', 'text-white');
            });

            // Add active state to the clicked button
            this.classList.add('bg-custom-yellow', 'text-white');

            // Get clicked category
            const selectedCategory = this.getAttribute('data-category');

            // Loop through all product cards
            document.querySelectorAll('.product-card').forEach(card => {
                const productCategory = card.getAttribute('data-category');

                // Show or hide product based on match
                if (selectedCategory === 'all' || selectedCategory === productCategory) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });
});