<?php
include "website/conn.php";

if (!isset($_GET['id'])) {
  die("Project not found");
}

$id = $_GET['id'];

$stmt = $conn->prepare("SELECT * FROM project WHERE id = :id");
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();

$project = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$project) {
  die("Invalid Project");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Project Details</title>
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
        <?php echo strtoupper($project['project_name']); ?> :
      </h1>

      <div class="space-y-20">

        <!-- SECTION 1 -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-10 items-center">

          <div>
            <?php 
$project_details1 = explode("/*/*/", $project['project_details1']);
// print_r($project_details1);exit;
            ?>
            <h2 class="text-2xl font-bold py-2"><?= $project_details1[0]; ?></h2>
            
            <p class="text-gray-700 leading-relaxed text-base sm:text-lg md:text-lg">
              <?php echo $project_details1[1]; ?>
            </p>
          </div>

          <?php if (!empty($project['project_image1'])): ?>
            <div class="transition-transform duration-500 hover:scale-105 rounded-2xl overflow-hidden shadow-2xl">
              <img
                src="website/uploads/<?php echo $project['project_image1']; ?>"
                class="w-full h-[450px] object-contain"
                alt="">
            </div>
          <?php endif; ?>

        </div>

        <!-- SECTION 2 -->
         <?php if (!empty($project['project_image2']) || !empty($project['project_details2'])): ?>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-10 items-center">

          <?php if (!empty($project['project_image2'])): ?>
            <div class="transition-transform duration-500 hover:scale-105 rounded-2xl overflow-hidden shadow-2xl">
              <img
                src="website/uploads/<?php echo $project['project_image2']; ?>"
                class="w-full h-[450px] object-contain"
                alt="">
            </div>
          <?php endif; ?>

          <div>
            <?php
            $project_details2 = explode("/*/*/", $project['project_details2']);
             ?>
             <h2 class="text-2xl font-bold py-2"><?= $project_details2[0]; ?></h2>
            <p class="text-gray-700 leading-relaxed text-base sm:text-lg md:text-lg">
              <?php echo $project_details2[1]; ?>
            </p>
          </div>
        </div>

        <?php endif; ?>
        
        <!-- SECTION 3 -->
         <?php if (!empty($project['project_image3']) || !empty($project['project_details3'])): ?>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-10 items-center">

         

          <div>
             <?php
            $project_details3 = explode("/*/*/", $project['project_details3']);
             ?>
             <h2 class="text-2xl font-bold py-2"><?= $project_details3[0]; ?></h2>
            <p class="text-gray-700 leading-relaxed text-base sm:text-lg md:text-lg">
              <?php echo $project_details3[1]; ?>
            </p>
          </div>
           <?php if (!empty($project['project_image2'])): ?>
            <div class="transition-transform duration-500 hover:scale-105 rounded-2xl overflow-hidden shadow-2xl">
              <img
                src="website/uploads/<?php echo $project['project_image3']; ?>"
                class="w-full h-[450px] object-contain"
                alt="">
            </div>
          <?php endif; ?>
        </div> 

        <?php endif; ?>

        

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
      <path d="M19.11 17.2c-.28-.14-1.65-.81-1.91-.9-.26-.09-.45-.14-.64.14-.19.28-.73.9-.9 1.08-.17.19-.34.21-.62.07-.28-.14-1.19-.44-2.27-1.4-.84-.75-1.4-1.67-1.57-1.95-.17-.28-.02-.43.13-.57z" />
      <path d="M16 2.67C8.64 2.67 2.67 8.64 2.67 16c0 7.36 5.97 13.33 13.33 13.33S29.33 23.36 29.33 16 23.36 2.67 16 2.67z" />
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