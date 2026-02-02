<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Contact For booking</title>
<style>
   .writing-mode-vertical {
      writing-mode: vertical-rl;
      text-orientation: mixed;
    }

</style>
</head>

<body >
    <?php include "header.php"; ?> 

  <section class="min-h-screen bg-white mx-auto px-6 py-20">
    <div class="grid md:grid-cols-2 gap-14 items-start">

      <!-- LEFT FORM -->
      <div class="border-[4px] border-blue-800 rounded-xl p-5">
        <h2 class="text-4xl font-serif text-black mb-4">
          Book Site Visit <span class="uppercase">Now !</span>
        </h2>

        <p class="text-black font-semibold mb-8">
          Take The First Step Towards Your Dream Home – Book Today!
        </p>

        <form class="space-y-6">

          <!-- Name -->
          <input type="text" placeholder="Name"
            class="w-full bg-transparent border-2 border-gray-700 rounded-lg px-5 py-4 focus:outline-none focus:border-[#d2a679]" />

          <!-- Email -->
          <input type="email" placeholder="Email"
            class="w-full bg-transparent border-2 border-gray-700 rounded-lg px-5 py-4 focus:outline-none focus:border-[#d2a679]" />

          <!-- Phone -->
          <div class="flex items-center bg-transparent border-2 border-gray-700 rounded-lg px-4 py-3">
            <span class="mr-3">🇮🇳</span>
            <input type="tel" placeholder="Phone"
              class="bg-transparent w-full focus:outline-none" />
          </div>

          <!-- Checkbox -->
          <label class="flex items-start gap-3 text-sm text-gray-800">
            <input type="checkbox" checked
              class="mt-1 accent-green-500" />
            I agree and authorize team to contact me. This will override the registry with DNC / NDNC
          </label>

          <!-- reCAPTCHA placeholder -->
          <div class="bg-white text-black ml-[150px] border border-gray-950 rounded-md p-4 w-72">
            <div class="flex items-center gap-3">
              <input type="checkbox" class="w-5 h-5">
              <span>I’m not a robot</span>
            </div>
            <p class="text-xs text-gray-500 mt-2">
              reCAPTCHA Privacy - Terms
            </p>
          </div>

          <!-- Submit -->
          <button
            class="jersey font-semibold bg-transparent border border-[#73bc01] hover:bg-[#73bc01] hover:text-black text-[#73bc01]  ml-[230px] px-10 py-3 rounded-md tracking-wide">
            SUBMIT
          </button>

        </form>
      </div>

      <!-- RIGHT CONTENT -->
      <div class="relative border-[4px] border-blue-800 rounded-xl p-5">
        <h2 class="text-4xl font-serif text-black mb-4">
          Unlock Your Dream Home!
        </h2>

        <p class="text-black font-semibold mb-10">
          Unlock a world of comfort and luxury in your dream home.
        </p>

        <!-- Contact Items -->
        <div class="space-y-8">

          <!-- Email -->
          <div class="flex gap-4 items-start">
            <div class="w-12 h-12 rounded-full bg-[#d2a679] flex items-center justify-center text-black">
              ✉
            </div>
            <div>
              <h4 class="text-xl font-serif">Send An Email</h4>
              <p class="text-red-800">grantha@gmail.com</p>
            </div>
          </div>

          <!-- Phone -->
          <div class="flex gap-4 items-start">
            <div class="w-12 h-12 rounded-full bg-[#d2a679] flex items-center justify-center text-black">
              ☎
            </div>
            <div>
              <h4 class="text-xl font-serif">Give Us A Call</h4>
              <p class="text-red-800">+91 9090909090</p>
            </div>
          </div>

          <!-- Address -->
          <div class="flex gap-4 items-start">
            <div class="w-12 h-12 rounded-full bg-[#d2a679] flex items-center justify-center text-black">
              📍
            </div>
            <div>
              <h4 class="text-xl font-serif">Site Address</h4>
              <p class="text-red-800 max-w-sm">
                comming soon
              </p>
            </div>
          </div>

        </div>

        <!-- Decorative line -->
        <div class="absolute right-0 top-0 h-full w-px bg-gradient-to-b from-transparent via-[#d2a679] to-transparent hidden md:block"></div>
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
