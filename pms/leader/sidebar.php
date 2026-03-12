<?php $current = basename($_SERVER['PHP_SELF']); ?>

<aside id="sidebar"
  class="fixed md:static z-30 top-0 left-0 h-full w-55 md:w-64 bg-gray-800 text-white
transition-all duration-300 ease-in-out -translate-x-full md:translate-x-0
flex flex-col justify-between shrink-0">

  <!-- Top -->
  <div>
    <!-- Logo -->
    <div class=" sidebar-text p-4 flex justify-center items-center">
      <h1 class="text-2xl md:text-3xl font-serif font-semibold tracking-[0.25em]
             text-yellow-500 drop-shadow-sm">
        GRANTHAA
      </h1>
      <!-- <img src="../images/logo.png" 
       alt="Granthaa Land Developer Pvt Ltd"
       class="h-25 w-60 sidebar-logo transition-all duration-300 border-2 border-yellow-400 rounded-lg "> -->

    </div>


    <nav class="mt-6 px-2">

      <ul class="space-y-6">

        <!-- Dashboard -->
        <li>
          <a href="dashboard"
            class="menu-item <?php if ($current == 'dashboard') echo 'active'; ?>">

            <svg class="w-6 h-6 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path d="M3 12l9-9 9 9M4 10v10h16V10" />
            </svg>

            <span class="sidebar-text">Dashboard</span>
          </a>
        </li>

        <!-- Leader -->
        <li>
          <a href="javascript:void(0)"
            onclick="toggleMenu('advisor', this)"
            class="menu-item flex justify-between items-center">

            <span class="flex items-center gap-3">
              <svg class="w-6 h-6 text-yellow-500" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                  d="M12 14c4 0 7 2 7 4v1H5v-1c0-2 3-4 7-4z" />
                <circle cx="12" cy="8" r="4" stroke-linecap="round" stroke-linejoin="round" />
              </svg>
              <span class="sidebar-text">Advisor</span>
            </span>

            <svg class="menu-arrow w-4 h-4 transition-transform transform" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
            </svg>
          </a>

          <ul id="advisor" class="hidden">

            <!-- Add Leader -->
            <li>
              <a href="add_advisor"
                class="menu-item flex items-center gap-3 <?php if ($current == 'add_commission') echo 'active'; ?>">

                <svg class="w-4 h-4 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path d="M4 12h16" />
                </svg>

                <span class="sidebar-text">Add Advisor</span>
              </a>
            </li>

            <!-- View leader -->
            <li>
              <a href="list_advisor"
                class="menu-item flex items-center gap-3 <?php if ($current == 'view_commission') echo 'active'; ?>">

                <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path d="M4 12h16" />
                </svg>

                <span class="sidebar-text">View Advisor</span>
              </a>
            </li>

          </ul>
        </li>


        <!-- Commission -->
        <li>
          <a href="javascript:void(0)"
            onclick="toggleMenu('commission', this)"
            class="menu-item flex justify-between items-center">

            <span class="flex items-center gap-3">
              <svg class="w-6 h-6 text-yellow-500" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                  d="M17 20v-2a4 4 0 0 0-3-3.87M7 20v-2a4 4 0 0 1 3-3.87m0 0A4 4 0 1 0 7 6a4 4 0 0 0 3 8zm6-8a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
              </svg>
              <span class="sidebar-text">Commission</span>
            </span>

            <svg class="menu-arrow w-4 h-4 transition-transform transform" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
            </svg>
          </a>

          <ul id="commission" class="hidden">

            <!-- Add Commission -->
            <li>
              <a href="set_commission"
                class="menu-item flex items-center gap-3 <?php if ($current == 'add_commission') echo 'active'; ?>">

                <svg class="w-4 h-4 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path d="M4 12h16" />
                </svg>

                <span class="sidebar-text">Add Commission</span>
              </a>
            </li>

            <!-- View Commission -->
            <li>
              <a href="list_commission"
                class="menu-item flex items-center gap-3 <?php if ($current == 'view_commission') echo 'active'; ?>">

                <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path d="M4 12h16" />
                </svg>

                <span class="sidebar-text">View Commission</span>
              </a>
            </li>

          </ul>
        </li>

        <!-- Booking -->
        <li>
          <a href="javascript:void(0)"
            onclick="toggleMenu('Booking', this)"
            class="menu-item flex justify-between items-center">

            <span class="flex items-center gap-3">
              <svg class="w-6 h-6 text-yellow-500" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                  d="M16 14c3 0 5 2 5 4v1H3v-1c0-2 2-4 5-4" />
                <circle cx="9" cy="8" r="3" />
                <circle cx="17" cy="9" r="2" />
              </svg>
              <span class="sidebar-text">Booking</span>
            </span>

            <svg class="menu-arrow w-4 h-4 transition-transform transform" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
            </svg>
          </a>

          <ul id="Booking" class="hidden">

            <!-- Add Booking -->
            <li>
              <a href="customer_booking"
                class="menu-item flex items-center gap-3 <?php if ($current == 'add_commission') echo 'active'; ?>">

                <svg class="w-4 h-4 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path d="M4 12h16" />
                </svg>

                <span class="sidebar-text">Add Booking</span>
              </a>
            </li>

            <!-- View Booking -->
            <li>
              <a href="list_customer_booking"
                class="menu-item flex items-center gap-3 <?php if ($current == 'view_commission') echo 'active'; ?>">

                <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path d="M4 12h16" />
                </svg>

                <span class="sidebar-text">View Booking</span>
              </a>
            </li>

          </ul>
        </li>

        <!-- Payment -->
        <li>
          <a href="javascript:void(0)"
            onclick="toggleMenu('payment', this)"
            class="menu-item flex justify-between items-center">

            <span class="flex items-center gap-3">
              <svg class="w-6 h-6 text-yellow-500" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                <rect x="3" y="7" width="18" height="10" rx="2" />
                <circle cx="16" cy="12" r="1.5" />
                <path d="M3 10h18" />
              </svg>
              <span class="sidebar-text">Payment</span>
            </span>

            <svg class="menu-arrow w-4 h-4 transition-transform transform" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
            </svg>
          </a>

          <ul id="payment" class="hidden">

            <!-- Add Payment -->
            <li>
              <a href="payment"
                class="menu-item flex items-center gap-3 <?php if ($current == 'add_commission') echo 'active'; ?>">

                <svg class="w-4 h-4 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path d="M4 12h16" />
                </svg>

                <span class="sidebar-text">Add Payment</span>
              </a>
            </li>

            <!-- View Payments -->
            <li>
              <a href="list_payment"
                class="menu-item flex items-center gap-3 <?php if ($current == 'view_commission') echo 'active'; ?>">

                <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path d="M4 12h16" />
                </svg>

                <span class="sidebar-text">View Payment</span>
              </a>
            </li>

          </ul>
        </li>

        <a href="team_performance"
          class="menu-item <?php if ($current == 'team_performance') echo 'active'; ?>">
          <svg class="w-6 h-6 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M3 3v18h18M7 13l3-3 4 4 5-5" />
          </svg>
          <span class="sidebar-text">Team Performance</span>
        </a>

      </ul>

    </nav>
  </div>

  <!-- Bottom Logout -->
  <div class="p-3 border-t border-gray-700">
    <a href="" onclick="logout()"
      class="menu-item text-red-400 hover:bg-red-500 hover:text-white transition">
      <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path d="M17 16l4-4m0 0l-4-4m4 4H7" />
      </svg>
      <span class="sidebar-text">Logout</span>
    </a>
  </div>

</aside>

<!-- Toggle -->

<script>
  function profileToggle() {
    const profileDropdown = document.getElementById('ProfileDropDown');
    profileDropdown.classList.toggle('hidden');
  }

  function toggleMenu(menuId, el) {

    const menu = document.getElementById(menuId);
    const arrow = el.querySelector('.menu-arrow');

    if (!menu) {
      console.error('Menu not found:', menuId);
      return;
    }

    menu.classList.toggle('hidden');

    if (arrow) {
      arrow.classList.toggle('rotate-90');
    }

  }
</script>

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

  if (!user || user.role !== "leader") {
    alert("Unauthorized access");
    window.location.href = "../login.php";
  }
</script>