<?php include 'header.php'; ?>

<div class="max-w-xl mx-auto bg-white p-8 rounded-2xl shadow">

<h2 class="text-2xl font-bold mb-6 text-center">
  Update Advisor Commission
</h2>

<form method="" action="" class="space-y-5">

  <!-- Advisor Code -->
  <div>
    <label class="block text-gray-900 font-semibold mb-1">Advisor Code</label>
    <input type="text" name="advisor_code" value="" 
      class="w-full border border-gray-300 p-2 rounded-lg focus:ring-2 focus:ring-yellow-400">
  </div>

  <!-- Advisor Name -->
  <div>
    <label class="block text-gray-900 font-semibold mb-1">Advisor Name</label>
    <input type="text" name="advisor_name" value="" 
      class="w-full border border-gray-300 p-2 rounded-lg focus:ring-2 focus:ring-yellow-400">
  </div>

  <!-- Commission Type -->
  <div>
    <label class="block text-gray-900 font-semibold mb-2">Commission Type</label>
    <div class="flex gap-6">
      <label class="flex items-center gap-2">
        <input type="radio" name="commission_type" value="" checked>
        <span>Percentage (%)</span>
      </label>

      <label class="flex items-center gap-2">
        <input type="radio" name="commission_type" value="">
        <span>Fixed Amount (₹)</span>
      </label>
    </div>
  </div>

  <!-- Commission Value -->
  <div>
    <label class="block text-gray-900 font-semibold mb-1">Commission Value</label>
    <input type="text" name="commission_value" value=""
      class="w-full border border-gray-300 p-2 rounded-lg
             focus:ring-2 focus:ring-yellow-400">
  </div>

  <!-- Buttons -->
  <div class="flex justify-between mt-6">

    <a href="list_commission.php"
      class="px-5 py-2 rounded-lg border border-gray-300 hover:bg-gray-100 transition">
      Back
    </a>

    <button type="submit"
      class="bg-yellow-500 hover:bg-yellow-600 text-black px-6 py-2 rounded-lg font-semibold transition">
      Update Commission
    </button>

  </div>

</form>

</div>

<?php include 'footer.php'; ?>
