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
                        class="w-full border border-gray-300 px-5 py-3 rounded-xl focus:ring-2 focus:ring-green-400 outline-none">
                        <option value="">Loading...</option>
                    </select>
                </div>

                <!-- Project  -->
                <div class="space-y-2">
                    <label class="text-sm font-semibold text-gray-700">Project Name</label>
                    <select name="project_id" id="project_name" required disabled
                        class="w-full border border-gray-300 px-5 py-3 rounded-xl bg-gray-100 outline-none cursor-not-allowed">
                        <option value="">Loading...</option>
                    </select>
                </div>

                <!-- Plot Number -->
                <div class="space-y-2">
                    <label class="text-sm font-semibold text-gray-700">Plot/Flat Number</label>
                    <select name="plot_id" id="plot_number" required disabled
                        class="w-full border border-gray-300 px-5 py-3 rounded-xl bg-gray-100 outline-none cursor-not-allowed">
                        <option value="">Loading...</option>
                    </select>
                </div>

                <!-- AMOUNT -->
                <div class="space-y-2">
                    <label class="text-sm font-semibold text-gray-700">Total Amount</label>
                    <input readonly type="number" name="total_amount" id="total_amount" readonly
                        class="w-full border border-gray-300 px-5 py-3 rounded-xl bg-gray-100 outline-none">
                </div>

                <!-- AMOUNT -->
                <div class="space-y-2">
                    <label class="text-sm font-semibold text-gray-700">Paid Amount</label>
                    <input readonly type="number" name="paid_amount" id="paid_amount" readonly
                        class="w-full border border-gray-300 px-5 py-3 rounded-xl bg-gray-100 outline-none">
                </div>

                <!-- AMOUNT -->
                <div class="space-y-2">
                    <label class="text-sm font-semibold text-gray-700">Balanced Amount</label>
                    <input readonly type="number" name="balanced_amount" id="balanced_amount" readonly
                        class="w-full border border-gray-300 px-5 py-3 rounded-xl bg-gray-100 outline-none">
                </div>



                <!-- AMOUNT -->
                <div class="space-y-2">
                    <label class="text-sm font-semibold text-gray-700">Payment Amount</label>
                    <input type="number" name="amount" id="amount" required
                        class="w-full border border-gray-300 px-5 py-3 rounded-xl focus:ring-2 focus:ring-green-400 outline-none">
                </div>

                <!-- PAYMENT TYPE -->
                <div class="space-y-2">
                    <label class="text-sm font-semibold text-gray-700">Payment Type</label>
                    <select name="payment_type" id="payment_type"
                        class="w-full border border-gray-300 px-5 py-3 rounded-xl focus:ring-2 focus:ring-green-400 outline-none">

                        <option value="">Select Payment Type</option>
                        <option value="full">Full</option>
                        <option value="advance">Advance</option>
                        <option value="installment">Installment</option>
                    </select>
                </div>

                <!-- PAYMENT MODE -->
                <div class="space-y-2">
                    <label class="text-sm font-semibold text-gray-700">Payment Mode</label>
                    <select name="payment_mode" id="payment_mode"
                        class="w-full border border-gray-300 px-5 py-3 rounded-xl focus:ring-2 focus:ring-green-400 outline-none">

                        <option value="" hidden disabled>Select Payment Mode</option>
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
                        class="w-full border border-gray-300 px-5 py-3 rounded-xl focus:ring-2 focus:ring-green-400 outline-none"></textarea>
                </div>

            </div>
        </div>

        <!-- BUTTON -->
        <div class="flex justify-center gap-2 mt-2">
<button type="submit"
    class="bg-green-500 hover:bg-green-600 px-4 py-4 rounded-xl
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

