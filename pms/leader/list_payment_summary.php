<?php include 'header.php'; ?>

<div class="max-w-7xl mx-auto bg-white p-4 sm:p-6 rounded-2xl shadow-xl">

    <h2 class="text-xl sm:text-2xl font-bold mb-4 text-center text-gray-800">
        Team Transaction Summary
    </h2>

    <p class="text-gray-500 text-center text-sm mb-4">
        All advisor transaction records
    </p>

    <div class="w-full overflow-x-auto">

        <table id="paymentTable"
            class="min-w-[700px] w-full text-sm border border-gray-200 rounded-xl overflow-hidden">

            <thead class="bg-gray-200 text-gray-700">
                <tr>
                    <th class="p-3 text-left">#</th>
                    <th class="p-3 text-left">Advisor</th>
                    <th class="p-3 text-left">Customer</th>
                    <th class="p-3 text-left">Plot No.</th>
                    <th class="p-3 text-right">Booking</th>
                    <th class="p-3 text-right">Commission</th>
                    <th class="p-3 text-right">Paid</th>
                    <th class="p-3 text-right">Balance</th>
                    <th class="p-3 text-left">Date</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-700"></tbody>

        </table>
    </div>

</div>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>

<style>

/* Wrapper */
.dataTables_wrapper {
    color: #374151 !important;
    font-size: 14px;
}

/* Top controls layout */
.dataTables_wrapper .dataTables_length,
.dataTables_wrapper .dataTables_filter {
    margin-bottom: 12px;
}

/* Align like Tailwind */
.dataTables_wrapper .dataTables_filter {
    text-align: right;
}

/* Inputs */
.dataTables_length select,
.dataTables_filter input {
    border: 1px solid #a7a8aa !important;
    border-radius: 8px !important;
    padding: 6px 10px !important;
    background: white !important;
    color: #111827 !important;
    outline: none;
}

/* Table */
table.dataTable {
    border-collapse: collapse !important;
}

/* Header */
table.dataTable thead th {
    background-color: #e7e7e8 !important;
    color: #374151 !important;
    font-weight: 600 !important;
    border-bottom: 1px solid #000000 !important;
    text-align: center !important;
}

/* Body */
table.dataTable tbody td {
    background-color: #fdfdfd !important;
    border-bottom: 1px solid #000000 !important;
     text-align: center !important;
}

/* Hover */
table.dataTable tbody tr:hover td {
    background-color: #f9fafb !important;
}

/* Pagination */
.dataTables_wrapper .dataTables_paginate {
    margin-top: 12px;
}

/* Buttons */
.dataTables_wrapper .dataTables_paginate .paginate_button {
    border: 1px solid #d1d5db !important;
    border-radius: 6px !important;
    padding: 4px 10px !important;
    margin: 0 2px;
    background: white !important;
    color: #374151 !important;
}

/* Active */
.dataTables_wrapper .dataTables_paginate .paginate_button.current {
    background: #3b82f6 !important;
    color: white !important;
    border: none !important;
}

/* Hover */
.dataTables_wrapper .dataTables_paginate .paginate_button:hover {
    background: #e5e7eb !important;
}

/* Info text */
.dataTables_info {
    color: #6b7280 !important;
    margin-top: 10px;
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
    if (data && typeof data === 'object') return [data];
    return [];
}

let bookingsMap = {};
let usersMap = {}; // 🔥 NEW

/* ================= LOAD BOOKINGS ================= */
async function loadBookingsMap() {

    const token = localStorage.getItem("auth_token");

    const res = await fetch(url + "bookings?per_page=1000", {
        headers: {
            "Authorization": "Bearer " + token
        }
    });

    const data = await res.json();
    let bookings = data.data?.data ?? [];

    bookings.forEach(b => {
        bookingsMap[b.id] = b;
    });
}


/* ================= LOAD USERS (ADVISORS) ================= */
async function loadUsersMap() {

    const token = localStorage.getItem("auth_token");

    const res = await fetch(url + "users?role=adviser&per_page=1000", {
        headers: {
            "Authorization": "Bearer " + token
        }
    });

    const data = await res.json();
    let users = data.data?.data ?? [];

    users.forEach(u => {
        usersMap[u.id] = u;
    });
}


/* ================= MAIN LOAD ================= */
async function loadPaymentRecords() {

    const token = localStorage.getItem("auth_token");
    const user = JSON.parse(localStorage.getItem("auth_user"));

    if (!token || !user) {
        alert("Session expired. Please login again.");
        window.location.href = "../login";
        return;
    }

    try {

        // 🔥 LOAD ALL DATA FIRST
        await loadBookingsMap();
        await loadUsersMap();

        const response = await fetch(url + `commission/payments/created-by/${user.id}`, {
            method: "GET",
            headers: {
                "Accept": "application/json",
                "Authorization": "Bearer " + token
            }
        });

        const data = await response.json();
        const records = normalizeRecords(data.data);

        if ($.fn.DataTable.isDataTable('#paymentTable')) {
            $('#paymentTable').DataTable().destroy();
        }

        const tbody = document.querySelector('#paymentTable tbody');
        tbody.innerHTML = '';

        if (!records.length) {
            tbody.innerHTML = `
                <tr>
                    <td colspan="9" class="text-center py-6 text-gray-400">
                        No payment records found
                    </td>
                </tr>
            `;
            return;
        }

        records.forEach((item, index) => {

            const booking = bookingsMap[item.booking_id] || {};

            // 🔥 GET ADVISOR
            const advisor = usersMap[booking.adviser_id] || {};

            let paid = Math.abs(parseFloat(item.amount) || 0);
            let total = parseFloat(booking.total_booking_amount) || 0;
            let commission = parseFloat(booking.commission_amount) || 0;

            let balance = total - paid;

            tbody.innerHTML += `
                <tr>
                    <td>${index + 1}</td>

                    <!-- ✅ ADVISOR NAME -->
                    <td>
                        ${advisor.name ?? '-'}
                    </td>

                    <!-- ✅ CUSTOMER -->
                    <td>
                        ${booking.user_code ?? ''} - ${booking.buyer_name ?? '-'}
                    </td>

                    <!-- ✅ PLOT -->
                    <td>${booking.plot_number ?? '-'}</td>

                    <!-- ✅ BOOKING -->
                    <td class="text-right font-semibold">
                        ${formatCurrency(total)}
                    </td>

                    <!-- ✅ COMMISSION -->
                    <td class="text-right text-blue-600">
                        ${formatCurrency(commission)}
                    </td>

                    <!-- ✅ PAID -->
                    <td class="text-right text-green-600 font-semibold">
                        ${formatCurrency(paid)}
                    </td>

                    <!-- ✅ BALANCE -->
                    <td class="text-right text-red-500 font-semibold">
                        ${formatCurrency(balance)}
                    </td>

                    <!-- ✅ DATE -->
                    <td>${formatDate(item.created_at)}</td>
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
                <td colspan="9" class="text-center py-6 text-red-500">
                    Failed to load payment records
                </td>
            </tr>
        `;
    }
}

/* ================= INIT ================= */
document.addEventListener('DOMContentLoaded', loadPaymentRecords);
</script>