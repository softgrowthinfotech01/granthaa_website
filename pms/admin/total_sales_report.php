<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Location Data</title>
    <link rel="stylesheet" href="../style.css">
    <script src="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.js"></script>
</head>

<body class="bg-gray-200">
    <!--Container -->
 <div class="mx-auto">
    <div class="flex flex-col min-h-screen">

        <?php include "header.php"; ?>

        <div class="flex flex-1 flex-col md:flex-row">

            <?php include "sidebar.php"; ?>

            <!-- MAIN -->
            <div id="mainContent"
                class="w-full md:w-[80%] lg:w-[75%] xl:w-[80%] 
                mx-auto my-6 px-3">

                <!-- CARD -->
                <div class="bg-white p-5 md:p-6 rounded-2xl shadow-lg border border-gray-200">

                    <!-- TITLE -->
                    <div class="mb-5 text-center">
                        <h2 class="text-xl md:text-2xl font-bold text-gray-800">
                            Total Sales Report
                        </h2>
                        <p class="text-sm text-gray-500">Overview of sales data</p>
                    </div>

                    <!-- TOP CONTROLS -->
                    <div class="mb-5 flex flex-col md:flex-row justify-between items-stretch md:items-center gap-3">

                        <!-- Search -->
                        <input type="text"
                            id="searchInput"
                            placeholder="Search location or site name"
                            class="px-3 py-2.5 border border-gray-300 rounded-lg w-full md:w-1/3 focus:ring-2 focus:ring-blue-500 outline-none">

                        <!-- Per Page -->
                        <div class="flex items-center gap-2 text-sm justify-between md:justify-start">
                            <span class="text-gray-600">Show</span>
                            <select id="perPageSelect"
                                class="px-2 py-1.5 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 outline-none">
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                            </select>
                            <span class="text-gray-600">entries</span>
                        </div>

                    </div>

                  

                    <!-- DESKTOP TABLE -->
                    <div class="hidden md:block w-full overflow-x-auto rounded-lg border border-gray-200">
                        <table class="w-full text-sm text-left text-gray-600">

                            <thead class="text-xs text-gray-700 uppercase bg-gray-100">
                                <tr>
                                    <th class="px-4 py-3">Site Name</th>
                                    <th class="px-4 py-3">Sale Date</th>
                                    <th class="px-4 py-3">Site Location</th>
                                    <th class="px-4 py-3">Total Amount</th>
                                    <th class="px-4 py-3">Balance Amount</th>
                                    <th class="px-4 py-3"></th>
                                </tr>
                            </thead>

                            <tbody id="locationTableBody" class="divide-y">
                                <tr>
                                    <td colspan="5" class="text-center py-4 text-gray-500">
                                        Loading...
                                    </td>
                                </tr>
                            </tbody>

                        </table>

                          <!-- LOADER -->
                    <div id="tableLoader" class="hidden text-center py-6">
                        <div class="inline-block animate-spin rounded-full h-8 w-8 border-4 border-blue-500 border-t-transparent"></div>
                        <p class="mt-2 text-gray-500">Loading...</p>
                    </div>
                    </div>

                    <!-- MOBILE CARDS -->
                    <div id="mobileCardContainer" class="md:hidden flex flex-col gap-3"></div>

                    <!-- PAGINATION -->
                    <div id="paginationControls"
                        class="flex flex-wrap justify-center gap-2 mt-5"></div>

                    <!-- RESULT -->
                    <div id="resultInfo"
                        class="text-sm text-gray-500 mt-2 text-center"></div>

                </div>

            </div>
            <!--/Main-->

        </div>

        <?php include "footer.php"; ?>

    </div>
</div>

   <script>
let currentPage = 1;
let currentSearch = '';
let currentPerPage = 5;
let searchTimeout;

const token = localStorage.getItem("auth_token");

