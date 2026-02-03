<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>index</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Yeseva+One&display=swap" rel="stylesheet">
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

    .carousel {
      --items: 6;
      --carousel-duration: 30s;
      --carousel-width: 80vw;
      --carousel-item-width: 280px;
      --carousel-item-height: 350px;
      --carousel-item-gap: 2rem;
      position: relative;
      overflow: hidden;
    }

    .carousel-mask {
      position: absolute;
      inset: 0;
      pointer-events: none;
      mask-image: linear-gradient(to right, transparent, black 10% 90%, transparent);
    }

    .carousel-inner {
      position: relative;
      width: var(--carousel-width);
      max-width: 1200px;
      height: var(--carousel-item-height);
    }

    .carousel-item {
      animation: marquee var(--carousel-duration) linear infinite;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .carousel:hover .carousel-item {
      animation-play-state: paused;
    }

    .carousel-item:hover {
      transform: translateY(-8px) scale(1.02);
      /* box-shadow: 0 18px 35px rgb(22, 243, 6); */
    }

    @keyframes marquee {
      0% {
        transform: translateX(0);
      }

      100% {
        transform: translateX(calc((var(--items) * (var(--carousel-item-width) + var(--carousel-item-gap))) * -1));
      }
    }

     .slide-card {
    min-width: 320px;
    flex-shrink: 0;
    scroll-snap-align: center;
    border-radius: 16px;
    overflow: hidden;
  }

  .slide-card img {
    width: 100%;
    height: auto;
    display: block;
  }

  .indicator.active {
    background-color: #21ee39 !important;
    color: black;
  }

    @media (max-width: 768px) {
      .slide-card.active {
        transform: scale(1.05);
      }
    }
    
.family {
  font-family: "Yeseva One", serif;
  font-optical-sizing: auto;
  font-weight: weight;
  font-style: normal;
}
.yeseva {
  font-family: "Yeseva One", serif;
  font-weight: 400;
  font-style: normal;
}
.ubuntu {
  font-family: "Ubuntu", sans-serif;
  font-weight: 300;
  font-style: italic;
}
.jersey {
  font-family: "Jersey 25", sans-serif;
  font-weight: 400;
  font-style: normal;
}
/* .slide {
    min-width: 25%;
    transition: transform 0.5s ease, opacity 0.5s ease;
  }

  .slide img {
    border-radius: 14px;
    width: 100%;
  }

  .slide.active {
    transform: scale(1.15);
    z-index: 10;
  }

  .dot {
    width: 10px;
    height: 10px;
    border-radius: 9999px;
    background: #555;
  }

  .dot.active {
    background: white;
    transform: scale(1.4);
  } */
</style>

     
 
  <!-- Tailwind CDN -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Flowbite JS -->
  <script src="https://unpkg.com/flowbite@1.6.5/dist/flowbite.min.js"></script>
</head>

<body class="bg-transparent">

    <?php include "header.php"; ?> 


<div id="default-carousel"
     class="relative w-full h-[700px]"
     data-carousel="slide">

  <!-- Carousel wrapper -->
  <div class="relative h-full overflow-hidden">

    <div class="hidden duration-700 ease-in-out h-full" data-carousel-item>
      <img src="images/GLDimg1.png" class="absolute w-full h-full object-cover">
    </div>

    <div class="hidden duration-700 ease-in-out h-full" data-carousel-item>
      <img src="images/GLDimg2.png" class="absolute w-full h-full object-cover">
    </div>

    <div class="hidden duration-700 ease-in-out h-full" data-carousel-item>
      <img src="images/GLDimg3.png" class="absolute w-full h-full object-cover">
    </div>

    <div class="hidden duration-700 ease-in-out h-full" data-carousel-item>
      <img src="images/GLDimg4.png" class="absolute w-full h-full object-cover">
    </div>

    <div class="hidden duration-700 ease-in-out h-full" data-carousel-item>
      <img src="images/GLDimg5.png" class="absolute w-full h-full object-cover">
    </div>
  </div>

  <!-- INDICATORS -->
 <div class="absolute z-30 bottom-6 left-1/2 -translate-x-1/2 flex gap-3">
  <button
    data-carousel-slide-to="0"
    class="w-4 h-4 rounded-full bg-black/70 border border-[#73bc01]
           transition-all duration-300
           hover:bg-[#73bc01]
           aria-[current=true]:scale-150
           aria-[current=true]:bg-[#73bc01]">
  </button>

  <button data-carousel-slide-to="1" class="w-4 h-4 rounded-full bg-black/70 border border-[#73bc01]
           transition-all duration-300 hover:bg-[#73bc01]
           aria-[current=true]:scale-150 aria-[current=true]:bg-[#73bc01]"></button>

  <button data-carousel-slide-to="2" class="w-4 h-4 rounded-full bg-black/70 border border-[#73bc01]
           transition-all duration-300 hover:bg-[#73bc01]
           aria-[current=true]:scale-150 aria-[current=true]:bg-[#73bc01]"></button>
           <button data-carousel-slide-to="1" class="w-4 h-4 rounded-full bg-black/70 border border-[#73bc01]
           transition-all duration-300 hover:bg-[#73bc01]
           aria-[current=true]:scale-150 aria-[current=true]:bg-[#73bc01]"></button>
           <button data-carousel-slide-to="1" class="w-4 h-4 rounded-full bg-black/70 border border-[#73bc01]
           transition-all duration-300 hover:bg-[#73bc01]
           aria-[current=true]:scale-150 aria-[current=true]:bg-[#73bc01]"></button>
           
</div>

  <!-- PREV -->
  <button type="button"
    class="group absolute left-4 top-1/2 -translate-y-1/2 z-30
           w-14 h-14 rounded-full bg-black/70 backdrop-blur
           flex items-center justify-center
           border border-[#73bc01]
           hover:scale-110 transition-all"
    data-carousel-prev>
    <span class="text-[#73bc01] text-5xl mb-4">‹</span>
  </button>

  <!-- NEXT -->
  <button type="button"
    class="group absolute right-4 top-1/2 -translate-y-1/2 z-30
           w-14 h-14 rounded-full bg-black/70 backdrop-blur
           flex items-center justify-center
           border border-[#73bc01]
           hover:scale-110 transition-all"
    data-carousel-next>
    <span class="text-[#73bc01] text-5xl mb-4">›</span>
  </button>

</div>

  <div class="min-h-screen bg-white ">

    <!-- Header -->
    <div class="text-center pt-20 pb-16">
      <!-- <h1 class="family text-5xl md:text-6xl font-Bold-700-Italic text-[#73bc01]">
        Gallery      </h1> -->
      <p class="yeseva mt-4 text-black text-3xl  ">
        Explore Our Gallery And Experience The Beauty In Every Detail
      </p>
    </div>

    <div class="max-w-7xl mx-auto px-1 ">
      <div class="grid grid-cols-1 md:grid-cols-3 gap-5 items-center">

        <!-- Left Card -->
        <div class="bg-black
            text-black max-w-lg mr-[60px] rounded-3xl p-10 shadow-lg
            animate-bounce
            [animation-duration:4s]
            [animation-timing-function:ease-in-out]
            transition-all duration-700 hover:scale-[1.02] mt-12">

          <h2 class="ubuntu text-3xl text-white mb-4 transition-colors duration-500">
            Visualise Your <span class="ml-[60px]"> Dream Home.</span>
          </h2>

          <p class="text-gray-400 font-semibold mb-8 transition-colors duration-500">
            Turn Your Dreams Into A Home You'll Love.
          </p>

          <button class="jersey bg-transparent text-[#73bc01] border border-[#73bc01] font-semibold ml-7 px-8 py-3 rounded-lg
                 transition-all duration-500 ease-in-out
                 hover:bg-[#73bc01] hover:text-black hover:scale-105 hover:shadow-lg">
            Schedule A Site Visit
          </button>
        </div>


        <!-- Image Gallery -->
        <div class=" md:col-span-2  relative w-full rounded-2xl  overflow-hidden py-4">




          <!-- SLIDER -->
          <div class="carousel mx-auto">

            <div class="carousel-mask"></div>

            <div class="carousel-inner">


              <!-- ITEM 1 -->
              <article class="carousel-item absolute top-0 bg-black rounded-xl overflow-hidden border border-gray-950 shadow-sm "
                style=" left: calc(100% + var(--carousel-item-gap)); width: var(--carousel-item-width); height: 300px; animation-delay: calc(var(--carousel-duration)/var(--items)*0*-1);">

                <div class="w-full h-[300px]">
                  <img src="images/flat1.jpg" class="w-full h-full object-cover" />
                </div>



              </article>



              <!-- ITEM 2 -->
              <article class="carousel-item absolute top-0 bg-black  rounded-xl overflow-hidden border border-gray-950  shadow-sm"
                style="left: calc(100% + var(--carousel-item-gap)); width: var(--carousel-item-width); height: 300px; animation-delay: calc(var(--carousel-duration)/var(--items)*1*-1);">

                <div class="w-full h-[300px]">
                  <img src="images/flat2.webp" class="w-full h-full object-cover" />
                </div>



              </article>



              <!-- ITEM 3 -->
              <article class="carousel-item absolute top-0 bg-black  rounded-xl overflow-hidden border border-gray-950 shadow-sm"
                style="left: calc(100% + var(--carousel-item-gap)); width: var(--carousel-item-width); height: 300px; animation-delay: calc(var(--carousel-duration)/var(--items)*2*-1);">

                <div class="w-full h-[300px]">
                  <img src="images/flat3.jpeg" class="w-full h-full object-cover" />
                </div>



              </article>



              <!-- ITEM 4 -->
              <article class="carousel-item absolute top-0 bg-black  rounded-xl overflow-hidden border border-gray-950  shadow-sm"
                style="left: calc(100% + var(--carousel-item-gap)); width: var(--carousel-item-width); height: 300px; animation-delay: calc(var(--carousel-duration)/var(--items)*3*-1);">

                <div class="w-full h-[300px]">
                  <img src="images/flat4.jpeg" class="w-full h-full object-cover" />
                </div>



              </article>



              <!-- ITEM 5 -->
              <article class="carousel-item absolute top-0 bg-black  rounded-xl overflow-hidden border border-gray-950  shadow-sm"
                style="left: calc(100% + var(--carousel-item-gap)); width: var(--carousel-item-width); height: 300px; animation-delay: calc(var(--carousel-duration)/var(--items)*4*-1);">

                <div class="w-full h-[300px]">
                  <img src="images/flat5.jpg" class="w-full h-full object-cover" />
                </div>



              </article>



              <!-- ITEM 6 -->
              <article class="carousel-item absolute top-0 bg-black  rounded-xl overflow-hidden border border-gray-950  shadow-sm"
                style="left: calc(100% + var(--carousel-item-gap)); width: var(--carousel-item-width); height: 300px; animation-delay: calc(var(--carousel-duration)/var(--items)*5*-1);">

                <div class="w-full h-[300px]">
                  <img src="images/flat6.webp" class="w-full h-full object-cover" />
                </div>


              </article>



            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

  <!-- <div class="relative w-full overflow-hidden bg-black py-10">

  <div
    id="slider"
    class="flex gap-14 transition-transform duration-700 ease-linear"
  >
    <div class="slide"><img src="images/card1.jpg" class="w-[150px] h-[300px]"></div>
    <div class="slide"><img src="images/card2.jpeg " class="w-[150px] h-[300px]"></div>
    <div class="slide"><img src="images/card3.webp " class="w-[150px] h-[300px]"></div>
    <div class="slide"><img src="images/card4.avif " class="w-[150px] h-[300px]"></div>
    <div class="slide"><img src="images/card5.jpg " class="w-[150px] h-[300px]"></div>
    <div class="slide"><img src="images/card6.jpg " class="w-[150px] h-[300px]"></div>
    <div class="slide"><img src="images/card7.jpg " class="w-[150px] h-[300px]"></div>


     <div class="slide"><img src="images/card1.jpg" class="w-[150px] h-[300px]"></div>
    <div class="slide"><img src="images/card2.jpeg " class="w-[150px] h-[300px]"></div>
    <div class="slide"><img src="images/card3.webp " class="w-[150px] h-[300px]"></div>
    <div class="slide"><img src="images/card4.avif " class="w-[150px] h-[300px]"></div>
    <div class="slide"><img src="images/card5.jpg " class="w-[150px] h-[300px]"></div>
    <div class="slide"><img src="images/card6.jpg " class="w-[150px] h-[300px]"></div>
    <div class="slide"><img src="images/card7.jpg " class="w-[150px] h-[300px]"></div>

  </div>

  <div class="flex justify-center gap-3 mt-6">
    <button class="dot active"></button>
    <button class="dot"></button>
    <button class="dot"></button>
    <button class="dot"></button>
    <button class="dot"></button>
    <button class="dot"></button>
     <button class="dot"></button>

  </div>

</div> -->

  <!-- Make Appointment -->

  <section class="text-center">
    <div
      class="relative bg-cover bg-center shadow-2xl overflow-hidden min-h-[450px]
           flex items-center justify-center"
      style="background-image: url('./images/Interial.avif');">
      <!-- Overlay -->
      <div class="absolute inset-0 bg-black/60"></div>

      <!-- Content -->
      <div class="relative z-10">
        <h2 class="yeseva text-xl text-gray-200 mb-4 tracking-wider">
          DON'T HESITATE TO CONTACT US
        </h2>

        <h3 class="family text-12xl md:text-6xl font-bold text-[#73bc01] mb-8">
          MAKE AN APPOINTMENT NOW
        </h3>

        <button
          class="jersey font-semibold bg-transparent  border border-[#73bc01] text-[#73bc01] hover:bg-[#73bc01] hover:text-black px-8 py-3 rounded-md transition duration-300">
          Enquire Now
        </button>
      </div>
    </div>
  </section>





  <!-- ABOUT SECTION -->
  <section class="bg-white mx-auto px-6 py-24">
  <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-16 items-center">

    <!-- LEFT IMAGE -->
    <div class="relative rounded-2xl overflow-hidden shadow-xl">
      <img
        src="images/plot booking img.jpeg"
        alt="Premium Plot Development"
        class="w-full h-[450px] object-cover"
      />
    </div>

    <!-- RIGHT CONTENT -->
    <div class="space-y-6">
      <h2 class="family text-[#73bc01]  font-bold text-2xl md:text-4xl ">
        About Us
      </h2>

      <p class="text-lg text-gray-700 leading-relaxed">
        We specialize in premium plot developments designed for those who value
        location, long-term growth, and lifestyle excellence. Every project is
        carefully planned to ensure legal clarity, superior infrastructure,
        and future-ready living.
      </p>

      <p class="text-lg text-gray-700 leading-relaxed">
        Our developments combine modern planning with nature-friendly layouts,
        offering well-connected roads, open spaces, and a secure investment
        environment for families and investors alike.
      </p>

      
    </div>

  </div>
</section>




    </div>


  <!-- Contact Sections-->

  <section class="bg-white px-6 py-24">
  <!-- Section Heading -->
  <div class="max-w-7xl mx-auto mb-12">
    <h1 class="family text-3xl font-bold text-[#73bc01] flex justify-center">
      CONTACT US 
    </h1>
  </div>

  <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-14 items-stretch">

    <!-- LEFT FORM -->
    <div class="border-2 border-blue-900 rounded-2xl p-10 flex flex-col justify-between bg-white shadow-sm">
      <div>
        <h2 class="text-4xl font-serif text-blue-900 mb-4">
          Book Site Visit <span class="uppercase text-green-600">Now !</span>
        </h2>

        <p class="text-gray-800 font-semibold mb-10">
          Take The First Step Towards Your Dream Home – Book Today!
        </p>

        <form class="space-y-6">

          <input
            type="text"
            placeholder="Name"
            class="w-full bg-white border-2 border-blue-200 rounded-lg px-5 py-4
                   focus:outline-none focus:border-green-500"
          />

          <input
            type="email"
            placeholder="Email"
            class="w-full bg-white border-2 border-blue-200 rounded-lg px-5 py-4
                   focus:outline-none focus:border-green-500"
          />

          <div class="flex items-center border-2 border-blue-200 rounded-lg px-4 py-3">
            <span class="mr-3">🇮🇳</span>
            <input
              type="tel"
              placeholder="Phone"
              class="bg-transparent w-full focus:outline-none"
            />
          </div>

          <label class="flex items-start gap-3 text-sm text-gray-700">
            <input type="checkbox" checked class="mt-1 accent-green-600" />
            I agree and authorize team to contact me. This will override the registry with DNC / NDNC
          </label>

          <div class="border border-blue-900 rounded-md p-4 max-w-xs">
            <div class="flex items-center gap-3">
              <input type="checkbox" class="w-5 h-5 accent-green-600">
              <span>I’m not a robot</span>
            </div>
            <p class="text-xs text-gray-500 mt-2">
              reCAPTCHA Privacy - Terms
            </p>
          </div>
        </form>
      </div>

      <div class="pt-10">
        <button
          class="font-semibold bg-green-600 text-white
                 hover:bg-green-500
                 px-14 py-3 rounded-md tracking-wide transition">
          SUBMIT
        </button>
      </div>
    </div>

    <!-- RIGHT CONTENT -->
    <div class="border-2 border-blue-900 rounded-2xl p-10  relative">
      <h2 class="text-4xl font-serif text-blue-900 mb-4">
        Unlock Your Dream Home!
      </h2>

      <p class="text-gray-800 font-semibold mb-12">
        Unlock a world of comfort and luxury in your dream home.
      </p>

      <div class="space-y-10">

        <div class="flex gap-5 items-start">
          <div class="w-12 h-12 rounded-full bg-green-600 flex items-center justify-center text-white">
            ✉
          </div>
          <div>
            <h4 class="text-xl font-serif text-blue-900">Send An Email</h4>
            <p class="text-blue-700">grantha@gmail.com</p>
          </div>
        </div>

        <div class="flex gap-5 items-start">
          <div class="w-12 h-12 rounded-full bg-green-600 flex items-center justify-center text-white">
            ☎
          </div>
          <div>
            <h4 class="text-xl font-serif text-blue-900">Give Us A Call</h4>
            <p class="text-blue-700">+91 9090909090</p>
          </div>
        </div>

        <div class="flex gap-5 items-start">
          <div class="w-12 h-12 rounded-full bg-green-600 flex items-center justify-center text-white">
            📍
          </div>
          <div>
            <h4 class="text-xl font-serif text-blue-900">Site Address</h4>
            <p class="text-blue-700 max-w-sm">
              comming soon
            </p>
          </div>
        </div>

      </div>
    </div>

  </div>
</section>




     <?php include "footer.php"; ?> 







  <!-- DOWNLOAD BROCHURE BUTTON (RIGHT SIDE) -->
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
           border border-[#73bc01]
           px-4 py-4
           rounded-l-md
           writing-mode-vertical
           tracking-widest
           font-semibold
           overflow-hidden">
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






  <script src="https://unpkg.com/flowbite@1.6.5/dist/flowbite.min.js"></script>
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

    // Side Brochure Button Ended

    // Autoslider for slider after galary


  // const slider = document.getElementById("slider");
  // const slides = document.querySelectorAll(".slide");
  // const dots = document.querySelectorAll(".dot");

  // let index = 0;
  // const visible = 4;
  // const total = slides.length / 2;

  // function updateSlider() {
  //   slider.style.transform = `translateX(-${index * (100 / visible)}%)`;

  //   slides.forEach(s => s.classList.remove("active"));
  //   const center = index + 1;
  //   slides[center]?.classList.add("active");

  //   dots.forEach(d => d.classList.remove("active"));
  //   dots[index % total]?.classList.add("active");
  // }

  // function autoScroll() {
  //   index++;

  //   if (index >= total) {
  //     setTimeout(() => {
  //       slider.style.transition = "none";
  //       index = 0;
  //       updateSlider();
  //       slider.offsetHeight;
  //       slider.style.transition = "transform 0.7s linear";
  //     }, 700);
  //   }

  //   updateSlider();
  // }

  // updateSlider();
  // setInterval(autoScroll, 2500);





  const backdrop = document.getElementById("modalBackdrop");
  const modalBox = document.getElementById("modalBox");
  const closeBtn = document.getElementById("closeModal");

  // OPEN MODAL
  function openModal() {
    backdrop.classList.remove("opacity-0", "pointer-events-none");
    modalBox.classList.remove("translate-y-24", "scale-95", "opacity-0");
  }

  // CLOSE MODAL
  function closeModal() {
    backdrop.classList.add("opacity-0", "pointer-events-none");
    modalBox.classList.add("translate-y-24", "scale-95", "opacity-0");
  }

  // SHOW MODAL ON EVERY PAGE LOAD
  window.addEventListener("load", () => {
    setTimeout(() => {
      openModal();
    }, 300); // small delay for smooth UX
  });

  // CLOSE BUTTON
  closeBtn.addEventListener("click", closeModal);

  // CLICK OUTSIDE TO CLOSE
  backdrop.addEventListener("click", (e) => {
    if (e.target === backdrop) closeModal();
  });





</script>

</body>

</html>