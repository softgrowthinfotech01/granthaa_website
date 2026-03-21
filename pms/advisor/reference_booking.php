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
                    <input type="text" name="buyer_name" id="buyer_name" required readonly
                        class="w-full border border-gray-300 px-5 py-3 rounded-xl bg-gray-100 outline-none">
                </div>

                <!-- Mobile -->
                <div class="space-y-2">
                    <label class="text-sm font-semibold text-gray-700">Mobile Number</label>
                    <input type="text" name="mobile" id="mobile" maxlength="10" readonly
                        class="w-full border border-gray-300 px-5 py-3 rounded-xl bg-gray-100 outline-none">
                </div>

                <!-- DOB -->
                <div class="space-y-2">
                    <label class="text-sm font-semibold text-gray-700">Date of Birth</label>
                    <input type="date" name="dob" id="dob"
                        class="w-full border border-gray-300 px-5 py-3 rounded-xl focus:ring-2 focus:ring-green-400 outline-none">
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
                    <input type="text" required name="pan_number" id="pan_number" maxlength="10"
                        class="w-full border border-gray-300 px-5 py-3 rounded-xl uppercase focus:ring-2 focus:ring-green-400 outline-none">
                </div>

                <!-- Aadhar -->
                <div class="space-y-2">
                    <label class="text-sm font-semibold text-gray-700">Aadhar Number</label>
                    <input type="text" maxlength="12" required name="aadhar_number" id="aadhar_number"
                        class="w-full border border-gray-300 px-5 py-3 rounded-xl focus:ring-2 focus:ring-green-400 outline-none">
                </div>

                <!-- Address -->
                <div class="space-y-2 md:col-span-2">
                    <label class="text-sm font-semibold text-gray-700">Address</label>
                    <input type="text" required name="address" id="address"
                        class="w-full border border-gray-300 px-5 py-3 rounded-xl focus:ring-2 focus:ring-green-400 outline-none">
                </div>

                <!-- City -->
                <div class="space-y-2">
                    <label class="text-sm font-semibold text-gray-700">City</label>
                    <input type="text" name="city" id="city"
                        class="w-full border border-gray-300 px-5 py-3 rounded-xl focus:ring-2 focus:ring-green-400 outline-none">
                </div>

                <!-- State -->
                <div class="space-y-2">
                    <label class="text-sm font-semibold text-gray-700">State</label>
                    <input type="text" name="state" id="state"
                        class="w-full border border-gray-300 px-5 py-3 rounded-xl focus:ring-2 focus:ring-green-400 outline-none">
                </div>

                <!-- Pincode -->
                <div class="space-y-2">
                    <label class="text-sm font-semibold text-gray-700">Pincode</label>
                    <input type="text" name="pincode" id="pincode" maxlength="6"
                        class="w-full border border-gray-300 px-5 py-3 rounded-xl focus:ring-2 focus:ring-green-400 outline-none">
                </div>

                <!-- Advance -->
                <div class="space-y-2">
                    <label class="text-sm font-semibold text-gray-700">Advance Booking Amount</label>
                    <input type="number" name="advance_amount" id="advance_amount"
                        class="w-full border border-gray-300 px-5 py-3 rounded-xl focus:ring-2 focus:ring-green-400 outline-none">
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
                        class="w-full border border-gray-300 px-5 py-3 rounded-xl focus:ring-2 focus:ring-green-400 outline-none">
                        <option value="">Loading....</option>
                    </select>
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-semibold text-gray-700">Commission Type</label>
                    <input id="commission_type" name="commission_type" type="text" placeholder="commission type..." readonly
                        class="w-full border border-gray-300 px-5 py-3 rounded-xl bg-gray-100 outline-none">
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-semibold text-gray-700">Commission Value</label>
                    <input id="commission_value" name="commission_value" type="text" placeholder="commission value..." readonly
                        class="w-full border border-gray-300 px-5 py-3 rounded-xl bg-gray-100 outline-none">
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-semibold text-gray-700">Project Name</label>
                    <input type="text" name="project_name" id="project_name"
                        class="w-full border border-gray-300 px-5 py-3 rounded-xl focus:ring-2 focus:ring-green-400 outline-none">
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-semibold text-gray-700">Plot / Flat Number</label>
                    <input name="plot_number" id="plot_number" type="text" required
                        class="w-full border border-gray-300 px-5 py-3 rounded-xl focus:ring-2 focus:ring-green-400 outline-none">
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-semibold text-gray-700">Khasara Number</label>
                    <input name="khasara_number" id="khasara_number" type="text"
                        class="w-full border border-gray-300 px-5 py-3 rounded-xl focus:ring-2 focus:ring-green-400 outline-none">
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-semibold text-gray-700">P.H. Number</label>
                    <input name="ph_number" id="ph_number" type="text"
                        class="w-full border border-gray-300 px-5 py-3 rounded-xl focus:ring-2 focus:ring-green-400 outline-none">
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-semibold text-gray-700">Mouza</label>
                    <input name="mouza" id="mouza" type="text"
                        class="w-full border border-gray-300 px-5 py-3 rounded-xl focus:ring-2 focus:ring-green-400 outline-none">
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-semibold text-gray-700">Tahsil</label>
                    <input name="tahsil" id="tahsil" type="text"
                        class="w-full border border-gray-300 px-5 py-3 rounded-xl focus:ring-2 focus:ring-green-400 outline-none">
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-semibold text-gray-700">District</label>
                    <input name="district" id="district" type="text"
                        class="w-full border border-gray-300 px-5 py-3 rounded-xl focus:ring-2 focus:ring-green-400 outline-none">
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-semibold text-gray-700">Square Feet</label>
                    <input type="number" name="square_feet" id="square_feet"
                        class="w-full border border-gray-300 px-5 py-3 rounded-xl focus:ring-2 focus:ring-green-400 outline-none">
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-semibold text-gray-700">Square Meter</label>
                    <input type="number" name="square_meter" id="square_meter"
                        class="w-full border border-gray-300 px-5 py-3 rounded-xl focus:ring-2 focus:ring-green-400 outline-none">
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-semibold text-gray-700">Total Booking Amount</label>
                    <input name="total_booking_amount" id="total_booking_amount" type="number"
                        class="w-full border border-gray-300 px-5 py-3 rounded-xl focus:ring-2 focus:ring-green-400 outline-none">
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-semibold text-gray-700">Payment Mode</label>
                    <select name="payment_mode" id="payment_mode"
                        class="w-full border border-gray-300 px-5 py-3 rounded-xl focus:ring-2 focus:ring-green-400 outline-none">
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
                        class="w-full border border-gray-300 px-5 py-3 rounded-xl focus:ring-2 focus:ring-green-400 outline-none"></textarea>
                </div>

            </div>
        </div>

        <!-- BUTTON -->
        <div class="flex justify-center gap-2 mt-2">
            <button type="submit"
                class="bg-green-500 hover:bg-green-600 px-4 py-4 rounded-xl text-black font-semibold text-lg shadow-md hover:shadow-xl transition transform hover:scale-[1.02]">
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
document.addEventListener("DOMContentLoaded", function () {

    const token = localStorage.getItem("auth_token");
    const authUser = JSON.parse(localStorage.getItem("auth_user"));
    const user = authUser?.user ?? authUser?.data ?? authUser;

    if (!token || !user) {
        alert("Login required");
        window.location.href = "../login";
        return;
    }

    const params = new URLSearchParams(window.location.search);
    const referenceId = params.get("reference_id") || "";
    document.getElementById("reference_id").value = referenceId;

    // ================= FETCH REFERRAL DATA =================
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
    function loadAdvisorLocations() {
        fetch(url + "my-commissions", {
            method: "GET",
            headers: {
                Authorization: "Bearer " + token,
                Accept: "application/json"
            }
        })
        .then(res => res.json())
        .then(response => {
            console.log("Advisor Locations:", response);

            const commissions = response.data?.data ?? [];
            const select = document.getElementById("site_location");

            select.innerHTML = `<option value="">Select Site Location</option>`;

            commissions.forEach(c => {
                if (!c.location) return;

                select.innerHTML += `
                    <option
                        value="${c.location.id}"
                        data-type="${c.commission_type ?? ""}"
                        data-value="${c.commission_value ?? ""}">
                        ${c.location.site_location}
                    </option>
                `;
            });
        })
        .catch(err => {
            console.error("Error loading locations:", err);
            alert("Failed to load site locations");
        });
    }

    loadAdvisorLocations();

    // ================= AUTO COMMISSION SHOW =================
    document.getElementById("site_location").addEventListener("change", function () {
        const selected = this.options[this.selectedIndex];
        const type = selected.getAttribute("data-type");
        const value = selected.getAttribute("data-value");

        const commissionField = document.getElementById("commission_type");
        const commissionValueField = document.getElementById("commission_value");

        if (!type || !value) {
            commissionField.value = "";
            commissionValueField.value = "";
            return;
        }

        commissionField.value = type;
        commissionValueField.value = value;
    });

    // ================= PAN UPPERCASE =================
    document.getElementById("pan_number").addEventListener("input", function () {
        this.value = this.value.toUpperCase().replace(/[^A-Z0-9]/g, '');
    });

    // ================= SUBMIT BOOKING =================
    document.getElementById("bookingForm").addEventListener("submit", async function(e) {
        e.preventDefault();

        let formData = new FormData(this);

        formData.set("referral_id", document.getElementById("reference_id").value);
        formData.set("created_by", user.id);
        formData.set("password", "password");
        formData.set("role", "customer");

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

        console.log([...formData.entries()]);

        try {
            const response = await fetch(url + "bookings", {
                method: "POST",
                headers: {
                    Authorization: "Bearer " + token,
                    Accept: "application/json"
                },
                body: formData
            });

            const data = await response.json();
            console.log("Booking API response:", data);

            if (!response.ok) {
                if (data.errors) {
                    let msg = "";
                    Object.values(data.errors).forEach(e => msg += e[0] + "\n");
                    alert("Validation Errors:\n\n" + msg);
                } else {
                    alert(data.error || data.message || "Something went wrong");
                }
                return;
            }

            alert("✅ " + (data.message || "Booking Created Successfully"));
            window.location.href = "list_customer_booking.php";

        } catch(err) {
            console.error(err);
            alert("Server Error");
        }
    });

});

function confirmReset() {
    if (confirm("Are you sure you want to reset the form?")) {
        location.reload();
    }
}
</script>

<?php include 'footer.php'; ?>