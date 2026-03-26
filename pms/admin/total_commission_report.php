<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Location Data</title>
    <link rel="stylesheet" href="../style.css">

</head>

<body class="bg-gray-200">
  <div class="mx-auto">
    <div class="flex flex-col min-h-screen">

        <?php include "header.php"; ?>

        <div class="flex flex-1 flex-col md:flex-row">

            <?php include "sidebar.php"; ?>

            <!-- MAIN -->
            <div id="mainContent"
                class="w-full md:w-[80%] lg:w-[75%] xl:w-[75%] 
                mx-auto my-6 px-3">

                <!-- CARD -->
                <div class="bg-white p-5 md:p-6 rounded-2xl shadow-lg border border-gray-200">

                    <!-- TITLE -->
                    <div class="mb-5 text-center">
                        <h2 class="text-xl md:text-2xl font-bold text-gray-800">
                            Total Commission Report
                        </h2>
                        <p class="text-sm text-gray-500">Overview of commission data</p>
                    </div>

                    <!-- TOP CONTROLS -->
                    <div class="mb-5 flex flex-col md:flex-row justify-between items-stretch md:items-center gap-3">

                        <!-- Search -->
                        <input
                            type="text"
                            id="searchInput"
                            placeholder="Search location..."
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

                   

                    <!-- TABLE -->
                    <div class="w-full overflow-x-auto rounded-lg border border-gray-200">

                        <table class="w-full text-sm text-left text-gray-600">

                            <thead class="text-xs text-gray-700 uppercase bg-gray-100">
                                <tr>
                                    <th class="px-4 py-3">Leader Name</th>
                                    <th class="px-4 py-3">Total Plots</th>
                                    <th class="px-4 py-3">Total Booking ₹</th>
                                    <th class="px-4 py-3">Total Commission ₹</th>
                                    <th class="px-4 py-3">Paid ₹</th>
                                    <th class="px-4 py-3">Balance ₹</th>
                                </tr>
                            </thead>

                            <tbody id="locationTableBody" class="divide-y">
                                <tr>
                                    <td colspan="6" class="text-center py-4 text-gray-500">
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

    <script src="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.js"></script>
<script>
let allData = [];
let filteredData = [];
let currentPage = 1;
let perPage = 5;

const token = localStorage.getItem("auth_token");

/* ================= LOAD DATA ================= */
async function fetchCommissionReport() {

    const loader = document.getElementById('tableLoader');
    loader.classList.remove('hidden');

    try {
        const response = await fetch(url + "leader-summary", {
            headers: {
                "Authorization": "Bearer " + token
            }
        });

        const result = await response.json();

        allData = result.data || [];
        applyFilters();

    } catch (error) {
        console.error(error);
    } finally {
        loader.classList.add('hidden');
    }
}

/* ================= FILTER ================= */
function applyFilters() {

    const search = document.getElementById('searchInput').value.toLowerCase();
    perPage = parseInt(document.getElementById('perPageSelect').value);

    filteredData = allData.filter(item => {

        return (
            (item.leader_name || '').toLowerCase().includes(search)
        );
    });

    currentPage = 1;
    renderTable();
}

/* ================= RENDER ================= */
function renderTable() {

    const tbody = document.getElementById('locationTableBody');
    const resultInfo = document.getElementById('resultInfo');

    tbody.innerHTML = '';

    let start = (currentPage - 1) * perPage;
    let paginated = filteredData.slice(start, start + perPage);

    if (paginated.length === 0) {
        tbody.innerHTML = `
            <tr>
                <td colspan="6" class="text-center py-4">
                    No records found
                </td>
            </tr>`;
        return;
    }

    paginated.forEach(item => {
        tbody.innerHTML += `
            <tr class="border-b hover:bg-gray-50">
                <td class="px-4 py-2">${item.leader_name}</td>
                <td class="px-4 py-2">${item.total_plots}</td>
                <td class="px-4 py-2">₹ ${Number(item.total_booking_amount).toLocaleString("en-IN")}</td>
                <td class="px-4 py-2 text-blue-600">₹ ${Number(item.total_commission).toLocaleString("en-IN")}</td>
                <td class="px-4 py-2 text-green-600">₹ ${Number(item.paid_amount).toLocaleString("en-IN")}</td>
                <td class="px-4 py-2 text-red-600">₹ ${Number(item.balance_amount).toLocaleString("en-IN")}</td>
            </tr>
        `;
    });

    resultInfo.innerHTML = `Showing ${paginated.length} of ${filteredData.length}`;

    renderPagination();
}

/* ================= PAGINATION ================= */
function renderPagination() {

    const paginationDiv = document.getElementById('paginationControls');

    let totalPages = Math.ceil(filteredData.length / perPage);

    let html = '';

    html += `
        <button ${currentPage === 1 ? 'disabled' : ''}
            onclick="changePage(${currentPage - 1})"
            class="px-3 py-1 bg-gray-300 rounded">
            Prev
        </button>
    `;

    html += `<span class="px-2">Page ${currentPage} of ${totalPages}</span>`;

    html += `
        <button ${currentPage === totalPages ? 'disabled' : ''}
            onclick="changePage(${currentPage + 1})"
            class="px-3 py-1 bg-gray-300 rounded">
            Next
        </button>
    `;

    paginationDiv.innerHTML = html;
}

/* ================= EVENTS ================= */
let timeout;

document.getElementById('searchInput').addEventListener('keyup', function () {

    clearTimeout(timeout);

    timeout = setTimeout(() => {
        applyFilters();
    }, 300);
});

document.getElementById('perPageSelect').addEventListener('change', function () {
    applyFilters();
});

window.changePage = function(page) {
    currentPage = page;
    renderTable();
}

/* ================= INIT ================= */
fetchCommissionReport();
</script>
</body>

</html>