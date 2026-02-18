<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form id="userForm" enctype="multipart/form-data">
    <input type="text" name="name" placeholder="Full Name" required><br><br>

    <input type="email" name="email" placeholder="Email" required><br><br>

    <input type="password" name="password" placeholder="Password" required><br><br>

    <select name="role" required>
        <option value="">Select Role</option>
        <option value="leader">Leader</option>
        <option value="adviser">Adviser</option>
        <option value="customer">Customer</option>
    </select><br><br>

    <input type="number" name="age" placeholder="Age"><br><br>

    <select name="gender">
        <option value="">Select Gender</option>
        <option value="male">Male</option>
        <option value="female">Female</option>
        <option value="other">Other</option>
    </select><br><br>

    <input type="text" name="contact_no" placeholder="Contact No"><br><br>
    <input type="text" name="city" placeholder="City"><br><br>
    <input type="text" name="state" placeholder="State"><br><br>
    <input type="text" name="address" placeholder="Address"><br><br>
    <input type="text" name="pin_code" placeholder="Pin Code"><br><br>

    <input type="text" name="bank_name" placeholder="Bank Name"><br><br>
    <input type="text" name="bank_branch" placeholder="Bank Branch"><br><br>
    <input type="text" name="bank_account_no" placeholder="Account No"><br><br>
    <input type="text" name="bank_ifsc_code" placeholder="IFSC Code"><br><br>

    <input type="file" name="image"><br><br>

    <button type="submit">Submit</button>
</form>

<script>
document.getElementById("userForm").addEventListener("submit", async function(e) {
    e.preventDefault(); // 🚀 stops page refresh

    const form = document.getElementById("userForm");
    const formData = new FormData(form);
 const token = localStorage.getItem('auth_token');
    const user = JSON.parse(localStorage.getItem('auth_user'));
    if (!token || !user) {
        alert("Please login first");
        window.location.href = "../login";
        return;
    }

    if (user.role !== "admin") {
        alert("You are not allowed to create leader");
        return;
    }
    try {
        const response = await fetch(url + "users", {
            method: "POST",
            headers: {
                "Accept": "application/json",
                "Authorization": "Bearer " + token // 👈 put token here
            },
            body: formData
        });

        const data = await response.json();

        if (response.ok) {
            alert(data.message); // ✅ success alert
            form.reset(); // clear form
        } else {
            // Show validation errors
            if (data.errors) {
                let errorMsg = "";
                for (let key in data.errors) {
                    errorMsg += data.errors[key][0] + "\n";
                }
                alert(errorMsg);
            } else {
                alert(data.message);
            }
        }

    } catch (error) {
        alert("Server error");
        console.error(error);
    }
});
</script>

</body>
</html>