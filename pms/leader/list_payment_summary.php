<?php include 'header.php'; ?>

<div class="max-w-7xl mx-auto px-4 py-6">
    <div class="bg-slate-900 rounded-2xl shadow-2xl border border-slate-700 p-5">
        <div class="mb-4">
            <h2 class="text-2xl text-center font-bold text-gray-600">Team Transaction Summary</h2>
            <p class="text-slate-400 text-center text-sm mt-1">All advisor transaction records</p>
        </div>

        <div class="overflow-x-auto">
            <table id="paymentTable" class="w-full table-fixed text-sm text-slate-200">
                <thead>
                    <tr class="border-b border-slate-700">
                        <th class="px-4 py-3 text-left">#</th>
                        <th class="px-4 py-3 text-left">Advisor</th>
                        <th class="px-4 py-3 text-left">Customer</th>
                        <th class="px-4 py-3 text-left">Plot No.</th>
                        <th class="px-4 py-3 text-right">Booking</th>
                        <th class="px-4 py-3 text-right">Commission</th>
                        <th class="px-4 py-3 text-right">Paid</th>
                        <th class="px-4 py-3 text-right">Balance</th>
                        <th class="px-4 py-3 text-left">Date</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>

<style>
    .dataTables_wrapper {
        color: #e2e8f0 !important;
    }

    .dataTables_length,
    .dataTables_filter,
    .dataTables_info,
    .dataTables_paginate {
        color: #e2e8f0 !important;
    }

    .dataTables_length select,
    .dataTables_filter input {
        background-color: #0f172a !important;
        color: #f8fafc !important;
        border: 1px solid #475569 !important;
        border-radius: 8px !important;
        padding: 6px 10px !important;
    }

    table.dataTable {
        border-collapse: collapse !important;
        width: 100% !important;
        color: #e2e8f0 !important;
        background-color: transparent !important;
    }

    table.dataTable thead th {
        background-color: #111827 !important;
        color: #f8fafc !important;
        border-bottom: 1px solid #334155 !important;
        font-weight: 600 !important;
    }

    table.dataTable tbody td {
        background-color: #0f172a !important;
        color: #e2e8f0 !important;
        border-bottom: 1px solid #1e293b !important;
    }

    table.dataTable tbody tr:hover td {
        background-color: #1e293b !important;
    }

    table.dataTable.no-footer {
        border-bottom: 1px solid #334155 !important;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button {
        color: #e2e8f0 !important;
        border: 1px solid transparent !important;
        border-radius: 8px !important;
        margin: 0 2px;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
        background: #374151 !important;
        color: #fff !important;
        border: 1px solid #4b5563 !important;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
        background: #1e293b !important;
        color: #fff !important;
        border: 1px solid #475569 !important;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.disabled {
        color: #64748b !important;
    }

    table.dataTable tbody tr {
        background-color: transparent !important;
    }

    .dataTables_wrapper .dataTables_length,
    .dataTables_wrapper .dataTables_filter {
        margin-bottom: 16px;
    }

    .dataTables_wrapper .dataTables_info {
        padding-top: 16px !important;
    }

    .dataTables_wrapper .dataTables_paginate {
        padding-top: 12px !important;
    }
</style>

<?php include 'footer.php'; ?>
<script>
    function formatCurrency(value) {
        return '₹' + Number(value || 0).toLocaleString('en-IN');
    }

    function formatDate(dateString) {
        if (!dateString) return '-';
        const date = new Date(dateString);
        return date.toLocaleDateString('en-GB');
    }

    function normalizeRecords(data) {
        if (Array.isArray(data)) return data;
        if (data && Array.isArray(data.data)) return data.data;
        if (data && Array.isArray(data.records)) return data.records;
        if (data && typeof data === 'object') return [data];
        return [];
    }

    async function loadPaymentRecords() {

        const token = localStorage.getItem("auth_token");
const user = JSON.parse(localStorage.getItem("auth_user"));

        if (!token) {
            alert("Session expired. Please login again.");
            window.location.href = "../login";
            return;
        }

        try {
            const response = await fetch(url + `commission/payments/created-by/${user.id}`, {
                method: "GET",
                headers: {
                    "Accept": "application/json",
                    "Authorization": "Bearer " + token
                }
            });

            if (response.status === 401) {
                localStorage.removeItem("token");
                window.location.href = "login.html";
                return;
            }

            const data = await response.json();
            console.log("API response:", data);

            const records = normalizeRecords(data);

            if ($.fn.DataTable.isDataTable('#paymentTable')) {
                $('#paymentTable').DataTable().destroy();
            }

            const tbody = document.querySelector('#paymentTable tbody');
            tbody.innerHTML = '';

            if (!records.length) {
                tbody.innerHTML = `
                    <tr>
                        <td colspan="9" class="text-center py-6 text-slate-400">
                            No payment records found
                        </td>
                    </tr>
                `;
                return;
            }

            records.forEach((item, index) => {
                tbody.innerHTML += `
                    <tr>
                        <td>${index + 1}</td>
                        <td>${item.advisor_name ?? item.advisor ?? '-'}</td>
                        <td>${item.customer ?? '-'}</td>
                        <td>${item.plot_number ?? '-'}</td>
                        <td class="text-right">${formatCurrency(item.amount)}</td>
                        <td class="text-right">${formatCurrency(item.commission)}</td>
                        <td class="text-right text-emerald-400">${formatCurrency(item.paid)}</td>
                        <td class="text-right text-rose-400">${formatCurrency(item.balance)}</td>
                        <td>${formatDate(item.date)}</td>
                    </tr>
                `;
            });

            $('#paymentTable').DataTable({
                pageLength: 10,
                lengthMenu: [10, 25, 50, 100],
                responsive: true,
                autoWidth: false
            });

        } catch (error) {
            console.error('Error loading payment records:', error);

            document.querySelector('#paymentTable tbody').innerHTML = `
                <tr>
                    <td colspan="9" class="text-center py-6 text-red-400">
                        Failed to load payment records
                    </td>
                </tr>
            `;
        }
    }

    document.addEventListener('DOMContentLoaded', loadPaymentRecords);
</script>