<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Auto Enquiry Popup</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen">

<!-- BACKDROP -->
<div
  id="modalBackdrop"
  class="fixed inset-0 z-50 flex items-center justify-center
         bg-black/60 px-4
         opacity-0 pointer-events-none
         transition-opacity duration-300"
>

  <!-- MODAL -->
  <div
    id="modalBox"
    class="relative w-full max-w-sm sm:max-w-md
           bg-white rounded-2xl shadow-2xl
           border-2 border-blue-600
           p-4 sm:p-6
           transform translate-y-24 scale-95 opacity-0
           transition-all duration-300 ease-out"
  >

    <!-- CLOSE -->
    <button
      id="closeModal"
      class="absolute top-3 right-3 text-blue-600
             hover:text-red-500 text-2xl font-bold"
    >
      ✕
    </button>

    <!-- HEADER -->
    <div class="text-center mb-5">
      <h2 class="text-xl sm:text-2xl font-bold text-blue-700">
        Call Us <span class="text-green-600">+91 7507070707</span>
      </h2>

      <p class="text-xs text-gray-500 mt-1">OR</p>

      <h3 class="text-lg sm:text-xl font-semibold text-blue-700 mt-1">
        Enquire Now!
      </h3>

      <p class="text-sm text-gray-600 mt-3">
        Take the first step towards your dream home —
        <span class="font-semibold text-green-600">book today!</span>
      </p>
    </div>

    <!-- FORM -->
    <form class="space-y-3 sm:space-y-4">

      <input
        type="text"
        placeholder="Name"
        class="w-full px-4 py-2.5 sm:py-3
               rounded-lg border border-blue-300
               focus:ring-2 focus:ring-blue-500 outline-none"
      />

      <input
        type="email"
        placeholder="Email"
        class="w-full px-4 py-2.5 sm:py-3
               rounded-lg border border-blue-300
               focus:ring-2 focus:ring-blue-500 outline-none"
      />

      <div class="flex gap-2">
        <select
          class="px-3 py-2.5 sm:py-3 rounded-lg
                 border border-blue-300 bg-white
                 focus:ring-2 focus:ring-blue-500"
        >
          <option>🇮🇳 +91</option>
        </select>

        <input
          type="tel"
          placeholder="Phone"
          class="flex-1 px-4 py-2.5 sm:py-3
                 rounded-lg border border-blue-300
                 focus:ring-2 focus:ring-blue-500 outline-none"
        />
      </div>

      <label class="flex gap-2 text-xs sm:text-sm text-gray-600">
        <input type="checkbox" checked class="mt-1 accent-green-600">
        I agree and authorize the team to contact me. This overrides
        <span class="font-semibold">DNC / NDNC</span>.
      </label>

      <!-- CAPTCHA MOCK -->
      <div class="border border-blue-900 rounded-md p-3 max-w-xs">
        <div class="flex items-center gap-3 text-sm">
          <input type="checkbox" class="w-5 h-5 accent-green-600">
          <span>I’m not a robot</span>
        </div>
        <p class="text-[11px] text-gray-500 mt-2">
          reCAPTCHA · Privacy · Terms
        </p>
      </div>

      <button
        type="submit"
        class="w-full bg-green-600 hover:bg-green-700
               text-white py-2.5 sm:py-3
               rounded-lg font-semibold tracking-wide
               transition"
      >
        SUBMIT
      </button>

    </form>
  </div>
</div>

<!-- SCRIPT -->
<script>
  const backdrop = document.getElementById("modalBackdrop");
  const modal = document.getElementById("modalBox");
  const closeBtn = document.getElementById("closeModal");

  function openModal() {
    backdrop.classList.remove("opacity-0", "pointer-events-none");
    modal.classList.remove("translate-y-24", "scale-95", "opacity-0");
  }

  function closeModal() {
    modal.classList.add("translate-y-24", "scale-95", "opacity-0");
    backdrop.classList.add("opacity-0");

    setTimeout(() => {
      backdrop.classList.add("pointer-events-none");
    }, 300);
  }

  window.addEventListener("load", () => {
    setTimeout(openModal, 500);
  });

  closeBtn.addEventListener("click", closeModal);
  backdrop.addEventListener("click", e => {
    if (e.target === backdrop) closeModal();
  });
</script>

</body>
</html>