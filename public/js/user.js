//User Dashboard Menu Items
let orderItems = {}; // Array to keep track the order

//Add item to order
function addToOrder(productID) {
    console.log('Adding product ID:', productID);
    const product = window.products[productID];
    console.log('Fetched product:', product);

    if (!product) return;

    if (orderItems[productID]) {
        orderItems[productID].quantity += 1;
    } else {
        orderItems[productID] = { ...product, quantity: 1 };
    }

    console.log('Current orderItems:', orderItems);
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
                <button class="text-sm bg-red-500 text-white px-2 rounded" onclick="removeItem(${item.id})">×</button>
            </div>
        `;

        orderListContainer.appendChild(orderItem);
    });

    document.getElementById('subtotal').textContent = `₱ ${subTotal.toFixed(2)}`;

    // Enable or disable buttons
    const hasItems = Object.keys(orderItems).length > 0;
    document.getElementById('review-order-btn').disabled = !hasItems;
    document.getElementById('clear-order-btn').disabled = !hasItems;
}

//Remove Item
function removeItem(id) {
    delete orderItems[id];
    updateOrderList();
}

//Increase Quantity
function increaseQuantity(productID) {
    if (orderItems[productID]) {
        orderItems[productID].quantity += 1;
        updateOrderList();
    }
}
//Decrease Quantity
function decreaseQuantity(productID) {
    if (orderItems[productID]) {
        orderItems[productID].quantity -= 1;
        if (orderItems[productID].quantity <= 0) {
            delete orderItems[productID];
        }
        updateOrderList();
    }
}


//Remove Items
function removeItem(productID) {
    delete orderItems[productID];
    updateOrderList();
}

document.getElementById('clear-order-btn').addEventListener('click', function () {
    orderItems = {};
    updateOrderList();
});


//Function to update Confirm Button if Payment Method and Customer name is not Empty
const paymentMethodInput = document.getElementById('paymentMethodInput');
const customerName = document.getElementById('customerName');
const confirmBtn = document.getElementById('confirm-order-btn');

function updateConfirmBtn(){
    const paymentMethodInputValue = paymentMethodInput.value.trim();
    const customerNameValue = customerName.value.trim();

    const btnDisable = (paymentMethodInputValue === '' || customerNameValue === '');

    confirmBtn.disabled = btnDisable;

    if (btnDisable) {

        confirmBtn.classList.remove('bg-custom-yellow', 'hover:bg-custom-yellow-dark', 'focus:ring-custom-yellow-dark');
        confirmBtn.classList.add('bg-gray-400', 'cursor-not-allowed');

    }else{
        confirmBtn.classList.remove('bg-gray-400', 'cursor-not-allowed');
        confirmBtn.classList.add('bg-custom-yellow', 'hover:bg-custom-yellow-dark', 'focus:ring-custom-yellow-dark');
    }

}

paymentMethodInput.addEventListener('input', updateConfirmBtn);
customerName.addEventListener('input', updateConfirmBtn);


//Review Modal
document.getElementById('review-order-btn').addEventListener('click', function () {
    const reviewContainer = document.getElementById('review-items');
    const orderDataInput = document.getElementById('orderDataInput');
    const reviewTotal = document.getElementById('reviewTotal');

    reviewContainer.innerHTML = '';
    let total = 0;
    const orderData = [];

    Object.values(orderItems).forEach(item => {
        const itemTotal = item.quantity * item.price;
        total += itemTotal;

        const itemElement = document.createElement('div');
        itemElement.className = 'flex py-4';
        itemElement.innerHTML = `
            <span class="hidden"> ${item.id}</span>
            <span class="flex-1">${item.name}</span>
            <span class="flex-1 text-center">x ${item.quantity}</span>
            <span class="flex-1 text-right">₱${itemTotal.toFixed(2)}</span>
        `;

        reviewContainer.appendChild(itemElement); //Append the order items

        orderData.push({ product_id: item.id, quantity: item.quantity, subtotal: itemTotal });
    });

    reviewTotal.textContent = `₱${total.toFixed(2)}`;

    orderDataInput.value = JSON.stringify(orderData); //Order items only

    document.getElementById('review-modal').classList.remove('hidden');
});

//Cancel Review Modal
document.getElementById('cancelReviewBtn').addEventListener('click', function () {
    document.getElementById('review-modal').classList.add('hidden');
});

//Payment Method Toggle active
function togglePayment(option){
    const paymentOptions = document.querySelectorAll('.payment-option');

    //Store selected value
    const selectedMethod = option.getAttribute('data-value');
    // Store the value of selected payment method data-value
    const paymentMethodInput = document.getElementById('paymentMethodInput');

    if (selectedMethod === 'cashOption') {
        paymentMethodInput.value = 'C';
    }else if (selectedMethod === 'emoneyOption'){
        paymentMethodInput.value = 'E';
    }

    paymentOptions.forEach(opt => {
        if (opt === option) {
            opt.classList.add('bg-green-500', 'text-white', 'font-medium', 'border-green-500', 'transition', '-translate-y-1', 'shadow', 'duration-300', 'ease-out');
            opt.classList.remove('bg-white', 'text-gray-700', 'border-gray-300');
        }else{
            opt.classList.remove('bg-green-500', 'text-white', 'font-medium', 'border-green-500', 'transition', '-translate-y-1', 'shadow', 'duration-300', 'ease-out');
            opt.classList.add('bg-white', 'text-gray-700', 'border-gray-300');
        }
    });

    updateConfirmBtn();
}

updateConfirmBtn();
