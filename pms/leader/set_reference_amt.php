<?php include 'header.php'; ?>

<div class="max-w-5xl mx-auto bg-white p-8 rounded-2xl shadow-xl">

    <h2 class="text-2xl font-bold mb-6 text-gray-800 text-center">
        Set Referral Setting
    </h2>

    <form id="commissionForm" class="grid grid-cols-1 md:grid-cols-2 gap-6">

        <!-- Location Dropdown -->
        <div class="space-y-2">
            <label class="text-sm font-semibold text-gray-700">Site Location</label>
            <select name="location_id" id="location_id"
                class="w-full border border-gray-300 px-5 py-3 rounded-xl focus:ring-2 focus:ring-yellow-400 outline-none">
                <option>Loading....</option>
            </select>
        </div>

        <!-- Advisor Dropdown -->
        <div>
            <label class="block text-gray-900 font-semibold mb-1">Select Customer</label>
            <select id="customerDropdown" name="target_user_id"
                class="w-full border border-gray-300 p-2 rounded-lg focus:ring-2 focus:ring-yellow-400">
                <option value="">-- Select Customer --</option>
            </select>
        </div>

        <!-- Referral Type -->
        <div class="md:col-span-2">
            <label class="block text-gray-900 font-semibold mb-2">Referral Type</label>

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

        <!-- Referral Value -->
        <div class="md:col-span-2">
            <label class="block text-gray-900 font-semibold mb-1">Referral Value</label>
            <input name="commission_value" type="number"
                placeholder="Enter value (e.g. 5 or 5000)"
                class="w-full border border-gray-300 p-2 rounded-lg focus:ring-2 focus:ring-yellow-400">
        </div>

        <!-- Submit Button -->
        <div class="md:col-span-2 text-right mt-4">
            <button type="submit"
                class="bg-yellow-500 hover:bg-yellow-600 text-black px-6 py-2 rounded-lg font-semibold transition">
                Save Referral Setting
            </button>
        </div>

    </form>

</div>

<script src="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {

        const token = localStorage.getItem('auth_token');
        const user = JSON.parse(localStorage.getItem('auth_user'));

        if (!token || !user) {
            alert("Please login first");
            window.location.href = "../login";
            return;
        }

        // ================= LOAD LOCATIONS =================
        function loadLocations() {
            fetch(url + "my-commissions", {
                    method: "GET",
                    headers: {
                        "Authorization": "Bearer " + token,
                        "Accept": "application/json"
                    }
                })
                .then(res => res.json())
                .then(response => {

                    const data = response.data?.data ?? [];
                    const select = document.getElementById("location_id");

                    select.innerHTML = `<option value="">Select Site Location</option>`;

                    data.forEach(item => {
                        if (item.location) {
                            select.innerHTML += `
                        <option value="${item.location.id}">
                            ${item.location.site_location}
                        </option>
                    `;
                        }
                    });
                });
        }

        loadLocations();

        // ================= LOAD Customers =================
        fetch(url + "by-role?role=customer", {
                headers: {
                    "Authorization": "Bearer " + token,
                    "Accept": "application/json"
                }
            })
            .then(res => res.json())
            .then(response => {

                const dropdown = document.getElementById("customerDropdown");
                dropdown.innerHTML = '<option value="">-- Select Customer --</option>';

                const advisors = response.data?.data ?? [];

                advisors.forEach(user => {
                    dropdown.innerHTML += `
                <option value="${user.id}">
                    ${user.user_code} - ${user.name}
                </option>
            `;
                });
            });

    });
</script>

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

        // Allow leader & adviser
        if (!['leader', 'adviser'].includes(user.role)) {
            alert('Unauthorized');
            return;
        }

        const location_id = document.getElementById("location_id").value;
        const target_user_id = document.getElementById("customerDropdown").value;

        const type = document.querySelector('input[name="commission_type"]:checked').value === 'percent' ?
            'percentage' :
            'fixed';

        const value = document.querySelector('input[name="commission_value"]').value;

        // ✅ Validation
        if (!location_id || !type || !value) {
            alert("All fields are required");
            return;
        }

        if (type === "percentage" && value > 100) {
            alert("Percentage cannot exceed 100");
            return;
        }

        try {
            const response = await fetch(url + 'referral-setting', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'Authorization': 'Bearer ' + token
                },
                body: JSON.stringify({
                    location_id: location_id,
                    target_user_id: target_user_id || null,
                    type: type,
                    value: value
                })
            });

            const data = await response.json();

            if (!response.ok) {
                alert(data.message || 'Something went wrong');
                return;
            }

            alert('Referral setting saved successfully');
            window.location.href = "list_reference.php";

        } catch (error) {
            console.error(error);
            alert('Server error');
        }
    });
</script>

<?php include 'footer.php'; ?>