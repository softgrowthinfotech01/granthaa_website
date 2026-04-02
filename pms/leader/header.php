<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Granthaa Land Developer Pvt Ltd</title>

  <link rel="stylesheet" href="../style.css">
  <script src="script.js"></script>

  <!-- <link rel="stylesheet" href="a.css"> -->
  <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
  <!--Responsive Extension Datatables CSS-->
  <link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" rel="stylesheet">


  <style>
    /* Sidebar collapse */
    .sidebar-collapsed {
      width: 5rem !important;
    }

    .sidebar-collapsed .sidebar-text {
      display: none;
    }

   /* MOBILE → hide scrollbar */
@media (max-width: 640px) {

  #sidebar {
    -ms-overflow-style: none;  /* IE & Edge */
    scrollbar-width: none;     /* Firefox */
  }

  #sidebar::-webkit-scrollbar {
    display: none;             /* Chrome, Safari */
  }



}

/* DESKTOP → show scrollbar */
@media (min-width: 641px) {

  #sidebar {
    overflow-y: auto;
    scrollbar-width: thin; /* Firefox */
       overflow-x: hidden !important;  
   
  }

  #sidebar::-webkit-scrollbar {
    width: 6px;
  }

  #sidebar::-webkit-scrollbar-thumb {
    background-color: #cbd5e1; /* Tailwind gray-300 */
    border-radius: 6px;
  }

  #sidebar::-webkit-scrollbar-thumb:hover {
    background-color: #94a3b8; /* darker */
  }
  

}


    /* Menu items */
    .menu-item {
      display: flex;
      align-items: center;
      gap: 12px;
      padding: 10px;
      border-radius: 12px;
      transition: all .3s ease;
    }

    .menu-item:hover {
      background: rgb(17 24 39);
      color: white;
    }

    .menu-item.active {
      background: rgb(3 7 18);
      ;
      color: white;
    }

    /* Profile dropdown animation */
    #profileMenu {
      transition: all 0.3s ease;
      transform-origin: top right;
    }
  </style>
</head>


<body class="bg-gray-200">



  <!-- Mobile overlay -->
  <div id="overlay" onclick="toggleMobileSidebar()"
    class="fixed inset-0 bg-black/50 hidden z-20 transition-opacity duration-300">
  </div>

  <div class="flex h-screen overflow-hidden">

    <?php include 'sidebar.php'; ?>

    <div class="flex-1 flex flex-col overflow-hidden">

      <header class="bg-gray-200 shadow px-4 sm:px-6 py-4 flex justify-between items-center">

        <!-- Desktop toggle -->
        <button onclick="toggleSidebar()" class="hidden md:block text-2xl">
          ☰
        </button>

        <!-- Mobile toggle -->
        <button onclick="toggleMobileSidebar()" class="md:hidden text-xl">
          ☰
        </button>

        <!-- Project Name -->
        <div class="absolute left-1/2 transform -translate-x-1/2 text-center">
          <img src="../images/logo_icon.png" alt="Granthaa Land Developer Pvt Ltd"
            class="h-23 w-70 sidebar-logo transition-all duration-300 ">
        </div>






        <!-- RIGHT SIDE PROFILE -->
        <div class="relative flex items-center gap-3">

          <!-- LEADER badge -->
          <span class="hidden md:block relative px-4 py-1 bg-yellow-500  text-black text-xs font-bold tracking-widest
             rounded-md shadow-md">
            LEADER
          </span>




          <div id="profileWrapper" class="relative">

            <!-- Profile Button -->
            <button onclick="toggleProfile(event)" class="w-14 h-14 rounded-full border-2 border-yellow-500
           overflow-hidden shadow-md hover:shadow-lg transition">

              <img src="../images/profile.png" class="w-full h-full object-cover" alt="Profile">
            </button>

            <!-- Dropdown -->
            <div id="profileMenu" class="hidden absolute right-0 mt-3 bg-white rounded-xl shadow-lg w-56 z-50">

              <div class="p-4 border-b text-center">
                <img src="../images/profile.png"
                  class="w-16 h-16 mx-auto rounded-full object-cover border-2 border-yellow-500 mb-2">

                <p id="userCode" class="font-semibold text-gray-800"></p>
                <p id="userName" class="text-lg font-semibold text-gray-500"></p>
                <p id="userEmail" class="text-sm font-semibold text-gray-500 break-all">
                </p>
                </p>
              </div>

              <a href="profile" style="cursor: pointer;"
                class="block px-4 py-2 text-blue-500 hover:bg-gray-100 transition text-center">
                Profile
              </a>
              <hr>
              <a onclick="logout()" style="cursor: pointer;"
                class="block px-4 py-2 text-red-500 hover:bg-gray-100 transition text-center">
                Logout
              </a>

            </div>

          </div>
          <script src="../url.js"></script>
          <script>
            //  Customer Data
            document.addEventListener("DOMContentLoaded", function() {

              // get user object from localStorage
              console.log(localStorage.getItem("auth_user")); //debug
              const userData = JSON.parse(localStorage.getItem("auth_user") || "{}")
              document.getElementById("userCode").textContent = userData.user_code || "";
              document.getElementById("userName").textContent = userData.name || "";
              document.getElementById("userEmail").textContent = userData.email || "";
            });

            function logout() {

              const token = localStorage.getItem("auth_token");
              fetch(url + "logout", {
                  method: "POST",
                  headers: {
                    "Authorization": "Bearer " + token,
                    "Accept": "application/json"
                  }
                })
                .then(() => {
                  // remove only auth data
                  localStorage.removeItem("auth_token");
                  localStorage.removeItem("auth_user");
                  window.location.href = "../login.php";
                })
                .catch(() => {
                  // logout even if API fails
                  localStorage.removeItem("auth_token");
                  localStorage.removeItem("auth_user");
                  window.location.href = "../login.php";
                });

            }
            //     function logout() {
            //     const token = localStorage.getItem("auth_token");

            //     fetch(url + "logout", {
            //         method: "POST",
            //         headers: {
            //             "Authorization": "Bearer " + token,
            //             "Accept": "application/json"
            //         }
            //     }).finally(() => {
            //         localStorage.clear();
            //         window.location.href = "../login.php";
            //     });
            // }

            // const user = JSON.parse(localStorage.getItem("auth_user"));

            // if (!user || user.role !== "leader") {
            //     alert("Unauthorized access");
            //     window.location.href = "../login.php";
            // }
          </script>

        </div>


      </header>

      <main class="p-6 overflow-y-auto transition-all duration-300">