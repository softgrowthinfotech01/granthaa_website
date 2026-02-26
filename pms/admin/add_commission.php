<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Commission</title>
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
                <div class="w-[60%] mx-auto my-4 self-start rounded-lg bg-gray-200 p-6 border border-default rounded-base shadow-xl hover:bg-neutral-secondary-medium">
                    <form id="commissionForm" class="w-full">
                        <div class="personal-details">
                            <h5 class="text-xl font-bold text-heading p-1">Set Leader Commission</h5>
                            <div class="grid grid-cols-2">
                                <div class="mb-5 col-span-1 px-1">
                                    <label for="site" class="block mb-2.5 text-sm font-medium text-heading">Site Location</label>
                                    <select name="location_id" id="location_id" class="block w-full px-3 py-2.5 rounded-lg bg-white border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand shadow-xs placeholder:text-body focus:outline-none focus:ring-2 focus:ring-gray-600">
                                        <option selected>Choose a site location</option>
                                        <option value="">Loading...</option>

                                    </select>
                                </div>
                                <div class="mb-5 col-span-1 px-1">
                                    <label for="leader" class="block mb-2.5 text-sm font-medium text-heading">Select Leader</label>
                                    <select name="user_id" id="user_id" class="block w-full px-3 py-2.5 rounded-lg bg-white border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand shadow-xs placeholder:text-body focus:outline-none focus:ring-2 focus:ring-gray-600">
                                        <option selected>Choose a Leader</option>
                                        <option value="">Loading...</option>
                                    </select>
                                </div>
                            </div>
                            <div class="">
                                <div class="mb-5  px-1">
                                    <label class="block mb-2.5 text-sm font-medium text-heading">Commission Type</label>
                                    <div class="flex gap-4">
                                        <div class="flex items-center">
                                            <input  name="commission_type" value="percent"  type="radio" id="percentage"  class="w-4 h-4" checked />
                                            <label for="percentage" class="ml-2 text-sm font-medium text-heading">Percentage</label>
                                        </div>
                                        <div class="flex items-center">
                                            <input name="commission_type" value="amount" type="radio" id="amount" class="w-4 h-4" />
                                            <label  for="amount" class="ml-2 text-sm font-medium text-heading">Amount</label>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="">
                                <div class="mb-5 px-1">
                                    <label for="commission" class="block mb-2.5 text-sm font-medium text-heading">Commission Value</label>
                                    <input name="commission_value" type="text" id="commission_value" class="rounded-lg bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body focus:outline-none focus:ring-2 focus:ring-gray-600" placeholder="Enter commission value" required />
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
        const leaderRes = await fetch(url + 'by-role?role=leader', {
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


</body>

</html>