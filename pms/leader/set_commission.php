<?php include 'header.php'; ?>

<div class="max-w-5xl mx-auto bg-white p-8 rounded-2xl shadow-xl">

<h2 class="text-2xl font-bold mb-6 text-gray-800 text-center">
  Set Advisor Commission
</h2>

<form class="grid grid-cols-1 md:grid-cols-2 gap-6">

  <!-- Location Dropdown -->
  <div>
    <label class="block text-gray-900 font-semibold mb-1">Select Location</label>
    <select class="w-full border border-gray-300 p-2 rounded-lg focus:ring-2 focus:ring-yellow-400">
      <option value="">-- Select Location --</option>
      <option>Pune</option>
      <option>Mumbai</option>
      <option>Nagpur</option>
      <option>Nashik</option>
    </select>
  </div>

  <!-- Advisor Dropdown -->
  <div>
    <label class="block text-gray-900 font-semibold mb-1">Select Advisor</label>
    <select class="w-full border border-gray-300 p-2 rounded-lg focus:ring-2 focus:ring-yellow-400">
      <option value="">-- Select Advisor --</option>
      <option>ADV001 - Prateek Raj</option>
      <option>ADV002 - Rahul Sharma</option>
      <option>ADV003 - Shaktiman</option>
    </select>
  </div>

  <!-- Commission Type -->
  <div class="md:col-span-2">
    <label class="block text-gray-900 font-semibold mb-2">Commission Type</label>

    <div class="flex gap-6">
      <label class="flex items-center gap-2">
        <input type="radio" name="commission_type" value="percent" checked>
        <span>Percentage (%)</span>
      </label>

      <label class="flex items-center gap-2">
        <input type="radio" name="commission_type" value="amount">
        <span>Fixed Amount (₹)</span>
      </label>
    </div>
  </div>

  <!-- Commission Value -->
  <div class="md:col-span-2">
    <label class="block text-gray-900 font-semibold mb-1">Commission Value</label>
    <input type="text" placeholder="Enter commission (e.g. 5 or 5000)"
      class="w-full border border-gray-300 p-2 rounded-lg focus:ring-2 focus:ring-yellow-400">
  </div>

  <!-- Submit Button -->
  <div class="md:col-span-2 text-right mt-4">
    <button type="submit"
      class="bg-yellow-500 hover:bg-yellow-600 text-black px-6 py-2 rounded-lg font-semibold transition">
      Save Commission
    </button>
  </div>

</form>

</div>

<?php include 'footer.php'; ?>


