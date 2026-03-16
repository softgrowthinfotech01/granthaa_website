<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Location Data</title>
    <link rel="stylesheet" href="../style.css">

</head>
<body>
    <!--Container -->
    <div class="mx-auto">
        <!--Screen-->
        <div class="flex flex-col min-h-screen">
            <!--Header Section Starts Here-->
            <?php include "header.php"; ?>
            <!--/Header-->

            <div class="flex flex-1">
                <!--Sidebar-->
                <?php include "sidebar.php"; ?>
                <!--/Sidebar-->

                <!--Main-->
               <!--Main-->
<div class="w-full md:w-[80%] lg:w-[60%] xl:w-[40%] 
            mx-auto my-4 self-start 
            rounded-lg bg-slate-100 
            p-4 md:p-6 
            border border-default 
            shadow-xs hover:bg-neutral-secondary-medium">

    <div class="mb-4 flex flex-col md:flex-row justify-between items-start md:items-center gap-3">

        <!-- Search -->
        <input
            type="text"
            id="searchInput"
            placeholder="Search location..."
            class="px-3 py-2 border rounded w-full md:w-1/3">

        <!-- Per Page Select -->
        <div class="flex items-center gap-2">
            <label>Show:</label>
            <select id="perPageSelect"
                class="px-2 py-1 border rounded">
                <option value="5">5</option>
                <option value="10">10</option>
                <option value="25">25</option>
                <option value="50">50</option>
            </select>
            <span>entries</span>
        </div>

    </div>

    <div id="tableLoader" class="hidden text-center py-6">
        <div class="inline-block animate-spin rounded-full h-8 w-8 border-4 border-blue-500 border-t-transparent"></div>
        <p class="mt-2 text-gray-600">Loading...</p>
    </div>

    <!-- Responsive Table Wrapper -->
    <div class="w-full overflow-x-auto">

        <table class="w-full text-sm text-left text-gray-600">
            <thead class="text-xs text-gray-700 uppercase bg-gray-100">
                <tr>
                    <th class="px-4 py-3">Leader Name</th>
                    <th class="px-4 py-3">Site Name</th>
                    <th class="px-4 py-3">Customer Name</th>
                    <th class="px-4 py-3">Commission Amount</th>
                </tr>
            </thead>

            <tbody id="locationTableBody">
                <tr>
                    <td colspan="5" class="text-center py-4">Loading...</td>
                </tr>
            </tbody>
        </table>

    </div>

    <div id="paginationControls" class="flex flex-wrap justify-center gap-2 mt-4"></div>
    <div id="resultInfo" class="text-sm text-gray-600 mt-2 text-center"></div>

</div>
<!--/Main-->
                <!--/Main-->
            </div>
            <!--Footer-->
            <?php include "footer.php"; ?>
            <!--/footer-->

        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.js"></script>

    <script src="../url.js"></script>

</body>

</html>