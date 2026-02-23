<?php
include "website/conn.php";

$stmt = $conn->prepare("SELECT * FROM project WHERE project_status='Current'");
$stmt->execute();
$projects = $stmt->fetchAll(PDO::FETCH_ASSOC);


// print_r($_POST['send']);exit;
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Granthaa Developer Pvt Ltd | Plots, Flats & Land for Sale in Chandrapur</title>
  <meta name="description" content="Granthaa Developer Pvt Ltd offers trusted property solutions in Chandrapur. Buy, sell, or resell plots, flats, and land in Chandrapur and nearby areas with expert guidance and transparent deals.">
  <meta name="author" content="Granthaa Developer Pvt Ltd, Chandrapur">
  <meta name="keywords" content="Granthaa Developer, Chandrapur real estate, plots for sale in Chandrapur, flats in Chandrapur, land for sale Chandrapur, property dealer Chandrapur, land resale Chandrapur, real estate developer Chandrapur">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

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

    /* .same-indicator {
    @apply w-2.5 h-2.5 sm:w-3 sm:h-3 md:w-4 md:h-4
           rounded-full bg-black/70 border border-[#73bc01]
           transition-all duration-300
           hover:bg-[#73bc01]
           aria-[current=true]:scale-125
           aria-[current=true]:bg-[#73bc01];
  } */

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

    /* Root carousel wrapper */
    .project-carousel {
      --carousel-item-width: 340px;
      --carousel-item-gap: 30px;
      --carousel-duration: 28s;

      position: relative;
      width: 100%;
      max-width: 1200px;
      height: 380px;
      overflow: hidden;
      margin: auto;
    }

    /* Mask (optional fade edges) */
    .project-carousel-mask {
      position: absolute;
      inset: 0;
      pointer-events: none;
      z-index: 5;
    }

    /* Inner container */
    .project-carousel-inner {
      position: relative;
      height: 100%;
    }

    /* Each card */
    .project-carousel-item {
      position: absolute;
      animation: project-carousel-slide var(--carousel-duration) linear infinite;
    }

    /* Animation */
    @keyframes project-carousel-slide {
      from {
        transform: translateX(0);
      }

      to {
        transform: translateX(calc(-1 * (var(--carousel-item-width) + var(--carousel-item-gap)) * var(--items)));
      }
    }

    /* Pause on hover */
    .project-carousel:hover .project-carousel-item {
      animation-play-state: paused;
    }

    /* Responsive */
    @media (max-width: 768px) {
      .project-carousel {
        --carousel-item-width: 220px;
        height: 280px;
      }
    }

    @media (max-width: 480px) {
      .project-carousel {
        --carousel-item-width: 200px;
        height: 260px;
      }
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
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>

</head>

<body class="bg-transparent">

  <?php include "header.php"; ?>


  <!-- slider start -->
  <div id="default-carousel"
    class="relative w-full
            h-[260px] sm:h-[360px] md:h-[500px] lg:h-[650px] xl:h-[700px]"
    data-carousel="slide">

    <!-- Carousel wrapper -->
    <div class="relative h-full overflow-hidden">

      <div class="hidden duration-700 ease-in-out h-full" data-carousel-item>
        <img src="images/GLDimg1.webp"
          class="absolute w-full h-full object-cover">
      </div>

      <div class="hidden duration-700 ease-in-out h-full" data-carousel-item>
        <img src="images/GLDimg2.webp"
          class="absolute w-full h-full object-cover">
      </div>

      <div class="hidden duration-700 ease-in-out h-full" data-carousel-item>
        <img src="images/GLDimg3.webp"
          class="absolute w-full h-full object-cover">
      </div>

      <div class="hidden duration-700 ease-in-out h-full" data-carousel-item>
        <img src="images/GLDimg4.webp"
          class="absolute w-full h-full object-cover">
      </div>

      <div class="hidden duration-700 ease-in-out h-full" data-carousel-item>
        <img src="images/GLDimg5.webp"
          class="absolute w-full h-full object-cover">
      </div>

    </div>

    <!-- INDICATORS -->
    <!-- <div class="absolute z-30 bottom-4 sm:bottom-6
              left-1/2 -translate-x-1/2 flex gap-2 sm:gap-3">

    <button data-carousel-slide-to="0"
      class="w-2.5 h-2.5 sm:w-3 sm:h-3 md:w-4 md:h-4
             rounded-full bg-black/70 border border-[#73bc01]
             transition-all duration-300
             hover:bg-[#73bc01]
             aria-[current=true]:scale-125
             aria-[current=true]:bg-[#73bc01]"></button>

    <button data-carousel-slide-to="1" class="same-indicator"></button>
    <button data-carousel-slide-to="2" class="same-indicator"></button>
    <button data-carousel-slide-to="3" class="same-indicator"></button>
    <button data-carousel-slide-to="4" class="same-indicator"></button>
  </div> -->

    <!-- PREV -->
    <button type="button"
      class="absolute left-2 sm:left-4 top-1/2 -translate-y-1/2 z-30
           w-8 h-8 sm:w-10 sm:h-10 md:w-14 md:h-14
           rounded-full bg-black/70 backdrop-blur
           flex items-center justify-center
           border border-[#73bc01]
           hover:scale-110 transition-all"
      data-carousel-prev>
      <span class="text-[#73bc01] text-2xl sm:text-3xl md:text-5xl mb-1 md:mb-3 leading-none">‹</span>
    </button>

    <!-- NEXT -->
    <button type="button"
      class="absolute right-2 sm:right-4 top-1/2 -translate-y-1/2 z-30
           w-8 h-8 sm:w-10 sm:h-10 md:w-14 md:h-14
           rounded-full bg-black/70 backdrop-blur
           flex items-center justify-center
           border border-[#73bc01]
           hover:scale-110 transition-all"
      data-carousel-next>
      <span class="text-[#73bc01] text-2xl sm:text-3xl md:text-5xl mb-1 md:mb-3 leading-none">›</span>
    </button>

  </div>

  <!-- slider end -->
  <div class=" bg-white ">

    <!-- Header -->
    <div class="text-center pt-15 pb-16">
      <!-- <h1 class="family text-5xl md:text-6xl font-Bold-700-Italic text-[#73bc01]">
        Gallery      </h1> -->
      <p class="yeseva mt-10 text-black text-3xl  ">
        Explore Our Gallery And Experience The Beauty In Every Detail
      </p>
    </div>

    <div class="max-w-7xl mx-auto px-1 ">
      <div class="grid grid-cols-1 md:grid-cols-3 gap-5 items-center">

        <!-- Left Card -->
        <div class="bg-black
            text-black max-w-lg  rounded-3xl p-10 shadow-lg
            animate-bounce
            [animation-duration:4s]
            [animation-timing-function:ease-in-out]
            transition-all duration-700 hover:scale-[1.02] mt-12 ">

          <h2 class="ubuntu text-3xl text-white mb-4 transition-colors duration-500">
            Visualise Your <span class="ml-[60px]"> Dream Home.</span>
          </h2>

          <p class="text-gray-400 font-semibold mb-8 transition-colors duration-500">
            Turn Your Dreams Into A Home You'll Love.
          </p>

          <a
            href="contact"
            class="inline-block jersey bg-transparent text-[#73bc01]
         border border-[#73bc01] font-semibold ml-7
         px-8 py-3 rounded-lg
         transition-all duration-500 ease-in-out
         hover:bg-[#73bc01] hover:text-black
         hover:scale-105 hover:shadow-lg">
            Schedule A Site Visit
          </a>

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

        <a
          href="contact.php"
          class="inline-block jersey font-semibold bg-transparent
         border border-[#73bc01] text-[#73bc01]
         hover:bg-[#73bc01] hover:text-black
         px-8 py-3 rounded-md transition duration-300">
          Enquire Now
        </a>

      </div>
    </div>
  </section>





  <!-- ABOUT SECTION -->
  <section class="bg-white mx-auto px-6 py-8 mt-[80px]">
    <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-16 items-center">

      <!-- LEFT IMAGE -->
      <div class="relative rounded-2xl transition-transform duration-500 ease-in-out
                hover:scale-105 overflow-hidden shadow-2xl">
        <img
          src="images/plot booking.jpeg"
          alt="Premium Plot Development"
          class="w-full h-[450px] rounded-lg
      " />
        <span class="absolute top-0 right-0 w-80 h-[7px] bg-[#73bc01] "></span>
        <span class="absolute top-0 right-0 w-[7px] h-80 bg-[#73bc01] "></span>

        <!-- Bottom Left Blue -->
        <span class="absolute bottom-0 left-0 w-80 h-[7px] bg-blue-800"></span>
        <span class="absolute bottom-0 left-0 w-[7px] h-80 bg-blue-800"></span>
      </div>

      <!-- RIGHT CONTENT -->
      <div class="space-y-6">
        <h2 class="family text-[#73bc01]  font-bold text-2xl md:text-4xl  ">
          About Us
        </h2>

        <p class="text-lg text-gray-700 leading-relaxed text-justify">
          We specialize in premium plot developments designed for those who value
          location, long-term growth, and lifestyle excellence. Every project is
          carefully planned to ensure legal clarity, superior infrastructure,
          and future-ready living.
        </p>

        <p class="text-lg text-gray-700 leading-relaxed text-justify">
          Our developments combine modern planning with nature-friendly layouts,
          offering well-connected roads, open spaces, and a secure investment
          environment for families and investors alike.
        </p>
        <p class="text-lg text-gray-700 leading-relaxed text-justify">
          Each of our communities is thoughtfully crafted to enhance the quality
          of life, blending convenience with tranquility. From landscaped parks and
          recreational areas to essential amenities within easy reach, we ensure a
          harmonious balance between urban comforts and natural serenity. By prioritizing
          sustainability, safety, and aesthetic appeal, our developments provide not just
          a plot, but a lifestyle that grows in value and prestige over time.</p>
      </div>

    </div>
  </section>


  <section>
    <div class="bg-white">

      <div class="max-w-7xl mx-auto px-4">

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10 items-center">

          <!-- LEFT CARD -->
          <div class="bg-black w-full max-w-sm mx-auto lg:mx-0 rounded-3xl p-5 shadow-lg mb-5 lg:ml-10 flex flex-col items-center text-center">

            <h2 class="ubuntu text-3xl text-white mb-4">
              Our Projects
            </h2>

            <p class="text-gray-400 font-semibold mb-8">
              Building Homes That Match Your Dreams
            </p>

            <a href="contact"
              class="jersey bg-transparent text-[#73bc01] border border-[#73bc01] font-semibold w-60 px-6 py-2 rounded-lg transition-all duration-500 hover:bg-[#73bc01] hover:text-black hover:scale-105">
              Schedule A Site Visit
            </a>

          </div>

          <!-- RIGHT CAROUSEL -->
          <div class="  lg:col-span-2 relative w-full max-w-full lg:max-w-[745px] mx-auto lg:ml-20 rounded-2xl py-4">

            <div class="project-carousel mx-auto"
              style="--items: <?php echo max(count($projects), 1); ?>;">

              <div class="project-carousel-mask"></div>

              <div class="project-carousel-inner relative min-h-[420px]">

                <?php if (count($projects) > 0): ?>
                  <?php $i = 0; ?>

                  <?php foreach ($projects as $row): ?>

                    <article
                      class="project-carousel-item absolute top-0 bg-white rounded-xl border border-gray-200 shadow-sm transition-transform duration-500 hover:scale-105 flex flex-col min-h-[380px] pb-12 sm:pb-4"

                      style="
                              left: calc(100% + var(--carousel-item-gap));
                              width: var(--carousel-item-width);
                              animation-delay: calc(var(--carousel-duration)/var(--items)*<?php echo $i; ?>*-1);
                              ">

                      <!-- IMAGE -->
                      <div class="w-full h-[200px] bg-gray-100 shrink-0">

                        <?php if (!empty($row['project_image1'])): ?>
                          <img
                            src="website/uploads/<?php echo $row['project_image1']; ?>"
                            alt="<?php echo $row['project_name']; ?>"
                            class="w-full h-full object-cover" />
                        <?php else: ?>
                          <span class="flex h-full items-center justify-center text-gray-400">
                            No Image
                          </span>
                        <?php endif; ?>

                      </div>

                      <!-- CONTENT -->
                      <div class="p-4 flex flex-col flex-1">

                        <h3 class="text-sm font-semibold mb-1">
                          <?php echo strtoupper($row['project_name']); ?>
                        </h3>

                        <p class=" hidden sm:block text-xs text-gray-600 mb-2 ">
                          <?php echo substr($row['project_details1'], 0, 80); ?>...
                        </p>

                        <a
                          href="project_details.php?id=<?php echo $row['id']; ?>"
                          class="mt-1 mb-6 md:mt-[65px] text-sm font-medium text-black underline">
                          Read More →
                        </a>

                      </div>

                    </article>

                    <?php $i++; ?>
                  <?php endforeach; ?>
                <?php endif; ?>

              </div>
            </div>

          </div>

        </div>
      </div>
    
    </div>
  </section>


  <!-- Contact Sections-->
<?php
include "website/conn.php";

$errors = [];

if (isset($_POST['submit'])) {

  // Trim inputs
  $name  = trim($_POST['name'] ?? '');
  $email = trim($_POST['email'] ?? '');
  $phone = trim($_POST['number'] ?? '');
  $agree = $_POST['agree'] ?? '';
  $response = $_POST['g-recaptcha-response'] ?? '';

  /* ======================
     BASIC VALIDATIONS
  =======================*/

  if (empty($name)) {
    $errors['name'] = "Name is required";
  }

  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = "Enter valid email";
  }

  if (!preg_match('/^[0-9]{10}$/', $phone)) {
    $errors['phone'] = "Enter valid 10 digit mobile";
  }

  if (!$agree) {
    $errors['agree'] = "You must agree before submitting";
  }

  if (!$response) {
    $errors['captcha'] = "Captcha required";
  }

  /* ======================
     CAPTCHA VERIFY
  =======================*/

  if (empty($errors)) {

    $secretKey = "6Lf45GcsAAAAAP8NfLwWSmj14LTXgSqQuuZ6-tTM";

    $verify = file_get_contents(
      "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$response"
    );

    $captcha = json_decode($verify);

    if (!$captcha->success) {
      $errors['captcha'] = "Captcha failed";
    }
  }

  /* ======================
     INSERT IF NO ERRORS
  =======================*/

  if (empty($errors)) {

    $stmt = $conn->prepare("
      INSERT INTO contact(name,email,phone)
      VALUES(:name,:email,:phone)
    ");

    $stmt->execute([
      ':name' => htmlspecialchars($name),
      ':email' => htmlspecialchars($email),
      ':phone' => htmlspecialchars($phone)
    ]);

    header("Location: home.php");
    exit;
  }
}
?>
  <section class="bg-white px-6 py-20">
    <!-- Section Heading -->
    <div class="max-w-7xl mx-auto mb-12">
      <h1 class="family text-3xl font-bold text-[#73bc01] flex justify-center">
        CONTACT US
      </h1>
    </div>

    <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-14 items-stretch">

      <!-- LEFT FORM -->
      <div class="border-2 border-blue-900 rounded-2xl p-10 flex flex-col justify-between bg-white transition-transform duration-500 ease-in-out
                hover:scale-105 shadow-sm">
        <div>
          <h2 class="text-4xl font-serif text-blue-900 mb-4">
            Book Site Visit <span class="uppercase text-green-600">Now !</span>
          </h2>

          <p class="text-gray-800 font-semibold mb-10">
            Take The First Step Towards Your Dream Home – Book Today!
          </p>

          <form method="post" class="space-y-6">

            <input
          type="text"
          placeholder="Name" required
          name="name"
          class="w-full px-4 py-2.5 sm:py-3
               rounded-lg border border-blue-300
               focus:ring-2 focus:ring-blue-500 outline-none" />

       <input
  type="email"
  name="email"
  placeholder="Email"
  required
  pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$"
  title="Enter valid email address"
  class="w-full bg-white border-2 border-blue-200 rounded-lg px-5 py-4
         focus:outline-none focus:border-green-500"
/>
                  <?php if (!empty($errors['email'])): ?>
<small style="color:red;"><?php echo $errors['email']; ?></small>
<?php endif; ?>

        <div class="flex items-center border-2 border-blue-200 rounded-lg px-4 py-3">
              <span class="mr-3">🇮🇳</span>
              <input
                type="tel"
                name="number"
                placeholder="Phone"
                maxlength="10"
                pattern="[0-9]{10}"
                oninput="this.value=this.value.replace(/[^0-9]/g,'').slice(0,10)"
                required
                class="bg-transparent w-full focus:outline-none"
              />
                <?php if (!empty($errors['phone'])): ?>
<small style="color:red;"><?php echo $errors['phone']; ?></small>
<?php endif; ?>

            </div>


<label class="flex items-start gap-3 text-sm text-gray-700">
  <input
    type="checkbox"
    name="agree"
    value="1"
    class="mt-1 accent-green-600"
    <?php if (!empty($_POST['agree'])) echo 'checked'; ?>
  />
  I agree and authorize team to contact me. This will override the register with us.
</label>

<?php if (!empty($errors['agree'])): ?>
  <small style="color:red;"><?php echo $errors['agree']; ?></small>
<?php endif; ?>

            <div class="g-recaptcha" data-sitekey="6Lf45GcsAAAAAIDRQ-udUFSe_D_KMi4a1vmwEfnd"></div>

            <div class="pt-10">
              <button name="submit"
                class="font-semibold bg-[#73bc01] text-white
                 hover:bg-green-500
                 px-14 py-3 rounded-md tracking-wide transition">
                SUBMIT
              </button>
            </div>
          </form>
        </div>


      </div>

      <!-- RIGHT CONTENT -->
      <div class="border-2 border-blue-900 rounded-2xl p-10  relative transition-transform duration-500 ease-in-out
                hover:scale-105 shadow-sm">
        <h2 class="text-4xl font-serif text-blue-900 mb-4">
          Unlock Your Dream Home!
        </h2>

        <p class="text-gray-800 font-semibold mb-12">
          Unlock a world of comfort and luxury in your dream home.
        </p>

        <div class="space-y-10">

          <div class="flex gap-5 items-start">
            <div class="w-12 h-12 rounded-full bg-[#73bc01] flex items-center justify-center text-white">
              ✉
            </div>
            <div>
              <h4 class="text-xl font-serif text-blue-900">Send An Email</h4>
              <p class="text-blue-700">email id : info@granthaadeveloperpvtltd.com</p>
            </div>
          </div>

          
          <div class="flex gap-5 items-start">
            <div class="w-12 h-12 rounded-full bg-[#73bc01] flex items-center justify-center text-white">
              ☎
            </div>
            <div>
              <h4 class="text-xl font-serif text-blue-900">Give Us A Call</h4>
              <p class="text-blue-700">+91 9975086229 , +91 8975280850</p>
            </div>
          </div>

          <div class="flex gap-5 items-start">
            <div class="w-12 h-12 rounded-full bg-[#73bc01] flex items-center justify-center text-white">
              📍
            </div>
            <div>
              <h4 class="text-xl font-serif text-blue-900">Site Address</h4>
              <p class="text-blue-700 max-w-sm">
                Near ram setu bridge, devki complex, Chandrapur.
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

<!-- Enquiry Form -->
  <div
    id="modalBackdrop"
    class="fixed inset-0 z-50 flex items-center justify-center
         bg-black/60 px-4
         opacity-0 pointer-events-none
         transition-opacity duration-300">
    <!-- MODAL -->
    <div
      id="modalBox"
      class="relative w-full max-w-sm sm:max-w-md
           bg-white rounded-2xl shadow-2xl
           border-2 border-blue-600
           p-4 sm:p-6
           transform translate-y-24 scale-95 opacity-0
           transition-all duration-300 ease-out">

      <!-- CLOSE -->
      <button
        id="closeModal"
        class="absolute top-3 right-3 text-blue-600
             hover:text-red-500 text-2xl font-bold">
        ✕
      </button>

      <!-- HEADER -->
      <div class="text-center mb-5">
        <h2 class="text-xl sm:text-2xl font-bold text-blue-700">
          Call Us <span class="text-[#73bc01]">+91 9975086229</span>
          </br><span class="text-[#73bc01]">
            +91 8975280850</span>
        </h2>

        <p class="text-xs text-gray-500 mt-1">OR</p>

        <h3 class="text-lg sm:text-xl font-semibold text-blue-700 mt-1">
          Enquire Now!
        </h3>

        <p class="text-sm text-gray-600 mt-3">
          Take the first step towards your dream home —
          <span class="font-semibold text-[#73bc01]">book today!</span>
        </p>
      </div>

      <!-- FORM -->
      <form method="post" action="modal.php" class="space-y-3 sm:space-y-4">

        <input
          type="text"
          placeholder="Name" required
          name="name"
          class="w-full px-4 py-2.5 sm:py-3
               rounded-lg border border-blue-300
               focus:ring-2 focus:ring-blue-500 outline-none" />

        <input
              type="email"
              placeholder="Email" name="email" required
              class="w-full bg-white border-2 border-blue-200 rounded-lg px-5 py-4
                   focus:outline-none focus:border-green-500" />
                  <?php if (!empty($errors['email'])): ?>
<small style="color:red;"><?php echo $errors['email']; ?></small>
<?php endif; ?>

        <div class="flex items-center border-2 border-blue-200 rounded-lg px-4 py-3">
              <span class="mr-3">🇮🇳</span>
              <input
                type="tel"
                name="number"
                placeholder="Phone"
                maxlength="10"
                pattern="[0-9]{10}"
                oninput="this.value=this.value.replace(/[^0-9]/g,'').slice(0,10)"
                required
                class="bg-transparent w-full focus:outline-none"
              />
                <?php if (!empty($errors['phone'])): ?>
<small style="color:red;"><?php echo $errors['phone']; ?></small>
<?php endif; ?>

            </div>


       <label class="flex items-start gap-3 text-sm text-gray-700">
  <input
    type="checkbox"
    name="agree"
    value="1"
    class="mt-1 accent-green-600"
    <?php if (!empty($_POST['agree'])) echo 'checked'; ?>
  />
  I agree and authorize team to contact me. This will override the register with us.
</label>

<?php if (!empty($errors['agree'])): ?>
  <small style="color:red;"><?php echo $errors['agree']; ?></small>
<?php endif; ?>

        <!-- CAPTCHA MOCK -->
        <div class="g-recaptcha" data-sitekey="6Lf45GcsAAAAAIDRQ-udUFSe_D_KMi4a1vmwEfnd"></div>


        <button
          type="submit"
          name="send"
          class="w-full bg-[#73bc01] hover:bg-green-700
               text-white  py-2.5 sm:py-3
               rounded-lg font-semibold tracking-wide
               transition">
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
      }, 100); // small delay for smooth UX
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