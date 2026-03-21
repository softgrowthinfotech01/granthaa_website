<?php include 'header.php'; ?>

<div class="max-w-7xl mx-auto bg-white p-6 rounded-2xl shadow-xl">

    <h2 class="text-3xl font-semibold text-center text-gray-800 mb-2">
        Customer Booking Form
    </h2>

    <form id="bookingForm" class="space-y-2">

        <!-- ================= CUSTOMER DETAILS ================= -->
        <div class="p-6">

            <h3 class="text-xl font-semibold text-gray-800 mb-3 border-b pb-2">
                Customer Details
            </h3>

            <div class="grid md:grid-cols-3 gap-2">

                <!-- Reference ID -->
                <div class="space-y-2">
                    <label class="text-sm font-semibold text-gray-700">Reference ID</label>
                    <input type="text" name="reference_id" id="reference_id" readonly
                        class="w-full border border-gray-300 px-5 py-3 rounded-xl bg-gray-100 outline-none">
                </div>

                <!-- Buyer -->
                <div class="space-y-2">
                    <label class="text-sm font-semibold text-gray-700">Buyer Name</label>
                    <input type="text" required name="buyer_name" id="buyer_name" readonly
                        class="w-full border border-gray-300 px-5 py-3 rounded-xl bg-gray-100 outline-none">
                </div>

                <!-- Mobile -->
                <div class="space-y-2">
                    <label class="text-sm font-semibold text-gray-700">Mobile Number</label>
                    <input type="text" required name="mobile" id="mobile" maxlength="10" pattern="[0-9]{10}" readonly
                        class="w-full border border-gray-300 px-5 py-3 rounded-xl focus:ring-2 focus:ring-yellow-400 outline-none">
                </div>

                <!-- DOB -->
                <div class="space-y-2">
                    <label class="text-sm font-semibold text-gray-700">Date of Birth</label>
                    <input type="date" name="dob" id="dob"
                        class="w-full border border-gray-300 px-5 py-3 rounded-xl focus:ring-2 focus:ring-yellow-400 outline-none">
                </div>

                <!-- Email -->
                <div class="space-y-2">
                    <label class="text-sm font-semibold text-gray-700">Email</label>
                    <input type="email" name="email" id="email" readonly
                        class="w-full border border-gray-300 px-5 py-3 rounded-xl bg-gray-100 outline-none">
                </div>

                <!-- PAN -->
                <div class="space-y-2">
                    <label class="text-sm font-semibold text-gray-700">PAN Number</label>
                    <input type="text"
                        name="pan_number"
                        id="pan_number"
                        maxlength="10"
                        pattern="[A-Za-z0-9]{10}"
                        title="PAN must be exactly 10 alphanumeric characters"
                        required
                        class="w-full border border-gray-300 px-5 py-3 rounded-xl uppercase focus:ring-2 focus:ring-yellow-400 outline-none">
                </div>

                <!-- Aadhar -->
                <div class="space-y-2">
                    <label class="text-sm font-semibold text-gray-700">Aadhar Number</label>
                    <input type="text" maxlength="12" required name="aadhar_number" id="aadhar_number"
                        class="w-full border border-gray-300 px-5 py-3 rounded-xl focus:ring-2 focus:ring-yellow-400 outline-none">
                </div>

                <!-- Address -->
                <div class="space-y-2 md:col-span-2">
                    <label class="text-sm font-semibold text-gray-700">Address</label>
                    <input type="text" required name="address" id="address"
                        class="w-full border border-gray-300 px-5 py-3 rounded-xl focus:ring-2 focus:ring-yellow-400 outline-none">
                </div>

                <!-- City -->
                <div class="space-y-2">
                    <label class="text-sm font-semibold text-gray-700">City</label>
                    <input type="text" name="city" id="city"
                        class="w-full border border-gray-300 px-5 py-3 rounded-xl focus:ring-2 focus:ring-yellow-400 outline-none">
                </div>

                <!-- State -->
                <div class="space-y-2">
                    <label class="text-sm font-semibold text-gray-700">State</label>
                    <input type="text" name="state" id="state"
                        class="w-full border border-gray-300 px-5 py-3 rounded-xl focus:ring-2 focus:ring-yellow-400 outline-none">
                </div>

                <!-- Pincode -->
                <div class="space-y-2">
                    <label class="text-sm font-semibold text-gray-700">Pincode</label>
                    <input type="text" name="pincode" id="pincode"
                        maxlength="6"
                        pattern="[0-9]{6}"
                        title="Pincode must be exactly 6 numbers"
                        required
                        class="w-full border border-gray-300 px-5 py-3 rounded-xl focus:ring-2 focus:ring-yellow-400 outline-none">
                </div>

                <!-- Advance -->
                <div class="space-y-2">
                    <label class="text-sm font-semibold text-gray-700">Advance Booking Amount</label>
                    <input type="number" name="advance_amount" id="advance_amount"
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
                    <label class="text-sm font-semibold text-gray-700">Site Location</label>
                    <select name="site_location" id="site_location"
                        class="w-full border border-gray-300 px-5 py-3 rounded-xl focus:ring-2 focus:ring-yellow-400 outline-none">
                        <option>Loading....</option>
                    </select>
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-semibold text-gray-700">Commission Type</label>
                    <input name="commission_type" id="commission_type" type="text" placeholder="commission type" readonly
                        class="w-full border border-gray-300 px-5 py-3 rounded-xl bg-gray-100 outline-none">
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-semibold text-gray-700">Commission Value</label>
                    <input name="commission_value" id="commission_value" type="text" placeholder="commission value" readonly
                        class="w-full border border-gray-300 px-5 py-3 rounded-xl bg-gray-100 outline-none">
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-semibold text-gray-700">Project Name</label>
                    <input name="project_name" id="project_name" type="text"
                        class="w-full border border-gray-300 px-5 py-3 rounded-xl focus:ring-2 focus:ring-yellow-400 outline-none">
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-semibold text-gray-700">Plot / Flat Number</label>
                    <input name="plot_number" id="plot_number" type="text" required
                        class="w-full border border-gray-300 px-5 py-3 rounded-xl focus:ring-2 focus:ring-yellow-400 outline-none">
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-semibold text-gray-700">Khasara Number</label>
                    <input name="khasara_number" id="khasara_number" type="text"
                        class="w-full border border-gray-300 px-5 py-3 rounded-xl focus:ring-2 focus:ring-yellow-400 outline-none">
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-semibold text-gray-700">P.H. Number</label>
                    <input name="ph_number" id="ph_number" type="text"
                        class="w-full border border-gray-300 px-5 py-3 rounded-xl focus:ring-2 focus:ring-yellow-400 outline-none">
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-semibold text-gray-700">Mouza</label>
                    <input name="mouza" id="mouza" type="text"
                        class="w-full border border-gray-300 px-5 py-3 rounded-xl focus:ring-2 focus:ring-yellow-400 outline-none">
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-semibold text-gray-700">Tahsil</label>
                    <input name="tahsil" id="tahsil" type="text"
                        class="w-full border border-gray-300 px-5 py-3 rounded-xl focus:ring-2 focus:ring-yellow-400 outline-none">
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-semibold text-gray-700">District</label>
                    <input name="district" id="district" type="text"
                        class="w-full border border-gray-300 px-5 py-3 rounded-xl focus:ring-2 focus:ring-yellow-400 outline-none">
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-semibold text-gray-700">Square Feet</label>
                    <input name="square_feet" id="square_feet" type="number"
                        class="w-full border border-gray-300 px-5 py-3 rounded-xl focus:ring-2 focus:ring-yellow-400 outline-none">
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-semibold text-gray-700">Square Meter</label>
                    <input name="square_meter" id="square_meter" type="number"
                        class="w-full border border-gray-300 px-5 py-3 rounded-xl focus:ring-2 focus:ring-yellow-400 outline-none">
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-semibold text-gray-700">Total Booking Amount</label>
                    <input name="total_booking_amount" id="total_booking_amount" type="number"
                        class="w-full border border-gray-300 px-5 py-3 rounded-xl focus:ring-2 focus:ring-yellow-400 outline-none">
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-semibold text-gray-700">Payment Mode</label>
                    <select name="payment_mode" id="payment_mode"
                        class="w-full border border-gray-300 px-5 py-3 rounded-xl focus:ring-2 focus:ring-yellow-400 outline-none">
                        <option value="">Select Payment Mode</option>
                        <option value="cash">Cash</option>
                        <option value="cheque">Cheque</option>
                        <option value="online_transfer">Online Transfer</option>
                        <option value="upi">UPI</option>
                    </select>
                </div>

                <div class="space-y-2 md:col-span-2">
                    <label class="text-sm font-semibold text-gray-700">Remark</label>
                    <textarea name="remark" id="remark" rows="2"
                        class="w-full border border-gray-300 px-5 py-3 rounded-xl focus:ring-2 focus:ring-yellow-400 outline-none"></textarea>
                </div>

            </div>
        </div>

        <!-- BUTTON -->
        <div class="flex justify-center mt-2 gap-2">
            <button type="submit"
                class="bg-yellow-500 hover:bg-yellow-600 px-4 py-4 rounded-xl text-black font-semibold text-lg shadow-md hover:shadow-xl transition transform hover:scale-[1.02]">
                Save Booking
            </button>

            <button type="button" onclick="confirmReset()"
                class="bg-red-500 hover:bg-red-600 px-4 py-4 rounded-xl text-black font-semibold text-lg shadow-md hover:shadow-xl transition transform hover:scale-[1.02]">
                Reset
            </button>
        </div>

    </form>

