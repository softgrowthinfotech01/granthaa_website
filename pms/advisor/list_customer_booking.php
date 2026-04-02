<?php include 'header.php'; ?>

<div class="max-w-7xl mx-auto bg-white p-4 rounded-2xl shadow-xl">

    <h2 class="text-2xl font-bold mb-4 text-center">Customer and Plot Details</h2>

    <!-- Horizontal scroll wrapper -->
    <div class="mb-4 grid grid-cols-1 sm:grid-cols-2 items-center gap-3">

        <!-- LEFT SIDE -->
        <div class="flex flex-wrap justify-start sm:justify-center gap-3">
            <input type="text" id="searchInput"
                placeholder="Search buyer / project / mobile"
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
        <table id="example" class="" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">

            <thead class="bg-gradient-to-r from-gray-100 to-gray-200 text-gray-700">
                <tr>
                    <!-- <th class="p-3 font-semibold text-left">ID</th> -->
                    <th data-priority="1" class="p-3 font-semibold text-left"></th>
                    <th data-priority="2" class="p-3 font-semibold text-left">Buyer Name</th>
                    <th data-priority="9" class="p-3 font-semibold text-left">Project Name</th>
                    <th data-priority="7" class="p-3 font-semibold text-left">Site Location</th>
                    <th data-priority="9" class="p-3 font-semibold text-left">Total Booking Amount</th>
                    <th data-priority="10" class="p-3 font-semibold text-left">Commission Type</th>
                    <th data-priority="11" class="p-3 font-semibold text-left">Commission Value</th>
                    <th data-priority="11" class="p-3 font-semibold text-left">Commission Amount</th>
                    <th data-priority="5" class="p-3 font-semibold text-left">Email</th>
                    <th data-priority="12" class="p-3 font-semibold text-left">Action</th>
                    <!-- <th data-priority="13" class="p-3 font-semibold text-left">Site Location</th>
          <th data-priority="14" class="p-3 font-semibold text-left">Commission Type</th>
          <th data-priority="15" class="p-3 font-semibold text-left">Project Name</th>
          <th data-priority="16" class="p-3 font-semibold text-left">Plot / Flat No.</th>
          <th data-priority="17" class="p-3 font-semibold text-left">Khasara No.</th>
          <th data-priority="18" class="p-3 font-semibold text-left">P.H. No.</th>
          <th data-priority="19" class="p-3 font-semibold text-left">Mouza</th>
          <th data-priority="20" class="p-3 font-semibold text-left">Tahsil</th>
          <th data-priority="21" class="p-3 font-semibold text-left">District</th>
          <th data-priority="22" class="p-3 font-semibold text-left">Sq. Feet</th>
          <th data-priority="23" class="p-3 font-semibold text-left">Sq. Mtr</th>
          <th data-priority="24" class="p-3 font-semibold text-left">Total Booking Amt.</th>
          <th data-priority="25" class="p-3 font-semibold text-left">Payment Mode</th>
          <th data-priority="26" class="p-3 font-semibold text-left">Remark</th>
          <th data-priority="27" class="p-3 font-semibold text-center">Action</th> -->
                </tr>
            </thead>

            <tbody id="customerData" class="divide-y divide-gray-200">
                <!-- Data will be populated here via Fetch API -->
            </tbody>

        </table>
        <div id="pagination" class="mt-4 flex justify-center items-center gap-2"></div>

    </div>

</div>

<?php include 'footer.php'; ?>


<!-- jQuery -->
<script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

<script>
    function update_customer_booking(id) {
        window.location.href = "update_customer_booking.php?id=" + id;
    }

    function deleteBooking(id) {
        if (!confirm("Are you sure you want to delete this booking?")) return;

        const token = localStorage.getItem("auth_token");

        fetch(url + "bookings/" + id, {
                method: "DELETE",
                headers: {
                    "Authorization": "Bearer " + token,
                    "Accept": "application/json"
                }
            })
            .then(res => res.json())
            .then(data => {
                alert(data.message || "Booking deleted successfully");
                location.reload();
            })
            .catch(err => {
                console.error("Delete error:", err);
                alert("Delete failed");
            });
    }
</script>


