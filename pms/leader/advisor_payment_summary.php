<?php include 'header.php'; ?>

<div class="max-w-7xl mx-auto bg-white p-4 rounded-2xl shadow-xl">

    <h2 class="text-2xl font-bold mb-4 text-center">Payment Records</h2>

    <div class="w-full overflow-x-auto">

        <!-- Adviser Dropdown -->
        <div class="mb-4">
            <label class="font-semibold">Select Adviser :</label>
            <select id="adviserDropdown" class="border p-2 rounded w-64"></select>
        </div>

        <!-- Summary Cards -->
        <div class="mb-6">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">

                <!-- Total Plots -->
                <div class="bg-white border border-gray-200 rounded-2xl shadow-sm p-4 hover:shadow-md transition">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Total Plots</p>
                            <h3 id="totalPlots" class="text-2xl font-bold text-gray-800 mt-1">0</h3>
                        </div>
                        <div class="w-12 h-12 rounded-xl bg-blue-100 flex items-center justify-center text-blue-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 20h16" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 16l4-4 3 3 5-6" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Total Booking -->
                <div class="bg-white border border-gray-200 rounded-2xl shadow-sm p-4 hover:shadow-md transition">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Total Booking</p>
                            <h3 id="totalAmount" class="text-2xl font-bold text-gray-800 mt-1">0</h3>
                        </div>
                        <div class="w-12 h-12 rounded-xl bg-green-100 flex items-center justify-center text-green-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                <rect x="4" y="4" width="16" height="16" rx="2" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8 10h8" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8 14h5" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Total Commission -->
                <div class="bg-white border border-gray-200 rounded-2xl shadow-sm p-4 hover:shadow-md transition">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Total Commission</p>
                            <h3 id="totalCommission" class="text-2xl font-bold text-gray-800 mt-1">0</h3>
                        </div>
                        <div class="w-12 h-12 rounded-xl bg-yellow-100 flex items-center justify-center text-yellow-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 19h16" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M7 15v-3" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 15V9" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 15v-5" />
                                <circle cx="17" cy="6" r="2" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Paid -->
                <div class="bg-white border border-gray-200 rounded-2xl shadow-sm p-4 hover:shadow-md transition">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Paid</p>
                            <h3 id="paidAmount" class="text-2xl font-bold text-gray-800 mt-1">0</h3>
                        </div>
                        <div class="w-12 h-12 rounded-xl bg-purple-100 flex items-center justify-center text-purple-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                <rect x="3" y="5" width="18" height="14" rx="2" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 14l2 2 4-4" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Balance -->
                <div class="bg-white border border-gray-200 rounded-2xl shadow-sm p-4 hover:shadow-md transition">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Balance</p>
                            <h3 id="balanceAmount" class="text-2xl font-bold text-gray-800 mt-1">0</h3>
                        </div>
                        <div class="w-12 h-12 rounded-xl bg-red-100 flex items-center justify-center text-red-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v5" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 16h.01" />
                                <circle cx="12" cy="12" r="9" />
                            </svg>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- Logs Table -->
        <table class="w-full border">
            <thead>
                <tr class="bg-gray-200">
                    <th class="p-2">Booking ID</th>
                    <th class="p-2">Customer</th>
                    <th class="p-2">Plot</th>
                    <th class="p-2">Total Commission</th>
                    <th class="p-2">Paid Commission</th>
                    <th class="p-2">Balance</th>
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
    document.addEventListener("DOMContentLoaded", function() {

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

                    dropdown.innerHTML = "";

                    data.advisers.forEach(user => {
                        dropdown.innerHTML += `
                <option value="${user.id}" 
                    ${user.id == data.selected_adviser ? "selected" : ""}>
                    ${user.name}
                </option>
            `;
                    });

                    if (data.summary) {
                        document.getElementById("totalPlots").innerText =
                            Number(data.summary.total_plots ?? 0).toLocaleString("en-IN");

                        document.getElementById("totalAmount").innerText =
                            "₹" + Number(data.summary.total_booking_amount ?? 0).toLocaleString("en-IN");

                        document.getElementById("totalCommission").innerText =
                            "₹" + Number(data.summary.total_commission ?? 0).toLocaleString("en-IN");

                        document.getElementById("paidAmount").innerText =
                            "₹" + Number(data.summary.paid_amount ?? 0).toLocaleString("en-IN");

                        document.getElementById("balanceAmount").innerText =
                            "₹" + Number(data.summary.balance_amount ?? 0).toLocaleString("en-IN");
                    }

                    const tbody = document.getElementById("logsTable");
                    tbody.innerHTML = "";

                    data.logs.forEach(row => {
                        tbody.innerHTML += `
        <tr class="border-b">
            <td class="p-2 text-center">${row.booking_id ?? "-"}</td>
            <td class="p-2 text-center">${row.customer ?? "-"}</td>
            <td class="p-2 text-center">${row.plot_number ?? "-"}</td>
            <td class="p-2 text-center">₹${Number(row.commission ?? 0).toLocaleString("en-IN")}</td>
            <td class="p-2 text-center">₹${Number(row.paid ?? 0).toLocaleString("en-IN")}</td>
            <td class="p-2 text-center">₹${Number(row.balance ?? 0).toLocaleString("en-IN")}</td>
            <td class="p-2 text-center">${row.date ?? "-"}</td>
        </tr>
    `;
                    });
                });
        }

        // 🔁 Dropdown change
        dropdown.addEventListener("change", function() {
            loadData(this.value);
        });

        // 🚀 Initial load
        loadData();

    });
</script>