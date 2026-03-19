<?php include 'header.php'; ?>

<div class="max-w-7xl mx-auto bg-white p-6  rounded-2xl shadow-xl">

    <h2 class="text-2xl font-semibold text-center mb-6">
        Add Booking Payment
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
                    <label class="text-sm font-semibold text-gray-700">Booking Name</label>
                    <select name="user_id" id="user_id" required
                        class="w-full border border-gray-300 px-5 py-3 rounded-xl focus:ring-2 focus:ring-yellow-400 outline-none">
                        <option value="">Loading...</option>
                    </select>
                </div>

                   <!-- Project  -->
                <div class="space-y-2">
                    <label class="text-sm font-semibold text-gray-700">Project Name</label>
                    <select name="project_id" id="project_name" required
                        class="w-full border border-gray-300 px-5 py-3 rounded-xl focus:ring-2 focus:ring-yellow-400 outline-none">
                        <option value="">Loading...</option>
                    </select>
                </div>

                <!-- Plot Number -->
                <div class="space-y-2">
                    <label class="text-sm font-semibold text-gray-700">Plot/Flat Number</label>
                    <select name="plot_id" id="plot_number" required
                        class="w-full border border-gray-300 px-5 py-3 rounded-xl focus:ring-2 focus:ring-yellow-400 outline-none">
                        <option value="">Loading...</option>
                    </select>
                </div>

                 <!-- AMOUNT -->
                <div class="space-y-2">
                    <label class="text-sm font-semibold text-gray-700">Total Amount</label>
                    <input type="number" name="total_amount" id="total_amount" required
                        class="w-full border border-gray-300 px-5 py-3 rounded-xl focus:ring-2 focus:ring-yellow-400 outline-none">
                </div>

                 <!-- AMOUNT -->
                <div class="space-y-2">
                    <label class="text-sm font-semibold text-gray-700">Paid Amount</label>
                    <input type="number" name="paid_amount" id="paid_amount" required
                        class="w-full border border-gray-300 px-5 py-3 rounded-xl focus:ring-2 focus:ring-yellow-400 outline-none">
                </div>

                 <!-- AMOUNT -->
                <div class="space-y-2">
                    <label class="text-sm font-semibold text-gray-700">Balanced Amount</label>
                    <input type="number" name="balanced_amount" id="balanced_amount" required
                        class="w-full border border-gray-300 px-5 py-3 rounded-xl focus:ring-2 focus:ring-yellow-400 outline-none">
                </div>



                <!-- AMOUNT -->
                <div class="space-y-2">
                    <label class="text-sm font-semibold text-gray-700">Payment Amount</label>
                    <input type="number" name="amount" id="amount" required
                        class="w-full border border-gray-300 px-5 py-3 rounded-xl focus:ring-2 focus:ring-yellow-400 outline-none">
                </div>

                <!-- PAYMENT TYPE -->
                <div class="space-y-2">
                    <label class="text-sm font-semibold text-gray-700">Payment Type</label>
                    <select name="payment_type" id="payment_type"
                        class="w-full border border-gray-300 px-5 py-3 rounded-xl focus:ring-2 focus:ring-yellow-400 outline-none">

                        <option>Select Payment Type</option>
                        <option value="full">Full</option>
                        <option value="advance">Advance</option>
                        <option value="installment">Installment</option>
                    </select>
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
const token = localStorage.getItem("auth_token");
let bookingsData = []; // store full data

/* ================= LOAD BOOKINGS ================= */
document.addEventListener("DOMContentLoaded", loadBookings);

async function loadBookings() {

    const dropdown = document.getElementById("user_id");

    try {
        const res = await fetch(url + "bookings", {
            headers: {
                "Authorization": "Bearer " + token
            }
        });

        const data = await res.json();

        bookingsData = data.data.data; // store full data

        dropdown.innerHTML = '<option value="">Select Booking</option>';

        bookingsData.forEach(b => {

            let site = b.location ? b.location.site_location : "N/A";

            dropdown.innerHTML += `
                <option value="${b.id}">
                    ${site} - ${b.user_code} - ${b.buyer_name}
                </option>
            `;
        });

    } catch (err) {
        console.error(err);
        dropdown.innerHTML = '<option>Error loading</option>';
    }
}


/* ================= ON BOOKING SELECT ================= */
document.getElementById("user_id").addEventListener("change", function () {

    const bookingId = this.value;

    if (!bookingId) return;

    const selected = bookingsData.find(b => b.id == bookingId);

    if (!selected) return;

    // 🔹 Project
    document.getElementById("project_name").innerHTML = `
        <option value="${selected.project_name}">
            ${selected.project_name}
        </option>
    `;

    // 🔹 Plot
    document.getElementById("plot_number").innerHTML = `
        <option value="${selected.plot_number}">
            ${selected.plot_number}
        </option>
    `;

    // 🔹 Amounts
    let total = parseFloat(selected.total_booking_amount) || 0;
    let paid = parseFloat(selected.advance_amount) || 0;
    let balance = total - paid;

    document.getElementById("total_amount").value = total;
    document.getElementById("paid_amount").value = paid;
    document.getElementById("balanced_amount").value = balance;
});


/* ================= SUBMIT PAYMENT ================= */
document.getElementById("paymentForm").addEventListener("submit", async function(e) {

    e.preventDefault();

    const bookingId = document.getElementById("user_id").value;

    const amount = parseFloat(document.getElementById("amount").value);
    const balance = parseFloat(document.getElementById("balanced_amount").value);

    // ✅ Validation
    if (amount > balance) {
        alert("Payment cannot exceed balance");
        return;
    }

    let formData = new FormData();
    formData.append("booking_id", bookingId);
    formData.append("amount", amount);
    formData.append("payment_type", document.getElementById("payment_type").value);
    formData.append("payment_mode", document.getElementById("payment_mode").value);
    formData.append("remark", document.getElementById("remark").value);

    try {
        const res = await fetch(url + "book-payments", {
            method: "POST",
            headers: {
                "Authorization": "Bearer " + token
            },
            body: formData
        });

        const result = await res.json();

        if (result.status) {
            alert("✅ Payment Recorded");

            // Update balance instantly
            let newBalance = balance - amount;
            let newPaid = parseFloat(document.getElementById("paid_amount").value) + amount;

            document.getElementById("paid_amount").value = newPaid;
            document.getElementById("balanced_amount").value = newBalance;

            // Reset only input fields
            document.getElementById("amount").value = "";
            document.getElementById("remark").value = "";

        } else {
            alert(result.message || "Payment failed");
        }

    } catch (err) {
        console.error(err);
        alert("Server error");
    }
});


/* ================= RESET FUNCTION ================= */
function confirmReset() {
    if (confirm("Are you sure to reset?")) {
        document.getElementById("paymentForm").reset();
    }
}
</script>