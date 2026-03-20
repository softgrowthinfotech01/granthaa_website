<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leader Data</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>

<div class="mx-auto">
<div class="flex flex-col min-h-screen">

    <?php include "header.php"; ?>

    <div class="flex flex-1">

        <?php include "sidebar.php"; ?>

        <!-- MAIN -->
        <div class="w-full sm:w-[95%] md:w-[80%] lg:w-[60%] mx-3 md:mx-auto my-4 self-start rounded-lg bg-slate-100 p-4 md:p-6 border shadow-xs">

            <!-- TOP CONTROLS -->
            <div class="mb-4 flex flex-col md:flex-row justify-between items-stretch md:items-center gap-3">

                <!-- Search -->
                <input type="text" id="searchInput"
                    placeholder="Search by Name..."
                    class="px-3 py-2 border rounded w-full md:w-1/3">

                <!-- Per Page -->
                <div class="flex flex-col md:flex-row items-start md:items-center gap-2 w-full md:w-auto">
                    <label>Show:</label>
                    <select id="perPageSelect" class="px-2 py-1 border rounded w-full md:w-auto">
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                    </select>
                    <span>entries</span>
                </div>

            </div>

            <!-- LOADER -->
            <div id="tableLoader" class="hidden text-center py-6">
                <div class="inline-block animate-spin rounded-full h-8 w-8 border-4 border-blue-500 border-t-transparent"></div>
                <p class="mt-2 text-gray-600">Loading...</p>
            </div>

            <!-- TABLE -->
            <div class="overflow-x-auto">
                <table class="w-full text-sm md:text-md text-left text-gray-600">

                    <thead class="text-xs text-gray-700 uppercase bg-gray-100 hidden md:table-header-group">
                        <tr>
                            <th class="px-4 py-3">#</th>
                            <th class="px-4 py-3">Name</th>
                            <th class="px-4 py-3">Email</th>
                            <th class="px-4 py-3">Age</th>
                            <th class="px-4 py-3">Contact</th>
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
            </div>

            <!-- PAGINATION -->
            <div id="paginationControls" class="flex flex-wrap justify-center gap-2 mt-4"></div>

            <!-- RESULT INFO -->
            <div id="resultInfo" class="text-sm text-gray-600 mt-2 text-center"></div>

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

    try {

        loader.classList.remove('hidden');
        tbody.innerHTML = '';
        pagination.innerHTML = '';

        const response = await fetch(
            url + `by-role?role=leader&page=${page}&search=${currentSearch}&per_page=${currentPerPage}`, {
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
                    <td colspan="6" class="text-center py-4">No records found</td>
                </tr>`;
        } else {

            locations.forEach((loc, index) => {

                tbody.innerHTML += `
                <tr class="border-b md:table-row block bg-white md:bg-transparent rounded-lg md:rounded-none shadow md:shadow-none mb-3 md:mb-0 p-3 md:p-0">

                    <td class="px-4 py-2 flex justify-between md:table-cell">
                        <span class="md:hidden font-semibold text-gray-500">#</span>
                        ${(paginationData.current_page - 1) * paginationData.per_page + index + 1}
                    </td>

                    <td class="px-4 py-2 flex justify-between md:table-cell">
                        <span class="md:hidden font-semibold text-gray-500">Name</span>
                        ${loc.name}
                    </td>

                    <td class="px-4 py-2 flex justify-between md:table-cell break-all">
                        <span class="md:hidden font-semibold text-gray-500">Email</span>
                        ${loc.email}
                    </td>

                    <td class="px-4 py-2 flex justify-between md:table-cell">
                        <span class="md:hidden font-semibold text-gray-500">Age</span>
                        ${loc.age}
                    </td>

                    <td class="px-4 py-2 flex justify-between md:table-cell">
                        <span class="md:hidden font-semibold text-gray-500">Contact</span>
                        ${loc.contact_no}
                    </td>

                    <td class="px-4 py-2 flex justify-between md:table-cell">
                        <span class="md:hidden font-semibold text-gray-500">Created</span>
                        ${new Date(loc.created_at).toLocaleDateString()}
                    </td>

                    <td class="px-4 py-2 flex flex-col md:flex-row gap-2 md:table-cell">
                        <a href="update_leader.php?id=${loc.id}" 
                           class="w-full md:w-auto text-center px-3 py-1.5 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-500">
                           Edit
                        </a>

                        <button onclick="deleteLeader(${loc.id})"
                            class="w-full md:w-auto px-3 py-1.5 text-sm font-medium text-white bg-red-600 rounded-md hover:bg-red-500">
                            Delete
                        </button>
                    </td>

                </tr>
                `;
            });
        }

        document.getElementById('resultInfo').innerHTML =
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
        console.error("Error:", error);
    } finally {
        loader.classList.add('hidden');
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

/* DELETE */

async function deleteLeader(id) {

    if (!confirm("Are you sure you want to delete this leader?")) return;

    try {
        const response = await fetch(url + `users/${id}`, {
            method: "DELETE",
            headers: {
                "Accept": "application/json",
                "Authorization": "Bearer " + token
            }
        });

        const result = await response.json();

        if (!response.ok) {
            alert(result.message || "Delete failed");
            return;
        }

        alert(result.message || "Deleted successfully");
        fetchLocations(currentPage);

    } catch (error) {
        console.error(error);
        alert("Server error");
    }
}

</script>

</body>
</html>