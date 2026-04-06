<?php 
$current = basename($_SERVER['PHP_SELF'], ".php");
?>

<aside id="sidebar"
  class="fixed md:static z-30 top-0 left-0 h-full w-55 md:w-64 bg-gray-800 text-white
  transition-all duration-300 ease-in-out -translate-x-full md:translate-x-0
  flex flex-col justify-between shrink-0 overflow-y-auto scroll-smooth">
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
            class="menu-item <?php if ($current == 'dashboard') echo 'parent-active'; ?>">

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
class="menu-item flex justify-between items-center 
<?php if (in_array($current, ['add_advisor','list_advisor'])) echo 'parent-active'; ?>">

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
                class="menu-item flex items-center gap-3 <?php if ($current == 'add_advisor') echo 'active'; ?>">

                <svg class="w-4 h-4 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path d="M4 12h16" />
                </svg>

                <span class="sidebar-text">Add Advisor</span>
              </a>
            </li>

            <!-- View leader -->
            <li>
              <a href="list_advisor"
                class="menu-item flex items-center gap-3 <?php if ($current == 'list_advisor') echo 'active'; ?>">

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
         class="menu-item flex justify-between items-center 
<?php if (in_array($current, ['set_commission','list_commission'])) echo 'parent-active'; ?>">
            <span class="flex items-center gap-3">
              <svg class="w-6 h-6 text-yellow-500" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                  d="M17 20v-2a4 4 0 0 0-3-3.87M7 20v-2a4 4 0 0 1 3-3.87m0 0A4 4 0 1 0 7 6a4 4 0 0 0 3 8zm6-8a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
              </svg>
              <span class="sidebar-text"> Set Commission</span>
            </span>

            <svg class="menu-arrow w-4 h-4 transition-transform transform" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
            </svg>
          </a>

          <ul id="commission" class="hidden">

            <!-- Add Commission -->
            <li>
              <a href="set_commission"
                class="menu-item flex items-center gap-3 <?php if ($current == 'set_commission') echo 'active'; ?>">

                <svg class="w-4 h-4 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path d="M4 12h16" />
                </svg>

                <span class="sidebar-text">Add Commission</span>
              </a>
            </li>

            <!-- View Commission -->
            <li>
              <a href="list_commission"
                class="menu-item flex items-center gap-3 <?php if ($current == 'list_commission') echo 'active'; ?>">

                <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path d="M4 12h16" />
                </svg>

                <span class="sidebar-text">View Set Commission</span>
              </a>
            </li>

          </ul>
        </li>

        <!-- Booking -->
        <li>
          <a href="javascript:void(0)"
onclick="toggleMenu('Booking', this)"
        class="menu-item flex justify-between items-center 
