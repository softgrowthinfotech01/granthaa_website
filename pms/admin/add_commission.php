<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Commission</title>
    <link rel="stylesheet" href="../style.css">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.css" rel="stylesheet" />

</head>

<body class="bg-gray-200">
    <!--Container -->
    <div class="mx-auto">
        <!--Screen-->
        <div class="min-h-screen flex flex-col">
            <!--Header Section Starts Here-->
            <?php include "header.php"; ?>
            <!--/Header-->

            <div class="flex flex-1">
                <!--Sidebar-->
                <?php include 'sidebar.php'; ?>
                <!--/Sidebar-->

                <!--Main-->
                <div id="mainContent"
                    class="w-full md:w-[80%] lg:w-[75%] mx-3 md:mx-auto my-4
                        transition-all duration-300">
                  <form id="commissionForm" class="w-full bg-white p-6 md:p-8 rounded-2xl shadow-lg border border-gray-200">

    <!-- TITLE -->
    <div class="mb-5 text-center">
        <h2 class="text-xl md:text-2xl font-bold text-gray-800">
            Set Leader Commission
        </h2>
        <p class="text-sm text-gray-500">Assign commission to leader</p>
    </div>

    <!-- ROW 1 -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

        <div>
            <label class="block mb-1 text-sm font-medium text-gray-700">
                Site Location
            </label>

            <select name="location_id" id="location_id"
                class="w-full px-3 py-2.5 border border-gray-400 rounded-lg bg-white text-sm focus:ring-2 focus:ring-blue-500 outline-none">
                <option selected>Choose a site location</option>
                <option value="">Loading...</option>
            </select>
        </div>

        <div>
            <label class="block mb-1 text-sm font-medium text-gray-700">
                Select Leader
            </label>

            <select name="user_id" id="user_id"
                class="w-full px-3 py-2.5 border border-gray-400 rounded-lg bg-white text-sm focus:ring-2 focus:ring-blue-500 outline-none">
                <option selected>Choose a Leader</option>
                <option value="">Loading...</option>
            </select>
        </div>

    </div>

    <!-- ROW 2 -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">

        <div>
            <label class="block mb-2 text-sm font-medium text-gray-700">
                Commission Type
            </label>

        <div class="flex flex-wrap gap-2 justify-start">

    <!-- Percentage -->
    <label class="flex items-center gap-2 px-3 py-2 border rounded-md cursor-pointer hover:bg-blue-100">
        
        <input type="radio" name="commission_type" value="percent" id="percentage"
            class="accent-blue-600" checked>

        <span class="text-blue-600 font-bold text-sm">%</span>
        <span class="text-sm">Percentage</span>
    </label>

    <!-- Amount -->
    <label class="flex items-center gap-2 px-3 py-2 border rounded-md cursor-pointer hover:bg-blue-100">
        
        <input type="radio" name="commission_type" value="amount" id="amount"
            class="accent-blue-600">

        <span class="text-green-600 font-bold text-sm">₹</span>
        <span class="text-sm">Amount / Sq Ft</span>
    </label>

</div>
        </div>

    </div>

    <!-- ROW 3 -->
    <div class="mt-4">
        <label class="block mb-1 text-sm font-medium text-gray-700">
            Commission Value
        </label>

        <input name="commission_value" type="number" id="commission_value"
            class="w-full px-3 py-2.5 border border-gray-400 rounded-lg bg-white text-sm focus:ring-2 focus:ring-blue-500 outline-none"
            placeholder="Enter commission value" required />
    </div>

    <!-- BUTTONS -->
    <div class="mt-6 flex flex-col md:flex-row justify-center gap-3">

        <button type="submit"
            class="w-full md:w-[180px] bg-blue-600 hover:bg-blue-500 text-white rounded-lg px-4 py-2.5 transition shadow">
            Save
        </button>

        <button type="button"
            onclick="confirmReset()"
            class="w-full md:w-[180px] bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg px-4 py-2.5 border">
            Reset
        </button>

    </div>

</form>
                </div>
                <!--/Main-->
            </div>
            <!--Footer-->
            <?php include 'footer.php'; ?>
            <!--/footer-->

        </div>

    </div>

    <script>
        function confirmReset() {
            if (confirm("Clear all entered data?")) {
                document.querySelector("form").reset();
            }
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.js"></script>


    <script src="../url.js"></script>


    <script>
        async function loadDropdowns() {

            const token = localStorage.getItem('auth_token');

            try {

                // 🔹 Load Site Locations
                const locRes = await fetch(url + 'site-location', {
                    headers: {
                        "Authorization": "Bearer " + token,
                        "Accept": "application/json"
                    }
                });

                const locationData = await locRes.json();
                const locationSelect = document.getElementById('location_id');

                locationSelect.innerHTML = `<option value="">Choose a site location</option>`;

                const locations = locationData.data.data || locationData.data;

                locations.forEach(loc => {
                    locationSelect.innerHTML += `
                <option value="${loc.id}">
                    ${loc.site_location}
                </option>
            `;
                });


                // 🔹 Load Leaders
                const leaderRes = await fetch(url + 'by-role?role=leader&per_page=100', {
                    headers: {
                        "Authorization": "Bearer " + token,
                        "Accept": "application/json"
                    }
                });

                const leaderData = await leaderRes.json();
                const leaderSelect = document.getElementById('user_id');

                leaderSelect.innerHTML = `<option value="">Choose a leader</option>`;

                leaderData.data.data.forEach(user => {
                    leaderSelect.innerHTML += `
        <option value="${user.id}">
            ${user.name}
        </option>
    `;
                });

            } catch (error) {
                console.error("Dropdown loading error:", error);
            }
        }

        // Call when page loads
        loadDropdowns();
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

            // UI level role protection (backend already protected)
            if (user.role !== 'admin') {
                alert('You are not allowed to update commission');
                return;
            }

            let form = document.getElementById('commissionForm');
            let formData = new FormData(form);
            // alert(formData.get('user_id') + ' ' + formData.get('location_id') + ' ' + formData.get('commission_type') + ' ' + formData.get('commission_value'))



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
                window.location.href = "view_commission.php";

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


</body>

</html>