<?php include 'header.php'; ?>

<div class="max-w-7xl mx-auto bg-white p-6  rounded-2xl shadow-xl">

<h2 class="text-3xl font-semibold text-center text-gray-800 mb-2">
Customer Booking Form
</h2>

<form id="bookingForm" class="space-y-2">

<!-- ================= CUSTOMER DETAILS ================= -->
<div class=" p-6 ">

<h3 class="text-xl font-semibold text-gray-800 mb-3 border-b pb-2">
Customer Details
</h3>

<div class="grid md:grid-cols-3 gap-2">

<!-- Agent -->
<!-- <div class="space-y-2">
<label class="text-sm font-semibold text-gray-700">Agent / Advisor Name</label>
<input type="text" value="ADV001 - Ravi Kumar" readonly
class="w-full border border-gray-300 px-5 py-3 rounded-xl bg-gray-100 outline-none ">
</div> -->

<!-- Buyer -->
<div class="space-y-2">
<label class="text-sm font-semibold text-gray-700">Buyer Name</label>
<input type="text" name="buyer_name" id="buyer_name" required
class="w-full border border-gray-300 px-5 py-3 rounded-xl focus:ring-2 focus:ring-green-400 outline-none">
</div>

<!-- Mobile -->
<div class="space-y-2">
<label class="text-sm font-semibold text-gray-700">Mobile Number</label>
<input type="number" name="mobile" id="mobile"
class="w-full border border-gray-300 px-5 py-3 rounded-xl focus:ring-2 focus:ring-green-400 outline-none">
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
<input type="email" name="email" id="email"
class="w-full border border-gray-300 px-5 py-3 rounded-xl focus:ring-2 focus:ring-green-400 outline-none">
</div>

<!-- PAN -->
<div class="space-y-2">
<label class="text-sm font-semibold text-gray-700">PAN Number</label>
<input type="text" required name="pan_number" id="pan_number"
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
<input type="number" name="pincode" id="pincode"
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
  <select name="site_location" id="site_location" class="w-full border border-gray-300 px-5 py-3 rounded-xl focus:ring-2 focus:ring-green-400 outline-none ">
    <option>Loading....</option>
</select>
</div>



<div class="space-y-2">
<label class="text-sm font-semibold text-gray-700">Commission Type</label>
<input id="commission_type" type="text" placeholder="commission..."  readonly
                        class="w-full border border-gray-300 px-5 py-3 rounded-xl bg-gray-100 outline-none ">
</div>


<div class="space-y-2">
<label class="text-sm font-semibold text-gray-700">Project Name</label>
<input type="text" name="project_name" id="project_name"
class="w-full border border-gray-300 px-5 py-3 rounded-xl focus:ring-2 focus:ring-green-400 outline-none ">
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
<input  name="tahsil" id="tahsil" type="text"
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
<select name="payment_mode" id="payment_mode" class="w-full border border-gray-300 px-5 py-3 rounded-xl focus:ring-2 focus:ring-green-400 outline-none">
<option>Select Payment Mode</option>
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
<div class="flex justify-center mt-2">
<button
class="bg-green-500 hover:bg-green-600 px-4 py-4 rounded-xl
text-black font-semibold text-lg shadow-md hover:shadow-xl
transition transform hover:scale-[1.02]">

Save Booking

</button>

<button onclick="confirmReset()"
                class="bg-red-500 hover:bg-red-600 px-4 py-4 rounded-xl
text-black font-semibold text-lg shadow-md hover:shadow-xl
transition transform hover:scale-[1.02]">

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

/* ===============================
   LOAD ADVISOR ASSIGNED LOCATIONS
================================*/
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

    const commissions =
        response.data?.data ?? [];

    const select =
        document.getElementById("site_location");

    select.innerHTML =
        `<option value="">Select Site Location</option>`;

    commissions.forEach(c => {

        if (!c.location) return;

        select.innerHTML += `
            <option
                value="${c.location.id}"
                data-type="${c.commission_type}"
                data-value="${c.commission_value}">
                ${c.location.site_location}
            </option>
        `;
    });

});
}

loadAdvisorLocations();


/* ===============================
   AUTO COMMISSION SHOW
================================*/
document
.getElementById("site_location")
.addEventListener("change", function () {

const selected =
    this.options[this.selectedIndex];

const type =
    selected.getAttribute("data-type");

const value =
    selected.getAttribute("data-value");

const commissionField =
    document.getElementById("commission_type");

if (!type || !value) {
    commissionField.value =
        "No Commission Assigned";
    return;
}

if (type === "percent") {
    commissionField.value =
        value + " %";
} else {
    commissionField.value =
        "₹ " + value;
}

});


/* ===============================
   SUBMIT BOOKING (ADVISOR)
================================*/
document
.getElementById("bookingForm")
.addEventListener("submit", async function(e){

e.preventDefault();

let formData = new FormData(this);
formData.set("created_by", user.id);
formData.set("password","password");
formData.set("role","customer");

try {

const response = await fetch(
    url + "bookings",
    {
        method:"POST",
        headers:{
            Authorization:"Bearer "+token,
            Accept:"application/json"
        },
        body:formData
    }
);

const data = await response.json();

if(!response.ok){

if(data.errors){
let msg="";
Object.values(data.errors)
.forEach(e=>msg+=e[0]+"\n");

alert(msg);
}else{
alert(data.message);
}

return;
}

alert("✅ Booking Created Successfully");
this.reset();

}catch(err){
console.error(err);
alert("Server Error");
}

});

});
</script>


<?php include 'footer.php'; ?>
