<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>User Login | Granthaa Land Developer Pvt Ltd</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="style.css">
<style>
    @keyframes fadeIn{
  from{opacity:0; transform:scale(.9);}
  to{opacity:1; transform:scale(1);}
}

.animate-fadeIn{
  animation:fadeIn .3s ease;
}
</style>
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
            <p id="error" class="text-center text-red-600 mt-2"></p>
            <!-- Divider -->
            <div class="my-6 h-px bg-yellow-400/40"></div>

            <!-- Form -->
            <form id="loginForm" class="space-y-5">

                <!-- Username -->
                <div>
                    <label class="block text-sm text-gray-200 mb-1">Username</label>
                    <input id="login" type="text"
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
                <button type="submit"
                    class="w-full mt-4 bg-yellow-400 text-black py-2.5 rounded-md
               font-semibold tracking-widest hover:bg-yellow-500 transition">
                    LOGIN
                </button>

            </form>

            <p class="text-center mt-4">
                <a href="#" onclick="openForgotModal()"
                    class="text-yellow-400 text-sm hover:underline">
                    Forgot Password?
                </a>
            </p>

            <!-- Footer -->
            <p class="text-center text-xs text-gray-400 mt-6">
                © 2026 <span class=" ">
                    Developed By <a href="https://softgrowthinfotech.com/" target="_blank">Softgrowth Infotech</a>
                </span>.
            </p>

        </div>

    </div>


    <!-- Forgot Password Modal -->
    <!-- Forgot Password Modal -->
    <div id="forgotModal"
        class="hidden fixed inset-0 z-50 flex items-center justify-center">

        <!-- Dark Background -->
        <div class="absolute inset-5 bg-gary-500"></div>

        <!-- Modal Card -->
        <div class="relative bg-gray-500 rounded-xl shadow-2xl
              border border-yellow-400/40 p-8 w-full max-w-md
              animate-fadeIn">

            <h3 class="text-yellow-400 text-xl text-center font-semibold mb-6 tracking-wide">
                Reset Password
            </h3>

            <!-- Email -->
            <input id="reset_email"
                placeholder="Enter Registered Email"
                class="w-full bg-gray-800 border border-gray-600
             text-white placeholder-gray-400
             rounded-md px-3 py-2 mb-4
             focus:outline-none focus:border-yellow-400">

            <!-- OTP -->
            <input id="reset_token"
                placeholder="Enter OTP received on Email"
                class="w-full bg-gray-800 border border-gray-600
         text-white placeholder-gray-400
         rounded-md px-3 py-2 mb-4
         focus:outline-none focus:border-yellow-400 hidden">

            <!-- Generate Token -->
            <button id="tokenBtn" onclick="sendResetToken()"
                class="w-full bg-yellow-400 text-black py-2.5 rounded-md
             font-semibold tracking-widest hover:bg-yellow-500 transition">
                Generate Token
            </button>

            <!-- Divider -->
            <div class="my-6 h-px bg-yellow-400/40"></div>

            <div id="resetSection" class="hidden">

                <input id="new_password" type="password"
                    placeholder="New Password"
                    class="w-full bg-gray-800 border border-gray-600
text-white rounded-md px-3 py-2 mb-3">

                <input id="confirm_password" type="password"
                    placeholder="Confirm Password"
                    class="w-full bg-gray-800 border border-gray-600
text-white rounded-md px-3 py-2 mb-5">

                <button onclick="resetPassword()"
                    class="w-full bg-green-500 text-black py-2.5 rounded-md
