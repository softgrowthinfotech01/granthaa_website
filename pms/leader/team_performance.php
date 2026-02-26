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

    const token = localStorage.getItem('auth_token');

    if (!token) {
        alert("Please login first");
        window.location.href = "../login";
        return;
    }

    // Initialize DataTable
    var table = $('#example').DataTable({
        responsive: true,
        ordering: false
    });

    // Fetch Adviser Performance
    $.ajax({
        url: url + "adviserPerformance",
        type: "GET",
        headers: {
            "Authorization": "Bearer " + token,
            "Accept": "application/json"
        },
        success: function(response) {

            let advisors = response?.data?.data ?? [];

            table.clear();

            // 🔥 Sort advisors by booking amount (extra safety)
            advisors.sort((a, b) => 
                (b.total_booking_amount ?? 0) - (a.total_booking_amount ?? 0)
            );

            let rank = 1;

            advisors.forEach(function(advisor) {

                let bookingAmount = parseFloat(advisor.total_booking_amount ?? 0);
                let totalDeals = advisor.total_deals ?? 0;

                // Example commission 5%
                let commission = bookingAmount * 0.05;

                // Rank badge
                let rankBadge = '';

                if (rank === 1) {
                    rankBadge = `<span class="bg-yellow-400 text-gray-800 px-3 py-1 rounded-full">🥇 1</span>`;
                } else if (rank === 2) {
                    rankBadge = `<span class="bg-gray-400 text-gray-800 px-3 py-1 rounded-full">🥈 2</span>`;
                } else if (rank === 3) {
                    rankBadge = `<span class="bg-purple-500 text-gray-800 px-3 py-1 rounded-full">🥉 3</span>`;
                } else {
                    rankBadge = `<span class="bg-gray-200 text-gray-800 px-3 py-1 rounded-full">#${rank}</span>`;
                }

                table.row.add([
                    advisor.user_code ?? '',
                    advisor.name ?? '',
                    advisor.city ?? '-', 
                    totalDeals,
                    "₹ " + bookingAmount.toLocaleString(),
                    "₹ " + commission.toLocaleString(undefined, {minimumFractionDigits: 2}),
                    rankBadge
                ]);

                rank++;
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
</script>