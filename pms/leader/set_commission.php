<?php include 'header.php'; ?>

<div class="max-w-5xl mx-auto bg-white p-8 rounded-2xl shadow-xl">

<h2 class="text-2xl font-bold mb-6 text-gray-800 text-center">
  Set Advisor Commission
</h2>

<form id="commissionForm" class="grid grid-cols-1 md:grid-cols-2 gap-6">

  <!-- Location Dropdown -->
  <div>
    <label class="block text-gray-900 font-semibold mb-1">Select Location</label>
   <select id="locationDropdown" name="location_id"
  class="w-full border border-gray-300 p-2 rounded-lg focus:ring-2 focus:ring-yellow-400">
  <option value="">-- Select Location --</option>
</select>
  </div>

  <!-- Advisor Dropdown -->
  <div>
    <label class="block text-gray-900 font-semibold mb-1">Select Advisor</label>
    <select id="advisorDropdown" name="user_id"
  class="w-full border border-gray-300 p-2 rounded-lg focus:ring-2 focus:ring-yellow-400">
  <option value="">-- Select Advisor --</option>        
    
  
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
    <input name="commission_value" type="text" placeholder="Enter commission (e.g. 5 or 5000)"
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
<script src="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.js"></script>



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


    // ================= ADVISOR FETCH =================
    fetch(url + "by-role?role=adviser", {
        headers: {
            "Authorization": "Bearer " + token,
            "Accept": "application/json"
        }
    })
    .then(res => res.json())
    .then(response => {

        console.log("Advisors:", response);

        const dropdown =
            document.getElementById("advisorDropdown");

        dropdown.innerHTML =
            '<option value="">-- Select Advisor --</option>';

        const advisors = response.data?.data ?? [];

        advisors.forEach(user => {
            dropdown.innerHTML += `
                <option value="${user.id}">
                    ${user.user_code} - ${user.name}
                </option>
            `;
        });
    });

});</script>

    <script>
        document.getElementById('commissionForm').addEventListener('submit', async function(e) {
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
                alert('You are not allowed to update commission');
                return;
            }

            let form = document.getElementById('commissionForm');
            let formData = new FormData(form);



            try {
                const response = await fetch(url + 'commission', {
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

                alert('Commission saved successfully');
                document.getElementById('commissionForm').reset();

            } catch (error) {
                console.error(error);
                alert('Server error');
            }
        });

        // Reset confirmation
        function confirmReset() {
            if (confirm('Are you sure you want to reset the form?')) {
                document.getElementById('loginForm').reset();
            }
        }
    </script>



<?php include 'footer.php'; ?>