</div>

<script src="../url.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {

        const token = localStorage.getItem("auth_token");
        const user = JSON.parse(localStorage.getItem("auth_user"));

        if (!token || !user) {
            alert("Please login first");
            window.location.href = "../login";
            return;
        }

        const params = new URLSearchParams(window.location.search);
        const referenceId = params.get("reference_id") || "";
        document.getElementById("reference_id").value = referenceId;

        // ================= FETCH REFERRAL DATA AND AUTOFILL =================
        async function loadReferralData() {
            if (!referenceId) return;

            try {
                const response = await fetch(url + "referrals", {
                    method: "GET",
                    headers: {
                        "Authorization": "Bearer " + token,
                        "Accept": "application/json"
                    }
                });

                const result = await response.json();
                console.log("REFERRALS API:", result);

                if (!response.ok) {
                    alert(result.message || "Unable to fetch referral data");
                    return;
                }

                const referrals = result.data?.data || result.data || [];
                const referral = referrals.find(item => String(item.id) === String(referenceId));

                if (!referral) {
                    alert("Referral record not found");
                    return;
                }

                document.getElementById("reference_id").value = referral.id || "";
                document.getElementById("buyer_name").value = referral.referred_name || "";
                document.getElementById("mobile").value = referral.referred_contact || "";
                document.getElementById("email").value = referral.referred_email || "";

            } catch (error) {
                console.error("Error fetching referral data:", error);
                alert("Failed to load referral details");
            }
        }

        loadReferralData();

        // ================= LOAD SITE LOCATIONS =================
        function loadSiteLocations() {
            fetch(url + "my-commissions", {
                    method: "GET",
                    headers: {
                        "Authorization": "Bearer " + token,
                        "Accept": "application/json"
                    }
                })
                .then(res => res.json())
                .then(response => {
                    console.log("MY COMMISSIONS:", response);

                    const commissions = response.data?.data ?? [];
                    const select = document.getElementById("site_location");

                    select.innerHTML = `<option value="">Select Site Location</option>`;

                    commissions.forEach(commission => {
                        if (commission.location) {
                            select.innerHTML += `
                            <option 
                                value="${commission.location.id}"
                                data-type="${commission.commission_type}"
                                data-value="${commission.commission_value}">
                                ${commission.location.site_location}
                            </option>
                        `;
                        }
                    });
                })
                .catch(error => {
                    console.error("Error loading site locations:", error);
                    alert("Failed to load site locations");
                });
        }

        loadSiteLocations();

        // ================= AUTO FETCH COMMISSION =================
        document.getElementById("site_location").addEventListener("change", function() {
            const selectedOption = this.options[this.selectedIndex];
            const type = selectedOption.getAttribute("data-type");
            const value = selectedOption.getAttribute("data-value");

            const typeInput = document.getElementById("commission_type");
            const valueInput = document.getElementById("commission_value");

            if (!type || !value) {
                typeInput.value = "";
                valueInput.value = "";
                return;
            }

            typeInput.value = type;
            valueInput.value = value;
        });

        // ================= PAN UPPERCASE =================
        document.getElementById("pan_number").addEventListener("input", function() {
            this.value = this.value.toUpperCase().replace(/[^A-Z0-9]/g, '');
        });

        // ================= FORM SUBMIT =================
        document.getElementById("bookingForm").addEventListener("submit", async function(e) {
            e.preventDefault();

            if (user.role !== "leader") {
                alert("You are not allowed to create Booking");
                return;
            }

            let form = document.getElementById("bookingForm");
            let formData = new FormData(form);

            // IMPORTANT: backend expects referral_id, not reference_id
            formData.set("referral_id", document.getElementById("reference_id").value);

            const pan = document.getElementById("pan_number").value.trim().toUpperCase();
            const panPattern = /^[A-Z]{5}[0-9]{4}[A-Z]{1}$/;

            if (!panPattern.test(pan)) {
                alert("Invalid PAN format. Example: ABCDE1234F");
                return;
            }

            const aadhar = document.getElementById("aadhar_number").value.trim();
            const aadharPattern = /^[0-9]{12}$/;

            if (!aadharPattern.test(aadhar)) {
                alert("Invalid Aadhar Number. Aadhar must be 12 digits");
                return;
            }

            const pin = document.getElementById("pincode").value.trim();
            const pinCode = /^[0-9]{6}$/;

            if (!pinCode.test(pin)) {
                alert("Invalid Pincode. Pincode must be only 6 digits");
                return;
            }

            const mobile = document.getElementById("mobile").value.trim();
            const mobilePattern = /^[0-9]{10}$/;

            if (!mobilePattern.test(mobile)) {
                alert("Invalid Mobile Number. Mobile must be 10 digits");
                return;
            }

            const dobValue = document.getElementById("dob").value;

            if (dobValue) {
                const selectedDate = new Date(dobValue);
                const today = new Date();
                today.setHours(0, 0, 0, 0);

                if (selectedDate >= today) {
                    alert("DOB cannot be today or future date");
                    return;
                }
            }

            formData.set("role", "customer");
            formData.set("password", "password");
            formData.set("created_by", user.id);

            console.log([...formData.entries()]);

            try {
                const response = await fetch(url + "bookings", {
                    method: "POST",
                    headers: {
                        "Authorization": "Bearer " + token,
                        "Accept": "application/json"
                    },
                    body: formData
                });

                const data = await response.json();
                console.log("Booking API response:", data);

                if (!response.ok) {
                    if (data.errors) {
                        let errorMessages = "";
                        for (let field in data.errors) {
                            errorMessages += data.errors[field][0] + "\n";
                        }
                        alert("Validation Errors:\n\n" + errorMessages);
                    } else {
                        alert(data.error || data.message || "Something went wrong");
                    }
                    return;
                }

                alert("✅ " + data.message);
                window.location.href = "list_reference.php";

            } catch (error) {
                console.error(error);
                alert("Server error occurred");
            }
        });
    });

    function confirmReset() {
        if (confirm("Are you sure you want to reset the form?")) {
            document.getElementById("bookingForm").reset();

            const params = new URLSearchParams(window.location.search);
            const referenceId = params.get("reference_id") || "";

            document.getElementById("reference_id").value = referenceId;

            location.reload();
        }
    }
</script>

<?php include 'footer.php'; ?>