<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>index</title>
  <style>
    .writing-mode-vertical {
      writing-mode: vertical-rl;
      text-orientation: mixed;
    }

    @keyframes bounce-slow {

      0%,
      100% {
        transform: translateY(0);
      }

      50% {
        transform: translateY(-8px);
      }
    }

    .animate-bounce-slow {
      animation: bounce-slow 2s infinite;
    }
  </style>
  <!-- Tailwind CDN -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Flowbite JS -->
  <script src="https://unpkg.com/flowbite@1.6.5/dist/flowbite.min.js"></script>
</head>

<body class="bg-white">

  <?php include "header.php"; ?>


  <div id="default-carousel" class="relative w-full h-[600px]" data-carousel="slide">
    <!-- Carousel wrapper -->
    <div class="relative h-full overflow-hidden">

      <!-- Item 1 -->
      <div class="hidden duration-700 ease-in-out h-full" data-carousel-item>
        <img src="images/GLDimg1.png"
          class="absolute w-full h-full object-cover"
          alt="Slide 1">
      </div>

      <!-- Item 2 -->
      <div class="hidden duration-700 ease-in-out h-full" data-carousel-item>
        <img src="images/GLDimg2.png"
          class="absolute w-full h-full object-cover"
          alt="Slide 2">
      </div>

      <!-- Item 3 -->
      <div class="hidden duration-700 ease-in-out h-full" data-carousel-item>
        <img src="images/GLDimg3.png"
          class="absolute w-full h-full object-cover"
          alt="Slide 3">
      </div>

      <!-- Item 4 -->
      <div class="hidden duration-700 ease-in-out h-full" data-carousel-item>
        <img src="images/GLDimg4.png"
          class="absolute w-full h-full object-cover"
          alt="Slide 4">
      </div>

      <!-- Item 5 -->
      <div class="hidden duration-700 ease-in-out h-full" data-carousel-item>
        <img src="images/GLDimg5.png"
          class="absolute w-full h-full object-cover"
          alt="Slide 5">
      </div>

    </div>
  </div>

  <!-- Slider indicators -->
  <div class="absolute z-30 flex -translate-x-1/2 bottom-5 left-1/2 space-x-3">
    <button type="button" class="w-3 h-3 rounded-full bg-white/40" data-carousel-slide-to="0"></button>
    <button type="button" class="w-3 h-3 rounded-full bg-white/40" data-carousel-slide-to="1"></button>
    <button type="button" class="w-3 h-3 rounded-full bg-white/40" data-carousel-slide-to="2"></button>
    <button type="button" class="w-3 h-3 rounded-full bg-white/40" data-carousel-slide-to="3"></button>
    <button type="button" class="w-3 h-3 rounded-full bg-white/40" data-carousel-slide-to="4"></button>
  </div>

  <!-- Controls (Updated Buttons) -->
  <a href="#slide-prev"
    class="group absolute left-4 top-1/2 -translate-y-1/2 z-30
            w-14 h-14 rounded-full
            bg-black/70 backdrop-blur
            flex items-center justify-center
            border border-[#d4af37]/40
            shadow-[0_0_0_#d4af37]
            hover:shadow-[0_0_25px_#d4af37]
            hover:scale-110
            transition-all duration-300"
    data-carousel-prev>
    <span class="text-[#d4af37] text-5xl
                 group-hover:-translate-x-1
                 transition-transform duration-300 mb-4">‹</span>
  </a>

  <a href="#slide-next"
    class="group absolute right-4 top-1/2 -translate-y-1/2 z-30
            w-14 h-14 rounded-full
            bg-black/70 backdrop-blur
            flex items-center justify-center
            border border-[#d4af37]/40
            shadow-[0_0_0_#d4af37]
            hover:shadow-[0_0_25px_#d4af37]
            hover:scale-110
            transition-all duration-300"
    data-carousel-next>
    <span class="text-[#d4af37] text-5xl
                 group-hover:translate-x-1
                 transition-transform duration-300 mb-4">›</span>
  </a>
  </div>

  <div class="min-h-screen bg-gradient-to-tr from-cyan-950 via-gray-900 to-slate-950 ">

    <!-- Header -->
    <div class="text-center pt-20 pb-16">
      <h1 class="text-5xl md:text-6xl font-bold text-cyan-800">
        Gallery
      </h1>
      <p class="mt-4 text-violet-950 text-2xl font-semibold font-mono">
        Explore Our Gallery And Experience The Beauty In Every Detail
      </p>
    </div>

    <div class="max-w-7xl mx-auto px-1 ">
      <div class="grid grid-cols-1 md:grid-cols-3 gap-5 items-center">

        <!-- Left Card -->
        <div class="bg-gradient-to-r from-cyan-950 via-slate-900 to-cyan-950
            text-black max-w-lg mr-[60px] rounded-3xl p-10 shadow-lg
            animate-bounce
            [animation-duration:4s]
            [animation-timing-function:ease-in-out]
            transition-all duration-700 hover:scale-[1.02] mt-12">

          <h2 class="text-3xl text-white mb-4 transition-colors duration-500">
            Visualise Your Dream Home.
          </h2>

          <p class="text-gray-300 mb-8 transition-colors duration-500">
            Turn Your Dreams Into A Home You'll Love.
          </p>

          <button class="bg-red-950 text-white px-6 py-3 rounded-lg
                 transition-all duration-500 ease-in-out
                 hover:bg-red-800 hover:scale-105 hover:shadow-lg">
            Schedule A Site Visit
          </button>
        </div>


        <!-- Image Gallery -->
        <div class=" md:col-span-2 relative w-full bg-gradient-to-br from-green-800 via-[#3b2a1a] to-green-800 rounded-2xl  p-12 overflow-hidden py-10">

          <!-- LEFT ARROW -->
          <a href="#s1-slide1" class="group absolute left-1 top-1/2 -translate-y-1/2 z-10
              w-14 h-14 rounded-full
              bg-black/70 backdrop-blur
              flex items-center justify-center
              border border-[#d4af37]/40
              shadow-[0_0_0_#d4af37]
              hover:shadow-[0_0_25px_#d4af37]
              hover:scale-110
              transition-all duration-300">
            <span class="text-[#d4af37] text-5xl
                   group-hover:-translate-x-1
                   transition-transform duration-300 mb-3">‹</span>
          </a>

          <!-- RIGHT ARROW -->
          <a href="#s1-slide7" class="group absolute right-4 top-1/2 -translate-y-1/2 z-10
              w-14 h-14 rounded-full
              bg-black/70 backdrop-blur
              flex items-center justify-center
              border border-[#d4af37]/40
              shadow-[0_0_0_#d4af37]
              hover:shadow-[0_0_25px_#d4af37]
              hover:scale-110
              transition-all duration-300">
            <span class="text-[#d4af37] text-5xl
                   group-hover:translate-x-1
                   transition-transform duration-300 mb-3">›</span>
          </a>

          <!-- SLIDER -->
          <div class="flex w-[800px] gap-4  overflow-x-auto  scroll-smooth snap-x snap-mandatory
                 px-4 md:px-8 scrollbar-hide">

            <!-- CARD 1 -->
            <div id="s1-slide1" class="min-w-[280px] snap-center bg-white rounded-xl shadow-xl overflow-hidden">
              <img src="https://picsum.photos/500/350?1" class="w-full h-48 object-cover">
              <div class="p-4">
                <h3 class="text-lg font-semibold">Luxury Interior</h3>
                <p class="text-sm text-gray-500">Modern premium design</p>
              </div>
            </div>

            <!-- CARD 2 -->
            <div id="s1-slide2" class="min-w-[280px] snap-center bg-white rounded-xl shadow-xl overflow-hidden">
              <img src="https://picsum.photos/500/350?2" class="w-full h-48 object-cover">
              <div class="p-4">
                <h3 class="text-lg font-semibold">Architecture</h3>
                <p class="text-sm text-gray-500">Minimal & clean</p>
              </div>
            </div>

            <!-- CARD 3 -->
            <div id="s1-slide3" class="min-w-[280px] snap-center bg-white rounded-xl shadow-xl overflow-hidden">
              <img src="https://picsum.photos/500/350?3" class="w-full h-48 object-cover">
              <div class="p-4">
                <h3 class="text-lg font-semibold">Creative Space</h3>
                <p class="text-sm text-gray-500">Bright & elegant</p>
              </div>
            </div>

            <!-- CARD 4 -->
            <div id="s1-slide4" class="min-w-[280px] snap-center bg-white rounded-xl shadow-xl overflow-hidden">
              <img src="https://picsum.photos/500/350?4" class="w-full h-48 object-cover">
              <div class="p-4">
                <h3 class="text-lg font-semibold">Premium Living</h3>
                <p class="text-sm text-gray-500">High-end comfort</p>
              </div>
            </div>

            <div id="s1-slide5" class="min-w-[280px] snap-center bg-white rounded-xl shadow-xl overflow-hidden">
              <img src="https://picsum.photos/500/350?4" class="w-full h-48 object-cover">
              <div class="p-4">
                <h3 class="text-lg font-semibold">Premium Living</h3>
                <p class="text-sm text-gray-500">High-end comfort</p>
              </div>
            </div>

            <div id="s1-slide6" class="min-w-[280px] snap-center bg-white rounded-xl shadow-xl overflow-hidden">
              <img src="https://picsum.photos/500/350?4" class="w-full h-48 object-cover">
              <div class="p-4">
                <h3 class="text-lg font-semibold">Premium Living</h3>
                <p class="text-sm text-gray-500">High-end comfort</p>
              </div>
            </div>

            <div id="s1-slide7" class="min-w-[280px] snap-center bg-white rounded-xl shadow-xl overflow-hidden">
              <img src="https://picsum.photos/500/350?4" class="w-full h-48 object-cover">
              <div class="p-4">
                <h3 class="text-lg font-semibold">Premium Living</h3>
                <p class="text-sm text-gray-500">High-end comfort</p>
              </div>
            </div>

          </div>
        </div>

      </div>

    </div>

  </div>

  <section class="min-h-screen bg-gray-200 mx-auto px-6 py-20">

    <div class="relative max-w-6xl bg-cyan-950 rounded-xl mx-auto py-16">

      <!-- LEFT ARROW -->
      <a href="#slider1"
        class="arrowbtn  group absolute -left-[60px] top-1/2 -translate-y-1/2 z-10
          w-14 h-14 rounded-full
          bg-black/70 backdrop-blur
          flex items-center justify-center
          border border-[#d4af37]/40
          shadow-[0_0_0_#d4af37]
          hover:shadow-[0_0_25px_#d4af37]
          hover:scale-110
          transition-all duration-300">
        <span class="text-[#d4af37] text-5xl
               group-hover:-translate-x-1
               transition-transform duration-300 mb-4">‹</span>
      </a>


      <a href="#slider7"
        class="arrowbtn  group absolute -right-[60px] top-1/2 -translate-y-1/2 z-10
          w-14 h-14 rounded-full
          bg-black/70 backdrop-blur
          flex items-center justify-center
          border border-[#d4af37]/40
          shadow-[0_0_0_#d4af37]
          hover:shadow-[0_0_25px_#d4af37]
          hover:scale-110
          transition-all duration-300">
        <span class="text-[#d4af37] text-5xl
               group-hover:translate-x-1
               transition-transform duration-300 mb-4">›</span>
      </a>







      <!-- SLIDER -->
      <div
        class="flex gap-6 overflow-x-auto scroll-smooth snap-x snap-mandatory
           px-14 scrollbar-hide">

        <!-- CARD 1 -->
        <div id="slider1"
          class="min-w-[320px] snap-center bg-white rounded-xl shadow-xl overflow-hidden">
          <img src="https://picsum.photos/500/350?1" class="w-full h-56 object-cover">
          <div class="p-4">
            <h3 class="text-lg font-semibold">Luxury Interior</h3>
            <p class="text-sm text-gray-500">Modern premium design</p>
          </div>
        </div>

        <!-- CARD 2 -->
        <div id="slider2"
          class="min-w-[320px] snap-center bg-white rounded-xl shadow-xl overflow-hidden">
          <img src="https://picsum.photos/500/350?2" class="w-full h-56 object-cover">
          <div class="p-4">
            <h3 class="text-lg font-semibold">Architecture</h3>
            <p class="text-sm text-gray-500">Minimal & clean</p>
          </div>
        </div>

        <!-- CARD 3 -->
        <div id="slider3"
          class="min-w-[320px] snap-center bg-white rounded-xl shadow-xl overflow-hidden">
          <img src="https://picsum.photos/500/350?3" class="w-full h-56 object-cover">
          <div class="p-4">
            <h3 class="text-lg font-semibold">Creative Space</h3>
            <p class="text-sm text-gray-500">Bright & elegant</p>
          </div>
        </div>

        <!-- CARD 4 -->
        <div id="slider4"
          class="min-w-[320px] snap-center bg-white rounded-xl shadow-xl overflow-hidden">
          <img src="https://picsum.photos/500/350?4" class="w-full h-56 object-cover">
          <div class="p-4">
            <h3 class="text-lg font-semibold">Premium Living</h3>
            <p class="text-sm text-gray-500">High-end comfort</p>
          </div>
        </div>

        <div id="slider5"
          class="min-w-[320px] snap-center bg-white rounded-xl shadow-xl overflow-hidden">
          <img src="https://picsum.photos/500/350?4" class="w-full h-56 object-cover">
          <div class="p-4">
            <h3 class="text-lg font-semibold">Premium Living</h3>
            <p class="text-sm text-gray-500">High-end comfort</p>
          </div>
        </div>

        <div id="slider6"
          class="min-w-[320px] snap-center bg-white rounded-xl shadow-xl overflow-hidden">
          <img src="https://picsum.photos/500/350?4" class="w-full h-56 object-cover">
          <div class="p-4">
            <h3 class="text-lg font-semibold">Premium Living</h3>
            <p class="text-sm text-gray-500">High-end comfort</p>
          </div>
        </div>

        <div id="slider7"
          class="min-w-[320px] snap-center bg-white rounded-xl shadow-xl overflow-hidden">
          <img src="https://picsum.photos/500/350?4" class="w-full h-56 object-cover">
          <div class="p-4">
            <h3 class="text-lg font-semibold">Premium Living</h3>
            <p class="text-sm text-gray-500">High-end comfort</p>
          </div>
        </div>

      </div>
    </div>

    <button class="mt-8 bg-red-950 hover:bg-red-800 hover:scale-105 hover:shadow-lg  text-white ml-[635px] px-8 py-3 rounded-md transition">
      Schedule A Site Visit
    </button>


  </section>

  <section class="py-24 bg-gradient-to-l from-slate-950 via-gray-950 to-cyan-950 text-center">
    <h2 class="text-3xl font-heading text-gray-200 mb-12">
      DON'T HESITATE TO CONTACT US
    </h2>

    <div class="max-w-4xl mx-auto px-6">
      <div
        class="relative rounded-xl border border-gold/60
           bg-[url('/images/appointment-bg.jpg')] bg-cover bg-center
           px-10 py-14 shadow-2xl overflow-hidden">

        <!-- Overlay -->
        <div class="absolute inset-0 bg-black/60"></div>

        <!-- Content -->
        <div class="relative z-10">
          <h3 class="text-3xl font-bold text-gray-200 mb-8">
            MAKE AN APPOINTMENT NOW
          </h3>

          <button class="bg-red-700 hover:bg-red-500 text-white px-8 py-3 rounded-md transition">
            Enquire Now
          </button>
        </div>
      </div>
    </div>

  </section>



  <!-- ABOUT SECTION -->
  <section class="min-h-screen bg-gray-400 mx-auto px-6 py-20 grid md:grid-cols-2 gap-16 items-center">

    <!-- LEFT IMAGE -->
    <div class="rounded-2xl overflow-hidden shadow-lg">
      <img src="images/villas img.jpg" alt="Building" class="w-full h-full object-cover">

      <h2 class="text-4xl md:text-5xl font-serif ml-[15px] mt-6 text-cyan-900 mb-5">
        Amenities
      </h2>
      <p class="text-lg text-black ml-[15px] leading-relaxed max-w-xl mb-6">
        Discover top-notch amenities designed to enhance your experience, comfort, and convenience at every step.
      </p>

    </div>

    <!-- RIGHT CONTENT -->
    <div class="mb-[200px]">
      <h2 class="text-4xl md:text-5xl font-serif text-cyan-900  mb-[30px]">
        About Us
      </h2>

      <p class="text-lg text-black leading-relaxed max-w-xl ">
        Roswalt Zyon in Andheri Oshiwara stands tall like the 'Hills of God',
        representing power, prestige, and perfection. It's not just a home;
        it's a symbol of excellence for a select few.
      </p>

      <button class="mt-8 bg-red-950 hover:bg-red-800 text-white justify-items-center px-8 py-3 rounded-md transition">
        Schedule A Site Visit
      </button>
    </div>

  </section>

  <section class="min-h-screen bg-red-50 mx-auto px-6 py-20">
    <div class="grid md:grid-cols-2 gap-14 items-start">

      <!-- LEFT FORM -->
      <div class="border-4 border-red-800 rounded-xl p-5">
        <h2 class="text-4xl font-serif text-black mb-4">
          Book Site Visit <span class="uppercase">Now !</span>
        </h2>

        <p class="text-gray-700 mb-8">
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
          <label class="flex items-start gap-3 text-sm text-gray-700">
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
            class="bg-green-600 hover:bg-green-900 text-white ml-[230px] px-10 py-3 rounded-md tracking-wide">
            SUBMIT
          </button>

        </form>
      </div>

      <!-- RIGHT CONTENT -->
      <div class="relative border-4 border-red-800 rounded-xl p-5">
        <h2 class="text-4xl font-serif text-black mb-4">
          Unlock Your Dream Home!
        </h2>

        <p class="text-gray-700 mb-10">
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
  <section class="relative bg-gradient-to-l from-slate-950 via-gray-950 to-cyan-950  overflow-hidden py-20">

    <!-- Background Decorative Lines -->
    <div class="absolute inset-0 opacity-20 pointer-events-none">
      <svg class="w-full h-full" viewBox="0 0 1440 400" fill="none">
        <path d="M0 300 L200 200 L400 260 L600 180 L800 240 L1000 200 L1200 250 L1440 210"
          stroke="#b38350" />
        <path d="M0 340 L200 260 L400 300 L600 240 L800 290 L1000 260 L1200 300 L1440 270"
          stroke="#b38350" />
      </svg>
    </div>

    <div class="relative max-w-7xl mx-auto px-6">

      <div class="grid lg:grid-cols-3 gap-14 items-start">

        <!-- LEFT : BRAND -->
        <div>
          <img src="images/granthalogo.webp" alt="Roswalt Zyon" class="w-[190px] mb-6">

          <h3 class="font-serif text-3xl text-[#d2a679] mb-6 leading-tight">
            Granthaa Land Developer<br>Pvt. Ltd.
          </h3>

          <div class="flex gap-4">
            <div class="w-10 h-10 rounded-full bg-[#1f1f1f] flex items-center justify-center text-[#d2a679]">f</div>
            <div class="w-10 h-10 rounded-full bg-[#1f1f1f] flex items-center justify-center text-[#d2a679]">◎</div>
            <div class="w-10 h-10 rounded-full bg-[#1f1f1f] flex items-center justify-center text-[#d2a679]">▶</div>
          </div>
        </div>

        <!-- CENTER : TEXT / DISCLAIMER -->
        <div class="text-sm text-gray-300 leading-relaxed">
          <p class="mb-4">
            Roswalt Zyon is registered with MahaRERA under Project Registration No.
            <span class="text-[#d2a679]">P51800047680</span>, which can be viewed at
            maharera.mahaonline.gov.in under registered projects.
          </p>

          <p>
            <span class="text-[#d2a679]">Disclaimer:</span>
            This content is for informational purposes only and does not constitute an offer to avail
            of any service. Prices mentioned are subject to change without notice, and properties
            mentioned are subject to availability. Images are for representation purposes only.
            This is the official website of an authorized marketing partner. We may share data with
            RERA-registered brokers/companies for further processing and may also send updates to the
            registered mobile number/email ID.
          </p>
        </div>

        <!-- RIGHT : QR CODES -->
        <div class="flex gap-10 justify-start lg:justify-end">
          <div class="text-center">
            <img src="qr1.png" alt="EC QR"
              class="w-32 h-32 border-4 border-white rounded-lg mx-auto">
            <p class="mt-2 text-sm">EC</p>
            <div class="mt-2 w-8 h-8 bg-[#b38350] rounded-full flex items-center justify-center mx-auto">
              ⬇
            </div>
          </div>

          <div class="text-center">
            <img src="qr2.png" alt="SMC QR"
              class="w-32 h-32 border-4 border-white rounded-lg mx-auto">
            <p class="mt-2 text-sm">SMC</p>
            <div class="mt-2 w-8 h-8 bg-[#b38350] rounded-full flex items-center justify-center mx-auto">
              ⬇
            </div>
          </div>
        </div>

      </div>

      <!-- CONTACT ROW -->
      <div class="mt-16 pt-6 border-t border-[#b38350]/40
                flex flex-col lg:flex-row gap-6 text-sm text-gray-300">

        <div class="flex items-center gap-2">
          ☎ <span>Phone: +91 7507070707</span>
        </div>

        <div class="flex items-center gap-2">
          ✉ <span>Email: info@roswalt.com</span>
        </div>

        <div class="flex items-center gap-2">
          📍 <span>Roswalt Zyon, M/s. A, next to Ruby Hospital, Oshiwara, Andheri West</span>
        </div>

      </div>

      <!-- BOTTOM TEXT -->
      <div class="text-center text-sm text-[#d2a679] mt-8">
        All Rights Reserved. | Privacy Policy Applies.
      </div>

    </div>
  </section>







  <!-- DOWNLOAD BROCHURE BUTTON (RIGHT SIDE) -->
  <div id="brochureBtn"
    class="fixed right-0 top-1/2 -translate-y-1/2 z-30
            transition-opacity duration-500 opacity-85">
    <a href="#"
      class="bg-[#b38350] text-white px-4 py-6 rounded-l-md
            writing-mode-vertical tracking-widest font-semibold">
      Download Brochure
    </a>
  </div>




  <!-- WHATSAPP STICKY BUTTON -->
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

</body>

</html>