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
        <div class="flex items-center gap-5">

            <!-- 🔔 BELL ICON -->
            <div class="relative">

                <div onclick="toggleAlerts()"
                    class="relative cursor-pointer p-2 rounded-full hover:bg-gray-200">

                    <i class="fa-solid fa-bell text-xl text-blue-700"></i>

                    <!-- 🔴 Notification Dot -->
                    <span id="alertDot"
                        class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full hidden"></span>
                </div>

                <!-- 🔽 ALERT DROPDOWN -->
                <div id="alertDropdown"
                    class="hidden absolute right-0 mt-3 w-80 bg-white border border-gray-200 rounded-xl shadow-xl z-50 overflow-hidden">

                    <!-- HEADER -->
                    <div class="flex items-center gap-2 px-4 py-3 border-b bg-yellow-50">
                        <span class="text-yellow-600 text-lg">⚠️</span>
                        <h3 class="text-md font-semibold text-yellow-800">
                            Alerts
                        </h3>
                    </div>

                    <!-- BODY -->
                    <div class="p-3 max-h-64 overflow-y-auto bg-white">
                        <ul id="alertsList" class="text-sm space-y-2"></ul>
                    </div>

                </div>

            </div>

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
    function toggleAlerts() {
        const dropdown = document.getElementById("alertDropdown");
        const dot = document.getElementById("alertDot");

        dropdown.classList.toggle("hidden");

        if (!dropdown.classList.contains("hidden")) {
            loadAlerts();

            // ✅ mark as seen
            alertsSeen = true;
            dot.classList.add("hidden");
        }
    }

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

    let alertsSeen = false;

    function loadAlerts() {

        const token = localStorage.getItem("auth_token");

        fetch(url + "dashboard-alerts", {
                headers: {
                    "Authorization": "Bearer " + token
                }
            })
            .then(res => res.json())
            .then(res => {

                const alerts = res.data || [];
                const ul = document.getElementById("alertsList");
                const dot = document.getElementById("alertDot");

                ul.innerHTML = "";

                if (alerts.length === 0) {
                    ul.innerHTML = `<li>✅ No alerts, everything looks good</li>`;
                    dot.classList.add("hidden");
                    return;
                }

                // ✅ Show dot ONLY if not seen
                if (!alertsSeen) {
                    dot.classList.remove("hidden");
                } else {
                    dot.classList.add("hidden");
                }


                alerts.forEach(a => {
                    ul.innerHTML += `
        <li class="flex items-start gap-2 p-2 rounded-md hover:bg-yellow-50 transition border border-yellow-100">
            
            <span class="text-gray-700">${a}</span>
        </li>
    `;
                });

            })
            .catch(() => {
                document.getElementById("alertDot").classList.add("hidden");
            });
    }
</script>