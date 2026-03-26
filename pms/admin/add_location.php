<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Location</title>
    <link rel="stylesheet" href="../style.css">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.css" rel="stylesheet" />

</head>

<body class="bg-gray-200">
    <!--Container -->
    <div class="mx-auto">
        <!--Screen-->
        <div class="flex flex-col min-h-screen">
            <!--Header Section Starts Here-->
            <?php include "header.php"; ?>
            <!--/Header-->

            <div class="flex flex-1">
                <!--Sidebar-->
                <?php include 'sidebar.php'; ?>
                <!--/Sidebar-->

                <!--Main-->
              <div id="mainContent"
    class="w-full md:w-[80%] mx-auto my-6 px-3 transition-all duration-300">

    <!-- FORM CARD -->
    <form class="w-full bg-white p-6 md:p-8 rounded-2xl shadow-lg border border-gray-200" id="loginForm">

        <!-- TITLE -->
        <div class="mb-5 text-center">
            <h2 class="text-xl md:text-2xl font-bold text-gray-800">
                Location Details
            </h2>
            <p class="text-sm text-gray-500">Add new site location</p>
        </div>

        <!-- INPUT -->
        <div class="grid grid-cols-1 gap-4">

            <div>
                <label for="site_location"
                    class="block mb-1 text-sm font-medium text-gray-700">
                    Site Location
                </label>

                <input type="text"
                    id="site_location"
                    class="w-full px-3 py-2.5 border border-gray-400 rounded-lg bg-white text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"
                    placeholder="Enter your site location"
                    required />
            </div>

        </div>

        <!-- BUTTONS -->
        <div class="mt-6 flex flex-col md:flex-row justify-center gap-3">

            <button type="submit"
                class="w-full md:w-[180px] bg-blue-600 hover:bg-blue-500 text-white rounded-lg px-4 py-2.5 transition shadow">
                Save
            </button>

            <button type="button"
                onclick="confirmReset()"
                class="w-full md:w-[180px] bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-lg px-4 py-2.5 border">
                Reset
            </button>

        </div>

    </form>

    <!-- LIST CARD -->
    <div class="mt-6 bg-white p-5 rounded-2xl shadow-lg border border-gray-200">

        <h5 class="text-lg font-semibold text-gray-800 mb-4 text-center">
            Site Locations List
        </h5>

        <ul id="siteList" class="space-y-2">
            <!-- Dynamic -->
        </ul>

    </div>

</div>
                <!--/Main-->
            </div>
            <!--Footer-->
            <?php include 'footer.php'; ?>
            <!--/footer-->

        </div>

    </div>
    <script>
        document.getElementById('loginForm').addEventListener('submit', async function(e) {
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
                alert('You are not allowed to update site location');
                return;
            }

            const siteLocation = document.getElementById('site_location').value.trim();

            if (!siteLocation) {
                alert('Operating location is required');
                return;
            }

            try {
                const response = await fetch(url + 'site-location', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Authorization': 'Bearer ' + token
                    },
                    body: JSON.stringify({
                        site_location: siteLocation
                    })
                });

                const data = await response.json();

                if (!response.ok) {
                    alert(data.message || 'Something went wrong');
                    return;
                }

                alert('Site location saved successfully');
                document.getElementById('loginForm').reset();
                loadSites();
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

    <script>
        async function loadSites() {
    const token = localStorage.getItem('auth_token');

    try {
        const response = await fetch(url + 'site-location', {
            method: 'GET',
            headers: {
                'Authorization': 'Bearer ' + token
            }
        });

        const data = await response.json();

        const list = document.getElementById('siteList');
        list.innerHTML = '';

        if (!data.data || data.data.length === 0) {
            list.innerHTML = '<li class="text-gray-500">No locations found</li>';
            return;
        }
            var sr = 0;
        data.data.forEach(site => {
            const li = document.createElement('li');
            li.className = "p-2 mb-2 bg-gray-100 border border-gray-300 rounded flex justify-between";
            li.innerHTML = `
                <span>${++sr}. ${site.site_location}</span>
            `;

            list.appendChild(li);
        });

    } catch (error) {
        console.error(error);
    }
}
window.onload = function () {
    loadSites();
};
    </script>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.js"></script>

</body>

</html>