<script>
    document.addEventListener("DOMContentLoaded", function() {

        let allBookings = [];
        let filteredBookings = [];
        let currentPage = 1;
        let perPage = 10;

        const token = localStorage.getItem('auth_token');
        if (!token) {
            alert("Please login first");
            window.location.href = "../login";
            return;
        }

        let locationsMap = {};

        function loadLocations() {
            return fetch(url + "site-location", {
                    headers: {
                        "Authorization": "Bearer " + token
                    }
                })
                .then(res => res.json())
                .then(response => {
                    const locations = response.data ?? [];
                    locations.forEach(loc => {
                        locationsMap[loc.id] = loc.site_location;
                    });
                });
        }

        async function loadBookings() {

            await loadLocations();

            fetch(`${url}bookings?per_page=1000`, {
                    headers: {
                        "Authorization": "Bearer " + token
                    }
                })
                .then(res => res.json())
                .then(response => {

                    allBookings = response.data?.data ?? response.data ?? [];
                    applyFilters();

                });
        }

        /* ================= FILTER ================= */
        function applyFilters() {

            let search = document.getElementById("searchInput").value.toLowerCase();
            perPage = parseInt(document.getElementById("perPage").value);

            filteredBookings = allBookings.filter(row => {

                return (
                    (row.buyer_name || '').toLowerCase().includes(search) ||
                    (row.project_name || '').toLowerCase().includes(search) ||
                    (row.mobile || '').toLowerCase().includes(search)
                );
            });

            currentPage = 1;
            renderTable();
        }

        /* ================= RENDER ================= */
        function renderTable() {

            const tbody = document.getElementById("customerData");
            tbody.innerHTML = "";

            let start = (currentPage - 1) * perPage;
            let paginated = filteredBookings.slice(start, start + perPage);

            paginated.forEach((row) => {

                let commission_Amount = 0;

                if (row.commission_type === "percent") {
                    commission_Amount = (row.total_booking_amount * row.adviser_commission_value) / 100;
                } else {
                    commission_Amount = row.adviser_commission_value;
                }

                let dob = row.dob ?
                    new Date(row.dob).toLocaleDateString('en-GB') :
                    '';

                tbody.innerHTML += `
            <tr class="border-b bg-white">
                <td class="p-2 text-center">
                    <button onclick="toggleRow(${row.id})"
                        class="w-4 h-4 flex items-center justify-center border rounded-full bg-green-500 text-white text-sm">
                        +
                    </button>
                </td>

                <td class="p-1">${row.buyer_name ?? ''}</td>
                <td class="p-1">${row.project_name ?? ''}</td>
                <td class="p-1">${locationsMap[row.site_location] ?? ''}</td>
                <td class="p-1">${row.total_booking_amount ?? ''}</td>
                <td class="p-1">${row.adviser_commission_type ?? ''}</td> 
                <td class="p-1">${row.adviser_commission_value ?? ''}</td>
                <td class="p-1">${commission_Amount}</td>
                <td class="p-1">${row.email ?? ''}</td>

                <td class="p-1">
                    <div class="flex gap-2">
                        <button class="bg-blue-500 text-white px-4 py-1 rounded"
                            onclick="update_customer_booking(${row.id})">
                            Update
                        </button>

                        <button class="bg-red-500 text-white px-4 py-1 rounded"
                            onclick="deleteBooking(${row.id})">
                            Delete
                        </button>
                    </div>
                </td>
            </tr>

            <tr id="expand-${row.id}" class="hidden bg-gray-50">
                <td colspan="15" class="p-4">
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm">
                        <div><strong>Advance Booking AMT:</strong> ${row.advance_amount ?? ''}</div>
                    <div><strong>Aadhar Number:</strong> ${row.aadhar_number ?? ''} </div>
                    <div><strong>State:</strong>${row.state ?? ''} </div>
                    <div><strong>City:</strong>${row.city ?? ''} </div>
                    <div><strong>Plot No:</strong> ${row.plot_number ?? ''}</div>
                    <div><strong>Khasara:</strong> ${row.khasara_number ?? ''}</div>
                    <div><strong>P.H. No:</strong> ${row.ph_number ?? ''}</div>
                    <div><strong>Mouza:</strong> ${row.mouza ?? ''}</div>
                    <div><strong>Tahsil:</strong> ${row.tahsil ?? ''}</div>
                    <div><strong>District:</strong> ${row.district ?? ''}</div>
                    <div><strong>Sq. Feet:</strong> ${row.square_feet ?? ''}</div>
                    <div><strong>Sq. Meter:</strong> ${row.square_meter ?? ''}</div>
                    <div><strong>Total Booking:</strong> ${row.total_booking_amount ?? ''}</div>
                    <div><strong>Payment Mode:</strong> ${row.payment_mode ?? ''}</div>
                    <div><strong>Remark:</strong> ${row.remark ?? ''}</div>
                    <div><strong>Pincode:</strong> ${row.pincode ?? ''}</div>
                    <div><strong>Mobile Number:</strong> ${row.mobile ?? ''}</div>
                    <div><strong>Created On:</strong> ${row.created_at ? new Date(row.created_at).toLocaleDateString("en-IN") : ''}</div>
                    </div>
                </td>
            </tr>
            `;
            });

            renderPagination();
        }

        /* ================= PAGINATION ================= */
        function renderPagination() {

            let totalPages = Math.ceil(filteredBookings.length / perPage);

            document.getElementById("pagination").innerHTML = `
            <button ${currentPage == 1 ? 'disabled' : ''}
                onclick="changePage(${currentPage - 1})"
                class="bg-gray-300 px-4 py-2 rounded">
                Prev
            </button>

            <span class="px-2">Page ${currentPage} of ${totalPages}</span>

            <button ${currentPage == totalPages ? 'disabled' : ''}
                onclick="changePage(${currentPage + 1})"
                class="bg-gray-300 px-4 py-2 rounded">
                Next
            </button>
        `;
        }

        /* ================= EVENTS ================= */

        document.getElementById("searchBtn").addEventListener("click", applyFilters);

        document.getElementById("searchInput").addEventListener("keyup", function(e) {
            if (e.key === "Enter") applyFilters();
        });

        document.getElementById("perPage").addEventListener("change", applyFilters);

        window.changePage = function(page) {
            currentPage = page;
            renderTable();
        }

        window.toggleRow = function(id) {

            const row = document.getElementById("expand-" + id);
            const button = event.target;

            if (row.classList.contains("hidden")) {
                row.classList.remove("hidden");
                button.innerHTML = "−";
                button.classList.replace("bg-green-500", "bg-red-500");
            } else {
                row.classList.add("hidden");
                button.innerHTML = "+";
                button.classList.replace("bg-red-500", "bg-green-500");
            }
        }

        /* ================= INIT ================= */
        loadBookings();

    });
</script>