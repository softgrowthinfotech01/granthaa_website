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

  <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-14 items-stretch">

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
    <div class="border-2 border-blue-900 rounded-2xl p-10  relative transition-transform duration-500 ease-in-out
                hover:scale-105 shadow-sm">
        <h2 class="text-4xl font-serif text-blue-900 mb-4">
          Unlock Your Dream Home!
        </h2>

        <p class="text-gray-800 font-semibold mb-12">
          Unlock a world of comfort and luxury in your dream home.
        </p>

        <div class="space-y-10">

          <div class="flex gap-5 items-start">
            <div class="w-12 h-12 rounded-full bg-[#73bc01] flex items-center justify-center text-white">
              ✉
            </div>
            <div>
              <h4 class="text-xl font-serif text-blue-900">Send An Email</h4>
              <p class="text-blue-700">email id : info@granthaadeveloperpvtltd.com</p>
            </div>
          </div>

          <div class="flex gap-5 items-start">
            <div class="w-12 h-12 rounded-full bg-[#73bc01] flex items-center justify-center text-white">
              ☎
            </div>
            <div>
              <h4 class="text-xl font-serif text-blue-900">Give Us A Call</h4>
              <p class="text-blue-700">+91 9975086229 , +91 8975280850</p>
            </div>
          </div>

          <div class="flex gap-5 items-start">
            <div class="w-12 h-12 rounded-full bg-[#73bc01] flex items-center justify-center text-white">
              📍
            </div>
            <div>
              <h4 class="text-xl font-serif text-blue-900">Site Address</h4>
              <p class="text-blue-700 max-w-sm">
                Near ram setu bridge, devki complex, Chandrapur.
              </p>
            </div>
          </div>

        </div>
      </div>

    <!-- RIGHT CONTENT -->
      

    </div>

  </div>
  
</section>
<a href="https://wa.me/919999999999"
    target="_blank"
    class="fixed bottom-6 right-6 z-50 bg-green-500 p-4 rounded-full shadow-lg
          hover:scale-110 hover:shadow-2xl
          transition-all duration-300
          animate-bounce-slow">

    <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 fill-white drop-shadow-lg" viewBox="0 0 32 32">
      <path d="M19.11 17.2c-.28-.14-1.65-.81-1.91-.9-.26-.09-.45-.14-.64.14-.19.28-.73.9-.9 1.08-.17.19-.34.21-.62.07-.28-.14-1.19-.44-2.27-1.4-.84-.75-1.4-1.67-1.57-1.95-.17-.28-.02-.43.13-.57.13-.13.28-.34.42-.51.14-.17.19-.28.28-.47.09-.19.05-.35-.02-.49-.07-.14-.64-1.54-.88-2.11-.23-.56-.46-.49-.64-.5-.17-.01-.35-.01-.54-.01-.19 0-.49.07-.75.35-.26.28-.98.96-.98 2.35s1.01 2.73 1.15 2.92c.14.19 1.99 3.04 4.82 4.26.67.29 1.2.46 1.61.59.68.22 1.29.19 1.78.11.54-.08 1.65-.67 1.88-1.32.23-.65.23-1.2.16-1.32-.07-.12-.26-.19-.54-.33z" />
      <path d="M16 2.67C8.64 2.67 2.67 8.64 2.67 16c0 2.61.77 5.05 2.1 7.1L2.67 29.33l6.39-2.07c1.98 1.08 4.25 1.74 6.94 1.74 7.36 0 13.33-5.97 13.33-13.33S23.36 2.67 16 2.67zm0 24.22c-2.34 0-4.5-.64-6.36-1.75l-.45-.27-3.78 1.22 1.24-3.68-.29-.47c-1.23-1.95-1.88-4.2-1.88-6.55 0-6.68 5.44-12.11 12.11-12.11s12.11 5.44 12.11 12.11-5.44 12.11-12.11 12.11z" />
    </svg>
  </a>

<?php include "footer.php"; ?>

</body>
</html>