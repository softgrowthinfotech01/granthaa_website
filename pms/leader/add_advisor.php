<?php include 'header.php'; ?>

<div class="max-w-5xl mx-auto bg-white p-8 rounded-2xl shadow-2xl">

  <h2 class="text-2xl font-bold mb-6 text-gray-800 text-center">Add Advisor</h2>

  <form id="advisorForm"
    class="grid grid-cols-1 md:grid-cols-2 gap-6">

 

    <!-- Full Name -->
    <div>
      <label class="block text-gray-900 font-semibold mb-1">Full Name</label>
      <input type="text" name="name" placeholder="Enter full name" required
        class="w-full border border-gray-300 p-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-400">
    </div>

    <!-- email -->
    <div>
      <label class="block text-gray-900 font-semibold mb-1">Email</label>
      <input type="text" name="email" placeholder="Enter email" required
        class="w-full border border-gray-300 p-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-400">
    </div>

    <!-- Phone -->
    <div>
      <label class="block text-gray-900 font-semibold mb-1">Phone Number</label>
      <input type="number" name="contact_no" placeholder="Enter phone number" required
        class="w-full border border-gray-300 p-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-400">
    </div>

    <!-- PAN Card -->
    <div>
      <label class="block text-gray-900 font-semibold mb-1">PAN Card Number</label>
      <input type="text" name="pancard_number" placeholder="ABCDE1234F" required
        class="w-full border border-gray-300 p-2 rounded-lg uppercase focus:outline-none focus:ring-2 focus:ring-yellow-400">
    </div>
    <div>
      <label class="block text-gray-900 font-semibold mb-1">Age</label>
      <input type="number" 
       name="age" 
       min="18"
       required
       class="w-full border border-gray-300 p-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-400">
    </div>
    <div>
      <label class="block text-gray-900 font-semibold mb-1">Gender</label>
      <select name="gender" required
        class="w-full border border-gray-300 p-2 rounded-lg focus:ring-2 focus:ring-yellow-400">
  <option value="">-- Select Gender --</option>
  <option value="male">Male</option>
  <option value="female">Female</option>
</select>
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
      <input type="text" name="bank_branch" placeholder="Enter branch name"
        class="w-full border border-gray-300 p-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-400">
    </div>

    <!-- Account Number -->
    <div>
      <label class="block text-gray-900 font-semibold mb-1">Account Number</label>
      <input type="number" name="bank_account_no" placeholder="Enter account number" required
        class="w-full border border-gray-300 p-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-400">
    </div>

    <!-- IFSC Code -->
    <div>
      <label class="block text-gray-900 font-semibold mb-1">IFSC Code</label>
      <input type="text" name="bank_ifsc_code" placeholder="Enter IFSC code" required
        class="w-full border border-gray-300 p-2 rounded-lg uppercase focus:outline-none focus:ring-2 focus:ring-yellow-400">
    </div>

    <!-- Submit Button -->
    <div class="md:col-span-2 text-right mt-4 gap-2">
      <button type="submit"
        class="bg-yellow-400 px-6 py-2 rounded-lg font-semibold hover:bg-yellow-500 transition">
        Save Advisor
      </button>
      <button type="button" onclick="confirmReset()"
        class="bg-yellow-400 px-6 py-2 rounded-lg font-semibold hover:bg-yellow-500 transition">
        Reset
      </button>
    </div>
  </form>

</div>

<?php include 'footer.php'; ?>
<script src="../url.js"></script>

<script>
  document.getElementById('advisorForm').addEventListener('submit', async function(e) {
    e.preventDefault();

    const token = localStorage.getItem('auth_token');
    const user = JSON.parse(localStorage.getItem('auth_user'));
    if (!token || !user) {
      alert('Please login first');
      window.location.href = '../login';
      return;
    }

    // UI level role protection (backend already protected)
    if (user.role !== 'leader') {
      alert('You are not allowed to add advisor');
      return;
    }

    let form = document.getElementById('advisorForm');
    let formData = new FormData(form);
     console.log(formData);
    // 🔥 FORCE VALUES
    formData.set("role", "adviser");
    formData.set("password", "password"); // static password
    formData.set("created_by", user.id); // admin id

    try {
      const response = await fetch(url + 'users', {
        method: 'POST',
        headers: {
          'Accept': 'application/json',
          'Authorization': 'Bearer ' + token
        },
        body: formData
      });

      const data = await response.json();

      if (!response.ok) {
        alert(data.message || 'Something went wrong');
        return;
      }

      alert('adviser created successfully');
      document.getElementById('advisorForm').reset();

    } catch (error) {
      console.error(error);
      alert('Server error');
    }
  });

  // Reset confirmation
  function confirmReset() {
    if (confirm('Are you sure you want to reset the form?')) {
      document.getElementById('advisorForm').reset();
    }
  }
</script>