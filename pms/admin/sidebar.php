<link rel="stylesheet" href="../style.css">

<!-- Sidebar -->
<aside id="sidebar" class="w-64 min-h-screen bg-gray-400 border-r border-gray-200 flex flex-col
                            transition-all duration-500 ease-in-out transform">
    <!-- Menu -->
    <nav class="flex-1">
        <ul class="text-sm text-gray-700">

            <!-- Active Item -->
            <li class="bg-gray-300">
                <a href="home"
                    class="flex items-center justify-between px-4 py-4">
                    <span class="flex items-center gap-3 text-base font-semibold text-base font-semibold">
                        <i class="fas fa-tachometer-alt"></i>
                        Dashboard
                    </span>
                </a>
            </li>

            <li class="border-t">
                <a href="javascript:void(0)"
                    onclick="toggleMenu('categoryMenu', this)"
                    class="flex items-center justify-between px-4 py-4 hover:bg-gray-300">
                    <span class="flex items-center gap-3 text-base font-semibold">
                        <i class="fa-solid fa-users"></i>
                        Leaders
                    </span>
                    <i class="fas fa-angle-right transition-transform"></i>
                </a>

                <ul id="categoryMenu" class="hidden bg-gray-100">
                    <li class="border-t">
                        <a href="add_leader"
                            class="block px-10 py-3 bg-gray-500 text-white text-sm font-semibold">
                            <i class="fas fa-angle-right transition-transform mx-2"></i>
                            Add Leader
                        </a>
                    </li>
                    <li class="border-t">
                        <a href="view_leader"
                            class="block px-10 py-3 bg-gray-500 text-white text-sm font-semibold">
                            <i class="fas fa-angle-right transition-transform mx-2"></i>
                            View Leaders
                        </a>
                    </li>
                </ul>
            </li>

            <li class="border-t">
                <a href="javascript:void(0)"
                    onclick="toggleMenu('location', this)"
                    class="flex items-center justify-between px-4 py-4 hover:bg-gray-300">
                    <span class="flex items-center gap-3 text-base font-semibold">
                       <i class="fa-solid fa-location-dot"></i>
                        Location
                    </span>
                    <i class="fas fa-angle-right transition-transform"></i>
                </a>

                <ul id="location" class="hidden bg-gray-100">
                    <li class="border-t">
                        <a href="add_location"
                            class="block px-10 py-3 bg-gray-500 text-white text-sm font-semibold">
                            <i class="fas fa-angle-right transition-transform mx-2"></i>
                            Add Location
                        </a>
                    </li>
                    <li class="border-t">
                        <a href="view_location"
                            class="block px-10 py-3 bg-gray-500 text-white text-sm font-semibold">
                            <i class="fas fa-angle-right transition-transform mx-2"></i>
                            View Locations
                        </a>
                    </li>
                </ul>
            </li>

            <li class="border-t">
                <a href="javascript:void(0)"
                    onclick="toggleMenu('commission', this)"
                    class="flex items-center justify-between px-4 py-4 hover:bg-gray-300">
                    <span class="flex items-center gap-3 text-base font-semibold">
                        <i class="fa-solid fa-users"></i>
                       Set Commission
                    </span>
                    <i class="fas fa-angle-right transition-transform"></i>
                </a>

                <ul id="commission" class="hidden bg-gray-100">
                    <li class="border-t">
                        <a href="add_commission"
                            class="block px-10 py-3 bg-gray-500 text-white text-sm font-semibold">
                            <i class="fas fa-angle-right transition-transform mx-2"></i>
                            Add Commission
                        </a>
                    </li>
                    <li class="border-t">
                        <a href="view_commission"
                            class="block px-10 py-3 bg-gray-500 text-white  text-sm font-semibold">
                            <i class="fas fa-angle-right transition-transform mx-2"></i>
                            View Commission
                        </a>
                    </li>
                </ul>
            </li>


            <li class="border-t">
                <a href="javascript:void(0)"
                    onclick="toggleMenu('reportMenu', this)"
                    class="flex items-center justify-between px-4 py-4 hover:bg-gray-300">
                    <span class="flex items-center gap-3 text-base font-semibold">
                        <i class="fa fa-file"></i>
                        Reports
                    </span>
                    <i class="fas fa-angle-right transition-transform"></i>
                </a>

                <ul id="reportMenu" class="hidden bg-gray-100">
                    <li class="border-t">
                        <a href="product_add"
                            class="block px-10 py-3 bg-gray-500 text-white text-sm font-semibold">
                            <i class="fas fa-angle-right transition-transform mx-1"></i>
                            Total Sales Report
                        </a>
                    </li>
                    <li class="border-t">
                        <a href="product_view"
                            class="block px-10 py-3 bg-gray-500 text-white text-sm font-semibold">
                            <i class="fas fa-angle-right transition-transform mx-1"></i>
                            Total Commission Report
                        </a>
                    </li>
                    <li class="border-t">
                        <a href="product_add"
                            class="block px-10 py-3 bg-gray-500 text-white text-sm font-semibold">
                            <i class="fas fa-angle-right transition-transform mx-1"></i>
                            Leader-wise Business Report
                        </a>
                    </li>
                    <li class="border-t">
                        <a href="product_add"
                            class="block px-10 py-3 bg-gray-500 text-white text-sm font-semibold">
                            <i class="fas fa-angle-right transition-transform mx-1"></i>
                            Advisor-wise Business Report
                        </a>
                    </li>
                    <li class="border-t">
                        <a href="product_add"
                            class="block px-10 py-3 bg-gray-500 text-white  text-sm font-semibold">
                            <i class="fas fa-angle-right transition-transform mx-1"></i>
                            Project-wise Sales Report
                        </a>
                    </li>
                </ul>
            </li>

            <li class="border-t">
                <a href="javascript:void(0)"
                    onclick="toggleMenu('commissionReport', this)"
                    class="flex items-center justify-between px-4 py-4 hover:bg-gray-300">
                    <span class="flex items-center gap-3 text-base font-semibold">
                        <i class="fas fa-receipt"></i>
                        Commission Records
                    </span>
                    <i class="fas fa-angle-right transition-transform"></i>
                </a>

                <ul id="commissionReport" class="hidden bg-gray-100">
                    <li class="border-t">
                        <a href="add_leader"
                            class="block px-10 py-3 bg-gray-500 text-white">
                            
                        </a>
                    </li>
                    <li class="border-t">
                        <a href="view_leader"
                            class="block px-10 py-3 bg-gray-500 text-white">
                            
                        </a>
                    </li>
                    
                </ul>
            </li>

            <!-- <li class="border-t">
                <a href="javascript:void(0)"
                    onclick="toggleMenu('pReports', this)"
                    class="flex items-center justify-between px-4 py-4 hover:bg-gray-300">
                    <span class="flex items-center gap-3 text-base font-semibold">
                       <i class="fa-solid fa-building-circle-arrow-right"></i>
                        Projects and Properties
                    </span>
                    <i class="fas fa-angle-right transition-transform"></i>
                </a>

                <ul id="pReports" class="hidden bg-gray-100">
                    <li class="border-t">
                        <a href="add_leader"
                            class="block px-10 py-3 bg-gray-500 text-white">
                            
                        </a>
                    </li>
                    <li class="border-t">
                        <a href="view_leader"
                            class="block px-10 py-3 bg-gray-500 text-white">
                            
                        </a>
                    </li>
                    
                </ul>
            </li> -->

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
        const arrow = el.querySelector('.fa-angle-right');

        if (!menu) {
            console.error('Menu not found:', menuId);
            return;
        }

        menu.classList.toggle('hidden');
        arrow.classList.toggle('rotate-45');
    }

    function sidebarToggle() {
        const sidebar = document.getElementById('sidebar');
        sidebar.classList.toggle('-translate-x-full');
    }
</script>