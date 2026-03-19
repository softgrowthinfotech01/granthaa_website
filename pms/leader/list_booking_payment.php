<?php include 'header.php'; ?>

<div class="max-w-7xl mx-auto bg-white p-4 rounded-2xl shadow-xl">

    <h2 class="text-2xl font-bold mb-4 text-center">Payment Records</h2>

    <div class="w-full overflow-x-auto">

        <div class="flex justify-between flex-wrap mb-4 mr-4">

            <div>
                <input type="text" id="searchInput"
                    placeholder="Search reference / remark"
                    class="border p-2 rounded w-64">

                <button id="searchBtn"
                    class="bg-blue-500 text-white px-4 py-2 rounded">
                    Search
                </button>
            </div>

            <div>
                <select id="perPage" class="border p-2 rounded">
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                </select>
            </div>

        </div>

        <table class="w-full">

            <thead class="bg-gradient-to-r from-gray-100 to-gray-200 text-gray-700">

                <tr>

                    <th class="p-3 text-left">Customer</th>
                    <th class="p-3 text-left">Amount</th>
                    <th class="p-3 text-left">Payment Type</th>
                    <th class="p-3 text-left">Payment Mode</th>
                    <th class="p-3 text-left">Reference No</th>
                    <th class="p-3 text-left">Remark</th>
                    <th class="p-3 text-left">Date</th>

                </tr>

            </thead>

            <tbody id="paymentData" class="divide-y divide-gray-200">

            </tbody>

        </table>

        <div id="pagination" class="mt-4 flex justify-center items-center gap-2"></div>

    </div>

</div>

<?php include 'footer.php'; ?>

<script src="../url.js"></script>