<?php include 'header.php'; ?>

<div class="max-w-7xl mx-auto bg-white p-4 sm:p-6 rounded-2xl shadow-xl">

    <h2 class="text-xl sm:text-2xl font-bold mb-4 text-center">
        Referral Records
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
                    <th class="p-3 text-left">Referrer</th>
                    <th class="p-3 text-left">Referred Customer</th>
                    <th class="p-3 text-left">Contact</th>
                    <th class="p-3 text-left">Email</th>
                    <th class="p-3 text-left">Status</th>
                    <th class="p-3 text-left">Date</th>
                    <th class="p-3 text-left">Action</th>
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

    let currentPageUrl = url + "refered";

    async function loadReferrals(apiUrl = currentPageUrl) {

        const search = document.getElementById("searchInput").value;
        const perPage = document.getElementById("perPage").value;

        let separator = apiUrl.includes("?") ? "&" : "?";
        let finalUrl = `${apiUrl}${separator}search=${search}&per_page=${perPage}`;

        try {

            // ✅ CALL BOTH APIs
            const [refRes, settingRes] = await Promise.all([
                fetch(finalUrl, {
                    headers: {
                        "Authorization": "Bearer " + token,
                        "Accept": "application/json"
                    }
                }),
                fetch(url + "referral-setting", {
                    headers: {
                        "Authorization": "Bearer " + token,
                        "Accept": "application/json"
                    }
                })
            ]);

            const refData = await refRes.json();
            const settingData = await settingRes.json();

            const referrals = refData.data?.data || [];
            const settings = settingData.data?.data || [];

            const currentPage = refData.data?.current_page || 1;
            const perPageVal = refData.data?.per_page || 10;

            const tbody = document.getElementById("paymentData");
            tbody.innerHTML = "";

            if (referrals.length === 0) {
                tbody.innerHTML = `
                    <tr>
                        <td colspan="10" class="text-center p-4 text-gray-500">
                            No records found
                        </td>
                    </tr>
                `;
                return;
            }

            referrals.forEach((row, i) => {

                let srNo = (currentPage - 1) * perPageVal + (i + 1);

                // ✅ MATCH SETTING
                const setting = settings.find(s => 
                    s.target_user_id == row.referrer_id
                );

                const type = setting?.type;
                const value = setting?.value;

                tbody.innerHTML += `
<tr>
    <td class="p-3">${srNo}</td>

    <td class="p-3 font-semibold text-blue-600">
        ${row.referrer?.name ?? '-'}
    </td>

    <td class="p-3">${row.referred_name ?? '-'}</td>

    <td class="p-3">${row.referred_contact ?? '-'}</td>

    <td class="p-3">${row.referred_email ?? '-'}</td>

    <td class="p-3">
        <span class="px-2 py-1 rounded text-white ${
            row.status === 'converted' ? 'bg-green-500' : 'bg-yellow-500'
        }">
            ${row.status ?? '-'}
        </span>
    </td>

    <td class="p-3">${formatDate(row.created_at)}</td>

    <td class="p-3">
        ${
            row.status === "converted"
            ? `<button class="bg-gray-400 text-white px-3 py-2 rounded-lg cursor-not-allowed" disabled>
                    Already Booked
               </button>`
            : `<a href="reference_booking.php?reference_id=${row.id}" 
                  class="inline-block bg-blue-600 text-white px-3 py-2 rounded-lg hover:bg-blue-700 transition">
                    Create Booking
               </a>`
        }
    </td>
</tr>
                `;
            });

            renderPagination(refData.data.links || []);

        } catch (error) {
            console.error(error);
            alert("Error loading data");
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

            btn.onclick = () => loadReferrals(link.url);

            pagination.appendChild(btn);
        });
    }

    function formatDate(dateStr) {
        if (!dateStr) return '-';
        const date = new Date(dateStr);
        return date.toLocaleDateString("en-IN");
    }

    document.getElementById("searchBtn").addEventListener("click", () => loadReferrals());
    document.getElementById("perPage").addEventListener("change", () => loadReferrals());

    loadReferrals();

});
</script>

<?php include 'footer.php'; ?>