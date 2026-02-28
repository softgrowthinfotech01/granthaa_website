<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>User Login | Granthaa Land Developer Pvt Ltd</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="stylesheet" href="style.css">

<!-- <script src="https://cdn.tailwindcss.com"></script> -->
</head>

<body class="min-h-screen flex items-center justify-center 
             bg-gradient-to-br from-gray-900 via-gray-800 to-black">

<!-- Wrapper -->
<div class="w-full max-w-md">

  <!-- Card -->
  <div class="bg-white/10 backdrop-blur-md rounded-xl shadow-2xl p-8 border border-white/20">

    <!-- Logo -->
    <div class="flex justify-center mb-3">
      <img src="images/logo.png" alt="Logo" class="h-25 w-60 rounded-lg border-2 border-yellow-400 shadow-md">
    </div>

    <!-- Heading -->
    <h2 class="text-center text-xl font-serif font-semibold tracking-widest text-yellow-400">
      SOFTWARE LOGIN
    </h2>
    <p class="text-center text-md text-gray-300 mt-1">
      Granthaa Land Developer Pvt Ltd
    </p>
<p id="error"></p>
    <!-- Divider -->
    <div class="my-6 h-px bg-yellow-400/40"></div>

    <!-- Form -->
    <form id="loginForm" class="space-y-5">

      <!-- Username -->
      <div>
        <label class="block text-sm text-gray-200 mb-1">Username</label>
        <input id="email" type="text"
          class="w-full bg-transparent border-b border-gray-400 text-white px-2 py-2
                 focus:outline-none focus:border-yellow-400">
      </div>

      <!-- Password -->
      <div class="relative">
        <label class="block text-sm text-gray-200 mb-1">Password</label>

        <input type="password" id="password"
          class="w-full bg-transparent border-b border-gray-400 text-white px-2 py-2
                 focus:outline-none focus:border-yellow-400 pr-10">

        <!-- Show password -->
        <button type="button" onclick="togglePassword()"
          class="absolute right-2 top-8 text-gray-300 hover:text-yellow-400">
          👁
        </button>
      </div>

      <!-- Login Button -->
      <button
        class="w-full mt-4 bg-yellow-400 text-black py-2.5 rounded-md
               font-semibold tracking-widest hover:bg-yellow-500 transition">
        LOGIN
      </button>

    </form>

    <!-- Footer -->
    <p class="text-center text-xs text-gray-400 mt-6">
      © 2026 <span class=" ">
      Developed By <a href="https://softgrowthinfotech.com/" target="_blank">Softgrowth Infotech</a>
    </span>.
    </p>

  </div> 

</div>

<script src="url.js"></script>
<script>
function togglePassword(){
  const pass = document.getElementById("password");
  pass.type = pass.type === "password" ? "text" : "password";
}
</script>

<!-- login API -->
<script src="url.js"></script>
<script>

  // const url ="https://granthaadeveloperpvtltd.com/pms/apis/api/";
const API_URL =url+"login";
console.log(API_URL);
document.getElementById("loginForm").addEventListener("submit", function (e) {
    e.preventDefault();

    const email = document.getElementById("email").value.trim();
    const password = document.getElementById("password").value.trim();
    const errorBox = document.getElementById("error");

    errorBox.innerText = "";

    fetch(API_URL, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "Accept": "application/json"
        },
        body: JSON.stringify({ email, password })
    })
    .then(async response => {
        const data = await response.json();

        if (!response.ok) {
            throw data;
        }

        return data;
    })
    .then(data => {
        // ✅ Save token & user
        localStorage.setItem("auth_token", data.token);
        localStorage.setItem("auth_user", JSON.stringify(data.user));

        // 🔁 Redirect based on role
        switch (data.user.role) {
            case "admin":
                window.location.href = "admin";
                break;
            case "leader":
                window.location.href = "leader";
                break;
            case "adviser":
                window.location.href = "advisor";
                break;
            case "customer":
                window.location.href = "customer";
                break;
            default:
                alert("Unknown role");
        }
    })
    .catch(err => {
        errorBox.innerText = err?.message || "Login failed";
    });
});
</script>

</body>
</html>
