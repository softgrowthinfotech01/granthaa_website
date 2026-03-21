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
            placeholder="Name / contact / email"
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
        <table class="min-w-[700px] w-full text-sm border border-gray-200">

            <thead class="bg-gray-100 text-gray-700">
                <tr>
                    <th class="p-3 text-left">Advisor Name</th>
                    <th class="p-3 text-left">Amount</th>
                    <th class="p-3 text-left">Payment Mode</th>
                    <th class="p-3 text-left">Reference No</th>
                    <th class="p-3 text-left">Remark</th>
                    <th class="p-3 text-left">Date</th>
                </tr>
            </thead>

            <tbody id="paymentData" class="divide-y divide-gray-200"></tbody>

        </table>
</div>
        <div id="pagination" class="mt-4 flex justify-center items-center gap-2"></div>

</div>
<?php include 'footer.php'; ?>

<script src="../url.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {

    const token = localStorage.getItem("auth_token");

    if (!token) {
        alert("Please login first");
        window.location.href = "../login";
        return;
    }

    const authUser = JSON.parse(localStorage.getItem("auth_user"));
    const loggedInUser = authUser?.user ?? authUser?.data ?? authUser;

    if (!loggedInUser || !loggedInUser.id) {
        alert("User data missing. Please login again.");
        window.location.href = "../login";
        return;
    }

    const userCache = {};
    let currentPage = 1;

    async function getUserName(userId) {
        if (!userId) return "-";

        if (userCache[userId]) return userCache[userId];

        try {
            const response = await fetch(url + "users/" + userId, {
                headers: {
                    "Authorization": "Bearer " + token,
                    "Accept": "application/json"
                }
            });

            const result = await response.json();
            const userData = result.data ?? result;
            const userName = userData?.name ?? userId;

            userCache[userId] = userName;
            return userName;

        } catch (error) {
            console.error("User fetch error:", error);
            return userId;
        }
    }

    async function loadPayments(page = 1) {

        currentPage = page;

        // ✅ FIX: declare BEFORE fetch
        const searchValue = document.getElementById("searchInput").value.trim();
        const perPage = document.getElementById("perPage").value;

        try {
            const response = await fetch(
                `${url}commission/payments/created-by/${loggedInUser.id}?page=${currentPage}&per_page=${perPage}&search=${searchValue}`,
                {
                    method: "GET",
                    headers: {
                        "Authorization": "Bearer " + token,
                        "Accept": "application/json"
                    }
                }
            );

            const result = await response.json();
            console.log("Payments API:", result);

            const payments = result.data?.data ?? result.data ?? [];
            const tbody = document.getElementById("paymentData");
            tbody.innerHTML = "";

            if (!payments.length) {
                tbody.innerHTML = `
                    <tr>
                        <td colspan="6" class="text-center p-4 text-gray-500">
                            No payment records found
                        </td>
                    </tr>
                `;
                document.getElementById("pagination").innerHTML = "";
                return;
            }

            let rows = "";

            for (const row of payments) {
                const advisorName = row.user?.name ?? await getUserName(row.user_id);

                rows += `
                    <tr class="border-b bg-white">
                        <td class="p-3">${advisorName}</td>
                        <td class="p-3 text-green-600 font-semibold">₹ ${Math.abs(row.amount ?? 0)}</td>
                        <td class="p-3">${row.payment_mode ?? ""}</td>
                        <td class="p-3">${row.reference_no ?? ""}</td>
                        <td class="p-3">${row.remark ?? ""}</td>
                        <td class="p-3">${row.created_at ? new Date(row.created_at).toLocaleDateString() : ""}</td>
                    </tr>
                `;
            }

            tbody.innerHTML = rows;

            // ✅ PAGINATION
            const pagination = document.getElementById("pagination");
            pagination.innerHTML = "";

            const meta = result.data || {};
            const totalPages = meta.last_page || 1;
            const current = meta.current_page || 1;

            if (totalPages > 1) {

                if (current > 1) {
                    pagination.innerHTML += `
                        <button onclick="changePage(${current - 1})"
                        class="px-3 py-1 bg-gray-200 rounded">Prev</button>`;
                }

                for (let i = 1; i <= totalPages; i++) {
                    pagination.innerHTML += `
                        <button onclick="changePage(${i})"
                        class="px-3 py-1 rounded ${i === current ? 'bg-blue-500 text-white' : 'bg-gray-200'}">
                        ${i}</button>`;
                }

                if (current < totalPages) {
                    pagination.innerHTML += `
                        <button onclick="changePage(${current + 1})"
                        class="px-3 py-1 bg-gray-200 rounded">Next</button>`;
                }
            }

        } catch (error) {
            console.error(error);
            alert("Failed to load payments");
        }
    }

    // ✅ DELETE
    window.deletePayment = function(id) {
        if (!confirm("Delete this payment record?")) return;

        fetch(url + "commission/ledger/" + loggedInUser.id, {
            method: "DELETE",
            headers: {
                "Authorization": "Bearer " + token,
                "Accept": "application/json"
            }
        })
        .then(res => res.json())
        .then(data => {
            alert(data.message ?? "Payment deleted");
            loadPayments(currentPage);
        })
        .catch(() => alert("Delete failed"));
    };

    // ✅ PAGINATION CLICK
    window.changePage = function(page) {
        loadPayments(page);
    };

    // ✅ SEARCH + FILTER
    document.getElementById("searchBtn").addEventListener("click", () => loadPayments(1));
    document.getElementById("perPage").addEventListener("change", () => loadPayments(1));

    // INITIAL LOAD
    loadPayments();

});
</script>