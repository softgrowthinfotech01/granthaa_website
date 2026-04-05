<?php include 'header.php'; ?>
<style>
    table {
        width: 100%;
        border-collapse: collapse;
        background: white;
    }

    th,
    td {
        padding: 10px;
        border: 1px solid #ddd;
        text-align: center;
    }

    td {
        text-align: center;
    }

    th {
        background: #2c3e50;
        color: white;
    }

    tr:nth-child(even) {
        background: #f2f2f2;
    }
</style>
<div class="max-w-7xl mx-auto bg-white p-4 rounded-2xl shadow-xl">
    <h2 class="text-2xl font-bold mb-4 text-center"> My Referral Records </h2>
    <div class="flex justify-between items-center mb-4"> <!-- Search (left side) --> <input id="searchInput" type="text"
            placeholder="Search..." class="border rounded-lg px-3 py-2 w-60" /> <!-- Per Page (right side) -->
        <div class="flex items-center gap-2"> <label for="perPage">Show</label> <select id="perPage"
                class="border p-2 rounded">
                <option value="10">10</option>
                <option value="25">25</option>
                <option value="50">50</option>
            </select> <span>entries</span> </div>
    </div>
    <div class="w-full overflow-x-auto">
        <table>
            <thead>
                <tr>
                    <th>Customer Name</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Location</th>
                    <th>Status</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody id="referralBody"> </tbody>
        </table>
    </div>
    <div class="flex justify-between items-center mt-4"> <button id="prevBtn" class="bg-gray-200 px-4 py-2 rounded">
            Prev </button> <span id="pageInfo"></span> <button id="nextBtn" class="bg-gray-200 px-4 py-2 rounded"> Next
        </button> </div>
    <?php include 'footer.php'; ?>

    <script src="../url.js"></script>

    <script>

        let referrals = [];
        let filteredReferrals = [];
        let currentPage = 1;
        let rowsPerPage = 10;

        document.addEventListener("DOMContentLoaded", () => {

            fetchReferrals();

            document.getElementById("searchInput")
                .addEventListener("input", function () {

                    let term = this.value.toLowerCase().trim();

                    if (term === "") {
                        filteredReferrals = referrals;
                    }
                    else {

                        filteredReferrals = referrals.filter(r => {

                            const searchableText = [
                                r.referred_name,
                                r.referred_contact,
                                r.referred_email,
                                r.status
                            ].join(" ").toLowerCase();

                            return searchableText.includes(term) ||
                                searchableText.startsWith(term);

                        });

                    }

                    currentPage = 1;
                    renderTable();

                });


            document.getElementById("perPage").addEventListener("change", function () {

                rowsPerPage = parseInt(this.value);

                currentPage = 1;

                renderTable();

            });


            document.getElementById("prevBtn").onclick = () => {

                if (currentPage > 1) {
                    currentPage--;
                    renderTable();
                }

            };

            document.getElementById("nextBtn").onclick = () => {

                if (currentPage < Math.ceil(filteredReferrals.length / rowsPerPage)) {
                    currentPage++;
                    renderTable();
                }

            };

        });

        async function fetchReferrals() {

            try {

                const token = localStorage.getItem("auth_token");

                const response = await fetch(url + "refered", {

                    method: "GET",

                    headers: {
                        "Authorization": "Bearer " + token,
                        "Accept": "application/json"
                    }

                });

                const result = await response.json();

                referrals = result.data?.data || [];

                if (!Array.isArray(referrals)) {
                    referrals = [];
                }

                filteredReferrals = referrals;

                renderTable();

            } catch (error) {

                console.error("Error fetching referrals:", error);

            }

        }

        function renderTable() {

            const tbody = document.getElementById("referralBody");

            tbody.innerHTML = "";

            const start = (currentPage - 1) * rowsPerPage;
            const end = start + rowsPerPage;

            const pageData = filteredReferrals.slice(start, end);

            if (pageData.length === 0) {

                tbody.innerHTML = `
<tr style="text-align:center;">
<td colspan="6">No referrals found</td>
</tr>
`;

                return;

            }

            pageData.forEach(r => {

                const row = `
<tr>

<td>${r.referred_name ?? "-"}</td>

<td>${r.referred_contact ?? "-"}</td>

<td>${r.referred_email ?? "-"}</td>

<td>${r.location?.site_location ?? "-"}</td> <!-- ✅ ADD THIS -->

<td>
<span style="
padding:4px 8px;
border-radius:6px;
background:${r.status === 'pending' ? '#ffeeba' : '#c3e6cb'};
">
${r.status}
</span>
</td>

<td>${new Date(r.created_at).toLocaleDateString()}</td>

</tr>
`;

                tbody.insertAdjacentHTML("beforeend", row);

            });

            document.getElementById("pageInfo").innerText =
                `Page ${currentPage} of ${Math.ceil(filteredReferrals.length / rowsPerPage)}`;

        }

    </script>