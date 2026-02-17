<?php
include "conn.php";

$id = $_GET['id'];

$stmt = $conn->prepare("SELECT * FROM project WHERE id = :id");
$stmt->execute([':id' => $id]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if (isset($_POST['submit'])) {

    $project_name     = $_POST['project_name'];
    $project_location = $_POST['project_location'];
    $project_status   = $_POST['project_status'];
    $project_details1 = $_POST['project_details1'];
    $project_details2 = $_POST['project_details2'];
    $project_details3 = $_POST['project_details3'];

    $uploadDir = "uploads/";

    // IMAGE 1
    if (!empty($_FILES['project_image1']['name'])) {
        $image1 = time() . "_1_" . $_FILES['project_image1']['name'];
        move_uploaded_file($_FILES['project_image1']['tmp_name'], $uploadDir . $image1);
    } else {
        $image1 = $row['project_image1']; // keep old
    }

    // IMAGE 2
    if (!empty($_FILES['project_image2']['name'])) {
        $image2 = time() . "_2_" . $_FILES['project_image2']['name'];
        move_uploaded_file($_FILES['project_image2']['tmp_name'], $uploadDir . $image2);
    } else {
        $image2 = $row['project_image2']; // keep old
    }

    // IMAGE 3
    if (!empty($_FILES['project_image3']['name'])) {
        $image3 = time() . "_3_" . $_FILES['project_image3']['name'];
        move_uploaded_file($_FILES['project_image3']['tmp_name'], $uploadDir . $image3);
    } else {
        $image3 = $row['project_image3']; // keep old
    }

    // UPDATE QUERY
    $update = $conn->prepare("
        UPDATE project SET 
            project_name = :name,
            project_location = :location,
            project_status = :status,
            project_image1 = :img1,
            project_image2 = :img2,
            project_image3 = :img3,
            project_details1 = :details1,
            project_details2 = :details2,
            project_details3 = :details3
        WHERE id = :id
    ");

    $update->execute([
        ':name'     => $project_name,
        ':location' => $project_location,
        ':status'   => $project_status,
        ':img1'     => $image1,
        ':img2'     => $image2,
        ':img3'     => $image3,
        ':details1' => $project_details1,
        ':details2' => $project_details2,
        ':details3' => $project_details3,
        ':id'       => $id
    ]);

    echo "<script>
            alert('Project Updated Successfully');
            window.location.href='project_record.php';
          </script>";
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
            <?php include "header.php"; ?>

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
                                                    <input name="project_name" value="<?php echo $row['project_name']; ?>"
                                                        type="text"
                                                        class="form-control"
                                                        id="studentID"
                                                        placeholder="Enter Project Name" />
                                                </div>
                                            </div>
                                            <div class="col-md-4 ">
                                                <div class="form-group">
                                                    <label for="studentname">Location</label>
                                                    <input name="project_location" value="<?php echo $row['project_location']; ?>"
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
                                                        <option value="Current" <?= $row['project_status'] == 'Current' ? 'selected' : '' ?>>Current</option>
                                                        <option value="Upcoming" <?= $row['project_status'] == 'Upcoming' ? 'selected' : '' ?>>Upcoming</option>
                                                        <option value="Complete" <?= $row['project_status'] == 'Complete' ? 'selected' : '' ?>>Complete</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mb-4 ms-3">

                                            <div class="row g-3">

                                                <!-- Image 1 -->
                                                <div class="col-md-4">
                                                    <label>Project Image 1</label>
                                                    <input type="file" name="project_image1" class="form-control">

                                                    <?php if (!empty($row['project_image1'])): ?>
                                                        <img src="uploads/<?php echo $row['project_image1']; ?>"
                                                            width="100" class="mt-2">
                                                    <?php endif; ?>
                                                </div>

                                                <!-- Image 2 -->
                                                <div class="col-md-4">
                                                    <label>Project Image 2</label>
                                                    <input type="file" name="project_image2" class="form-control">

                                                    <?php if (!empty($row['project_image2'])): ?>
                                                        <img src="uploads/<?php echo $row['project_image2']; ?>"
                                                            width="100" class="mt-2">
                                                    <?php endif; ?>
                                                </div>

                                                <!-- Image 3 -->
                                                <div class="col-md-4">
                                                    <label>Project Image 3</label>
                                                    <input type="file" name="project_image3" class="form-control">

                                                    <?php if (!empty($row['project_image3'])): ?>
                                                        <img src="uploads/<?php echo $row['project_image3']; ?>"
                                                            width="100" class="mt-2">
                                                    <?php endif; ?>
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
                                                            placeholder="Enter remark here">
                                                            <?php echo htmlspecialchars($row['project_details1']); ?>
                                                            </textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="remark">Project Details</label>
                                                        <textarea name="project_details2"
                                                            class="form-control"
                                                            id="project_details2"
                                                            placeholder="Enter remark here">
                                                            <?php echo htmlspecialchars($row['project_details2']); ?>
                                                            </textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="remark">Project Details</label>
                                                        <textarea name="project_details3"
                                                            class="form-control"
                                                            id="project_details3"
                                                            placeholder="Enter remark here">
                                                            <?php echo htmlspecialchars($row['project_details3']); ?>
                                                            </textarea>
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