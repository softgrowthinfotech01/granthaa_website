<link rel="stylesheet" href="../style.css">

<style>
    /* Smooth transition */
    #sidebar {
        transition: all 0.3s ease-in-out;
        background: linear-gradient(180deg, #ffffff, #f8fafc);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
    }

    /* Menu items base */
    #sidebar ul li a {
        border-radius: 10px;
        margin: 6px 10px;
        transition: all 0.25s ease;
    }

    /* Hover effect (premium feel) */
    #sidebar ul li a:hover {
        background: linear-gradient(90deg, #6366f1, #3b82f6);
        color: #fff !important;
        transform: translateX(4px);
        box-shadow: 0 4px 12px rgba(99, 102, 241, 0.25);
    }

    /* Active (Dashboard highlight) */
    #sidebar ul li.bg-gray-200 a {
        background: linear-gradient(90deg, #4f46e5, #2563eb);
        color: #fff;
        box-shadow: 0 4px 14px rgba(79, 70, 229, 0.3);
    }

    /* Icons */
    #sidebar .text-lg,
    #sidebar i {
        transition: transform 0.25s ease, color 0.25s ease;
    }

    /* Icon hover animation */
    #sidebar ul li a:hover .text-lg,
    #sidebar ul li a:hover i {
        transform: scale(1.15);
        color: #fff;
    }

    /* Submenu styling */
    #sidebar ul ul {
        border-left: 2px solid #e5e7eb;
        margin-left: 20px;
        padding-left: 10px;
    }

    #sidebar ul ul li a {
        border-radius: 8px;
        background: #f1f5f9;
        margin: 4px 0;
    }

    /* Submenu hover */
    #sidebar ul ul li a:hover {
        background: linear-gradient(90deg, #22c55e, #16a34a);
        color: #fff !important;
    }

    /* Arrow animation */
    .dropdown-arrow {
        transition: transform 0.3s ease;
    }

    .dropdown-arrow.rotate-open {
        transform: rotate(90deg);
    }

    /* Scrollbar (premium look) */
    #sidebar::-webkit-scrollbar {
        width: 6px;
    }

    #sidebar::-webkit-scrollbar-thumb {
        background: #c7d2fe;
        border-radius: 10px;
    }

    /* Collapsed sidebar (desktop) */
    @media (min-width: 768px) {
        #sidebar.md\:w-0 {
            width: 80px !important;
            overflow: visible;
        }

        /* Hide only text */
        #sidebar.md\:w-0 span {
            font-size: 0;
        }

        #sidebar.md\:w-0 span .text-lg {
            font-size: 18px !important;
        }

        /* Hide arrows */
        #sidebar.md\:w-0 .fa-angle-right {
            display: none;
        }

        /* Center icons */
        #sidebar.md\:w-0 a {
            justify-content: center !important;
        }

        /* Hide submenu */
        #sidebar.md\:w-0 ul ul {
            display: none !important;
        }

        /* Tooltip */
        #sidebar a {
            position: relative;
        }

        #sidebar a::after {
            content: attr(data-name);
            position: absolute;
            left: 70px;
            background: linear-gradient(90deg, #111827, #1f2937);
            color: #fff;
            padding: 6px 12px;
            border-radius: 8px;
            font-size: 12px;
            white-space: nowrap;
            opacity: 0;
            pointer-events: none;
            transition: 0.2s;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        #sidebar.md\:w-0 a:hover::after {
            opacity: 1;
        }
    }
</style>

<!-- Sidebar -->
<aside id="sidebar"
    class="w-64 md:w-64 min-h-screen bg-gray-50 border-r border-gray-200
