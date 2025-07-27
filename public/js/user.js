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
        itemElement.className = 'flex py-4 border-b';
        itemElement.innerHTML = `
            <span class="hidden"> ${item.id}</span>
            <span class="flex-1">${item.name}</span>
            <span class="flex-1 text-center">x ${item.quantity}</span>
            <span class="flex-1 text-right">₱${itemTotal.toFixed(2)}</span>
        `;

        //Container for Payment Method
        const paymentMethodContainer = document.createElement('div');
        paymentMethodContainer.className = 'flex';

        //Payment Method Option - Cash
        const cashOption = document.createElement('div');
        cashOption.className = 'flex-1 py-2 text-center border cursor-pointer bg-green-500 text-white border-green-500 rounded-l-lg'
        cashOption.innerText = 'Cash';

        //Payment Method Option
        const emoneyOption = document.createElement('div');
        emoneyOption.className = 'flex-1 py-2 text-center border cursor-pointer bg-green-500 text-white border-green-500 rounded-r-lg'
        emoneyOption.innerText = 'E-money';

        //Append options to payment Method
        paymentMethodContainer.appendChild(cashOption);
        paymentMethodContainer.appendChild(emoneyOption);

        reviewContainer.appendChild(itemElement); //Append the order items
        reviewContainer.appendChild(paymentMethodContainer); //Append the payment method container

        orderData.push({ product_id: item.id, quantity: item.quantity, subtotal: itemTotal });
    });

    reviewTotal.textContent = `₱${total.toFixed(2)}`;
    orderDataInput.value = JSON.stringify(orderData);

    document.getElementById('review-modal').classList.remove('hidden');
});

//Cancel Review Modal
document.getElementById('cancelReviewBtn').addEventListener('click', function () {
    document.getElementById('review-modal').classList.add('hidden');
});
