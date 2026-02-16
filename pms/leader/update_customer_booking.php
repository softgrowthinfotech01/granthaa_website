<?php include 'header.php'; ?>

<div class="max-w-7xl mx-auto bg-white p-6  rounded-2xl shadow-xl">

<h2 class="text-3xl font-semibold text-center text-gray-800 mb-2">
Update Customer Booking Details
</h2>

<form class="space-y-2">

<!-- ================= CUSTOMER DETAILS ================= -->
<div class=" p-6 ">

<h3 class="text-xl font-semibold text-gray-800 mb-3 border-b pb-2">
Customer Details
</h3>

<div class="grid md:grid-cols-3 gap-2">

<!-- Agent -->
<div class="space-y-2">
<label class="text-sm font-semibold text-gray-700">Leader Name</label>
<input type="text" value="LEAD001 - Prateek Raj" readonly
class="w-full border border-gray-300 px-5 py-3 rounded-xl bg-gray-100 outline-none ">
</div>

<!-- Buyer -->
<div class="space-y-2">
<label class="text-sm font-semibold text-gray-700">Buyer Name</label>
<input type="text" required
class="w-full border border-gray-300 px-5 py-3 rounded-xl focus:ring-2 focus:ring-yellow-400 outline-none">
</div>

<!-- Mobile -->
<div class="space-y-2">
<label class="text-sm font-semibold text-gray-700">Mobile Number</label>
<input type="number" required
class="w-full border border-gray-300 px-5 py-3 rounded-xl focus:ring-2 focus:ring-yellow-400 outline-none">
</div>

<!-- DOB -->
<div class="space-y-2">
<label class="text-sm font-semibold text-gray-700">Date of Birth</label>
<input type="date"
class="w-full border border-gray-300 px-5 py-3 rounded-xl focus:ring-2 focus:ring-yellow-400 outline-none">
</div>

<!-- Email -->
<div class="space-y-2">
<label class="text-sm font-semibold text-gray-700">Email</label>
<input type="email"
class="w-full border border-gray-300 px-5 py-3 rounded-xl focus:ring-2 focus:ring-yellow-400 outline-none">
</div>

<!-- PAN -->
<div class="space-y-2">
<label class="text-sm font-semibold text-gray-700">PAN Number</label>
<input type="text" required
class="w-full border border-gray-300 px-5 py-3 rounded-xl uppercase focus:ring-2 focus:ring-yellow-400 outline-none">
</div>

<!-- Aadhar -->
<div class="space-y-2">
<label class="text-sm font-semibold text-gray-700">Aadhar Number</label>
<input type="text" maxlength="12" required
class="w-full border border-gray-300 px-5 py-3 rounded-xl focus:ring-2 focus:ring-yellow-400 outline-none">
</div>

<!-- Address -->
<div class="space-y-2 md:col-span-2">
<label class="text-sm font-semibold text-gray-700">Address</label>
<input type="text" required
class="w-full border border-gray-300 px-5 py-3 rounded-xl focus:ring-2 focus:ring-yellow-400 outline-none">
</div>

<!-- City -->
<div class="space-y-2">
<label class="text-sm font-semibold text-gray-700">City</label>
<input type="text"
class="w-full border border-gray-300 px-5 py-3 rounded-xl focus:ring-2 focus:ring-yellow-400 outline-none">
</div>

<!-- State -->
<div class="space-y-2">
<label class="text-sm font-semibold text-gray-700">State</label>
<input type="text"
class="w-full border border-gray-300 px-5 py-3 rounded-xl focus:ring-2 focus:ring-yellow-400 outline-none">
</div>

<!-- Pincode -->
<div class="space-y-2">
<label class="text-sm font-semibold text-gray-700">Pincode</label>
<input type="number"
class="w-full border border-gray-300 px-5 py-3 rounded-xl focus:ring-2 focus:ring-yellow-400 outline-none">
</div>

<!-- Advance -->
<div class="space-y-2">
<label class="text-sm font-semibold text-gray-700">Advance Booking Amount</label>
<input type="number"
class="w-full border border-gray-300 px-5 py-3 rounded-xl focus:ring-2 focus:ring-yellow-400 outline-none">
</div>

</div>
</div>

<!-- ================= PLOT DETAILS ================= -->
<div class="p-6 mt-1">

<h3 class="text-xl font-semibold text-gray-800 mb-4 border-b pb-2">
Plot / Booking Details
</h3>

<div class="grid md:grid-cols-3 gap-2">

