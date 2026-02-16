<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Location</title>
    <link rel="stylesheet" href="../style.css">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.css" rel="stylesheet" />

</head>

<body>
    <!--Container -->
    <div class="mx-auto">
        <!--Screen-->
        <div class="flex flex-col">
            <!--Header Section Starts Here-->
            <?php include "header.php"; ?>
            <!--/Header-->

            <div class="flex">
                <!--Sidebar-->
                <?php include 'sidebar.php'; ?>
                <!--/Sidebar-->

                <!--Main-->
                <div class="w-[60%] mx-auto my-4 self-start rounded-lg bg-gray-300 p-6 border border-default rounded-base shadow-xs hover:bg-neutral-secondary-medium">
                    <form class="w-full" id="loginForm">
                        <div class="personal-details">
                            <h5 class="text-xl font-bold text-heading p-1">Location Details</h5>
                            <div class="w-full">
                               
                                <div class="mb-5  px-1">
                                    <label for="site_location" class="block mb-2.5 text-sm font-medium text-heading">Site Location</label>
                                    <input type="text" id="site_location" class="rounded-lg bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body" placeholder="Enter your site location" required />
                                </div>
                            </div>
                        </div>
                        <hr class="border-white-300 mb-3">
                        <div class="flex justify-center gap-2">
                            <button type="submit" class="w-[15%] text-white bg-blue-600 box-border border border-transparent hover:bg-blue-400 rounded-lg focus:ring-4 focus:ring-brand-medium shadow-xs font-medium leading-5 rounded-base text-sm px-4 py-2.5 focus:outline-none">Save</button>
                            <button type="button"
                                onclick="confirmReset()"
                                class="w-[15%] text-gray-700 bg-white hover:bg-gray-200 rounded-lg text-sm px-5 py-2.5">
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

<script src="url.js"></script>

    <script>
document.getElementById('loginForm').addEventListener('submit', async function (e) {
    e.preventDefault();

    const token = localStorage.getItem('auth_token');
    const user  = JSON.parse(localStorage.getItem('auth_user'));

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

    <script src="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.js"></script>

</body>

</html>