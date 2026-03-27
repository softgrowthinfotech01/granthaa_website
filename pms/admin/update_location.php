<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Location</title>
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
    class="w-full md:w-[60%] mx-auto my-6 px-3">

    <form class="w-full bg-white p-6 md:p-8 rounded-2xl shadow-lg border border-gray-200">

        <!-- TITLE -->
        <div class="mb-6 text-center">
            <h2 class="text-xl md:text-2xl font-bold text-gray-800">
                Update Location Details
            </h2>
            <p class="text-sm text-gray-500">Edit site location</p>
        </div>

        <!-- INPUT -->
        <input type="hidden" id="location_id">

        <div class="mb-5">
            <label for="site_location"
                class="block mb-1 text-sm font-medium text-gray-700">
                Site Location
            </label>

            <input type="text"
                id="site_location"
                class="w-full px-3 py-2.5 border border-gray-400 rounded-lg bg-white text-sm focus:ring-2 focus:ring-blue-500 outline-none"
                placeholder="Enter your site location"
                required />
        </div>

        <hr class="mb-6">

        <!-- BUTTONS -->
        <div class="flex flex-col md:flex-row justify-center gap-3">

            <button type="button"
                onclick="updateLocation()"
                class="w-full md:w-[180px] bg-blue-600 hover:bg-blue-500 text-white rounded-lg px-4 py-2.5 transition shadow">
                Update
            </button>

            <a href="view_location.php"
                class="w-full md:w-[180px] text-center bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-lg px-4 py-2.5 border">
                Back
            </a>

        </div>

    </form>
</div><!--/Main-->
            </div>
            <!--Footer-->
            <?php include 'footer.php'; ?>
            <!--/footer-->

        </div>

    </div>
    <script src="../url.js"></script>

    <script>
       
        const token = localStorage.getItem("auth_token");

        // ✅ Get ID from URL
        const params = new URLSearchParams(window.location.search);
        const id = params.get("id");
        if (!id) {
    alert("Invalid location ID");
    window.location.href = "view_location.php";
}

        // Load single data
        async function loadLocation() {

    try {

        const response = await fetch(
            url + `site-location/${id}`, {
                method: "GET",
                headers: {
                    "Accept": "application/json",
                    "Authorization": "Bearer " + token
                }
            }
        );

        const result = await response.json();

        if (!response.ok) {
            alert(result.message || "Failed to load location");
            return;
        }

        document.getElementById("location_id").value = result.data.id;
        document.getElementById("site_location").value = result.data.site_location;

    } catch (error) {
        console.error("Error loading location:", error);
    }
}

        // Update function
        async function updateLocation() {

            const locationId = document.getElementById("location_id").value;
            const siteLocation = document.getElementById("site_location").value;

            try {

                const response = await fetch(
                    url + `site-location/${locationId}`, {
                        method: "PUT",
                        headers: {
                            "Accept": "application/json",
                            "Content-Type": "application/json",
                            "Authorization": "Bearer " + token
                        },
                        body: JSON.stringify({
                            site_location: siteLocation
                        })
                    }
                );

                const result = await response.json();


                if (response.ok) {
                    alert(result.message || "Updated successfully");
                    window.location.href = "view_location.php";
                } else {
                    alert(result.message || "Something went wrong");
                }

            } catch (error) {
                console.error("Update error:", error);
            }
        }

        // Load data on page load
        loadLocation();
    </script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.js"></script>

</body>

</html>