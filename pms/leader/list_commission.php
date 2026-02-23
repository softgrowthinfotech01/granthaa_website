<?php include 'header.php'; ?>

<div class="max-w-7xl mx-auto bg-white p-6 rounded-2xl shadow-xl">

  <h2 class="text-2xl font-bold mb-4 text-center">Advisor Commission Records</h2>

  <!-- Table wrapper for horizontal scroll -->
  <div class="w-full overflow-x-auto">
<div class="flex flex-col sm:flex-row gap-3 mb-4">

  <input type="text" id="searchInput"
      placeholder="Search by advisor or location..."
      class="border p-2 rounded w-full sm:w-1/3">

  <select id="commissionTypeFilter"
      class="border p-2 rounded w-full sm:w-1/4">
      <option value="">All Types</option>
      <option value="percent">Percent</option>
      <option value="amount">Amount</option>
  </select>

</div>
    <table id="example" class="" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">

      <thead class="bg-gradient-to-r from-gray-100 to-gray-300 text-gray-700">
        <tr>
          <th data-priority="1" class="p-3 text-center font-semibold">Advisor Code</th>
          <th data-priority="2" class="p-3 text-center font-semibold">Advisor Name</th>
          <th data-priority="3" class="p-3 text-center font-semibold">Commission</th>
          <th data-priority="4" class="p-3 text-center font-semibold">Action</th>
        </tr>
      </thead>

      <tbody class="divide-y divide-gray-200">
      </tbody>
    </table>
<div id="pagination" class="mt-4"></div>
  </div>

</div>

<?php include 'footer.php'; ?>


<!-- jQuery -->
<script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

<script>
$(document).ready(function() {

    const token = localStorage.getItem('auth_token');
    if (!token) {
        alert("Please login first");
        window.location.href = "../login";
        return;
    }

    let currentPage = 1;
    let perPage = 10;

    function loadCommissions(page = 1) {

        let search = $("#searchInput").val();
        let commissionType = $("#commissionTypeFilter").val();

        $.ajax({
            url: url + "commissions?page=" + page +
                 "&per_page=" + perPage +
                 "&search=" + search +
                 "&commission_type=" + commissionType,
            type: "GET",
            headers: {
                "Authorization": "Bearer " + token,
                "Accept": "application/json"
            },
            success: function(response) {

                let tbody = $("tbody");
                tbody.empty();

                let commissions = response.data.data;

                if (commissions.length === 0) {
                    tbody.append(`
                        <tr>
                            <td colspan="4" class="text-center p-4">
                                No Records Found
                            </td>
                        </tr>
                    `);
                }

                commissions.forEach(function(item) {

                    tbody.append(`
                        <tr class="border-b">
                            <td class="p-3 text-center">
                                ${item.user?.user_code ?? ''}
                            </td>
                            <td class="p-3 text-center">
                                ${item.user?.name ?? ''}
                            </td>
                            <td class="p-3 text-center">
                                ${item.commission_type === 'percent'
                                    ? item.commission_value + '%'
                                    : '₹ ' + item.commission_value}
                            </td>
                            <td class="p-3 text-center">
                                <div class="flex flex-col sm:flex-row gap-2 justify-center">
                                    <a href="update_commission.php?id=${item.id}"
                                       class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-1.5 rounded-lg shadow-sm transition">
                                       Update
                                    </a>
                                    <button onclick="deleteCommission(${item.id})"
                                       class="bg-red-500 hover:bg-red-600 text-white px-4 py-1.5 rounded-lg shadow-sm transition">
                                       Delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                    `);
                });

                // 🔥 Pagination
                let pagination = response.data;

                $("#pagination").html(`
                    <div class="flex justify-between items-center">
                        <button ${pagination.current_page == 1 ? 'disabled' : ''}
                            onclick="changePage(${pagination.current_page - 1})"
                            class="bg-gray-300 px-4 py-2 rounded">
                            Previous
                        </button>

                        <span>
                            Page ${pagination.current_page} of ${pagination.last_page}
                        </span>

                        <button ${pagination.current_page == pagination.last_page ? 'disabled' : ''}
                            onclick="changePage(${pagination.current_page + 1})"
                            class="bg-gray-300 px-4 py-2 rounded">
                            Next
                        </button>
                    </div>
                `);

                currentPage = pagination.current_page;
            },
            error: function(error) {
                if (error.status === 401 || error.status === 403) {
                    alert("Unauthorized. Please login again.");
                    window.location.href = "../login";
                }
            }
        });
    }

    // Initial load
    loadCommissions();

    // Search event
    $("#searchInput").on("keyup", function() {
        loadCommissions(1);
    });

    // Filter event
    $("#commissionTypeFilter").on("change", function() {
        loadCommissions(1);
    });

    window.changePage = function(page) {
        loadCommissions(page);
    }

});


// 🔥 Delete Commission
function deleteCommission(id) {

    const token = localStorage.getItem('auth_token');

    if (!confirm("Are you sure you want to delete this commission?")) return;

    $.ajax({
        url: url + "commissions/" + id,
        type: "DELETE",
        headers: {
            "Authorization": "Bearer " + token,
            "Accept": "application/json"
        },
        success: function(response) {
            alert("Deleted Successfully");
            location.reload();
        }
    });
}
</script>