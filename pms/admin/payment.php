<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Record Payment</title>

    <link rel="stylesheet" href="../style.css">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.css" rel="stylesheet" />

</head>

<body class="bg-gray-200">

 <div class="mx-auto">

    <div class="flex flex-col min-h-screen">

        <?php include "header.php"; ?>

        <div class="flex flex-1 flex-col md:flex-row">

            <?php include 'sidebar.php'; ?>

            <!-- MAIN -->
            <div id="mainContent"
                class="w-full md:w-[80%] lg:w-[60%] xl:w-[50%] 
                mx-auto my-6 px-3">

                <!-- CARD -->
                <form method="post" id="paymentForm"
                    class="bg-white p-5 md:p-6 rounded-2xl shadow-lg border border-gray-200">

                    <!-- TITLE -->
                    <div class="mb-5 text-center">
                        <h2 class="text-xl md:text-2xl font-bold text-gray-800">
                            Add Payment
                        </h2>
                        <p class="text-sm text-gray-500">Enter payment details</p>
                    </div>

                    <!-- GRID -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                        <!-- USER -->
                        <div>
                            <label class="block mb-1 text-sm text-gray-700">Leader Name</label>
                            <select name="user_id" id="user_id"
                                class="w-full px-3 py-2.5 rounded-lg border border-gray-300 bg-white text-sm focus:ring-2 focus:ring-blue-500 outline-none"
                                required>
                                <option value="">Loading...</option>
                            </select>
                        </div>

                        <!-- BOOKING -->
                        <div>
                            <label class="block mb-1 text-sm text-gray-700">Select Booking</label>
                            <select id="booking_id" name="booking_id"
                                class="w-full px-3 py-2.5 rounded-lg border border-gray-300 bg-white text-sm focus:ring-2 focus:ring-blue-500 outline-none"
                                required>
                                <option value="">Select Booking</option>
                            </select>
                        </div>

                        <!-- TOTAL COMMISSION -->
                        <div>
                            <label class="block mb-1 text-sm text-gray-700">Total Commission</label>
                            <input name="total_commission" type="text" id="total_commission"
                                class="w-full px-3 py-2.5 rounded-lg border border-gray-200 bg-gray-100 text-sm"
                                readonly />
                        </div>

                        <!-- TOTAL PAID -->
                        <div>
                            <label class="block mb-1 text-sm text-gray-700">Total Paid</label>
                            <input name="total_paid" type="number" id="total_paid"
                                class="w-full px-3 py-2.5 rounded-lg border border-gray-200 bg-gray-100 text-sm"
                                readonly />
                        </div>

                        <!-- BALANCE -->
                        <div>
                            <label class="block mb-1 text-sm text-gray-700">Balance</label>
                            <input name="balance" type="number" id="balance"
                                class="w-full px-3 py-2.5 rounded-lg border border-gray-200 bg-gray-100 text-sm"
                                readonly />
                        </div>

                        <!-- AMOUNT -->
                        <div>
                            <label class="block mb-1 text-sm text-gray-700">Payment Amount</label>
                            <input name="amount" type="number" id="amount"
                                class="w-full px-3 py-2.5 rounded-lg border border-gray-300 text-sm focus:ring-2 focus:ring-blue-500 outline-none"
                                placeholder="Enter amount" required />
                        </div>

                        <!-- PAYMENT MODE -->
                        <div>
                            <label class="block mb-1 text-sm text-gray-700">Payment Mode</label>
                            <select name="payment_mode" id="payment_mode" required
                                class="w-full px-3 py-2.5 rounded-lg border border-gray-300 bg-white text-sm focus:ring-2 focus:ring-blue-500 outline-none">
                                <option value="" disabled selected hidden>Select Payment Mode</option>
                                <option value="cash">Cash</option>
                                <option value="cheque">Cheque</option>
                                <option value="online_transfer">Online Transfer</option>
                                <option value="upi">UPI</option>
                            </select>
                        </div>

                        <!-- REFERENCE -->
                        <div>
                            <label class="block mb-1 text-sm text-gray-700">Reference Number</label>
                            <input name="reference_no" type="text" id="reference_no"
                                class="w-full px-3 py-2.5 rounded-lg border border-gray-300 text-sm focus:ring-2 focus:ring-blue-500 outline-none"
                                placeholder="Enter transaction reference" />
                        </div>

                        <!-- REMARK -->
                        <div class="md:col-span-2">
                            <label class="block mb-1 text-sm text-gray-700">Remark</label>
                            <textarea name="remark" id="remark" rows="3"
                                class="w-full px-3 py-2.5 rounded-lg border border-gray-300 text-sm focus:ring-2 focus:ring-blue-500 outline-none"
                                placeholder="Enter remark"></textarea>
                        </div>

                    </div>

                    <hr class="my-6">

                    <!-- BUTTONS -->
                    <div class="flex flex-col md:flex-row justify-center gap-3">

                        <button type="submit"
                            class="w-full md:w-[180px] bg-blue-600 hover:bg-blue-500 text-white rounded-lg px-4 py-2.5 transition">
                            Save Payment
                        </button>

                        <button type="button"
                            onclick="confirmReset()"
                            class="w-full md:w-[180px] bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-lg px-4 py-2.5 border">
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

      let isSubmitting = false;

document.getElementById("paymentForm").addEventListener("submit", async function(e) {

    e.preventDefault();

    // 🚫 prevent double click
    if (isSubmitting) return;
    isSubmitting = true;

    let submitBtn = document.querySelector("button[type='submit']");
    submitBtn.disabled = true;
    submitBtn.innerText = "Processing...";

    let amount = parseFloat(document.getElementById("amount").value);
    let balance = parseFloat(document.getElementById("balance").value);

    if (amount > balance) {
        alert("Amount cannot exceed balance");

        // 🔄 reset
        isSubmitting = false;
        submitBtn.disabled = false;
        submitBtn.innerText = "Save Payment";
        return;
    }

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

        isSubmitting = false;
        submitBtn.disabled = false;
        submitBtn.innerText = "Save Payment";
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

            isSubmitting = false;
            submitBtn.disabled = false;
            submitBtn.innerText = "Save Payment";
            return;
        }

  alert("✅ " + data.message);

form.reset();

// 🔥 Show success temporarily
submitBtn.innerText = "Saved ✔";

// 🔄 Reset button after 1.5 sec
setTimeout(() => {
    isSubmitting = false;
    submitBtn.disabled = false;
    submitBtn.innerText = "Save Payment";
}, 1500);

    } catch (error) {
        console.error(error);
        alert("Server error");

        isSubmitting = false;
        submitBtn.disabled = false;
        submitBtn.innerText = "Save Payment";
    }

});
   
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

    document.getElementById("total_commission").value = totalCommission || "";
    document.getElementById("total_paid").value = paid || "";
    document.getElementById("balance").value = balance || "";
    document.getElementById("amount").value = balance || "";
});

    </script>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.js"></script>

</body>

</html>