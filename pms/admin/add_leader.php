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
        <div class="flex flex-col">
            <!--Header Section Starts Here-->
            <?php include "header.php"; ?>
            <!--/Header-->

            <div class="flex">
                <!--Sidebar-->
                <?php include 'sidebar.php'; ?>
                <!--/Sidebar-->

                <!--Main-->
                <div class="w-[60%] mx-auto my-4 self-start rounded-lg bg-gray-300 p-6 border border-default rounded-base shadow-xs hover:bg-neutral-secondary-medium">
                    <form class="w-full" method="post" id="userForm" enctype="multipart/form-data">
                        <div class="personal-details">
                            <h5 class="text-xl font-bold text-heading p-1">Add Leader Details</h5>
                            <div class="">
                                <!-- <div class="mb-5 col-span-1 px-1">
                                    <label for="leader_code" class="block mb-2.5 text-sm font-medium text-heading">Leader Code</label>
                                    <input type="text" id="leader_code" class="rounded-lg bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body focus:outline-none focus:ring-2 focus:ring-gray-600" placeholder="Enter leader code"  />
                                </div> -->
                                <div class="mb-5 col-span-1 px-1">
                                    <label for="name" class="block mb-2.5 text-sm font-medium text-heading">Full Name</label>
                                    <input name="name" type="text" id="name" class="rounded-lg bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body" placeholder="Enter your name" required />
                                </div>
                            </div>
                            <div class="grid grid-cols-2">
                                <div class="mb-5 col-span-1 px-1">
                                    <label for="age" class="block mb-2.5 text-sm font-medium text-heading">Age</label>
                                    <input name="age" type="text" maxlength="2" pattern="[0-9]{2}" inputmode="numeric" id="age" class="rounded-lg bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body" placeholder="Enter your age" required />
                                </div>
                                <div class="mb-5 col-span-1 px-1">
                                    <label for="gender" class="block mb-2.5 text-sm font-medium text-heading">Gender</label>
                                    <select name="gender" id="gender" class="block w-full px-3 py-2.5 rounded-lg bg-white border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand shadow-xs placeholder:text-body">
                                        <option selected>Choose a gender</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                    </select>
                                </div>
                            </div>
                            <div class="">
                                <div class="mb-5 px-1">
                                    <label class="block mb-2.5 text-sm font-medium text-heading" for="file_input">Upload Image</label>
                                    <input name="image" accept=".jpg,.jpeg,.png" class="rounded-lg cursor-pointer bg-white border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full shadow-xs placeholder:text-body" id="file_input" type="file">
                                </div>
                            </div>
                        </div>
                        <hr class="border-white-300 mb-3">
                        <div class="contact-details">
                            <h5 class="text-xl font-bold text-heading p-1">Contact Details</h5>

                            <div class="grid grid-cols-2">
                                <div class="mb-5 col-span-1 px-1">
                                    <label for="mobile" class="block mb-2.5 text-sm font-medium text-heading">Mobile Number</label>
                                    <input name="contact_no" type="tel" maxlength="10" pattern="[0-9]{10}" inputmode="numeric" id="mobile"
                                        class="rounded-lg bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body" placeholder="Enter your mobile number" required />
                                </div>
                                <div class="mb-5 col-span-1 px-1">
                                    <label for="email" class="block mb-2.5 text-sm font-medium text-heading">Email</label>
                                    <input type="email" name="email" id="email" class="rounded-lg bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body" placeholder="Enter your email"  required />
                                </div>
                            </div>
                            <div class="grid grid-cols-2">
                                <div class="mb-5 col-span-1 px-1">
                                    <label for="city" class="block mb-2.5 text-sm font-medium text-heading">City</label>
                                    <input type="text" name="city" id="city" class="rounded-lg bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body" placeholder="Enter your city" required pattern="[A-Za-z\s]+"/>
                                </div>
                                <div class="mb-5 col-span-1 px-1">
                                    <label for="state" class="block mb-2.5 text-sm font-medium text-heading">State</label>
                                    <input name="state" type="text" id="state" class="rounded-lg bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body" placeholder="Enter your state" required />
                                </div>
                            </div>
                            <div class="">
                                <div class="grid grid-cols-2">
                                    <div class="mb-5 col-span-1 px-1">
                                        <label for="address" class="block mb-2.5 text-sm font-medium text-heading">Address</label>
                                        <input name="address" type="textarea" id="address" class="rounded-lg bg-white border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body" placeholder="Enter your address" required />
                                    </div>
                                    <div class="mb-5 col-span-1 px-1">
                                        <label for="pincode" class="block mb-2.5 text-sm font-medium text-heading">Pincode</label>
                                        <input name="pin_code" type="text" maxlength="6" inputmode="numeric" pattern="[0-9]{6}" id="pincode"
                                            class="rounded-lg bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body" placeholder="Enter your pincode" required />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="border-white-300 mb-3">
                        <div class="contact-details">
                            <h5 class="text-xl font-bold text-heading p-1">Bank Details</h5>
                            <div class="grid grid-cols-2">
                                <div class="mb-5 col-span-1 px-1">
                                    <label for="bank_name" class="block mb-2.5 text-sm font-medium text-heading">Bank Name</label>
                                    <input name="bank_name" type="text" id="bank_name" class="rounded-lg bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body" placeholder="Enter your bank name" required />
                                </div>
                                <div class="mb-5 col-span-1 px-1">
                                    <label for="branch" class="block mb-2.5 text-sm font-medium text-heading">Branch</label>
                                    <input name="bank_branch" type="text" id="branch" class="rounded-lg bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body" placeholder="Enter your branch name" required />
                                </div>

                            </div>
                            <div class="grid grid-cols-2">
                                <div class="mb-5 col-span-1 px-1">
                                    <label for="account_number" class="block mb-2.5 text-sm font-medium text-heading">Account Number</label>
                                    <input name="bank_account_no" type="text" id="account_number" class="rounded-lg bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body" placeholder="Enter your account number" required />
                                </div>
                                <div class="mb-5 col-span-1 px-1">
                                    <label for="ifsc_code" class="block mb-2.5 text-sm font-medium text-heading">IFSC Code</label>
                                    <input name="bank_ifsc_code" type="text" id="ifsc_code" class="rounded-lg bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body" placeholder="Enter your IFSC code" required />
                                </div>

                            </div>

                        </div>
                        <hr class="border-white-300 mb-3">
                        <div class="flex justify-center gap-2">
                            <button type="submit" class="w-[15%] text-white bg-blue-500 box-border border border-transparent hover:bg-blue-600 rounded-lg focus:ring-4 focus:ring-brand-medium shadow-xs font-medium leading-5 rounded-base text-sm px-4 py-2.5 focus:outline-none">Save</button>
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


    <script>
        // Email Validation
        document.addEventListener("DOMContentLoaded", function () {

            const form = document.getElementById("userForm");
            const emailInput = document.getElementById("email");

            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            function validateEmail() {
                const email = emailInput.value.trim();

                if (email === "") {
                    emailInput.setCustomValidity("Email is required");
                }
                else if (!emailPattern.test(email)) {
                    emailInput.setCustomValidity("Enter a valid email like example@gmail.com");
                }
                else {
                    emailInput.setCustomValidity("");
                }
            }

            // Validate while typing
            emailInput.addEventListener("input", validateEmail);

            // Show error when user leaves field
            emailInput.addEventListener("blur", function () {
                emailInput.reportValidity();
            });

            // Prevent form submission if invalid
            form.addEventListener("submit", function (e) {
                validateEmail();

                if (!emailInput.checkValidity()) {
                    e.preventDefault();
                    emailInput.reportValidity();
                }
            });

        });

        // City Validation
        document.addEventListener("DOMContentLoaded", function () {

            const form = document.getElementById("userForm");
            const cityInput = document.getElementById("city");

            const cityPattern = /^[A-Za-z\s]+$/;

            function validateCity() {
                const city = cityInput.value.trim();

                if (city === "") {
                    cityInput.setCustomValidity("City is required");
                }
                else if (!cityPattern.test(city)) {
                    cityInput.setCustomValidity("City should contain only letters");
                }
                else {
                    cityInput.setCustomValidity("");
                }
            }

            // Validate while typing
            cityInput.addEventListener("input", validateCity);

            // Show error when leaving the field
            cityInput.addEventListener("blur", function () {
                cityInput.reportValidity();
            });

            // Prevent form submission if invalid
            form.addEventListener("submit", function (e) {

                validateCity();

                if (!cityInput.checkValidity()) {
                    e.preventDefault();
                    cityInput.reportValidity();
                }

            });

        });
    </script>





    <script>
        function confirmReset() {
            if (confirm("Clear all entered data?")) {
                document.querySelector("form").reset();
            }
        }

        console.log("Add Leader page loaded");
    </script>
    <script src="../url.js"></script>
    <script>
        document.getElementById("userForm").addEventListener("submit", async function(e) {

            // ✅ Image Validation (JPG, JPEG, PNG, Max 5MB)
            const fileInput = document.getElementById("file_input");
            const file = fileInput.files[0];

            if (file) {

                const allowedTypes = ["image/jpeg", "image/png"];

                if (!allowedTypes.includes(file.type)) {
                    alert("Only JPG, JPEG and PNG files are allowed.");
                    return;
                }

                const maxSize = 2 * 1024 * 1024; // 2MB

                if (file.size > maxSize) {
                    alert("Image size must be less than 2MB.");
                    return;
                }
            }

            e.preventDefault();

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

            let form = document.getElementById("userForm");
            let formData = new FormData(form);
            // alert(formData);
            // 🔥 FORCE VALUES
            formData.set("role", "leader");
            formData.set("password", "password123"); // static password
            formData.set("created_by", user.id); // admin id
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
                    // Laravel validation errors
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

                // ✅ SUCCESS ALERT
                alert("✅ " + data.message);

                // Optional: reset form after success
                form.reset();

            } catch (error) {
                console.error(error);
                alert("Server error occurred");
            }
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.js"></script>



    <script src="../url.js"></script>

    <script>
        document.getElementById('leaderForm').addEventListener('submit', async function(e) {
            e.preventDefault();

            const token = localStorage.getItem('auth_token');
            const user = JSON.parse(localStorage.getItem('auth_user'));

            if (!token || !user) {
                alert('Please login first');
                window.location.href = '../login';
                return;
            }

            // UI level role protection (backend already protected)
            if (user.role !== 'admin') {
                alert('You are not allowed to update Leader details');
                return;
            }

            const name = document.getElementById('name').value.trim();
            const password = 'password';
            const leader_code = document.getElementById('leader_code').value.trim();
            const age = document.getElementById('age').value.trim();
            const gender = document.getElementById('gender').value.trim();
            const mobile = document.getElementById('mobile').value.trim();
            const email = document.getElementById('email').value.trim();
            const city = document.getElementById('city').value.trim();
            const state = document.getElementById('state').value.trim();
            const address = document.getElementById('address').value.trim();
            const pincode = document.getElementById('pincode').value.trim();
            const fileInput = document.getElementById('file_input');
            // const bankName = document.getElementById('bank_name').value.trim();
            // const branch = document.getElementById('branch').value.trim();
            // const accountNumber = document.getElementById('account_number').value.trim();
            // const ifscCode = document.getElementById('ifsc_code').value.trim();




            try {
                const response = await fetch(url + 'users', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Authorization': 'Bearer ' + token
                    },
                    body: JSON.stringify({
                        first_name: name,
                        last_name: "aryan",
                        email: email,
                        password: password,
                        role: "leader",
                        age: age,
                        gender: gender,
                        contact_no: mobile,
                        city: city,
                        state: state,
                        address: address,
                        pin_code: pincode
                    })
                });

                const data = await response.json();

                if (!response.ok) {
                    alert(data.message || 'Something went wrong');
                    return;
                }

                alert('Leader added successfully');
                document.getElementById('leaderForm').reset();

            } catch (error) {
                console.error(error);
                alert('Server error');
            }
        });
    </script>


<script>
        // Account number max 18 digits
document.getElementById("account_number").addEventListener("input", function () {
    if (this.value.length > 18) {
        this.value = this.value.slice(0, 18);
    }
});

// IFSC validation (uppercase + alphanumeric + max 11)
document.getElementById("ifsc_code").addEventListener("input", function () {

    // convert to uppercase
    this.value = this.value.toUpperCase();

    // allow only alphanumeric
    this.value = this.value.replace(/[^A-Z0-9]/g, '');

    // limit to 11 characters
    if (this.value.length > 10) {
        this.value = this.value.slice(0, 10);
    }
});

// for branch and bank name allow only letters and spaces

function allowOnlyLetters(input) {
    input.value = input.value.replace(/[^a-zA-Z0-9\s]/g, '');
}

document.getElementById("bank_name").addEventListener("input", function () {
    allowOnlyLetters(this);
});

document.getElementById("branch").addEventListener("input", function () {
    allowOnlyLetters(this);
});
    </script>


</body>

</html>