flex flex-col transition-all duration-300 ease-in-out
fixed md:relative transform md:translate-x-0 -translate-x-full z-40 overflow-hidden">

    <nav class="flex-1">
        <ul class="text-sm text-gray-950">

            <!-- Dashboard -->
            <li class="bg-gray-200">
                <a href="home" data-name="Dashboard"
                    class="flex items-center justify-between px-4 py-3">
                    <span class="flex items-center gap-3 text-base font-semibold">
                        <span class="text-lg">🏠</span>
                        Dashboard
                    </span>
                </a>
            </li>

            <!-- Leaders -->
            <li class="border-t">
                <a href="javascript:void(0)" data-name="Leaders"
                    onclick="toggleMenu('categoryMenu', this)"
                    class="flex items-center justify-between px-4 py-3 hover:bg-gray-300">
                    <span class="flex items-center gap-3 text-base font-semibold">
                        <span class="text-lg">👥</span>
                        Leaders
                    </span>
                    <i class="fas fa-angle-right dropdown-arrow"></i>
                </a>

                <ul id="categoryMenu" class="hidden bg-gray-100">
                    <li class="border-t">
                        <a href="add_leader" data-name="Add Leader"
                            class="block px-10 py-3 bg-gray-500 text-black text-sm font-semibold">
                            <i class="fas fa-angle-right mx-2"></i>
                            Add Leader
                        </a>
                    </li>
                    <li class="border-t">
                        <a href="view_leader" data-name="View Leaders"
                            class="block px-10 py-3 bg-gray-500 text-black text-sm font-semibold">
                            <i class="fas fa-angle-right mx-2"></i>
                            View Leaders
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Location -->
            <li class="border-t">
                <a href="javascript:void(0)" data-name="Location"
                    onclick="toggleMenu('location', this)"
                    class="flex items-center justify-between px-4 py-3 hover:bg-gray-300">
                    <span class="flex items-center gap-3 text-base font-semibold">
                        <span class="text-lg">📍</span>
                        Location
                    </span>
                    <i class="fas fa-angle-right dropdown-arrow"></i>
                </a>

                <ul id="location" class="hidden bg-gray-100">
                    <li class="border-t">
                        <a href="add_location" data-name="Add Location"
                            class="block px-10 py-3 bg-gray-500 text-black text-sm font-semibold">
                            <i class="fas fa-angle-right mx-2"></i>
                            Add Location
                        </a>
                    </li>
                    <li class="border-t">
                        <a href="view_location" data-name="View Locations"
                            class="block px-10 py-3 bg-gray-500 text-black text-sm font-semibold">
                            <i class="fas fa-angle-right mx-2"></i>
                            View Locations
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Commission -->
            <li class="border-t">
                <a href="javascript:void(0)" data-name="Set Commission"
                    onclick="toggleMenu('commission', this)"
                    class="flex items-center justify-between px-4 py-3 hover:bg-gray-300">
                    <span class="flex items-center gap-3 text-base font-semibold">
                        <span class="text-lg">💰</span>
                        Set Commission
                    </span>
                    <i class="fas fa-angle-right dropdown-arrow"></i>
                </a>

                <ul id="commission" class="hidden bg-gray-100">
                    <li class="border-t">
                        <a href="add_commission" data-name="Add Commission"
                            class="block px-10 py-3 bg-gray-500 text-black text-sm font-semibold">
                            <i class="fas fa-angle-right mx-2"></i>
                            Add Commission
                        </a>
                    </li>
                    <li class="border-t">
                        <a href="view_commission" data-name="View Commission"
                            class="block px-10 py-3 bg-gray-500 text-black text-sm font-semibold">
                            <i class="fas fa-angle-right mx-2"></i>
                            View Commission
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Reports -->
            <li class="border-t">
                <a href="javascript:void(0)" data-name="Reports"
                    onclick="toggleMenu('reportMenu', this)"
                    class="flex items-center justify-between px-4 py-3 hover:bg-gray-300">
                    <span class="flex items-center gap-3 text-base font-semibold">
                        <span class="text-lg">📊</span>
                        Reports
                    </span>
                    <i class="fas fa-angle-right dropdown-arrow"></i>
                </a>

                <ul id="reportMenu" class="hidden bg-gray-100">
                    <li class="border-t">
                        <a href="total_sales_report" data-name="Total Sales Report"
                            class="block px-10 py-3 bg-gray-500 text-black text-sm font-semibold">
                            <i class="fas fa-angle-right mx-1"></i>
                            Total Sales Report
                        </a>
                    </li>
                    <li class="border-t">
                        <a href="total_commission_report" data-name="Total Commission Report"
                            class="block px-10 py-3 bg-gray-500 text-black text-sm font-semibold">
                            <i class="fas fa-angle-right mx-1"></i>
                            Total Commission Report
                        </a>
                    </li>
                    <li class="border-t">
                        <a href="leader_business_report" data-name="Leader-wise Business Report"
                            class="block px-10 py-3 bg-gray-500 text-black text-sm font-semibold">
                            <i class="fas fa-angle-right mx-1"></i>
                            Leader-wise Business Report
                        </a>
                    </li>
                    <li class="border-t">
                        <a href="advisor_business_report" data-name="Advisor-wise Business Report"
                            class="block px-10 py-3 bg-gray-500 text-black text-sm font-semibold">
                            <i class="fas fa-angle-right mx-1"></i>
                            Advisor-wise Business Report
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Payment -->
            <li class="border-t">
                <a href="javascript:void(0)" data-name="Commission Payment"
                    onclick="toggleMenu('payment', this)"
                    class="flex items-center justify-between px-4 py-3 hover:bg-gray-300">
                    <span class="flex items-center gap-3 text-base font-semibold">
                        <span class="text-lg mb-1">💳</span>
                        Commission <br>Payment
                    </span>
                    <i class="fas fa-angle-right dropdown-arrow"></i>
                </a>

                <ul id="payment" class="hidden bg-gray-100">
                    <li class="border-t">
                        <a href="payment" data-name="Add Commission Payment"
                            class="block px-10 py-3 bg-gray-500 text-black font-semibold">
                            <i class="fas fa-angle-right mx-1"></i>
                            Add Commission Payment
                        </a>
                    </li>
                    <li class="border-t">
                        <a href="view_payment" data-name="Payment Records"
                            class="block px-10 py-3 bg-gray-500 text-black font-semibold">
                            <i class="fas fa-angle-right mx-1"></i>
                            Commission Payment Records
                        </a>
                    </li>
                </ul>
            </li>

        </ul>
    </nav>
</aside>

<script>
    function profileToggle() {
        const profileDropdown = document.getElementById('ProfileDropDown');
        profileDropdown.classList.toggle('hidden');
    }

    function toggleMenu(menuId, el) {
        const menu = document.getElementById(menuId);
        const arrow = el.querySelector('.dropdown-arrow');
        if (arrow) {
            arrow.classList.toggle('rotate-open');
        }

        if (!menu) return;

        menu.classList.toggle('hidden');
    }

    function sidebarToggle() {
        const sidebar = document.getElementById("sidebar");

        if (window.innerWidth >= 768) {
            sidebar.classList.toggle("md:w-64");
            sidebar.classList.toggle("md:w-0");
        } else {
            sidebar.classList.toggle("-translate-x-full");
        }
    }
</script>