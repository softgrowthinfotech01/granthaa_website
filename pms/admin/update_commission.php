<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Commission</title>
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
                <div class="w-[60%] mx-auto my-4 self-start rounded-lg bg-gray-200 p-6 border border-default rounded-base shadow-xs hover:bg-neutral-secondary-medium">
                    <form class="w-full" id="updateCommissionForm">
                        <div class="personal-details">
                          
                            <h5 class="text-xl font-bold text-heading p-1">Update Leader Commission</h5>
                            <div class="grid grid-cols-2">
                                <div class="mb-5 col-span-1 px-1">
                                    <label for="site" class="block mb-2.5 text-sm font-medium text-heading">Site Location</label>
                                    <select id="location_id" class="block w-full px-3 py-2.5 rounded-lg bg-white border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand shadow-xs placeholder:text-body">
                                        <option selected>Choose a site location</option>
                                        
                                    </select>
                                </div>
                                <div class="mb-5 col-span-1 px-1">
                                    <label for="leader" class="block mb-2.5 text-sm font-medium text-heading">Select Leader</label>
                                    <select id="user_id" class="block w-full px-3 py-2.5 rounded-lg bg-white border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand shadow-xs placeholder:text-body">
                                        <option selected>Choose a leader</option>
                                        
                                    </select>
                                </div>
                            </div>
                            <div class="">
                                <div class="mb-5  px-1">
                                    <label class="block mb-2.5 text-sm font-medium text-heading">Commission Type</label>
                                    <div class="flex gap-4">
                                        <div class="flex items-center">
                                            <input type="radio" name="commission_type" value="percent" class="w-4 h-4" checked />
                                            <label for="percentage" class="ml-2 text-sm font-medium text-heading">Percentage</label>
                                        </div>
                                        <div class="flex items-center">
                                            <input type="radio" name="commission_type" value="amount" class="w-4 h-4" />
                                            <label for="amount" class="ml-2 text-sm font-medium text-heading">Amount</label>
                                        </div>
                                    </div></div>
                                
                            </div>
                            <div class="">
                                <div class="mb-5 px-1">
                                   <label for="commission" class="block mb-2.5 text-sm font-medium text-heading">Commission Value</label>
                                    <input type="text" id="commission_value" class="rounded-lg bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body" placeholder="Enter commission value" required />
                                </div>
                            </div>
                        </div>
                   
                        <hr class="border-white-300 mb-3">
                        <div class="flex justify-center gap-2">
                            <!-- UPDATE BUTTON -->
        <button type="submit"
            class="w-[15%] text-white bg-blue-600 hover:bg-blue-400 rounded-lg text-sm px-4 py-2.5">
            Update
        </button>

        <!-- BACK BUTTON -->
        <a href="view_commission.php"
           class="w-[15%] text-center text-gray-700 bg-white hover:bg-gray-200 rounded-lg text-sm px-5 py-2.5 inline-block">
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
        headers: { "Authorization": "Bearer " + token }
    });
    const locData = await locRes.json();

    locationSelect.innerHTML = "";
    locData.data.data.forEach(loc => {
        locationSelect.innerHTML +=
            `<option value="${loc.id}">${loc.site_location}</option>`;
    });

    // Load leaders
    const leaderRes = await fetch(url + "leader_list", {
        headers: { "Authorization": "Bearer " + token }
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

    const commission = result.data;

    // 🔥 SET VALUES AFTER small delay (ensures dropdown rendered)
    setTimeout(() => {
        document.getElementById("location_id").value = commission.location_id;
        document.getElementById("user_id").value = commission.user_id;
        document.getElementById("commission_value").value = commission.commission_value;

        const radio = document.querySelector(
            `input[name="commission_type"][value="${commission.commission_type}"]`
        );

        if (radio) radio.checked = true;

    }, 100);
}

// 3️⃣ Submit Update
document.getElementById("updateCommissionForm")
.addEventListener("submit", async function(e) {

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