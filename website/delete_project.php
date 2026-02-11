<?php
include "conn.php";

$id = $_GET['id'];

// echo $id ;

$del = $conn->prepare("DELETE FROM project WHERE id = $id");
$del->execute();

if($del){
    echo "<script>alert('data deleted successfully !!!');window.location.href='project_record.php'</script>";
}else{
    echo "<script>alert('data delete error !!!');window.location.href='project_record.php'</script>";
}
?>