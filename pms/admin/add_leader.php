<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Leader</title>
    <link rel="stylesheet" href="../style.css">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.css" rel="stylesheet" />

</head>

<body class="bg-gray-200">
    <!--Container -->
    <!--Container -->
    <div class="mx-auto">
        <div class="flex flex-col min-h-screen">

            <?php include "header.php"; ?>

            <div class="flex flex-1">

                <?php include 'sidebar.php'; ?>

                <!-- MAIN -->
                <div id="mainContent"
                    class="w-full md:w-[80%] mx-auto my-6 px-3">

                    <!-- CARD -->
                    <div class="max-w-5xl mx-auto bg-white p-6 md:p-8 rounded-2xl shadow-lg border border-gray-200">

                        <!-- TITLE -->
                        <div class="mb-6 text-center">
                            <h2 class="text-2xl font-bold text-gray-800">Add Leader</h2>
                            <p class="text-sm text-gray-500">Fill all required details</p>
                        </div>

                        <form method="post" id="userForm" enctype="multipart/form-data">

                            <!-- PERSONAL DETAILS -->
                            <div>
                                <h5 class="text-lg font-semibold text-gray-800 mb-3 border-b pb-2">
                                    Personal Details
                                </h5>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                                    <div>
                                        <label class="block mb-1 text-sm font-medium text-gray-700">Full Name</label>
                                        <input name="name" type="text" id="name"
                                            class="w-full px-3 py-2.5 border border-gray-400 rounded-lg bg-white text-sm focus:ring-2 focus:ring-blue-500 outline-none"
                                            placeholder="Enter your name" required>
                                    </div>

                                    <div>
                                        <label class="block mb-1 text-sm font-medium text-gray-700">Aadhaar Card</label>
                                        <input name="aadhaar_number" type="text" maxlength="12" pattern="[0-9]{12}" id="aadhaar_number"
                                            class="w-full px-3 py-2.5 border border-gray-400 rounded-lg bg-white text-sm focus:ring-2 focus:ring-blue-500 outline-none"
                                            placeholder="Enter Aadhaar number" required>
                                    </div>

                                    <div>
                                        <label class="block mb-1 text-sm font-medium text-gray-700">Age</label>
                                        <input name="age" type="text" maxlength="2" id="age"
                                            class="w-full px-3 py-2.5 border border-gray-400 rounded-lg bg-white text-sm focus:ring-2 focus:ring-blue-500 outline-none"
                                            placeholder="Enter age" required>
                                    </div>

                                    <div>
                                        <label class="block mb-1 text-sm font-medium text-gray-700">Gender</label>
                                        <select name="gender" id="gender"
                                            class="w-full px-3 py-2.5 border border-gray-400 rounded-lg ">
                                            <option selected>Choose gender</option>
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                            <option value="other">Other</option>
                                        </select>
                                    </div>

                                    <div>
                                        <label class="block mb-1 text-sm font-medium text-gray-700">Upload Image</label>
                                        <input name="image" type="file" id="file_input"
                                            class="w-full border border-gray-400 rounded-lg bg-white text-sm focus:ring-2 focus:ring-blue-500 outline-none p-2 bg-white">
                                    </div>

                                    <div>
                                        <label class="block mb-1 text-sm font-medium text-gray-700">Pan Card</label>
                                        <input name="pancard_number" type="text" id="pancard_number"
                                            class="w-full px-3 py-2.5 border border-gray-400 rounded-lg bg-white text-sm focus:ring-2 focus:ring-blue-500 outline-none"
                                            placeholder="Enter pancard_number number" required>
                                    </div>

                                </div>
                            </div>

                            <!-- CONTACT DETAILS -->
                            <div class="mt-6">
                                <h5 class="text-lg font-semibold text-gray-800 mb-3 border-b pb-2">
                                    Contact Details
                                </h5>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                                    <div>
                                        <label class="block mb-1 text-sm font-medium text-gray-700">Mobile</label>
                                        <input name="contact_no" type="text" id="contact_no" maxlength="10" pattern="[0-9]{10}"
                                            class="w-full px-3 py-2.5 border border-gray-400 rounded-lg bg-white text-sm focus:ring-2 focus:ring-blue-500 outline-none"
                                            placeholder="Enter mobile number" required>
                                    </div>

                                    <div>
                                        <label class="block mb-1 text-sm font-medium text-gray-700">Email</label>
                                        <input name="email" type="email" id="email"
                                            class="w-full px-3 py-2.5 border border-gray-400 rounded-lg bg-white text-sm focus:ring-2 focus:ring-blue-500 outline-none"
                                            placeholder="Enter email" required>
                                    </div>

                                    <div>
                                        <label class="block mb-1 text-sm font-medium text-gray-700">City</label>
                                        <input name="city" type="text" id="city"
                                            class="w-full px-3 py-2.5 border border-gray-400 rounded-lg bg-white text-sm focus:ring-2 focus:ring-blue-500 outline-none"
                                            placeholder="Enter city" required>
                                    </div>

                                    <div>
                                        <label class="block mb-1 text-sm font-medium text-gray-700">State</label>
                                        <input name="state" type="text" id="state"
                                            class="w-full px-3 py-2.5 border border-gray-400 rounded-lg bg-white text-sm focus:ring-2 focus:ring-blue-500 outline-none"
                                            placeholder="Enter state" required>
                                    </div>

                                    <div class="md:col-span-2">
                                        <label class="block mb-1 text-sm font-medium text-gray-700">Address</label>
                                        <input name="address" type="text" id="address"
                                            class="w-full px-3 py-2.5 border border-gray-400 rounded-lg bg-white text-sm focus:ring-2 focus:ring-blue-500 outline-none"
                                            placeholder="Enter address" required>
                                    </div>

                                    <div>
                                        <label class="block mb-1 text-sm font-medium text-gray-700">Pincode</label>
                                        <input name="pin_code" type="text" id="pin_code" maxlength="6"
                                            class="w-full px-3 py-2.5 border border-gray-400 rounded-lg bg-white text-sm focus:ring-2 focus:ring-blue-500 outline-none"
                                            placeholder="Enter pincode" required>
                                    </div>

                                </div>
                            </div>

                            <!-- BANK DETAILS -->
                            <div class="mt-6">
                                <h5 class="text-lg font-semibold text-gray-800 mb-3 border-b pb-2">
                                    Bank Details
                                </h5>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                                    <div>
                                        <label class="block mb-1 text-sm font-medium text-gray-700">Bank Name</label>
                                        <input name="bank_name" type="text" id="bank_name"
                                            class="w-full px-3 py-2.5 border border-gray-400 rounded-lg bg-white text-sm focus:ring-2 focus:ring-blue-500 outline-none"
                                            placeholder="Enter bank name" required>
                                    </div>

                                    <div>
                                        <label class="block mb-1 text-sm font-medium text-gray-700">Branch</label>
                                        <input name="bank_branch" type="text" id="branch"
                                            class="w-full px-3 py-2.5 border border-gray-400 rounded-lg bg-white text-sm focus:ring-2 focus:ring-blue-500 outline-none"
                                            placeholder="Enter branch" required>
                                    </div>

                                    <div>
                                        <label class="block mb-1 text-sm font-medium text-gray-700">Account Number</label>
                                        <input name="bank_account_no" type="text" id="account_number" maxlength="18"
                                            inputmode="numeric"
                                            pattern="[0-9]{9,18}"
                                            class="w-full px-3 py-2.5 border border-gray-400 rounded-lg bg-white text-sm focus:ring-2 focus:ring-blue-500 outline-none"
                                            placeholder="Enter account number" required>
                                    </div>

                                    <div>
                                        <label class="block mb-1 text-sm font-medium text-gray-700">IFSC Code</label>
                                        <input name="bank_ifsc_code" type="text" id="ifsc_code"
                                            class="w-full px-3 py-2.5 border border-gray-400 rounded-lg bg-white text-sm focus:ring-2 focus:ring-blue-500 outline-none"
                                            placeholder="Enter IFSC code" required>
                                    </div>

                                </div>
                            </div>

                            <!-- BUTTONS -->
                            <div class="mt-8 flex flex-col md:flex-row justify-center gap-3">

                                <button type="submit"
                                    class="w-full md:w-[180px] bg-blue-600 hover:bg-blue-500 text-white rounded-lg px-4 py-2.5 transition shadow">
                                    Save
                                </button>

                                <button type="button"
                                    onclick="confirmReset()"
                                    class="w-full md:w-[180px] bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-lg px-4 py-2.5 border">
                                    Reset
                                </button>

                            </div>

                        </form>

                    </div>
                </div>

            </div>

            <?php include 'footer.php'; ?>

        </div>
    </div>

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
            const aadhar = document.getElementById("aadhaar_number").value.trim();

            if (!/^\d{12}$/.test(aadhar)) {
                alert("Aadhar must be exactly 12 digits");
                return;
            }

            // Mobile validation
            function validateMobile() {
                let mobile = document.getElementById("contact_no").value;

                if (!/^[6-9]\d{9}$/.test(mobile)) {
                    alert("Enter valid 10 digit mobile number");
                    return false;
                }
                return true;
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

            // ✅ PAN VALIDATION (ADD HERE)
            const panInput = document.getElementById("pancard_number");

            // force uppercase
            panInput.value = panInput.value.toUpperCase();

            const pan = panInput.value.trim();
            const panRegex = /^[A-Z]{5}[0-9]{4}[A-Z]{1}$/;

            if (!panRegex.test(pan)) {
                panInput.setCustomValidity("Invalid PAN format (ABCDE1234F)");
                panInput.reportValidity();
                return; // 🚨 STOP FORM SUBMIT
            } else {
                panInput.setCustomValidity("");
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

            let contactNumber = document.querySelector("input[name='contact_no']").value;

            formData.set("role", "leader");
            formData.set("password", contactNumber);
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

                window.location.href = "view_leader.php";

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

        ifscInput.addEventListener("input", function() {

            const value = this.value;

            // only validate when length is 11
            if (value.length === 11) {

                const ifscRegex = /^[A-Z]{4}0[A-Z0-9]{6}$/;

                if (!ifscRegex.test(value)) {
                    alert("Invalid IFSC code");
                }
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

        // Pincode Validation
        const pincode = document.getElementById("pin_code").value.trim();

        if (!/^[0-9]{6}$/.test(pincode)) {
            alert("Invalid pincode");
            return;
        }
    </script>

    <script>
        document.getElementById("account_number").addEventListener("input", function(e) {

            // remove non-numeric characters
            this.value = this.value.replace(/\D/g, "");

            // limit to 18 digits
            if (this.value.length > 18) {
                this.value = this.value.slice(0, 18);
            }

        });
    </script>
</body>

</html>