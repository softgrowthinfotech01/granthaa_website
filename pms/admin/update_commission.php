<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Commission</title>
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

    <form class="w-full bg-white p-6 md:p-8 rounded-2xl shadow-lg border border-gray-200"
        id="updateCommissionForm">

        <!-- TITLE -->
        <div class="mb-6 text-center">
            <h2 class="text-xl md:text-2xl font-bold text-gray-800">
                Update Leader Commission
            </h2>
            <p class="text-sm text-gray-500">Modify commission details</p>
        </div>

        <!-- ROW 1 -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

            <!-- Site -->
            <div>
                <label class="block text-sm text-gray-700 mb-1">Site Location</label>
                <select id="location_id"
                    class="w-full px-3 py-2.5 rounded-lg bg-gray-100 border border-gray-200 text-gray-700 text-sm cursor-not-allowed"
                    readonly>
                    <option selected>Loading...</option>
                </select>
            </div>

            <!-- Leader -->
            <div>
                <label class="block text-sm text-gray-700 mb-1">Leader</label>
                <select id="user_id"
                    class="w-full px-3 py-2.5 rounded-lg bg-gray-100 border border-gray-200 text-gray-700 text-sm cursor-not-allowed"
                    readonly>
                    <option selected>Loading...</option>
                </select>
            </div>

        </div>

        <!-- COMMISSION TYPE -->
        <div class="mt-5">
            <label class="block text-sm font-medium text-gray-700 mb-2">
                Commission Type
            </label>

            <div class="flex flex-wrap gap-2">

                <label class="flex items-center gap-2 px-3 py-2 border rounded-md cursor-pointer hover:bg-blue-100">
                    <input type="radio" name="commission_type" value="percent" id="percentage"
                        class="accent-blue-600" checked>
                    <span class="text-blue-600 font-bold text-sm">%</span>
                    <span class="text-sm">Percentage</span>
                </label>

                <label class="flex items-center gap-2 px-3 py-2 border rounded-md cursor-pointer hover:bg-blue-100">
                    <input type="radio" name="commission_type" value="amount" id="amount"
                        class="accent-blue-600">
                    <span class="text-green-600 font-bold text-sm">₹</span>
                    <span class="text-sm">Amount</span>
                </label>

            </div>
        </div>

        <!-- VALUE -->
        <div class="mt-5">
            <label class="block text-sm text-gray-700 mb-1">
                Commission Value
            </label>

            <input type="text" id="commission_value"
                class="w-full px-3 py-2.5 border border-gray-400 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 outline-none"
                placeholder="Enter commission value" required />
        </div>

        <hr class="my-6">

        <!-- BUTTONS -->
        <div class="flex flex-col md:flex-row justify-center gap-3">

            <button type="submit"
                class="w-full md:w-[180px] bg-blue-600 hover:bg-blue-500 text-white rounded-lg px-4 py-2.5 transition shadow">
                Update
            </button>

            <a href="view_commission.php"
                class="w-full md:w-[180px] text-center bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-lg px-4 py-2.5 border">
                Back
            </a>

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
        const token = localStorage.getItem("auth_token");
        const params = new URLSearchParams(window.location.search);
        const commissionId = params.get("id");

        if (!commissionId) {
            alert("Invalid commission ID");
            window.location.href = "view_commission.php";
        }

        // 1️⃣ Load Dropdowns FIRST
        async function loadDropdowns() {

            const locationSelect = document.getElementById("location_id");
            const leaderSelect = document.getElementById("user_id");

            // Load locations
            const locRes = await fetch(url + "site-location", {
                headers: {
                    "Authorization": "Bearer " + token
                }
            });
            const locData = await locRes.json();

            locationSelect.innerHTML = "";
            locData.data.forEach(loc => {
                locationSelect.innerHTML +=
                    `<option value="${loc.id}">${loc.site_location}</option>`;
            });

            // Load leaders
            const leaderRes = await fetch(url + "by-role?role=leader", {
                headers: {
                    "Authorization": "Bearer " + token
                }
            });
            const leaderData = await leaderRes.json();

            leaderSelect.innerHTML = "";
            leaderData.data.data.forEach(user => {
                leaderSelect.innerHTML +=
                    `<option value="${user.id}">${user.name}</option>`;
            });
        }

        // 2️⃣ Load Commission AFTER dropdowns loaded
        async function loadCommission() {

            const response = await fetch(url + `commission/${commissionId}`, {
                headers: {
                    "Authorization": "Bearer " + token,
                    "Accept": "application/json"
                }
            });

            const result = await response.json();

            if (!response.ok) {
                alert(result.message);
                return;
            }

            // 🔥 Correct path based on your API response
            const commission = result.data;

            console.log("Commission:", commission);

            document.getElementById("location_id").value = String(commission.location_id);
            document.getElementById("user_id").value = String(commission.user_id);
            document.getElementById("commission_value").value = commission.commission_value;

            const radio = document.querySelector(
                `input[name="commission_type"][value="${commission.commission_type}"]`
            );

            console.log(commission.commission_type);

            if (radio) radio.checked = true;
        }

        // 3️⃣ Submit Update
        document.getElementById("updateCommissionForm")
            .addEventListener("submit", async function (e) {

                e.preventDefault();

                const location_id = document.getElementById("location_id").value;
                const user_id = document.getElementById("user_id").value;
                const commission_value = document.getElementById("commission_value").value;
                const commission_type = document.querySelector(
                    'input[name="commission_type"]:checked'
                ).value;

                const response = await fetch(url + `commission/${commissionId}`, {
                    method: "PUT",
                    headers: {
                        "Content-Type": "application/json",
                        "Authorization": "Bearer " + token
                    },
                    body: JSON.stringify({
                        user_id,
                        location_id,
                        commission_type,
                        commission_value
                    })
                });

                const result = await response.json();

                if (!response.ok) {
                    console.log(result);
                    alert(result.message || "Update failed");
                    return;
                }

                alert("Commission updated successfully");
                window.location.href = "view_commission.php";
            });

        // 🔥 IMPORTANT ORDER
        loadDropdowns().then(() => {
            loadCommission();
        });
    </script>
</body>

</html>