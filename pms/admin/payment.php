<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Record Payment</title>

    <link rel="stylesheet" href="../style.css">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.css" rel="stylesheet" />

</head>

<body>

    <div class="mx-auto">

        <div class="flex flex-col">

            <?php include "header.php"; ?>

            <div class="flex">

                <?php include 'sidebar.php'; ?>

                <!-- Main Content -->
                <div id="mainContent"
                    class="w-full md:w-[80%] lg:w-[75%] mx-3 md:mx-auto my-4
                            transition-all duration-300">

                    <form class="w-full px-4 rounded-lg bg-gray-200 p-6 border shadow-xl" method="post" id="paymentForm">

                        <h5 class="text-xl font-bold text-heading p-1 mb-4">
                            Add Payment
                        </h5>

                        <div class="grid grid-cols-1 md:grid-cols-2">

                            <!-- USER ID -->
                            <div class="mb-5 px-1">
                                <label class="block mb-2.5 text-sm font-medium text-heading">
                                    Leader Name
                                </label>

                                <select name="user_id" id="user_id"
                                    class="block w-full px-3 py-2.5 rounded-lg bg-white border border-default-medium text-heading text-sm shadow-xs"
                                    required>

                                    <option value="">Loading...</option>

                                </select>
                            </div>

                            <div class="mb-5 px-1">
                                <label class="block mb-2.5 text-sm font-medium text-heading">
                                    Select Booking
                                </label>

                                <select id="booking_id" name="booking_id"
                                    class="block w-full px-3 py-2.5 rounded-lg bg-white border border-default-medium text-heading text-sm shadow-xs"
                                    required>

                                    <option value="">Select Booking</option>

                                </select>
                            </div>

                            <!-- Total Commission -->
                            <div class="mb-5 px-1">
                                <label class="block mb-2.5 text-sm font-medium text-heading">
                                    Total Commission
                                </label>

                                <input name="total_commission" type="text" id="total_commission"
                                    class="rounded-lg bg-neutral-secondary-medium border border-default-medium text-heading text-sm block w-full px-3 py-2.5 shadow-xs"
                                    placeholder="Enter amount" readonly />
                            </div>

                            <!-- Total Paid -->
                            <div class="mb-5 px-1">
                                <label class="block mb-2.5 text-sm font-medium text-heading">
                                    Total Paid
                                </label>

                                <input name="total_paid" type="number" id="total_paid"
                                    class="rounded-lg bg-neutral-secondary-medium border border-default-medium text-heading text-sm block w-full px-3 py-2.5 shadow-xs"
                                    placeholder="Enter amount" readonly />
                            </div>

                            <!-- Balance -->
                            <div class="mb-5 px-1">
                                <label class="block mb-2.5 text-sm font-medium text-heading">
                                    Balance
                                </label>

                                <input name="balance" type="number" id="balance"
                                    class="rounded-lg bg-neutral-secondary-medium border border-default-medium text-heading text-sm block w-full px-3 py-2.5 shadow-xs"
                                    placeholder="Enter amount" readonly />
                            </div>

                            <!-- AMOUNT -->
                            <div class="mb-5 px-1">
                                <label class="block mb-2.5 text-sm font-medium text-heading">
                                    Payment Amount
                                </label>

                                <input name="amount" type="number" id="amount"
                                    class="rounded-lg bg-neutral-secondary-medium border border-default-medium text-heading text-sm block w-full px-3 py-2.5 shadow-xs"
                                    placeholder="Enter amount" required />
                            </div>

                            <!-- PAYMENT MODE -->
                            <div class="mb-5 px-1">

                                <label class="block mb-2.5 text-sm font-medium text-heading">
                                    Payment Mode
                                </label>

                                <select name="payment_mode" id="payment_mode"
                                    class="block w-full px-3 py-2.5 rounded-lg bg-white border border-default-medium text-heading text-sm shadow-xs">

                                    <option selected>Select Payment Mode</option>
                                    <option value="cash">Cash</option>
                                    <option value="cheque">Cheque</option>
                                    <option value="online_transfer">Online Transfer</option>
                                    <option value="upi">UPI</option>

                                </select>

                            </div>

                            <!-- REFERENCE NUMBER -->
                            <div class="mb-5 px-1">

                                <label class="block mb-2.5 text-sm font-medium text-heading">
                                    Reference Number
                                </label>

                                <input name="reference_no" type="text" id="reference_no"
                                    class="rounded-lg bg-neutral-secondary-medium border border-default-medium text-heading text-sm block w-full px-3 py-2.5 shadow-xs"
                                    placeholder="Enter transaction reference" />

                            </div>

                            <!-- REMARK -->
                            <div class="mb-5 px-1 md:col-span-2">

                                <label class="block mb-2.5 text-sm font-medium text-heading">
                                    Remark
                                </label>

                                <textarea name="remark" id="remark" rows="3"
                                    class="rounded-lg bg-white border border-default-medium text-heading text-sm block w-full px-3 py-2.5 shadow-xs"
                                    placeholder="Enter remark"></textarea>

                            </div>

                        </div>

                        <hr class="border-white-300 mb-3">

                        <div class="flex justify-center gap-3">

                            <button type="submit"
                                class="w-full md:w-[20%] text-white bg-blue-600 hover:bg-blue-500 rounded-lg text-sm px-4 py-2.5">

                                Save Payment

                            </button>

                            <button type="button"
                                onclick="confirmReset()"
                                class="w-full md:w-[20%] text-gray-700 bg-white hover:bg-gray-200 rounded-lg text-sm px-4 py-2.5">

                                Reset

                            </button>

                        </div>

                    </form>


                </div>

            </div>

            <?php include 'footer.php'; ?>

        </div>

    </div>

    <script>
        function confirmReset() {
            if (confirm("Clear all entered data?")) {
                document.querySelector("form").reset();
            }
        }

        document.getElementById("paymentForm").addEventListener("submit", async function(e) {

            e.preventDefault();

            const form = document.getElementById("paymentForm");

            const token = localStorage.getItem('auth_token');
            const user = JSON.parse(localStorage.getItem('auth_user'));

            if (!token || !user) {
                alert("Please login first");
                window.location.href = "../login";
                return;
            }

            let booking_id = document.getElementById("booking_id").value;

            if (!booking_id) {
                alert("Please select a booking");
                return;
            }

            let formData = new FormData(form);

            formData.set("created_by", user.id);
            formData.set("booking_id", booking_id);

            try {

                const response = await fetch(url + "commission/payment", {
                    method: "POST",
                    headers: {
                        "Authorization": "Bearer " + token,
                        "Accept": "application/json"
                    },
                    body: formData
                });

                const data = await response.json();

                if (!response.ok) {
                    alert(data.message || "Error");
                    return;
                }

                alert("✅ " + data.message);

                form.reset();

            } catch (error) {
                console.error(error);
                alert("Server error");
            }

        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", loadUsers);

        async function loadUsers() {

            const dropdown = document.getElementById("user_id");
            const token = localStorage.getItem("auth_token");

            try {

                const response = await fetch(url + "by-role?role=leader&per_page=100", {
                    method: "GET",
                    headers: {
                        "Authorization": "Bearer " + token,
                        "Accept": "application/json"
                    }
                });

                const result = await response.json();

                dropdown.innerHTML = '<option value="">Select Leader</option>';

                result.data.data.forEach(user => {

                    dropdown.innerHTML += `
                <option value="${user.id}">
                    ${user.user_code} - ${user.name}
                </option>
            `;

                });

            } catch (error) {

                console.error(error);
                dropdown.innerHTML = '<option value="">Failed to load users</option>';

            }
        }

        document.getElementById("user_id").addEventListener("change", async function() {

            let leader_id = this.value;
            const token = localStorage.getItem("auth_token");

            if (!leader_id) return;

            const response = await fetch(url + "leader-details/" + leader_id, {
                headers: {
                    "Authorization": "Bearer " + token
                }
            });

            const result = await response.json();

            let bookings = result.data;
            let bookingDropdown = document.getElementById("booking_id");

            bookingDropdown.innerHTML = `<option value="">Select Booking</option>`;

            bookings.forEach((b) => {
                bookingDropdown.innerHTML += `
            <option value="${b.booking_id}"
                data-total-commission="${b.total_commission}"
                data-paid="${b.paid}"
                data-balance="${b.total_balance}">
                ${b.plot_number} - ${b.buyer_name} (${b.role})
            </option>
        `;
            });

            document.getElementById("total_commission").value = "";
            document.getElementById("total_paid").value = "";
            document.getElementById("balance").value = "";
            document.getElementById("amount").value = "";
        });

        document.getElementById("booking_id").addEventListener("change", function() {

            let selected = this.options[this.selectedIndex];

            if (!selected.value) return;

            let totalCommission = selected.dataset.totalCommission;
            let paid = selected.dataset.paid;
            let balance = selected.dataset.balance;
            let total_balance = selected.dataset.total_balance;

            document.getElementById("total_commission").value = totalCommission || "";
            document.getElementById("total_paid").value = paid || "";
            document.getElementById("balance").value = total_balance || "";
            document.getElementById("amount").value = total_balance || "";
        });

        let amount = parseFloat(document.getElementById("amount").value);
let balance = parseFloat(document.getElementById("balance").value);

if (amount > balance) {
    alert("Amount cannot exceed balance");
    return;
}
    </script>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.js"></script>

</body>

</html>