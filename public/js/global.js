//Tailwind CSS Customize Color Theme
tailwind.config = {
    theme: {
        extend: {
            colors: {
                'custom-gray': '#1f1f1f',
                'custom-yellow': '#E9BB3F',
                'custom-light-gray': '#F6F6F6',
                'custom-dark-gray': '#979797',
            }
        }
    }
}

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

//Update
// function openModalCategory(modalId) {
//     const modal = document.getElementById(modalId);
//     if (modal) {
//         modal.classList.remove('opacity-0', 'pointer-events-none');
//         modal.classList.add('opacity-100', 'pointer-events-auto');
//     }
// }

// function closeModalCategory(modalId) {
//     const modal = document.getElementById(modalId);
//     if (modal) {
//         modal.classList.add('opacity-0', 'pointer-events-none');
//         modal.classList.remove('opacity-100', 'pointer-events-auto');
//     }
// }

//Destroy
function openModalDestroy(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {
        modal.classList.remove('opacity-0', 'pointer-events-none');
        modal.classList.add('opacity-100', 'pointer-events-auto');
    }
}

function closeModalDestroy(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {
        modal.classList.add('opacity-0', 'pointer-events-none');
        modal.classList.remove('opacity-100', 'pointer-events-auto');
    }
}
// 

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

// function toggleEditModal() {
//     const modal = document.getElementById('add-new-modal');
//     modal.classList.remove('opacity-0', 'pointer-events-none');
//     modal.classList.add('opacity-100');

//     document.getElementById('category-name-input').value = name;
//     document.getElementById('edit-form').action = `/category/${id}`;
//     document.getElementById('_method').value = 'PUT';
// }

//  // Toggle sidebar on mobile
// document.getElementById('toggleSidebar').addEventListener('click', function() {
//     document.querySelector('.sidebar').classList.toggle('hidden');
//     document.querySelector('.content-area').classList.toggle('ml-64');
// });

// // Set active state for sidebar items
// document.querySelectorAll('.sidebar-item').forEach(item => {
//     item.addEventListener('click', function() {
//         document.querySelectorAll('.sidebar-item').forEach(i => i.classList.remove('active'));
//         this.classList.add('active');
//     });
// });