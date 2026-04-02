<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>

    <link rel="stylesheet" href="../style.css">
    <!-- STYLES -->
<style id="q4c3yy">
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
</style>

</head>

<body class="bg-gray-200">

<div class="mx-auto">
    <div class="flex flex-col min-h-screen">

        <?php include 'header.php'; ?>

        <div class="flex flex-1">

            <?php include 'sidebar.php'; ?>

            <!-- MAIN CONTENT -->
            <div id="mainContent" class="flex-1 w-full my-6 px-3 md:px-6">

                <div class="max-w-md mx-auto">

                    <!-- CARD -->
                    <div class="bg-white p-5 sm:p-6 rounded-2xl shadow-lg border border-gray-200">

                        <h2 class="text-xl sm:text-2xl font-bold text-center text-gray-800 mb-6">
                            🔒 Change Password
                        </h2>

                        <form id="changePasswordForm" class="space-y-5">

                            <!-- Current Password -->
                            <div>
                                <label class="label">Current Password</label>

                                <div class="relative">
                                    <input type="password" id="current_password" class="input pr-12">

                                    <button type="button"
                                        onclick="togglePassword('current_password', this)"
                                        class="absolute right-3 top-2.5 text-gray-500">
                                        👁
                                    </button>
                                </div>
                            </div>

                            <!-- New Password -->
                            <div>
                                <label class="label">New Password</label>

                                <div class="relative">
                                    <input type="password" id="new_password" class="input pr-12">

                                    <button type="button"
                                        onclick="togglePassword('new_password', this)"
                                        class="absolute right-3 top-2.5 text-gray-500">
                                        👁
                                    </button>
                                </div>
                            </div>

                            <!-- Confirm Password -->
                            <div>
                                <label class="label">Confirm Password</label>

                                <div class="relative">
                                    <input type="password" id="new_password_confirmation" class="input pr-12">

                                    <button type="button"
                                        onclick="togglePassword('new_password_confirmation', this)"
                                        class="absolute right-3 top-2.5 text-gray-500">
                                        👁
                                    </button>
                                </div>
                            </div>

                            <!-- BUTTON -->
                            <button type="submit"
                                class="w-full bg-blue-600 text-white py-3 rounded-lg font-semibold hover:bg-blue-700 transition">
                                Update Password
                            </button>

                        </form>

                        <p id="message" class="text-center mt-4 font-medium"></p>

                    </div>

                </div>

            </div>

        </div>

        <?php include 'footer.php'; ?>

    </div>
</div>


<!-- SCRIPT -->
<script>
function togglePassword(fieldId, btn) {
    const input = document.getElementById(fieldId);

    if (input.type === "password") {
        input.type = "text";
        btn.innerHTML = "🙈";
    } else {
        input.type = "password";
        btn.innerHTML = "👁";
    }
}

document.getElementById("changePasswordForm")
.addEventListener("submit", async function(e) {

    e.preventDefault();

    const token = localStorage.getItem("auth_token");

    if (!token) {
        alert("Session expired");
        window.location.href = "login";
        return;
    }

    const payload = {
        current_password: document.getElementById("current_password").value,
        new_password: document.getElementById("new_password").value,
        new_password_confirmation: document.getElementById("new_password_confirmation").value
    };

    const messageBox = document.getElementById("message");

    try {

        const response = await fetch(url + "change-password", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "Authorization": "Bearer " + token
            },
            body: JSON.stringify(payload)
        });

        const data = await response.json();

        if (response.ok) {
            messageBox.innerHTML = `<span class="text-green-600">${data.message}</span>`;
            document.getElementById("changePasswordForm").reset();
        } else {
            messageBox.innerHTML = `<span class="text-red-600">${data.message ?? 'Error'}</span>`;
        }

    } catch (error) {
        messageBox.innerHTML = `<span class="text-red-600">Server error</span>`;
    }

});
</script>

</body>
</html>