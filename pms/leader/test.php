<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<form id="paymentForm">

    <!-- Booking Dropdown -->
    <select id="booking_id" required>
        <option value="">Select Booking</option>
    </select>

    <!-- Auto Filled Details -->
    <input type="text" id="total_amount" placeholder="Total Amount" readonly>
    <input type="text" id="paid_amount" placeholder="Paid Amount" readonly>
    <input type="text" id="balance_amount" placeholder="Balance Amount" readonly>

    <!-- Payment Input -->
    <input type="number" id="amount" placeholder="Enter Payment Amount" required>

    <select id="payment_mode">
        <option value="cash">Cash</option>
        <option value="online">Online</option>
        <option value="cheque">Cheque</option>
    </select>

    <input type="text" id="remark" placeholder="Remark">

    <button type="submit">Submit Payment</button>
</form>

<script src="../url.js"></script>
<script>
const token = localStorage.getItem("auth_token");

// Load bookings
async function loadBookings() {
    const res = await fetch(url + "bookings", {
        headers: {
            "Authorization": "Bearer " + token
        }
    });
    console.log(token);

    const data = await res.json();

    const dropdown = document.getElementById("booking_id");

    data.data.data.forEach(booking => {
        let option = document.createElement("option");
        option.value = booking.id;
        option.text = booking.buyer_name + " (Plot: " + booking.plot_number + ")";
        dropdown.appendChild(option);
    });
}

loadBookings();
</script>

<script>
document.getElementById("booking_id").addEventListener("change", async function () {

    const bookingId = this.value;

    if (!bookingId) return;

    const res = await fetch(`${url}booking-summary/${bookingId}`, {
        headers: {
            "Authorization": "Bearer " + token
        }
    });

    const data = await res.json();

    document.getElementById("total_amount").value = data.total_amount;
    document.getElementById("paid_amount").value = data.paid_amount;
    document.getElementById("balance_amount").value = data.balance;
});
</script>

<script>
document.getElementById("paymentForm").addEventListener("submit", async function(e) {
    e.preventDefault();

    const bookingId = document.getElementById("booking_id").value;
    const amount = parseFloat(document.getElementById("amount").value);
    const balance = parseFloat(document.getElementById("balance_amount").value);

    // ✅ Validation
    if (amount > balance) {
        alert("❌ Payment cannot exceed balance");
        return;
    }

    const data = {
        booking_id: bookingId,
        amount: amount,
        payment_type: "remaining",
        payment_mode: document.getElementById("payment_mode").value,
        remark: document.getElementById("remark").value
    };

    try {
        const res = await fetch(url + "book-payments", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "Authorization": "Bearer " + token
            },
            body: JSON.stringify(data)
        });

        const result = await res.json();

        if (result.status) {
            alert("✅ Payment Success");

            // 🔁 reload summary (keep booking selected)
            document.getElementById("booking_id").dispatchEvent(new Event('change'));

            // ✅ only reset amount + remark (NOT booking_id)
            document.getElementById("amount").value = "";
            document.getElementById("remark").value = "";

        } else {
            alert("❌ " + (result.message || "Error"));
        }

    } catch (error) {
        console.error(error);
        alert("❌ Something went wrong");
    }
});
</script>
</body>
</html>