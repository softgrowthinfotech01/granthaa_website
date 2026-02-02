<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Header</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
 
    </style>
  </head>

 <body class="bg-transparent overflow-x-hidden">
  <!-- MENU TOGGLE -->
  <input type="checkbox" id="menuToggle" class="peer hidden" />

  <!-- HEADER -->
  <header
  class="w-full sticky top-0
        h-16 md:h-24 flex items-center justify-between
         px-4 md:px-6 border-b border-gray-800 z-50"
>

    <!-- MENU ICON -->
    <label
      for="menuToggle"
      class="flex items-center gap-3 text-[#73bc01] cursor-pointer"
    >
      <span class="text-xl mb-1 font-bold">☰</span>
      <span class="hidden sm:block text-lg font-bold">Menu</span>
    </label>

    <!-- LOGO -->
  <div class="flex items-center mt-10 justify-center  bg-transparent rounded-2xl">
  <div class="relative p-2 bg-white rounded-xl">

    <!-- SVG BORDER -->
    <svg
      class="absolute inset-0 w-full h-full pointer-events-none"
      viewBox="0 0 400 250"
      preserveAspectRatio="none"
    >
      <defs>
        <!-- Glow -->
        <filter id="penGlow">
          <feGaussianBlur stdDeviation="15" result="blur" />
          <feMerge>
            <feMergeNode in="blur" />
            <feMergeNode in="SourceGraphic" />
          </feMerge>
        </filter>
      </defs>

      <!-- TOP + RIGHT border (moving pen) -->
      <path
        d="M20 15 L380 15 L380 120"
        fill="none"
        stroke="#1e40af"
        stroke-width="5"
        stroke-linecap="round"
        stroke-linejoin="round"
        stroke-dasharray="500"
        stroke-dashoffset="500"
        filter="url(#penGlow)"
      >
        <animate
          attributeName="stroke-dashoffset"
          from="500"
          to="0"
          dur="3.8s"
           begin="1.4s"
          repeatCount="indefinite"
        />
      </path>

      <!-- BOTTOM + LEFT border (moving pen) -->
      <path
        d="M380 235 L20 235 L20 120"
        fill="none"
        stroke="#1e40af"
        stroke-width="5"
        stroke-linecap="round"
        stroke-linejoin="round"
        stroke-dasharray="500"
        stroke-dashoffset="500"
        filter="url(#penGlow)"
      >
        <animate
          attributeName="stroke-dashoffset"
          from="500"
          to="0"
          dur="3.8s"
          begin="1.4s"
          repeatCount="indefinite"
        />
      </path>
    </svg>

    <!-- LOGO -->
    <img
      src="images/granthalogo.webp"
      alt="Logo"
      class="w-[150px] h-[100px]"
    />
  </div>
</div>

    <!-- CTA -->
    <a
      href="#"
      class="hidden font-semibold md:block border border-[#73bc01] text-[#73bc01]
             px-5 py-2 rounded
             hover:bg-[#73bc01] hover:text-black hover:scale-110 transition"
    >
      Download Brochure
    </a>
  </header>

  <!-- OVERLAY -->
  <label
    for="menuToggle"
    class="fixed inset-0 bg-black/60
           opacity-0 pointer-events-none
           peer-checked:opacity-100 peer-checked:pointer-events-auto
           transition-opacity duration-300 z-40"
  ></label>

  <!-- SIDE MENU -->
  <div
    class="fixed top-0 left-0 h-full w-full sm:w-80 bg-black text-[#73bc01]
           transform -translate-x-full peer-checked:translate-x-0
           transition-transform duration-300 z-50
           border-r border-gray-800"
  >
    <!-- CLOSE BUTTON (FUNCTIONAL) -->
    <label for="menuToggle" class="absolute top-4 right-4 cursor-pointer">
      <span
        class="w-10 h-10 flex items-center justify-center
               text-[#73bc01] rounded-full
               hover:bg-[#73bc01] hover:text-black transition"
        aria-label="Close"
      >
        ✕
      </span>
    </label>

    <!-- MENU LINKS -->
    <div class="p-8 space-y-8 mt-16">
      <a href="#" class="block text-xl hover:opacity-90">Home</a>
      <a href="#" class="block text-xl hover:opacity-90">About</a>
      <a href="#" class="block text-xl hover:opacity-90">Projects</a>
      <a href="#" class="block text-xl hover:opacity-90">Contact</a>
    </div>
  </div>
</body>

</html>