<?php if (in_array($current, [
'customer_booking',
'list_customer_booking',
'list_customer_booking_deleted'
])) echo 'parent-active'; ?>">
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
                class="menu-item flex items-center gap-3 <?php if ($current == 'customer_booking') echo 'active'; ?>">

                <svg class="w-4 h-4 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path d="M4 12h16" />
                </svg>

                <span class="sidebar-text">Add Booking</span>
              </a>
            </li>

            <!-- View Booking -->
            <li>
              <a href="list_customer_booking"
                class="menu-item flex items-center gap-3 <?php if ($current == 'list_customer_booking') echo 'active'; ?>">

                <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path d="M4 12h16" />
                </svg>

                <span class="sidebar-text">View Booking</span>
              </a>
            </li>

            <!-- View delete Booking -->
            <li>
              <a href="list_customer_booking_deleted"
                class="menu-item flex items-center gap-3 <?php if ($current == 'list_customer_booking_deleted') echo 'active'; ?>">

                <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path d="M4 12h16" />
                </svg>

                <span class="sidebar-text">View Canceled Booking</span>
              </a>
            </li>

          </ul>
        </li>

        <!-- Commission Payment -->
        <li>
          <a href="javascript:void(0)"
            onclick="toggleMenu('compayment', this)"
            class="menu-item flex justify-between items-center
            <?php if (in_array($current, ['payment','list_payment'])) echo 'parent-active'; ?>">

            <span class="flex items-center gap-3">
              <svg class="w-6 h-6 text-yellow-500" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                <rect x="3" y="4" width="18" height="16" rx="2" stroke-linecap="round" stroke-linejoin="round" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M7 15v-3" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v-6" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M17 15v-4" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 19h14" />
              </svg>
              <span class="sidebar-text">Advisor Commission Payment</span>
            </span>

            <svg class="menu-arrow w-4 h-4 transition-transform transform" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
            </svg>
          </a>

          <ul id="compayment" class="hidden">

            <!-- Add Payment -->
            <li>
              <a href="payment"
                class="menu-item flex items-center gap-3 <?php if ($current == 'payment') echo 'active'; ?>">

                <svg class="w-4 h-4 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path d="M4 12h16" />
                </svg>

                <span class="sidebar-text">Add Payment</span>
              </a>
            </li>

            <!-- View Payments -->
            <li>
              <a href="list_payment"
                class="menu-item flex items-center gap-3 <?php if ($current == 'list_payment') echo 'active'; ?>">

                <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path d="M4 12h16" />
                </svg>

                <span class="sidebar-text">View Payment</span>
              </a>
            </li>

          </ul>
        </li>

        <!-- Booking Payment -->
        <li>
          <a href="javascript:void(0)"
            onclick="toggleMenu('payment', this)"
            class="menu-item flex justify-between items-center
            <?php if (in_array($current, ['booking_payment','list_booking_payment'])) echo 'parent-active'; ?>">
            <span class="flex items-center gap-3">
              <svg class="w-6 h-6 text-yellow-500" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                <rect x="3" y="5" width="18" height="14" rx="2" stroke-linecap="round" stroke-linejoin="round" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M7 15h3" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M14 15h3" />
              </svg>
              <span class="sidebar-text">Plot Booking Payment</span>
            </span>

            <svg class="menu-arrow w-4 h-4 transition-transform transform" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
            </svg>
          </a>

          <ul id="payment" class="hidden">

            <!-- Add Payment -->
            <li>
              <a href="booking_payment"
                class="menu-item flex items-center gap-3 <?php if ($current == 'booking_payment') echo 'active'; ?>">

                <svg class="w-4 h-4 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path d="M4 12h16" />
                </svg>

                <span class="sidebar-text">Add Payment</span>
              </a>
            </li>

            <!-- View Payments -->
            <li>
              <a href="list_booking_payment"
                class="menu-item flex items-center gap-3 <?php if ($current == 'list_booking_payment') echo 'active'; ?>">

                <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path d="M4 12h16" />
                </svg>

                <span class="sidebar-text">View Payment</span>
              </a>
            </li>

          </ul>
        </li>

        <!-- Permormance -->
        <li>
          <a href="javascript:void(0)"
            onclick="toggleMenu('performance', this)"
            class="menu-item flex justify-between items-center
               <?php if (in_array($current, ['my_performance','team_performance','sites_commission'])) echo 'parent-active'; ?>">

            <span class="flex items-center gap-3">
              <svg class="w-6 h-6 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M3 3v18h18M7 13l3-3 4 4 5-5" />
          </svg>
              <span class="sidebar-text">Performance & Commission</span>
            </span>

            <svg class="menu-arrow w-4 h-4 transition-transform transform" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
            </svg>
          </a>

          <ul id="performance" class="hidden">
            <li>
              <a href="my_performance"
                class="menu-item flex items-center gap-3 <?php if ($current == 'my_performance') echo 'active'; ?>">

                <svg class="w-4 h-4 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path d="M4 12h16" />
                </svg>

                <span class="sidebar-text">My Commission Record</span>
              </a>
            </li>
            <li>
              <a href="team_performance"
                class="menu-item flex items-center gap-3 <?php if ($current == 'team_performance') echo 'active'; ?>">

                <svg class="w-4 h-4 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path d="M4 12h16" />
                </svg>

                <span class="sidebar-text">Team Performance</span> 
              </a>
            </li>
            <li>
              <a href="sites_commission"
                class="menu-item flex items-center gap-3 <?php if ($current == 'sites_commission') echo 'active'; ?>">

                <svg class="w-4 h-4 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path d="M4 12h16" />
                </svg>

                <span class="sidebar-text">My Sites & Commission</span> 
              </a>
            </li>


          </ul>
        </li>

        <!-- <a href="team_performance"
          class="menu-item <?php if ($current == 'team_performance') echo 'active'; ?>">
          <svg class="w-6 h-6 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M3 3v18h18M7 13l3-3 4 4 5-5" />
          </svg>
          <span class="sidebar-text">Team Performance</span>
        </a> -->

        <!-- Transaction Summary -->
        <li>
