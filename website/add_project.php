<?php
session_start();

$timeout = 1800; // 30 minutes

// If not logged in
if (!isset($_SESSION['user'])) {
  header("Location: login.php?error=login_required");
  exit();
}

// If session expired
if (
  isset($_SESSION['LAST_ACTIVITY']) &&
  (time() - $_SESSION['LAST_ACTIVITY']) > $timeout
) {
  session_unset();
  session_destroy();
  header("Location: login.php?error=timeout");
  exit();
}

$_SESSION['LAST_ACTIVITY'] = time();

// Disable browser cache
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");
header("Expires: 0");

include "conn.php";

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  // ----------- GET FORM DATA -----------
  $name     = trim($_POST['project_name'] ?? '');
  $location = trim($_POST['project_location'] ?? '');
  $status   = $_POST['project_status'] ?? '';
  $details1 = $_POST['project_details1'] ?? '';
  $details2 = $_POST['project_details2'] ?? '';
  $details3 = $_POST['project_details3'] ?? '';

  // ----------- BASIC VALIDATION -----------

  if (empty($name)) {
    $errors['project_name'] = "Project name is required.";
  }

  if (empty($location)) {
    $errors['project_location'] = "Project location is required.";
  }

  if (empty($status) || $status === "Select One") {
    $errors['project_status'] = "Please select project status.";
  }

  // ----------- IMAGE SETTINGS -----------
  $uploadDir    = "uploads/";
  $maxSize      = 2 * 1024 * 1024; // 2MB
  $allowedTypes = ['image/jpeg', 'image/png', 'image/webp'];

  // ----------- IMAGE VALIDATION FUNCTION -----------
  function validateImage($inputName, $allowedTypes, $maxSize, &$errors)
  {
    if (isset($_FILES[$inputName]) && $_FILES[$inputName]['error'] === 0) {

      $tmpName = $_FILES[$inputName]['tmp_name'];
      $fileSize = $_FILES[$inputName]['size'];

      if (!file_exists($tmpName)) {
        $errors[$inputName] = "File upload failed.";
        return false;
      }

      $fileType = mime_content_type($tmpName);

      if (!in_array($fileType, $allowedTypes)) {
        $errors[$inputName] = "Only JPG, PNG, WEBP images allowed.";
        return false;
      }

      if ($fileSize > $maxSize) {
        $errors[$inputName] = "Image must be less than 2MB.";
        return false;
      }

      return true;
    }

    return false;
  }

  // ----------- VALIDATE IMAGES -----------
  $validImg1 = validateImage('project_image1', $allowedTypes, $maxSize, $errors);
  $validImg2 = validateImage('project_image2', $allowedTypes, $maxSize, $errors);
  $validImg3 = validateImage('project_image3', $allowedTypes, $maxSize, $errors);

  // ----------- IF NO ERRORS -----------
  if (empty($errors)) {

    // Upload images
    function uploadImage($inputName, $prefix, $uploadDir)
    {
      if (isset($_FILES[$inputName]) && $_FILES[$inputName]['error'] === 0) {

        $newName = time() . "_" . $prefix . "_" . basename($_FILES[$inputName]['name']);
        move_uploaded_file($_FILES[$inputName]['tmp_name'], $uploadDir . $newName);
        return $newName;
      }
      return "";
    }

    $image1 = uploadImage('project_image1', '1', $uploadDir);
    $image2 = uploadImage('project_image2', '2', $uploadDir);
    $image3 = uploadImage('project_image3', '3', $uploadDir);

    // ----------- INSERT INTO DATABASE -----------
    $sql = "INSERT INTO project 
                (project_name, project_location, project_status, 
                 project_image1, project_image2, project_image3, 
                 project_details1, project_details2, project_details3)
                VALUES 
                (:name, :location, :status, 
                 :img1, :img2, :img3, 
                 :details1, :details2, :details3)";

    $stmt = $conn->prepare($sql);
    $stmt->execute([
      ':name'     => $name,
      ':location' => $location,
      ':status'   => $status,
      ':img1'     => $image1,
      ':img2'     => $image2,
      ':img3'     => $image3,
      ':details1' => $details1,
      ':details2' => $details2,
      ':details3' => $details3
    ]);

    header("Location: project_record.php");
    exit();
  }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <title> Admin Dashboard</title>
  <meta
    content="width=device-width, initial-scale=1.0, shrink-to-fit=no"
    name="viewport" />

  <!-- Fonts and icons -->
  <script src="assets/js/plugin/webfont/webfont.min.js"></script>
  <script>
    WebFont.load({
      google: {
        families: ["Public Sans:300,400,500,600,700"]
      },
      custom: {
        families: [
          "Font Awesome 5 Solid",
          "Font Awesome 5 Regular",
          "Font Awesome 5 Brands",
          "simple-line-icons",
        ],
        urls: ["assets/css/fonts.min.css"],
      },
      active: function() {
        sessionStorage.fonts = true;
      },
    });
  </script>

  <!-- CSS Files -->
  <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
  <link rel="stylesheet" href="assets/css/plugins.min.css" />
  <link rel="stylesheet" href="assets/css/kaiadmin.min.css" />

  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link rel="stylesheet" href="assets/css/demo.css" />
</head>

