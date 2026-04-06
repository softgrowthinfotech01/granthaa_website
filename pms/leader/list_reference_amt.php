<?php include 'header.php'; ?>

<div class="max-w-7xl mx-auto bg-white p-4 sm:p-6 rounded-2xl shadow-xl">

    <h2 class="text-xl sm:text-2xl font-bold mb-4 text-center">
        Reference Amount Records
    </h2>

    <!-- SEARCH + PER PAGE -->
    <div class="mb-4 grid grid-cols-1 sm:grid-cols-2 items-center gap-3">

        <!-- LEFT -->
        <div class="flex flex-wrap justify-start gap-3">
            <input type="text" id="searchInput"
                placeholder="name / contact / email"
                class="border p-2 rounded w-64">

            <button id="searchBtn"
                class="bg-blue-500 text-white px-4 py-1 rounded">
                Search
            </button>
        </div>

        <!-- RIGHT -->
        <div class="flex justify-end gap-2">
            <span class="text-sm text-gray-600">Show:</span>
            <select id="perPage" class="border p-2 rounded">
                <option value="10">10</option>
                <option value="25">25</option>
                <option value="50">50</option>
            </select>
        </div>

    </div>

    <!-- TABLE -->
    <div class="w-full overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gradient-to-r from-gray-100 to-gray-200 text-gray-700">
                <tr>
    <th class="p-3 text-left">Sr No</th>
    <th class="p-3 text-left">Site Location</th>
    <th class="p-3 text-left">Customer</th>
    <th class="p-3 text-left">Referral Type</th>
    <th class="p-3 text-left">Referral Value</th>
    <th class="p-3 text-left">Created Date</th>
</tr>
            </thead>

            <tbody id="paymentData" class="divide-y divide-gray-200"></tbody>
        </table>
    </div>

    <!-- PAGINATION -->
    <div id="pagination" class="mt-4 flex justify-center items-center gap-2"></div>

</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {

    const token = localStorage.getItem("auth_token");

    if (!token) {
        alert("Please login first");
        window.location.href = "../login";
        return;
    }

    let currentPageUrl = url + "referral-setting";

    async function loadReferralSettings(apiUrl = currentPageUrl) {

        try {
            const res = await fetch(apiUrl, {
                headers: {
                    "Authorization": "Bearer " + token,
                    "Accept": "application/json"
                }
            });

            const result = await res.json();

            const records = result.data?.data || result.data || [];

            const currentPage = result.data?.current_page || 1;
            const perPageVal = result.data?.per_page || 10;

            const tbody = document.getElementById("paymentData");
            tbody.innerHTML = "";

            if (records.length === 0) {
                tbody.innerHTML = `
                    <tr>
                        <td colspan="6" class="text-center p-4 text-gray-500">
                            No records found
                        </td>
                    </tr>
                `;
                return;
            }

            records.forEach((row, i) => {

    let commissionDisplay = row.type === 'percent'
        ? `${row.value}%`
        : `₹ ${row.value}`;

    tbody.innerHTML += `
<tr>
    <td class="p-3">${i + 1}</td>

    <!-- ✅ SITE LOCATION -->
    <td class="p-3">
        ${row.location?.site_location ?? '-'}
    </td>

    <!-- ✅ CUSTOMER NAME -->
    <td class="p-3">
        ${row.referal?.name ?? row.target_user_id}
    </td>

    <!-- TYPE -->
    <td class="p-3">
        ${row.type === 'percent' ? 'Percentage (%)' : 'Fixed Amount (₹)'}
    </td>

    <!-- VALUE -->
    <td class="p-3 font-semibold text-green-600">
        ${commissionDisplay}
    </td>

    <!-- DATE -->
    <td class="p-3">
        ${formatDate(row.created_at)}
    </td>
</tr>
`;
});

            renderPagination(result.data?.links || []);

        } catch (error) {
            console.error(error);
            alert("Error loading referral settings");
        }
    }

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

            btn.onclick = () => loadReferralSettings(link.url);

            pagination.appendChild(btn);
        });
    }

    function formatDate(dateStr) {
        if (!dateStr) return '-';
        const date = new Date(dateStr);
        return date.toLocaleDateString("en-IN");
    }

    // Optional (kept from your code)
    document.getElementById("searchBtn").addEventListener("click", () => loadReferralSettings());
    document.getElementById("perPage").addEventListener("change", () => loadReferralSettings());

    loadReferralSettings();

});
</script>


<?php include 'footer.php'; ?>