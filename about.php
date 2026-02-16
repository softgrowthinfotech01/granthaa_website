<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>grantha developers</title>
</head>
<style>
   .writing-mode-vertical {
      writing-mode: vertical-rl;
      text-orientation: mixed;
    }

</style>
<body>

  <?php include "header.php"; ?> 

<section class="px-4 mt-[50px] sm:px-6 lg:px-8 py-16 lg:py-24">
  <div class="max-w-7xl mx-auto">

    <!-- TITLE -->
    <h1 class="text-2xl sm:text-3xl font-bold text-blue-900
               border-l-4 border-green-500 pl-4 mb-10">
      ABOUT US :
    </h1>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">

      <!-- IMAGE -->
      <div class="rounded-2xl transition-transform duration-500 ease-in-out
                  hover:scale-105 overflow-hidden shadow-2xl">
        <img
          src="images/plot booking.jpeg"
          alt="Premium Plot Development"
          class="w-full h-64 sm:h-80 md:h-[420px] object-cover"
        />
      </div>

      <!-- CONTENT -->
      <div class="space-y-6 ">
        <!-- <h2 class="text-2xl md:text-3xl font-bold text-black">
          About Us
        </h2> -->

        <p class="sm:text-lg md:text-lg text-gray-700 leading-relaxed">
          We specialize in premium plot developments designed for those who value
          location, long-term growth, and lifestyle excellence. Every project is
          carefully planned to ensure legal clarity, superior infrastructure,
          and future-ready living.
        </p>

        
        <p class="sm:text-lg md:text-lg text-gray-700 leading-relaxed">
          Each of our communities is thoughtfully crafted to enhance the quality
           of life, blending convenience with tranquility. From landscaped parks and 
           recreational areas to essential amenities within easy reach, we ensure a 
           harmonious balance between urban comforts and natural serenity. By prioritizing 
           sustainability, safety, and aesthetic appeal, our developments provide not just 
           a plot, but a lifestyle that grows in value and prestige over time.</p>
      </div>

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
    class="border-2 border-blue-900 text-[#73bc01]
           bg-[#73bc01]/40 backdrop-blur
           px-3 py-5 rounded-l-md
           tracking-widest font-semibold text-sm
           [writing-mode:vertical-rl]
           [text-orientation:mixed]
           hover:bg-[#73bc01] hover:text-black transition">
    Download Brochure
  </a>
</div>

<!-- WHATSAPP FLOAT -->
<a href="https://wa.me/919999999999"
   target="_blank"
   class="fixed bottom-5 right-5 z-50
          bg-green-500 p-4 rounded-full shadow-lg
          hover:scale-110 hover:shadow-2xl
          transition-all duration-300">

  <svg xmlns="http://www.w3.org/2000/svg"
       class="w-7 h-7 fill-white"
       viewBox="0 0 32 32">
    <path d="M19.11 17.2c-.28-.14-1.65-.81-1.91-.9-.26-.09-.45-.14-.64.14-.19.28-.73.9-.9 1.08-.17.19-.34.21-.62.07-.28-.14-1.19-.44-2.27-1.4-.84-.75-1.4-1.67-1.57-1.95-.17-.28-.02-.43.13-.57.13-.13.28-.34.42-.51.14-.17.19-.28.28-.47.09-.19.05-.35-.02-.49-.07-.14-.64-1.54-.88-2.11-.23-.56-.46-.49-.64-.5-.17-.01-.35-.01-.54-.01-.19 0-.49.07-.75.35-.26.28-.98.96-.98 2.35s1.01 2.73 1.15 2.92c.14.19 1.99 3.04 4.82 4.26.67.29 1.2.46 1.61.59.68.22 1.29.19 1.78.11.54-.08 1.65-.67 1.88-1.32.23-.65.23-1.2.16-1.32-.07-.12-.26-.19-.54-.33z"/>
    <path d="M16 2.67C8.64 2.67 2.67 8.64 2.67 16c0 2.61.77 5.05 2.1 7.1L2.67 29.33l6.39-2.07c1.98 1.08 4.25 1.74 6.94 1.74 7.36 0 13.33-5.97 13.33-13.33S23.36 2.67 16 2.67z"/>
  </svg>
</a>

<!-- SCROLL SCRIPT -->
<script>
  const brochureBtn = document.getElementById("brochureBtn");

  window.addEventListener("scroll", () => {
    brochureBtn.classList.toggle(
      "opacity-0",
      window.scrollY < 200
    );
    brochureBtn.classList.toggle(
      "pointer-events-none",
      window.scrollY < 200
    );
  });
</script>
</body>
</html>
