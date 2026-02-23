<?php include 'header.php'; ?>

<div class="max-w-7xl mx-auto bg-white p-4 rounded-2xl shadow-xl">

  <h2 class="text-2xl font-bold mb-4 text-center">Customer and Plot Details</h2>

  <!-- Horizontal scroll wrapper -->
  <div class="w-full overflow-x-auto">
<div class="flex flex-wrap gap-3 mb-4">

    <input type="text" id="searchInput" 
           placeholder="Search buyer / project / mobile"
           class="border p-2 rounded w-64">

    <button id="searchBtn"
            class="bg-blue-500 text-white px-4 rounded">
        Search
    </button>

    <select id="perPage" class="border p-2 rounded">
        <option value="10">10</option>
        <option value="25">25</option>
        <option value="50">50</option>
    </select>

</div>

    <table id="example" class="" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">

      <thead class="bg-gradient-to-r from-gray-100 to-gray-200 text-gray-700">
        <tr>
          <th class="p-3 font-semibold text-left">ID</th>
          <th data-priority="1" class="p-3 font-semibold text-left">Leader Name</th>
          <th data-priority="2" class="p-3 font-semibold text-left">Buyer Name</th>
          <th data-priority="3" class="p-3 font-semibold text-left">Phone</th>
          <th data-priority="4" class="p-3 font-semibold text-left">DOB</th>
          <th data-priority="5" class="p-3 font-semibold text-left">Email</th>
          <th data-priority="6" class="p-3 font-semibold text-left">PAN No.</th>
          <th data-priority="7" class="p-3 font-semibold text-left">Aadhar No.</th>
          <th data-priority="8" class="p-3 font-semibold text-left">Address</th>
          <th data-priority="9" class="p-3 font-semibold text-left">City</th>
          <th data-priority="10" class="p-3 font-semibold text-left">State</th>
          <th data-priority="11" class="p-3 font-semibold text-left">Pin code</th>
          <th data-priority="12" class="p-3 font-semibold text-left">Advanced Booking AMT</th>
          <th data-priority="13" class="p-3 font-semibold text-left">Site Location</th>
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
          <th data-priority="27" class="p-3 font-semibold text-center">Action</th>
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

<script src="../url.js"></script>
<script src="../url.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {

    const token = localStorage.getItem('auth_token');
    if (!token) {
        alert("Please login first");
        window.location.href = "../login";
        return;
    }

    let currentPage = 1;

   function loadBookings() {

        fetch(`${url}bookings?per_page=1000`, {
            method: "GET",
            headers: {
                "Authorization": "Bearer " + token,
                "Accept": "application/json"
            }
        })
        .then(res => res.json())
        .then(response => {

            const bookings = response.data?.data ?? response;
            const tbody = document.getElementById("customerData");
            tbody.innerHTML = "";

            const visibleCount = 5;

            bookings.forEach((row, index) => {

                const hiddenClass = index >= visibleCount ? "hidden-row hidden" : "";

                tbody.innerHTML += `
                    <tr class="border-b ${hiddenClass}">
                        <td class="p-2">
                            ${index === 0 && bookings.length > visibleCount ? `
                                <button onclick="toggleRows()" 
                                        class="text-blue-600 font-bold text-lg mr-2"
                                        id="toggleBtn">+</button>
                            ` : ''}
                            ${row.id}
                        </td>
                        <td class="p-2">${row.buyer_name ?? ''}</td>
                        <td class="p-2">${row.mobile ?? ''}</td>
                        <td class="p-2">${row.project_name ?? ''}</td>
                        <td class="p-2">${row.advance_amount ?? ''}</td>
                    </tr>
                `;
            });
        });
    }

    window.toggleRows = function () {

        const hiddenRows = document.querySelectorAll(".hidden-row");
        const btn = document.getElementById("toggleBtn");

        hiddenRows.forEach(row => {
            row.classList.toggle("hidden");
        });

        btn.textContent = btn.textContent === "+" ? "−" : "+";
    }

    window.changePage = function(page) {
        loadBookings(page);
    }

    document.getElementById("searchBtn").addEventListener("click", function() {
        loadBookings(1);
    });

    document.getElementById("perPage").addEventListener("change", function() {
        loadBookings(1);
    });

    loadBookings();
});
</script>