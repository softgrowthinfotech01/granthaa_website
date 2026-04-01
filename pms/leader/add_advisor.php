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

    <!-- Email -->
    <div>
      <label class="block text-gray-900 font-semibold mb-1">Email</label>
      <input type="email" name="email" placeholder="Enter email" id="email" required
        class="w-full border border-gray-300 p-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-400">
    </div>

    <!-- Phone -->
    <div>
      <label class="block text-gray-900 font-semibold mb-1">Phone Number</label>
      <input type="text" name="contact_no" placeholder="Enter phone number" id="contact_no" maxlength="10"
        class="w-full border border-gray-300 p-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-400">
    </div>

    <!-- PAN Card -->
    <div>
      <label class="block text-gray-900 font-semibold mb-1">PAN Card Number</label>
      <input type="text" name="pancard_number" placeholder="ABCDE1234F" required
        class="w-full border border-gray-300 p-2 rounded-lg uppercase focus:outline-none focus:ring-2 focus:ring-yellow-400">
    </div>

    <!-- Aadhar Card -->
    <div>
      <label class="block text-gray-900 font-semibold mb-1">Aadhaar Card</label>
      <input type="text" name="aadhaar_number" placeholder="Enter Aadhar Card number" required
        maxlength="12" id="aadhaar_number"
        pattern="[0-9]{12}"
        title="Aadhar Card number must be exactly 12 digits"
        class="w-full border border-gray-300 p-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-400">
    </div>

    <!-- Age -->
    <div>
      <label class="block text-gray-900 font-semibold mb-1">Age</label>
      <input type="text"
        name="age"  placeholder="Enter age"
        min="18"
        pattern="[0-9]{1,2}"
        maxlength="2"
        required
        class="w-full border border-gray-300 p-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-400">
    </div>

    <!-- Gender -->
    <div>
      <label class="block text-gray-900 font-semibold mb-1">Gender</label>
      <select name="gender" required
        class="w-full border border-gray-300 p-2 rounded-lg focus:ring-2 focus:ring-yellow-400">
        <option value="">-- Select Gender --</option>
        <option value="male">Male</option>
        <option value="female">Female</option>
        <option value="other">Other</option>
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
        pattern="[A-Za-z\s&]+"
        title="Bank name should contain only letters and spaces"
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
      <input type="text" name="bank_account_no" placeholder="Enter account number" required
        maxlength="18"
        pattern="[0-9]{9,18}"
        title="Account number must be between 9-18 digits"
        class="w-full border border-gray-300 p-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-400">
    </div>

    <!-- IFSC Code -->
    <div>
      <label class="block text-gray-900 font-semibold mb-1">IFSC Code</label>
      <input type="text" name="bank_ifsc_code" placeholder="Enter IFSC code" required
        maxlength="11" id="bank_ifsc_code"
        pattern="[A-Za-z]{4}0[A-Za-z0-9]{6}"
        title="Enter valid IFSC code (Example: HDFC0001234)"
        class="w-full border border-gray-300 p-2 rounded-lg uppercase focus:outline-none focus:ring-2 focus:ring-yellow-400">
    </div>

    <!-- Submit Button -->
    <div class="md:col-span-2 text-right mt-4 gap-2">
      <button type="submit"
        class="bg-yellow-500 hover:bg-yellow-600 px-4 py-3 rounded-xl
text-black font-semibold text-lg shadow-md hover:shadow-xl
transition transform hover:scale-[1.02]">
        Save Advisor
      </button>
      <button type="button" onclick="confirmReset()"
        class="bg-red-500 hover:bg-red-600 px-4 py-3 rounded-xl
text-black font-semibold text-lg shadow-md hover:shadow-xl
transition transform hover:scale-[1.02]">
        Reset
      </button>
    </div>
  </form>

</div>

<?php include 'footer.php'; ?>
<script src="../url.js"></script>

<script>
  // Email Validation
  function validateEmail(email) {
    const pattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return pattern.test(email);
  }
  // IFSC Validation
  document.getElementById("bank_ifsc_code").addEventListener("input", function() {
    this.value = this.value
      .toUpperCase()
      .replace(/[^A-Z0-9]/g, '');
  });

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

    let email = formData.get("email");

    // Email validation
    if (!validateEmail(email)) {
      alert("Please enter a valid email address");
      return;
    }

    // Phone validation
    let phone = formData.get("contact_no");
    const phonePattern = /^[0-9]{10}$/;

    if (!phonePattern.test(phone)) {
      alert("Phone number must be exactly 10 digits");
      return;
    }

    // Pancard validation
    let pancard = formData.get("pancard_number").trim().toUpperCase();
    const panPattern = /^[A-Z]{5}[0-9]{4}[A-Z]{1}$/;

    if (!panPattern.test(pancard)) {
      alert("Invalid PAN card number. Format should be ABCDE1234F");
      return;
    }

    let contactNumber = document.querySelector("input[name='contact_no']").value;

    // FORCE VALUES
    formData.set("role", "adviser");
    formData.set("password", contactNumber);
    formData.set("created_by", user.id);

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