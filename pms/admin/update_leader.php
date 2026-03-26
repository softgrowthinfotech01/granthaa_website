<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Leader</title>
    <link rel="stylesheet" href="../style.css">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.css" rel="stylesheet" />

</head>

<body class="bg-gray-200">
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
             <div id="mainContent"
    class="w-full md:w-[80%] lg:w-[70%] mx-auto my-6 px-3">

    <form class="w-full bg-white p-6 md:p-8 rounded-2xl shadow-lg border border-gray-200"
        method="post" id="userForm" enctype="multipart/form-data">

        <!-- TITLE -->
        <div class="mb-6 text-center">
            <h2 class="text-xl md:text-2xl font-bold text-gray-800">
                Update Leader Details
            </h2>
            <p class="text-sm text-gray-500">Edit leader information</p>
        </div>

        <!-- PERSONAL -->
        <div class="mb-6">
            <h5 class="text-md font-semibold text-gray-700 mb-3">Personal Details</h5>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                <div>
                    <label class="block text-sm text-gray-700 mb-1">Leader Code</label>
                    <input type="text" id="user_code"
                        class="w-full px-3 py-2.5 rounded-lg bg-gray-100 border border-gray-200 text-gray-700 text-sm cursor-not-allowed"
                        readonly />
                </div>

                <div>
                    <label class="block text-sm text-gray-700 mb-1">Full Name</label>
                    <input type="text" id="name"
                        class="w-full px-3 py-2.5 border border-gray-400 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 outline-none"
                        required />
                </div>

                <div>
                    <label class="block text-sm text-gray-700 mb-1">Age</label>
                    <input name="age" type="text" maxlength="2" pattern="[0-9]{2}" inputmode="numeric" id="age"
                        class="w-full px-3 py-2.5 border border-gray-400 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 outline-none"
                        required />
                </div>

                <div>
                    <label class="block text-sm text-gray-700 mb-1">Gender</label>
                    <select id="gender"
                        class="w-full px-3 py-2.5 border border-gray-400 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 outline-none">
                        <option selected>Choose a gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="other">Other</option>
                    </select>
                </div>

            </div>

            <!-- IMAGE -->
            <div class="mt-4">
                <label class="block text-sm text-gray-700 mb-2">Current Image</label>

                <img id="current_image"
                    src=""
                    class="w-28 h-28 object-cover rounded-lg border mb-3"
                    alt="Leader Image">

                <label class="block text-sm text-gray-700 mb-1">Upload New Image</label>
                <input accept=".jpg,.jpeg,.png"
                    class="w-full px-3 py-2 border border-gray-400 rounded-lg text-sm bg-white"
                    id="file_input" type="file">
            </div>
        </div>

        <hr class="mb-6">

        <!-- CONTACT -->
        <div class="mb-6">
            <h5 class="text-md font-semibold text-gray-700 mb-3">Contact Details</h5>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                <div>
                    <label class="block text-sm text-gray-700 mb-1">Mobile</label>
                    <input id="mobile"
                        class="w-full px-3 py-2.5 rounded-lg bg-gray-100 border border-gray-200 text-gray-700 text-sm cursor-not-allowed"
                        readonly />
                </div>

                <div>
                    <label class="block text-sm text-gray-700 mb-1">Email</label>
                    <input id="email"
                        class="w-full px-3 py-2.5 rounded-lg bg-gray-100 border border-gray-200 text-gray-700 text-sm cursor-not-allowed"
                        readonly />
                </div>

                <div>
                    <label class="block text-sm text-gray-700 mb-1">City</label>
                    <input id="city"
                        class="w-full px-3 py-2.5 border border-gray-400 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 outline-none"
                        required />
                </div>

                <div>
                    <label class="block text-sm text-gray-700 mb-1">State</label>
                    <input id="state"
                        class="w-full px-3 py-2.5 border border-gray-400 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 outline-none"
                        required />
                </div>

                <div>
                    <label class="block text-sm text-gray-700 mb-1">Address</label>
                    <input id="address"
                        class="w-full px-3 py-2.5 border border-gray-400 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 outline-none"
                        required />
                </div>

                <div>
                    <label class="block text-sm text-gray-700 mb-1">Pincode</label>
                    <input id="pincode"
                        class="w-full px-3 py-2.5 border border-gray-400 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 outline-none"
                        required />
                </div>

            </div>
        </div>

        <hr class="mb-6">

        <!-- BANK -->
        <div class="mb-6">
            <h5 class="text-md font-semibold text-gray-700 mb-3">Bank Details</h5>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                <input id="bank_name" placeholder="Bank Name"
                    class="w-full px-3 py-2.5 border border-gray-400 rounded-lg text-sm" />

                <input id="branch" placeholder="Branch"
                    class="w-full px-3 py-2.5 border border-gray-400 rounded-lg text-sm" />

                <input id="account_number" placeholder="Account Number"
                    class="w-full px-3 py-2.5 border border-gray-400 rounded-lg text-sm" />

                <input id="ifsc_code" placeholder="IFSC Code"
                    class="w-full px-3 py-2.5 border border-gray-400 rounded-lg text-sm" />

            </div>
        </div>

        <!-- BUTTONS -->
        <div class="flex flex-col md:flex-row justify-center gap-3">

            <button type="button" onclick="updateLeader()"
                class="w-full md:w-[180px] bg-blue-600 hover:bg-blue-500 text-white rounded-lg px-4 py-2.5 transition shadow">
                Update
            </button>

            <button type="button"
                onclick="window.location.href='view_leader.php'"
                class="w-full md:w-[180px] bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-lg px-4 py-2.5 border">
                Back
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

    <script>

    </script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.js"></script>

    <script src="../url.js"></script>

    <script>
        const token = localStorage.getItem("auth_token");

        // Get leader ID from URL
        const params = new URLSearchParams(window.location.search);
        const id = params.get("id");

        if (!id) {
            alert("Invalid Leader ID");
            window.location.href = "view_leader.php";
        }

        // 🔹 Load Leader Data
        async function loadLeader() {
            try {
                const response = await fetch(url + `users/${id}`, {
                    headers: {
                        "Authorization": "Bearer " + token,
                        "Accept": "application/json"
                    }
                });



                const result = await response.json();

                if (!response.ok) {
                    alert(result.message);
                    return;
                }

                const user = result.data;

                document.getElementById("user_code").value = user.user_code ?? "";
                document.getElementById("name").value = user.name ?? "";
                document.getElementById("age").value = user.age ?? "";
                document.getElementById("gender").value = user.gender ?? "";
                document.getElementById("mobile").value = user.contact_no ?? "";
                document.getElementById("email").value = user.email ?? "";
                document.getElementById("city").value = user.city ?? "";
                document.getElementById("state").value = user.state ?? "";
                document.getElementById("address").value = user.address ?? "";
                document.getElementById("pincode").value = user.pin_code ?? "";
                document.getElementById("bank_name").value = user.bank_name ?? "";
                document.getElementById("branch").value = user.bank_branch ?? "";
                document.getElementById("account_number").value = user.bank_account_no ?? "";
                document.getElementById("ifsc_code").value = user.bank_ifsc_code ?? "";

                // ✅ Show current image
                if (user.profile_image) {

                    document.getElementById("current_image").src =
                        url + "storage/" + user.profile_image;

                } else {
                    document.getElementById("current_image").style.display = "none";
                }

            } catch (error) {
                console.error("Load error:", error);
            }
        }

        // 🔹 Update Leader with FULL VALIDATION
        async function updateLeader() {

            const emailInput = document.getElementById("email");
            const ageInput = document.getElementById("age");
            const mobileInput = document.getElementById("mobile");
            const pincodeInput = document.getElementById("pincode");
            const fileInput = document.getElementById("file_input");

            const email = emailInput.value.trim();
            const age = ageInput.value.trim();
            const mobile = mobileInput.value.trim();
            const pincode = pincodeInput.value.trim();
            const file = fileInput.files[0];

            // Clear previous errors
            emailInput.setCustomValidity("");
            ageInput.setCustomValidity("");
            mobileInput.setCustomValidity("");
            pincodeInput.setCustomValidity("");

            // ✅ Email validation
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailPattern.test(email)) {
                emailInput.setCustomValidity("Enter a valid email address");
                emailInput.reportValidity();
                return;
            }

            // ✅ Age validation
            if (isNaN(age) || age < 1 || age > 150) {
                ageInput.setCustomValidity("Age must be between 1 and 150");
                ageInput.reportValidity();
                return;
            }

            // ✅ Mobile validation
            if (!/^[0-9]{10}$/.test(mobile)) {
                mobileInput.setCustomValidity("Mobile number must be exactly 10 digits");
                mobileInput.reportValidity();
                return;
            }

            // ✅ Pincode validation
            if (!/^[0-9]{6}$/.test(pincode)) {
                pincodeInput.setCustomValidity("Pincode must be exactly 6 digits");
                pincodeInput.reportValidity();
                return;
            }

            // ✅ Image Validation (JPG, JPEG, PNG - Max 5MB)
            if (file) {
                const allowedTypes = ["image/jpeg", "image/png"];

                if (!allowedTypes.includes(file.type)) {
                    alert("Only JPG, JPEG and PNG files are allowed.");
                    return;
                }

                const maxSize = 5 * 1024 * 1024; // 5MB
                if (file.size > maxSize) {
                    alert("Image size must be less than 5MB.");
                    return;
                }
            }

            try {
                const formData = new FormData();

                // Laravel PATCH with file requires this
                formData.append("_method", "PATCH");

                formData.append("name", document.getElementById("name").value);
                formData.append("email", email);
                formData.append("age", age);
                formData.append("gender", document.getElementById("gender").value);
                formData.append("contact_no", mobile);
                formData.append("city", document.getElementById("city").value);
                formData.append("state", document.getElementById("state").value);
                formData.append("address", document.getElementById("address").value);
                formData.append("pin_code", pincode);
                formData.append("bank_name", document.getElementById("bank_name").value);
                formData.append("bank_branch", document.getElementById("branch").value);
                formData.append("bank_account_no", document.getElementById("account_number").value);
                formData.append("bank_ifsc_code", document.getElementById("ifsc_code").value);

                if (file) {
                    formData.append("image", file);
                }

                const response = await fetch(url + `users/${id}`, {
                    method: "POST", // Important for file + PATCH
                    headers: {
                        "Authorization": "Bearer " + token,
                        "Accept": "application/json"
                    },
                    body: formData
                });

                const result = await response.json();

                if (response.ok) {
                    alert("Leader updated successfully");

                    if (result.data?.profile_image) {
                        document.getElementById("current_image").src =
                            url + "storage/" + result.data.image + "?t=" + new Date().getTime();
                    }

                } else {
                    alert(result.message || "Update failed");
                }

            } catch (error) {
                console.error("Update error:", error);
            }
        }

        // Load data
        loadLeader();
    </script>

</body>

</html>