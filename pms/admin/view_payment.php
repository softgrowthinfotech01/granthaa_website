<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Records</title>

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
                    class="w-full md:w-[85%] lg:w-[75%] xl:w-[70%] 
                mx-auto my-6 px-3">

                    <!-- CARD -->
                    <div class="bg-white p-5 md:p-6 rounded-2xl shadow-lg border border-gray-200">

                        <!-- TITLE -->
                        <div class="mb-5 text-center">
                            <h2 class="text-xl md:text-2xl font-bold text-gray-800">
                                Payment Records
                            </h2>
                            <p class="text-sm text-gray-500">Manage and track all payments</p>
                        </div>

                        <!-- SEARCH + FILTER -->
                        <div class="mb-5 flex flex-col md:flex-row justify-between items-stretch md:items-center gap-3">

                            <!-- Search -->
                            <input
                                type="text"
                                id="searchInput"
                                placeholder="Search reference / remark..."
                                class="px-3 py-2.5 border border-gray-300 rounded-lg w-full md:w-1/2 focus:ring-2 focus:ring-blue-500 outline-none">

                            <!-- Per Page -->
                            <div class="flex items-center justify-between md:justify-start gap-2 text-sm">
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
                        <div class="overflow-x-auto rounded-lg border border-gray-200">

                            <table class="w-full text-sm text-left text-gray-600">

                                <thead class="text-xs text-gray-700 uppercase bg-gray-100">
                                    <tr>
                                        <th class="px-4 py-3">#</th>
                                        <th class="px-4 py-3">Leader Name</th>
                                        <th class="px-4 py-3">Amount</th>
                                        <th class="px-4 py-3">Mode</th>
                                        <th class="px-4 py-3">Reference</th>
                                        <th class="px-4 py-3">Remark</th>
                                        <th class="px-4 py-3">Created At</th>
                                    </tr>
                                </thead>

                                <tbody id="paymentTableBody" class="divide-y">
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

            </div>

            <?php include "footer.php"; ?>

        </div>

    </div>

    <script src="../url.js"></script>

    <script>
        let currentPage = 1;
        let currentSearch = '';
        let currentPerPage = 5;
        let searchTimeout;

        const token = localStorage.getItem("auth_token");

        if (!token) {
            alert("Please login first");
            window.location.href = "../login";
        }

        async function fetchPayments(page = 1) {

            currentPage = page;

            const loader = document.getElementById('tableLoader');
            const tbody = document.getElementById('paymentTableBody');
            const pagination = document.getElementById('paginationControls');

            try {

                loader.classList.remove('hidden');
                tbody.innerHTML = '';
                pagination.innerHTML = '';

                const response = await fetch(
                    url + `commission/payments?page=${page}&search=${currentSearch}&per_page=${currentPerPage}`, {
                        method: "GET",
                        headers: {
                            "Accept": "application/json",
                            "Authorization": "Bearer " + token
                        }
                    }
                );

                const result = await response.json();

                if (!response.ok) {
                    alert(result.message || "Failed to fetch payments");
                    return;
                }

                const paginationData = result.data;
                const payments = result?.data?.data ?? [];

                if (payments.length === 0) {

                    tbody.innerHTML = `
<tr>
<td colspan="8" class="text-center py-4">No records found</td>
</tr>`;

                } else {

                    let rows = "";
                    let serial = (paginationData.current_page - 1) * paginationData.per_page;

                    payments.forEach((pay) => {

                        // Skip advisors
                        if (pay.user?.role === 'adviser') {
                            return;
                        }

                        serial++;

                        rows += `
    <tr class="border-b">

    <td class="px-4 py-2">
    ${serial}
    </td>

    <td class="px-4 py-2">
    ${pay.user?.name ?? pay.user_id}
    </td>

    <td class="px-4 py-2 text-green-600 font-semibold">
    ₹ ${Math.abs(pay.amount)}
    </td>

    <td class="px-4 py-2">${pay.payment_mode ?? ''}</td>

    <td class="px-4 py-2">${pay.reference_no ?? ''}</td>

    <td class="px-4 py-2">${pay.remark ?? ''}</td>

    <td class="px-4 py-2">
    ${new Date(pay.created_at).toLocaleDateString()}
    </td>

    </tr>
    `;
                    });

                    tbody.innerHTML = rows;

                }

                document.getElementById('resultInfo').innerHTML =
                    `Showing ${paginationData.from} to ${paginationData.to} of ${paginationData.total} entries`;

                if (paginationData.prev_page_url) {

                    pagination.innerHTML += `
<button onclick="fetchPayments(${paginationData.current_page - 1})"
class="px-3 py-1 bg-gray-300 rounded hover:bg-gray-400">

Prev

</button>`;
                }

                for (let i = 1; i <= paginationData.last_page; i++) {

                    pagination.innerHTML += `
<button onclick="fetchPayments(${i})"
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
<button onclick="fetchPayments(${paginationData.current_page + 1})"
class="px-3 py-1 bg-gray-300 rounded hover:bg-gray-400">

Next

</button>`;
                }

            } catch (error) {

                console.error("Error fetching payments:", error);
                alert("Server error");

            } finally {

                loader.classList.add('hidden');

            }

        }

        document.getElementById('searchInput')
            .addEventListener('keyup', function() {

                clearTimeout(searchTimeout);

                searchTimeout = setTimeout(() => {

                    currentSearch = this.value.trim();
                    fetchPayments(1);

                }, 400);

            });

        document.getElementById('perPageSelect')
            .addEventListener('change', function() {

                currentPerPage = this.value;
                fetchPayments(1);

            });

        fetchPayments();
    </script>

</body>

</html>