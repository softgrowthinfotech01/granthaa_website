<?php
include "website/conn.php";

$stmt = $conn->prepare("SELECT * FROM project WHERE project_status = 'Upcoming' ");
$stmt->execute();
$projects = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>

</head>

<body>
  <?php include "header.php"; ?>



  <div class="min-h-screen flex items-center justify-center px-4">
    <div class="max-w-7xl w-full">
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <!-- Card 1 -->
        <!-- <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition">
        <img
          src="https://via.placeholder.com/400x250"
          alt="Card Image"
          class="w-full h-48 object-cover"
        />
        <div class="p-6 flex flex-col h-full">
          <h3 class="text-lg font-semibold text-gray-800 mb-2">
            Card Title One
          </h3>
          <p class="text-gray-600 text-sm mb-4">
            This is a short description for the first card. You can explain your
            service, feature, or content here.
          </p>
          <a href="#" class="mt-auto text-indigo-600 font-medium hover:underline">
            Read More →
          </a>
        </div>
      </div> -->

        <!-- Card 2 -->
        <!-- <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition">
        <img
          src="https://via.placeholder.com/400x250"
          alt="Card Image"
          class="w-full h-48 object-cover"
        />
        <div class="p-6 flex flex-col h-full">
          <h3 class="text-lg font-semibold text-gray-800 mb-2">
            Card Title Two
          </h3>
          <p class="text-gray-600 text-sm mb-4">
            Use this card to highlight another feature, blog post, or product.
            Keep the content simple and readable.
          </p>
          <a href="#" class="mt-auto text-indigo-600 font-medium hover:underline">
            Read More →
          </a>
        </div>
      </div> -->

        <!-- Card 3 -->
        <!-- <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition">
        <img
          src="https://via.placeholder.com/400x250"
          alt="Card Image"
          class="w-full h-48 object-cover"
        />
        <div class="p-6 flex flex-col h-full">
          <h3 class="text-lg font-semibold text-gray-800 mb-2">
            Card Title Three
          </h3>
          <p class="text-gray-600 text-sm mb-4">
            Perfect for portfolio items, services, or promotions. Tailwind keeps
            everything responsive by default.
          </p>
          <a href="#" class="mt-auto text-indigo-600 font-medium hover:underline">
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