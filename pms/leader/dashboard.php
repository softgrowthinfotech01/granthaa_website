<?php include 'header.php'; ?>
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-4">

  <!-- Total Advisors -->
  <div class="relative bg-gradient-to-br from-yellow-200 to-gray-800 
            text-black p-6 rounded-2xl shadow-lg overflow-hidden">

    <div class="absolute top-5 right-5 opacity-20 text-6xl font-bold">👥</div>

    <div id="advisoe">
      <h3 class="text-sm tracking-widest font-semibold">TOTAL ADVISORS</h3>
    <p class="text-3xl font-bold mt-2 value" id="totalAdvisors"></p>
    </div>
  </div>

  <!-- Booking Amount -->
  <div class="relative bg-gradient-to-br from-yellow-200 to-gray-800  
            text-black p-6 rounded-2xl shadow-lg overflow-hidden">

    <div class="absolute top-5 right-5 opacity-20 text-6xl font-bold">₹</div>

    <h3 class="text-sm tracking-widest font-semibold">TOTAL BOOKING AMOUNT</h3>
    <p class="text-3xl font-bold mt-2" id="totalBooking"></p>
  </div>

  <!-- Commission Amount -->
  <div class="relative bg-gradient-to-br from-yellow-200 to-gray-800  
            text-black p-6 rounded-2xl shadow-lg overflow-hidden">

    <div class="absolute top-5 right-5 opacity-20 text-6xl font-bold">%</div>

    <h3 class="text-sm tracking-widest font-semibold">TOTAL COMMISSION AMOUNT</h3>
    <p class="text-3xl font-bold mt-2" id="totalCommission"></p>
  </div>

  <!-- Top Leader -->
  <div class="relative bg-gradient-to-br from-yellow-200 to-gray-800  
            text-black p-6 rounded-2xl shadow-lg overflow-hidden">

    <div class="absolute top-5 right-5 opacity-20 text-6xl font-bold">🏆</div>

    <h3 class="text-sm tracking-widest font-semibold">TOP ADVISOR</h3>
    <p class="text-2xl font-bold mt-3" id="topAdvisor">Harish</p>
  </div>

</div>
<script src="../url.js"></script>
<script>
  document.addEventListener("DOMContentLoaded", function() {
    const token = localStorage.getItem('auth_token');
    if (!token) {
      alert("Please login first");
      window.location.href = "../login";
      return;
    }
    const apiUrl = url + 'dashboard';

    fetch(apiUrl, {
        method: "GET",
        headers: {
          "Content-Type": "application/json",
          "Authorization": "Bearer " + token
        }
      })
      .then(response => {
        if (!response.ok) {
          throw new Error("Network response was not ok: " + response.statusText);
        }
        return response.json();
      })
      .then(data => {
        document.querySelector('#totalAdvisors').textContent = data.total_advisors;
        document.querySelector('#totalBooking').textContent = "₹ " + data.total_booking_amount.toLocaleString();
        document.querySelector('#totalCommission').textContent = "₹ " + data.total_commission_amount.toLocaleString();
        document.querySelector('#topAdvisor').textContent = data.top_advisor;
      })
      .catch(error => console.error('Error fetching dashboard data:', error));
  });
</script>

<?php include 'footer.php'; ?>