<script>
    const userSelect = document.getElementById("user_id");
    const projectSelect = document.getElementById("project_name");
    const plotSelect = document.getElementById("plot_number");

    function disableSelect(selectElement) {
        selectElement.disabled = true;
        selectElement.classList.add("bg-gray-100", "cursor-not-allowed");
        selectElement.classList.remove("focus:ring-2", "focus:ring-green-400");
        selectElement.value = "";
    }

    function enableSelect(selectElement) {
        selectElement.disabled = false;
        selectElement.classList.remove("bg-gray-100", "cursor-not-allowed");
        selectElement.classList.add("focus:ring-2", "focus:ring-green-400");
    }

    // Initial state
    disableSelect(projectSelect);
    disableSelect(plotSelect);

    // When Booking Name is selected
    userSelect.addEventListener("change", function() {
        if (this.value) {
            enableSelect(projectSelect);
        } else {
            disableSelect(projectSelect);
            disableSelect(plotSelect);
        }
    });

    // When Project Name is selected
    projectSelect.addEventListener("change", function() {
        if (this.value) {
            enableSelect(plotSelect);
        } else {
            disableSelect(plotSelect);
        }
    });

    const token = localStorage.getItem("auth_token");

    /* ================= LOAD CUSTOMERS ================= */
    document.addEventListener("DOMContentLoaded", () => {
        loadCustomers();

        // disable dependent dropdowns initially
        document.getElementById("project_name").disabled = true;
        document.getElementById("plot_number").disabled = true;
    });

    async function loadCustomers() {

        const dropdown = document.getElementById("user_id");

        try {
            const res = await fetch(url + "customers", {
                headers: {
                    Authorization: "Bearer " + token
                }
            });

            const data = await res.json();

            dropdown.innerHTML = '<option value="">Select Customer</option>';

            data.data.forEach(c => {
                dropdown.innerHTML += `
                <option value="${c.user_id}">
                    ${c.user_code} - ${c.buyer_name}
                </option>
            `;
            });

        } catch (err) {
            console.error(err);
            dropdown.innerHTML = '<option>Error loading customers</option>';
        }
    }


    /* ================= CUSTOMER CHANGE ================= */
    document.getElementById("user_id").addEventListener("change", async function() {

        let userId = this.value;

        // 🔄 Reset everything
        document.getElementById("project_name").innerHTML = '<option>Loading...</option>';
        document.getElementById("plot_number").innerHTML = '<option>Select Plot</option>';

        document.getElementById("project_name").disabled = true;
        document.getElementById("plot_number").disabled = true;

        clearAmounts();

        if (!userId) return;

        try {
            const res = await fetch(url + "projects/" + userId, {
                headers: {
                    Authorization: "Bearer " + token
                }
            });

            const data = await res.json();

            let projectDropdown = document.getElementById("project_name");
            projectDropdown.innerHTML = '<option value="">Select Project</option>';

            data.data.forEach(p => {
                projectDropdown.innerHTML += `
                <option value="${p.project_name}">
                    ${p.project_name}
                </option>
            `;
            });

            projectDropdown.disabled = false;

        } catch (err) {
            console.error(err);
            alert("Failed to load projects");
        }
    });


    /* ================= PROJECT CHANGE ================= */
    document.getElementById("project_name").addEventListener("change", async function() {

        let userId = document.getElementById("user_id").value;
        let project = this.value;

        // 🔄 Reset plot + amounts
        document.getElementById("plot_number").innerHTML = '<option>Loading...</option>';
        document.getElementById("plot_number").disabled = true;

        clearAmounts();

        if (!project) return;

        try {
            const res = await fetch(url + `plots/${userId}/${project}`, {
                headers: {
                    Authorization: "Bearer " + token
                }
            });

            const data = await res.json();

            let plotDropdown = document.getElementById("plot_number");
            plotDropdown.innerHTML = '<option value="">Select Plot</option>';

            data.data.forEach(b => {
                plotDropdown.innerHTML += `
                <option value="${b.id}">
                    ${b.plot_number}
                </option>
            `;
            });

            plotDropdown.disabled = false;

        } catch (err) {
            console.error(err);
            alert("Failed to load plots");
        }
    });


    /* ================= PLOT CHANGE ================= */
    document.getElementById("plot_number").addEventListener("change", async function() {

        let bookingId = this.value;

        clearAmounts();

        if (!bookingId) return;

        try {
            const res = await fetch(url + "booking-summary/" + bookingId, {
                headers: {
                    Authorization: "Bearer " + token,
                    Accept: "application/json"
                }
            });

            const data = await res.json();

            /* ================= ADVANCE OPTION CONTROL ================= */
            let paid = parseFloat(data.paid_amount) || 0;

            let paymentType = document.getElementById("payment_type");
            let advanceOption = paymentType.querySelector('option[value="advance"]');

            // If already paid → disable advance
            if (paid > 0) {
                advanceOption.disabled = true;

                if (paymentType.value === "advance") {
                    paymentType.value = "";
                }
            } else {
                advanceOption.disabled = false;
            }

            document.getElementById("total_amount").value = data.total_amount ?? 0;
            document.getElementById("paid_amount").value = data.paid_amount ?? 0;
            document.getElementById("balanced_amount").value = data.balance ?? 0;

        } catch (err) {
            console.error(err);
            alert("Failed to fetch booking summary");
        }
    });


    /* ================= CLEAR AMOUNTS ================= */
    function clearAmounts() {
        document.getElementById("total_amount").value = "";
        document.getElementById("paid_amount").value = "";
        document.getElementById("balanced_amount").value = "";
    }



    /* ================= PAYMENT TYPE CONTROL ================= */
    document.getElementById("amount").addEventListener("input", function() {

        let amount = parseFloat(this.value) || 0;
        let paid = parseFloat(document.getElementById("paid_amount").value) || 0;
        let total = parseFloat(document.getElementById("total_amount").value) || 0;

        let newBalance = total - (paid + amount);

        let paymentType = document.getElementById("payment_type");
        let fullOption = paymentType.querySelector('option[value="full"]');

       if (Math.abs(newBalance) > 0.01) {
    fullOption.disabled = true;

    if (paymentType.value === "full") {
        paymentType.value = "";
    }
} else {
    fullOption.disabled = false;

    // 🔥 auto select full
    paymentType.value = "full";
}
    });


    /* ================= FORM SUBMIT ================= */
    let isSubmitting = false;

