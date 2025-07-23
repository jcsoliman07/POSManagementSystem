//Open Modal Form Function
function toggleModal(modalId) {
    const modal = document.getElementById(modalId);
    if (!modal) return;

    // If it's hidden (opacity-0), show it
    if (modal.classList.contains('opacity-0')) {
        modal.classList.remove('opacity-0', 'pointer-events-none');
        modal.classList.add('opacity-100');
    } 
    // Otherwise, hide it
    else {
        modal.classList.remove('opacity-100');
        modal.classList.add('opacity-0', 'pointer-events-none');
    }
}
//Close Modal Form Function
function closeModal(modalId) {
    const modal = document.getElementById(modalId);
    if (!modal) return;

    modal.classList.remove('opacity-100');
    modal.classList.add('opacity-0', 'pointer-events-none');
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
