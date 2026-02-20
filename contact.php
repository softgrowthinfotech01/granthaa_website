<?php
include "website/conn.php";

$errors = [];

if (isset($_POST['submit'])) {

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
      INSERT INTO contact(name,email,phone)
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

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Contact For booking</title>

  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>

<body>

<?php include "header.php"; ?>

<section class="bg-white mt-[50px] px-6 py-24">

  <div class="max-w-7xl mx-auto mb-12">
    <h1 class="text-3xl font-bold text-blue-900 border-l-4 border-green-500 pl-4">
      CONTACT US :
    </h1>
  </div>

  <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-14 items-stretch">

    <!-- LEFT FORM -->
    <div class="border-2 border-blue-900 rounded-2xl p-10 bg-white shadow-sm">

      <h2 class="text-4xl font-serif text-blue-900 mb-4">
        Book Site Visit <span class="uppercase text-green-600">Now !</span>
      </h2>

      <p class="text-gray-800 font-semibold mb-10">
        Take The First Step Towards Your Dream Home – Book Today!
      </p>

      <form method="post" class="space-y-6">

        <!-- NAME -->
        <input
          type="text"
          name="name"
          placeholder="Name"
          value="<?php echo htmlspecialchars($_POST['name'] ?? ''); ?>"
          class="w-full border-2 border-blue-200 rounded-lg px-5 py-4"
        />
        <?php if (!empty($errors['name'])): ?>
          <small style="color:red;"><?php echo $errors['name']; ?></small>
        <?php endif; ?>

        <!-- EMAIL -->
        <input
          type="email"
          name="email"
          placeholder="Email"
          value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>"
          class="w-full border-2 border-blue-200 rounded-lg px-5 py-4"
        />
        <?php if (!empty($errors['email'])): ?>
          <small style="color:red;"><?php echo $errors['email']; ?></small>
        <?php endif; ?>

        <!-- PHONE -->
        <div class="flex items-center border-2 border-blue-200 rounded-lg px-4 py-3">
          <span class="mr-3">🇮🇳</span>
          <input
            type="tel"
            name="number"
            placeholder="Phone"
            maxlength="10"
            value="<?php echo htmlspecialchars($_POST['number'] ?? ''); ?>"
            oninput="this.value=this.value.replace(/[^0-9]/g,'').slice(0,10)"
            class="bg-transparent w-full focus:outline-none"
          />
        </div>
        <?php if (!empty($errors['phone'])): ?>
          <small style="color:red;"><?php echo $errors['phone']; ?></small>
        <?php endif; ?>

        <!-- CHECKBOX -->
        <label class="flex items-start gap-3 text-sm text-gray-700">
          <input
            type="checkbox"
            name="agree"
            value="1"
            class="mt-1 accent-green-600"
            <?php if (!empty($_POST['agree'])) echo 'checked'; ?>
          />
          I agree and authorize team to contact me. This will override the register with us.
        </label>
        <?php if (!empty($errors['agree'])): ?>
          <small style="color:red;"><?php echo $errors['agree']; ?></small>
        <?php endif; ?>

        <!-- CAPTCHA -->
        <div class="g-recaptcha" data-sitekey="6Lf45GcsAAAAAIDRQ-udUFSe_D_KMi4a1vmwEfnd"></div>
        <?php if (!empty($errors['captcha'])): ?>
          <small style="color:red;"><?php echo $errors['captcha']; ?></small>
        <?php endif; ?>

        <!-- SUBMIT -->
        <div class="pt-6">
          <button name="submit"
            class="font-semibold bg-[#73bc01] text-white px-14 py-3 rounded-md">
            SUBMIT
          </button>
        </div>

      </form>
    </div>

  </div>
</section>

<?php include "footer.php"; ?>

</body>
</html>