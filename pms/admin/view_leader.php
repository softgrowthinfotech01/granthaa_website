<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leader Data</title>
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
                <div class="w-[60%] mx-auto my-4 self-start rounded-lg bg-slate-100 p-6 border border-default rounded-base shadow-xs hover:bg-neutral-secondary-medium">

                <h5 class="text-lg font-bold text-heading p-1 my-2">Leaders Data</h5>

                    <table id="pagination-table">
                        <thead>
                            <tr>
                                <th>
                                    <span class="flex justify-center">
                                    Code
                                    </span>
                                </th>
                                <th>
                                    <span class="flex justify-center">
                                     Name
                                    </span>
                                </th>
                                <th>
                                    <span class="flex justify-center">
                                        Age
                                    </span>
                                </th>
                                <th data-type="date" data-format="Month YYYY">
                                    <span class="flex justify-center">
                                        Gender
                                    </span>
                                </th>
                                <th>
                                    <span class="flex justify-center">
                                        Image
                                    </span>
                                </th>
                                <th>
                                    <span class="flex justify-center">
                                        Mobile Number
                                    </span>
                                </th>
                                <th>
                                    <span class="flex justify-center">
                                        Email
                                    </span>
                                </th>
                                <th>
                                    <span class="flex justify-center">
                                        City
                                    </span>
                                </th>
                                <th>
                                    <span class="flex justify-center">
                                        State
                                    </span>
                                </th>
                                <th>
                                    <span class="flex justify-center">
                                        Address
                                    </span>
                                </th>
                                <th>
                                    <span class="flex justify-center">
                                        Pincode
                                    </span>
                                </th>
                                <th>
                                    <span class="flex justify-center">
                                        Bank Name
                                    </span>
                                </th>
                                <th>
                                    <span class="flex justify-center">
                                        Branch
                                    </span>
                                </th>
                                <th>
                                    <span class="flex justify-center">
                                        Acc. No.
                                    </span>
                                </th>
                                <th>
                                    <span class="flex justify-center">
                                        IFSC Code
                                    </span>
                                </th>
                                <th>
                                    <span class="flex justify-center">
                                        Actions
                                    </span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="font-medium text-heading whitespace-nowrap">test data</td>
                                <td>test data</td>
                                <td>test data</td>
                                <td>test data</td>
                                <td>test data</td>
                                <td>test data</td>
                                <td>test data</td>
                                <td>test data</td>
                                <td>test data</td>
                                <td>test data</td>
                                <td>test data</td>
                                <td>test data</td>
                                <td>test data</td>
                                <td>test data</td>
                                <td>test data</td>
                                <td class="flex gap-2">
                                   <a href="update_leader.php" class="px-3 py-1.5 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-500 focus:ring-2 focus:ring-blue-300">Edit</a>

                                 <button class="px-3 py-1.5 text-sm font-medium text-white bg-red-600 rounded-md hover:bg-red-500 focus:ring-2 focus:ring-red-300">
                                        Delete
                                    </button>
                                </td>

                            </tr>
                            <tr>
                                <td class="font-medium text-heading whitespace-nowrap">test data</td>
                                <td>test data</td>
                                <td>test data</td>
                                <td>test data</td>
                                <td>test data</td>
                                <td>test data</td>
                                <td>test data</td>
                                <td>test data</td>
                                <td>test data</td>
                                <td>test data</td>
                                <td>test data</td>
                                <td>test data</td>
                                <td>test data</td>
                                <td>test data</td>
                                <td>test data</td>
                                <td class="flex gap-2">
                                    <a href="update_leader.php" class="px-3 py-1.5 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-500 focus:ring-2 focus:ring-blue-300">Edit</a>
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


</body>

</html>