<div class="space-y-2">
<label class="text-sm font-semibold text-gray-700">Site Name</label>
<select class="w-full border border-gray-300 px-5 py-3 rounded-xl focus:ring-2 focus:ring-yellow-400 outline-none">
<option>Select Site</option>
<option>DSk</option>
<option>Grantha</option>
<option>Shobha</option>
</select>
</div>



<div class="space-y-2">
<label class="text-sm font-semibold text-gray-700">Commission Type</label>
<input type="text" value="Percent (%) or Amount (₹)" readonly
class="w-full border border-gray-300 px-5 py-3 rounded-xl bg-gray-100 outline-none ">
</div>


<div class="space-y-2">
<label class="text-sm font-semibold text-gray-700">Project Name</label>
<input type="text"
class="w-full border border-gray-300 px-5 py-3 rounded-xl focus:ring-2 focus:ring-yellow-400 outline-none ">
</div>



<div class="space-y-2">
<label class="text-sm font-semibold text-gray-700">Plot / Flat Number</label>
<input type="text" required
class="w-full border border-gray-300 px-5 py-3 rounded-xl focus:ring-2 focus:ring-yellow-400 outline-none">
</div>

<div class="space-y-2">
<label class="text-sm font-semibold text-gray-700">Khasara Number</label>
<input type="text"
class="w-full border border-gray-300 px-5 py-3 rounded-xl focus:ring-2 focus:ring-yellow-400 outline-none">
</div>

<div class="space-y-2">
<label class="text-sm font-semibold text-gray-700">P.H. Number</label>
<input type="text"
class="w-full border border-gray-300 px-5 py-3 rounded-xl focus:ring-2 focus:ring-yellow-400 outline-none">
</div>

<div class="space-y-2">
<label class="text-sm font-semibold text-gray-700">Mouza</label>
<input type="text"
class="w-full border border-gray-300 px-5 py-3 rounded-xl focus:ring-2 focus:ring-yellow-400 outline-none">
</div>

<div class="space-y-2">
<label class="text-sm font-semibold text-gray-700">Tahsil</label>
<input type="text"
class="w-full border border-gray-300 px-5 py-3 rounded-xl focus:ring-2 focus:ring-yellow-400 outline-none">
</div>

<div class="space-y-2">
<label class="text-sm font-semibold text-gray-700">District</label>
<input type="text"
class="w-full border border-gray-300 px-5 py-3 rounded-xl focus:ring-2 focus:ring-yellow-400 outline-none">
</div>

<div class="space-y-2">
<label class="text-sm font-semibold text-gray-700">Square Feet</label>
<input type="number"
class="w-full border border-gray-300 px-5 py-3 rounded-xl focus:ring-2 focus:ring-yellow-400 outline-none">
</div>

<div class="space-y-2">
<label class="text-sm font-semibold text-gray-700">Square Meter</label>
<input type="number"
class="w-full border border-gray-300 px-5 py-3 rounded-xl focus:ring-2 focus:ring-yellow-400 outline-none">
</div>

<div class="space-y-2">
<label class="text-sm font-semibold text-gray-700">Total Booking Amount</label>
<input type="number" 
class="w-full border border-gray-300 px-5 py-3 rounded-xl focus:ring-2 focus:ring-yellow-400 outline-none">
</div>

<div class="space-y-2">
<label class="text-sm font-semibold text-gray-700">Payment Mode</label>
<select class="w-full border border-gray-300 px-5 py-3 rounded-xl focus:ring-2 focus:ring-yellow-400 outline-none">
<option>Select Payment</option>
<option>Cash</option>
<option>Cheque</option>
<option>Online Transfer</option>
<option>UPI</option>
</select>
</div>

<div class="space-y-2 md:col-span-2">
<label class="text-sm font-semibold text-gray-700">Remark</label>
<textarea rows="2"
class="w-full border border-gray-300 px-5 py-3 rounded-xl focus:ring-2 focus:ring-yellow-400 outline-none"></textarea>
</div>

</div>
</div>


  <!-- Buttons -->
  <div class="md:col-span-2 flex justify-between mt-6">

    <a href="list_customer_booking.php"
      class="px-5 py-2 rounded-lg border border-gray-300 hover:bg-gray-100 transition">
      Back
    </a>

    <button type="submit"
      class="bg-yellow-500 hover:bg-yellow-600 text-black px-6 py-2 rounded-lg font-semibold transition">
      Update Customer Booking
    </button>

  </div>


</form>

</div>

<?php include 'footer.php'; ?>
