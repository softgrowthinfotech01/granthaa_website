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

    <div class="flex flex-1">

        <?php include "sidebar.php"; ?>

        <!-- MAIN -->
        <div class="w-full md:w-[80%] lg:w-[75%] xl:w-[75%] 
                    mx-auto my-6 px-3">

            <!-- CARD -->
            <div class="bg-white rounded-2xl shadow-lg border border-gray-200 p-4 md:p-6">

                <!-- TITLE -->
                <div class="mb-5 text-center">
                    <h2 class="text-xl md:text-2xl font-bold text-gray-800">
                        Site Locations
                    </h2>
                    <p class="text-sm text-gray-500">
                        Manage all site locations
                    </p>
                </div>

                <!-- TOP CONTROLS -->
                <div class="mb-5 flex flex-col md:flex-row justify-between items-stretch md:items-center gap-3">

                    <!-- Search -->
                    <input
                        type="text"
                        id="searchInput"
                        placeholder="Search location..."
                        class="w-full md:w-1/3 px-3 py-2.5 border border-gray-300 rounded-lg bg-white text-sm focus:ring-2 focus:ring-blue-500 outline-none">

                    <!-- Per Page -->
                    <div class="flex items-center gap-2">
                        <label class="text-sm text-gray-600">Show:</label>

                        <select id="perPageSelect"
                            class="px-3 py-2 border border-gray-300 rounded-lg bg-white text-sm focus:ring-2 focus:ring-blue-500 outline-none">
                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                        </select>

                        <span class="text-sm text-gray-600">entries</span>
                    </div>

                </div>

            

                <!-- TABLE -->
                <div class="w-full overflow-x-auto rounded-lg border border-gray-200">

                    <table class="w-full text-sm text-left text-gray-800">

                        <!-- Hide header on mobile -->
                        <thead class="text-xs text-gray-600 uppercase bg-gray-100 hidden md:table-header-group">
                            <tr>
                                <th class="px-4 py-3">#</th>
                                <th class="px-4 py-3">Site Location</th>
                                <th class="px-4 py-3">Created At</th>
                                <th class="px-4 py-3">Actions</th>
                            </tr>
                        </thead>

                        <tbody id="locationTableBody" class="divide-y divide-gray-200">
                            <tr>
                                <td colspan="4" class="text-center py-6 text-gray-500">
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
                    class="flex flex-wrap justify-center items-center gap-2 mt-6">
                </div>

                <!-- RESULT -->
                <div id="resultInfo"
                    class="text-sm text-gray-500 mt-2 text-center">
                </div>

            </div>

        </div>
    </div>

    <?php include "footer.php"; ?>

</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.js"></script>
<script src="../url.js"></script>

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

    try {

        loader.classList.remove('hidden');
        tbody.innerHTML = '';
        pagination.innerHTML = '';
        resultInfo.innerHTML = '';

        const response = await fetch(
            url + `site-location?page=${page}&search=${currentSearch}&per_page=${currentPerPage}`, {
                method: "GET",
                headers: {
                    "Accept": "application/json",
                    "Authorization": "Bearer " + token
                }
            }
        );

        const result = await response.json();

        const paginationData = result.data;
        const locations = paginationData.data;

        if (!locations || locations.length === 0) {
            tbody.innerHTML = `
                <tr>
                    <td colspan="4" class="text-center py-4">No locations found</td>
                </tr>`;
            return;
        }

        locations.forEach((loc, index) => {
            tbody.innerHTML += `
                <tr class="border-b md:table-row block bg-white md:bg-transparent rounded-lg md:rounded-none shadow md:shadow-none mb-3 md:mb-0 p-3 md:p-0">

                    <td class="px-4 py-2 flex justify-between md:table-cell">
                        <span class="md:hidden font-semibold text-gray-500">#</span>
                        ${(paginationData.current_page - 1) * paginationData.per_page + index + 1}
                    </td>

                    <td class="px-4 py-2 flex justify-between md:table-cell">
                        <span class="md:hidden font-semibold text-gray-500">Location</span>
                        ${loc.site_location}
                    </td>

                    <td class="px-4 py-2 flex justify-between md:table-cell">
                        <span class="md:hidden font-semibold text-gray-500">Created</span>
                        ${new Date(loc.created_at).toLocaleDateString()}
                    </td>

                    <td class="px-4 py-2 flex flex-col md:flex-row gap-2 md:table-cell">
                        <a href="update_location.php?id=${loc.id}" 
                           class="mr-1 w-full md:w-auto text-center px-3 py-1.5 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-500">
                           Edit
                        </a>

                        <button onclick="deleteLocation(${loc.id})"
                            class="w-full md:w-auto px-3 py-1.5 text-sm font-medium text-white bg-red-600 rounded-md hover:bg-red-500">
                            Delete
                        </button>
                    </td>

                </tr>
            `;
        });

        resultInfo.innerHTML =
            `Showing ${paginationData.from} to ${paginationData.to} of ${paginationData.total} entries`;

        if (paginationData.prev_page_url) {
            pagination.innerHTML += `
                <button onclick="fetchLocations(${paginationData.current_page - 1})"
                    class="px-3 py-1 bg-gray-300 rounded hover:bg-gray-400">Prev</button>`;
        }

        for (let i = 1; i <= paginationData.last_page; i++) {
            pagination.innerHTML += `
                <button onclick="fetchLocations(${i})"
                    class="px-3 py-1 rounded ${
                        i === paginationData.current_page
                        ? 'bg-blue-600 text-white'
                        : 'bg-gray-200 hover:bg-gray-300'
                    }">${i}</button>`;
        }

        if (paginationData.next_page_url) {
            pagination.innerHTML += `
                <button onclick="fetchLocations(${paginationData.current_page + 1})"
                    class="px-3 py-1 bg-gray-300 rounded hover:bg-gray-400">Next</button>`;
        }

    } catch (error) {
        console.error("Error fetching locations:", error);
    } finally {
        loader.classList.add('hidden');
    }
}


/* DELETE */
async function deleteLocation(id) {

    if (!confirm("Are you sure you want to delete this location?")) return;

    try {

        const response = await fetch(
            url + `site-location/${id}`, {
                method: "DELETE",
                headers: {
                    "Accept": "application/json",
                    "Authorization": "Bearer " + token
                }
            }
        );

        const result = await response.json();

        if (!response.ok) {
            throw new Error(result.message || "Delete failed");
        }

        alert(result.message || "Location deleted successfully");
        fetchLocations(currentPage);

    } catch (error) {
        alert(error.message);
        console.error("Delete error:", error);
    }
}


/* EVENTS */

document.getElementById('searchInput').addEventListener('keyup', function () {
    clearTimeout(searchTimeout);
    searchTimeout = setTimeout(() => {
        currentSearch = this.value.trim();
        fetchLocations(1);
    }, 400);
});

document.getElementById('perPageSelect').addEventListener('change', function () {
    currentPerPage = this.value;
    fetchLocations(1);
});

fetchLocations();

</script>

</body>
</html>