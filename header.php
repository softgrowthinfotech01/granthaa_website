<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Header</title>
    <script src="https://cdn.tailwindcss.com"></script>
  </head>

 <body class="bg-black overflow-x-hidden">
  <!-- MENU TOGGLE -->
  <input type="checkbox" id="menuToggle" class="peer hidden" />

  <!-- HEADER -->
  <header
  class="w-full sticky top-0
         bg-gradient-to-tr from-cyan-950 via-gray-900 to-slate-950
         h-16 md:h-24 flex items-center justify-between
         px-4 md:px-10 border-b border-gray-800 z-50"
>

    <!-- MENU ICON -->
    <label
      for="menuToggle"
      class="flex items-center gap-3 text-[#73bc01] cursor-pointer"
    >
      <span class="text-2xl font-bold">☰</span>
      <span class="hidden sm:block text-lg font-bold">Menu</span>
    </label>

    <!-- LOGO -->
    <div class="flex flex-col items-center justify-center">
      <img
        src="images/granthalogo.webp"
        alt="Grantha Logo"
        class="h-6 sm:h-8 md:h-10 lg:h-12 xl:h-14 w-auto object-contain"
      />
    </div>

    <!-- CTA -->
    <a
      href="#"
      class="hidden md:block border border-[#73bc01] text-[#73bc01]
             px-5 py-2 rounded
             hover:bg-[#73bc01] hover:text-black transition"
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
