<?php include 'header.php'; ?>
<div class="flex">

    <div class="w-full sm:w-[95%] md:w-[80%] lg:w-[75%] mx-auto px-3 sm:px-4 my-4 sm:my-6 rounded-lg bg-slate-100 p-3 sm:p-5 md:p-6">

        <!-- HEADER -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3 mb-5">
            <h2 class="text-xl sm:text-2xl font-bold text-gray-800">
                📷 Upload Profile Photo
            </h2>
<a href="profile"
   class="inline-flex items-center gap-1 px-5 py-2 text-md sm:text-sm bg-gray-500 text-white rounded-md hover:bg-gray-600">
   ← Back
</a>
        </div>

        <!-- CARD -->
        <div class="bg-white shadow-lg rounded-xl p-4 sm:p-6 max-w-md sm:max-w-xl mx-auto">

            <!-- IMAGE PREVIEW -->
            <div class="flex justify-center mb-5 sm:mb-6">
                <img id="previewImage"
                     class="w-24 h-24 sm:w-32 sm:h-32 rounded-full object-cover border"
                     src="">
            </div>

            <!-- FILE INPUT -->
            <input type="file" id="profile_image" accept="image/*"
                class="w-full mb-4 border border-gray-300 p-2 sm:p-3 text-sm sm:text-base rounded-lg">

            <!-- BUTTON -->
            <button onclick="uploadPhoto()"
                class="w-full bg-indigo-600 text-white py-2 sm:py-3 text-sm sm:text-base rounded-lg hover:bg-indigo-700">
                Upload Photo
            </button>

        </div>

    </div>

</div>
<?php include 'footer.php'; ?>


<script src="../url.js"></script>

<script>

const token = localStorage.getItem("auth_token");

// ================= LOAD CURRENT IMAGE =================
let currentUserId = null;

async function loadProfileImage(){

    try {
        const res = await fetch(url + "profile", {
            headers:{
                "Authorization":"Bearer " + token
            }
        });

        const data = await res.json();
        const user = data.user;

        // ✅ STORE USER ID HERE
        currentUserId = user.id;

       document.getElementById("previewImage").src =
    user.profile_image
        ? base_url + user.profile_image + "?t=" + new Date().getTime()
        : "https://ui-avatars.com/api/?background=4f46e5&color=fff&name=" + encodeURIComponent(user.name);

    } catch (err) {
        console.error(err);
    }
}
document.addEventListener("DOMContentLoaded", loadProfileImage);


// ================= IMAGE PREVIEW =================
document.getElementById("profile_image").addEventListener("change", function(e){

    const file = e.target.files[0];

    if(file){
        document.getElementById("previewImage").src = URL.createObjectURL(file);
    }

});


// ================= UPLOAD IMAGE =================
async function uploadPhoto(){

    const file = document.getElementById("profile_image").files[0];

    if(!file){
        alert("Select image ❗");
        return;
    }

    if(!currentUserId){
        alert("User not loaded ❗");
        return;
    }

    const formData = new FormData();
    formData.append("profile_image", file);

    // Laravel PATCH fix
    formData.append("_method", "PATCH");

    try {

        const res = await fetch(url + "users/" + currentUserId, {
            method: "POST",
            headers:{
                "Authorization":"Bearer " + token
            },
            body: formData
        });

        const data = await res.json();
        console.log("Response:", data);

        if(res.ok){
            alert("Profile image updated ✅");

            setTimeout(() => {
                window.location.href = "profile";
            }, 500);

        } else {
            alert(data.message || "Upload failed ❌");
        }

    } catch (err) {
        console.error("ERROR:", err);
        alert("Something went wrong ❌");
    }
}
</script>