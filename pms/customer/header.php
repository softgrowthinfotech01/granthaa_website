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

/* Menu items */
.menu-item{
  display:flex;
  align-items:center;
  gap:12px;
  padding:12px;
  border-radius:12px;
  transition:all .3s ease;
}
.menu-item:hover{
  background:rgb(17 24 39);
  color:white;
}
.menu-item.active{
  background:rgb(3 7 18);;
  color:white;
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
<div id="overlay"
     onclick="toggleMobileSidebar()"
     class="fixed inset-0 bg-black/50 hidden z-20 transition-opacity duration-300">
</div>

<div class="flex h-screen overflow-hidden">

<?php include 'sidebar.php'; ?>

<div class="flex-1 flex flex-col">

<header class="relative bg-gray-200 shadow px-6 py-4 flex justify-between items-center">

  <!-- LEFT SIDE -->
  <div class="flex items-center gap-4">
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
 <img src="../images/logo_icon.png" 
       alt="Granthaa Land Developer Pvt Ltd"
       class="h-23 w-70 sidebar-logo transition-all duration-300 ">
</div>





  </div>

  <!-- RIGHT SIDE PROFILE -->
 <div class="relative flex items-center gap-3">

  <!-- LEADER badge -->
 <span class="hidden md:block relative px-4 py-1 bg-blue-400  text-black text-xs font-bold tracking-widest
             rounded-md shadow-md">
  CUSTOMER
</span>




  <div id="profileWrapper" class="relative">

  <!-- Profile Button -->
  <button onclick="toggleProfile(event)"
    class="w-14 h-14 rounded-full border-2 border-blue-500
           overflow-hidden shadow-md hover:shadow-lg transition">

    <img src="../images/profile.png"
         class="w-full h-full object-cover"
         alt="Profile">
  </button>

  <!-- Dropdown -->
  <div id="profileMenu"
    class="hidden absolute right-0 mt-3 bg-white rounded-xl shadow-lg w-56 z-50">

    <div class="p-4 border-b text-center">
      <img src="../images/profile.png"
           class="w-16 h-16 mx-auto rounded-full object-cover border-2 border-blue-500 mb-2">

      <p class="font-semibold text-gray-800">CUST001</p>
      <p class="text-lg font-semibold text-gray-500">Pravin Kumar</p>
    </div>

    <a href=""
       class="block px-4 py-2 text-red-500 hover:bg-gray-100 transition text-center">
      Logout
    </a>

  </div>

</div>


</div>


</header>

<main class="p-6 overflow-y-auto transition-all duration-300">
