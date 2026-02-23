<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>shobaa residency</title>
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
        SHOBHAA RESIDENCY :
      </h1>

      <div class="space-y-20">

        <!-- SECTION 1 -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-10 items-center">
          <div class="relative group rounded-2xl transition-transform duration-500 ease-in-out
            hover:scale-105 overflow-hidden shadow-lg">

            <img
              src="images/Shobha residency plan.jpeg"
              alt="Project Layout Plan"
              class="w-full h-[400px] object-cover" />
            <span class="absolute top-0 right-0 w-80 h-[7px] bg-[#73bc01] "></span>
            <span class="absolute top-0 right-0 w-[7px] h-80 bg-[#73bc01] "></span>

            <!-- Bottom Left Blue -->
            <span class="absolute bottom-0 left-0 w-80 h-[7px] bg-blue-800"></span>
            <span class="absolute bottom-0 left-0 w-[7px] h-80 bg-blue-800"></span>
          </div>

          <div>
            <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-4">
              Elevated Living at Shobhaa Residency
            </h2>
            <p class="text-gray-700 leading-relaxed mb-4 text-base sm:text-lg md:text-lg text-justify">
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
         transition-opacity duration-100">

    <a
      href="#"
      class="jersey
           flex items-center justify-center
           bg-[#73bc01]/40
           text-[#73bc01]
           border-2 border-blue-900
           px-4 py-4
           rounded-l-md
           writing-mode-vertical
           tracking-widest
           font-semibold
           overflow-hidden">
      Download Brochure
    </a>

  </div>



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