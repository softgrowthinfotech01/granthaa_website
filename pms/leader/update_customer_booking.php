<?php include 'header.php'; ?>

<div class="max-w-7xl mx-auto bg-white p-6  rounded-2xl shadow-xl">

    <h2 class="text-3xl font-semibold text-center text-gray-800 mb-2">
        Update Customer Booking Details
    </h2>

    <form id="updateBookingForm" class="space-y-2">

        <!-- ================= CUSTOMER DETAILS ================= -->
        <div class="p-6">

            <h3 class="text-xl font-semibold text-gray-800 mb-3 border-b pb-2">
                Customer Details
            </h3>

            <div class="grid md:grid-cols-3 gap-2">

                <!-- Leader -->
                <div class="space-y-2">
                    <label class="text-sm font-semibold text-gray-700">Leader Name</label>
                    <input type="text" id="leader_name" readonly
                        class="w-full border border-gray-300 px-5 py-3 rounded-xl bg-gray-100 outline-none">
                </div>

                <!-- Buyer -->
                <div class="space-y-2">
                    <label class="text-sm font-semibold text-gray-700">Buyer Name</label>
                    <input type="text" required id="buyer_name" name="buyer_name"
                        class="w-full border border-gray-300 px-5 py-3 rounded-xl focus:ring-2 focus:ring-yellow-400 outline-none">
                </div>

                <!-- Mobile -->
                <div class="space-y-2">
                    <label class="text-sm font-semibold text-gray-700">Mobile Number</label>
                    <input type="number" required id="mobile" name="mobile"
                        class="w-full border border-gray-300 px-5 py-3 rounded-xl focus:ring-2 focus:ring-yellow-400 outline-none">
                </div>

                <!-- DOB -->
                <div class="space-y-2">
                    <label class="text-sm font-semibold text-gray-700">Date of Birth</label>
                    <input type="date" id="dob" name="dob"
                        class="w-full border border-gray-300 px-5 py-3 rounded-xl focus:ring-2 focus:ring-yellow-400 outline-none">
                </div>

                <!-- Email -->
                <div class="space-y-2">
                    <label class="text-sm font-semibold text-gray-700">Email</label>
                    <input type="email" id="email" name="email"
                        class="w-full border border-gray-300 px-5 py-3 rounded-xl focus:ring-2 focus:ring-yellow-400 outline-none">
                </div>

                <!-- PAN -->
                <div class="space-y-2">
                    <label class="text-sm font-semibold text-gray-700">PAN Number</label>
                    <input type="text" required id="pan_number" name="pan_number"
                        class="w-full border border-gray-300 px-5 py-3 rounded-xl uppercase focus:ring-2 focus:ring-yellow-400 outline-none">
                </div>

                <!-- Aadhar -->
                <div class="space-y-2">
                    <label class="text-sm font-semibold text-gray-700">Aadhar Number</label>
                    <input type="text" maxlength="12" required id="aadhar_number" name="aadhar_number"
                        class="w-full border border-gray-300 px-5 py-3 rounded-xl focus:ring-2 focus:ring-yellow-400 outline-none">
                </div>

                <!-- Address -->
                <div class="space-y-2 md:col-span-2">
                    <label class="text-sm font-semibold text-gray-700">Address</label>
                    <input type="text" required id="address" name="address"
                        class="w-full border border-gray-300 px-5 py-3 rounded-xl focus:ring-2 focus:ring-yellow-400 outline-none">
                </div>

                <!-- City -->
                <div class="space-y-2">
                    <label class="text-sm font-semibold text-gray-700">City</label>
                    <input type="text" id="city" name="city"
                        class="w-full border border-gray-300 px-5 py-3 rounded-xl focus:ring-2 focus:ring-yellow-400 outline-none">
                </div>

                <!-- State -->
                <div class="space-y-2">
                    <label class="text-sm font-semibold text-gray-700">State</label>
                    <input type="text" id="state" name="state"
                        class="w-full border border-gray-300 px-5 py-3 rounded-xl focus:ring-2 focus:ring-yellow-400 outline-none">
                </div>

                <!-- Pincode -->
                <div class="space-y-2">
                    <label class="text-sm font-semibold text-gray-700">Pincode</label>
                    <input type="number" id="pincode" name="pincode"
                        class="w-full border border-gray-300 px-5 py-3 rounded-xl focus:ring-2 focus:ring-yellow-400 outline-none">
                </div>

                <!-- Advance -->
                <div class="space-y-2">
                    <label class="text-sm font-semibold text-gray-700">Advance Booking Amount</label>
                    <input type="number" id="advance_amount" name="advance_amount"
                        class="w-full border border-gray-300 px-5 py-3 rounded-xl focus:ring-2 focus:ring-yellow-400 outline-none">
                </div>

            </div>
        </div>

        <!-- ================= PLOT DETAILS ================= -->
        <div class="p-6 mt-1">

            <h3 class="text-xl font-semibold text-gray-800 mb-4 border-b pb-2">
                Plot / Booking Details
            </h3>

            <div class="grid md:grid-cols-3 gap-2">

                <div class="space-y-2">
                    <label class="text-sm font-semibold text-gray-700">Site Location <span style="color:red">(readonly)</span></label>
                    <select id="site_location" name="site_location" disabled
                        class="w-full border border-gray-300 px-5 py-3 rounded-xl focus:ring-2 focus:ring-yellow-400 outline-none">
                        <option value="">Select Site</option>
                    </select>
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-semibold text-gray-700">Commission Type</label>
                    <input type="text" id="commission_type" name="commission_type" readonly
                        class="w-full border border-gray-300 px-5 py-3 rounded-xl bg-gray-100 outline-none">
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-semibold text-gray-700">Project Name</label>
                    <input type="text" id="project_name" name="project_name"
                        class="w-full border border-gray-300 px-5 py-3 rounded-xl focus:ring-2 focus:ring-yellow-400 outline-none">
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-semibold text-gray-700">Plot / Flat Number</label>
                    <input type="text" required id="plot_number" name="plot_number"
                        class="w-full border border-gray-300 px-5 py-3 rounded-xl focus:ring-2 focus:ring-yellow-400 outline-none">
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-semibold text-gray-700">Khasara Number</label>
                    <input type="text" id="khasara_number" name="khasara_number"
                        class="w-full border border-gray-300 px-5 py-3 rounded-xl focus:ring-2 focus:ring-yellow-400 outline-none">
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-semibold text-gray-700">P.H. Number</label>
                    <input type="text" id="ph_number" name="ph_number"
                        class="w-full border border-gray-300 px-5 py-3 rounded-xl focus:ring-2 focus:ring-yellow-400 outline-none">
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-semibold text-gray-700">Mouza</label>
                    <input type="text" id="mouza" name="mouza"
                        class="w-full border border-gray-300 px-5 py-3 rounded-xl focus:ring-2 focus:ring-yellow-400 outline-none">
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-semibold text-gray-700">Tahsil</label>
                    <input type="text" id="tahsil" name="tahsil"
                        class="w-full border border-gray-300 px-5 py-3 rounded-xl focus:ring-2 focus:ring-yellow-400 outline-none">
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-semibold text-gray-700">District</label>
                    <input type="text" id="district" name="district"
                        class="w-full border border-gray-300 px-5 py-3 rounded-xl focus:ring-2 focus:ring-yellow-400 outline-none">
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-semibold text-gray-700">Square Feet</label>
                    <input type="number" id="square_feet" name="square_feet"
                        class="w-full border border-gray-300 px-5 py-3 rounded-xl focus:ring-2 focus:ring-yellow-400 outline-none">
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-semibold text-gray-700">Square Meter</label>
                    <input type="number" id="square_meter" name="square_meter"
                        class="w-full border border-gray-300 px-5 py-3 rounded-xl focus:ring-2 focus:ring-yellow-400 outline-none">
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-semibold text-gray-700">Total Booking Amount</label>
                    <input type="number" id="total_booking_amount" name="total_booking_amount"
                        class="w-full border border-gray-300 px-5 py-3 rounded-xl focus:ring-2 focus:ring-yellow-400 outline-none">
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-semibold text-gray-700">Payment Mode</label>
                    <select id="payment_mode" name="payment_mode"
                        class="w-full border border-gray-300 px-5 py-3 rounded-xl focus:ring-2 focus:ring-yellow-400 outline-none">
                        <option value="">Select Payment</option>
                        <option value="cash">Cash</option>
                        <option value="cheque">Cheque</option>
                        <option value="online_transfer">Online Transfer</option>
                        <option value="upi">UPI</option>
                    </select>
                </div>

                <div class="space-y-2 md:col-span-2">
                    <label class="text-sm font-semibold text-gray-700">Remark</label>
                    <textarea rows="2" id="remark" name="remark"
                        class="w-full border border-gray-300 px-5 py-3 rounded-xl focus:ring-2 focus:ring-yellow-400 outline-none"></textarea>
                </div>

            </div>
        </div>

        <div class="flex justify-between mt-6">
            <a href="list_customer_booking.php"
                class="px-5 py-2 rounded-lg border border-gray-300 hover:bg-gray-100 transition">
                Back
            </a>

            <button type="submit"
                class="bg-yellow-500 hover:bg-yellow-600 text-black px-6 py-2 rounded-lg font-semibold transition">
                Update Customer Booking
            </button>
        </div>

    </form>

