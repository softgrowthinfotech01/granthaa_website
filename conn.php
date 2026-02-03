<?php
$server = 'localhost';
$username = "root";
$password = "";
$dbname = "realestate";

	  try {
         $conn = new PDO("mysql:host=$server;dbname=$dbname", $username, $password,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
		   $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		   date_default_timezone_set("Asia/Kolkata");
        //    echo "database connected !!";
      } catch (\Throwable $th) {
           echo $th;
      }

?>