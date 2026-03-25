<header class="bg-gray-100 border-b shadow-lg">
    <div class="flex justify-between items-center px-6 h-20">

        <!-- LEFT -->
        <div class="flex items-center gap-4">

            <!-- Sidebar Toggle -->
            <i class="fas fa-bars text-gray-700 text-lg cursor-pointer hover:bg-gray-200 p-2 rounded-md md:hidden"
                onclick="sidebarToggle()"></i>

            <h1 class="text-gray-800 text-lg font-semibold tracking-wide">
                Granthaa Admin Panel
            </h1>

        </div>


        <!-- CENTER LOGO -->
        <div class="hidden md:flex items-center">
            <img src="../images/logo_icon.png"
                class="w-40 h-20">
        </div>


        <!-- RIGHT SIDE -->
        <div class="flex items-center gap-4">

            <!-- PROFILE -->
            <div class="relative">

                <div onclick="profileToggle()"
                    class="flex items-center gap-2 cursor-pointer px-3 py-2 rounded-lg bg-gray-200 hover:bg-gray-300 shadow-sm">

                    <img src="../images/profile.png"
                        class="w-9 h-9 rounded-full border border-gray-300 shadow-sm">

                    <span class="hidden md:block font-medium text-red-700">
                        ADMIN
                    </span>

                    <i class="fa-solid fa-chevron-down text-xs text-gray-500"></i>

                </div>

                <!-- DROPDOWN -->
                <div id="ProfileDropDown"
                    class="hidden absolute right-0 mt-3 w-52 bg-white border rounded-xl shadow-2xl overflow-hidden z-50">


                    <hr>

                    <a onclick="logout()"
                        class="flex items-center gap-2 px-4 py-3 hover:bg-red-50 text-red-600 cursor-pointer">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        Logout
                    </a>
                    <hr>
                     <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 rounded-lg shadow-sm mb-4">

                    <h3 class="text-lg font-semibold text-yellow-800 mb-2">
                        ⚠️ Alerts
                    </h3>

                    <ul id="alertsList" class="text-sm text-yellow-700 space-y-1"></ul>

                </div>

                </div>

            </div>

        </div>

    </div>
</header>

<script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<script src="../url.js"></script>

<script>
    function profileToggle() {
        const dropdown = document.getElementById("ProfileDropDown");
        dropdown.classList.toggle("hidden");
    }


    function logout() {

        const token = localStorage.getItem("auth_token");

        fetch(url + "logout", {
            method: "POST",
            headers: {
                "Authorization": "Bearer " + token,
                "Accept": "application/json"
            }
        }).finally(() => {
            localStorage.clear();
            window.location.href = "../login.php";
        });
    }


    const user = JSON.parse(localStorage.getItem("auth_user"));

    if (!user || user.role !== "admin") {
        alert("Unauthorized access");
        window.location.href = "../login.php";
    }

    function loadAlerts() {

    const token = localStorage.getItem("auth_token");

    fetch(url + "dashboard-alerts", {
        headers: {
            "Authorization": "Bearer " + token
        }
    })
    .then(res => res.json())
    .then(res => {

        const alerts = res.data;

        const ul = document.getElementById("alertsList");
        ul.innerHTML = "";

        if (alerts.length === 0) {
            ul.innerHTML = `<li>✅ No alerts, everything looks good</li>`;
            return;
        }

        alerts.forEach(a => {
            ul.innerHTML += `<li>${a}</li>`;
        });

    });
}
</script>