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
      <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition">
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
      </div>

      <!-- Card 2 -->
      <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition">
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
      </div>

      <!-- Card 3 -->
      <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition">
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
      </div>

    </div>
  </div>
</div>

 <?php include "footer.php"; ?> 

</body>
</html>