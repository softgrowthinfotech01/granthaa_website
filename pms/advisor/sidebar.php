<?php $current = basename($_SERVER['PHP_SELF']); ?>

<aside id="sidebar"
  class="fixed md:static z-30 top-0 left-0 h-full w-55 md:w-64 bg-gray-800 text-white
transition-all duration-300 ease-in-out -translate-x-full md:translate-x-0
flex flex-col justify-between flex-shrink-0">

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

      <ul class="space-y-5">

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
            onclick="toggleMenu('Customer', this)"
            class="menu-item flex justify-between items-center">

            <span class="flex items-center gap-3">
              <svg class="w-6 h-6 text-yellow-500" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                  d="M12 14c4 0 7 2 7 4v1H5v-1c0-2 3-4 7-4z" />
                <circle cx="12" cy="8" r="4" stroke-linecap="round" stroke-linejoin="round" />
              </svg>
              <span class="sidebar-text">Customer Booking</span>
            </span>

            <svg class="menu-arrow w-4 h-4 transition-transform transform" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
            </svg>
          </a>

          <ul id="Customer" class="hidden">

            <!-- Add Leader -->
            <li>
              <a href="add_customer_booking"
                class="menu-item flex items-center gap-3 <?php if ($current == 'add_commission') echo 'active'; ?>">

                <svg class="w-4 h-4 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path d="M4 12h16" />
                </svg>

                <span class="sidebar-text">Add Customer Bookings</span>
              </a>
            </li>

            <!-- View leader -->
            <li>
              <a href="list_customer_booking"
                class="menu-item flex items-center gap-3 <?php if ($current == 'view_commission') echo 'active'; ?>">

                <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path d="M4 12h16" />
                </svg>

                <span class="sidebar-text">View Customer Bookings</span>
              </a>
            </li>

            <!-- View delete leader -->
            <li>
              <a href="list_customer_booking_deleted"
                class="menu-item flex items-center gap-3 <?php if ($current == 'list_customer_booking_deleted') echo 'active'; ?>">

                <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path d="M4 12h16" />
                </svg>

                <span class="sidebar-text">View Customer deleted Bookings</span>
              </a>
            </li>

          </ul>
        </li>


        <!-- Commission -->
        <li>
          <a href="javascript:void(0)"
            onclick="toggleMenu('booking', this)"
            class="menu-item flex justify-between items-center">

            <span class="flex items-center gap-3">
              <svg class="w-6 h-6 text-yellow-500" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                  d="M17 20v-2a4 4 0 0 0-3-3.87M7 20v-2a4 4 0 0 1 3-3.87m0 0A4 4 0 1 0 7 6a4 4 0 0 0 3 8zm6-8a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
              </svg>
              <span class="sidebar-text">Booking Payments</span>
            </span>

            <svg class="menu-arrow w-4 h-4 transition-transform transform" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
            </svg>
          </a>

          <ul id="booking" class="hidden">

            <!-- Add Booking -->
            <li>
              <a href="booking_payments"
                class="menu-item flex items-center gap-3 <?php if ($current == 'booking_payments') echo 'active'; ?>">

                <svg class="w-4 h-4 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path d="M4 12h16" />
                </svg>

                <span class="sidebar-text">Add Booking Payment</span>
              </a>
            </li>

            <!-- View Booking Payment -->
            <li>
              <a href="list_booking_payments"
                class="menu-item flex items-center gap-3 <?php if ($current == 'list_booking_payments') echo 'active'; ?>">

                <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path d="M4 12h16" />
                </svg>

                <span class="sidebar-text">View Booking Payments</span>
              </a>
            </li>

          </ul>
        </li>

        <a href="sites_commission"
          class="menu-item <?php if ($current == 'sites_commission') echo 'active'; ?>">
          <svg class="w-6 h-6 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M3 3v18h18M7 13l3-3 4 4 5-5" />
          </svg>
          <span class="sidebar-text">Sites & Commission</span>
        </a>
        </li>


        <!-- reference -->
        <li>
          <a href="javascript:void(0)"
            onclick="toggleMenu('reference', this)"
            class="menu-item flex justify-between items-center">

            <span class="flex items-center gap-3">
              <svg class="w-6 h-6 text-yellow-500" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                  d="M16 14c3 0 5 2 5 4v1H3v-1c0-2 2-4 5-4" />
                <circle cx="9" cy="8" r="3" />
                <circle cx="17" cy="9" r="2" />
              </svg>
              <span class="sidebar-text">Reference</span>
            </span>

            <svg class="menu-arrow w-4 h-4 transition-transform transform" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
            </svg>
          </a>

          <ul id="reference" class="hidden">

            <li>
              <a href="set_reference_amt"
                class="menu-item flex items-center gap-3 <?php if ($current == 'set_reference_amt') echo 'active'; ?>">

                <svg class="w-4 h-4 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path d="M4 12h16" />
                </svg>

                <span class="sidebar-text">Set Reference Amount</span>
              </a>
            </li>

            <li>
              <a href="list_reference_amt"
                class="menu-item flex items-center gap-3 <?php if ($current == 'list_reference') echo 'active'; ?>">

                <svg class="w-4 h-4 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path d="M4 12h16" />
                </svg>

                <span class="sidebar-text">List Reference Amount</span>
              </a>
            </li>

            <!-- Sites & Commission -->
            <li>
              <a href="list_reference"
                class="menu-item flex items-center gap-3 <?php if ($current == 'list_reference') echo 'active'; ?>">

                <svg class="w-4 h-4 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path d="M4 12h16" />
                </svg>

                <span class="sidebar-text">References List</span>
              </a>
            </li>
          </ul>
        </li>

        <!-- visit customer -->

        <li>
          <a href="javascript:void(0)"
            onclick="toggleMenu('visit', this)"
            class="menu-item flex justify-between items-center">

            <span class="flex items-center gap-3">
              <svg class="w-6 h-6 text-yellow-500" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                  d="M12 14c4 0 7 2 7 4v1H5v-1c0-2 3-4 7-4z" />
                <circle cx="12" cy="8" r="4" stroke-linecap="round" stroke-linejoin="round" />
              </svg>
              <span class="sidebar-text">Customer Visit</span>
            </span>

            <svg class="menu-arrow w-4 h-4 transition-transform transform" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
            </svg>
          </a>

          <ul id="visit" class="hidden">

            <!-- Add customer -->
            <li>
              <a href="add_customer_visit"
                class="menu-item flex items-center gap-3 <?php if ($current == 'add_customer_visit') echo 'active'; ?>">

                <svg class="w-4 h-4 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path d="M4 12h16" />
                </svg>

                <span class="sidebar-text">Register Customer Visit</span>
              </a>
            </li>

            <!-- View leader -->
            <li>
              <a href="list_customer_visit"
                class="menu-item flex items-center gap-3 <?php if ($current == 'list_customers_visit') echo 'active'; ?>">

                <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path d="M4 12h16" />
                </svg>

                <span class="sidebar-text">View Customers Visit</span>
              </a>
            </li>

          </ul>
        </li>



      </ul>

    </nav>


  </div>

  <!-- Bottom Logout -->
  <div class="p-3 border-t border-gray-700">
    <a onclick="logout()" style="cursor: pointer;"
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

  if (!user || user.role !== "adviser") {
    alert("Unauthorized access");
    window.location.href = "../login.php";
  }
</script>