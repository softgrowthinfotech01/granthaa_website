<?php include 'header.php'; ?>
<style>

table{
width:100%;
border-collapse:collapse;
background:white;
}

th,td{
padding:10px;
border:1px solid #ddd;
text-align:left;
}

th{
background:#2c3e50;
color:white;
}

tr:nth-child(even){
background:#f2f2f2;
}
</style>
<div class="max-w-7xl mx-auto bg-white p-4 rounded-2xl shadow-xl">

  <h2 class="text-2xl font-bold mb-4 text-center">
    My Bookings Record
  </h2>

  <div class="flex justify-between mb-4">
    <!-- Search  -->
    <input
      id="searchInput"
      type="text"
      placeholder="Search bookings..."
      class="border rounded-lg px-3 py-2 w-60" />
  </div>
  <!-- Table Wrapper -->
  <div class="w-full overflow-x-auto">

    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Buyer Name</th>
          <th>Mobile</th>
          <th>Email</th>
          <th>Project</th>
          <th>Plot No</th>
          <th>Total Amount</th>
          <th>Commission</th>
          <th>City</th>
        </tr>
      </thead>

      <tbody id="bookingBody">

      </tbody>
    </table>
  </div>
  <div class="flex justify-between items-center mt-4">
    <button id="prevBtn" class="bg-gray-200 px-4 py-2 rounded">
      Prev
    </button>
    <span id="pageInfo"></span>

    <button id="nextBtn" class="bg-gray-200 px-4 py-2 rounded">
      Next
    </button>
  </div>
</div>

<?php include 'footer.php'; ?>

<script>
  let bookings = [];
  let filteredBookings = [];
  let currentPage = 1;
  const rowsPerPage = 5;

  document.addEventListener("DOMContentLoaded", () => {
    fetchBookings();

    document.getElementById("searchInput").addEventListener("input", function() {
      let term = this.value.toLowerCase().trim();
      if (term === "") {
        filteredBookings = bookings;
      } else {
        filteredBookings = bookings.filter(b => {
          const searchableText = [
          b.project_name,
          b.site_location,
          b.square_feet,
          b.square_meter,
          b.plot_number,
          b.total_booking_amount,
          b.buyer_name,
          b.email
        ]
            .join(" ")
            .toLowerCase();
          // prefix match + normal match
          return searchableText.includes(term) ||
            searchableText.startsWith(term);
        });
      }
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
      if (currentPage < Math.ceil(filteredBookings.length / rowsPerPage)) {
        currentPage++;
        renderTable();
      }
    };


  });

  async function fetchBookings() {

    try {

      const token = localStorage.getItem("auth_token");

      const response = await fetch(url + "mybookings", {
        method: "GET",
        headers: {
          "Authorization": "Bearer " + token,
          "Accept": "application/json"
        }
      });

      const result = await response.json();
      bookings = result || result.data || [];
      console.log("API Result:", result);
      console.log("Bookings:", bookings);

      if (!Array.isArray(bookings)) {
        bookings = [];
      }
      filteredBookings = bookings;

      renderTable();

      console.log("result", result);
    } catch (error) {

      console.error("Error fetching bookings:", error);

    }
  }

  function renderTable() {

    const tbody = document.getElementById("bookingBody");
    tbody.innerHTML = "";

    const start = (currentPage - 1) * rowsPerPage;
    const end = start + rowsPerPage;

    const pageData = filteredBookings.slice(start, end);

    if (pageData.length === 0) {
      tbody.innerHTML = `<tr style="text-align:center;"><td colspan="9" class="p-4 text-center">No bookings found</td></tr>`;
      return;
    }

    pageData.forEach(b => {

const row = `
<tr>
<td class="border p-2">${b.id ?? "-"}</td>
<td class="border p-2">${b.buyer_name ?? "-"}</td>
<td class="border p-2">${b.mobile ?? "-"}</td>
<td class="border p-2">${b.email ?? "-"}</td>
<td class="border p-2">${b.project_name ?? "-"}</td>
<td class="border p-2">${b.plot_number ?? "-"}</td>
<td class="border p-2 text-green-600 font-semibold">₹ ${b.total_booking_amount ?? "-"}</td>
<td class="border p-2">₹ ${b.commission_amount ?? "-"}</td>
<td class="border p-2">${b.city ?? "-"}</td>
</tr>
`;

      tbody.insertAdjacentHTML("beforeend", row);

    });

    document.getElementById("pageInfo").innerText =
      `Page ${currentPage} of ${Math.ceil(filteredBookings.length / rowsPerPage)}`;

  }
</script>