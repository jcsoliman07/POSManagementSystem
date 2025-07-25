
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


//Function to Filter Order date from a dropdown
function filterOrderData(mode){ //Mode its either dropdown or daterange
    const orderRow = document.querySelectorAll('#myOrderTable tbody tr'); //Get the row from tbody
    const clearButton = document.getElementById('clearOrderRange');

    const today = new Date(); //Create a new Date
    let fromDate, toDate;

    if(mode === 'dropdown') {
        const orderDateFilter = document.getElementById('filterDate').value;

        switch(orderDateFilter){

            //Case if Today
            case 'today':
                console.log(fromDate = toDate = formatDate(today));
                break;

            //Case if Yesterday
            case 'yesterday':
                const yesterday = new Date(today);
                yesterday.setDate(today.getDate() - 1); //Get todat date and subtract one to get yesterday date
                console.log(fromDate = toDate = formatDate(yesterday));
                break;

            //Case if This Week
            case 'thisWeek':
                //Create a new Date
                const firstDayofWeek = new Date(today);
                //Set date todat
                const day = today.getDay();
                //Subract to get date of Monday
                const difftoMonday = day == 0 ? 6 : day - 1;
                firstDayofWeek.setDate(today.getDate() - difftoMonday);

                console.log(fromDate = formatDate(firstDayofWeek)); // This will be the first day of the week (Monday)
                console.log(toDate = formatDate(today)); //Until today
                break;

            //Clear filter
            case 'clear':
                fromDate = toDate = '';
                break;

            //Case if No Filter, shows all rows
            case 'all':
                fromDate = toDate = '';
                break;
        }
    }else if(mode === 'daterange'){
        fromDate = document.getElementById('startDate').value;
        toDate = document.getElementById('endDate').value;
    }

    orderRow.forEach(row => {
        const rowDate = row.getAttribute('data-date');
        if (
            (!fromDate && !toDate) || 
            (rowDate >= fromDate && rowDate <= toDate)) {
            row.style.display = '';
        }
        else{
            row.style.display = 'none';
        }
    })
}

//Function to format Date to YYYY-MM-DD
function formatDate(date){
    const year = date.getFullYear();
    const month = (`0${date.getMonth() + 1}`).slice(-2);
    const day = (`0${date.getDate()}`).slice(-2);

    return `${year}-${month}-${day}`;
}


//Line Graph for Weekly Sales
document.addEventListener('DOMContentLoaded', function(){
    //Access the inject global variable
    const chartData = window.weekSalesChart;

    const label = chartData.map(item => item.date); //Map the days for a week
    const orderCounts = chartData.map(item => item.order_count); //Map the order count per day in a week

    const salesChart = document.getElementById('salesChart').getContext('2d');
    new Chart(salesChart, {
        type: 'line',
        data:{
            labels: label,
            datasets:[{
                label: 'Order This Week',
                data: orderCounts,
                borderColor: 'yellow',
                backgroundColor: 'rgba(255, 255, 255, 1)',
                fill:true,
                tension:0.3
            }]
        },
        options:{
            responsive: true,
            scales:{
                x:{
                    title: {
                        display: true,
                        text: 'Date'
                    }
                },
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Order Count'
                    }
                }
            }
        }
    });

});
