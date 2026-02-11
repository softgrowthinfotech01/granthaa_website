<?php
include "conn.php";

if (isset($_POST['submit'])) {

  $name     = $_POST['project_name'];
  $location = $_POST['project_location'];
  $status   = $_POST['project_status'];
  $details1 = $_POST['project_details1'];
  $details2 = $_POST['project_details2'];

  // ---------- IMAGE UPLOAD ----------
  $imageName = $_FILES['project_image']['name'];
  $tmpName   = $_FILES['project_image']['tmp_name'];

  $uploadDir = "uploads/";
  $newName   = time() . "_" . $imageName;

  move_uploaded_file($tmpName, $uploadDir . $newName);

  // ---------- INSERT QUERY ----------
  $sql = "INSERT INTO project 
            (project_name, project_location, project_status, project_image, project_details1, project_details2)
            VALUES 
            (:name, :location, :status, :image, :details1, :details2)";

  $stmt = $conn->prepare($sql);
  $stmt->execute([
    ':name'     => $name,
    ':location' => $location,
    ':status'   => $status,
    ':image'    => $newName,
    ':details1' => $details1,
    ':details2' => $details2
  ]);

  header("Location: project_record.php");
  exit();
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
                          <label for="studentID">Project Name</label>
                          <input name="project_name"
                            type="text"
                            class="form-control"
                            id="studentID"
                            placeholder="Enter Project Name" />
                        </div>
                      </div>
                      <div class="col-md-4 ">
                        <div class="form-group">
                          <label for="studentname">Location</label>
                          <input name="project_location"
                            type="text"
                            class="form-control"
                            id="studentname"
                            placeholder="Enter Name" />
                        </div>
                      </div>
                      <div class="col-md-4 ">
                        <div class="form-group">
                          <label for="studentname">Project Status</label>
                          <select class="form-select" name="project_status" aria-label="Default select example">
                            <option selected>Select One</option>
                            <option value="Current">Current</option>
                            <option value="Upcoming">Upcoming</option>
                            <option value="Complete">Complete</option>


                          </select>
                        </div>
                      </div>
                    </div>

                    <div class="mb-4 ms-3">

                      <div class="row g-3">
                        <div class="col-md-6">
                          <div class="form-check d-flex align-items-center gap-2">

                            <label
                              for="project">Project Images (Add Max 4 Images)</label>
                            <input name="project_image"
                              type="file"
                              class="form-control form-control-sm w-auto"
                              id="project_image" />
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="remark">Project Details</label>
                              <textarea name="project_details1"
                                class="form-control"
                                id="project_details1"

                                placeholder="Enter remark here"></textarea>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="remark">Project Details</label>
                              <textarea name="project_details2"
                                class="form-control"
                                id="project_details2"

                                placeholder="Enter remark here"></textarea>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <button class="btn btn-primary" name="submit">Save</button>
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
  <!-- Custom template | don't include it in your project! -->
  <div class="custom-template">
    <div class="title">Settings</div>
    <div class="custom-content">
      <div class="switcher">
        <div class="switch-block">
          <h4>Logo Header</h4>
          <div class="btnSwitch">
            <button
              type="button"
              class="selected changeLogoHeaderColor"
              data-color="dark"></button>
            <button
              type="button"
              class="selected changeLogoHeaderColor"
              data-color="blue"></button>
            <button
              type="button"
              class="changeLogoHeaderColor"
              data-color="purple"></button>
            <button
              type="button"
              class="changeLogoHeaderColor"
              data-color="light-blue"></button>
            <button
              type="button"
              class="changeLogoHeaderColor"
              data-color="green"></button>
            <button
              type="button"
              class="changeLogoHeaderColor"
              data-color="orange"></button>
            <button
              type="button"
              class="changeLogoHeaderColor"
              data-color="red"></button>
            <button
              type="button"
              class="changeLogoHeaderColor"
              data-color="white"></button>
            <br />
            <button
              type="button"
              class="changeLogoHeaderColor"
              data-color="dark2"></button>
            <button
              type="button"
              class="changeLogoHeaderColor"
              data-color="blue2"></button>
            <button
              type="button"
              class="changeLogoHeaderColor"
              data-color="purple2"></button>
            <button
              type="button"
              class="changeLogoHeaderColor"
              data-color="light-blue2"></button>
            <button
              type="button"
              class="changeLogoHeaderColor"
              data-color="green2"></button>
            <button
              type="button"
              class="changeLogoHeaderColor"
              data-color="orange2"></button>
            <button
              type="button"
              class="changeLogoHeaderColor"
              data-color="red2"></button>
          </div>
        </div>
        <div class="switch-block">
          <h4>Navbar Header</h4>
          <div class="btnSwitch">
            <button
              type="button"
              class="changeTopBarColor"
              data-color="dark"></button>
            <button
              type="button"
              class="changeTopBarColor"
              data-color="blue"></button>
            <button
              type="button"
              class="changeTopBarColor"
              data-color="purple"></button>
            <button
              type="button"
              class="changeTopBarColor"
              data-color="light-blue"></button>
            <button
              type="button"
              class="changeTopBarColor"
              data-color="green"></button>
            <button
              type="button"
              class="changeTopBarColor"
              data-color="orange"></button>
            <button
              type="button"
              class="changeTopBarColor"
              data-color="red"></button>
            <button
              type="button"
              class="changeTopBarColor"
              data-color="white"></button>
            <br />
            <button
              type="button"
              class="changeTopBarColor"
              data-color="dark2"></button>
            <button
              type="button"
              class="selected changeTopBarColor"
              data-color="blue2"></button>
            <button
              type="button"
              class="changeTopBarColor"
              data-color="purple2"></button>
            <button
              type="button"
              class="changeTopBarColor"
              data-color="light-blue2"></button>
            <button
              type="button"
              class="changeTopBarColor"
              data-color="green2"></button>
            <button
              type="button"
              class="changeTopBarColor"
              data-color="orange2"></button>
            <button
              type="button"
              class="changeTopBarColor"
              data-color="red2"></button>
          </div>
        </div>
        <div class="switch-block">
          <h4>Sidebar</h4>
          <div class="btnSwitch">
            <button
              type="button"
              class="selected changeSideBarColor"
              data-color="white"></button>
            <button
              type="button"
              class="changeSideBarColor"
              data-color="dark"></button>
            <button
              type="button"
              class="changeSideBarColor"
              data-color="dark2"></button>
          </div>
        </div>
      </div>
    </div>

  </div>
  <!-- End Custom template -->

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