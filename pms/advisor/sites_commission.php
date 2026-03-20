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
          <th data-priority="1" class="p-3 text-center font-semibold">Site Location</th>
          <th data-priority="2" class="p-3 text-center font-semibold">Commission Type</th>
          <th data-priority="3" class="p-3 text-center font-semibold">Commission Value</th>
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

    let allData = [];
    let filteredData = [];
    let currentPage = 1;
    let perPage = 10;

    /* ================= LOAD DATA ================= */
    function loadCommissions() {

        $.ajax({
            url: url + "my-commissions?per_page=1000", // get all
            type: "GET",
            headers: {
                "Authorization": "Bearer " + token
            },
            success: function(response) {

                allData = response.data.data || [];
                applyFilters();

            },
            error: function(err) {
                console.log(err);
            }
        });
    }

    /* ================= FILTER ================= */
    function applyFilters() {

        let search = $("#searchInput").val().toLowerCase();
        let type = $("#commissionTypeFilter").val();

        filteredData = allData.filter(item => {

            let location = item.location?.site_location?.toLowerCase() || '';
            let commissionType = item.commission_type || '';

            return (
                (location.includes(search) || commissionType.includes(search)) &&
                (type === "" || commissionType === type)
            );
        });

        currentPage = 1;
        renderTable();
    }

    /* ================= RENDER TABLE ================= */
    function renderTable() {

        let tbody = $("tbody");
        tbody.empty();

        let start = (currentPage - 1) * perPage;
        let paginated = filteredData.slice(start, start + perPage);

        if (paginated.length === 0) {
            tbody.append(`
                <tr>
                    <td colspan="3" class="text-center p-4">
                        No Records Found
                    </td>
                </tr>
            `);
        }

        paginated.forEach(item => {

            tbody.append(`
                <tr class="border-b hover:bg-gray-50">

                    <td class="p-3 text-center">
                        ${item.location?.site_location ?? ''}
                    </td>

                    <td class="p-3 text-center capitalize">
                        ${item.commission_type ?? ''}
                    </td>

                    <td class="p-3 text-center font-semibold">
                        ${item.commission_type === 'percent'
                            ? item.commission_value + '%'
                            : '₹ ' + Number(item.commission_value || 0).toLocaleString("en-IN")}
                    </td>

                </tr>
            `);
        });

        renderPagination();
    }

    /* ================= PAGINATION ================= */
    function renderPagination() {

        let totalPages = Math.ceil(filteredData.length / perPage);

        $("#pagination").html(`
            <div class="flex justify-between items-center">

                <button ${currentPage == 1 ? 'disabled' : ''}
                    onclick="changePage(${currentPage - 1})"
                    class="bg-gray-300 px-4 py-2 rounded">
                    Previous
                </button>

                <span>Page ${currentPage} of ${totalPages}</span>

                <button ${currentPage == totalPages ? 'disabled' : ''}
                    onclick="changePage(${currentPage + 1})"
                    class="bg-gray-300 px-4 py-2 rounded">
                    Next
                </button>

            </div>
        `);
    }

    /* ================= EVENTS ================= */

    let timeout;

    $("#searchInput").on("keyup", function() {

        clearTimeout(timeout);

        timeout = setTimeout(() => {
            applyFilters();
        }, 300);
    });

    $("#commissionTypeFilter").on("change", function() {
        applyFilters();
    });

    window.changePage = function(page) {
        currentPage = page;
        renderTable();
    }

    /* ================= INIT ================= */
    loadCommissions();

});
</script>