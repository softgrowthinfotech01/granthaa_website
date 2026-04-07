<?php include 'header.php'; ?>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-4">

<!-- Total Bookings -->
<div class="relative bg-gradient-to-br from-green-900 to-green-400 text-white p-6 rounded-2xl shadow-lg overflow-hidden">
  <div class="absolute top-5 right-5 opacity-50 text-6xl font-bold">🧾</div>
  <h3 class="text-sm tracking-widest font-semibold">TOTAL BOOKINGS</h3>
  <p class="text-3xl font-bold mt-2" id="totalBookings"></p>
</div>

<!-- Booking Amount -->
<div class="relative bg-gradient-to-br from-orange-900 to-orange-400 text-white p-6 rounded-2xl shadow-lg overflow-hidden">
  <div class="absolute top-5 right-5 opacity-50 text-6xl font-bold">₹</div>
  <h3 class="text-sm tracking-widest font-semibold">TOTAL BOOKING AMOUNT</h3>
  <p class="text-3xl font-bold mt-2" id="totalBookingAmount"></p>
</div>

<!-- Paid -->
<div class="relative bg-gradient-to-br from-blue-900 to-blue-400 text-white p-6 rounded-2xl shadow-lg overflow-hidden">
  <div class="absolute top-5 right-5 opacity-50 text-6xl font-bold">₹</div>
  <h3 class="text-sm tracking-widest font-semibold">TOTAL PAID AMOUNT</h3>
  <p class="text-3xl font-bold mt-2" id="totalPaidAmount"></p>
</div>

<!-- Pending -->
<div class="relative bg-gradient-to-br from-red-900 to-red-400 text-white p-6 rounded-2xl shadow-lg overflow-hidden">
  <div class="absolute top-5 right-5 opacity-50 text-6xl font-bold">₹</div>
  <h3 class="text-sm tracking-widest font-semibold">TOTAL PENDING AMOUNT</h3>
  <p class="text-3xl font-bold mt-3" id="totalPendingAmount"></p>
</div>

<!-- Total Reference -->
<div class="relative bg-gradient-to-br from-purple-900 to-purple-400 text-white p-6 rounded-2xl shadow-lg overflow-hidden">
  <div class="absolute top-5 right-5 opacity-50 text-6xl font-bold">👥</div>
  <h3 class="text-sm tracking-widest font-semibold">TOTAL REFERENCE</h3>
  <p class="text-3xl font-bold mt-3" id="totalReference"></p>
</div>

<!-- Referral Earnings -->
<div class="relative bg-gradient-to-br from-yellow-900 to-yellow-400 text-white p-6 rounded-2xl shadow-lg overflow-hidden">
  <div class="absolute top-5 right-5 opacity-50 text-6xl font-bold">💰</div>
  <h3 class="text-sm tracking-widest font-semibold">TOTAL REFERRAL EARNINGS</h3>
  <p class="text-3xl font-bold mt-3" id="totalReferralAmount">₹ 0</p>
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

    // ================= DASHBOARD API =================
    fetch(url + 'dashboard', {
        method: "GET",
        headers: {
            "Content-Type": "application/json",
            "Authorization": "Bearer " + token
        }
    })
    .then(res => res.json())
    .then(data => {

        document.querySelector('#totalBookings').textContent = data.data.total_booking;
        document.querySelector('#totalBookingAmount').textContent = "₹ " + data.data.total_booking_amount.toLocaleString();
        document.querySelector('#totalPaidAmount').textContent = "₹ " + data.data.total_paidamt.toLocaleString();
        document.querySelector('#totalPendingAmount').textContent = "₹ " + data.data.total_balanceamt.toLocaleString();
        document.querySelector('#totalReference').textContent = data.data.total_references;

    })
    .catch(err => console.error("Dashboard error:", err));


    // ================= REFERRAL API =================
    fetch(url + 'refered', {
        method: "GET",
        headers: {
            "Authorization": "Bearer " + token,
            "Accept": "application/json"
        }
    })
    .then(res => res.json())
    .then(result => {

        const referrals = result.data?.data || [];

        let total = 0;

        referrals.forEach(r => {

            // skip if no booking (pending)
            if (!r.booking) return;

            const totalBooking = parseFloat(r.booking.total_booking_amount || 0);
            const value = parseFloat(r.incentive_value || 0);

            if (r.incentive_type === 'percent') {
                total += (totalBooking * value) / 100;
            } else {
                total += value;
            }

        });

        document.getElementById("totalReferralAmount").innerText =
            "₹ " + total.toFixed(2);

    })
    .catch(err => console.error("Referral error:", err));

});
</script>

<?php include 'footer.php'; ?>