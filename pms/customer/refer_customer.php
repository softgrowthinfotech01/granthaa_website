<?php include 'header.php'; ?>

<div class="max-w-3xl mx-auto bg-white px-10 py-10 rounded-2xl shadow-xl">

    <h2 class="text-2xl font-semibold text-gray-800 text-center mb-10">
        Customer Referral Form
    </h2>

    <form class="space-y-8" id="referralForm">

        <!-- Form Grid -->
        <div class="grid md:grid-cols-2 gap-x-8 gap-y-6">


            <!-- Client Name -->
            <div class="space-y-2">
                <label class="text-sm font-semibold text-gray-700">
                    New Customer Name
                </label>
                <input id="referred_name" name="referred_name" type="text" placeholder="Enter Customer Name" class="w-full border border-gray-300 px-4 py-3 rounded-xl
focus:ring-2 focus:ring-blue-400 focus:border-blue-400 outline-none">
            </div>

            <!-- Phone Number -->
            <div class="space-y-2">
                <label class="text-sm font-semibold text-gray-700">
                    Phone Number
                </label>
                <input id="referred_contact" name="referred_contact" type="text" placeholder="Enter Phone Number" class="w-full border border-gray-300 px-4 py-3 rounded-xl
focus:ring-2 focus:ring-blue-400 focus:border-blue-400 outline-none">
            </div>

            <!-- Location -->
            <div class="space-y-2">
                <label class="text-sm font-semibold text-gray-700">
                    Customer Email
                </label>
                <input type="email" id="referred_email" name="referred_email" placeholder="Enter Location" class="w-full border border-gray-300 px-4 py-3 rounded-xl
focus:ring-2 focus:ring-blue-400 focus:border-blue-400 outline-none">
            </div>


        </div>

        <!-- Submit Button -->
        <div class="flex justify-center pt-4">
            <button type="submit" class="bg-blue-400 hover:bg-blue-500
px-14 py-3 rounded-xl
font-semibold text-black
shadow-md hover:shadow-xl
transition duration-300">

                Save Referral

            </button>
        </div>

    </form>

</div>


<?php include 'footer.php'; ?>


<script src="../url.js"></script>

<script>

    document.addEventListener("DOMContentLoaded", function () {

        const token = localStorage.getItem("auth_token");

        let authUser = JSON.parse(localStorage.getItem("auth_user"));

        const user = authUser?.user ?? authUser?.data ?? authUser;

        if (!token || !user) {
            alert("Please login first");
            window.location.href = "../login";
            return;
        }

        document.getElementById("referralForm")
            .addEventListener("submit", async function (e) {

                e.preventDefault();

                let formData = new FormData(this);

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

                            let errors = "";

                            for (let field in data.errors) {
                                errors += data.errors[field][0] + "\n";
                            }

                            alert(errors);

                        } else {
                            alert(data.message || "Something went wrong");
                        }

                        return;
                    }

                    alert(" Referral submitted successfully");

                    this.reset();

                } catch (error) {

                    console.error(error);

                    alert("Server error occurred");

                }

            });

    });

</script>