<a href="javascript:void(0)"
onclick="toggleMenu('Transactionsum', this)"
class="menu-item flex justify-between items-center 
<?php if (in_array($current, ['list_payment_summary', 'advisor_payment_summary'])) echo 'parent-active'; ?>">
            <span class="flex items-center gap-3">
              <svg class="w-6 h-6 text-yellow-500" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                <rect x="3" y="4" width="18" height="16" rx="2" ry="2" stroke-linecap="round" stroke-linejoin="round" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 9h18" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M7 16v-3" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 16v-5" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M17 16v-2" />
              </svg>
              <span class="sidebar-text">Commission Transaction Summary</span>
            </span>

            <svg class="menu-arrow w-4 h-4 transition-transform transform" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
            </svg>
          </a>

          <ul id="Transactionsum" class="hidden">
            <li>
              <a href="list_payment_summary"
                class="menu-item flex items-center gap-3 <?php if ($current == 'list_payment_summary') echo 'active'; ?>">

                <svg class="w-4 h-4 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path d="M4 12h16" />
                </svg>

                <span class="sidebar-text">All Commission Transactions</span>
              </a>
            </li>
            <li>
              <a href="advisor_payment_summary"
                class="menu-item flex items-center gap-3 <?php if ($current == 'advisor_payment_summary') echo 'active'; ?>">

                <svg class="w-4 h-4 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path d="M4 12h16" />
                </svg>

                <span class="sidebar-text">Advisor's Commission Transactions</span>
              </a>
            </li>
          </ul>
        </li>

        <!-- Reference -->
        <li>
      <a href="javascript:void(0)"
onclick="toggleMenu('Bookingpay', this)"
class="menu-item flex justify-between items-center 
<?php if (in_array($current, ['set_reference_amt', 'list_reference_amt', 'list_reference'])) echo 'parent-active'; ?>">
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

          <ul id="Bookingpay" class="hidden">

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
                class="menu-item flex items-center gap-3 <?php if ($current == 'list_reference_amt') echo 'active'; ?>">

                <svg class="w-4 h-4 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path d="M4 12h16" />
                </svg>

                <span class="sidebar-text">View Reference Amount</span>
              </a>
            </li>

            <li>
              <a href="list_reference"
                class="menu-item flex items-center gap-3 <?php if ($current == 'list_reference') echo 'active'; ?>">

                <svg class="w-4 h-4 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path d="M4 12h16" />
                </svg>

                <span class="sidebar-text">List Reference</span>
              </a>
            </li>
          </ul>
        </li>

        <!-- visit customer -->

        <li>
          <a href="javascript:void(0)"
onclick="toggleMenu('visit', this)"
        class="menu-item flex justify-between items-center 
<?php if (in_array($current, [
'add_customer_visit',
'list_customer_visit'
])) echo 'parent-active'; ?>">
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

                <span class="sidebar-text">Register Customer Visits</span>
              </a>
            </li>

            <!-- View leader -->
            <li>
              <a href="list_customer_visit"
                class="menu-item flex items-center gap-3 <?php if ($current == 'list_customer_visit') echo 'active'; ?>">

                <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path d="M4 12h16" />
                </svg>

                <span class="sidebar-text">View Customers Visits</span>
              </a>
            </li>

          </ul>
        </li>



      </ul>

    </nav>
  </div>

  <!-- Bottom Logout -->
  <div class="mt-4 p-3 border-t border-gray-700">
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
  function toggleMenu(menuId, el) {

    const allMenus = document.querySelectorAll("aside ul[id]");
    const allArrows = document.querySelectorAll(".menu-arrow");

    // 🔴 Close all menus
    allMenus.forEach(menu => {
        if (menu.id !== menuId) {
            menu.classList.add("hidden");
        }
    });

    // 🔴 Reset all arrows
    allArrows.forEach(a => a.classList.remove("rotate-90"));

    // ✅ Open clicked menu
    const menu = document.getElementById(menuId);
    const arrow = el.querySelector(".menu-arrow");

    menu.classList.toggle("hidden");

    if (arrow) {
        arrow.classList.toggle("rotate-90");
    }
}

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

  const user = JSON.parse(localStorage.getItem("auth_user"));

  if (!user || user.role !== "leader") {
    alert("Unauthorized access");
    window.location.href = "../login.php";
  }
</script>