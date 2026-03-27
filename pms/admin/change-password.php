<?php include 'header.php'; ?>

<div class="max-w-md mx-auto mt-12 bg-white p-8 rounded-2xl shadow-lg border">

    <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">
        Change Password
    </h2>

    <form id="changePasswordForm" class="space-y-5">

        <!-- Current Password -->
        <div>
            <label class="block text-sm font-medium text-gray-600 mb-1">
                Current Password
            </label>

            <div class="relative">
                <input type="password" id="current_password"
                    class="w-full border rounded-lg p-3 pr-12 focus:ring-2 focus:ring-blue-500 outline-none">

                <button type="button"
                    onclick="togglePassword('current_password', this)"
                    class="absolute right-3 top-3 text-gray-500">
                    👁
                </button>
            </div>
        </div>

        <!-- New Password -->
        <div>
            <label class="block text-sm font-medium text-gray-600 mb-1">
                New Password
            </label>

            <div class="relative">
                <input type="password" id="new_password"
                    class="w-full border rounded-lg p-3 pr-12 focus:ring-2 focus:ring-blue-500 outline-none">

                <button type="button"
                    onclick="togglePassword('new_password', this)"
                    class="absolute right-3 top-3 text-gray-500">
                    👁
                </button>
            </div>
        </div>

        <!-- Confirm Password -->
        <div>
            <label class="block text-sm font-medium text-gray-600 mb-1">
                Confirm Password
            </label>

            <div class="relative">
                <input type="password" id="new_password_confirmation"
                    class="w-full border rounded-lg p-3 pr-12 focus:ring-2 focus:ring-blue-500 outline-none">

                <button type="button"
                    onclick="togglePassword('new_password_confirmation', this)"
                    class="absolute right-3 top-3 text-gray-500">
                    👁
                </button>
            </div>
        </div>

        <button type="submit"
            class="w-full bg-blue-600 text-white py-3 rounded-lg font-semibold hover:bg-blue-700 transition">
            Update Password
        </button>

    </form>

    <p id="message" class="text-center mt-4 font-medium"></p>

</div>

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
        current_password:
            document.getElementById("current_password").value,
        new_password:
            document.getElementById("new_password").value,
        new_password_confirmation:
            document.getElementById("new_password_confirmation").value
    };

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
        const messageBox = document.getElementById("message");

        if (response.ok) {

            messageBox.innerHTML =
                `<span class="text-green-600">${data.message}</span>`;

            document.getElementById("changePasswordForm").reset();

        } else {

            messageBox.innerHTML =
                `<span class="text-red-600">${data.message ?? 'Error'}</span>`;
        }

    } catch (error) {

        document.getElementById("message").innerHTML =
            `<span class="text-red-600">Server error</span>`;
    }

});
</script>
<?php include 'footer.php'; ?>