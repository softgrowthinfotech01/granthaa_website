<?php include 'header.php'; ?>

<div class="max-w-6xl mx-auto px-4 py-6">

    <!-- PROFILE HEADER -->

    <div class="bg-white rounded-xl shadow p-6 flex items-center gap-6">

        <img id="profileImage"
             class="w-24 h-24 rounded-full object-cover border"
             src=""
        />

        <div>
            <h2 id="name" class="text-2xl font-bold text-gray-800"></h2>

            <p id="role"
               class="text-sm text-white bg-indigo-500 inline-block px-3 py-1 rounded mt-1">
            </p>

            <p id="email" class="text-gray-600 font-semibold mt-2"></p>
            <p id="mobile" class="text-gray-600 font-semibold"></p>
        </div>

    </div>

    <!-- SUMMARY CARDS -->
    <div id="summaryCards"
         class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-6"></div>


    <!-- PERSONAL DETAILS -->
    <div class="bg-white shadow rounded-xl p-6 mt-6">

        <h3 class="text-lg font-semibold mb-4">Personal Details</h3>

        <div class="grid md:grid-cols-2 gap-4 text-gray-700">

            <p><b>User Code:</b> <span id="user_code"></span></p>
            <p><b>Aadhaar:</b> <span id="aadhaar"></span></p>
            <p><b>Gender:</b> <span id="gender"></span></p>
            <p><b>Age:</b> <span id="age"></span></p>
            <p><b>City:</b> <span id="city"></span></p>
            <p><b>State:</b> <span id="state"></span></p>
            <p><b>Address:</b> <span id="address"></span></p>

        </div>
    </div>


    <!-- BANK DETAILS -->
    <div class="bg-white shadow rounded-xl p-6 mt-6">

        <h3 class="text-lg font-semibold mb-4">Bank Details</h3>

        <div class="grid md:grid-cols-2 gap-4 text-gray-700">

            <p><b>Bank Name:</b> <span id="bank_name"></span></p>
            <p><b>Branch:</b> <span id="bank_branch"></span></p>
            <p><b>Account No:</b> <span id="account_no"></span></p>
            <p><b>IFSC:</b> <span id="ifsc"></span></p>

        </div>
    </div>

    <!-- ACTION BUTTONS -->
<div class="bg-white rounded-xl shadow p-5 mt-6">

    <h3 class="text-lg font-semibold mb-4">Account Actions</h3>

    <div class="flex flex-wrap gap-3">

        <button onclick="editProfile()"
            class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
            ✏️ Edit Profile
        </button>

        <button onclick="changePassword()"
            class="px-4 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600">
            🔒 Change Password
        </button>

        <button onclick="uploadPhoto()"
            class="px-4 py-2 bg-sky-500 text-white rounded-lg hover:bg-sky-600">
            📷 Upload Photo
        </button>

        <button onclick="logoutUser()"
            class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">
            🚪 Logout
        </button>

        <!-- ROLE BASED ACTION -->
        <div id="roleActions"></div>

    </div>
</div>

</div>

<script>
    function safe(value){
    if(value === null || value === undefined || value === ""){
        return "-";
    }
    return value;
}

const token = localStorage.getItem("auth_token");

async function loadProfile(){



    const res = await fetch(url+"profile",{
        headers:{
            "Authorization":"Bearer "+token,
            "Accept":"application/json"
        }
    });

    const data = await res.json();

    const user = data.user;
    const summary = data.summary;

    window.currentUserId = user.id;

 // HEADER
document.getElementById('name').innerText = safe(user.name).toUpperCase();
document.getElementById('role').innerText = safe(user.role?.toUpperCase());
document.getElementById('email').innerText = safe(user.email);
document.getElementById('mobile').innerText = safe(user.contact_no);

// PROFILE IMAGE
document.getElementById('profileImage').src =
    user.profile_image
        ? base_url + "storage/" + user.profile_image
        : "https://ui-avatars.com/api/?background=4f46e5&color=fff&name=" + encodeURIComponent(user.name);
        
// DETAILS
user_code.innerText = safe(user.user_code);
aadhaar.innerText = safe(user.aadhaar_number);
gender.innerText = safe(user.gender);
age.innerText = safe(user.age);
city.innerText = safe(user.city);
state.innerText = safe(user.state);
address.innerText = safe(user.address);

// BANK DETAILS
bank_name.innerText = safe(user.bank_name);
bank_branch.innerText = safe(user.bank_branch);
account_no.innerText = safe(user.bank_account_no);
ifsc.innerText = safe(user.bank_ifsc_code);

    // SUMMARY CARDS
    let cardsHTML = "";

    Object.entries(summary || {}).forEach(([key,value])=>{
        cardsHTML += `
            <div class="bg-white shadow rounded-xl p-4 text-center">
                <p class="text-sm text-gray-500">${key.replace('_',' ')}</p>
                <h3 class="text-2xl font-bold text-indigo-600">${safe(value)}</h3>
            </div>
        `;
    });

    document.getElementById('summaryCards').innerHTML = cardsHTML;

    loadRoleActions(user.role);
}

document.addEventListener('DOMContentLoaded',loadProfile);

</script>

<script>

function editProfile(){
    window.location.href = "edit_profile?id=" + window.currentUserId;
}

function changePassword(){
    window.location.href = "change-password";
}

function uploadPhoto(){
    window.location.href = "upload-photo";
}

function logoutUser(){
    localStorage.removeItem("auth_token");
    localStorage.removeItem("auth_user");
    window.location.href = "../login";
}
function loadRoleActions(role){

    const roleBox = document.getElementById("roleActions");
    roleBox.innerHTML = "";

    if(role === "admin"){
        roleBox.innerHTML += `
            <button onclick="location.href='users'"
            class="px-4 py-2 bg-purple-600 text-white rounded-lg">
                👥 Manage Users
            </button>`;
    }


    if(role === "adviser"){
        roleBox.innerHTML += `
            <button onclick="location.href='customers'"
            class="px-4 py-2 bg-teal-600 text-white rounded-lg">
                👨‍👩‍👧 My Customers
            </button>`;
    }

    if(role === "customer"){
        roleBox.innerHTML += `
            <button onclick="location.href='bookings'"
            class="px-4 py-2 bg-blue-600 text-white rounded-lg">
                📑 My Bookings
            </button>`;
    }
}

window.addEventListener("focus", loadProfile);
</script>

<?php include 'footer.php'; ?>