async function fetchLocations(page = 1) {
    const loader = document.getElementById('tableLoader');
    const tbody = document.getElementById('locationTableBody');
    const pagination = document.getElementById('paginationControls');
    const resultInfo = document.getElementById('resultInfo');
    const mobileContainer = document.getElementById('mobileCardContainer');

    try {
        loader.classList.remove('hidden');
        tbody.innerHTML = '';
        pagination.innerHTML = '';
        mobileContainer.innerHTML = '';
        resultInfo.innerHTML = '';

        const response = await fetch(
            url + `bookings?page=${page}&search=${currentSearch}&per_page=${currentPerPage}`, {
                method: "GET",
                headers: {
                    "Accept": "application/json",
                    "Authorization": "Bearer " + token
                }
            }
        );

        const result = await response.json();
        const paginationData = result.data;
        const bookings = paginationData.data;

        if (!bookings || bookings.length === 0) {
            tbody.innerHTML = `<tr><td colspan="6" class="text-center py-4">No records found</td></tr>`;
            return;
        }

        bookings.forEach((item, index) => {

              const formattedCommission =
    item.commission_type === "percent"
        ? `${item.commission_value ?? 0}%`
        : `₹${item.commission_value ?? 0}`;

            // MAIN ROW
            tbody.innerHTML += `
                <tr class="border-b">
                    <td class="px-4 py-2">${item.project_name || '-'}</td>
                    <td class="px-4 py-2">${new Date(item.created_at).toLocaleDateString()}</td>
                    <td class="px-4 py-2">${item.location?.site_location || '-'}</td>
                    <td class="px-4 py-2">₹${item.total_booking_amount}</td>
                    <td class="px-4 py-2">₹${item.total_booking_amount - item.advance_amount}</td>
                    <td class="px-4 py-2">
                        <button onclick="toggleDetails(${index})"
                        class="bg-blue-600 text-white px-2 py-1 rounded">View</button>
                    </td>
                </tr>
            `;

            // ACCORDION ROW
            tbody.innerHTML += `
                <tr id="details-${index}" class="hidden bg-gray-50">
                    <td colspan="6" class="px-4 py-3 text-sm text-gray-700">
                        
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                            <p><b>Buyer:</b> ${item.buyer_name}</p>
                            <p><b>Mobile:</b> ${item.mobile}</p>
                            <p><b>Email:</b> ${item.email}</p>

                            <p><b>Plot:</b> ${item.plot_number}</p>
                            <p><b>Project:</b> ${item.project_name}</p>
                            <p><b>Payment:</b> ${item.payment_mode}</p>

                            <p><b>Advance:</b> ₹${item.advance_amount}</p>
                            <p><b>Total:</b> ₹${item.total_booking_amount}</p>
                            <p><b>Commission:</b> ${formattedCommission}</p>
                            <p><b>Total Commission Amount:</b> ₹${item.commission_amount}</p>
                            
     

                            <p class="col-span-2"><b>Address:</b> ${item.address}, ${item.city}</p>
                            <p class="col-span-2"><b>Remark:</b> ${item.remark}</p>
                        </div>

                    </td>
                </tr>
            `;

            // MOBILE CARD
           mobileContainer.innerHTML += `
    <div class="bg-white rounded-xl shadow border p-4">

        <div class="flex justify-between">
            <h3 class="font-semibold">${item.buyer_name}</h3>
            <span>${new Date(item.created_at).toLocaleDateString()}</span>
        </div>

        <p class="text-sm text-gray-600">${item.project_name}</p>

        <p class="text-sm mt-2">₹${item.total_booking_amount}</p>

        <button onclick="toggleMobileDetails(${index})"
            class="mt-2 bg-blue-600 text-white px-2 py-1 rounded w-full">
            View Details
        </button>

        <!-- MOBILE DETAILS -->
       <div id="mobile-details-${index}" class="hidden mt-3 text-sm text-gray-700 bg-gray-50 p-2">

            <div class="grid grid-cols-2 gap-2">
                <p><b>Buyer:</b> ${item.buyer_name}</p>
                <p><b>Mobile:</b> ${item.mobile}</p>
                <p><b>Email:</b> ${item.email}</p>

                <p><b>Plot:</b> ${item.plot_number}</p>
                <p><b>Project:</b> ${item.project_name}</p>
                <p><b>Payment:</b> ${item.payment_mode}</p>

                <p><b>Advance:</b> ₹${item.advance_amount}</p>
                <p><b>Total:</b> ₹${item.total_booking_amount}</p>

                <p><b>Total Commission Amount:</b> ₹${item.commission_amount}</p>
              
            </div>

        </div>
    </div>
`;
        });

        resultInfo.innerHTML = `Page ${paginationData.current_page} of ${paginationData.last_page}`;

        // PAGINATION
        if (paginationData.prev_page_url) {
            pagination.innerHTML += `<button onclick="fetchLocations(${paginationData.current_page - 1})"
                class="px-3 py-1 bg-gray-300 rounded">Prev</button>`;
        }

        for (let i = 1; i <= paginationData.last_page; i++) {
            pagination.innerHTML += `<button onclick="fetchLocations(${i})"
                class="px-3 py-1 rounded ${i === paginationData.current_page ? 'bg-blue-600 text-white' : 'bg-gray-200'}">${i}</button>`;
        }

        if (paginationData.next_page_url) {
            pagination.innerHTML += `<button onclick="fetchLocations(${paginationData.current_page + 1})"
                class="px-3 py-1 bg-gray-300 rounded">Next</button>`;
        }

    } catch (error) {
        console.error("Error:", error);
    } finally {
        loader.classList.add('hidden');
    }
}

// TOGGLE FUNCTION
function toggleDetails(index) {
    const row = document.getElementById("details-" + index);
    row.classList.toggle("hidden");
}

// toggle for mobile
function toggleMobileDetails(index) {
    const el = document.getElementById("mobile-details-" + index);
    el.classList.toggle("hidden");
}

// SEARCH
document.getElementById('searchInput').addEventListener('keyup', function () {
    clearTimeout(searchTimeout);
    searchTimeout = setTimeout(() => {
        currentSearch = this.value.trim();
        fetchLocations(1);
    }, 400);
});

// PER PAGE
document.getElementById('perPageSelect').addEventListener('change', function () {
    currentPerPage = this.value;
    fetchLocations(1);
});

// LOAD
fetchLocations();
</script>
</body>

</html>