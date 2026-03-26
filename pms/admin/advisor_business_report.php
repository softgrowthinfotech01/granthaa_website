<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Location Data</title>
    <link rel="stylesheet" href="../style.css">

</head>

<body class="bg-gray-200">
    <!--Container -->
    <div class="mx-auto">
    <div class="flex flex-col min-h-screen">

        <?php include "header.php"; ?>

        <div class="flex flex-1 flex-col md:flex-row">

            <?php include "sidebar.php"; ?>

            <!-- MAIN -->
            <div id="mainContent"
                class="w-full md:w-[80%] lg:w-[60%] xl:w-[50%] 
                mx-auto my-6 px-3">

                <!-- CARD -->
                <div class="bg-white p-5 md:p-6 rounded-2xl shadow-lg border border-gray-200">

                    <!-- TITLE -->
                    <div class="mb-5 text-center">
                        <h2 class="text-xl md:text-2xl font-bold text-gray-800">
                            Advisor Business Report
                        </h2>
                        <p class="text-sm text-gray-500">View advisor-wise commission details</p>
                    </div>

                    <!-- TOP CONTROLS -->
                    <div class="mb-5 flex flex-col md:flex-row justify-between items-stretch md:items-center gap-3">

                        <!-- Search -->
                        <input
                            type="text"
                            id="searchInput"
                            placeholder="Search advisor / site / customer..."
                            class="px-3 py-2.5 border border-gray-300 rounded-lg w-full md:w-1/2 focus:ring-2 focus:ring-blue-500 outline-none">

                        <!-- Per Page -->
                        <div class="flex items-center gap-2 text-sm justify-between md:justify-start">
                            <span class="text-gray-600">Show</span>
                            <select id="perPageSelect"
                                class="px-2 py-1.5 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 outline-none">
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                            </select>
                            <span class="text-gray-600">entries</span>
                        </div>

                    </div>

                    <!-- LOADER -->
                    <div id="tableLoader" class="hidden text-center py-6">
                        <div class="inline-block animate-spin rounded-full h-8 w-8 border-4 border-blue-500 border-t-transparent"></div>
                        <p class="mt-2 text-gray-500">Loading...</p>
                    </div>

                    <!-- TABLE -->
                    <div class="w-full overflow-x-auto rounded-lg border border-gray-200">

                        <table class="w-full text-sm text-left text-gray-600">

                            <thead class="text-xs text-gray-700 uppercase bg-gray-100">
                                <tr>
                                    <th class="px-4 py-3">Advisor Name</th>
                                    <th class="px-4 py-3">Site Name</th>
                                    <th class="px-4 py-3">Customer Name</th>
                                    <th class="px-4 py-3">Commission ₹</th>
                                </tr>
                            </thead>

                            <tbody id="locationTableBody" class="divide-y">
                                <tr>
                                    <td colspan="4" class="text-center py-6 text-gray-500">
                                        Loading...
                                    </td>
                                </tr>
                            </tbody>

                        </table>

                    </div>

                    <!-- PAGINATION -->
                    <div id="paginationControls"
                        class="flex flex-wrap justify-center gap-2 mt-5"></div>

                    <!-- RESULT -->
                    <div id="resultInfo"
                        class="text-sm text-gray-500 mt-2 text-center"></div>

                </div>

            </div>
            <!--/Main-->

        </div>

        <?php include "footer.php"; ?>

    </div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.js"></script>

    <script src="../url.js"></script>

</body>

</html>