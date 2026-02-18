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
        <div class="flex flex-col">
            <!--Header Section Starts Here-->
            <?php include "header.php"; ?>
            <!--/Header-->

            <div class="flex">
                <!--Sidebar-->
                <?php include "sidebar.php"; ?>
                <!--/Sidebar-->

                <!--Main-->
                <div class="w-[40%] mx-auto my-4 self-start rounded-lg bg-slate-100 p-6 border border-default rounded-base shadow-xs hover:bg-neutral-secondary-medium">
                    <div class="mb-4 flex justify-between items-center">

                        <!-- Search -->
                        <input
                            type="text"
                            id="searchInput"
                            placeholder="Search location..."
                            class="px-3 py-2 border rounded w-1/3">

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

                    <table class="w-full text-sm text-left text-gray-600">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-100">
                            <tr>
                                <th class="px-4 py-3">#</th>
                                <th class="px-4 py-3">Site Location</th>
                                <th class="px-4 py-3">Created At</th>
                            </tr>
                        </thead>
                        <tbody id="locationTableBody">
                            <tr>
                                <td colspan="3" class="text-center py-4">Loading...</td>
                            </tr>
                        </tbody>
                    </table>
                    <div id="paginationControls" class="flex justify-center gap-2 mt-4"></div>
                    <div id="resultInfo" class="text-sm text-gray-600 mt-2 text-center"></div>

                </div>
                <!--/Main-->
            </div>
            <!--Footer-->
            <?php include "footer.php"; ?>
            <!--/footer-->

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

        // ✅ SHOW LOADER BEFORE FETCH
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
                    <td colspan="3" class="text-center py-4">No locations found</td>
                </tr>`;
            return;
        }

        // Populate table
        locations.forEach((loc, index) => {
            tbody.innerHTML += `
                <tr class="border-b">
                    <td class="px-4 py-2">
                        ${(paginationData.current_page - 1) * paginationData.per_page + index + 1}
                    </td>
                    <td class="px-4 py-2 font-medium">${loc.site_location}</td>
                    <td class="px-4 py-2 text-gray-500">
                        ${new Date(loc.created_at).toLocaleDateString()}
                    </td>
                </tr>
            `;
        });

        resultInfo.innerHTML =
            `Showing ${paginationData.from} to ${paginationData.to} of ${paginationData.total} entries`;

        // Previous Button
        if (paginationData.prev_page_url) {
            pagination.innerHTML += `
                <button onclick="fetchLocations(${paginationData.current_page - 1})"
                    class="px-3 py-1 bg-gray-300 rounded hover:bg-gray-400">
                    Prev
                </button>`;
        }

        // Page Numbers
        for (let i = 1; i <= paginationData.last_page; i++) {
            pagination.innerHTML += `
                <button onclick="fetchLocations(${i})"
                    class="px-3 py-1 rounded ${
                        i === paginationData.current_page
                        ? 'bg-blue-600 text-white'
                        : 'bg-gray-200 hover:bg-gray-300'
                    }">
                    ${i}
                </button>`;
        }

        // Next Button
        if (paginationData.next_page_url) {
            pagination.innerHTML += `
                <button onclick="fetchLocations(${paginationData.current_page + 1})"
                    class="px-3 py-1 bg-gray-300 rounded hover:bg-gray-400">
                    Next
                </button>`;
        }

    } catch (error) {
        console.error("Error fetching locations:", error);
    } finally {
        // ✅ HIDE LOADER AFTER EVERYTHING
        loader.classList.add('hidden');
    }
}

/* -------------------------
   EVENT LISTENERS (OUTSIDE)
--------------------------*/

// Debounced Search (prevents glitch)
document.getElementById('searchInput')
    .addEventListener('keyup', function () {

        clearTimeout(searchTimeout);

        searchTimeout = setTimeout(() => {
            currentSearch = this.value.trim();
            fetchLocations(1);
        }, 400);
});

// Per Page Select
document.getElementById('perPageSelect')
    .addEventListener('change', function () {
        currentPerPage = this.value;
        fetchLocations(1);
});

// Initial Load
fetchLocations();
</script>

</body>

</html>