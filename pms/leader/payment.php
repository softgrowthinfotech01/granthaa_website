<?php include 'header.php'; ?>

<div class="max-w-7xl mx-auto bg-white p-6  rounded-2xl shadow-xl">

    <h2 class="text-2xl font-semibold text-center mb-6">
        Add Advisor Payment
    </h2>

    <form id="paymentForm" class="space-y-2">

        <!-- ================= PAYMENT DETAILS ================= -->
        <div class="p-6">

            <h3 class="text-xl font-semibold text-gray-800 mb-3 border-b pb-2">
                Payment Details
            </h3>

            <div class="grid md:grid-cols-3 gap-2">

                <!-- USER ID -->
                <div class="space-y-2">
                    <label class="text-sm font-semibold text-gray-700">Advisor</label>
                    <select name="user_id" id="user_id" required
                        class="w-full border border-gray-300 px-5 py-3 rounded-xl focus:ring-2 focus:ring-yellow-400 outline-none">
                        <option value="">Loading...</option>
                    </select>
                </div>

                <div class="space-y-2">
    <label class="text-sm font-semibold text-gray-700">Select Booking</label>
    <select id="booking_id" name="booking_id" required
        class="w-full border border-gray-300 px-5 py-3 rounded-xl">
        <option value="">Select Booking</option>
    </select>
</div>
                
                <!-- Total Commission -->
                <div class="space-y-2">
                    <label class="text-sm font-semibold text-gray-700">Total Commission</label>
                    <input type="text" name="total_commission" id="total_commission" readonly
                        class="w-full border border-gray-300 px-5 py-3 rounded-xl bg-gray-100 outline-none cursor-not-allowed">
                </div>

                <!-- Total Paid -->
                <div class="space-y-2">
                    <label class="text-sm font-semibold text-gray-700">Total Paid</label>
                    <input type="text" name="total_paid" id="total_paid" readonly
                        class="w-full border border-gray-300 px-5 py-3 rounded-xl bg-gray-100 outline-none cursor-not-allowed">
                </div>

                <!-- Balance -->
                <div class="space-y-2">
                    <label class="text-sm font-semibold text-gray-700">Balance Amount</label>
                    <input type="text" name="balance" id="balance" readonly
                        class="w-full border border-gray-300 px-5 py-3 rounded-xl bg-gray-100 outline-none cursor-not-allowed">
                </div>

                <!-- AMOUNT -->
                <div class="space-y-2">
                    <label class="text-sm font-semibold text-gray-700">Payment Amount</label>
                    <input type="number" name="amount" id="amount" required
                        class="w-full border border-gray-300 px-5 py-3 rounded-xl focus:ring-2 focus:ring-yellow-400 outline-none">
                </div>

                <!-- PAYMENT MODE -->
                <div class="space-y-2">
                    <label class="text-sm font-semibold text-gray-700">Payment Mode</label>
                    <select name="payment_mode" id="payment_mode"
                        class="w-full border border-gray-300 px-5 py-3 rounded-xl focus:ring-2 focus:ring-yellow-400 outline-none">

                        <option>Select Payment Mode</option>
                        <option value="cash">Cash</option>
                        <option value="cheque">Cheque</option>
                        <option value="online_transfer">Online Transfer</option>
                        <option value="upi">UPI</option>

                    </select>
                </div>

                <!-- REFERENCE NUMBER -->
                <div class="space-y-2">
                    <label class="text-sm font-semibold text-gray-700">Reference Number</label>
                    <input type="text" name="reference_no" id="reference_no"
                        class="w-full border border-gray-300 px-5 py-3 rounded-xl focus:ring-2 focus:ring-yellow-400 outline-none">
                </div>

                <!-- REMARK -->
                <div class="space-y-2 md:col-span-2">
                    <label class="text-sm font-semibold text-gray-700">Remark</label>
                    <textarea name="remark" id="remark" rows="2"
                        class="w-full border border-gray-300 px-5 py-3 rounded-xl focus:ring-2 focus:ring-yellow-400 outline-none"></textarea>
                </div>

            </div>
        </div>

        <!-- BUTTON -->
        <div class="flex justify-center gap-2 mt-2">

            <button
                class="bg-yellow-500 hover:bg-yellow-600 px-4 py-4 rounded-xl
text-black font-semibold text-lg shadow-md hover:shadow-xl
transition transform hover:scale-[1.02]">

                Record Payment

            </button>

            <button type="button" onclick="confirmReset()"
                class="bg-red-500 hover:bg-red-600 px-4 py-4 rounded-xl
text-black font-semibold text-lg shadow-md hover:shadow-xl
transition transform hover:scale-[1.02]">

                Reset

            </button>

        </div>

    </form>
</div>

<?php include 'footer.php'; ?>
<script src="../url.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", loadLeaders);

    async function loadLeaders() {

        const dropdown = document.getElementById("user_id");
        const token = localStorage.getItem("auth_token");

        try {

            const response = await fetch(url + "commission/leader/advisers-commission", {
                method: "GET",
                headers: {
                    "Authorization": "Bearer " + token,
                    "Accept": "application/json"
                }
            });

            const result = await response.json();

            dropdown.innerHTML = '<option value="">Select Advisor</option>';

            result.data.data.forEach(user => {

                dropdown.innerHTML += `
                <option value="${user.id}">
                    ${user.name}
                </option>
            `;

            });

        } catch (error) {

            console.error(error);
            dropdown.innerHTML = '<option value="">Failed to load leaders</option>';

        }
    }

    // Submit
    document.getElementById('paymentForm').addEventListener('submit', async function(e) {

        e.preventDefault();

        const token = localStorage.getItem('auth_token');
        const user = JSON.parse(localStorage.getItem('auth_user'));

        if (!token || !user) {
            alert('Please login first');
            window.location.href = '../login';
            return;
        }

        let form = document.getElementById('paymentForm');
        let formData = new FormData(form);

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
                alert(data.message || "Payment failed");
                return;
            }

            alert("Payment recorded successfully");

            document.getElementById("paymentForm").reset();

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

                const response = await fetch(url + "by-role?role=adviser&per_page=100", {
                    method: "GET",
                    headers: {
                        "Authorization": "Bearer " + token,
                        "Accept": "application/json"
                    }
                });

                const result = await response.json();

                dropdown.innerHTML = '<option value="">Select Advisor</option>';

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

        document.getElementById("user_id").addEventListener("change", async function () {

    let user_id = this.value;
    const token = localStorage.getItem("auth_token");

    if (!user_id) return;

    const response = await fetch(url + "adviser-details/" + user_id, {
        headers: {
            "Authorization": "Bearer " + token
        }
    });

    const result = await response.json();

    let bookingDropdown = document.getElementById("booking_id");

    bookingDropdown.innerHTML = `<option value="">Select Booking</option>`;

    result.data.forEach((b) => {

        bookingDropdown.innerHTML += `
            <option value="${b.booking_id}"
                data-commission="${b.commission}"
                data-paid="${b.paid}"
                data-balance="${b.balance}">
                
                ${b.plot_number} - ${b.buyer_name}
            </option>
        `;
    });

});
document.getElementById("booking_id").addEventListener("change", function () {

    let selected = this.options[this.selectedIndex];

    if (!selected.value) return;

    document.getElementById("total_commission").value = selected.dataset.commission;
    document.getElementById("total_paid").value = selected.dataset.paid;
    document.getElementById("balance").value = selected.dataset.balance;

    document.getElementById("amount").value = selected.dataset.balance;

});
    </script>