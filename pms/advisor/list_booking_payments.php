<?php include 'header.php'; ?>

<div class="max-w-7xl mx-auto bg-white p-4 rounded-2xl shadow-xl">

    <h2 class="text-2xl font-bold mb-4 text-center">Booking Payment Records</h2>

     <!-- Horizontal scroll wrapper -->
  <div class="mb-4 grid grid-cols-1 sm:grid-cols-2 items-center gap-3">

    <!-- LEFT SIDE -->
    <div class="flex flex-wrap justify-start sm:justify-center gap-3">
        <input type="text" id="searchInput"
            placeholder="Customer / project / mobile"
            class="border p-2 rounded w-64">

        <button id="searchBtn"
            class="bg-blue-500 text-white px-4 py-1 rounded">
            Search
        </button>
    </div>

    <!-- RIGHT SIDE -->
    <div class="flex justify-end sm:justify-center gap-2">
        <span class="text-sm text-gray-600">Show:</span>
        <select id="perPage" class="border p-2 rounded">
            <option value="10">10</option>
            <option value="25">25</option>
            <option value="50">50</option>
        </select>
    </div>

</div>
 <div class="w-full overflow-x-auto">

        <table id="example" class="min-w-[900px] w-full" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">

            <thead class="bg-gradient-to-r from-gray-100 to-gray-200 text-gray-700  sticky top-0 z-10">
                <tr>
                    <th class="p-3 text-left">Customer</th>
                    <th class="p-3 text-left">Amount</th>
                    <th class="p-3 text-left">Type / Paid</th>
                    <th class="p-3 text-left">Mode / Balance</th>
                    <th class="p-3 text-left">Remark / Project</th>
                    <th class="p-3 text-left">Date / Plot</th>
                    <th class="p-3 text-left">Extra</th>
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
<script>
document.addEventListener("DOMContentLoaded", function() {

    const token = localStorage.getItem("auth_token");

    if (!token) {
        alert("Please login first");
        window.location.href = "../login";
        return;
    }

    let allBookings = [];
    let currentPage = 1;
    let perPage = 10;

    /* ================= LOAD DATA ================= */
    function loadPayments() {

        fetch(url + "my-book-payments", {
            headers: {
                "Authorization": "Bearer " + token
            }
        })
        .then(res => res.json())
        .then(response => {

            allBookings = response.data ?? [];
            renderTable();

        })
        .catch(err => console.error(err));
    }

    /* ================= RENDER TABLE ================= */
    function renderTable() {

        const tbody = document.getElementById("paymentData");
        const search = document.getElementById("searchInput").value.toLowerCase();

        // 🔍 SEARCH FILTER
        let filtered = allBookings.filter(b => {

            return (
                (b.buyer_name || '').toLowerCase().includes(search) ||
                (b.project_name || '').toLowerCase().includes(search) ||
                (b.plot_number || '').toLowerCase().includes(search)
            );
        });

        // 📄 PAGINATION
        let start = (currentPage - 1) * perPage;
        let paginated = filtered.slice(start, start + perPage);

        let html = "";

        paginated.forEach((booking) => {

            const groupClass = "group_" + booking.booking_id;

            // 🔹 BOOKING ROW
            html += `
            <tr class="bg-gray-100 font-semibold cursor-pointer"
                onclick="togglePayments('${groupClass}')">

                <td class="p-3">
                    ${booking.buyer_name ?? ''}
                </td>

                <td class="p-3 text-blue-600">
                    ₹ ${Number(booking.total_amount || 0).toLocaleString("en-IN")}
                </td>

                <td class="p-3 text-green-600">
                    Paid: ₹ ${Number(booking.paid_amount || 0).toLocaleString("en-IN")}
                </td>

                <td class="p-3 text-red-600">
                    Balance: ₹ ${Number(booking.balance_amount || 0).toLocaleString("en-IN")}
                </td>

                <td class="p-3">${booking.project_name ?? '-'}</td>
                <td class="p-3">${booking.plot_number ?? '-'}</td>

                <td class="p-3 text-center">▼</td>
            </tr>
            `;

            // 🔹 PAYMENT ROWS
            if (booking.payments && booking.payments.length > 0) {

                booking.payments.forEach(payment => {

                    html += `
                    <tr class="${groupClass}" style="display:none;">
                        <td class="p-3 pl-10 text-gray-600">↳ Payment</td>

                        <td class="p-3 font-semibold text-indigo-600">
                            ₹ ${Number(payment.amount || 0).toLocaleString("en-IN")}
                        </td>

                        <td class="p-3">${payment.payment_type}</td>
                        <td class="p-3">${payment.payment_mode}</td>
                        <td class="p-3">${payment.remark ?? '-'}</td>
                        <td class="p-3">${formatDate(payment.created_at)}</td>
                        <td class="p-3">-</td>
                    </tr>
                    `;
                });

            } else {
                html += `
                <tr class="${groupClass}" style="display:none;">
                    <td colspan="7" class="p-3 text-center text-gray-400">
                        No payments yet
                    </td>
                </tr>
                `;
            }

        });

        if (paginated.length === 0) {
            html = `<tr><td colspan="7" class="text-center p-4">No records found</td></tr>`;
        }

        tbody.innerHTML = html;

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

    document.getElementById("searchBtn").addEventListener("click", () => {
        currentPage = 1;
        renderTable();
    });

    document.getElementById("searchInput").addEventListener("keyup", function(e) {
        if (e.key === "Enter") {
            currentPage = 1;
            renderTable();
        }
    });

    document.getElementById("perPage").addEventListener("change", function() {
        perPage = parseInt(this.value);
        currentPage = 1;
        renderTable();
    });

    window.changePage = function(page) {
        currentPage = page;
        renderTable();
    }

    window.togglePayments = function(groupClass) {

        const rows = document.querySelectorAll("." + groupClass);

        rows.forEach(row => {
            row.style.display =
                row.style.display === "none" ? "table-row" : "none";
        });
    };

    function formatDate(dateStr) {
        const date = new Date(dateStr);
        return date.toLocaleDateString("en-IN");
    }

    /* ================= INIT ================= */
    loadPayments();

});
</script>