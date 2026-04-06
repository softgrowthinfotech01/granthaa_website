<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile</title>

    <link rel="stylesheet" href="../style.css">
    
<style>
.input {
    width: 100%;
    padding: 10px 12px;
    border: 1px solid #9ca3af;
    border-radius: 8px;
    font-size: 14px;
    background: white;
    outline: none;
}

.input:focus {
    border-color: #3b82f6;
    box-shadow: 0 0 0 2px rgba(59,130,246,0.2);
}

.label {
    display: block;
    font-size: 14px;
    font-weight: 600;
    color: #374151;
    margin-bottom: 4px;
}

@media (min-width:640px){
    .input{
        padding:12px;
        font-size:15px;
    }
}

@media (max-width:640px){
    .sticky-save{
        position:sticky;
        bottom:0;
        background:white;
        padding:10px;
    }
}
</style>
</head>

<body class="bg-gray-200">

<div class="mx-auto">
    <div class="flex flex-col min-h-screen">

        <?php include "header.php"; ?>

        <div class="flex flex-1">

            <?php include "sidebar.php"; ?>

            <!-- MAIN CONTENT -->
        <div id="mainContent" class="flex-1 w-full my-6 px-3 md:px-6">

    <div class="max-w-4xl lg:max-w-5xl mx-auto">

        <!-- PAGE TITLE -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3 mb-6">
            <h2 class="text-xl sm:text-2xl font-bold text-gray-800">✏️ Edit Profile</h2>

            <a href="profile"
               class="px-4 py-2 text-sm sm:text-base bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition">
               ← Back to Profile
            </a>
        </div>

        <!-- FORM CARD -->
        <div class="bg-white shadow-lg rounded-2xl p-5 sm:p-6 border border-gray-200">

            <form id="editProfileForm"
                  class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-5">

                <!-- NAME -->
                <div>
                    <label class="label">Full Name</label>
                    <input type="text" id="name" class="input">
                </div>

                <!-- EMAIL -->
                <div>
                    <label class="label">Email</label>
                    <input type="email" id="email" readonly
                        class="input bg-gray-100 cursor-not-allowed">
                </div>

                <!-- PHONE -->
                <div>
                    <label class="label">Phone Number</label>
                    <input type="text" id="contact_no" readonly
                        class="input bg-gray-100 cursor-not-allowed">
                </div>

                <!-- AADHAAR -->
                <div>
                    <label class="label">Aadhaar</label>
                    <input type="text" id="aadhaar_number" maxlength="12" class="input">
                </div>

                <!-- GENDER -->
                <div>
                    <label class="label">Gender</label>
                    <select id="gender" class="input">
                        <option value="">Select</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="others">Others</option>
                    </select>
                </div>

                <!-- AGE -->
                <div>
                    <label class="label">Age</label>
                    <input type="number" id="age" class="input">
                </div>

                <!-- ADDRESS -->
                <div class="sm:col-span-2">
                    <label class="label">Address</label>
                    <textarea id="address" rows="3" class="input"></textarea>
                </div>

                <!-- BANK NAME -->
                <div>
                    <label class="label">Bank Name</label>
                    <input type="text" id="bank_name" class="input">
                </div>

                <!-- BRANCH -->
                <div>
                    <label class="label">Branch</label>
                    <input type="text" id="bank_branch" class="input">
                </div>

                <!-- ACCOUNT -->
                <div>
                    <label class="label">Account No</label>
                    <input type="text" id="bank_account_no" class="input">
                </div>

                <!-- IFSC -->
                <div>
                    <label class="label">IFSC Code</label>
                    <input type="text" id="bank_ifsc_code" class="input">
                </div>

                <!-- BUTTONS -->
                <div class="sm:col-span-2 flex flex-col sm:flex-row justify-end gap-3 mt-5">

                    <a href="profile"
                       class="w-full sm:w-auto text-center px-5 py-2 bg-gray-400 text-white rounded-lg hover:bg-gray-500 transition">
                       Cancel
                    </a>

                    <button type="button" onclick="updateProfile()"
                        class="w-full sm:w-auto px-6 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 shadow transition">
                        💾 Save Changes
                    </button>

                </div>

            </form>

        </div>
    </div>
</div>

        </div>

        <?php include 'footer.php'; ?>

    </div>
</div>
<script src="../url.js"></script>
<script>

const token = localStorage.getItem("auth_token");
let currentUserId = null;

// ================= LOAD PROFILE =================
async function loadEditProfile(){

    try {
        const res = await fetch(url + "profile", {
            headers:{
                "Authorization":"Bearer " + token,
                "Accept":"application/json"
            }
        });

        if(!res.ok){
            throw new Error("API failed");
        }

        const data = await res.json();
        console.log("Response:", data);

        const user = data.user || data.data;


currentUserId = user.id;

// BASIC
document.getElementById("name").value = user.name || "";
document.getElementById("email").value = user.email || "";
document.getElementById("contact_no").value = user.contact_no || "";

// PERSONAL

document.getElementById("aadhaar_number").value = user.aadhaar_number || "";
document.getElementById("gender").value = user.gender || "";
document.getElementById("age").value = user.age || "";

document.getElementById("address").value = user.address || "";

// BANK
document.getElementById("bank_name").value = user.bank_name || "";
document.getElementById("bank_branch").value = user.bank_branch || "";
document.getElementById("bank_account_no").value = user.bank_account_no || "";
document.getElementById("bank_ifsc_code").value = user.bank_ifsc_code || "";

    } catch (err) {
        console.error(err);
        alert("Failed to load profile ❌");
    }
}

document.addEventListener("DOMContentLoaded", loadEditProfile);


// ================= UPDATE PROFILE =================
async function updateProfile(){

    const btn = event.target;
    btn.innerText = "Saving...";
    btn.disabled = true;

   const bodyData = {

    // BASIC
    name: document.getElementById("name").value.trim(),
    email: document.getElementById("email").value.trim(),
    // contact_no: document.getElementById("contact_no").value.trim(),

    // PERSONAL
    aadhaar_number: document.getElementById("aadhaar_number").value.trim(),
    gender: document.getElementById("gender").value,
    age: document.getElementById("age").value,
    address: document.getElementById("address").value.trim(),

    // BANK
    bank_name: document.getElementById("bank_name").value.trim(),
    bank_branch: document.getElementById("bank_branch").value.trim(),
    bank_account_no: document.getElementById("bank_account_no").value.trim(),
    bank_ifsc_code: document.getElementById("bank_ifsc_code").value.trim()
};

    // 🔥 Validation
    if(!bodyData.name){
        alert("Name required ❗");
        btn.innerText = "💾 Save Changes";
        btn.disabled = false;
        return;
    }

    try {

        console.log("Sending:", bodyData);

        const res = await fetch(url + "users/" + currentUserId, {
            method: "PATCH",
            headers:{
                "Authorization":"Bearer " + token,
                "Content-Type":"application/json",
                "Accept":"application/json"
            },
            body: JSON.stringify(bodyData)
        });

        const data = await res.json();
        console.log("Response:", data);

        if(res.ok){

            alert(data.message); // success message
            window.location.href = "profile";

        } else {
            alert(data.message || "Update failed ❌");
        }

    } catch (err) {
        console.error(err);
        alert("Something went wrong ❌");
    }

    btn.innerText = "💾 Save Changes";
    btn.disabled = false;
}

</script>
</body>
</html>


