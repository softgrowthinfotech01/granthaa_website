<?php include 'header.php'; ?>

<div class="max-w-3xl mx-auto bg-white px-10 py-10 rounded-2xl shadow-xl">

    <h2 class="text-2xl font-semibold text-gray-800 text-center mb-10">
        Customer Referral Form
    </h2>

    <form class="space-y-8" id="bookingForm">

        <!-- Form Grid -->
        <div class="grid md:grid-cols-2 gap-x-8 gap-y-6">

            <!-- Referral Code -->
            <div class="space-y-2">
                <label class="text-sm font-semibold text-gray-700">
                    Referral Code
                </label>
                <input type="text" value="REF001" readonly
                    class="w-full border border-gray-300 px-4 py-3 rounded-xl
bg-gray-100 outline-none">
            </div>

            <!-- Advisor Code -->
            <div class="space-y-2">
                <label class="text-sm font-semibold text-gray-700">
                    Leader / Advisor Code
                </label>
                <input type="text" value="LEAD001" readonly
                    class="w-full border border-gray-300 px-4 py-3 rounded-xl
bg-gray-100 outline-none">
            </div>

            <!-- site location -->
            <div class="space-y-2">
                <label class="text-sm font-semibold text-gray-700">Site Location</label>
                <select class="w-full border border-gray-300 px-5 py-3 rounded-xl focus:ring-2 focus:ring-blue-400 outline-none">
                    <option>Select Site</option>
                    <option>Datala</option>
                    <option>Kosara</option>
                    <option>Chandrapur</option>
                </select>
            </div>

            <!-- Client Name -->
            <div class="space-y-2">
                <label class="text-sm font-semibold text-gray-700">
                    New Customer Name
                </label>
                <input id="referred_name" name="referred_name" type="text" placeholder="Enter New Customer Name"
                    class="w-full border border-gray-300 px-4 py-3 rounded-xl
focus:ring-2 focus:ring-blue-400 focus:border-blue-400 outline-none">
            </div>

            <!-- Phone Number -->
            <div class="space-y-2">
                <label class="text-sm font-semibold text-gray-700">
                    Phone Number
                </label>
                <input id="referred_contact" name="referred_contact" type="text" placeholder="Enter Phone Number"
                    class="w-full border border-gray-300 px-4 py-3 rounded-xl
focus:ring-2 focus:ring-blue-400 focus:border-blue-400 outline-none">
            </div>

            <!-- Location -->
            <div class="space-y-2">
                <label class="text-sm font-semibold text-gray-700">
                    Customer Email
                </label>
                <input type="email" id="referred_email" name="referred_email" placeholder="Enter Location"
                    class="w-full border border-gray-300 px-4 py-3 rounded-xl
focus:ring-2 focus:ring-blue-400 focus:border-blue-400 outline-none">
            </div>


        </div>

        <!-- Submit Button -->
        <div class="flex justify-center pt-4">
            <button
                class="bg-blue-400 hover:bg-blue-500
px-14 py-3 rounded-xl
font-semibold text-black
shadow-md hover:shadow-xl
transition duration-300">

                Save Referral

            </button>
        </div>

    </form>

</div>


<script>
    document.addEventListener("DOMContentLoaded", function() {

        const token = localStorage.getItem('auth_token');
        const user = JSON.parse(localStorage.getItem('auth_user'));

        if (!token || !user) {
            alert("Please login first");
            window.location.href = "../login";
            return;
        }

        // ================= FORM SUBMIT =================
        document.getElementById("bookingForm").addEventListener("submit", async function(e) {
            e.preventDefault();

            if (user.role !== "customer") {
                alert("You are not allowed to make reference");
                return;
            }

            let form = document.getElementById("bookingForm");
            let formData = new FormData(form);
console.log(formData);
            try {
                const response = await fetch(url + "referrals", {
                    method: "POST",
                    headers: {
                        "Authorization": "Bearer " + token,
                        "Accept": "application/json"
                    },
                    body: formData
                });

                const data = await response.json();

                if (!response.ok) {
                    if (data.errors) {
                        let errorMessages = "";
                        for (let field in data.errors) {
                            errorMessages += data.errors[field][0] + "\n";
                        }
                        alert("Validation Errors:\n\n" + errorMessages);
                    } else {
                        alert(data.message || "Something went wrong");
                    }
                    return;
                }

                alert("✅ " + data.message);
                form.reset();

            } catch (error) {
                console.error(error);
                alert("Server error occurred");
            }
        });

    });
</script>
<?php include 'footer.php'; ?>