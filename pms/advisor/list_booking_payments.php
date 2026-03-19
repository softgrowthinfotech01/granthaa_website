
<?php include 'header.php'; ?>

<div class="max-w-7xl mx-auto bg-white p-4 rounded-2xl shadow-xl">

    <h2 class="text-2xl font-bold mb-4 text-center">Booking Payment Records</h2>

    <!-- Horizontal scroll wrapper -->
    <div class="w-full overflow-x-auto">
        <div class="flex flex-wrap gap-3 mb-4">

            <input type="text" id="searchInput"
                placeholder="Search buyer / project / mobile"
                class="border p-2 rounded w-64">

            <button id="searchBtn"
                class="bg-blue-500 text-white px-4 rounded">
                Search
            </button>

            <select id="perPage" class="border p-2 rounded">
                <option value="10">10</option>
                <option value="25">25</option>
                <option value="50">50</option>
            </select>

        </div>

        <table id="example" class="" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">

            <thead class="bg-gradient-to-r from-gray-100 to-gray-200 text-gray-700">
                <tr class="text-center">
                    <th data-priority="1" class="p-3 font-semibold text-left">Booking </th>
                    <th data-priority="2" class="p-3 font-bold text-left">Project </th>
                    <th data-priority="3" class="p-3 font-semibold text-left">Plot No.</th>
                    <th data-priority="4" class="p-3 font-semibold text-left">Total AMT</th>
                    <th data-priority="5" class="p-3 font-semibold text-left">Paid AMT</th>
                    <th data-priority="6" class="p-3 font-semibold text-left">Balance AMT</th>
                    <th data-priority="7" class="p-3 font-semibold text-left">Payment AMT</th>
                    <th data-priority="8" class="p-3 font-semibold text-left">Type</th>
                    <th data-priority="9" class="p-3 font-semibold text-center">Mode</th>
                    <th data-priority="10" class="p-3 font-semibold text-center">Remark</th>
                </tr>
            </thead>

            <tbody id="paymentData" class="divide-y divide-gray-200">
                <!-- Data will be populated here via Fetch API -->
            </tbody>

        </table>
        <div id="pagination" class="mt-4 flex justify-center items-center gap-2"></div>

    </div>

</div>

<?php include 'footer.php'; ?>
<script src="../url.js"></script>

<script>
document.addEventListener("DOMContentLoaded", async function () {

    const token = localStorage.getItem("auth_token");

    let allPayments = [];
    let currentPage = 1;
    let perPage = 10;

    /* ================= LOAD PAYMENTS ================= */
    async function loadPayments() {

        const tbody = document.getElementById("paymentData");
        tbody.innerHTML = `<tr><td colspan="10">Loading...</td></tr>`;

        try {
            const res = await fetch(url + "my-book-payments", {
                headers: {
                    "Authorization": "Bearer " + token
                }
            });

            const response = await res.json();
            console.log(response);

            allPayments = response.data || [];

            renderTable();

        } catch (err) {
            console.error(err);
        }
    }

    /* ================= FORMAT MONEY ================= */
    function money(val) {
        return "₹ " + parseFloat(val || 0).toLocaleString("en-IN");
    }

    /* ================= RENDER TABLE ================= */
    function renderTable() {

        const tbody = document.getElementById("paymentData");
        const search = document.getElementById("searchInput").value.toLowerCase();

        // 🔍 SEARCH FILTER
        let filtered = allPayments.filter(p => {

            let b = p.booking || {};

            return (
                (b.buyer_name || '').toLowerCase().includes(search) ||
                (b.user_code || '').toLowerCase().includes(search) ||
                (b.project_name || '').toLowerCase().includes(search) ||
                (b.plot_number || '').toLowerCase().includes(search)
            );
        });

        // 📄 PAGINATION
        let start = (currentPage - 1) * perPage;
        let paginated = filtered.slice(start, start + perPage);

        tbody.innerHTML = "";

        if (paginated.length === 0) {
            tbody.innerHTML = `
                <tr><td colspan="10" class="text-center p-4">No Records Found</td></tr>
            `;
        }

        paginated.forEach(p => {

            let b = p.booking || {};

            let total = parseFloat(b.total_booking_amount) || 0;
            let paid = parseFloat(b.advance_amount) || 0;
            let balance = total - paid;

            tbody.innerHTML += `
                <tr class="border-b hover:bg-gray-50 text-center">

                    <!-- Customer -->
                    <td class="p-3">
                        <div class="font-semibold">${b.buyer_name ?? ''}</div>
                        <div class="text-xs text-gray-800">${b.user_code ?? ''}</div>
                    </td>

                    <!-- Project -->
                    <td class="p-3">${b.project_name ?? ''}</td>

                    <!-- Plot -->
                    <td class="p-3">${b.plot_number ?? ''}</td>

                    <!-- Total -->
                    <td class="p-3 text-blue-600 font-semibold">${money(total)}</td>

                    <!-- Paid -->
                    <td class="p-3 text-green-600 font-semibold">${money(paid)}</td>

                    <!-- Balance -->
                    <td class="p-3 font-semibold ${balance > 0 ? 'text-red-500' : 'text-green-600'}">
                        ${money(balance)}
                    </td>

                    <!-- Payment -->
                    <td class="p-3 font-bold text-indigo-600">${money(p.amount)}</td>

                    <!-- Type -->
                    <td class="p-3">
                        <span class="px-2 py-1 text-sm rounded bg-yellow-100 text-yellow-700">
                            ${p.payment_type}
                        </span>
                    </td>

                    <!-- Mode -->
                    <td class="p-3 text-center">${p.payment_mode}</td>

                    <!-- Remark -->
                    <td class="p-3 text-sm text-gray-600">${p.remark ?? '-'}</td>

                </tr>
            `;
        });

        renderPagination(filtered.length);
    }

    /* ================= PAGINATION ================= */
    function renderPagination(totalItems) {

        let totalPages = Math.ceil(totalItems / perPage);

        document.getElementById("pagination").innerHTML = `
            <button 
                ${currentPage == 1 ? 'disabled' : ''}
                onclick="changePage(${currentPage - 1})"
                class="px-3 py-1 bg-gray-200 rounded ${currentPage == 1 ? 'opacity-50' : ''}">
                Prev
            </button>

            <span class="px-2">Page ${currentPage} of ${totalPages}</span>

            <button 
                ${currentPage == totalPages ? 'disabled' : ''}
                onclick="changePage(${currentPage + 1})"
                class="px-3 py-1 bg-gray-200 rounded ${currentPage == totalPages ? 'opacity-50' : ''}">
                Next
            </button>
        `;
    }

    /* ================= EVENTS ================= */

    // Search button
    document.getElementById("searchBtn").addEventListener("click", () => {
        currentPage = 1;
        renderTable();
    });

    // Enter search
    document.getElementById("searchInput").addEventListener("keyup", function (e) {
        if (e.key === "Enter") {
            currentPage = 1;
            renderTable();
        }
    });

    // Per page
    document.getElementById("perPage").addEventListener("change", function () {
        perPage = parseInt(this.value);
        currentPage = 1;
        renderTable();
    });

    // Global pagination
    window.changePage = function (page) {
        currentPage = page;
        renderTable();
    }

    /* ================= INIT ================= */
    loadPayments();

});
</script>