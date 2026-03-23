<?php include 'header.php'; ?>

<div class="max-w-7xl mx-auto bg-white p-4 rounded-2xl shadow-xl">
    <h2 class="text-xl sm:text-2xl font-bold mb-4 text-center">
        Customer Visit Records
    </h2>

    <!-- Search -->
    <input type="text" id="searchInput"
        placeholder="Search customer visits..."
        class="border p-2 rounded mb-3 w-full sm:w-1/3">

    <!-- Table wrapper -->
    <div class="w-full overflow-x-auto">

        <table id="example"
            class="min-w-[900px] w-full text-sm text-left border border-gray-200">

            <thead class="bg-gray-100 text-gray-700">
                <tr>
                    <th class="p-3 whitespace-nowrap">Site Location</th>
                    <th class="p-3 whitespace-nowrap">Name</th>
                    <th class="p-3 whitespace-nowrap">Email</th>
                    <th class="p-3 whitespace-nowrap">Phone</th>
                    <th class="p-3 whitespace-nowrap">Aadhar</th>
                    <th class="p-3 whitespace-nowrap">Gender</th>
                    <th class="p-3 text-center whitespace-nowrap">Action</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-200">
            </tbody>

        </table>

    </div>

    <div id="pagination" class="mt-4"></div>

</div>

<?php include 'footer.php'; ?>
