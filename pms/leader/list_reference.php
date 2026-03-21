<?php include 'header.php'; ?>

<div class="max-w-7xl mx-auto bg-white p-4 rounded-2xl shadow-xl">

    <h2 class="text-2xl font-bold mb-4 text-center">Referral Records</h2>

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
                    <th class="p-3 text-left">Sr No</th>
                    <th class="p-3 text-left">Referred Name</th>
                    <th class="p-3 text-left">Contact</th>
                    <th class="p-3 text-left">Email</th>
                    <th class="p-3 text-left">Status</th>
                    <th class="p-3 text-left">Date</th>
                    <th class="p-3 text-left">Booking Link</th>
                </tr>
            </thead>

            <tbody id="paymentData" class="divide-y divide-gray-200">

            </tbody>

        </table>

        <div id="pagination" class="mt-4 flex justify-center items-center gap-2"></div>

    </div>

</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {

        const token = localStorage.getItem("auth_token");
        const user = localStorage.getItem("auth_user");

        if (!token) {
            alert("Please login first");
            window.location.href = "../login";
            return;
        }

        let currentPageUrl = url + "referrals";

        function loadReferrals(apiUrl = currentPageUrl) {

            const search = document.getElementById("searchInput").value;
            const perPage = document.getElementById("perPage").value;

            let separator = apiUrl.includes("?") ? "&" : "?";
            let finalUrl = `${apiUrl}${separator}search=${search}&per_page=${perPage}`;

            fetch(finalUrl, {
                    headers: {
                        "Authorization": "Bearer " + token,
                        "Accept": "application/json"
                    }
                })
                .then(res => res.json())
                .then(response => {

                    const referrals = response.data?.data ?? [];
                    const currentPage = response.data.current_page;
                    const perPage = response.data.per_page;

                    const tbody = document.getElementById("paymentData");
                    tbody.innerHTML = "";

                    referrals.forEach((row, i) => {
                        let srNo = (currentPage - 1) * perPage + (i + 1);

                        tbody.innerHTML += `
                        <tr>
                            <td class="p-3">${srNo}</td>
                            <td class="p-3">${row.referred_name}</td>
                            <td class="p-3">${row.referred_contact}</td>
                            <td class="p-3">${row.referred_email}</td>
                            <td class="p-3">
                                <span class="px-2 py-1 rounded text-white ${
                                    row.status === 'converted' ? 'bg-green-500' : 'bg-yellow-500'
                                }">
                                    ${row.status}
                                </span>
                            </td>
                            <td class="p-3">${formatDate(row.created_at)}</td>
                            <td class="p-3">          
    ${
    Number(row.assigned_to) === Number(user.id)
        ? (
            row.status === "converted"
                ? `<button class="bg-gray-400 text-white px-3 py-2 rounded-lg cursor-not-allowed" disabled>
                        Already Booked
                   </button>`
                : `<a href="reference_booking.php?reference_id=${row.id}" 
                      class="inline-block bg-blue-600 text-white px-3 py-2 rounded-lg hover:bg-blue-700 transition">
                        Create Booking
                   </a>`
          )
        : `<button class="bg-gray-300 text-gray-700 px-3 py-2 rounded-lg cursor-not-allowed" disabled>
                Assigned to Adviser
           </button>`
}
</td>
                        </tr>
                    `;
                    });

                    renderPagination(response.data.links);
                });
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

                btn.onclick = () => {
                    loadReferrals(link.url);
                };

                pagination.appendChild(btn);
            });
        }

        function formatDate(dateStr) {
            const date = new Date(dateStr);
            return date.toLocaleDateString("en-IN");
        }

        document.getElementById("searchBtn").addEventListener("click", function() {
            loadReferrals();
        });

        document.getElementById("perPage").addEventListener("change", function() {
            loadReferrals();
        });

        loadReferrals();
    });
</script>
<?php include 'footer.php'; ?>