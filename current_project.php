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
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

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
        <?php foreach ($projects as $row): ?>

          <div class="bg-white rounded-xl shadow-md hover:shadow-lg transition h-full flex flex-col my-1">

            <div class="w-full aspect-[16/9] bg-gray-100 flex items-center justify-center">

              <?php if (!empty($row['project_image1'])): ?>
                <img
                  src="website/uploads/<?php echo $row['project_image1']; ?>"
                  alt="<?php echo $row['project_name']; ?>"
                  class="w-full h-full object-contain" />
              <?php else: ?>
                <span class="text-gray-400">No Image</span>
              <?php endif; ?>

            </div>

            <div class="p-6 flex flex-col flex-grow">
              <h3 class="text-lg font-semibold text-gray-800 mb-2">
                <?php echo strtoupper($row['project_name']); ?>
              </h3>

              <p class="text-gray-600 text-sm mb-4">
                <?php echo substr($row['project_details1'], 0, 120); ?>...
              </p>

              <a href="project_details.php?id=<?php echo $row['id']; ?>"
                class="mt-auto text-black font-medium hover:underline">
                Read More →
              </a>
            </div>

          </div>

        <?php endforeach; ?>



      </div>
    </div>
  </div>

  <?php include "footer.php"; ?>

</body>

</html>