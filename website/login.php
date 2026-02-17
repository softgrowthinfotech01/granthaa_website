<?php
session_start();
include "conn.php";

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $password = $_POST['password'];

    $smt = $conn->prepare("SELECT * FROM users WHERE name = :name and password = :pass");
    $smt->execute([
        ":name" => $name,
        ":pass" => $password
    ]);

    $auth = $smt->fetchAll(PDO::FETCH_ASSOC);
    $auth = count($auth);

    if ($auth) {
        $_SESSION['user'] = $name;
        echo "<script>window.location.href='website.php';</script>";
    } else {
        echo "<script>alert('Login Attempt Fail');window.location.href='login.php';</script>";
    }
}
if (isset($_GET['error']) && $_GET['error'] == 'login_required') {
    echo "<script>alert('Please login first');</script>";
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
                <form class="flex flex-col gap-1 py-2" method="post">
                    <label for="" class="">Username:</label>
                    <input class="p-2 mt-1 rounded-xl border" type="text" name="name" placeholder="Your username">
                    <label for="">Password:</label>
                    <input class="p-2 mt-1 rounded-xl border w-full" type="password" name="password" placeholder="Your password">
                    <button class="Login-button bg-blue-500 rounded-xl text-white mt-2 py-2" name="submit">Login</button>
                </form>
            </div>
        </div>
    </section>

</body>

</html>