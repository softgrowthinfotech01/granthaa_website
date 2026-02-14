<?php
session_start();

include "conn.php";

if (!isset($_SESSION['user'])) {
  header("Location: login.php?error=login_required");
  exit();
}

// Adding counter to cards
$stmt = $conn->prepare("
    SELECT 
        SUM(project_status = 'current') AS current_count,
        SUM(project_status = 'upcoming') AS upcoming_count,
        SUM(project_status = 'completed') AS completed_count
    FROM project
");
$stmt->execute();
$projectCounts = $stmt->fetch(PDO::FETCH_ASSOC);

$currentCount = $projectCounts['current_count'] ?? 0;
$upcomingCount = $projectCounts['upcoming_count'] ?? 0;
$completedCount = $projectCounts['completed_count'] ?? 0;

// Contact Records
$stmt = $conn->prepare("SELECT COUNT(*) FROM contact");
$stmt->execute();
$contactCount = $stmt->fetchColumn();

// Enquiries
$stmt = $conn->prepare("SELECT COUNT(*) FROM enquiries");
$stmt->execute();
$enquiryCount = $stmt->fetchColumn();
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

      <div class="container mt-0">


        <div>
          <?php include "header.php"; ?>

        </div>
        <div class="page-inner">

          <div
            class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
              <h3 class="fw-bold mb-3">Dashboard</h3>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-6 col-md-3">
              <div class="card card-stats card-round bg-primary">
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col-icon">
                      <div
                        class="icon-big text-center icon-white  text-white bubble-shadow-small">
                        <i class="fas fa-tasks"></i>
                      </div>
                    </div>
                    <div class="col col-stats ms-3 ms-sm-0">
                      <div class="numbers">
                        <p class="card-category text-white">Current Project</p>
                        <h4 class="fw-bold mb-0 text-white"><?= $currentCount ?></h4>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm-6 col-md-3">
              <div class="card card-stats card-round bg-warning">
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col-icon">
                      <div
                        class="icon-big text-center bg-warning text-white bubble-shadow-small">
                        <i class="fas fa-calendar-alt"></i>
                      </div>
                    </div>
                    <div class="col col-stats ms-3 ms-sm-0">
                      <div class="numbers">
                        <p class="card-category text-dark">Upcoming Project</p>
                        <h4 class="fw-bold mb-0 text-dark"><?= $upcomingCount ?></h4>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm-6 col-md-3">
              <div class="card card-stats card-round bg-success">
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col-icon">
                      <div
                        class="icon-big text-center bg-success bg-dark text-white bubble-shadow-small">
                        <i class="fas fa-check-circle"></i>
                      </div>
                    </div>
                    <div class="col col-stats ms-3 ms-sm-0">
                      <div class="numbers">
                        <p class="card-category text-white">Completed Project</p>
                        <h4 class="fw-bold mb-0 text-white"><?= $completedCount ?></h4>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm-6 col-md-3">
              <div class="card card-stats card-round bg-secondary">
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col-icon">
                      <div
                        class="icon-big text-center  bg-secondary text-white bubble-shadow-small">
                        <i class="fas fa-envelope"></i>
                      </div>
                    </div>
                    <div class="col col-stats ms-3 ms-sm-0">
                      <div class="numbers">
                        <p class="card-category text-white">Enquiries</p>
                        <h4 class="fw-bold mb-0 text-white"><?= $enquiryCount ?></h4>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm-6 col-md-3">
              <div class="card card-stats card-round bg-dark">
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col-icon">
                      <div
                        class="icon-big text-center icon-success bg-dark text-white bubble-shadow-small">
                        <i class="fas fa-address-book"></i>
                      </div>
                    </div>
                    <div class="col col-stats ms-3 ms-sm-0">
                      <div class="numbers">
                        <p class="card-category text-white">Contact Records</p>
                        <h4 class="fw-bold mb-0 text-white"><?= $contactCount ?></h4>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
  </div>

  <?php include "footer.php"; ?>
  </div>

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
              class="changeLogoHeaderColor"
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
              class="selected changeTopBarColor"
              data-color="white"></button>
            <br />
            <button
              type="button"
              class="changeTopBarColor"
              data-color="dark2"></button>
            <button
              type="button"
              class="changeTopBarColor"
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
              class="changeSideBarColor"
              data-color="white"></button>
            <button
              type="button"
              class="selected changeSideBarColor"
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
  </div>
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

  <!-- Sweet Alert -->
  <script src="assets/js/plugin/sweetalert/sweetalert.min.js"></script>

  <!-- Kaiadmin JS -->
  <script src="assets/js/kaiadmin.min.js"></script>

  <!-- Kaiadmin DEMO methods, don't include it in your project! -->
  <!-- <script src="assets/js/setting-demo.js"></script>
    <script src="assets/js/demo.js"></script> -->
  <script>
    $("#lineChart").sparkline([102, 109, 120, 99, 110, 105, 115], {
      type: "line",
      height: "70",
      width: "100%",
      lineWidth: "2",
      lineColor: "#177dff",
      fillColor: "rgba(23, 125, 255, 0.14)",
    });

    $("#lineChart2").sparkline([99, 125, 122, 105, 110, 124, 115], {
      type: "line",
      height: "70",
      width: "100%",
      lineWidth: "2",
      lineColor: "#f3545d",
      fillColor: "rgba(243, 84, 93, .14)",
    });

    $("#lineChart3").sparkline([105, 103, 123, 100, 95, 105, 115], {
      type: "line",
      height: "70",
      width: "100%",
      lineWidth: "2",
      lineColor: "#ffa534",
      fillColor: "rgba(255, 165, 52, .14)",
    });
  </script>
</body>

</html>