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
          <!-- <th class="p-3 font-semibold text-left">ID</th> -->
          <th data-priority="1" class="p-3 font-semibold text-left"></th>
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

        const bookings = response.data?.data ?? response.data ?? [];
        const tbody = document.getElementById("customerData");
        tbody.innerHTML = "";

        bookings.forEach((row) => {

    tbody.innerHTML += `
        <tr class="border-b bg-white">
            <td class="p-2 text-center">
                <button onclick="toggleRow(${row.id})"
                    class="w-4 h-4 flex items-center justify-center border-1 rounded-full bg-green-500 text-white text-sm">
                    +
                </button>
            </td>

            <td class="p-2">${row.buyer_name ?? ''}</td>
            <td class="p-2">${row.mobile ?? ''}</td>
            <td class="p-2">${row.dob ?? ''}</td>
            <td class="p-2">${row.email ?? ''}</td>
            <td class="p-2">${row.pan_number ?? ''}</td>
            <td class="p-2">${row.aadhar_number ?? ''}</td>
            <td class="p-2">${row.address ?? ''}</td>
            <td class="p-2">${row.city ?? ''}</td>
            <td class="p-2">${row.state ?? ''}</td>
            <td class="p-2">${row.pincode ?? ''}</td>
           
            <td class="p-2"><button class="mb-2 bg-blue-500 hover:bg-blue-600 text-white px-4 py-1 rounded"
                        onclick="viewBooking(${row.id})">
                        Update
                    </button>

                    <button class="bg-red-500 hover:bg-red-600 text-white px-4 py-1 rounded"
                        onclick="deleteBooking(${row.id})">
                        Delete
                    </button></td>
        </tr>

        <tr id="expand-${row.id}" class="hidden bg-gray-50">
            <td colspan="15" class="p-4">

                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm">
                     <div><strong>Advance Booking AMT:</strong> ${row.advance_amount ?? ''}</div>
                    <div><strong>Site Location:</strong> ${row.location?.site_location ?? row.location_id ?? ''}</div>
                    <div><strong>Commission Type:</strong> ${row.commission_type ?? ''}</div>
                    <div><strong>Project Name:</strong> ${row.project_name ?? ''}</div>
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

                </div>

               

            </td>
        </tr>
    `;
});
 });
}
    window.toggleRow = function(id) {

    const row = document.getElementById("expand-" + id);
    const button = event.target;

    if (row.classList.contains("hidden")) {
        row.classList.remove("hidden");
        button.innerHTML = "−";
        button.classList.remove("bg-green-500");
        button.classList.add("bg-red-500");
    } else {
        row.classList.add("hidden");
        button.innerHTML = "+";
        button.classList.remove("bg-red-500");
        button.classList.add("bg-green-500");
    }
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