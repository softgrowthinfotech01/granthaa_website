<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
   .writing-mode-vertical {
      writing-mode: vertical-rl;
      text-orientation: mixed;
    }

</style>
<body>
       <?php include "header.php"; ?> 
      
<section class="py-16 mt-[50px] lg:py-24">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

    <!-- PAGE TITLE -->
    <h1 class="text-2xl sm:text-3xl font-bold text-blue-900
               border-l-4 border-green-500 pl-4 mb-12">
      LAYOUT :
    </h1>

    <div class="space-y-20">

      <!-- SECTION 1 -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-10 items-center">
        <div class="rounded-2xl transition-transform duration-500 ease-in-out
                    hover:scale-105 overflow-hidden shadow-lg">
          <img
            src="images/Shobha residency plan.jpeg"
            alt="Project Layout Plan"
            class="w-full h-64 sm:h-80 md:h-[420px] object-contain bg-white"
          />
        </div>

        <div>
          <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-4">
            Elevated Living at Shobhaa Residency
          </h2>
          <p class="text-gray-700 leading-relaxed mb-4 text-base sm:text-lg md:text-lg">
            Shobhaa Residency is a premium residential plot development created for those
            who value location, quality planning, and smart investment opportunities. 
            Strategically located with excellent road access, the project offers NA-approved
            plots with bank finance availability and easy EMI options. Surrounded by open 
            green spaces and supported by modern infrastructure, Shobhaa Residency promises 
            peaceful living with strong appreciation potential—making it the perfect choice 
            for building your dream home or securing a high-growth property investment.
          </p>

          
        </div>
      </div>

      <!-- SECTION 2 -->
      

    </div>
  </div>
</section>

<?php include "footer.php"; ?>

<!-- SIDE BROCHURE BUTTON -->
<div
  id="brochureBtn"
  class="fixed right-0 top-1/2 -translate-y-1/2 z-30
         opacity-0 pointer-events-none
         transition-opacity duration-300">

  <a
    href="#"
    class="border border-[#73bc01] text-[#73bc01]
           bg-white/80 backdrop-blur
           px-3 py-5 rounded-l-md
           tracking-widest font-semibold text-sm
           [writing-mode:vertical-rl]
           [text-orientation:mixed]
           hover:bg-[#73bc01] hover:text-black transition">
    Download Brochure
  </a>
</div>

<!-- WHATSAPP BUTTON -->
<a href="https://wa.me/919999999999"
   target="_blank"
   class="fixed bottom-5 right-5 z-50
          bg-green-500 p-4 rounded-full shadow-lg
          hover:scale-110 hover:shadow-2xl
          transition-all duration-300">

  <svg xmlns="http://www.w3.org/2000/svg"
       class="w-7 h-7 fill-white"
       viewBox="0 0 32 32">
    <path d="M19.11 17.2c-.28-.14-1.65-.81-1.91-.9-.26-.09-.45-.14-.64.14-.19.28-.73.9-.9 1.08-.17.19-.34.21-.62.07-.28-.14-1.19-.44-2.27-1.4-.84-.75-1.4-1.67-1.57-1.95-.17-.28-.02-.43.13-.57z"/>
    <path d="M16 2.67C8.64 2.67 2.67 8.64 2.67 16c0 7.36 5.97 13.33 13.33 13.33S29.33 23.36 29.33 16 23.36 2.67 16 2.67z"/>
  </svg>
</a>

<!-- SCROLL SCRIPT -->
<script>
  const brochureBtn = document.getElementById("brochureBtn");

  window.addEventListener("scroll", () => {
    brochureBtn.classList.toggle("opacity-0", window.scrollY < 200);
    brochureBtn.classList.toggle("pointer-events-none", window.scrollY < 200);
  });
</script>
</body>
</html>