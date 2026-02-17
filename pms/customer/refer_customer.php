<?php include 'header.php'; ?>

<div class="max-w-3xl mx-auto bg-white px-10 py-10 rounded-2xl shadow-xl">

<h2 class="text-2xl font-semibold text-gray-800 text-center mb-10">
Customer Referral Form
</h2>

<form class="space-y-8">

<!-- Form Grid -->
<div class="grid md:grid-cols-2 gap-x-8 gap-y-6">

<!-- Referral Code -->
<div class="space-y-2">
<label class="text-sm font-semibold text-gray-700">
Referral Code
</label>
<input type="text" value="REF001" readonly
class="w-full border border-gray-300 px-4 py-3 rounded-xl
bg-gray-100 outline-none">
</div>

<!-- Advisor Code -->
<div class="space-y-2">
<label class="text-sm font-semibold text-gray-700">
Leader / Advisor Code
</label>
<input type="text" value="LEAD001" readonly
class="w-full border border-gray-300 px-4 py-3 rounded-xl
bg-gray-100 outline-none">
</div>

<!-- site location -->
<div class="space-y-2">
<label class="text-sm font-semibold text-gray-700">Site Location</label>
<select class="w-full border border-gray-300 px-5 py-3 rounded-xl focus:ring-2 focus:ring-blue-400 outline-none">
<option>Select Site</option>
<option>Datala</option>
<option>Kosara</option>
<option>Chandrapur</option>
</select>
</div>

<!-- Client Name -->
<div class="space-y-2">
<label class="text-sm font-semibold text-gray-700">
New Customer Name
</label>
<input type="text" placeholder="Enter New Customer Name"
class="w-full border border-gray-300 px-4 py-3 rounded-xl
focus:ring-2 focus:ring-blue-400 focus:border-blue-400 outline-none">
</div>

<!-- Phone Number -->
<div class="space-y-2">
<label class="text-sm font-semibold text-gray-700">
Phone Number
</label>
<input type="text" placeholder="Enter Phone Number"
class="w-full border border-gray-300 px-4 py-3 rounded-xl
focus:ring-2 focus:ring-blue-400 focus:border-blue-400 outline-none">
</div>

<!-- Location -->
<div class="space-y-2">
<label class="text-sm font-semibold text-gray-700">
Customer Location
</label>
<input type="text" placeholder="Enter Location"
class="w-full border border-gray-300 px-4 py-3 rounded-xl
focus:ring-2 focus:ring-blue-400 focus:border-blue-400 outline-none">
</div>


</div>

<!-- Submit Button -->
<div class="flex justify-center pt-4">
<button
class="bg-blue-400 hover:bg-blue-500
px-14 py-3 rounded-xl
font-semibold text-black
shadow-md hover:shadow-xl
transition duration-300">

Save Referral

</button>
</div>

</form>

</div>

<?php include 'footer.php'; ?>
