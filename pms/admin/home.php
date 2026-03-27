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

    <style>
        .admin-b {
            background-repeat: no-repeat;
            background-position: bottom;
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
                <div class="flex-1 admin-b bg-gray-200">

                    <div class="w-full md:w-[90%] lg:w-[80%] mx-auto my-6 px-3 md:px-0">

                        <!-- GRID WRAPPER -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-2">

                            <div class="pl-2 h-40 bg-sky-500 rounded-lg shadow-md">
                                <div class="flex flex-col justify-between h-full p-2 bg-white rounded-lg">
                                    <!-- Leaders -->
                                    <div>
                                        <p class="text-gray-500 text-xs font-medium">
                                            Total Leaders
                                        </p>
                                        <div class="flex items-center justify-between mt-1">
                                            <p id="total_leaders"
                                                class="text-lg font-semibold text-sky-500">
                                                0
                                            </p>
                                            <svg viewBox="0 0 24 24"
                                                class="h-[40%] w-[40%] max-h-8 max-w-8 opacity-80">
                                                <circle cx="9" cy="7" r="3" fill="#3b82f6" />
                                                <circle cx="17" cy="9" r="2.5" fill="#60a5fa" />
                                            </svg>
                                        </div>
                                    </div>

                                    <!-- Divider -->
                                    <div class="border-t"></div>

                                    <!-- Sites -->
                                    <div>
                                        <p class="text-gray-500 text-xs font-medium">
                                            Total Sites
                                        </p>
                                        <div class="flex items-center justify-between mt-1">
                                            <p id="total_sites"
                                                class="text-lg font-semibold text-sky-500">
                                                0
                                            </p>
                                            <svg viewBox="0 0 24 24"
                                                class="h-5 w-5 opacity-80 shrink-0">
                                                <path d="M12 21s6-5.5 6-10a6 6 0 10-12 0c0 4.5 6 10 6 10z"
                                                    fill="#8b5cf6" />
                                            </svg>
                                        </div>
                                    </div>

                                    <!-- Divider -->
                                    <div class="border-t"></div>

                                    <!-- Bookings -->
                                    <div>
                                        <p class="text-gray-500 text-xs font-medium">
                                            Total Bookings
                                        </p>
                                        <div class="flex items-center justify-between mt-1 mb-1">
                                            <p id="total_bookings"
                                                class="text-lg font-semibold text-sky-500">
                                                0
                                            </p>
                                            <svg viewBox="0 0 24 24"
                                                class="h-5 w-5 opacity-80 shrink-0">
                                                <rect x="3" y="5" width="18" height="16" rx="3"
                                                    fill="#34d399" />
                                                <rect x="3" y="9" width="18" height="2"
                                                    fill="#059669" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!--  -->
                            <div class="pl-2 h-40 bg-sky-500 rounded-lg shadow-md">
                                <div class="flex flex-col justify-between h-full p-4 bg-white rounded-lg">
                                    <!-- Top Section -->
                                    <div>
                                        <p class="text-gray-500 text-sm font-medium">
                                            Total Booking Value
                                        </p>
                                        <div class="flex items-center justify-between mt-1">
                                            <p id="total_sales_value"
                                                class="text-xl font-semibold text-sky-500">
                                                ₹ 00
                                            </p>
                                            <svg viewBox="0 0 24 24"
                                                class="h-5 w-5 text-green-600">
                                                <rect x="3" y="6" width="18" height="12" rx="3"
                                                    fill="currentColor" />
                                                <circle cx="12" cy="12" r="3" fill="#bbf7d0" />
                                            </svg>
                                        </div>
                                    </div>

                                    <!-- Divider -->
                                    <div class="border-t"></div>

                                    <!-- Bottom Section -->
                                    <div>
                                        <p class="text-gray-500 text-sm font-medium">
                                            Total Commissions
                                        </p>
                                        <div class="flex items-center justify-between mt-1">
                                            <p id="total_commissions"
                                                class="text-xl font-semibold text-sky-500">
                                                ₹ 00
                                            </p>
                                            <div class="bg-purple-100 p-1.5 rounded-lg">
                                                <svg viewBox="0 0 24 24"
                                                    class="h-5 w-5 text-purple-600">
                                                    <circle cx="12" cy="12" r="9" fill="currentColor" />
                                                    <path d="M12 7v5l3 2"
                                                        stroke="#fff"
                                                        stroke-width="2"
                                                        fill="none" />
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!--  -->
                            <div class="pl-2 h-40 bg-sky-500 rounded-lg shadow-md">
                                <div class="flex flex-col justify-between h-full p-4 bg-white rounded-lg">
                                    <!-- Pending -->
                                    <div>
                                        <p class="text-gray-500 text-sm font-medium">
                                            Pending Commissions
                                        </p>
                                        <div class="flex items-center justify-between mt-1">
                                            <p id="pending_commissions"
                                                class="text-xl font-semibold text-sky-500">
                                                ₹ 00
                                            </p>
                                            <svg viewBox="0 0 24 24"
                                                class="h-5 w-5 text-orange-600">
                                                <circle cx="12" cy="12" r="9" fill="currentColor" />
                                                <path d="M12 7v5l3 2"
                                                    stroke="#fff"
                                                    stroke-width="2"
                                                    fill="none" />
                                            </svg>
                                        </div>
                                    </div>

                                    <!-- Divider -->
                                    <div class="border-t"></div>

                                    <!-- Paid -->
                                    <div>
                                        <p class="text-gray-500 text-sm font-medium">
                                            Paid Commissions
                                        </p>
                                        <div class="flex items-center justify-between mt-1">
                                            <p id="paid_commissions"
                                                class="text-xl font-semibold text-sky-500">
                                                ₹ 00
                                            </p>
                                            <svg viewBox="0 0 24 24"
                                                class="h-5 w-5 text-green-600">
                                                <circle cx="12" cy="12" r="9" fill="currentColor" />
                                                <path d="M8 12l2.5 2.5L16 9"
                                                    stroke="#fff"
                                                    stroke-width="2"
                                                    fill="none" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">

                            <!-- SALES TREND -->
                            <div class="bg-white p-4 rounded-xl shadow">
                                <h3 class="text-lg font-semibold mb-3">📈 Sales Trend</h3>
                                <canvas id="salesChart"></canvas>
                            </div>

                            <!-- COMMISSION SPLIT -->
                            <div class="bg-white p-4 rounded-xl shadow flex flex-col justify-center items-center">
                                <h3 class="text-lg font-semibold mb-3">Commission Status</h3>
                                <canvas id="commissionChart" style="max-width: 280px; max-height: 280px;"></canvas>
                            </div>

                        </div>

                        <div class="bg-white rounded-xl shadow-md p-4 mt-6">

                            <h3 class="text-lg font-semibold mb-3">Recent Bookings</h3>

                            <div class="overflow-x-auto">
                                <table class="w-full text-sm text-left border rounded-lg">

                                    <thead class="bg-gray-100 text-gray-600">
                                        <tr>
                                            <th class="p-2">Buyer</th>
                                            <th class="p-2">Plot</th>
                                            <th class="p-2">Amount</th>
                                            <th class="p-2">Date</th>
                                        </tr>
                                    </thead>

                                    <tbody id="recentBookingsTable"></tbody>

                                </table>
                                <a href="total_sales_report"
                                    class="inline-block bg-blue-500 text-white text-sm px-4 py-2 rounded-lg shadow
                                     hover:bg-blue-600 transition float-right m-2">
                                    View All →
                                </a>
                            </div>

                        </div>

                        <div class="bg-white rounded-xl shadow-md p-4 mt-6">

                            <h3 class="text-lg font-semibold mb-3">Recent Payments</h3>

                            <div class="overflow-x-auto">
                                <table class="w-full text-sm text-left border rounded-lg">

                                    <thead class="bg-gray-100 text-gray-600">
                                        <tr>
                                            <th class="p-2">User</th>
                                            <th class="p-2">Amount</th>
                                            <th class="p-2">Mode</th>
                                            <th class="p-2">Date</th>
                                        </tr>
                                    </thead>

                                    <tbody id="recentPaymentsTable"></tbody>

                                </table>
                                <a href="view_payment"
                                    class="inline-block bg-blue-500 text-white text-sm px-4 py-2 rounded-lg shadow
                                     hover:bg-blue-600 transition float-right m-2">
                                    View All →
                                </a>
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

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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
                    document.querySelector('#total_commissions').textContent = "₹ " + data.data.total_commission.toLocaleString("en-IN");
                })
                .catch(error => console.error('Error fetching dashboard data:', error));
        });


        function loadRecentBookings() {

            const token = localStorage.getItem("auth_token");

            fetch(url + "bookings?per_page=5", {
                    headers: {
                        "Authorization": "Bearer " + token
                    }
                })
                .then(res => res.json())
                .then(res => {

                    const bookings = res.data.data; // pagination

                    const tbody = document.getElementById("recentBookingsTable");
                    tbody.innerHTML = "";

                    bookings.forEach(b => {

                        tbody.innerHTML += `
                <tr class="border-t hover:bg-gray-50">
                    <td class="p-2">${b.buyer_name}</td>
                    <td class="p-2">${b.plot_number}</td>
                    <td class="p-2 text-green-600">₹${b.total_booking_amount}</td>
                    <td class="p-2">${new Date(b.created_at).toLocaleDateString()}</td>
                </tr>
            `;
                    });

                });
        }

        function loadRecentPayments() {

            const token = localStorage.getItem("auth_token");

            fetch(url + "recent-payments", {
                    headers: {
                        "Authorization": "Bearer " + token
                    }
                })
                .then(res => res.json())
                .then(res => {

                    const payments = res.data;

                    const tbody = document.getElementById("recentPaymentsTable");
                    tbody.innerHTML = "";

                    payments.forEach(p => {

                        tbody.innerHTML += `
                <tr class="border-t hover:bg-gray-50">
                    <td class="p-2">${p.user?.name ?? 'N/A'}</td>
                    <td class="p-2 text-blue-600">₹${Math.abs(p.amount)}</td>
                    <td class="p-2">${p.payment_mode ?? '-'}</td>
                    <td class="p-2">${new Date(p.created_at).toLocaleDateString()}</td>
                </tr>
            `;
                    });

                });
        }

        async function loadSalesChart() {

            const token = localStorage.getItem("auth_token");

            const res = await fetch(url + "sales-trend", {
                headers: {
                    "Authorization": "Bearer " + token
                }
            });

            const result = await res.json();

            const labels = result.data.map(d => d.date);
            const values = result.data.map(d => d.total);

            new Chart(document.getElementById("salesChart"), {
                type: "line",
                data: {
                    labels: labels,
                    datasets: [{
                        label: "Sales",
                        data: values,
                        borderWidth: 2,
                        tension: 0.3
                    }]
                }
            });
        }

        async function loadCommissionChart() {

            const token = localStorage.getItem("auth_token");

            // ✅ Use existing dashboard API
            const res = await fetch(url + "admdashboard", {
                headers: {
                    "Authorization": "Bearer " + token
                }
            });

            const result = await res.json();
            const d = result.data;

            // ✅ Use existing fields
            const paid = Number(d.total_paid);
            const pending = Number(d.pending_commissions);
            const total = paid + pending;

            const ctx = document.getElementById("commissionChart").getContext("2d");

            // 🎨 Paid (green)
            const gradient1 = ctx.createLinearGradient(0, 0, 0, 400);
            gradient1.addColorStop(0, "#34d399");
            gradient1.addColorStop(1, "#059669");

            // 🎨 Pending (orange)
            const gradient2 = ctx.createLinearGradient(0, 0, 0, 400);
            gradient2.addColorStop(0, "#fbbf24");
            gradient2.addColorStop(1, "#f97316");

            // 🔥 Inner Circle Plugin
            const innerCirclePlugin = {
                id: 'innerCircle',
                beforeDraw(chart) {
                    const {
                        ctx
                    } = chart;
                    const meta = chart.getDatasetMeta(0);
                    if (!meta?.data?.[0]) return;

                    const x = meta.data[0].x;
                    const y = meta.data[0].y;
                    const innerRadius = meta.data[0].innerRadius;

                    ctx.save();

                    // Inner circle
                    ctx.beginPath();
                    ctx.arc(x, y, innerRadius - 10, 0, 2 * Math.PI);
                    ctx.fillStyle = "#f8fafc";
                    ctx.fill();

                    ctx.strokeStyle = "#e5e7eb";
                    ctx.lineWidth = 2;
                    ctx.stroke();

                    // Dynamic center
                    const centerData = chart.$centerText || {
                        title: "Total Commission",
                        value: total
                    };

                    ctx.textAlign = "center";

                    ctx.fillStyle = "#111";
                    ctx.font = "bold 22px sans-serif";
                    ctx.fillText("₹" + centerData.value.toLocaleString(), x, y - 8);

                    ctx.fillStyle = "#666";
                    ctx.font = "13px sans-serif";
                    ctx.fillText(centerData.title, x, y + 15);

                    ctx.restore();
                }
            };

            const chart = new Chart(ctx, {
                type: "doughnut",
                data: {
                    labels: ["Paid", "Pending"], // ✅ changed
                    datasets: [{
                        data: [paid, pending], // ✅ changed
                        backgroundColor: [gradient1, gradient2],
                        borderWidth: 0,
                        hoverOffset: 20
                    }]
                },
                options: {
                    cutout: "70%",
                    radius: "85%",

                    plugins: {
                        legend: {
                            position: "top"
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    const value = context.raw;
                                    const percent = ((value / total) * 100).toFixed(1);
                                    return `${context.label}: ₹${value.toLocaleString()} (${percent}%)`;
                                }
                            }
                        }
                    },

                    onHover: (event, elements, chart) => {
                        if (elements.length) {
                            const index = elements[0].index;
                            chart.$centerText = {
                                title: chart.data.labels[index],
                                value: chart.data.datasets[0].data[index]
                            };
                        } else {
                            chart.$centerText = {
                                title: "Total Commission",
                                value: total
                            };
                        }

                        chart.draw();
                    }
                },
                plugins: [innerCirclePlugin]
            });

            chart.$centerText = {
                title: "Total Commission",
                value: total
            };
        }


        document.addEventListener("DOMContentLoaded", function() {
            loadRecentBookings();
            loadRecentPayments(); // 👈 ADD THIS
            loadSalesChart(); // 👈 NEW
            loadCommissionChart();
        });
    </script>



</body>

</html>