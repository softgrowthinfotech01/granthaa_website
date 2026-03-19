<?php include 'header.php'; ?>
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-4">

<!-- Total Advisors -->
<div class="relative bg-gradient-to-br from-green-900 to-green-400        
            text-white p-6 rounded-2xl shadow-lg overflow-hidden">

  <div class="absolute top-5 right-5 opacity-50 text-6xl font-bold">🧾</div>

  <h3 class="text-sm tracking-widest font-semibold">TOTAL BOOKINGS</h3>
  <p class="text-3xl font-bold mt-2" id="totalBookings"></p>
</div>

<!-- Booking Amount -->
<div class="relative bg-gradient-to-br from-orange-900 to-orange-400
            text-white p-6 rounded-2xl shadow-lg overflow-hidden">

  <div class="absolute top-5 right-5 opacity-50 text-6xl font-bold">₹</div>

  <h3 class="text-sm tracking-widest font-semibold">TOTAL BOOKING AMOUNT</h3>
  <p class="text-3xl font-bold mt-2" id="totalBookingAmount"></p>
</div>

<!-- Commission Amount -->
<div class="relative bg-gradient-to-br from-blue-900 to-blue-400   
            text-white p-6 rounded-2xl shadow-lg overflow-hidden">

  <div class="absolute top-5 right-5 opacity-50 text-6xl font-bold">₹</div>

  <h3 class="text-sm tracking-widest font-semibold">TOTAL PAID AMOUNT</h3>
  <p class="text-3xl font-bold mt-2" id="totalPaidAmount"></p>
</div>

<!-- Top Leader -->
<div class="relative bg-gradient-to-br from-red-900 to-red-400
            text-white p-6 rounded-2xl shadow-lg overflow-hidden">

  <div class="absolute top-5 right-5 opacity-50 text-6xl font-bold">₹</div>

  <h3 class="text-sm tracking-widest font-semibold">TOTAL PENDING AMOUNT</h3>
  <p class="text-3xl font-bold mt-3" id="totalPendingAmount"></p>
</div>

<!-- Reference -->
<div class="relative bg-gradient-to-br from-purple-900 to-purple-400
            text-white p-6 rounded-2xl shadow-lg overflow-hidden">

  <div class="absolute top-5 right-5 opacity-50 text-6xl font-bold">👥</div>

  <h3 class="text-sm tracking-widest font-semibold">TOTAL REFERENCE</h3>
  <p class="text-3xl font-bold mt-3" id="totalReference"></p>
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
       
        document.querySelector('#totalBookings').textContent = data.data.total_booking;
        document.querySelector('#totalBookingAmount').textContent = "₹ " + data.data.total_booking_amount.toLocaleString();
        document.querySelector('#totalPaidAmount').textContent = "₹ " + data.data.total_paidamt.toLocaleString();
        document.querySelector('#totalPendingAmount').textContent = "₹ " + data.data.total_balanceamt.toLocaleString();
        document.querySelector('#totalReference').textContent = data.data.total_references;
      })
      .catch(error => console.error('Error fetching dashboard data:', error));
  });
</script>
<?php include 'footer.php'; ?>
