<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Leader</title>
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
                <div class="w-[60%] mx-auto my-4 self-start rounded-lg bg-gray-200 p-6 border border-default rounded-base shadow-xs hover:bg-neutral-secondary-medium">
                    <form class="w-full">
                        <div class="personal-details">
                            <h5 class="text-xl font-bold text-heading p-1">Update Leader Details</h5>
                            <div class="grid grid-cols-2">
                                <div class="mb-5 col-span-1 px-1">
                                    <label for="user_code" class="block mb-2.5 text-sm font-medium text-heading">Leader Code</label>
                                    <input type="text" id="user_code" class="rounded-lg bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body" placeholder="Enter leader code" readonly />
                                </div>
                                <div class="mb-5 col-span-1 px-1">
                                    <label for="name" class="block mb-2.5 text-sm font-medium text-heading">Full Name</label>
                                    <input type="text" id="name" class="rounded-lg bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body" placeholder="Enter your name" required />
                                </div>
                            </div>
                            <div class="grid grid-cols-2">
                                <div class="mb-5 col-span-1 px-1">
                                    <label for="age" class="block mb-2.5 text-sm font-medium text-heading">Age</label>
                                     <input name="age" type="text" maxlength="2" pattern="[0-9]{2}" inputmode="numeric" id="age" class="rounded-lg bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body" placeholder="Enter your age" required />
                                </div>
                                <div class="mb-5 col-span-1 px-1">
                                    <label for="gender" class="block mb-2.5 text-sm font-medium text-heading">Gender</label>
                                    <select id="gender" class="block w-full px-3 py-2.5 rounded-lg bg-white border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand shadow-xs placeholder:text-body">
                                        <option selected>Choose a gender</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                        <option value="others">Others</option>
                                    </select>
                                </div>
                            </div>
                            <div class="">
                                <div class="mb-5 px-1">
                                    <label class="block mb-2.5 text-sm font-medium text-heading" for="file_input">Upload Image</label>
                                    <input class="rounded-lg cursor-pointer bg-white border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full shadow-xs placeholder:text-body" id="file_input" type="file">
                                </div>
                            </div>
                        </div>
                        <hr class="border-white-300 mb-3">
                        <div class="contact-details">
                            <h5 class="text-xl font-bold text-heading p-1">Update Contact Details</h5>
                            <div class="grid grid-cols-2">
                                <div class="mb-5 col-span-1 px-1">
                                    <label for="mobile" class="block mb-2.5 text-sm font-medium text-heading">Mobile Number</label>
                                   <input name="contact_no" type="tel" maxlength="10" pattern="[0-9]{10}" inputmode="numeric" id="mobile"
                                        class="rounded-lg bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body" placeholder="Enter your mobile number" required />
                                </div>
                                <div class="mb-5 col-span-1 px-1">
                                    <label for="email" class="block mb-2.5 text-sm font-medium text-heading">Email</label>
                                    <input type="email" id="email" class="rounded-lg bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body" placeholder="Enter your email" required />
                                </div>
                            </div>
                            <div class="grid grid-cols-2">
                                <div class="mb-5 col-span-1 px-1">
                                    <label for="city" class="block mb-2.5 text-sm font-medium text-heading">City</label>
                                    <input type="text" id="city" class="rounded-lg bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body" placeholder="Enter your city" required />
                                </div>
                                <div class="mb-5 col-span-1 px-1">
                                    <label for="state" class="block mb-2.5 text-sm font-medium text-heading">State</label>
                                    <input type="text" id="state" class="rounded-lg bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body" placeholder="Enter your state" required />
                                </div>
                            </div>
                            <div class="">
                                <div class="grid grid-cols-2">
                                    <div class="mb-5 col-span-1 px-1">
                                        <label for="address" class="block mb-2.5 text-sm font-medium text-heading">Address</label>
                                        <input type="textarea" id="address" class="rounded-lg bg-white border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body" placeholder="Enter your address" required />
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
                            <h5 class="text-xl font-bold text-heading p-1">Update Bank Details</h5>
                            <div class="grid grid-cols-2">
                                <div class="mb-5 col-span-1 px-1">
                                    <label for="bank_name" class="block mb-2.5 text-sm font-medium text-heading">Bank Name</label>
                                    <input type="text" id="bank_name" class="rounded-lg bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body" placeholder="Enter your bank name" required />
                                </div>
                                <div class="mb-5 col-span-1 px-1">
                                    <label for="branch" class="block mb-2.5 text-sm font-medium text-heading">Branch</label>
                                    <input type="text" id="branch" class="rounded-lg bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body" placeholder="Enter your branch name" required />
                                </div>
                               
                            </div>
                            <div class="grid grid-cols-2">
                                 <div class="mb-5 col-span-1 px-1">
                                    <label for="account_number" class="block mb-2.5 text-sm font-medium text-heading">Account Number</label>
                                    <input type="number" id="account_number" class="rounded-lg bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body" placeholder="Enter your account number" required />
                                </div>
                                <div class="mb-5 col-span-1 px-1">
                                    <label for="ifsc_code" class="block mb-2.5 text-sm font-medium text-heading">IFSC Code</label>
                                    <input type="text" id="ifsc_code" class="rounded-lg bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body" placeholder="Enter your IFSC code" required />
                                </div>
                              
                            </div>
                            
                        </div>
                        <hr class="border-white-300 mb-3">
                        <div class="flex justify-center gap-2">
                           <button type="button" onclick="updateLeader()"
class="w-[15%] text-white bg-blue-600 hover:bg-blue-400 rounded-lg text-sm px-4 py-2.5">
Update
</button>
                           <button type="button"
onclick="window.location.href='view_leader.php'"
class="w-[15%] text-gray-700 bg-white hover:bg-gray-200 rounded-lg text-sm px-5 py-2.5">
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

    } catch (error) {
        console.error("Load error:", error);
    }
}

// 🔹 Update Leader
async function updateLeader() {

    const data = {
        name: document.getElementById("name").value,
        email: document.getElementById("email").value,
        age: document.getElementById("age").value,
        gender: document.getElementById("gender").value,
        contact_no: document.getElementById("mobile").value,
        city: document.getElementById("city").value,
        state: document.getElementById("state").value,
        address: document.getElementById("address").value,
        pin_code: document.getElementById("pincode").value,
        bank_name: document.getElementById("bank_name").value,
        bank_branch: document.getElementById("branch").value,
        bank_account_no: document.getElementById("account_number").value,
        bank_ifsc_code: document.getElementById("ifsc_code").value
    };

    try {
        const response = await fetch(url + `users/${id}`, {
            method: "PATCH",
            headers: {
                "Authorization": "Bearer " + token,
                "Content-Type": "application/json",
                "Accept": "application/json"
            },
            body: JSON.stringify(data)
        });

        const result = await response.json();

        if (response.ok) {
            alert("Leader updated successfully");
            window.location.href = "view_leader.php";
        } else {
            alert(result.message || "Update failed");
        }

    } catch (error) {
        console.error("Update error:", error);
    }
}

// Load data when page loads
loadLeader();
</script>

</body>

</html>