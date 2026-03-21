<?php include 'header.php'; ?>

<div class="max-w-7xl mx-auto bg-white p-4 rounded-2xl shadow-xl">

    <h2 class="text-2xl font-bold mb-4 text-center">Payment Records</h2>

    <div class="w-full overflow-x-auto">

<!-- Adviser Dropdown -->
<div class="mb-4">
    <label class="font-semibold">Select Adviser</label>
    <select id="adviserDropdown" class="border p-2 rounded w-64"></select>
</div>

<!-- Summary Cards -->
<div class="grid grid-cols-5 gap-4 mb-6">

    <div class="bg-blue-100 p-3 rounded">
        <p>Total Plots</p>
        <h3 id="totalPlots">0</h3>
    </div>

    <div class="bg-green-100 p-3 rounded">
        <p>Total Booking</p>
        <h3 id="totalAmount">0</h3>
    </div>

    <div class="bg-yellow-100 p-3 rounded">
        <p>Commission</p>
        <h3 id="totalCommission">0</h3>
    </div>

    <div class="bg-purple-100 p-3 rounded">
        <p>Paid</p>
        <h3 id="paidAmount">0</h3>
    </div>

    <div class="bg-red-100 p-3 rounded">
        <p>Balance</p>
        <h3 id="balanceAmount">0</h3>
    </div>

</div>

<!-- Logs Table -->
<table class="w-full border">
    <thead>
        <tr class="bg-gray-200">
            <th class="p-2">Booking ID</th>
            <th class="p-2">Customer</th>
            <th class="p-2">Plot</th>
            <th class="p-2">Amount</th>
            <th class="p-2">Commission</th>
            <th class="p-2">Date</th>
        </tr>
    </thead>
    <tbody id="logsTable"></tbody>
</table>
        <div id="pagination" class="mt-4 flex justify-center items-center gap-2"></div>

    </div>

</div>

<?php include 'footer.php'; ?>
<script>
document.addEventListener("DOMContentLoaded", function () {

    const token = localStorage.getItem("auth_token");

    if (!token) {
        alert("Login required");
        return;
    }

    const dropdown = document.getElementById("adviserDropdown");

    function loadData(adviserId = "") {

        let apiUrl = url + "commission/leader-adviser-details";

        if (adviserId) {
            apiUrl += "?adviser_id=" + adviserId;
        }

        fetch(apiUrl, {
            headers: {
                "Authorization": "Bearer " + token,
                "Accept": "application/json"
            }
        })
        .then(res => res.json())
        .then(response => {

            const data = response.data;

            // 🔽 1. Fill dropdown
            dropdown.innerHTML = "";

            data.advisers.forEach(user => {
                dropdown.innerHTML += `
                    <option value="${user.id}" 
                        ${user.id == data.selected_adviser ? "selected" : ""}>
                        ${user.name}
                    </option>
                `;
            });

            // 📊 2. Summary
            if (data.summary) {
                document.getElementById("totalPlots").innerText = data.summary.total_plots;
                document.getElementById("totalAmount").innerText = data.summary.total_booking_amount;
                document.getElementById("totalCommission").innerText = data.summary.total_commission;
                document.getElementById("paidAmount").innerText = data.summary.paid_amount;
                document.getElementById("balanceAmount").innerText = data.summary.balance_amount;
            }

            // 📄 3. Logs table
            const tbody = document.getElementById("logsTable");
            tbody.innerHTML = "";

            data.logs.forEach(row => {
                tbody.innerHTML += `
                    <tr>
                        <td class="p-2">${row.booking_id}</td>
                        <td class="p-2">${row.customer}</td>
                        <td class="p-2">${row.plot_number}</td>
                        <td class="p-2">₹${row.amount}</td>
                        <td class="p-2">₹${row.commission}</td>
                        <td class="p-2">${row.date}</td>
                    </tr>
                `;
            });

        });
    }

    // 🔁 Dropdown change
    dropdown.addEventListener("change", function () {
        loadData(this.value);
    });

    // 🚀 Initial load
    loadData();

});
</script>