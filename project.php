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
      
<section class="bg-white py-16">
     <h1 class="text-3xl font-bold text-blue-900 border-l-4 border-green-500 pl-4 ml-[150px] mb-5"> PROJECT <span >:</span></h1>
  <div class="max-w-7xl mx-auto px-4 space-y-20">

    <!-- SECTION 1 : Layout Plan -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
      
      <!-- Image -->
      <div>
        <img
          src="images/layout plan img.jpeg"
          alt="Project Layout Plan"
          class="w-full rounded-2xl shadow-lg object-contain"
        />
      </div>

      <!-- Content -->
      <div>
        <h2 class="text-3xl font-bold text-gray-900 mb-4">
          Project Layout Plan
        </h2>
        <p class="text-gray-700 leading-relaxed mb-4">
          The layout plan presents a well-organized and thoughtfully designed
          development that ensures efficient space utilization and smooth
          connectivity throughout the project. Every plot and internal road is
          strategically planned to provide easy access, proper ventilation, and
          a structured living environment.
        </p>
        <p class="text-gray-700 leading-relaxed">
          With clearly defined plots, wide internal roads, and designated open
          spaces, the layout supports comfortable living and long-term value.
          This planned development offers a balanced blend of functionality,
          aesthetics, and future growth potential.
        </p>
      </div>

    </div>

    <!-- SECTION 2 : Infinity Park -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
      
      <!-- Content -->
      <div>
        <h2 class="text-3xl font-bold text-gray-900 mb-4">
          Infinity Park – Grantha
        </h2>
        <p class="text-gray-700 leading-relaxed mb-4">
          Infinity Park is a beautifully designed green space that enhances the
          overall lifestyle experience within the project. It provides a calm
          and refreshing environment where residents can relax, unwind, and
          connect with nature.
        </p>
        <p class="text-gray-700 leading-relaxed">
          Featuring landscaped gardens, walking paths, and open seating areas,
          the park encourages healthy outdoor activities and social interaction.
          Infinity Park serves as the heart of the community, promoting harmony,
          wellness, and a vibrant neighborhood atmosphere.
        </p>
      </div>

      <!-- Image -->
      <div>
        <img
          src="images/infiity park grantha.jpeg"
          alt="Infinity Park Grantha"
          class="w-full rounded-2xl shadow-lg object-contain"
        />
      </div>

    </div>

  </div>
</section>
        <?php include "footer.php"; ?> 
        <div
    id="brochureBtn"
    class="fixed right-0 top-1/2 -translate-y-1/2 z-30
         opacity-0 pointer-events-none
         transition-opacity duration-100
         bg-[#73bc01]/40">
    <a
      href="#"
      class="jersey text-[#73bc01] border border-[#73bc01]
           px-4 py-6 rounded-l-md
           writing-mode-vertical tracking-widest font-semibold">
      Download Brochure
    </a>
  </div>
    <a href="https://wa.me/919999999999"
    target="_blank"
    class="fixed bottom-6 right-6 z-50 bg-green-500 p-4 rounded-full shadow-lg
          hover:scale-110 hover:shadow-2xl
          transition-all duration-300
          animate-bounce-slow">

    <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 fill-white drop-shadow-lg" viewBox="0 0 32 32">
      <path d="M19.11 17.2c-.28-.14-1.65-.81-1.91-.9-.26-.09-.45-.14-.64.14-.19.28-.73.9-.9 1.08-.17.19-.34.21-.62.07-.28-.14-1.19-.44-2.27-1.4-.84-.75-1.4-1.67-1.57-1.95-.17-.28-.02-.43.13-.57.13-.13.28-.34.42-.51.14-.17.19-.28.28-.47.09-.19.05-.35-.02-.49-.07-.14-.64-1.54-.88-2.11-.23-.56-.46-.49-.64-.5-.17-.01-.35-.01-.54-.01-.19 0-.49.07-.75.35-.26.28-.98.96-.98 2.35s1.01 2.73 1.15 2.92c.14.19 1.99 3.04 4.82 4.26.67.29 1.2.46 1.61.59.68.22 1.29.19 1.78.11.54-.08 1.65-.67 1.88-1.32.23-.65.23-1.2.16-1.32-.07-.12-.26-.19-.54-.33z" />
      <path d="M16 2.67C8.64 2.67 2.67 8.64 2.67 16c0 2.61.77 5.05 2.1 7.1L2.67 29.33l6.39-2.07c1.98 1.08 4.25 1.74 6.94 1.74 7.36 0 13.33-5.97 13.33-13.33S23.36 2.67 16 2.67zm0 24.22c-2.34 0-4.5-.64-6.36-1.75l-.45-.27-3.78 1.22 1.24-3.68-.29-.47c-1.23-1.95-1.88-4.2-1.88-6.55 0-6.68 5.44-12.11 12.11-12.11s12.11 5.44 12.11 12.11-5.44 12.11-12.11 12.11z" />
    </svg>
  </a>

  <script>
    // Side Brochure Button started

    const brochureBtn = document.getElementById("brochureBtn");

    window.addEventListener("scroll", () => {
      if (window.scrollY > 200) {
        brochureBtn.classList.remove("opacity-0", "pointer-events-none");
        brochureBtn.classList.add("opacity-100");
      } else {
        brochureBtn.classList.add("opacity-0", "pointer-events-none");
        brochureBtn.classList.remove("opacity-100");
      }
    });
  </script>
</body>
</html>