<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Commission Data</title>
    <link rel="stylesheet" href="../style.css">

    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@9.0.3/dist/umd/simple-datatables.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/simple-datatables@9.0.3/dist/style.css">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.css" rel="stylesheet" />
</head>

<body>

<div class="mx-auto">
<div class="flex flex-col min-h-screen">

<?php include "header.php"; ?>

<div class="flex flex-1">

<?php include "sidebar.php"; ?>

<!-- MAIN -->
<div class="w-full md:w-[90%] lg:w-[75%] xl:w-[60%] mx-3 md:mx-auto my-4 self-start rounded-lg bg-slate-100 p-4 md:p-6 border shadow-xs">

    <!-- TOP -->
    <div class="mb-4 flex flex-col md:flex-row justify-between items-stretch md:items-center gap-3">

        <input
            type="text"
            id="searchInput"
            placeholder="Search by Name..."
            class="px-3 py-2 border rounded w-full md:w-1/3">

        <div class="flex flex-col md:flex-row items-start md:items-center gap-2 text-sm w-full md:w-auto">
            <span>Show</span>
            <select id="perPageSelect" class="px-2 py-1 border rounded w-full md:w-16">
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
    <div class="w-full overflow-x-auto">
        <table class="w-full text-md text-left text-gray-600">

            <!-- Hide header on mobile -->
            <thead class="text-xs text-gray-700 uppercase bg-gray-100 hidden md:table-header-group">
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
    </div>

    <div id="paginationControls" class="flex flex-wrap justify-center gap-2 mt-4"></div>
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

<tr class="border-b md:table-row block bg-white md:bg-transparent rounded-lg md:rounded-none shadow md:shadow-none mb-3 md:mb-0 p-3 md:p-0">

<td class="px-4 py-2 flex justify-between md:table-cell">
<span class="md:hidden font-semibold text-gray-500">#</span>
${(paginationData.current_page - 1) * currentPerPage + index + 1}
</td>

<td class="px-4 py-2 flex justify-between md:table-cell">
<span class="md:hidden font-semibold text-gray-500">Location</span>
${loc.location ? loc.location.site_location : '-'}
</td>

<td class="px-4 py-2 flex justify-between md:table-cell">
<span class="md:hidden font-semibold text-gray-500">Leader</span>
${loc.user ? loc.user.name : '-'}
</td>

<td class="px-4 py-2 flex justify-between md:table-cell">
<span class="md:hidden font-semibold text-gray-500">Type</span>
${loc.commission_type}
</td>

<td class="px-4 py-2 flex justify-between md:table-cell">
<span class="md:hidden font-semibold text-gray-500">Value</span>
${loc.commission_value}
</td>

<td class="px-4 py-2 flex justify-between md:table-cell">
<span class="md:hidden font-semibold text-gray-500">Created</span>
${new Date(loc.created_at).toLocaleDateString()}
</td>

<td class="px-4 py-2 flex flex-col md:flex-row gap-2 md:table-cell">
<a href="update_commission.php?id=${loc.id}" 
class="w-full md:w-auto text-center px-3 py-1.5 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-500">
Edit
</a>

<button onclick="deleteCommission(${loc.id})"
class="w-full md:w-auto px-3 py-1.5 text-sm font-medium text-white bg-red-600 rounded-md hover:bg-red-500">
Delete
</button>
</td>

</tr>
`;
            });
        }

        document.getElementById('resultInfo').innerHTML =
            `Showing page ${paginationData.current_page} of ${paginationData.total}
Total records: ${paginationData.total_records} entries`;

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


/* EVENTS */

document.getElementById('searchInput').addEventListener('keyup', function() {
    clearTimeout(searchTimeout);
    searchTimeout = setTimeout(() => {
        currentSearch = this.value.trim();
        fetchLocations(1);
    }, 400);
});

document.getElementById('perPageSelect').addEventListener('change', function() {
    currentPerPage = this.value;
    fetchLocations(1);
});

fetchLocations();


/* DELETE */

async function deleteCommission(id) {

    if (!confirm("Are you sure you want to delete this commission?")) return;

    try {

        const response = await fetch(url + `commission/${id}`, {
            method: "DELETE",
            headers: {
                "Authorization": "Bearer " + token,
                "Accept": "application/json"
            }
        });

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
</html>