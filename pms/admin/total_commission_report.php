<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Location Data</title>
    <link rel="stylesheet" href="../style.css">

</head>

<body>
    <!--Container -->
    <div class="mx-auto">
        <!--Screen-->
        <div class="flex flex-col min-h-screen">
            <!--Header Section Starts Here-->
            <?php include "header.php"; ?>
            <!--/Header-->

            <div class="flex flex-1">
                <!--Sidebar-->
                <?php include "sidebar.php"; ?>
                <!--/Sidebar-->

                <!--Main-->
                <!--Main-->
                <div class="w-full md:w-[80%] lg:w-[75%] xl:w-[75%] 
            mx-auto my-4 self-start 
            rounded-lg bg-slate-100 
            p-4 md:p-6 
            border border-default 
            shadow-xs hover:bg-neutral-secondary-medium">

            <h2 class="p-2 text-xl text-gray-600">Total Commission Report</h2>

                    <div class="mb-4 flex flex-col md:flex-row justify-between items-start md:items-center gap-3">

                        <!-- Search -->
                        <input
                            type="text"
                            id="searchInput"
                            placeholder="Search location..."
                            class="px-3 py-2 border rounded w-full md:w-1/3">

                        <!-- Per Page Select -->
                        <div class="flex items-center gap-2">
                            <label>Show:</label>
                            <select id="perPageSelect"
                                class="px-2 py-1 border rounded">
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                            </select>
                            <span>entries</span>
                        </div>

                    </div>

                    <div id="tableLoader" class="hidden text-center py-6">
                        <div class="inline-block animate-spin rounded-full h-8 w-8 border-4 border-blue-500 border-t-transparent"></div>
                        <p class="mt-2 text-gray-600">Loading...</p>
                    </div>

                    <!-- Responsive Table Wrapper -->
                    <div class="w-full overflow-x-auto">

                        <table class="w-full text-sm text-left text-gray-600">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-100">
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
                            <tbody id="locationTableBody">
                                <tr>
                                    <td colspan="5" class="text-center py-4">Loading...</td>
                                </tr>
                            </tbody>
                        </table>

                    </div>

                    <div id="paginationControls" class="flex flex-wrap justify-center gap-2 mt-4"></div>
                    <div id="resultInfo" class="text-sm text-gray-600 mt-2 text-center"></div>

                </div>
                <!--/Main-->
                <!--/Main-->
            </div>
            <!--Footer-->
            <?php include "footer.php"; ?>
            <!--/footer-->

        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.js"></script>
<script>
let currentSearch = '';
let currentPerPage = 5;

const token = localStorage.getItem("auth_token");

async function fetchCommissionReport() {
    const loader = document.getElementById('tableLoader');
    const tbody = document.getElementById('locationTableBody');
    const resultInfo = document.getElementById('resultInfo');

    try {
        loader.classList.remove('hidden');
        tbody.innerHTML = '';
        resultInfo.innerHTML = '';

        const response = await fetch(
            url + `leader-summary?search=${currentSearch}&per_page=${currentPerPage}`, {
                method: "GET",
                headers: {
                    "Accept": "application/json",
                    "Authorization": "Bearer " + token
                }
            }
        );

        const result = await response.json();
        const data = result.data;

        if (!data || data.length === 0) {
            tbody.innerHTML = `
                <tr>
                    <td colspan="6" class="text-center py-4">No records found</td>
                </tr>`;
            return;
        }

        data.forEach(item => {

            tbody.innerHTML += `
                <tr class="border-b hover:bg-gray-50">
                    <td class="px-4 py-2 font-medium">${item.leader_name}</td>
                    <td class="px-4 py-2">${item.total_plots}</td>
                    <td class="px-4 py-2">₹${item.total_booking_amount}</td>
                    <td class="px-4 py-2 text-blue-600">₹${item.total_commission}</td>
                    <td class="px-4 py-2 text-green-600">₹${item.paid_amount}</td>
                    <td class="px-4 py-2 text-red-600">₹${item.balance_amount}</td>
                </tr>
            `;
        });

        resultInfo.innerHTML = `Total Leaders: ${data.length}`;

    } catch (error) {
        console.error("Error:", error);
    } finally {
        loader.classList.add('hidden');
    }
}

// SEARCH
document.getElementById('searchInput').addEventListener('keyup', function () {
    currentSearch = this.value.trim();
    fetchCommissionReport();
});

// PER PAGE (optional if backend supports it)
document.getElementById('perPageSelect').addEventListener('change', function () {
    currentPerPage = this.value;
    fetchCommissionReport();
});

// LOAD DATA
fetchCommissionReport();
</script>
</body>

</html>