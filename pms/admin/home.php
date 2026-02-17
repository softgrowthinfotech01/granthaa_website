<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="keywords" content="tailwind,tailwindcss,tailwind css,css,starter template,free template,admin templates, admin template, admin dashboard, free tailwind templates, tailwind example">
    <!-- Css -->
    <link rel="stylesheet" href="../style.css">
    <title>Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.css" rel="stylesheet" />

</head>

<body>
    <!--Container -->
    <div class="mx-auto">
        <!--Screen-->
        <div class="flex flex-col">
            <!--Header Section Starts Here-->
            <?php include "header.php"; ?>
            <!--/Header-->

            <div class="flex">
                <!--Sidebar-->
                <?php include 'sidebar.php'; ?>
                <!--/Sidebar-->

                <!--Main-->
                <div class="w-[80%] mx-auto my-6">

                    <!-- GRID WRAPPER -->
                    <div class="grid grid-cols-3 gap-4">




                        <a href="#" class="rounded-lg bg-red-500 hover:bg-red-400

 p-6 border border-default rounded-base shadow-xs h-full flex flex-col">
                            <h5 class="mb-3 text-2xl font-semibold tracking-tight text-heading leading-8">Total Leaders</h5>
                            <p class="text-body mt-auto text-lg font-semibold">25</p>
                        </a>

                        <a href="#" class="rounded-lg bg-green-500 hover:bg-green-400
 p-6 border border-default rounded-base shadow-xs h-full flex flex-col">
                            <h5 class="mb-3 text-2xl font-semibold tracking-tight text-heading leading-8">Total Sites</h5>
                            <p class="text-body mt-auto text-lg font-semibold">12</p>
                        </a>

                        <a href="#" class="rounded-lg bg-blue-500 hover:bg-blue-400
 p-6 border border-default rounded-base shadow-xs  h-full flex flex-col">
                            <h5 class="mb-3 text-2xl font-semibold tracking-tight text-heading leading-8">Total Bookings</h5>
                            <p class="text-body mt-auto text-lg font-semibold">150</p>
                        </a>

                        <a href="#" class="rounded-lg bg-gray-500 hover:bg-gray-400
 p-6 border border-default rounded-base shadow-xs h-full flex flex-col">
                            <h5 class="mb-3 text-2xl font-semibold tracking-tight text-heading leading-8">Total Sales Value</h5>
                            <p class="text-body mt-auto text-lg font-semibold">₹ 25,00,000</p>
                        </a>

                        <a href="#" class="rounded-lg bg-purple-500 hover:bg-purple-400
 p-6 border border-default rounded-base shadow-xs h-full flex flex-col">
                            <h5 class="mb-3 text-2xl font-semibold tracking-tight text-heading leading-8">Pending Commissions</h5>
                            <p class="text-body mt-auto text-lg font-semibold">₹ 5,00,000</p>
                        </a>

                        <!-- <a href="#" class="rounded-lg bg-gray-200
 p-6 border border-default rounded-base shadow-xs hover:bg-gray-100 h-full flex flex-col">
                            <h5 class="mb-3 text-2xl font-semibold tracking-tight text-heading leading-8">MLM Network</h5>
                            <p class="text-body mt-auto text-lg font-semibold">250</p>
                        </a> -->

                    </div>
                </div>

                <!--/Main-->
            </div>
            <!--Footer-->
            <?php include 'footer.php'; ?>
            <!--/footer-->

        </div>

    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.js"></script>

</body>

</html>