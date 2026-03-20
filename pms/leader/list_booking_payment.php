
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
   document.addEventListener("DOMContentLoaded", function () {

    const token = localStorage.getItem("auth_token");

    if (!token) {
        alert("Please login first");
        window.location.href = "../login";
        return;
    }

    function loadPayments() {

        fetch(url + "my-book-payments", {
            headers: {
                "Authorization": "Bearer " + token,
                "Accept": "application/json"
            }
        })
        .then(res => res.json())
        .then(response => {

            const bookings = response.data ?? [];
            const tbody = document.getElementById("paymentData");

            let html = "";

            bookings.forEach((booking, index) => {

                // unique id for toggle
                const paymentRowId = `payments-${index}`;

                // =========================
                // 🔹 BOOKING ROW (CLICKABLE)
                // =========================
                html += `
                    <tr class="bg-gray-200 font-bold cursor-pointer" onclick="togglePayments('${paymentRowId}')">
                        <td class="p-3">${booking.buyer_name}</td>
                        <td class="p-3">₹ ${booking.total_amount ?? 0}</td>
                        <td class="p-3 text-green-600">Paid: ₹ ${booking.paid_amount}</td>
                        <td class="p-3 text-red-600">Balance: ₹ ${booking.balance_amount}</td>
                        <td class="p-3">${booking.project_name ?? '-'}</td>
                        <td class="p-3">${booking.plot_number ?? '-'}</td>
                        <td class="p-3">▼</td>
                    </tr>
                `;

                // =========================
                // 🔹 PAYMENTS CONTAINER (HIDDEN)
                // =========================
                html += `<tbody id="${paymentRowId}" style="display:none;">`;

                if (booking.payments && booking.payments.length > 0) {

                    booking.payments.forEach(payment => {

                        html += `
                            <tr class="bg-gray-50">
                                <td class="p-3 pl-10 text-gray-600">↳ Payment</td>
                                <td class="p-3">₹ ${payment.amount}</td>
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
                        <tr>
                            <td colspan="7" class="p-3 text-center text-gray-400">
                                No payments yet
                            </td>
                        </tr>
                    `;
                }

                html += `</tbody>`;
            });

            tbody.innerHTML = html;

        })
        .catch(err => {
            console.error(err);
            alert("Failed to load payments");
        });
    }

    // =========================
    // 🔹 TOGGLE FUNCTION
    // =========================
    window.togglePayments = function (id) {

        const el = document.getElementById(id);

        if (el.style.display === "none") {
            el.style.display = "table-row-group";
        } else {
            el.style.display = "none";
        }
    };

    function formatDate(dateStr) {
        const date = new Date(dateStr);
        return date.toLocaleDateString("en-IN");
    }

    loadPayments();
});
</script>