<?php
session_start();

$timeout = 1800; // 30 minutes

// If not logged in
if (!isset($_SESSION['user'])) {
  header("Location: login.php?error=login_required");
  exit();
}

// If session expired due to inactivity
if (
  isset($_SESSION['LAST_ACTIVITY']) &&
  (time() - $_SESSION['LAST_ACTIVITY']) > $timeout
) {

  session_unset();
  session_destroy();
  header("Location: login.php?error=timeout");
  exit();
}

// Update last activity time
$_SESSION['LAST_ACTIVITY'] = time();

// Disable browser cache
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header("Expires: 0");
include "conn.php";

$stmt = $conn->prepare("SELECT * FROM project ORDER BY id ASC");
$stmt->execute();
$projects = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <title>Record</title>
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

  <style>
    .sticky-action {
      position: sticky;
      right: 0;
      background: white;
      z-index: 2;
    }
  </style>

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
      <?php include "header.php"; ?>

      <div class="container">
        <div class="page-inner">
          <div class="page-header">
            <h3 class="fw-bold mb-3">Project List</h3>

          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">

                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                      <thead class="table-dark">
                        <tr>
                          <th>Sr. No.</th>
                          <th>Project Name</th>
                          <th>Location</th>
                          <th>Status</th>
                          <th>Image 1</th>
                          <th>Image 2</th>
                          <th>Image 3</th>
                          <th>Project Details 1</th>
                          <th>Project Details 2</th>
                          <th>Project Details 3</th>
                          <th class="sticky-action border border-black">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $i = 1;
                        foreach ($projects as $row): ?>
                          <tr>

                            <td><?php echo $i++; ?></td>

                            <td><?php echo $row['project_name']; ?></td>

                            <td><?php echo $row['project_location']; ?></td>

                            <td><?php echo $row['project_status']; ?></td>


                            <!-- Image 1 -->
                            <td>
                              <?php if (!empty($row['project_image1'])): ?>
                                <img src="uploads/<?php echo $row['project_image1']; ?>" width="70">
                              <?php else: ?>
                                No Image
                              <?php endif; ?>
                            </td>

                            <!-- Image 2 -->
                            <td>
                              <?php if (!empty($row['project_image2'])): ?>
                                <img src="uploads/<?php echo $row['project_image2']; ?>" width="70">
                              <?php else: ?>
                                No Image
                              <?php endif; ?>
                            </td>

                            <!-- Image 3 -->
                            <td>
                              <?php if (!empty($row['project_image3'])): ?>
                                <img src="uploads/<?php echo $row['project_image3']; ?>" width="70">
                              <?php else: ?>
                                No Image
                              <?php endif; ?>
                            </td>

                            <td>
                              <?php
                              $text = trim($row['project_details1']); // clean start/end spaces
                              $text = str_replace(["\r", "\n"], ' ', $text); // replace line breaks

                              echo strlen($text) > 50
                                ? substr($text, 0, 50) . '...'
                                : $text;
                              ?>
                            </td>


                            <td>
                              <?php
                              $text = trim($row['project_details2']);
                              $text = str_replace(["\r", "\n"], ' ', $text);

                              echo strlen($text) > 50
                                ? substr($text, 0, 50) . '...'
                                : $text;
                              ?>
                            </td>


                            <td>
                              <?php
                              $text = trim($row['project_details3']);
                              $text = str_replace(["\r", "\n"], ' ', $text);

                              echo strlen($text) > 50
                                ? substr($text, 0, 50) . '...'
                                : $text;
                              ?>
                            </td>



                            <td class="sticky-action border border-black">
                              <div class="d-flex gap-2">
                                <a href="update_project.php?id=<?php echo $row['id']; ?>"
                                  class="btn btn-sm btn-info">
                                  Edit
                                </a>

                                <a href="delete_project.php?id=<?php echo $row['id']; ?>"
                                  class="btn btn-sm btn-danger"
                                  onclick="return confirm('Delete this project?');">
                                  Delete
                                </a>
                              </div>
                            </td>

                          </tr>
                        <?php endforeach; ?>
                      </tbody>
                    </table>


                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <?php include "footer.php"; ?>
    </div>

  </div>
  <!--   Core JS Files   -->
  <script src="assets/js/core/jquery-3.7.1.min.js"></script>
  <script src="assets/js/core/popper.min.js"></script>
  <script src="assets/js/core/bootstrap.min.js"></script>

  <!-- jQuery Scrollbar -->
  <script src="assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
  <!-- Datatables -->
  <script src="assets/js/plugin/datatables/datatables.min.js"></script>
  <!-- Kaiadmin JS -->
  <script src="assets/js/kaiadmin.min.js"></script>
  <!-- Kaiadmin DEMO methods, don't include it in your project! -->
  <script src="assets/js/setting-demo2.js"></script>
  <script>
    $(document).ready(function() {
      $("#basic-datatables").DataTable({});

      $("#multi-filter-select").DataTable({
        pageLength: 5,
        initComplete: function() {
          this.api()
            .columns()
            .every(function() {
              var column = this;
              var select = $(
                  '<select class="form-select"><option value=""></option></select>'
                )
                .appendTo($(column.footer()).empty())
                .on("change", function() {
                  var val = $.fn.dataTable.util.escapeRegex($(this).val());

                  column
                    .search(val ? "^" + val + "$" : "", true, false)
                    .draw();
                });

              column
                .data()
                .unique()
                .sort()
                .each(function(d, j) {
                  select.append(
                    '<option value="' + d + '">' + d + "</option>"
                  );
                });
            });
        },
      });

      // Add Row
      $("#add-row").DataTable({
        pageLength: 5,
      });

      var action =
        '<td> <div class="form-button-action"> <button type="button" data-bs-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task"> <i class="fa fa-edit"></i> </button> <button type="button" data-bs-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove"> <i class="fa fa-times"></i> </button> </div> </td>';

      $("#addRowButton").click(function() {
        $("#add-row")
          .dataTable()
          .fnAddData([
            $("#addName").val(),
            $("#addPosition").val(),
            $("#addOffice").val(),
            action,
          ]);
        $("#addRowModal").modal("hide");
      });
    });
  </script>
</body>

</html>