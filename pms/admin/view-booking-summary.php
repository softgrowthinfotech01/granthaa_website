<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leader Data</title>
    <link rel="stylesheet" href="../style.css">
    <style>
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-5px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fadeIn {
            animation: fadeIn 0.3s ease-in-out;
        }
    </style>
</head>

<body>

    <div class="mx-auto">
        <div class="flex flex-col min-h-screen">

            <?php include "header.php"; ?>

            <div class="flex flex-1">

                <?php include "sidebar.php"; ?>

                <!-- MAIN -->
                <div class="w-full md:w-[90%] lg:w-[80%] mx-auto my-6">

                    <!-- CARD -->
                    <div class="bg-white rounded-2xl shadow-lg border p-5">

                        <!-- HEADER -->
                        <div class="mb-5 flex flex-col md:flex-row justify-between items-center gap-4">

                            <h2 class="text-xl font-semibold text-gray-700">Transaction Summary</h2>

                            <div class="flex flex-col md:flex-row gap-3 w-full md:w-auto">

                                <!-- Search -->
                                <input type="text" id="searchInput"
                                    placeholder="🔍 Search leader..."
                                    class="px-4 py-2 border rounded-lg w-full md:w-64 focus:ring-2 focus:ring-blue-400 outline-none">

                                <!-- Per Page -->
                                <select id="perPageSelect"
                                    class="px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400 outline-none">
                                    <option value="5">5 rows</option>
                                    <option value="10">10 rows</option>
                                    <option value="25">25 rows</option>
                                    <option value="50">50 rows</option>
                                </select>

                            </div>
                        </div>

                       

                        <!-- TABLE -->
                        <div class="overflow-x-auto rounded-lg border">
                            <table class="w-full text-sm text-left">

                                <!-- HEADER -->
                                <thead class="bg-gray-100 text-gray-700 text-xs uppercase sticky top-0">
                                    <tr>
                                        <th class="px-5 py-3">Leader</th>
                                        <th class="px-5 py-3">Plots</th>
                                        <th class="px-5 py-3">Booking</th>
                                        <th class="px-5 py-3">Commission</th>
                                        <th class="px-5 py-3">Paid Comm.</th>
                                        <th class="px-5 py-3">Balance Comm.</th>
                                    </tr>
                                </thead>

                                <!-- BODY -->
                                <tbody id="leaderTable" class="divide-y"></tbody>

                            </table>
                             <!-- LOADER -->
                        <div id="tableLoader" class="hidden flex flex-col items-center py-10">
                            <div class="animate-spin rounded-full h-10 w-10 border-4 border-blue-500 border-t-transparent"></div>
                            <p class="mt-3 text-gray-500">Fetching data...</p>
                        </div>
                        </div>

                        <!-- PAGINATION -->
                        <div id="paginationControls"
                            class="flex flex-wrap justify-center gap-2 mt-5"></div>

                        <!-- RESULT INFO -->
                        <div id="resultInfo"
                            class="text-sm text-gray-500 mt-2 text-center"></div>

                    </div>
                </div>
            </div>

            <?php include "footer.php"; ?>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.js"></script>
    <script>
    function formatCurrency(value) {
        return value ? `₹${value}` : "₹0";
    }

    let openLeaderId = null;
    const token = localStorage.getItem("auth_token");

    if (!token) {
        alert("Please login first");
        window.location.href = "../login";
    }

    const tbody = document.getElementById("leaderTable");
    const searchInput = document.getElementById("searchInput");
    const perPageSelect = document.getElementById("perPageSelect");
    const paginationControls = document.getElementById("paginationControls");
    const resultInfo = document.getElementById("resultInfo");
    const tableLoader = document.getElementById("tableLoader");

    let allLeaders = [];
    let filteredLeaders = [];
    let currentPage = 1;
    let rowsPerPage = parseInt(perPageSelect.value);

    function renderTable() {
        tbody.innerHTML = "";

        const searchValue = searchInput.value.trim().toLowerCase();

        filteredLeaders = allLeaders.filter(row => {
            return (
                (row.leader_name && row.leader_name.toLowerCase().includes(searchValue)) ||
                String(row.total_plots || "").includes(searchValue) ||
                String(row.total_booking_amount || "").includes(searchValue) ||
                String(row.total_commission || "").includes(searchValue) ||
                String(row.paid_amount || "").includes(searchValue) ||
                String(row.balance_amount || "").includes(searchValue)
            );
        });

        const totalRows = filteredLeaders.length;
        const totalPages = Math.ceil(totalRows / rowsPerPage) || 1;

        if (currentPage > totalPages) {
            currentPage = 1;
        }

        const start = (currentPage - 1) * rowsPerPage;
        const end = start + rowsPerPage;
        const paginatedRows = filteredLeaders.slice(start, end);

        if (paginatedRows.length === 0) {
            tbody.innerHTML = `
                <tr>
                    <td colspan="7" class="text-center py-6 text-gray-500">
                        No records found
                    </td>
                </tr>
            `;
        } else {
            paginatedRows.forEach(row => {
                tbody.innerHTML += `
                <tr onclick="loadLeaderDetails(${row.leader_id})"
    class="hover:bg-blue-50 transition duration-200 cursor-pointer">
                    <td class="px-5 py-3 font-medium text-gray-800 flex items-center gap-2">
                        <span id="icon-${row.leader_id}" class="text-sm mr-1">▶</span>
                        ${row.leader_name ?? ""}
                    </td>

                    <td class="px-5 py-3">${row.total_plots ?? 0}</td>

                    <td class="px-5 py-3 text-green-600 font-medium">
                        ${formatCurrency(row.total_booking_amount)}
                    </td>

                    <td class="px-5 py-3 text-indigo-600">
                        ${formatCurrency(row.total_commission)}
                    </td>

                    <td class="px-5 py-3 text-blue-600">
                        ${formatCurrency(row.paid_amount)}
                    </td>

                    <td class="px-5 py-3 font-semibold text-red-500">
                        ${formatCurrency(row.balance_amount)}
                    </td>

                    
                </tr>

                <tr id="leader-${row.leader_id}" class="hidden">
                    <td colspan="7" class="p-0">
                        <div class="bg-gray-50 border-l-4 border-blue-400 mx-4 my-3 rounded-lg shadow-sm p-4 animate-fadeIn">
                            <div id="leader-details-${row.leader_id}"></div>
                        </div>
                    </td>
                </tr>
                `;
            });
        }

        renderPagination(totalPages, totalRows, start, end);
    }

    function renderPagination(totalPages, totalRows, start, end) {
        paginationControls.innerHTML = "";

        if (totalRows === 0) {
            resultInfo.innerHTML = `Showing 0 to 0 of 0 entries`;
            return;
        }

        resultInfo.innerHTML = `Showing ${start + 1} to ${Math.min(end, totalRows)} of ${totalRows} entries`;

        const prevBtn = document.createElement("button");
        prevBtn.innerText = "Previous";
        prevBtn.className = `px-3 py-1 rounded border ${currentPage === 1 ? 'bg-gray-100 text-gray-400 cursor-not-allowed' : 'bg-white hover:bg-gray-100'}`;
        prevBtn.disabled = currentPage === 1;
        prevBtn.onclick = () => {
            currentPage--;
            openLeaderId = null;
            renderTable();
        };
        paginationControls.appendChild(prevBtn);

        for (let i = 1; i <= totalPages; i++) {
            const pageBtn = document.createElement("button");
            pageBtn.innerText = i;
            pageBtn.className = `px-3 py-1 rounded border ${i === currentPage ? 'bg-blue-500 text-white' : 'bg-white hover:bg-gray-100'}`;
            pageBtn.onclick = () => {
                currentPage = i;
                openLeaderId = null;
                renderTable();
            };
            paginationControls.appendChild(pageBtn);
        }

        const nextBtn = document.createElement("button");
        nextBtn.innerText = "Next";
        nextBtn.className = `px-3 py-1 rounded border ${currentPage === totalPages ? 'bg-gray-100 text-gray-400 cursor-not-allowed' : 'bg-white hover:bg-gray-100'}`;
        nextBtn.disabled = currentPage === totalPages;
        nextBtn.onclick = () => {
            currentPage++;
            openLeaderId = null;
            renderTable();
        };
        paginationControls.appendChild(nextBtn);
    }

    function fetchLeaderSummary() {
        tableLoader.classList.remove("hidden");

        fetch(url + "leader-summary", {
            headers: {
                "Authorization": "Bearer " + token
            }
        })
        .then(res => res.json())
        .then(res => {
            allLeaders = res.data || [];
            filteredLeaders = [...allLeaders];
            currentPage = 1;
            renderTable();
        })
        .catch(err => {
            console.error("Error fetching leader summary:", err);
            tbody.innerHTML = `
                <tr>
                    <td colspan="7" class="text-center py-6 text-red-500">
                        Failed to fetch data
                    </td>
                </tr>
            `;
        })
        .finally(() => {
            tableLoader.classList.add("hidden");
        });
    }

    function loadLeaderDetails(leaderId) {
        const container = document.getElementById("leader-details-" + leaderId);
        const row = document.getElementById("leader-" + leaderId);
        const icon = document.getElementById("icon-" + leaderId);
        
  // CLOSE SAME
    if (openLeaderId === leaderId) {
        row.classList.add("hidden");
        icon.innerHTML = "▶";
        openLeaderId = null;
        return;
    }

    // CLOSE PREVIOUS
    if (openLeaderId) {
        document.getElementById("leader-" + openLeaderId)?.classList.add("hidden");
        document.getElementById("icon-" + openLeaderId).innerHTML = "▶";
    }

        container.innerHTML = "Loading...";

        fetch(url + "leader-details/" + leaderId, {
            headers: {
                "Authorization": "Bearer " + token
            }
        })
        .then(res => res.json())
        .then(res => {
            let html = `
                <table class="w-full text-sm border rounded-lg overflow-hidden">
                    <thead class="bg-gray-100 text-gray-700">
                        <tr>
                            <th class="p-3 text-left">Buyer</th>
                            <th class="p-3 text-left">Role</th>
                            <th class="p-3 text-left">Plot</th>
                            <th class="p-3 text-left">Booking</th>
                            <th class="p-3 text-left">Commission</th>
                            <th class="p-3 text-left">Paid</th>
                            <th class="p-3 text-left">Balance</th>
                        </tr>
                    </thead>
                    <tbody>
            `;

            if (res.data && res.data.length > 0) {
                res.data.forEach(item => {
                    html += `
                        <tr class="border-t hover:bg-gray-100">
                            <td class="p-2">${item.buyer_name ?? ""}</td>
                            <td class="p-2">${item.role ?? ""}</td>
                            <td class="p-2">${item.plot_number ?? ""}</td>
                            <td class="p-2">${formatCurrency(item.booking_amount)}</td>
                            <td class="p-2">${formatCurrency(item.total_commission)}</td>
                            <td class="p-2">${formatCurrency(item.paid)}</td>
                            <td class="p-2 font-semibold text-red-500">${formatCurrency(item.total_balance)}</td>
                        </tr>
                    `;
                });
            } else {
                html += `
                    <tr>
                        <td colspan="7" class="p-4 text-center text-gray-500">
                            No details found
                        </td>
                    </tr>
                `;
            }

            html += `</tbody></table>`;

            container.innerHTML = html;
            row.classList.remove("hidden");
            icon.innerHTML = "▼";
            
            openLeaderId = leaderId;
        })
        .catch(err => {
            console.error("Error fetching details:", err);
            container.innerHTML = `<p class="text-red-500">Failed to load details</p>`;
            row.classList.remove("hidden");
        });
    }

    searchInput.addEventListener("input", function () {
        currentPage = 1;
        openLeaderId = null;
        renderTable();
    });

    perPageSelect.addEventListener("change", function () {
        rowsPerPage = parseInt(this.value);
        currentPage = 1;
        openLeaderId = null;
        renderTable();
    });

    fetchLeaderSummary();
</script>
</body>

</html>