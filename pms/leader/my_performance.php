<?php include 'header.php'; ?>
<!-- http://127.0.0.1:8000/api/adviserPerformance -->
<div class="max-w-7xl mx-auto bg-white p-4 rounded-2xl shadow-xl">

    <h2 class="text-2xl font-bold mb-4 text-center">
        My Commission Records
    </h2>

    <!-- Table Wrapper -->
    <div class="w-full overflow-x-auto">

        <table id="example" class="" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">

            <thead class="bg-gradient-to-r from-gray-100 to-gray-200 text-gray-700">
                <tr>
                    <th data-priority="1" class="p-3 font-semibold">#</th>
                    <th data-priority="2" class="p-3 font-semibold">Customer</th>
                    <th data-priority="3" class="p-3 font-semibold">Plot No.</th>
                    <th data-priority="4" class="p-3 font-semibold">Total Commission</th>
                    <th data-priority="5" class="p-3 font-semibold">Paid</th>
                    <th data-priority="6" class="p-3 font-semibold">Balance</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-200 text-center">
            </tbody>

        </table>

    </div>

</div>

<?php include 'footer.php'; ?>




<!-- jQuery -->
<script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

<!--Datatables -->
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script src="../url.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", loadTable);

    async function loadTable() {

        const token = localStorage.getItem("auth_token");
        const user = JSON.parse(localStorage.getItem("auth_user"));
        const leaderId = user?.id;

        if (!leaderId) {
            alert("Leader ID not found");
            return;
        }

        try {

            const response = await fetch(url + "leader-details/" + leaderId, { 
                method: "GET",
                headers: {
                    "Authorization": "Bearer " + token,
                    "Accept": "application/json"
                }
            });

            const result = await response.json();

            const table = $('#example').DataTable({
                responsive: true,
                destroy: true
            });

            table.clear();

            let data = result.data || [];

            if (!data || data.length === 0) {
                document.querySelector("#example tbody").innerHTML = `
                <tr>
                    <td colspan="7" class="p-4 text-center text-gray-500">
                        No records found
                    </td>
                </tr>
            `;
                return;
            }

            data.forEach((row, index) => {

                let serial = index + 1;

                // ✅ USE backend values directly
                let total = parseFloat(row.total_commission || 0);
                let paid = parseFloat(row.paid || 0);
                let balance = parseFloat(row.total_balance || 0);

        let balanceHtml = balance === 0
  ? `<span class="bg-green-100 text-green-700 px-2 py-1 rounded-full text-sm font-semibold">
       ✔ Paid
     </span>`
  : `<span class="text-red-500 font-bold">
       ₹ ${balance.toLocaleString('en-IN')}
     </span>`;
                table.row.add([
    serial,
    `${row.buyer_name ?? '-'} (Cr. by ${row.role ?? '-'})`,
    row.plot_number ?? '-',

    // 🔵 Total Commission
    `<span class="text-blue-600 font-semibold">
        ₹ ${total.toLocaleString('en-IN')}
     </span>`,

    // 🟢 Paid
    `<span class="text-green-600 font-bold">
        ₹ ${paid.toLocaleString('en-IN')}
     </span>`,

    // 🔥 Balance (fixed)
    balanceHtml
]);

            });

            table.draw();

        } catch (error) {

            console.error(error);

            document.querySelector("#example tbody").innerHTML = `
            <tr>
                <td colspan="7" class="p-4 text-center text-red-500">
                    Failed to load data
                </td>
            </tr>
        `;
        }
    }
</script>