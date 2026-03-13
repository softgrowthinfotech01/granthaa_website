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
<style>
    .admin-b{
        background-image: url("../images/admin.jpg");
        background-repeat: no-repeat;
        background-position: bottom;
    }
</style>
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
                <div class="flex-1 admin-b">
                    <div class="w-full md:w-[90%] lg:w-[80%] mx-auto my-6 px-3 md:px-0">

                        <!-- GRID WRAPPER -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">

                            <div class="pl-1 h-20 bg-green-400 rounded-lg shadow-md">
                                <div class="flex w-full h-full py-2 px-4 bg-white rounded-lg justify-between">
                                    <div class="my-auto">
                                        <p class="font-bold"> Total Leaders</p>
                                        <p id="total_leaders" class="text-lg">00.00</p>
                                    </div>
                                    <div class="my-auto">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <div class="pl-1 h-20 bg-green-400 rounded-lg shadow-md">
                                <div class="flex w-full h-full py-2 px-4 bg-white rounded-lg justify-between">
                                    <div class="my-auto">
                                        <p class="font-bold">Total Sites</p>
                                        <p id="total_sites"  class="text-lg">00.00</p>
                                    </div>
                                    <div class="my-auto">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <div class="pl-1 h-20 bg-green-400 rounded-lg shadow-md">
                                <div class="flex w-full h-full py-2 px-4 bg-white rounded-lg justify-between">
                                    <div class="my-auto">
                                        <p class="font-bold">Total Bookings</p>
                                        <p id="total_bookings" class="text-lg">00.00</p>
                                    </div>
                                    <div class="my-auto">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <div class="pl-1 h-20 bg-green-400 rounded-lg shadow-md">
                                <div class="flex w-full h-full py-2 px-4 bg-white rounded-lg justify-between">
                                    <div class="my-auto">
                                        <p class="font-bold">Total Sales Value</p>
                                        <p id="total_sales_value"  class="text-lg">00.00</p>
                                    </div>
                                    <div class="my-auto">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <div class="pl-1 h-20 bg-green-400 rounded-lg shadow-md">
                                <div class="flex w-full h-full py-2 px-4 bg-white rounded-lg justify-between">
                                    <div class="my-auto">
                                        <p class="font-bold">Pending Commissions</p>
                                        <p id="pending_commissions" class="text-lg">00.00</p>
                                    </div>
                                    <div class="my-auto">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                    <!--/Main-->
                </div>
            </div>
            <!--Footer-->
            <?php include 'footer.php'; ?>
            <!--/footer-->

        </div>

    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const token = localStorage.getItem('auth_token');
            if (!token) {
                alert("Please login first");
                window.location.href = "../login";
                return;
            }
            const apiUrl = url + 'admdashboard';

            fetch(apiUrl, {
                    method: "GET",
                    headers: {
                        "Content-Type": "application/json",
                        "Authorization": "Bearer " + token
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error("Network response was not ok: " + response.statusText);
                    }
                    return response.json();
                })
                .then(data => {
                    document.querySelector('#total_leaders').textContent = data.data.total_leaders;
                    document.querySelector('#total_sites').textContent = data.data.total_sites;
                    document.querySelector('#total_bookings').textContent = data.data.total_bookings;
                    document.querySelector('#total_sales_value').textContent = "₹ " + Number(data.data.total_sales_value).toLocaleString("en-IN");
                    document.querySelector('#pending_commissions').textContent = "₹ " + data.data.pending_commissions.toLocaleString("en-IN");
                })
                .catch(error => console.error('Error fetching dashboard data:', error));
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.js"></script>

</body>

</html>