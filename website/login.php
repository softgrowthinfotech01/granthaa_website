<?php
session_start();
include "conn.php";

if (isset($_POST['submit'])) {

    $name = trim($_POST['name'] ?? '');
    $password = trim($_POST['password'] ?? '');

    // Basic validation
    if (empty($name) || empty($password)) {
        header("Location: login.php?error=empty");
        exit();
    }

    $smt = $conn->prepare("SELECT * FROM users WHERE name = :name");
    $smt->execute([":name" => $name]);

    $user = $smt->fetch(PDO::FETCH_ASSOC);

    // Case-sensitive password check
    if ($user && $password === $user['password']) {

        $_SESSION['user'] = $name;
        $_SESSION['LAST_ACTIVITY'] = time();

        header("Location: website.php");
        exit();
    } else {
        header("Location: login.php?error=invalid");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="./style.css">
    <title>Login Screen</title>
</head>

<body>

    <section class="bg-black min-h-screen flex items-center justify-center ">
        <div class="bg-gradient-to-br from-blue-100 via-sky-100 to-emerald-100 rounded-2xl shadow-lg max-w-3xl p-4">
            <div class="sm:w-full px-16">
                <div class="flex flex-col items-center gap-2 py-1">
                    <img src="../images/granthalogo.webp" alt="logo" class="w-[150px] h-[80px] mb-2">
                    <h2 class="font-bold text-2xl text-[#4527a5] text-center">Admin Login</h2>
                </div>
                <?php if (isset($_GET['error'])): ?>
                    <p class="text-red-500 text-center mb-2">
                        <?php
                        if ($_GET['error'] === 'empty') {
                            echo "All fields are required";
                        } elseif ($_GET['error'] === 'invalid') {
                            echo "Invalid username or password";
                        }
                        ?>
                    </p>
                <?php endif; ?>


                <form class="flex flex-col gap-1 py-2" method="post">
                    <label for="" class="">Username:</label>
                    <input class="p-2 mt-1 rounded-xl border" type="text" name="name" placeholder="Your username">
                    <label>Password:</label>
                    <div class="relative">
                        <input
                            id="password"
                            class="p-2 mt-1 rounded-xl border w-full pr-10"
                            type="password"
                            name="password"
                            placeholder="Your password">
                        <span
                            onclick="togglePassword()"
                            class="absolute right-3 top-1/2 -translate-y-1/2 cursor-pointer text-gray-500 text-sm select-none font-bold">
                            Show
                        </span>

                    </div>
                    <button class="Login-button bg-blue-500 rounded-xl text-white mt-2 py-2" name="submit">Login</button>
                </form>
            </div>
        </div>
    </section>

    <script>
        function togglePassword() {
            const password = document.getElementById("password");
            password.type = password.type === "password" ? "text" : "password";
        }
    </script>


</body>

</html>