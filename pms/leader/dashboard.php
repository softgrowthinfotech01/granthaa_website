<?php include 'header.php'; ?>
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-4">

  <!-- Total Advisors -->
  <div class="relative bg-gradient-to-br from-yellow-200 to-gray-800 
            text-black p-6 rounded-2xl shadow-lg overflow-hidden">

    <div class="absolute top-5 right-5 opacity-30 text-6xl font-bold">👥</div>

    <div id="advisoe">
      <h3 class="text-sm tracking-widest font-semibold">TOTAL ADVISORS</h3>
    <p class="text-3xl font-bold mt-2 value" id="totalAdvisors"></p>
    </div>
  </div>

  <!-- Booking Amount -->
  <div class="relative bg-gradient-to-br from-yellow-200 to-gray-800  
            text-black p-6 rounded-2xl shadow-lg overflow-hidden">

    <div class="absolute top-5 right-5 opacity-50 text-6xl font-bold">₹</div>

    <h3 class="text-sm tracking-widest font-semibold">TOTAL MY BOOKING AMOUNT</h3>
    <p class="text-3xl font-bold mt-2" id="totalBooking"></p>
  </div>

  <!-- TEAM Booking Amount -->
  <div class="relative bg-gradient-to-br from-yellow-200 to-gray-800  
            text-black p-6 rounded-2xl shadow-lg overflow-hidden">

    <div class="absolute top-5 right-5 opacity-50 text-6xl font-bold">₹</div>

    <h3 class="text-sm tracking-widest font-semibold">TOTAL TEAM BOOKING AMOUNT</h3>
    <p class="text-3xl font-bold mt-2" id="teamtotalBooking"></p>
  </div>

  <!-- Commission Amount -->
  <div class="relative bg-gradient-to-br from-yellow-200 to-gray-800  
            text-black p-6 rounded-2xl shadow-lg overflow-hidden">

    <div class="absolute top-5 right-5 opacity-50 text-6xl font-bold">%</div>

    <h3 class="text-sm tracking-widest font-semibold">TOTAL MY COMMISSION AMOUNT</h3>
    <p class="text-3xl font-bold mt-2" id="totalCommission"></p>
  </div>

  <!-- Commission Amount -->
  <div class="relative bg-gradient-to-br from-yellow-200 to-gray-800  
            text-black p-6 rounded-2xl shadow-lg overflow-hidden">

    <div class="absolute top-5 right-5 opacity-50 text-6xl font-bold">%</div>

    <h3 class="text-sm tracking-widest font-semibold">TOTAL TEAM COMMISSION AMOUNT</h3>
    <p class="text-3xl font-bold mt-2" id="teamtotalCommission"></p>
  </div>

  <!-- Top Adviser -->
  <div class="relative bg-gradient-to-br from-yellow-200 to-gray-800  
            text-black p-6 rounded-2xl shadow-lg overflow-hidden">

    <div class="absolute top-5 right-5 opacity-50 text-6xl font-bold">🏆</div>

    <h3 class="text-sm tracking-widest font-semibold">TOP ADVISOR</h3>
    <p class="text-2xl font-bold mt-3" id="topAdvisor"></p>
  </div>

  <!-- My Total bookings  -->
  <div class="relative bg-gradient-to-br from-yellow-200 to-gray-800  
            text-black p-6 rounded-2xl shadow-lg overflow-hidden">

    <div class="absolute top-5 right-5 opacity-50 text-6xl font-bold">🏆</div>

    <h3 class="text-sm tracking-widest font-semibold">My Bookings</h3>
    <p class="text-2xl font-bold mt-3" id="mybooking"></p>
  </div>

  <!-- Team TOtal bookings -->
  <div class="relative bg-gradient-to-br from-yellow-200 to-gray-800  
            text-black p-6 rounded-2xl shadow-lg overflow-hidden">

    <div class="absolute top-5 right-5 opacity-50 text-6xl font-bold">🏆</div>

    <h3 class="text-sm tracking-widest font-semibold">Teams Bookings</h3>
    <p class="text-2xl font-bold mt-3" id="teambooking"></p>
  </div>

  <!-- Top Adviser -->
  <div class="relative bg-gradient-to-br from-yellow-200 to-gray-800  
            text-black p-6 rounded-2xl shadow-lg overflow-hidden">

    <div class="absolute top-5 right-5 opacity-50 text-6xl font-bold">🏆</div>

    <h3 class="text-sm tracking-widest font-semibold">TOTAL BOOKING AMOUNT</h3>
    <p class="text-2xl font-bold mt-3" id="total_booking_amount"></p>
  </div>

  <!-- Top Adviser -->
  <div class="relative bg-gradient-to-br from-yellow-200 to-gray-800  
            text-black p-6 rounded-2xl shadow-lg overflow-hidden">

    <div class="absolute top-5 right-5 opacity-50 text-6xl font-bold">🏆</div>

    <h3 class="text-sm tracking-widest font-semibold">TOTAL COMMISSION AMOUNT</h3>
    <p class="text-2xl font-bold mt-3" id="total_commission_amount"></p>
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
        document.querySelector('#totalAdvisors').textContent = data.data.total_advisors.toLocaleString();
        document.querySelector('#totalBooking').textContent = "₹ " + parseFloat(data.data.my_total_booking_amount).toLocaleString();
        document.querySelector('#teamtotalBooking').textContent = "₹ " + parseFloat(data.data.team_total_booking_amount).toLocaleString();
        document.querySelector('#totalCommission').textContent = "₹ " + parseFloat(data.data.my_commission).toLocaleString();
        document.querySelector('#teamtotalCommission').textContent = "₹ " + parseFloat(data.data.team_commission).toLocaleString();
        document.querySelector('#topAdvisor').textContent = (data.data.top_advisor_name == null) ? "-" : data.data.top_advisor_name + " (" + data.data.user_code + ")";
        document.querySelector('#teambooking').textContent = (data.data.team_total_booking == null) ? "-" : data.data.team_total_booking ;
        document.querySelector('#mybooking').textContent = (data.data.my_total_booking == null) ? "-" : data.data.my_total_booking  ;
        document.querySelector('#total_booking_amount').textContent = (data.data.total_booking_amount == null) ? "-" : "₹ " + data.data.total_booking_amount.toLocaleString()  ;
        document.querySelector('#total_commission_amount').textContent = (data.data.total_commission_amount == null) ? "-" : "₹ " + data.data.total_commission_amount.toLocaleString()  ;
    
      })
      .catch(error => console.error('Error fetching dashboard data:', error));
  });
</script>

<?php include 'footer.php'; ?>