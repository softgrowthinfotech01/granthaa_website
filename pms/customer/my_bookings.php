<?php include 'header.php'; ?>

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
  class="border rounded-lg px-3 py-2 w-60"
  />
  </div>
<!-- Table Wrapper -->
  <div class="w-full overflow-x-auto">

    <table class="w-full border border-gray-200" >

    <thead class="bg-gradient-to-right from-gray-100 to-gray-200 text-gray-700">
    <tr>
      <th data-priority="1" class="p-3 font-semibold border">Project Name</th>
      <th data-priority="2" class="p-3 font-semibold border">Site Location</th>
      <th data-priority="3" class="p-3 font-semibold border">Sq Feet</th>
      <th data-priority="4" class="p-3 font-semibold border">Sq Meter</th>
      <th data-priority="5" class="p-3 font-semibold border">Plot Number</th>
      <th data-priority="6" class="p-3 font-semibold border">Total Booking Amt</th>
    </tr>
    </thead>

    <tbody id="bookingTable" class="divide-y divide-gray-200 text-center">
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

   document.getElementById("searchInput").addEventListener("input", function(){
   let term = this.value.toLowerCase().trim();
   if(term === ""){
     filteredBookings = bookings;
   }else{
     filteredBookings = bookings.filter(b => {
       const searchableText = [
         b.project_name,
         b.site_location,
         b.square_feet,
         b.square_meter,
         b.plot_number,
         b.total_booking_amount
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
     if(currentPage > 1){
      currentPage--;
      renderTable();
     }
    };

    document.getElementById("nextBtn").onclick = () => {
     if(currentPage < Math.ceil(filteredBookings.length / rowsPerPage)){
      currentPage++;
      renderTable();
     }
    };


  });

  async function fetchBookings(){

      try {

          const token = localStorage.getItem("auth_token");

          const response = await fetch(url + "bookings", {
              method: "GET",
              headers: {
                  "Authorization": "Bearer " + token,
                  "Accept": "application/json"
              }
          });

          const result = await response.json();
          bookings = result.data?.data || result.data || [];
          console.log("API Result:", result.data.data);
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

function renderTable(){

 const tbody = document.getElementById("bookingTable");
 tbody.innerHTML = "";

 const start = (currentPage-1) * rowsPerPage;
 const end = start + rowsPerPage;

 const pageData = filteredBookings.slice(start,end);

 if(pageData.length === 0){
  tbody.innerHTML = `<tr><td colspan="6" class="p-4 text-center">No bookings found</td></tr>`;
  return;
 }

 pageData.forEach(b => {

  const row = `
   <tr>
    <td class="border p-2">${b.project_name ?? "-"}</td>
    <td class="border p-2">${b.site_location ?? "-"}</td>
    <td class="border p-2">${b.square_feet ?? "-"}</td>
    <td class="border p-2">${b.square_meter ?? "-"}</td>
    <td class="border p-2">${b.plot_number ?? "-"}</td>
    <td class="border p-2 text-green-600 font-semibold">₹ ${b.total_booking_amount ?? "-"}</td>
   </tr>
  `;

  tbody.insertAdjacentHTML("beforeend",row);

 });

 document.getElementById("pageInfo").innerText =
  `Page ${currentPage} of ${Math.ceil(filteredBookings.length / rowsPerPage)}`;

}
</script>