document.getElementById("paymentForm").addEventListener("submit", async function(e) {

    e.preventDefault();

    // 🚫 prevent double click
    if (isSubmitting) return;
    isSubmitting = true;

    let submitBtn = document.querySelector("#paymentForm button[type='submit']");
    submitBtn.disabled = true;
    submitBtn.innerText = "Processing...";

    const bookingId = document.getElementById("plot_number").value;
    const amount = parseFloat(document.getElementById("amount").value);
    const balance = parseFloat(document.getElementById("balanced_amount").value);

    if (!bookingId) {
        alert("Select plot first");
        resetBtn();
        return;
    }

    if (amount <= 0) {
        alert("Enter valid amount");
        resetBtn();
        return;
    }

    if (amount > balance) {
        alert("Payment exceeds balance");
        resetBtn();
        return;
    }

    const paymentType = document.getElementById("payment_type").value;

    if (paymentType === "full" && Math.abs(balance - amount) > 1) {
        alert("Full payment must match balance");
        resetBtn();
        return;
    }

    let formData = new FormData();
    formData.append("booking_id", bookingId);
    formData.append("amount", amount);
    formData.append("payment_type", paymentType);
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

       if (result.status === true || result.success === true) {

    alert("✅ Payment Recorded Successfully");

    submitBtn.innerText = "Saved ✔";

    document.getElementById("plot_number").dispatchEvent(new Event("change"));

    document.getElementById("amount").value = "";
    document.getElementById("remark").value = "";

    setTimeout(() => {
        resetBtn();
    }, 1500);

} else {
    alert(result.message || "Payment failed");
    resetBtn();
}

    } catch (err) {
        console.error(err);
        alert("Server error");
        resetBtn();
    }

    function resetBtn() {
        isSubmitting = false;
        submitBtn.disabled = false;
        submitBtn.innerText = "Record Payment";
    }

});
    /* ================= RESET ================= */
    function confirmReset() {
        if (confirm("Are you sure to reset?")) {
            document.getElementById("paymentForm").reset();
            clearAmounts();

            document.getElementById("project_name").disabled = true;
            document.getElementById("plot_number").disabled = true;
        }
    }
</script>