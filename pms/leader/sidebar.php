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


  <nav class="mt-6 space-y-2 px-2">

    <a href="dashboard"
     class="menu-item <?php if($current=='dashboard') echo 'active'; ?>">
      <!-- home icon -->
      <svg class="w-6 h-6 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path d="M3 12l9-9 9 9M4 10v10h16V10"/>
      </svg>
      <span class="sidebar-text">Dashboard</span>
    </a>

    <a href="add_advisor"
     class="menu-item <?php if($current=='add_advisor') echo 'active'; ?>">
      <svg class="w-6 h-6 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path d="M12 4v16m8-8H4"/>
      </svg>
      <span class="sidebar-text">Add Advisor</span>
    </a>

    <a href="set_commission"
     class="menu-item <?php if($current=='set_commission') echo 'active'; ?>">
     <svg class="w-6 h-6 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M19 5L5 19M7 7h.01M17 17h.01"/>
  </svg>
      <span class="sidebar-text">Set Commission</span>
    </a>

     <a href="customer_booking"
     class="menu-item <?php if($current=='customer_booking') echo 'active'; ?>">
     <svg class="w-6 h-6 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path d="M12 4v16m8-8H4"/>
      </svg>
      <span class="sidebar-text">Book Customer</span>
    </a>

    <a href="list_advisor"
     class="menu-item <?php if($current=='list_advisor') echo 'active'; ?>">
      <svg class="w-6 h-6 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path d="M3 7h18M3 12h18M3 17h18"/>
      </svg>
      <span class="sidebar-text">Advisor List</span>
    </a>

     <a href="list_commission"
     class="menu-item <?php if($current=='list_commission') echo 'active'; ?>">
 <svg class="w-6 h-6 text-yellow-500" fill="currentColor" viewBox="0 0 24 24">
    <rect x="3" y="4" width="18" height="16" rx="2"/>
    <rect x="7" y="8" width="10" height="2"/>
    <rect x="7" y="12" width="10" height="2"/>
    <rect x="7" y="16" width="10" height="2"/>
  </svg>
      <span class="sidebar-text">Commission List</span>
    </a>

       <a href="list_customer_booking"
     class="menu-item <?php if($current=='list_customer_booking') echo 'active'; ?>">
      <svg class="w-6 h-6 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path d="M3 7h18M3 12h18M3 17h18"/>
      </svg>
      <span class="sidebar-text">Customer Booking List</span>
    </a>

    <a href="team_performance"
     class="menu-item <?php if($current=='team_performance') echo 'active'; ?>">
      <svg class="w-6 h-6 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M3 3v18h18M7 13l3-3 4 4 5-5"/>
  </svg>
      <span class="sidebar-text">Team Performance</span>
    </a>

  </nav>
</div>

<!-- Bottom Logout -->
<div class="p-3 border-t border-gray-700">
  <a href="" onclick="logout()"
   class="menu-item text-red-400 hover:bg-red-500 hover:text-white transition">
    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path d="M17 16l4-4m0 0l-4-4m4 4H7"/>
    </svg>
    <span class="sidebar-text">Logout</span>
  </a>
</div>

</aside>

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
