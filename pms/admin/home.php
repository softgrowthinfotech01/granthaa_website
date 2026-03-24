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
        .admin-b {
            /* background-image: url("../images/admin.jpg"); */
            background-repeat: no-repeat;
            background-position: bottom;
            background-color: gray;


        }

        svg {
            transition: all 0.3s ease;
        }

        svg:hover {
            transform: scale(1.15);
            filter: drop-shadow(0 5px 15px rgba(0, 0, 0, 0.3));
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
                <div class="flex-1 admin-b ">

                    <div class="w-full md:w-[90%] lg:w-[80%] mx-auto my-6 px-3 md:px-0">

                        <!-- GRID WRAPPER -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">

                            <div class="pl-2 h-20 bg-sky-500 rounded-lg shadow-md">
                                <div class="flex w-full h-full py-2 px-4 bg-white rounded-lg justify-between">
                                    <div class="my-auto">
                                        <p class="font-bold"> Total Leaders</p>
                                        <p id="total_leaders" class="text-lg text-sky-500">00.00</p>
                                    </div>
                                    <div class="my-auto">
                                        <svg viewBox="0 0 24 24" class="h-10 w-10">
                                            <defs>
                                                <linearGradient id="leaderGrad" x1="0" y1="0" x2="1" y2="1">
                                                    <stop offset="0%" stop-color="#06b6d4" />
                                                    <stop offset="100%" stop-color="#3b82f6" />
                                                </linearGradient>
                                            </defs>
                                            <circle cx="9" cy="7" r="3" fill="url(#leaderGrad)" />
                                            <circle cx="17" cy="9" r="2.5" fill="#60a5fa" />
                                            <path d="M3 20c0-3.5 3-6 6-6s6 2.5 6 6" fill="url(#leaderGrad)" opacity="0.8" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <div class="pl-2 h-20 bg-sky-500 rounded-lg shadow-md">
                                <div class="flex w-full h-full py-2 px-4 bg-white rounded-lg justify-between">
                                    <div class="my-auto">
                                        <p class="font-bold">Total Sites</p>
                                        <p id="total_sites" class="text-lg text-sky-500">00.00</p>
                                    </div>
                                    <div class="my-auto">
                                        <svg viewBox="0 0 24 24" class="h-10 w-10">
                                            <defs>
                                                <linearGradient id="siteGrad" x1="0" y1="0" x2="1" y2="1">
                                                    <stop offset="0%" stop-color="#6366f1" />
                                                    <stop offset="100%" stop-color="#8b5cf6" />
                                                </linearGradient>
                                            </defs>
                                            <path d="M12 21s6-5.5 6-10a6 6 0 10-12 0c0 4.5 6 10 6 10z" fill="url(#siteGrad)" />
                                            <circle cx="12" cy="11" r="2.5" fill="#fff" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <div class="pl-2 h-20 bg-sky-500 rounded-lg shadow-md">
                                <div class="flex w-full h-full py-2 px-4 bg-white rounded-lg justify-between">
                                    <div class="my-auto">
                                        <p class="font-bold">Total Bookings</p>
                                        <p id="total_bookings" class="text-lg text-sky-500">00.00</p>
                                    </div>
                                    <div class="my-auto">
                                        <svg viewBox="0 0 24 24" class="h-10 w-10">
                                            <rect x="3" y="5" width="18" height="16" rx="3" fill="#34d399" />
                                            <rect x="3" y="9" width="18" height="2" fill="#059669" />
                                            <circle cx="8" cy="14" r="1.5" fill="#065f46" />
                                            <circle cx="12" cy="14" r="1.5" fill="#065f46" />
                                            <circle cx="16" cy="14" r="1.5" fill="#065f46" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <div class="pl-2 h-20 bg-sky-500 rounded-lg shadow-md">
                                <div class="flex w-full h-full py-2 px-4 bg-white rounded-lg justify-between">
                                    <div class="my-auto">
                                        <p class="font-bold">Total Sales Value</p>
                                        <p id="total_sales_value" class="text-lg text-sky-500">00.00</p>
                                    </div>
                                    <div class="my-auto">
                                        <svg viewBox="0 0 24 24" class="h-10 w-10">
                                            <defs>
                                                <linearGradient id="moneyGrad" x1="0" y1="0" x2="1" y2="1">
                                                    <stop offset="0%" stop-color="#22c55e" />
                                                    <stop offset="100%" stop-color="#16a34a" />
                                                </linearGradient>
                                            </defs>
                                            <rect x="3" y="6" width="18" height="12" rx="3" fill="url(#moneyGrad)" />
                                            <circle cx="12" cy="12" r="3" fill="#bbf7d0" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <div class="pl-2 h-20 bg-sky-500 rounded-lg shadow-md">
                                <div class="flex w-full h-full py-2 px-4 bg-white rounded-lg justify-between">
                                    <div class="my-auto">
                                        <p class="font-bold">Pending Commissions</p>
                                        <p id="pending_commissions" class="text-lg text-sky-500">00.00</p>
                                    </div>
                                    <div class="my-auto">
                                        <svg viewBox="0 0 24 24" class="h-10 w-10">
                                            <defs>
                                                <linearGradient id="clockGrad" x1="0" y1="0" x2="1" y2="1">
                                                    <stop offset="0%" stop-color="#f59e0b" />
                                                    <stop offset="100%" stop-color="#f97316" />
                                                </linearGradient>
                                            </defs>
                                            <circle cx="12" cy="12" r="9" fill="url(#clockGrad)" />
                                            <path d="M12 7v5l3 2" stroke="#fff" stroke-width="2" fill="none" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <div class="pl-2 h-20 bg-sky-500 rounded-lg shadow-md">
                                <div class="flex w-full h-full py-2 px-4 bg-white rounded-lg justify-between">
                                    <div class="my-auto">
                                        <p class="font-bold">Paid Commissions</p>
                                        <p id="paid_commissions" class="text-lg text-sky-500">00.00</p>
                                    </div>
                                    <div class="my-auto">
                                        <svg viewBox="0 0 24 24" class="h-10 w-10">
                                            <defs>
                                                <linearGradient id="walletGrad" x1="0" y1="0" x2="1" y2="1">
                                                    <stop offset="0%" stop-color="#10b981" />
                                                    <stop offset="100%" stop-color="#059669" />
                                                </linearGradient>
                                            </defs>

                                            <rect x="3" y="6" width="18" height="12" rx="3" fill="url(#walletGrad)" />
                                            <path d="M15 10h4v4h-4a2 2 0 010-4z" fill="#d1fae5" />
                                            <circle cx="16.5" cy="12" r="0.8" fill="#059669" />
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
                    document.querySelector('#paid_commissions').textContent = "₹ " + data.data.total_paid.toLocaleString("en-IN");
                })
                .catch(error => console.error('Error fetching dashboard data:', error));
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.js"></script>

</body>

</html>