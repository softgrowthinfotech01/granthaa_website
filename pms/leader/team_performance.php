<?php include 'header.php'; ?>
<!-- http://127.0.0.1:8000/api/adviserPerformance -->
<div class="max-w-7xl mx-auto bg-white p-4 rounded-2xl shadow-xl">

  <h2 class="text-2xl font-bold mb-4 text-center">
    Team Performance & Bookings
  </h2>

  <!-- Table Wrapper -->
  <div class="w-full overflow-x-auto">

    <table id="example" class="" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">

      <thead class="bg-gradient-to-r from-gray-100 to-gray-200 text-gray-700">
        <tr>
          <th data-priority="1" class="p-3 font-semibold">Advisor Code</th>
          <th data-priority="2" class="p-3 font-semibold">Advisor Name</th>
          <th data-priority="3" class="p-3 font-semibold">Location</th>
          <th data-priority="4" class="p-3 font-semibold">Total Deals</th>
          <th data-priority="5" class="p-3 font-semibold">Total Booking Amount</th>
          <th data-priority="6" class="p-3 font-semibold">Commission</th>
          <th data-priority="7" class="p-3 font-semibold">Rank</th>
        </tr>
      </thead>

      <tbody class="divide-y divide-gray-200 text-center">
      </tbody>

    </table>

  </div>

</div>

<?php include 'footer.php'; ?>




<!-- jQuery -->
<script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

<!--Datatables -->
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script src="../url.js"></script>
<script>
  $(document).ready(function() {

    // Get token from localStorage
    const token = localStorage.getItem('auth_token');
    if (!token) {
      alert("Please login first");
      window.location.href = "../login";
      return;
    }

    var table = $('#example').DataTable({
      responsive: true
    });

    // 🔥 AJAX call with Bearer token
    $.ajax({
      url: url + "adviserPerformance", // make sure 'url' is defined in url.js
      type: "GET",
      headers: {
        "Authorization": "Bearer " + token,
        "Accept": "application/json"
      },
      success: function(response) {

        var advisors = response.data && response.data.data ? response.data.data : [];

        table.clear();

        advisors.forEach(function(advisor) {

          table.row.add([
            advisor.user_code ?? '-',
            advisor.name ?? '-',
            advisor.address ?? '-',
            advisor.total_deals ?? '-',
            `<span class="px-3 py-1 rounded-full bg-gray-100 text-gray-700 text-xs font-semibold">
                        ${advisor.total_booking_amount ?? '00.0'}
                    </span>`,
            `<span class="px-3 py-1 rounded-full bg-blue-50 text-blue-600 text-xs font-semibold">
                        ${advisor.bank_ifsc_code ?? '-'}
                    </span>`,
            `
                    <div class="flex flex-col sm:flex-row gap-2 justify-center">
                        <a href="update_advisor.php?id=${advisor.id}"
                           class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-1.5 rounded-lg shadow-sm transition">
                           Update
                        </a>
                        <button onclick="deleteAdvisor(${advisor.id})"
                           class="bg-red-500 hover:bg-red-600 text-white px-4 py-1.5 rounded-lg shadow-sm transition">
                           Delete
                        </button>
                    </div>
                    `
          ]);
        });

        table.draw();
      },
      error: function(error) {
        console.log("Error fetching advisors:", error);
        if (error.status === 401 || error.status === 403) {
          alert("Unauthorized. Please login again.");
          window.location.href = "../login";
        }
      }
    });

  });

  // 🔥 Delete Function with Bearer token
  function deleteAdvisor(id) {
    const token = localStorage.getItem('auth_token');
    if (!token) {
      alert("Please login first");
      window.location.href = "../login";
      return;
    }

    if (!confirm("Are you sure you want to delete this advisor?")) return;

    $.ajax({
      url: url + "users/" + id,
      type: "DELETE",
      headers: {
        "Authorization": "Bearer " + token,
        "Accept": "application/json"
      },
      success: function(response) {
        alert("Deleted Successfully");
        location.reload();
      },
      error: function(error) {
        console.log("Delete error:", error);
        if (error.status === 401 || error.status === 403) {
          alert("Unauthorized. Please login again.");
          window.location.href = "../login";
        }
      }
    });
  }
</script>