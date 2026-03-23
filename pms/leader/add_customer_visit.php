<?php include 'header.php'; ?>

<div class="max-w-5xl mx-auto bg-white p-8 rounded-2xl shadow-2xl">

  <h2 class="text-2xl font-bold mb-6 text-gray-800 text-center">Add Customer</h2>

  <form id="customerForm"
    class="grid grid-cols-1 md:grid-cols-2 gap-6">

  <!-- Location Dropdown -->
  <div>
    <label class="block text-gray-900 font-semibold mb-1">Select Location</label>
   <select id="locationDropdown" name="location_id"
  class="w-full border border-gray-300 p-2 rounded-lg focus:ring-2 focus:ring-yellow-400">
  <option value="">-- Select Location --</option>
</select>
  </div>

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

    <!-- Aadhar Card -->
    <div>
      <label class="block text-gray-900 font-semibold mb-1">Aadhaar Card</label>
      <input type="text" name="aadhaar_number" placeholder="Enter Aadhar Card number" required
        maxlength="12" id="aadhaar_number"
        pattern="[0-9]{12}"
        title="Aadhar Card number must be exactly 12 digits"
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

    <!-- Submit Button -->
    <div class="md:col-span-2 text-right mt-4 gap-2">
      <button type="submit"
        class="bg-yellow-400 px-6 py-2 rounded-lg font-semibold hover:bg-yellow-500 transition">
        Save Customer
      </button>
      <button type="button" onclick="confirmReset()"
        class="bg-gray-300 px-6 py-2 rounded-lg font-semibold hover:bg-gray-600 transition">
        Reset
      </button>
    </div>
  </form>

</div>

<?php include 'footer.php'; ?>


    <script src="../url.js"></script>

    <script>
document.addEventListener("DOMContentLoaded", function () {

    const token = localStorage.getItem('auth_token');
    if (!token) return;

    // ================= LOCATION FETCH =================
    fetch(url + "site-location", {
        headers: {
            "Authorization": "Bearer " + token,
            "Accept": "application/json"
        }
    })
    .then(res => res.json())
    .then(response => {

        console.log("Locations:", response);

        const dropdown = document.getElementById("locationDropdown");

        dropdown.innerHTML =
            '<option value="">-- Select Location --</option>';

        const locations = response.data ?? [];

        locations.forEach(location => {
            dropdown.innerHTML += `
                <option value="${location.id}">
                    ${location.site_location}
                </option>
            `;
        });
    });
});

</script>