font-semibold tracking-widest hover:bg-green-600 transition">
                    Reset Password
                </button>

            </div>
            <!-- Close -->
            <button onclick="closeForgotModal()"
                class="w-full mt-4 text-center text-gray-400 hover:text-white text-sm">
                Cancel
            </button>

        </div>
    </div>
    <script src="url.js"></script>
    <script>
        function togglePassword() {
            const pass = document.getElementById("password");
            pass.type = pass.type === "password" ? "text" : "password";
        }
    </script>
    <script>
        /* ================================
   LOGIN API
================================ */

        const API_URL = url + "login";

        document.getElementById("loginForm")
            .addEventListener("submit", async function(e) {

                e.preventDefault();

                const login = document.getElementById("login").value.trim();
                const password = document.getElementById("password").value.trim();
                const errorBox = document.getElementById("error");
                const loginBtn = this.querySelector("button");

                errorBox.innerText = "";

                if (!login || !password) {
                    errorBox.innerText = "Please enter username and password";
                    return;
                }

                loginBtn.disabled = true;
                loginBtn.innerText = "Logging in...";

                try {

                    const response = await fetch(API_URL, {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "Accept": "application/json"
                        },
                        body: JSON.stringify({
                            login,
                            password
                        })
                    });

                    const data = await response.json();

                    if (!response.ok) {
                        throw data;
                    }

                    localStorage.setItem("auth_token", data.token);
                    localStorage.setItem("auth_user", JSON.stringify(data.user));

                    switch (data.user.role) {
                        case "admin":
                            window.location.href = "admin/";
                            break;
                        case "leader":
                            window.location.href = "leader/";
                            break;
                        case "adviser":
                            window.location.href = "advisor/";
                            break;
                        case "customer":
                            window.location.href = "customer/";
                            break;
                        default:
                            errorBox.innerText = "Unknown user role";
                    }

                } catch (err) {
                    errorBox.innerText = err?.message || "Login failed";
                } finally {
                    loginBtn.disabled = false;
                    loginBtn.innerText = "LOGIN";
                }

            });


        /* ================================
           MODAL CONTROL
        ================================ */

        function openForgotModal() {
            document.getElementById("forgotModal").classList.remove("hidden");
        }

        function closeForgotModal() {
            document.getElementById("forgotModal").classList.add("hidden");
        }

        // close when clicking outside
        document.getElementById("forgotModal")
            .addEventListener("click", function(e) {
                if (e.target === this) {
                    closeForgotModal();
                }
            });


        /* ================================
           TOKEN GENERATION (ONLY ONCE)
        ================================ */

        let resetToken = "";
        let tokenGenerated = false;

async function sendResetToken(){

    const email=document.getElementById("reset_email").value.trim();
    const btn=document.getElementById("tokenBtn");

    if(email===""){
        alert("Enter registered email");
        return;
    }

    const emailRegex=/^\S+@\S+\.\S+$/;

    if(!emailRegex.test(email)){
        alert("Enter valid email");
        return;
    }

    btn.disabled=true;
    btn.innerText="Sending OTP...";

    try{

        const response=await fetch(url+"forgot-password",{
            method:"POST",
            headers:{
                "Content-Type":"application/json",
                "Accept":"application/json"
            },
            body:JSON.stringify({email})
        });

        const data=await response.json();

        if(data.status){

            alert("OTP sent to your email ✅");

            document.getElementById("reset_token")
                .classList.remove("hidden");

            document.getElementById("resetSection")
                .classList.remove("hidden");

            btn.innerText="OTP Sent ✅";

        }else{
            btn.disabled=false;
            btn.innerText="Generate Token";
            alert(data.message);
        }

    }catch{
        btn.disabled=false;
        btn.innerText="Generate Token";
        alert("Server error");
    }
}


        /* ================================
           RESET PASSWORD
        ================================ */

        async function resetPassword() {

            const email = document.getElementById("reset_email").value.trim();
            const token = document.getElementById("reset_token").value.trim();
            const password = document.getElementById("new_password").value.trim();
            const confirm = document.getElementById("confirm_password").value.trim();

            if (!token) {
                alert("Enter OTP first");
                return;
            }

            if (password !== confirm) {
                alert("Passwords do not match");
                return;
            }

            try {

                const response = await fetch(url + "reset-password", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "Accept": "application/json"
                    },
                    body: JSON.stringify({
                        email,
                        token,
                        password
                    })
                });

                const data = await response.json();

                if (data.status) {

                    alert("Password Reset Successful ✅");

                    closeForgotModal();

                    // clear fields
                    document.getElementById("reset_email").value = "";
                    document.getElementById("reset_token").value = "";
                    document.getElementById("new_password").value = "";
                    document.getElementById("confirm_password").value = "";

                } else {
                    alert(data.message);
                }

            } catch {
                alert("Server error");
            }

            if (data.status) {

                alert("Password Reset Successful ✅");

                closeForgotModal();

                document.getElementById("reset_email").value = "";
                document.getElementById("reset_token").value = "";
                document.getElementById("new_password").value = "";
                document.getElementById("confirm_password").value = "";

                document.getElementById("reset_token")
                    .classList.add("hidden");

                document.getElementById("resetSection")
                    .classList.add("hidden");

                document.getElementById("tokenBtn").disabled = false;
                document.getElementById("tokenBtn").innerText = "Generate Token";
            }
        }
    </script>