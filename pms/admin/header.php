<header class="bg-white shadow-lg">
    <div class="flex justify-between items-center px-4 h-22">

        <!-- Left -->
        <div class="flex items-center gap-5">
            <i class="fas fa-bars text-gray-700 cursor-pointer hover:bg-gray-300 p-2 rounded-sm"
                onclick="sidebarToggle()"></i>

            <h1 class="text-gray-700 text-lg font-semibold">
                Granthaa Admin Panel
            </h1>
        </div>

        <!-- Center -->
        <img src="../images/logo.png" alt="logo" width="130px" class="rounded-sm">
        <!-- Center -->

        <!-- Right -->
        <div class="relative flex items-center bg-gray-300 rounded-lg">
            <a href="#"
                onclick="profileToggle()"
                class="flex items-center gap-2 px-3 py-2 rounded-sm hover:bg-gray-500 cursor-pointer text-gray-900 hover:text-white hover:rounded-lg">
                <img src="../images/profile.png" class="w-8 h-8 rounded-full">
                <span class="hidden md:block font-medium ">User</span>
            </a>


            <!-- Dropdown -->
            <div id="ProfileDropDown"
                class="hidden absolute right-0 top-14 w-48
                        bg-white rounded shadow-lg z-50">

                <ul class="text-sm text-gray-700">
                    <li>
                        <a href="#" class="block px-4 py-2 hover:bg-gray-100">
                            My account
                        </a>
                    </li>
                    <li>
                        <a href="#" class="block px-4 py-2 hover:bg-gray-100">
                            Notifications
                        </a>
                    </li>
                    <li>
                        <hr class="my-1 border-gray-200">
                    </li>
                    <li>
                        <a  onclick="logout()"  class="block px-4 py-2 hover:bg-gray-100 text-red-600">
                            Logout
                        </a>
                    </li>
                </ul>
            </div>
        </div>

    </div>
</header>
<script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<script>
    function logout() {
    const token = localStorage.getItem("auth_token");

    fetch("http://localhost/api/logout", {
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

</script>