<?php include 'header.php'; ?>

<div class="max-w-5xl mx-auto bg-white p-8 rounded-2xl shadow-2xl">

<h2 class="text-2xl font-bold mb-6 text-gray-800 text-center">Add Advisor</h2>

<form method="" action=""
      class="grid grid-cols-1 md:grid-cols-2 gap-6">

  <!-- Advisor Code -->
  <div>
    <label class="block text-gray-900 font-semibold mb-1">Advisor Code</label>
    <input type="text" name="advisor_code" placeholder="ADV001" required
      class="w-full border border-gray-300 p-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-400">
  </div>

  <!-- Full Name -->
  <div>
    <label class="block text-gray-900 font-semibold mb-1">Full Name</label>
    <input type="text" name="advisor_name" placeholder="Enter full name" required
      class="w-full border border-gray-300 p-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-400">
  </div>

  <!-- Phone -->
  <div>
    <label class="block text-gray-900 font-semibold mb-1">Phone Number</label>
    <input type="text" name="advisor_phone" placeholder="Enter phone number" required
      class="w-full border border-gray-300 p-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-400">
  </div>

  <!-- PAN Card -->
  <div>
    <label class="block text-gray-900 font-semibold mb-1">PAN Card Number</label>
    <input type="text" name="pan" placeholder="ABCDE1234F" required
      class="w-full border border-gray-300 p-2 rounded-lg uppercase focus:outline-none focus:ring-2 focus:ring-yellow-400">
  </div>

  <!-- Address -->
  <div class="md:col-span-2">
    <label class="block text-gray-900 font-semibold mb-1">Address</label>
    <textarea name="address" rows="3" placeholder="Enter address" required
      class="w-full border border-gray-300 p-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-400"></textarea>
  </div>

  

  <!-- Bank Name -->
  <div>
    <label class="block text-gray-900 font-semibold mb-1">Bank Name</label>
    <input type="text" name="bank_name" placeholder="Enter bank name" required
      class="w-full border border-gray-300 p-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-400">
  </div>

  <!-- Branch Name -->
  <div>
    <label class="block text-gray-900 font-semibold mb-1">Branch Name</label>
    <input type="text" name="branch_name" placeholder="Enter branch name" 
      class="w-full border border-gray-300 p-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-400">
  </div>

  <!-- Account Number -->
  <div>
    <label class="block text-gray-900 font-semibold mb-1">Account Number</label>
    <input type="text" name="account_no" placeholder="Enter account number" required
      class="w-full border border-gray-300 p-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-400">
  </div>

  <!-- IFSC Code -->
  <div>
    <label class="block text-gray-900 font-semibold mb-1">IFSC Code</label>
    <input type="text" name="ifsc" placeholder="Enter IFSC code" required
      class="w-full border border-gray-300 p-2 rounded-lg uppercase focus:outline-none focus:ring-2 focus:ring-yellow-400">
  </div>

  <!-- Submit Button -->
  <div class="md:col-span-2 text-right mt-4">
    <button type="submit"
      class="bg-yellow-400 px-6 py-2 rounded-lg font-semibold hover:bg-yellow-500 transition">
      Save Advisor
    </button>
  </div>

</form>

</div>

<?php include 'footer.php'; ?>
