<?php
include "website/conn.php";

$errors = [];

if (isset($_POST['send'])) {

  $name  = trim($_POST['name'] ?? '');
  $email = trim($_POST['email'] ?? '');
  $phone = trim($_POST['number'] ?? '');
  $agree = $_POST['agree'] ?? '';

  if (empty($name)) {
    $errors['name'] = "Name is required";
  }

  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = "Enter valid email";
  }

  if (!preg_match('/^[0-9]{10}$/', $phone)) {
    $errors['phone'] = "Enter valid 10 digit mobile";
  }

  if (!$agree) {
    $errors['agree'] = "You must agree before submitting";
  }

  if (empty($errors)) {

    $stmt = $conn->prepare("
      INSERT INTO enquiries(name,email,phone)
      VALUES(:name,:email,:phone)
    ");

    $stmt->execute([
      ':name' => htmlspecialchars($name),
      ':email' => htmlspecialchars($email),
      ':phone' => htmlspecialchars($phone)
    ]);

    header("Location: home.php");
    exit;
  }
}
?>