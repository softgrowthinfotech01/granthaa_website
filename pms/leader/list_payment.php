<?php include 'header.php'; ?>
<div class="max-w-7xl mx-auto bg-white p-4 sm:p-6 rounded-2xl shadow-xl">

    <h2 class="text-xl sm:text-2xl font-bold mb-4 text-center">
        Payment Records
    </h2>

    <!-- 🔹 SEARCH + FILTER -->
  <div class="mb-4 grid grid-cols-1 sm:grid-cols-2 items-center gap-3">

    <!-- LEFT SIDE -->
    <div class="flex flex-wrap justify-start sm:justify-center gap-3">
        <input type="text" id="searchInput"
            placeholder="Search user / reference"
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

    <!-- 🔹 TABLE -->
    <div class="w-full overflow-x-auto">

        <table class="min-w-[700px] w-full text-sm border border-gray-200">

            <thead class="bg-gray-100 text-gray-700">
                <tr>
                    <th class="p-3 text-left whitespace-nowrap">User</th>
                    <th class="p-3 text-left whitespace-nowrap">Amount</th>
                    <th class="p-3 text-left whitespace-nowrap">Payment Mode</th>
                    <th class="p-3 text-left whitespace-nowrap">Reference No</th>
                    <th class="p-3 text-left whitespace-nowrap">Remark</th>
                    <th class="p-3 text-left whitespace-nowrap">Date</th>
                </tr>
            </thead>

            <tbody id="paymentData" class="divide-y divide-gray-200"></tbody>

        </table>

    </div>

    <!-- 🔹 PAGINATION -->
    <div id="pagination" class="mt-4 flex flex-wrap justify-center items-center gap-2"></div>

</div>
<?php include 'footer.php'; ?>

<script src="../url.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {

        const token = localStorage.getItem('auth_token');

        if (!token) {
            alert("Please login first");
            window.location.href = "../login";
            return;
        }

        function loadPayments() {

            const user = JSON.parse(localStorage.getItem("auth_user"));

            fetch(url + "commission/payments/created-by/" + user.id, {
                    method: "GET",
                    headers: {
                        "Authorization": "Bearer " + token,
                        "Accept": "application/json"
                    }
                })
                .then(res => res.json())
                .then(response => {

                    const payments = response.data?.data ?? [];
                    const tbody = document.getElementById("paymentData");

                    tbody.innerHTML = "";

                    if (payments.length === 0) {
                        tbody.innerHTML = `
<tr>
<td colspan="8" class="text-center p-4 text-gray-500">
No payment records found
</td>
</tr>`;
                        return;
                    }

                    let rows = "";

                    payments.forEach(row => {

                        rows += `
<tr class="border-b bg-white">


<td class="p-2">
${row.user?.name ?? row.user_id}
</td>

<td class="p-2 text-green-600 font-semibold">
₹ ${Math.abs(row.amount)}
</td>

<td class="p-2">${row.payment_mode ?? ''}</td>

<td class="p-2">${row.reference_no ?? ''}</td>

<td class="p-2">${row.remark ?? ''}</td>

<td class="p-2">
${new Date(row.created_at).toLocaleDateString()}
</td>



</tr>
`;

                    });

                    tbody.innerHTML = rows;

                })
                .catch(error => {
                    console.error(error);
                    alert("Failed to load payments");
                });

        }

        window.deletePayment = function(id) {

            if (!confirm("Delete this payment record?")) {
                return;
            }

            const user = JSON.parse(localStorage.getItem("auth_user"));

            if (!user) {
                alert("User data missing. Please login again.");
                window.location.href = "../login";
                return;
            }

            fetch(url + "commission/ledger/" + user.id, {
                    method: "DELETE",
                    headers: {
                        "Authorization": "Bearer " + token,
                        "Accept": "application/json"
                    }
                })
                .then(res => res.json())
                .then(data => {

                    alert(data.message ?? "Payment deleted successfully");
                    loadPayments();

                })
                .catch(error => {
                    console.error(error);
                    alert("Delete failed");
                });

        }

        loadPayments();

    });
</script>