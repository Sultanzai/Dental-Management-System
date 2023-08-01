<?php
$servername = "localhost";
$userName= "root";
$password = "";
$database = "dms";


session_start();


$id = $_SESSION['IDDELETE'];

  // $userdata = $_SESSION['userdata'];


// Create Connection
$con = new mysqli($servername, $userName, $password, $database);


    $sql = "DELETE FROM `tbl_expances`  WHERE EX_ID = $id";
    $con->query($sql);


    echo "<script>
            alert('User Deleted Successfully!');
          </script>";
          
          header("location: /DMS/dist/ExpanceReport.php");
          exit;



?>