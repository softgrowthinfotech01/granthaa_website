<?php include 'header.php'; ?>

<div class="max-w-7xl mx-auto bg-white p-6  rounded-2xl shadow-xl">

<h2 class="text-2xl font-semibold text-center mb-6">
Record Payment
</h2>

<form id="paymentForm" class="space-y-2">

<!-- ================= PAYMENT DETAILS ================= -->
<div class="p-6">

<h3 class="text-xl font-semibold text-gray-800 mb-3 border-b pb-2">
Payment Details
</h3>

<div class="grid md:grid-cols-3 gap-2">

<!-- USER ID -->
<div class="space-y-2">
<label class="text-sm font-semibold text-gray-700">User ID</label>
<input type="number" name="user_id" id="user_id" required
class="w-full border border-gray-300 px-5 py-3 rounded-xl focus:ring-2 focus:ring-green-400 outline-none">
</div>

<!-- AMOUNT -->
<div class="space-y-2">
<label class="text-sm font-semibold text-gray-700">Payment Amount</label>
<input type="number" name="amount" id="amount" required
class="w-full border border-gray-300 px-5 py-3 rounded-xl focus:ring-2 focus:ring-green-400 outline-none">
</div>

<!-- PAYMENT MODE -->
<div class="space-y-2">
<label class="text-sm font-semibold text-gray-700">Payment Mode</label>
<select name="payment_mode" id="payment_mode"
class="w-full border border-gray-300 px-5 py-3 rounded-xl focus:ring-2 focus:ring-green-400 outline-none">

<option>Select Payment Mode</option>
<option value="cash">Cash</option>
<option value="cheque">Cheque</option>
<option value="online_transfer">Online Transfer</option>
<option value="upi">UPI</option>

</select>
</div>

<!-- REFERENCE NUMBER -->
<div class="space-y-2">
<label class="text-sm font-semibold text-gray-700">Reference Number</label>
<input type="text" name="reference_no" id="reference_no"
class="w-full border border-gray-300 px-5 py-3 rounded-xl focus:ring-2 focus:ring-green-400 outline-none">
</div>

<!-- REMARK -->
<div class="space-y-2 md:col-span-2">
<label class="text-sm font-semibold text-gray-700">Remark</label>
<textarea name="remark" id="remark" rows="2"
class="w-full border border-gray-300 px-5 py-3 rounded-xl focus:ring-2 focus:ring-green-400 outline-none"></textarea>
</div>

</div>
</div>

<!-- BUTTON -->
<div class="flex justify-center gap-2 mt-2">

<button
class="bg-green-500 hover:bg-green-600 px-4 py-4 rounded-xl
text-black font-semibold text-lg shadow-md hover:shadow-xl
transition transform hover:scale-[1.02]">

Record Payment

</button>

<button type="button" onclick="confirmReset()"
class="bg-red-500 hover:bg-red-600 px-4 py-4 rounded-xl
text-black font-semibold text-lg shadow-md hover:shadow-xl
transition transform hover:scale-[1.02]">

Reset

</button>

</div>

</form>
</div>

<?php include 'footer.php'; ?>
<script src="../url.js"></script>