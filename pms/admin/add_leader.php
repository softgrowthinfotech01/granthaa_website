<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Leader</title>
    <link rel="stylesheet" href="../style.css">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.css" rel="stylesheet" />

</head>

<body>
    <!--Container -->
    <div class="mx-auto">
        <!--Screen-->
        <div class="flex flex-col min-h-screen">
            <!--Header Section Starts Here-->
            <?php include "header.php"; ?>
            <!--/Header-->

            <div class="flex flex-1">
                <!--Sidebar-->
                <?php include 'sidebar.php'; ?>
                <!--/Sidebar-->

                <!--Main-->
                <!--Main-->
                <div id="mainContent"
                    class="w-full md:w-[80%] lg:w-[60%] mx-3 md:mx-auto my-4
transition-all duration-300">

                    <form class="w-full px-4 rounded-lg bg-gray-200 p-6 border shadow-xl" method="post" id="userForm" enctype="multipart/form-data">

                        <div class="personal-details">
                            <h5 class="text-xl font-bold text-heading p-1">Add Leader Details</h5>

                            <div class="grid grid-cols-1 md:grid-cols-2">

                                <div class="mb-5 px-1">
                                    <label for="name" class="block mb-2.5 text-sm font-medium text-heading">Full Name</label>
                                    <input name="name" type="text" id="name"
                                        class="rounded-lg bg-neutral-secondary-medium border border-default-medium text-heading text-sm block w-full px-3 py-2.5 shadow-xs"
                                        placeholder="Enter your name" required />
                                </div>

                                <div class="mb-5 px-1">
                                    <label for="aadhar_card" class="block mb-2.5 text-sm font-medium text-heading">Aadhar Card</label>
                                    <input name="aadhar_card" type="text" maxlength="12" pattern="[0-9]{12}" inputmode="numeric"
                                        id="aadhar_card"
                                        class="rounded-lg bg-neutral-secondary-medium border border-default-medium text-heading text-sm block w-full px-3 py-2.5 shadow-xs"
                                        placeholder="Enter Aadhar card number" required />
                                </div>

                                <div class="mb-5 px-1">
                                    <label for="age" class="block mb-2.5 text-sm font-medium text-heading">Age</label>
                                    <input name="age" type="text" maxlength="2" pattern="[0-9]{2}" inputmode="numeric"
                                        id="age"
                                        class="rounded-lg bg-neutral-secondary-medium border border-default-medium text-heading text-sm block w-full px-3 py-2.5 shadow-xs"
                                        placeholder="Enter your age" required />
                                </div>

                                <div class="mb-5 px-1">
                                    <label for="gender" class="block mb-2.5 text-sm font-medium text-heading">Gender</label>
                                    <select name="gender" id="gender"
                                        class="block w-full px-3 py-2.5 rounded-lg bg-white border border-default-medium text-heading text-sm shadow-xs">
                                        <option selected>Choose a gender</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                    </select>
                                </div>

                                <div class="mb-5 px-1">
                                    <label class="block mb-2.5 text-sm font-medium text-heading">Upload Image</label>
                                    <input id="file_input" name="image" accept=".jpg,.jpeg,.png"
                                        class="rounded-lg cursor-pointer bg-white border border-default-medium text-heading text-sm block w-full shadow-xs"
                                        type="file">
                                </div>

                            </div>
                        </div>

                        <hr class="border-white-300 mb-3">

                        <!-- Contact Details -->

                        <div>
                            <h5 class="text-xl font-bold text-heading p-1">Contact Details</h5>

                            <div class="grid grid-cols-1 md:grid-cols-2">

                                <div class="mb-5 px-1">
                                    <label for="mobile" class="block mb-2.5 text-sm font-medium text-heading">Mobile Number</label>
                                    <input name="contact_no" type="tel" maxlength="10" pattern="[0-9]{10}"
                                        id="mobile"
                                        class="rounded-lg bg-neutral-secondary-medium border border-default-medium text-heading text-sm block w-full px-3 py-2.5 shadow-xs"
                                        placeholder="Enter mobile number" required />
                                </div>

                                <div class="mb-5 px-1">
                                    <label for="email" class="block mb-2.5 text-sm font-medium text-heading">Email</label>
                                    <input name="email" type="email" id="email"
                                        class="rounded-lg bg-neutral-secondary-medium border border-default-medium text-heading text-sm block w-full px-3 py-2.5 shadow-xs"
                                        placeholder="Enter email" required />
                                </div>

                                <div class="mb-5 px-1">
                                    <label for="city" class="block mb-2.5 text-sm font-medium text-heading">City</label>
                                    <input name="city" type="text" id="city"
                                        class="rounded-lg bg-neutral-secondary-medium border border-default-medium text-heading text-sm block w-full px-3 py-2.5 shadow-xs"
                                        placeholder="Enter city" required />
                                </div>

                                <div class="mb-5 px-1">
                                    <label for="state" class="block mb-2.5 text-sm font-medium text-heading">State</label>
                                    <input name="state" type="text" id="state"
                                        class="rounded-lg bg-neutral-secondary-medium border border-default-medium text-heading text-sm block w-full px-3 py-2.5 shadow-xs"
                                        placeholder="Enter state" required />
                                </div>

                                <div class="mb-5 px-1">
                                    <label for="address" class="block mb-2.5 text-sm font-medium text-heading">Address</label>
                                    <input name="address" type="text" id="address"
                                        class="rounded-lg bg-white border border-default-medium text-heading text-sm block w-full px-3 py-2.5 shadow-xs"
                                        placeholder="Enter address" required />
                                </div>

                                <div class="mb-5 px-1">
                                    <label for="pincode" class="block mb-2.5 text-sm font-medium text-heading">Pincode</label>
                                    <input name="pin_code" type="text" maxlength="6"
                                        id="pincode"
                                        class="rounded-lg bg-neutral-secondary-medium border border-default-medium text-heading text-sm block w-full px-3 py-2.5 shadow-xs"
                                        placeholder="Enter pincode" required />
                                </div>

                            </div>
                        </div>

                        <hr class="border-white-300 mb-3">

                        <!-- Bank Details -->

                        <div>
                            <h5 class="text-xl font-bold text-heading p-1">Bank Details</h5>

                            <div class="grid grid-cols-1 md:grid-cols-2">

                                <div class="mb-5 px-1">
                                    <label for="bank_name" class="block mb-2.5 text-sm font-medium text-heading">Bank Name</label>
                                    <input name="bank_name" type="text" id="bank_name"
                                        class="rounded-lg bg-neutral-secondary-medium border border-default-medium text-heading text-sm block w-full px-3 py-2.5 shadow-xs"
                                        placeholder="Enter bank name" required />
                                </div>

                                <div class="mb-5 px-1">
                                    <label for="branch" class="block mb-2.5 text-sm font-medium text-heading">Branch</label>
                                    <input name="bank_branch" type="text" id="branch"
                                        class="rounded-lg bg-neutral-secondary-medium border border-default-medium text-heading text-sm block w-full px-3 py-2.5 shadow-xs"
                                        placeholder="Enter branch name" required />
                                </div>

                                <div class="mb-5 px-1">
                                    <label for="account_number" class="block mb-2.5 text-sm font-medium text-heading">Account Number</label>
                                    <input name="bank_account_no" type="text" id="account_number"
                                        class="rounded-lg bg-neutral-secondary-medium border border-default-medium text-heading text-sm block w-full px-3 py-2.5 shadow-xs"
                                        placeholder="Enter account number" pattern="[0-9]{9,18}" maxlength="18" required />
                                </div>

                                <div class="mb-5 px-1">
                                    <label for="ifsc_code" class="block mb-2.5 text-sm font-medium text-heading">IFSC Code</label>
                                    <input name="bank_ifsc_code" type="text" id="ifsc_code"
                                        class="rounded-lg bg-neutral-secondary-medium border border-default-medium text-heading text-sm block w-full px-3 py-2.5 shadow-xs"
                                        pattern="[A-Za-z]{4}0[A-Za-z0-9]{6}"
                                        title="Enter valid IFSC code (Example: HDFC0001234)"
                                        placeholder="Enter IFSC code" maxlength="11" required />
                                </div>

                            </div>
                        </div>

                        <hr class="border-white-300 mb-3">

                        <div class="flex justify-center gap-3">

                            <button type="submit"
                                class="w-full md:w-[20%] text-white bg-blue-600 hover:bg-blue-500 rounded-lg text-sm px-4 py-2.5">
                                Save
                            </button>

                            <button type="button"
                                onclick="confirmReset()"
                                class="w-full md:w-[20%] text-gray-700 bg-white hover:bg-gray-200 rounded-lg text-sm px-4 py-2.5">
                                Reset
                            </button>

                        </div>

                    </form>
                </div>
                <!--/Main-->
            </div>
            <!--Footer-->
            <?php include 'footer.php'; ?>
            <!--/footer-->

        </div>

    </div>

    <script src="../url.js"></script>

    <script>
        function confirmReset() {
            if (confirm("Clear all entered data?")) {
                document.querySelector("form").reset();
            }
        }

        console.log("Add Leader page loaded");
    </script>
    <script>
        document.getElementById("userForm").addEventListener("submit", async function(e) {

            e.preventDefault();

            const form = document.getElementById("userForm");
            const emailInput = document.getElementById("email");
            const fileInput = document.getElementById("file_input");

            // AADHAR VALIDATION
            const aadhar = document.getElementById("aadhar_card").value.trim();

            if (!/^\d{12}$/.test(aadhar)) {
                alert("Aadhar must be exactly 12 digits");
                return;
            }

            // EMAIL VALIDATION
            const email = emailInput.value.trim();
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            if (!emailPattern.test(email)) {
                emailInput.setCustomValidity("Enter a valid email (must contain @ and .)");
                emailInput.reportValidity();
                return;
            } else {
                emailInput.setCustomValidity("");
            }

            // ACCOUNT NUMBER VALIDATION
            const accountNumber = document.getElementById("account_number").value.trim();

            if (accountNumber.length < 9 || accountNumber.length > 18) {
                alert("Account number must be between 9-18 digits");
                return;
            }

            // IMAGE VALIDATION
            const file = fileInput.files[0];

            if (file) {

                const allowedTypes = ["image/jpeg", "image/png"];

                if (!allowedTypes.includes(file.type)) {
                    alert("Only JPG, JPEG and PNG files are allowed.");
                    return;
                }

                const maxSize = 2 * 1024 * 1024;

                if (file.size > maxSize) {
                    alert("Image size must be less than 2MB.");
                    return;
                }
            }

            const token = localStorage.getItem('auth_token');
            const user = JSON.parse(localStorage.getItem('auth_user'));

            if (!token || !user) {
                alert("Please login first");
                window.location.href = "../login";
                return;
            }

            if (user.role !== "admin") {
                alert("You are not allowed to create leader");
                return;
            }

            let formData = new FormData(form);

            formData.set("role", "leader");
            formData.set("password", "password123");
            formData.set("created_by", user.id);

            try {

                const response = await fetch(url + "users", {
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
        document.getElementById("email").addEventListener("input", function() {
            this.setCustomValidity("");
        });
    </script>



    <script src="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.js"></script>



    <script>
        // Account number max 18 digits
        const accountInput = document.getElementById("account_number");

        accountInput.addEventListener("input", function() {

            // allow only numbers
            this.value = this.value.replace(/\D/g, "");

            // max 18 digits
            if (this.value.length > 18) {
                this.value = this.value.slice(0, 18);
            }

        });

const ifscInput = document.getElementById("ifsc_code");

ifscInput.addEventListener("input", function () {

    let value = this.value.toUpperCase();

    // allow only A-Z and 0-9
    value = value.replace(/[^A-Z0-9]/g, '');

    // limit to 11 characters
    value = value.slice(0, 11);

    this.value = value;

});

ifscInput.addEventListener("blur", function () {

    const value = this.value;

    const ifscRegex = /^[A-Z]{4}0[A-Z0-9]{6}$/;

    if (!ifscRegex.test(value)) {
        alert("Invalid IFSC code");
    }

});

        // for branch and bank name allow only letters and spaces

        function allowOnlyLetters(input) {
            input.value = input.value.replace(/[^a-zA-Z0-9\s]/g, '');
        }

        document.getElementById("bank_name").addEventListener("input", function() {
            allowOnlyLetters(this);
        });

        document.getElementById("branch").addEventListener("input", function() {
            allowOnlyLetters(this);
        });
    </script>


</body>

</html>