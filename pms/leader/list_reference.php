<?php include 'header.php'; ?>

<div class="max-w-7xl mx-auto bg-white p-4 rounded-2xl shadow-xl">

    <h2 class="text-2xl font-bold mb-4 text-center">Payment Records</h2>

    <div class="w-full overflow-x-auto">

        <div class="flex justify-between flex-wrap mb-4 mr-4">

            <div>
                <input type="text" id="searchInput"
                    placeholder="Search reference / remark"
                    class="border p-2 rounded w-64">

                <button id="searchBtn"
                    class="bg-blue-500 text-white px-4 py-2 rounded">
                    Search
                </button>
            </div>

            <div>
                <select id="perPage" class="border p-2 rounded">
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                </select>
            </div>

        </div>

        <table class="w-full">

            <thead class="bg-gradient-to-r from-gray-100 to-gray-200 text-gray-700">

                <tr>

                    <th class="p-3 text-left">Customer</th>
                    <th class="p-3 text-left">Amount</th>
                    <th class="p-3 text-left">Payment Type</th>
                    <th class="p-3 text-left">Payment Mode</th>
                    <th class="p-3 text-left">Reference No</th>
                    <th class="p-3 text-left">Remark</th>
                    <th class="p-3 text-left">Date</th>

                </tr>

            </thead>

            <tbody id="paymentData" class="divide-y divide-gray-200">

            </tbody>

        </table>

        <div id="pagination" class="mt-4 flex justify-center items-center gap-2"></div>

    </div>

</div>

<script>
document.addEventListener("DOMContentLoaded", function () {

    const token = localStorage.getItem("auth_token");

    if (!token) {
        alert("Please login first");
        window.location.href = "../login";
        return;
    }

    let currentPageUrl = url + "referrals";

    // =========================
    // 🔹 LOAD REFERRALS
    // =========================
    function loadReferrals(apiUrl = currentPageUrl) {

        const search = document.getElementById("searchInput").value;
        const perPage = document.getElementById("perPage").value;

        fetch(`${apiUrl}&search=${search}&per_page=${perPage}`, {
            headers: {
                "Authorization": "Bearer " + token,
                "Accept": "application/json"
            }
        })
        .then(res => res.json())
        .then(response => {

            console.log(response); // 🔍 debug

            // ✅ CORRECT DATA ACCESS
            const referrals = response.data?.data ?? [];

            const tbody = document.getElementById("paymentData");
            tbody.innerHTML = "";

            referrals.forEach(row => {

                tbody.innerHTML += `
                    <tr>
                        <td class="p-3">${row.referred_name}</td>
                        <td class="p-3">${row.referred_contact}</td>
                        <td class="p-3">${row.referred_email}</td>
                        <td class="p-3">${row.status}</td>
                        <td class="p-3">${formatDate(row.created_at)}</td>
                    </tr>
                `;
            });

            // ✅ Pagination
            renderPagination(response.data.links);

        })
        .catch(err => {
            console.error(err);
            alert("❌ Failed to load referrals");
        });
    }

    // =========================
    // 🔹 PAGINATION
    // =========================
    function renderPagination(links) {

        const pagination = document.getElementById("pagination");
        pagination.innerHTML = "";

        links.forEach(link => {

            let btn = document.createElement("button");

            btn.innerText = link.label.replace(/&laquo;|&raquo;/g, "");
            btn.disabled = !link.url;

            btn.className = "px-3 py-1 border rounded";

            if (link.active) {
                btn.classList.add("bg-blue-500", "text-white");
            }

            btn.onclick = () => {
                loadReferrals(link.url);
            };

            pagination.appendChild(btn);
        });
    }

    // =========================
    // 🔹 DATE FORMAT
    // =========================
    function formatDate(dateStr) {
        const date = new Date(dateStr);
        return date.toLocaleDateString("en-IN");
    }

    // =========================
    // 🔹 SEARCH
    // =========================
    document.getElementById("searchBtn").addEventListener("click", function () {
        loadReferrals();
    });

    // =========================
    // 🔹 PER PAGE
    // =========================
    document.getElementById("perPage").addEventListener("change", function () {
        loadReferrals();
    });

    // =========================
    // 🔹 INITIAL LOAD
    // =========================
    loadReferrals();

});
</script>
<?php include 'footer.php'; ?>
