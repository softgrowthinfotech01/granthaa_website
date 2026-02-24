  <?php
include "website/conn.php";

$errors = [];

if (isset($_POST['send'])) {

  // Trim inputs
  $name  = trim($_POST['name'] ?? '');
  $email = trim($_POST['email'] ?? '');
  $phone = trim($_POST['number'] ?? '');
  $agree = $_POST['agree'] ?? '';
  $response = $_POST['g-recaptcha-response'] ?? '';

  /* ======================
     BASIC VALIDATIONS
  =======================*/

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

  if (!$response) {
    $errors['captcha'] = "Captcha required";
  }

  /* ======================
     CAPTCHA VERIFY
  =======================*/

  if (empty($errors)) {

    $secretKey = "6Lf45GcsAAAAAP8NfLwWSmj14LTXgSqQuuZ6-tTM";

    $verify = file_get_contents(
      "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$response"
    );

    $captcha = json_decode($verify);

    if (!$captcha->success) {
      $errors['captcha'] = "Captcha failed";
    }
  }

  /* ======================
     INSERT IF NO ERRORS
  =======================*/
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