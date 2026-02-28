<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Commission Data</title>
    <link rel="stylesheet" href="../style.css">

    <!-- CSS required for datatable -->
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@9.0.3/dist/umd/simple-datatables.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/simple-datatables@9.0.3/dist/style.css">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.css" rel="stylesheet" />


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

                <div class="w-[60%] mx-auto my-4 self-start rounded-lg bg-slate-100 p-6 border border-default rounded-base shadow-xs hover:bg-neutral-secondary-medium">
                    <div class="mb-4 flex justify-between items-center">

                        <!-- Search -->
                        <input
                            type="text"
                            id="searchInput"
                            placeholder="Search by Name..."
                            class="px-3 py-2 border rounded w-1/3">

                        <!-- Per Page Select -->
                        <div class="flex items-center gap-2 text-sm">
                            <span>Show</span>
                            <select id="perPageSelect"
                                class="px-2 py-1 border rounded w-16">
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

                    <table class="w-full text-md text-left text-gray-600">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-100">
                            <tr>
                                <th class="px-4 py-3">#</th>
                                <th class="px-4 py-3">Site Location</th>
                                <th class="px-4 py-3">Leader Name</th>
                                <th class="px-4 py-3">Commission Type</th>
                                <th class="px-4 py-3">Commission Value</th>
                                <th class="px-4 py-3">Created At</th>
                                <th class="px-4 py-3">Actions</th>
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

            try {

                // ✅ Show loader BEFORE API call
                loader.classList.remove('hidden');
                tbody.innerHTML = '';
                pagination.innerHTML = '';

                const response = await fetch(
                    url + `commissions?page=${page}&search=${currentSearch}&per_page=${currentPerPage}`, {
                        method: "GET",
                        headers: {
                            "Accept": "application/json",
                            "Authorization": "Bearer " + token
                        }
                    }
                );

                const result = await response.json();

                const paginationData = result.data;
                const locations = result.data.data;
                if (!locations || locations.length === 0) {
                    tbody.innerHTML = `
                <tr>
                    <td colspan="7" class="text-center py-4">No records found</td>
                </tr>`;
                } else {

                    locations.forEach((loc, index) => {
                        tbody.innerHTML += `
        <tr class="border-b">
            <td class="px-4 py-2">
                ${(paginationData.current_page - 1) * currentPerPage + index + 1}
            </td>

            <td class="px-4 py-2">
                ${loc.location ? loc.location.site_location : '-'}
            </td>

            <td class="px-4 py-2">
                ${loc.user ? loc.user.name : '-'}
            </td>

            <td class="px-4 py-2">${loc.commission_type}</td>
            <td class="px-4 py-2">${loc.commission_value}</td>

            <td class="px-4 py-2">
                ${new Date(loc.created_at).toLocaleDateString()}
            </td>

            <td class="px-4 py-2 flex gap-2">
                <a href="update_commission.php?id=${loc.id}" 
                   class="px-3 py-1.5 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-500">
                   Edit
                </a>
                <button onclick="deleteCommission(${loc.id})"
                    class="px-3 py-1.5 text-sm font-medium text-white bg-red-600 rounded-md hover:bg-red-500">
                    Delete
                </button>
            </td>
        </tr>
    `;
                    });

                }

                // Result info
                document.getElementById('resultInfo').innerHTML =
                    `Showing page ${paginationData.current_page} of ${paginationData.total}
Total records: ${paginationData.total_records}
 entries`;

                // Pagination
                if (paginationData.prev_page_url) {
                    pagination.innerHTML += `
                <button onclick="fetchLocations(${paginationData.current_page - 1})"
                    class="px-3 py-1 bg-gray-300 rounded hover:bg-gray-400">
                    Prev
                </button>`;
                }

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
                // ✅ Hide loader AFTER everything finishes
                loader.classList.add('hidden');
            }
        }

        /* -----------------------------
           EVENT LISTENERS (OUTSIDE)
        ------------------------------*/

        // Debounced Search
        document.getElementById('searchInput')
            .addEventListener('keyup', function() {

                clearTimeout(searchTimeout);

                searchTimeout = setTimeout(() => {
                    currentSearch = this.value.trim();
                    fetchLocations(1);
                }, 400);
            });

        // Per Page Change
        document.getElementById('perPageSelect')
            .addEventListener('change', function() {
                currentPerPage = this.value;
                fetchLocations(1);
            });

        // Initial Load
        fetchLocations();


        // DELETE FUNCTION
        async function deleteCommission(id) {

            if (!confirm("Are you sure you want to delete this commission?")) {
                return;
            }

            try {

                const response = await fetch(
                    url + `commission/${id}`, {
                        method: "DELETE",
                        headers: {
                            "Authorization": "Bearer " + token,
                            "Accept": "application/json"
                        }
                    }
                );

                const result = await response.json();

                if (!response.ok) {
                    alert(result.message);
                    return;
                }

                alert("Deleted successfully");
                fetchLocations(currentPage);

            } catch (error) {
                console.error(error);
                alert("Server error");
            }
        }
    </script>
</body>


</body>

</html>