<body>
  <div class="wrapper">
    <!-- Sidebar -->
    <?php require "side-menu.php"; ?>
    <!-- End Sidebar -->

    <div class="main-panel">
      <?php include "header.php" ?>

      <div class="container">
        <div class="page-inner">

          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <div class="card-title">Add Project</div>
                </div>
                <div class="card-body">
                  <form method="post" enctype="multipart/form-data">
                    <div class="row mb-2">
                      <div class="col-md-4 ">
                        <div class="form-group">
                          <label for="studentID">Project Name <span class="sticky-top text-danger fw-bold">*</span></label>
                          <input name="project_name"
                            type="text"
                            class="form-control"
                            id="studentID"
                            placeholder="Enter Project Name" required />
                          <?php if (!empty($errors['project_name'])): ?>
                            <small style="color:red;">
                              <?php echo $errors['project_name']; ?>
                            </small>
                          <?php endif; ?>
                        </div>
                      </div>
                      <div class="col-md-4 ">
                        <div class="form-group">
                          <label for="studentname">Location<span class="sticky-top text-danger fw-bold">*</span></label>
                          <input name="project_location"
                            type="text"
                            class="form-control"
                            id="studentname"
                            placeholder="Enter location" />
                          <!-- Error Message -->
                          <?php if (!empty($errors['project_location'])): ?>
                            <small style="color:red;">
                              <?php echo $errors['project_location']; ?>
                            </small>
                          <?php endif; ?>
                        </div>
                      </div>
                      <div class="col-md-4 ">
                        <div class="form-group">
                          <label for="studentname">Project Status<span class="sticky-top text-danger fw-bold">*</span></label>
                          <select class="form-select" name="project_status" aria-label="Default select example">
                            <option selected>Select One</option>
                            <option value="Current">Current</option>
                            <option value="Upcoming">Upcoming</option>
                            <option value="Complete">Completed</option>
                          </select>
                          <!-- Error Message -->
                          <?php if (!empty($errors['project_status'])): ?>
                            <small style="color:red;">
                              <?php echo $errors['project_status']; ?>
                            </small>
                          <?php endif; ?>
                        </div>
                      </div>
                    </div>

                    <div class="mb-4 ms-3">

                      <div class="row g-3">

                        <div class="col-md-4">
                          <label>Project Image 1</label>
                          <span class="mb-2 text-danger text-center mx-1">
                            (Max. image size should be 2mb.)
                          </span>

                          <input type="file"
                            name="project_image1"
                            class="form-control">
                          <?php if (!empty($errors['project_image1'])): ?>
                            <small class="text-danger">
                              <?php echo $errors['project_image1']; ?>
                            </small>
                          <?php endif; ?>
                        </div>


                        <div class="col-md-4">
                          <label>Project Image 1</label>
                          <span class="mb-2 text-danger text-center mx-1">
                            (Max. image size should be 2mb.)
                          </span>


                          <input type="file"
                            name="project_image2"
                            class="form-control">
                        </div>
                        <?php if (!empty($errors['project_image2'])): ?>
                          <small class="text-danger">
                            <?php echo $errors['project_image2']; ?>
                          </small>
                        <?php endif; ?>

                        <div class="col-md-4">
                          <label>Project Image 1</label>
                          <span class="mb-2 text-danger text-center mx-1">
                            (Max. image size should be 2mb.)
                          </span>

                          <input type="file"
                            name="project_image3"
                            class="form-control">
                          <?php if (!empty($errors['project_image3'])): ?>
                            <small class="text-danger">
                              <?php echo $errors['project_image3']; ?>
                            </small>
                          <?php endif; ?>
                        </div>

                      </div>

                      <div class="row">
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="remark">Project Details 1</label>
                              <textarea name="project_details1"
                                class="form-control"
                                id="project_details1"
                                maxlength="1000"

                                placeholder="Enter project details"></textarea>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="remark">Project Details 2</label>
                              <textarea name="project_details2"
                                class="form-control"
                                id="project_details2"
                                maxlength="1000"

                                placeholder="Enter project details"></textarea>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="remark">Project Details 3</label>
                              <textarea name="project_details3"
                                class="form-control"
                                id="project_details3"
                                maxlength="1000"

                                placeholder="Enter project details"></textarea>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <button class="btn btn-primary" type="submit" name="submit">Save</button>
                        </div>
                      </div>
                    </div>
                  </form>

                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
  <?php include "footer.php"; ?>


  <!--   Core JS Files   -->
  <script src="assets/js/core/jquery-3.7.1.min.js"></script>
  <script src="assets/js/core/popper.min.js"></script>
  <script src="assets/js/core/bootstrap.min.js"></script>

  <!-- jQuery Scrollbar -->
  <script src="assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>

  <!-- Chart JS -->
  <script src="assets/js/plugin/chart.js/chart.min.js"></script>

  <!-- jQuery Sparkline -->
  <script src="assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>

  <!-- Chart Circle -->
  <script src="assets/js/plugin/chart-circle/circles.min.js"></script>

  <!-- Datatables -->
  <script src="assets/js/plugin/datatables/datatables.min.js"></script>

  <!-- Bootstrap Notify -->
  <script src="assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>

  <!-- jQuery Vector Maps -->
  <script src="assets/js/plugin/jsvectormap/jsvectormap.min.js"></script>
  <script src="assets/js/plugin/jsvectormap/world.js"></script>

  <!-- Google Maps Plugin -->
  <script src="assets/js/plugin/gmaps/gmaps.js"></script>

  <!-- Sweet Alert -->
  <script src="assets/js/plugin/sweetalert/sweetalert.min.js"></script>

  <!-- Kaiadmin JS -->
  <script src="assets/js/kaiadmin.min.js"></script>

  <!-- Kaiadmin DEMO methods, don't include it in your project! -->
  <script src="assets/js/setting-demo2.js"></script>


</body>

</html>