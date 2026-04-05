

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
            <input type="file" id="profile_image" accept=".jpg,.jpeg,.png,.webp"
                class="w-full mb-4 border border-gray-300 p-2 sm:p-3 text-sm sm:text-base rounded-lg">

            <!-- BUTTON -->
            <button onclick="uploadPhoto()"
                class="w-full bg-indigo-600 text-white py-2 sm:py-3 text-sm sm:text-base rounded-lg hover:bg-indigo-700">
                Upload Photo
            </button>

        </div>

    </div>
</div>

        </div>

        <?php include 'footer.php'; ?>

    </div>
</div>

<script>
    const token = localStorage.getItem("auth_token");

    // ================= LOAD CURRENT IMAGE =================
    let currentUserId = null;

   async function loadProfileImage() {

    try {
        const res = await fetch(url + "profile", {
            headers: {
                "Authorization": "Bearer " + token
            }
        });

        const data = await res.json();
        const user = data.user;

        currentUserId = user.id;

        if (user.profile_image) {
            const cleanPath = user.profile_image.replace(/\\/g, '/');
            document.getElementById("previewImage").src = base_url + "storage/" + cleanPath;
        } else {
            document.getElementById("previewImage").src =
                "https://ui-avatars.com/api/?background=4f46e5&color=fff&name=" + encodeURIComponent(user.name);
        }

    } catch (err) {
        console.error(err);
    }
}
    document.addEventListener("DOMContentLoaded", loadProfileImage);


    // ================= IMAGE PREVIEW =================
    document.getElementById("profile_image").addEventListener("change", function(e) {

        const file = e.target.files[0];

        if (file) {
            document.getElementById("previewImage").src = URL.createObjectURL(file);
        }

    });


    // ================= UPLOAD IMAGE =================
async function uploadPhoto() {

    const file = document.getElementById("profile_image").files[0];
    // ✅ Validate file type
const allowedTypes = ["image/jpeg", "image/png", "image/webp"];

if (!allowedTypes.includes(file.type)) {
    alert("Only JPG, PNG, WEBP images allowed ❗");
    return;
}

// ✅ Validate file size (2MB max)
if (file.size > 2 * 1024 * 1024) {
    alert("Image must be less than 2MB ❗");
    return;
}

    if (!file) {
        alert("Select image ❗");
        return;
    }

    if (!currentUserId) {
        alert("User not loaded ❗");
        return;
    }

    const formData = new FormData();
    formData.append("image", file);
    formData.append("_method", "PATCH");

    try {

        const res = await fetch(url + "users/" + currentUserId, {
            method: "POST",
            headers: {
                "Authorization": "Bearer " + token,
                "Accept": "application/json"
            },
            body: formData
        });

        const data = await res.json();
        console.log(data);
if (res.ok) {
    alert("Profile image updated ✅");

    // redirect to profile page
    window.location.href = "profile";
} else {
            alert(data.message || "Upload failed ❌");
        }

    } catch (err) {
        console.error(err);
        alert("Something went wrong ❌");
    }
}
</script>

</body>
</html>


