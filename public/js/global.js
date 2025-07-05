
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



//User Dashboard Menu Items

let orderItems = {}; // Array to keep track the order

//Add item to order
function addToOrder(productID) 
{

    const product = window.products[productID];
    if (!product) return;

    if (orderItems[productID]) 
    {
        orderItems[productID].quantity += 1;
    } else 
    {
        orderItems[productID] = { ...product, quantity: 1 };
    }

    updateOrderList();
}


//Update the Order List
function updateOrderList() {
    const orderListContainer = document.getElementById('order-items');
    orderListContainer.innerHTML = '';

    let subTotal = 0;

    Object.values(orderItems).forEach(item => {
        const itemTotal = item.quantity * item.price;
        subTotal += itemTotal;

        const orderItem = document.createElement('div');
        orderItem.className = 'flex justify-between items-center border-b border-gray-200 pb-2';

        orderItem.innerHTML = `
            <div>
                <p class="font-semibold">${item.name}</p>
                <p class="text-sm text-gray-500">₱${item.price} x ${item.quantity}</p>
            </div>
            <div class="flex items-center gap-2">
                <button class="text-sm bg-gray-200 px-2 rounded" onclick="decreaseQuantity(${item.id})">-</button>
                <span>${item.quantity}</span>
                <button class="text-sm bg-gray-200 px-2 rounded" onclick="increaseQuantity(${item.id})">+</button>
                <button class="text-red-500 ml-2" onclick="removeItem(${item.id})">&times;</button>
            </div>
        `;

        orderListContainer.appendChild(orderItem);
    });

    document.getElementById('subtotal').textContent = `₱ ${subTotal.toFixed(2)}`;

    // Enable/Disable buttons
    const hasItems = Object.keys(orderItems).length > 0;
    document.getElementById('review-order-btn').disabled = !hasItems;
    document.getElementById('place-order-btn').disabled = !hasItems;
    document.getElementById('clear-order-btn').disabled = !hasItems;
}


//Increase Quantity
function increaseQuantity(productID) {
    orderItems[productID].quantity += 1;
    updateOrderList();
}

//Decrease Quantity
function decreaseQuantity(productID) {
    if (orderItems[productID].quantity > 1) {
        orderItems[productID].quantity -= 1;
    } else {
        delete orderItems[productID];
    }
    updateOrderList();
}


//Remove Items
function removeItem(productID) {
    delete orderItems[productID];
    updateOrderList();
}

//Review Modal
document.addEventListener('DOMContentLoaded', function () {

    //Clear Order Button
    document.getElementById('clear-order-btn').addEventListener('click', function() {
        orderItems = {};
        updateOrderList();
    });


    //Revie Modal Opens
    document.getElementById('review-order-btn').addEventListener('click', function () {
        const reviewItemsContainer = document.getElementById('review-items');
        reviewItemsContainer.innerHTML = '';
        
        let total = 0;

        Object.values(orderItems).forEach(item => {
            const itemTotal = item.quantity * item.price;
            total += itemTotal;

            const itemDiv = document.createElement('div');
            itemDiv.className = 'flex justify-between mb-2';

            itemDiv.innerHTML = `
                <span>${item.name} x ${item.quantity}</span>
                <span>₱${itemTotal.toFixed(2)}</span>
            `;
            reviewItemsContainer.appendChild(itemDiv);
        });

        document.getElementById('reviewTotal').textContent = `₱${total.toFixed(2)}`;
        document.getElementById('review-modal').classList.remove('hidden');
    });

    document.getElementById('cancelReviewBtn').addEventListener('click', function () {
        document.getElementById('review-modal').classList.add('hidden');
    });

    document.getElementById('confirm-order-btn').addEventListener('click', function () {
        alert("Order confirmed!");
        orderItems = {};
        updateOrderList();
        document.getElementById('review-modal').classList.add('hidden');
    });
});