</div>

<script src="../url.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {

        const token = localStorage.getItem("auth_token");
        const id = new URLSearchParams(window.location.search).get("id");

        function loadSiteLocations(selectedId = null) {

            fetch(url + "my-commissions", {
                    method: "GET",
                    headers: {
                        "Authorization": "Bearer " + token,
                        "Accept": "application/json"
                    }
                })
                .then(res => res.json())
                .then(response => {

                    const commissions = response.data?.data ?? [];
                    const select = document.getElementById("site_location");

                    select.innerHTML = `<option value="">Select Site Location</option>`;

                    commissions.forEach(commission => {

                        if (commission.location) {

                            const isSelected =
                                selectedId == commission.location.id ?
                                "selected" :
                                "";

                            select.innerHTML += `
                    <option 
                        value="${commission.location.id}"
                        data-type="${commission.commission_type}"
                        data-value="${commission.commission_value}"
                        ${isSelected}
                    >
                        ${commission.location.site_location}
                    </option>
                `;
                        }
                    });

                });
        }

        if (!token) {
            alert("Please login first");
            window.location.href = "../login";
            return;
        }

        // ================= FETCH BOOKING =================
        fetch(url + "bookings/" + id, {
                method: "GET",
                headers: {
                    "Authorization": "Bearer " + token,
                    "Accept": "application/json"
                }
            })

            .then(res => res.json())
            .then(response => {
                let booking = response;

                document.getElementById("buyer_name").value = booking.buyer_name;
                document.getElementById("mobile").value = booking.mobile;
                document.getElementById("dob").value = booking.dob;
                document.getElementById("email").value = booking.email;
                document.getElementById("pan_number").value = booking.pan_number;
                document.getElementById("aadhar_number").value = booking.aadhar_number;
                document.getElementById("address").value = booking.address;
                document.getElementById("city").value = booking.city;
                document.getElementById("state").value = booking.state;
                document.getElementById("pincode").value = booking.pincode;
                document.getElementById("advance_amount").value = booking.advance_amount;

                document.getElementById("project_name").value = booking.project_name;
                document.getElementById("plot_number").value = booking.plot_number;
                document.getElementById("khasara_number").value = booking.khasara_number;
                document.getElementById("ph_number").value = booking.ph_number;
                document.getElementById("mouza").value = booking.mouza;
                document.getElementById("tahsil").value = booking.tahsil;
                document.getElementById("district").value = booking.district;
                document.getElementById("square_feet").value = booking.square_feet;
                document.getElementById("square_meter").value = booking.square_meter;
                document.getElementById("total_booking_amount").value = booking.total_booking_amount;
                document.getElementById("payment_mode").value = booking.payment_mode;
                document.getElementById("remark").value = booking.remark;

                loadSiteLocations(booking.site_location);
            });

        // ================= UPDATE =================
        document.getElementById("updateBookingForm")
            .addEventListener("submit", async function(e) {

                e.preventDefault();

                let formData = new FormData(this);

                formData.append("_method", "PATCH"); // Laravel fix

                const response = await fetch(url + "bookings/" + id, {
                    method: "POST",
                    headers: {
                        "Authorization": "Bearer " + token,
                        "Accept": "application/json"
                    },
                    body: formData
                });

                const data = await response.json();

                if (!response.ok) {
                    alert(data.message || "Update failed");
                    return;
                }

                alert(data.message);
                window.location.replace("list_customer_booking.php");
            });

    });
</script>

<?php include 'footer.php'; ?>