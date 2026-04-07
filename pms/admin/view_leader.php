<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leader Data</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body class="bg-gray-200">
<div class="mx-auto">
<div class="flex flex-col min-h-screen">

    <?php include "header.php"; ?>

    <div class="flex flex-1">

        <?php include "sidebar.php"; ?>

        <!-- MAIN -->
        <div class="w-full md:w-[80%] mx-auto my-6 px-3">

            <!-- CARD -->
            <div class="bg-white rounded-2xl shadow-lg border border-gray-200 p-4 md:p-6">

                <!-- TITLE -->
                <div class="mb-5 text-center">
                    <h2 class="text-xl md:text-2xl font-bold text-gray-800">
                        Leader List
                    </h2>
                    <p class="text-sm text-gray-500">
                        Manage and view all leaders
                    </p>
                </div>

                <!-- TOP CONTROLS -->
                <div class="mb-5 flex flex-col md:flex-row justify-between items-stretch md:items-center gap-3">

                    <!-- Search -->
                    <input type="text" id="searchInput"
                        placeholder="Search by Name, Email, Contact..."
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
                <div class="overflow-x-auto rounded-lg border border-gray-200">

                    <table class="w-full text-sm text-left text-gray-800">

                        <thead class="bg-gray-100 text-gray-800 text-xs uppercase hidden md:table-header-group">
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

                        <tbody id="locationTableBody" class="divide-y divide-gray-200">
                            <tr>
                                <td colspan="7" class="text-center py-6 text-gray-500">
                                    Loading...
                                </td>
                            </tr>
                        </tbody>

                    </table>
                    
                <!-- LOADER -->
                <div id="tableLoader" class="hidden text-center py-6">
                    <div class="inline-block animate-spin rounded-full h-8 w-8 border-4 border-blue-500 border-t-transparent"></div>
                    <p class="mt-2 text-gray-600">Loading...</p>
                </div>


                </div>

                <!-- PAGINATION -->
                <div id="paginationControls"
                    class="flex flex-wrap justify-center items-center gap-2 mt-6">
                </div>

                <!-- RESULT INFO -->
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
                           class="mr-1 w-full md:w-auto text-center px-3 py-1.5 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-500">
                           Edit
                        </a>
                    
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
}/

    // <button onclick="deleteLeader(${loc.id})"
    //                         class="w-full md:w-auto px-3 py-1.5 text-sm font-medium text-white bg-red-600 rounded-md hover:bg-red-500">
    //                         Delete
    //                     </button>

</script>

</body>
</html>