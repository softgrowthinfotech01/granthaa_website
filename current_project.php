<?php
include "website/conn.php";

$stmt = $conn->prepare("SELECT * FROM project WHERE project_status = 'Current' ");
$stmt->execute();
$projects = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Projects</title>

  <!-- Tailwind CDN -->
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>

  <?php include "header.php"; ?>

  <div class="min-h-screen flex items-center justify-center px-4">
    <div class="max-w-7xl w-full">
      <div class="grid grid-cols-1 md:grid-cols-3 gap-10 mt-24 md:mt-[180px] lg:mt-[180px] mb-10">

        <!-- Card 1 -->
        <!-- <div class="bg-white rounded-xl shadow-md hover:shadow-lg transition h-full flex flex-col">
          <div class="w-full aspect-[16/9] bg-gray-100 flex items-center justify-center">
            <img
              src="images/infinity park.jpeg"
              alt="Infinity Park"
              class="w-full h-full object-contain" />
          </div>
          <div class="p-6 flex flex-col flex-grow">
            <h3 class="text-lg font-semibold text-gray-800 mb-2">
              INFINITY PARK
            </h3>
            <p class="text-gray-600 text-sm mb-4">
              Infinity Park is a beautifully designed green space that enhances the
              overall lifestyle experience within the project.
            </p>
            <a href="infinity_park" class="mt-auto text-black font-medium hover:underline">
              Read More →
            </a>
          </div>
        </div> -->

        <!-- Card 2 -->
        <!-- <div class="bg-white rounded-xl shadow-md hover:shadow-lg transition h-full flex flex-col">
          <div class="w-full aspect-[16/9] bg-gray-100 flex items-center justify-center">
            <img
              src="images/Shobha residency plan.jpeg"
              alt="Shobhaa Residency"
              class="w-full h-full object-contain" />
          </div>
          <div class="p-6 flex flex-col flex-grow">
            <h3 class="text-lg font-semibold text-gray-800 mb-2">
              SHOBHAA RESIDENCY
            </h3>
            <p class="text-gray-600 text-sm mb-4">
              Shobhaa Residency is a premium residential plot development created for those
              who value location, quality planning, and smart investment opportunities.
            </p>
            <a href="shobhaa_resi" class="mt-auto text-black font-medium hover:underline">
              Read More →
            </a>
          </div>
        </div> -->

        <!-- Card 3 -->
        <!-- <div class="bg-white rounded-xl shadow-md hover:shadow-lg transition h-full flex flex-col">
          <div class="w-full aspect-[16/9] bg-gray-100 flex items-center justify-center">
            <img
              src="images/facilities.png"
              alt="DSK Project"
              class="w-full h-full object-contain" />
          </div>
          <div class="p-6 flex flex-col flex-grow">
            <h3 class="text-lg font-semibold text-gray-800 mb-2">
              D.S.K
            </h3>
            <p class="text-gray-600 text-sm mb-4">
              D.S.K. RadhaKrishna Nagari offers thoughtfully planned amenities designed
              to give you comfort, convenience, and long-term value.
            </p>
            <a href="dsk" class="mt-auto text-black font-medium hover:underline">
              Read More →
            </a>
          </div>
        </div> -->

        <!-- Dynamic Cards -->
        <?php if (count($projects) > 0): ?>

          <?php foreach ($projects as $row): ?>

            <div class="bg-white rounded-xl shadow-md hover:shadow-lg transition h-full flex  flex-col my-1 transition-transform duration-500 ease-in-out
                hover:scale-105">

              <div class="w-full aspect-[16/9] bg-gray-100 flex items-center justify-center">

                <?php if (!empty($row['project_image1'])): ?>
                  <img
                    src="website/uploads/<?php echo $row['project_image1']; ?>"
                    alt="<?php echo $row['project_name']; ?>"
                    class="w-full h-full object-contain rounded-xl" />
                <?php else: ?>
                  <span class="text-gray-400">No Image</span>
                <?php endif; ?>

              </div>

              <div class="p-6 flex flex-col flex-grow">
                <h3 class="text-lg font-semibold text-gray-800 mb-2">
                  <?php echo strtoupper($row['project_name']); ?>
                </h3>

                <p class="text-gray-600 text-sm mb-4">
                  <?php
                  $text = $row['project_details1'] ?? '';
                  $cleanText = str_replace('/*/*/', '', $text);

                  if (strlen($cleanText) > 120) {
                    echo substr($cleanText, 0, 120) . '...';
                  } else {
                    echo $cleanText;
                  }
                  ?>
                </p>

                <a href="project_details.php?id=<?php echo $row['id']; ?>"
                  class="mt-auto text-black font-medium hover:underline">
                  Read More →
                </a>
              </div>

            </div>

          <?php endforeach; ?>
        <?php else: ?>

          <div class="col-span-3 text-center py-20">
            <h2 class="text-2xl font-semibold text-gray-500">Coming Soon</h2>
          </div>

        <?php endif; ?>


      </div>
    </div>
  </div>

  <?php include "footer.php"; ?>

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