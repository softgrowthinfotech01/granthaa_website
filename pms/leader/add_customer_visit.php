<?php include 'header.php'; ?>

<div class="max-w-5xl mx-auto bg-white p-8 rounded-2xl shadow-2xl">

    <h2 class="text-2xl font-bold mb-6 text-gray-800 text-center">Add Customer</h2>

    <form id="customerForm"
        class="grid grid-cols-1 md:grid-cols-2 gap-6">

        <!-- Location Dropdown -->
        <div class="space-y-2">
            <label class="text-sm font-semibold text-gray-700">Site Location</label>
            <select name="site_location" id="site_location" class="w-full border border-gray-300 px-5 py-3 rounded-xl focus:ring-2 focus:ring-yellow-400 outline-none ">
                <option>Loading....</option>
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
            <input type="text" pattern="[0-9]{10}" name="contact_no" placeholder="Enter phone number" id="contact_no" maxlength="10"
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

        <!-- remark -->
        <div class="md:col-span-2">
            <label class="block text-gray-900 font-semibold mb-1">Remark</label>
            <textarea name="remark" rows="3"
                placeholder="Enter visit remark"
                class="w-full border border-gray-300 p-2 rounded-lg focus:ring-2 focus:ring-yellow-400"></textarea>
        </div>

        <!-- Selfie Capture -->
        <div class="md:col-span-2">
            <label class="block text-gray-900 font-semibold mb-2">Customer Selfie</label>

            <input type="file"
                name="photo"
                id="photo"
                accept="image/*"
                capture="user"
                required
                class="w-full border border-gray-300 p-2 rounded-lg">

            <p class="text-sm text-gray-500 mt-1">
                Camera will open automatically on mobile
            </p>
        </div>

        <!-- Submit Button -->
        <div class="md:col-span-2 text-right mt-4 gap-2">
            <button type="submit"
                class="bg-yellow-500 hover:bg-yellow-600 px-4 py-3 rounded-xl
text-black font-semibold text-lg shadow-md hover:shadow-xl
transition transform hover:scale-[1.02]">
                Save Customer
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


<script>
    document.addEventListener("DOMContentLoaded", function() {

        const token = localStorage.getItem('auth_token');
        const user = JSON.parse(localStorage.getItem('auth_user'));

        if (!token || !user) {
            alert("Please login first");
            window.location.href = "../login";
            return;
        }

        /* ================= LOAD SITE LOCATIONS ================= */

        function loadSiteLocations() {

            fetch(url + "my-commissions", {
                    method: "GET",
                    headers: {
                        "Authorization": "Bearer " + token,
                        "Accept": "application/json"
                    }
                })
                .then(res => res.json())
                .then(response => {

                    const commissions = response.data?.data ?? [];
                    const select = document.getElementById("site_location");

                    select.innerHTML = `<option value="">Select Site Location</option>`;

                    commissions.forEach(commission => {

                        if (commission.location) {
                            select.innerHTML += `
                        <option value="${commission.location.id}">
                            ${commission.location.site_location}
                        </option>`;
                        }
                    });
                });
        }

        loadSiteLocations();


        /* ================= CUSTOMER VISIT SUBMIT ================= */

        const form = document.getElementById("customerForm");

        form.addEventListener("submit", async function(e) {

            e.preventDefault();

            const formData = new FormData(form);

            // add visited_at dynamically
            const now = new Date();
            const visited_at =
                now.getFullYear() + "-" +
                String(now.getMonth() + 1).padStart(2, '0') + "-" +
                String(now.getDate()).padStart(2, '0') + " " +
                String(now.getHours()).padStart(2, '0') + ":" +
                String(now.getMinutes()).padStart(2, '0') + ":" +
                String(now.getSeconds()).padStart(2, '0');

            formData.append("visited_at", visited_at);

            try {

                const response = await fetch(url + "customer-visits", {
                    method: "POST",
                    headers: {
                        "Authorization": "Bearer " + token,
                        "Accept": "application/json"
                    },
                    body: formData
                });

                const result = await response.json();

                if (result.status) {
                    alert(result.message);
                    form.reset();
                } else {
                    alert(result.message || "Failed to save customer");
                }

            } catch (error) {
                console.error(error);
                alert("Server error occurred");
            }
        });

    });
</script>