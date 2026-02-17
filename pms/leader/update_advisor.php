<?php include 'header.php'; ?>

<div class="max-w-2xl mx-auto bg-white p-8 rounded-2xl shadow">

<h2 class="text-2xl font-bold mb-6 text-center">
  Update Advisor Details
</h2>

<form method="" action="" class="grid grid-cols-1 md:grid-cols-2 gap-6">

  <!-- Advisor Code -->
  <div>
    <label class="block text-gray-900 font-semibold mb-1">Advisor Code</label>
    <input type="text" name="advisor_code" value="" 
      class="w-full border border-gray-300 p-2 rounded-lg focus:ring-2 focus:ring-yellow-400">
  </div>

  <!-- Full Name -->
  <div>
    <label class="block text-gray-900 font-semibold mb-1">Full Name</label>
    <input type="text" name="name" value=""
      class="w-full border border-gray-300 p-2 rounded-lg focus:ring-2 focus:ring-yellow-400">
  </div>

  <!-- Phone -->
  <div>
    <label class="block text-gray-900 font-semibold mb-1">Phone Number</label>
    <input type="text" name="phone" value=""
      class="w-full border border-gray-300 p-2 rounded-lg focus:ring-2 focus:ring-yellow-400">
  </div>

  <!-- PAN Card -->
  <div>
    <label class="block text-gray-900 font-semibold mb-1">PAN Card Number</label>
    <input type="text" name="pan" value=""
      class="w-full border border-gray-300 p-2 rounded-lg uppercase focus:ring-2 focus:ring-yellow-400">
  </div>

  <!-- Address -->
  <div class="md:col-span-2">
    <label class="block text-gray-900 font-semibold mb-1">Address</label>
    <textarea name="address" rows="3"
      class="w-full border border-gray-300 p-2 rounded-lg focus:ring-2 focus:ring-yellow-400"></textarea>
  </div>

  <!-- Bank Name -->
  <div>
    <label class="block text-gray-900 font-semibold mb-1">Bank Name</label>
    <input type="text" name="bank_name" value=""
      class="w-full border border-gray-300 p-2 rounded-lg focus:ring-2 focus:ring-yellow-400">
  </div>

  <!-- Account Number -->
  <div>
    <label class="block text-gray-900 font-semibold mb-1">Account Number</label>
    <input type="text" name="account_no" value=""
      class="w-full border border-gray-300 p-2 rounded-lg focus:ring-2 focus:ring-yellow-400">
  </div>

  <!-- IFSC Code -->
  <div>
    <label class="block text-gray-900 font-semibold mb-1">IFSC Code</label>
    <input type="text" name="ifsc" value=""
      class="w-full border border-gray-300 p-2 rounded-lg uppercase focus:ring-2 focus:ring-yellow-400">
  </div>

  <!-- Buttons -->
  <div class="md:col-span-2 flex justify-between mt-6">

    <a href="list_advisor.php"
      class="px-5 py-2 rounded-lg border border-gray-300 hover:bg-gray-100 transition">
      Back
    </a>

    <button type="submit"
      class="bg-yellow-500 hover:bg-yellow-600 text-black px-6 py-2 rounded-lg font-semibold transition">
      Update Advisor
    </button>

  </div>

</form>

</div>

<?php include 'footer.php'; ?>
