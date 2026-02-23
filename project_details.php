
<?php
include "website/conn.php";

if (!isset($_GET['id'])) {
  die("Project not found");
}

$id = (int) $_GET['id'];

$stmt = $conn->prepare("SELECT * FROM project WHERE id = :id");
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();

$project = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$project) {
  die("Invalid Project");
}

/* ---------- KEEPING EXPLODE (SAFE) ---------- */
$project_details1 = explode("/*/*/", $project['project_details1'] ?? '');
$title1 = $project_details1[0] ?? '';
$desc1  = $project_details1[1] ?? '';

$project_details2 = explode("/*/*/", $project['project_details2'] ?? '');
$title2 = $project_details2[0] ?? '';
$desc2  = $project_details2[1] ?? '';

$project_details3 = explode("/*/*/", $project['project_details3'] ?? '');
$title3 = $project_details3[0] ?? '';
$desc3  = $project_details3[1] ?? '';
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
    <h1 class="text-2xl sm:text-3xl font-bold text-blue-900 border-l-4 border-green-500 pl-4 mb-12">
      <?= strtoupper(htmlspecialchars($project['project_name'])); ?> :
    </h1>

    <div class="space-y-20">

      <!-- SECTION 1 -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-10 items-center">

        <div>
          <h2 class="text-2xl font-bold py-2">
            <?= htmlspecialchars($title1); ?>
          </h2>

          <p class="text-gray-700 leading-relaxed text-base sm:text-lg md:text-lg">
            <?= htmlspecialchars($desc1); ?>
          </p>
        </div>

        <?php if (!empty($project['project_image1'])): ?>
        <div class="transition-transform duration-500 hover:scale-105 rounded-2xl overflow-hidden shadow-2xl">
          <img
            src="website/uploads/<?= htmlspecialchars($project['project_image1']); ?>"
            class="w-full h-[450px] object-contain"
            alt="">
        </div>
        <?php endif; ?>

      </div>

      <!-- SECTION 2 -->
      <?php if (!empty($project['project_image2']) || !empty($title2) || !empty($desc2)): ?>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-10 items-center">

        <?php if (!empty($project['project_image2'])): ?>
        <div class="transition-transform duration-500 hover:scale-105 rounded-2xl overflow-hidden shadow-2xl">
          <img
            src="website/uploads/<?= htmlspecialchars($project['project_image2']); ?>"
            class="w-full h-[450px] object-contain"
            alt="">
        </div>
        <?php endif; ?>

        <div>
          <h2 class="text-2xl font-bold py-2">
            <?= htmlspecialchars($title2); ?>
          </h2>

          <p class="text-gray-700 leading-relaxed text-base sm:text-lg md:text-lg">
            <?= htmlspecialchars($desc2); ?>
          </p>
        </div>

      </div>
      <?php endif; ?>

      <!-- SECTION 3 -->
      <?php if (!empty($project['project_image3']) || !empty($title3) || !empty($desc3)): ?>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-10 items-center">

        <div>
          <h2 class="text-2xl font-bold py-2">
            <?= htmlspecialchars($title3); ?>
          </h2>

          <p class="text-gray-700 leading-relaxed text-base sm:text-lg md:text-lg">
            <?= htmlspecialchars($desc3); ?>
          </p>
        </div>

        <?php if (!empty($project['project_image3'])): ?>
        <div class="transition-transform duration-500 hover:scale-105 rounded-2xl overflow-hidden shadow-2xl">
          <img
            src="website/uploads/<?= htmlspecialchars($project['project_image3']); ?>"
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

<script>
const brochureBtn = document.getElementById("brochureBtn");

window.addEventListener("scroll", () => {
  brochureBtn.classList.toggle("opacity-0", window.scrollY < 200);
  brochureBtn.classList.toggle("pointer-events-none", window.scrollY < 200);
});
</script>

</body>
</html>
```
