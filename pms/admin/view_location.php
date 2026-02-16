<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Location Data</title>
    <link rel="stylesheet" href="../style.css">

    <!-- CSS required for datatable -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/simple-datatables@9.0.3/dist/style.css">
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@9.0.3/dist/umd/simple-datatables.js"></script>
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
                <?php include "sidebar.php"; ?>
                <!--/Sidebar-->

                <!--Main-->
                <div class="w-[40%] mx-auto my-4 self-start rounded-lg bg-slate-100 p-6 border border-default rounded-base shadow-xs hover:bg-neutral-secondary-medium">

            
                <h5 class="text-lg font-bold text-heading p-1 my-2">Location Data</h5>

                    <table id="pagination-table">
                        <thead>
                            <tr>
                                
                                <th>
                                    <span class=" text-center">
                                        #
                                    </span>
                                </th>
                                 <th>
                                    <span class=" text-center">
                                        Site Location
                                    </span>
                                </th>
                                 <th>
                                    <span class=" text-center">
                                        Created At
                                    </span>
                                </th>
                                <th>
                                    <span class=" text-center">
                                        Actions
                                    </span>
                                </th>

                            </tr>
                        </thead>
                        <tbody id="locationTableBody">
                            <tr>
                                <td colspan="1" class="font-medium text-heading whitespace-nowrap">Loading...</td>
                                <td class="flex gap-2">
                                    <a href="update_location.php" class="px-3 py-1.5 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-500 focus:ring-2 focus:ring-blue-300">Edit</a>

                                    <button class="px-3 py-1.5 text-sm font-medium text-white bg-red-600 rounded-md hover:bg-red-500 focus:ring-2 focus:ring-red-300">
                                        Delete
                                    </button>
                                </td>
                            </tr>
                            
                            
                        </tbody>
                    </table>


                </div>
                <!--/Main-->
            </div>
            <!--Footer-->
            <?php include "footer.php"; ?>
            <!--/footer-->

        </div>

    </div>

    <script>
        if (document.getElementById("pagination-table") && typeof simpleDatatables.DataTable !== 'undefined') {
            const dataTable = new simpleDatatables.DataTable("#pagination-table", {
                paging: true,
                perPage: 5,
                perPageSelect: [5, 10, 15, 20, 25],
                sortable: false
            });
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.js"></script>

    <script src="../url.js"></script>
<script>
async function fetchLocations() {
    try {
        const response = await fetch(url + 'site-location', {
            headers: {
                'Accept': 'application/json'
            }
        });

        const result = await response.json();
        const tbody = document.getElementById('locationTableBody');
        tbody.innerHTML = '';

        if (!result.data || result.data.length === 0) {
            tbody.innerHTML = `
                <tr>
                    <td colspan="4" class="text-center py-4">No locations found</td>
                </tr>`;
            return;
        }

        result.data.forEach((loc, index) => {
            tbody.innerHTML += `
                <tr class="border-b">
                    <td class="px-4 py-2 text-center">${index + 1}</td>
                    <td class="px-4 py-2 font-medium text-center">${loc.site_location}</td>
                    <td class="px-4 py-2 text-gray-500 text-center">
                        ${new Date(loc.created_at).toLocaleDateString()}
                    </td>
                    <td class="px-4 py-2 flex gap-2">
                        <a href="update_location.php?id=${loc.id}" class="px-3 py-1.5 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-500 focus:ring-2 focus:ring-blue-300">Edit</a>

                        <button onclick="deleteLocation(${loc.id})" class="px-3 py-1.5 text-sm font-medium text-white bg-red-600 rounded-md hover:bg-red-500 focus:ring-2 focus:ring-red-300">
                            Delete
                        </button>
                </tr>
            `;
        });

    } catch (error) {
        console.error(error);
    }
}

// auto load
fetchLocations();
</script>

</body>

</html>