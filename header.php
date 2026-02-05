<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <title>Header</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    .source-serif {
      font-family: "Source Serif 4", serif;
      font-optical-sizing: auto;
      font-weight: weight;
      font-style: normal;
    }

   
  </style>
  <!-- GOOGLE FONT -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Source+Serif+4:wght@200..900&display=swap" rel="stylesheet">
</head>

<body class="overflow-x-hidden">

  <!-- MENU TOGGLE -->
  <input type="checkbox" id="menuToggle" class="peer hidden" />

  <!-- HEADER -->
  <header class="fixed top-0 w-full z-50 bg-transparent">
    <div class="flex items-center justify-between h-16 md:h-24 px-4 md:px-8">

      <!-- MENU BUTTON -->
      <label
  for="menuToggle"
  class="flex items-center gap-2 cursor-pointer
         bg-white border border-[#73bc01] rounded-md p-1
         transition-all duration-300 ease-in-out
         hover:bg-[#73bc01] hover:scale-105 hover:text-black">

  <div class="rounded-md p-[2px] gap-1">
    <span
      class="text-black text-xl font-bold
             transition-colors duration-300">
      ☰
    </span>
  </div>

  <span
    class="source-serif mt-1 sm:block text-lg  p-1
           text-black transition-colors duration-300
           hover:text-black hidden md:block">
    Menu
  </span>
</label>

      <!-- LOGO -->
      <div class="relative bg-white rounded-xl p-2 mt-4 md:p-3 logo-glow ml-[90px]">
        <svg class="absolute inset-0 w-full h-full pointer-events-none" viewBox="0 0 400 250" preserveAspectRatio="none">
          <defs>
            <filter id="glow">
              <feGaussianBlur stdDeviation="10" result="blur" />
              <feMerge>
                <feMergeNode in="blur" />
                <feMergeNode in="SourceGraphic" />
              </feMerge>
            </filter>
          </defs>

          <path
            d="M40 20 H360 A20 20 0 0 1 380 40 V110"
            fill="none"
            stroke="#71BE00"
            stroke-width="8"
            stroke-linecap="round"
            stroke-dasharray="520"
            stroke-dashoffset="520"
            filter="url(#)">
            <animate attributeName="stroke-dashoffset" from="520" to="0" dur="3s" repeatCount="indefinite" />
          </path>

          <path
            d="M360 230 H40 A20 20 0 0 1 20 210 V120"
            fill="none"
            stroke="#1e40af"
            stroke-width="8"
            stroke-linecap="round"
            stroke-dasharray="520"
            stroke-dashoffset="520"
            filter="url(#)">
            <animate attributeName="stroke-dashoffset" from="520" to="0" dur="3s" repeatCount="indefinite" />
          </path>
        </svg>

        <div class="relative inline-block">
          <img
            src="images/granthalogo.webp"
            alt="Logo"
            class="relative w-28 h-auto md:w-36 " />
        </div>
      </div>

      <!-- CTA -->
      <a
        href="#"
        class="source-serif hidden md:block bg-white font-[Source_Serif_4] 
             border border-[#73bc01] text-black
             px-4 py-2 rounded-md text-lg
             hover:bg-[#73bc01] hover:text-black
             transition-transform hover:scale-105">
        Download Brochure
      </a>

    </div>
  </header>

  <!-- OVERLAY -->
  <label
    for="menuToggle"
    class="fixed inset-0 bg-black/30 opacity-0 peer-checked:opacity-100
         pointer-events-none peer-checked:pointer-events-auto
         transition z-40"></label>

  <!-- SIDE MENU -->
  <aside
    class="fixed top-0 left-0 h-full w-72 bg-white z-50
         transform -translate-x-full peer-checked:translate-x-0
         transition-transform duration-300">
    <!-- CLOSE -->
    <label
  for="menuToggle"
  class="absolute top-4 right-4 bg-white cursor-pointer
         border border-[#73bc01] rounded-md
         transform transition-all duration-300 ease-in-out
         hover:bg-[#73bc01] hover:scale-110">

  <span
    class="text-[#73bc01] text-xl px-3 py-1 font-bold
           transition-colors duration-300
           hover:text-black">
    ✕
  </span>
</label>

    <!-- LINKS -->
    <nav class="mt-20 px-6 space-y-6 font-[Source_Serif_4] font-semibold">
      <a href="home.php" class="block text-xl hover:text-[#73bc01]">Home</a>
      <a href="about.php" class="block text-xl hover:text-[#73bc01]">About</a>
      <div class="relative">

  <!-- Button -->
  <button onclick="toggleDropdown()"
    class="flex items-center gap-5 text-xl hover:text-[#73bc01] focus:outline-none">

    Projects

    <!-- Arrow -->
    <svg id="arrow" xmlns="http://www.w3.org/2000/svg"
      class="w-4 h-4 transition-transform duration-300"
      fill="none" viewBox="0 0 24 24" stroke="currentColor">

      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
        d="M19 9l-7 7-7-7" />
    </svg>

  </button>

  <!-- Dropdown -->
  <div id="dropdown"
    class="hidden absolute left-0 mt-2 bg-white shadow-lg rounded-xl w-48 z-50">

    <a href="infinity_park" class="block px-4 py-2 hover:bg-gray-100 rounded-t-xl">
      Infinity Park 
    </a>

    <a href="shobhaa_resi.php" class="block px-4 py-2 hover:bg-gray-100">
      Shobhaa Residency
    </a>

    <a href="dsk.php" class="block px-4 py-2 hover:bg-gray-100 rounded-b-xl">
      D.S.K 
    </a>

  </div>
</div>



      <a href="contact.php" class="block text-xl hover:text-[#73bc01]">Contact</a>
      <!-- <a href="facilities.php" class="block text-xl hover:text-[#73bc01]">
        Facilities</a> -->
<!--  -->
    </nav>
  </aside>
<!-- Script -->
<script>
function toggleDropdown() {
  const dropdown = document.getElementById("dropdown");
  const arrow = document.getElementById("arrow");

  dropdown.classList.toggle("hidden");
  arrow.classList.toggle("rotate-180");
}
</script>
</body>

</html>