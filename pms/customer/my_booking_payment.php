<?php include 'header.php'; ?>

<div class="max-w-7xl mx-auto bg-white p-3 sm:p-4 rounded-2xl shadow-xl">

    <h2 class="text-xl sm:text-2xl font-bold mb-4 text-center">
        My Booking Payments
    </h2>

    <!-- Top controls -->
    <div class="mb-4">
        <div class="flex flex-wrap sm:flex-nowrap items-center gap-3 w-fit">
            <input type="text" id="searchInput"
                placeholder="Search by project name / plot no. "
                class="border p-3 rounded-md w-[60%] sm:w-80 text-sm">

            <button id="searchBtn"
                class="bg-blue-500 text-white px-6 py-3 rounded-md whitespace-nowrap">
                Search
            </button>

            <select id="perPage" class="border p-3 rounded-md w-20">
                <option value="10">10</option>
                <option value="25">25</option>
                <option value="50">50</option>
            </select>
        </div>
    </div>

    <!-- Table wrapper -->
    <div class="w-full overflow-x-auto rounded-lg border border-gray-200">
        <table id="example" class="min-w-[850px] w-full text-sm sm:text-base">
            <thead class="bg-gradient-to-r from-gray-100 to-gray-200 text-gray-700 sticky top-0 z-10">
                <tr>
                    <th class="p-3 text-left whitespace-nowrap">Customer</th>
                    <th class="p-3 text-left whitespace-nowrap">Amount</th>
                    <th class="p-3 text-left whitespace-nowrap">Paid</th>
                    <th class="p-3 text-left whitespace-nowrap">Balance</th>
                    <th class="p-3 text-left whitespace-nowrap">Project</th>
                    <th class="p-3 text-left whitespace-nowrap">Plot</th>
                    <th class="p-3 text-left whitespace-nowrap">Action</th>
                </tr>
            </thead>

            <tbody id="paymentData" class="divide-y divide-gray-200">
                <!-- data comes here -->
            </tbody>
        </table>
    </div>

    <div id="noDataMessage" class="hidden text-center text-gray-500 py-6">
        No payment records found
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
        let filteredBookings = [];
        let currentPage = 1;

        function loadPayments() {
            fetch(url + "my-book-payments", {
                    method: "GET",
                    headers: {
                        "Authorization": "Bearer " + token,
                        "Accept": "application/json"
                    }
                })
                .then(res => res.json())
                .then(response => {
                    allBookings = response.data ?? [];
                    filteredBookings = [...allBookings];
                    currentPage = 1;
                    renderPayments();
                })
                .catch(err => {
                    console.error("Payment load error:", err);
                    alert("Failed to load payments");
                });
        }

        function renderPayments() {
            const tbody = document.getElementById("paymentData");
            const noDataMessage = document.getElementById("noDataMessage");
            const perPage = parseInt(document.getElementById("perPage").value) || 10;

            let html = "";

            if (!filteredBookings.length) {
                tbody.innerHTML = "";
                noDataMessage.classList.remove("hidden");
                return;
            }

            noDataMessage.classList.add("hidden");

            const start = (currentPage - 1) * perPage;
            const end = start + perPage;
            const paginatedBookings = filteredBookings.slice(start, end);

            paginatedBookings.forEach((booking) => {
                const groupClass = "group_" + booking.booking_id;

                html += `
                <tr class="bg-gray-100 font-semibold cursor-pointer hover:bg-gray-200 transition"
                    onclick="togglePayments('${groupClass}')">
                    <td class="p-3 whitespace-nowrap">${booking.buyer_name ?? '-'}</td>
                    <td class="p-3 whitespace-nowrap">₹ ${booking.total_amount ?? 0}</td>
                    <td class="p-3 whitespace-nowrap text-green-600">₹ ${booking.paid_amount ?? 0}</td>
                    <td class="p-3 whitespace-nowrap text-red-600">₹ ${booking.balance_amount ?? 0}</td>
                    <td class="p-3 whitespace-nowrap">${booking.project_name ?? '-'}</td>
                    <td class="p-3 whitespace-nowrap">${booking.plot_number ?? '-'}</td>
                    <td class="p-3 text-center whitespace-nowrap">▼</td>
                </tr>
            `;

                if (Array.isArray(booking.payments) && booking.payments.length > 0) {
                    booking.payments.forEach(payment => {
                        html += `
                        <tr class="${groupClass} bg-white" style="display:none;">
                            <td class="p-3 pl-6 sm:pl-10 text-gray-600">↳ Payment</td>
                            <td class="p-3 whitespace-nowrap">₹ ${payment.amount ?? 0}</td>
                            <td class="p-3 whitespace-nowrap">${payment.payment_type ?? '-'}</td>
                            <td class="p-3 whitespace-nowrap">${payment.payment_mode ?? '-'}</td>
                            <td class="p-3 whitespace-nowrap">${payment.remark ?? '-'}</td>
                            <td class="p-3 whitespace-nowrap">${formatDate(payment.created_at)}</td>
                            <td class="p-3 whitespace-nowrap">-</td>
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

            tbody.innerHTML = html;
        }

        window.togglePayments = function(groupClass) {
            const rows = document.querySelectorAll("." + groupClass);

            rows.forEach(row => {
                row.style.display = (getComputedStyle(row).display === "none") ? "table-row" : "none";
            });
        };

        function formatDate(dateStr) {
            if (!dateStr) return "-";
            const date = new Date(dateStr);
            return date.toLocaleDateString("en-IN", {
                day: "2-digit",
                month: "short",
                year: "numeric"
            });
        }

        document.getElementById("searchBtn").addEventListener("click", function() {
            const searchValue = document.getElementById("searchInput").value.trim().toLowerCase();
            currentPage = 1;

            if (!searchValue) {
                filteredBookings = [...allBookings];
                renderPayments();
                return;
            }

            filteredBookings = allBookings.filter(booking => {
                const project = String(booking.project_name ?? "").toLowerCase();
                const plot = String(booking.plot_number ?? "").toLowerCase();

                let paymentRemark = "";
                if (Array.isArray(booking.payments) && booking.payments.length > 0) {
                    paymentRemark = booking.payments
                        .map(p => String(p.remark ?? ""))
                        .join(" ")
                        .toLowerCase();
                }

                return (
                    project.includes(searchValue) ||
                    plot.includes(searchValue) ||
                    buyer.includes(searchValue) ||
                    paymentRemark.includes(searchValue)
                );
            });

            renderPayments();
        });

        document.getElementById("searchInput").addEventListener("keyup", function(e) {
            if (e.key === "Enter") {
                document.getElementById("searchBtn").click();
            }
        });

        document.getElementById("perPage").addEventListener("change", function() {
            currentPage = 1;
            renderPayments();
        });

        loadPayments();
    });
</script>