<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leader Data</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>

<div class="mx-auto">
<div class="flex flex-col min-h-screen">

    <?php include "header.php"; ?>

    <div class="flex flex-1">

        <?php include "sidebar.php"; ?>

        <!-- MAIN -->
        <div class="w-full sm:w-[95%] md:w-[75%] lg:w-[75%] mx-3 md:mx-auto my-4 self-start rounded-lg bg-slate-100 p-4 md:p-6 border shadow-xs">

            <!-- TOP CONTROLS -->
            <div class="mb-4 flex flex-col md:flex-row justify-between items-stretch md:items-center gap-3">

                <!-- Search -->
                <input type="text" id="searchInput"
                    placeholder="Search by Name..."
                    class="px-3 py-2 border rounded w-full md:w-1/3">

                <!-- Per Page -->
                <div class="flex flex-col md:flex-row items-start md:items-center gap-2 w-full md:w-auto">
                    <label>Show:</label>
                    <select id="perPageSelect" class="px-2 py-1 border rounded w-full md:w-auto">
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                    </select>
                    <span>entries</span>
                </div>

            </div>

            <!-- LOADER -->
            <div id="tableLoader" class="hidden text-center py-6">
                <div class="inline-block animate-spin rounded-full h-8 w-8 border-4 border-blue-500 border-t-transparent"></div>
                <p class="mt-2 text-gray-600">Loading...</p>
            </div>

            <!-- TABLE -->
            <div class="overflow-x-auto">
                <table class="w-full text-sm md:text-md text-left text-gray-600">
<thead class="text-xs text-gray-700 uppercase bg-gray-100">
<tr>
    <th class="px-4 py-3">Leader</th>
    <th class="px-4 py-3">Plots</th>
    <th class="px-4 py-3">Booking</th>
    <th class="px-4 py-3">Commission</th>
    <th class="px-4 py-3">Paid</th>
    <th class="px-4 py-3">Balance</th>
</tr>
</thead>
<tbody id="leaderTable"></tbody>
</table>
            </div>

            <!-- PAGINATION -->
            <div id="paginationControls" class="flex flex-wrap justify-center gap-2 mt-4"></div>

            <!-- RESULT INFO -->
            <div id="resultInfo" class="text-sm text-gray-600 mt-2 text-center"></div>

        </div>
    </div>

    <?php include "footer.php"; ?>

</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.js"></script>
<script>

    
const token = localStorage.getItem("auth_token");

if(!token){
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
        <tr onclick="loadLeaderDetails(${row.leader_id})" class="cursor-pointer border-b">
            <td class="px-4 py-2">${row.leader_name}</td>
            <td class="px-4 py-2">${row.total_plots}</td>
            <td class="px-4 py-2">₹${row.total_booking_amount}</td>
            <td class="px-4 py-2">₹${row.total_commission}</td>
            <td class="px-4 py-2">₹${row.paid_amount}</td>
            <td class="px-4 py-2">₹${row.balance_amount}</td>
        </tr>
        <tr id="leader-${row.leader_id}" class="hidden">
            <td colspan="6">
                <div id="leader-details-${row.leader_id}"></div>
            </td>
        </tr>
        `;
    });

});

function loadLeaderDetails(leaderId) {

    const container = document.getElementById("leader-details-" + leaderId);
    const row = document.getElementById("leader-" + leaderId);

    if (!row.classList.contains("hidden")) {
        row.classList.add("hidden");
        return;
    }

    container.innerHTML = "Loading...";

    fetch(url + "admin/leader/" + leaderId + "/details", {
        headers: {
            "Authorization": "Bearer " + token
        }
    })
    .then(res => res.json())
    .then(res => {

        let html = `
        <table class="w-full border">
            <tr>
                <th>Buyer</th>
                <th>Role</th>
                <th>Plot</th>
                <th>Booking</th>
                <th>Commission</th>
                <th>Paid</th>
                <th>Balance</th>
            </tr>
        `;

        res.data.forEach(row => {
            html += `
            <tr>
                <td>${row.buyer_name}</td>
                <td>${row.role}</td>
                <td>${row.plot_number}</td>
                <td>₹${row.booking_amount}</td>
                <td>₹${row.commission}</td>
                <td>₹${row.paid}</td>
                <td>₹${row.balance}</td>
            </tr>
            `;
        });

        html += `</table>`;

        container.innerHTML = html;
        row.classList.remove("hidden");
    });
}
</script>
</body>
</html>