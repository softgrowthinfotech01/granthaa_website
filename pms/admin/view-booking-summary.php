<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leader Data</title>
    <link rel="stylesheet" href="../style.css">
    <style>
        @keyframes fadeIn {
    from { opacity: 0; transform: translateY(-5px); }
    to { opacity: 1; transform: translateY(0); }
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

            <h2 class="text-xl font-semibold text-gray-700">Leader Summary</h2>

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

        <!-- LOADER -->
        <div id="tableLoader" class="hidden flex flex-col items-center py-10">
            <div class="animate-spin rounded-full h-10 w-10 border-4 border-blue-500 border-t-transparent"></div>
            <p class="mt-3 text-gray-500">Fetching data...</p>
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
                        <th class="px-5 py-3">Paid</th>
                        <th class="px-5 py-3">Balance</th>
                        <th class="px-5 py-3 text-center">Action</th>
                    </tr>
                </thead>

                <!-- BODY -->
                <tbody id="leaderTable" class="divide-y"></tbody>

            </table>
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
        const token = localStorage.getItem("auth_token");

        if (!token) {
            alert("Please login first");
            window.location.href = "../login";
        }

        fetch(url + "leader-summary", {
                headers: {
                    "Authorization": "Bearer " + token
                }
            })
            .then(res => res.json())
            .then(res => {

                const tbody = document.getElementById("leaderTable");
                tbody.innerHTML = "";

                res.data.forEach(row => {
                   tbody.innerHTML += `
<tr class="hover:bg-gray-50 transition duration-200">

    <td class="px-5 py-3 font-medium text-gray-800 flex items-center gap-2">
        <span id="icon-${row.leader_id}" class="transition-transform duration-200">▶</span>
        ${row.leader_name}
    </td>

    <td class="px-5 py-3">${row.total_plots}</td>

    <td class="px-5 py-3 text-green-600 font-medium">
        ₹${row.total_booking_amount}
    </td>

    <td class="px-5 py-3 text-indigo-600">
        ₹${row.total_commission}
    </td>

    <td class="px-5 py-3 text-blue-600">
        ₹${row.paid_amount}
    </td>

    <td class="px-5 py-3 font-semibold text-red-500">
        ₹${row.balance_amount}
    </td>

    <!-- BUTTON -->
    <td class="px-5 py-3 text-center">
        <button onclick="loadLeaderDetails(${row.leader_id})"
            class="px-3 py-1.5 text-sm bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition">
            View Details
        </button>
    </td>
</tr>

<tr id="leader-${row.leader_id}" class="hidden bg-gray-50">
    <td colspan="7" class="p-4">
        <div id="leader-details-${row.leader_id}"></div>
    </td>
</tr>
`;
                });

            });

        function loadLeaderDetails(leaderId) {

    const container = document.getElementById("leader-details-" + leaderId);
    const row = document.getElementById("leader-" + leaderId);
    const icon = document.getElementById("icon-" + leaderId);

    // CLOSE
    if (!row.classList.contains("hidden")) {
        row.classList.add("hidden");
        icon.innerHTML = "▶";
        return;
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
            <thead class="bg-gray-200">
                <tr>
                    <th class="p-2">Buyer</th>
                    <th class="p-2">Role</th>
                    <th class="p-2">Plot</th>
                    <th class="p-2">Booking</th>
                    <th class="p-2">Commission</th>
                    <th class="p-2">Paid</th>
                    <th class="p-2">Balance</th>
                </tr>
            </thead>
            <tbody>
        `;

        res.data.forEach(row => {
            html += `
            <tr class="border-t hover:bg-gray-100">
                <td class="p-2">${row.buyer_name}</td>
                <td class="p-2">${row.role}</td>
                <td class="p-2">${row.plot_number}</td>
                <td class="p-2">₹${row.booking_amount}</td>
                <td class="p-2">₹${row.commission}</td>
                <td class="p-2">₹${row.paid}</td>
                <td class="p-2">₹${row.balance}</td>
            </tr>
            `;
        });

        html += `</tbody></table>`;

        container.innerHTML = html;
        row.classList.remove("hidden");

        // OPEN icon
        icon.innerHTML = "▼";
    });
}
    </script>
</body>

</html>