<?php
$servername = "localhost";
$userName= "root";
$password = "";
$database = "dms";


session_start();

  $userdata = $_SESSION['userdata'];
  $id = $userdata['newid'];



// Create Connection
$con = new mysqli($servername, $userName, $password, $database);


    $sql2 = "DELETE FROM `tbl_patient_balance` WHERE PB_ID = $id";
    $con->query($sql2);

    $sql = "DELETE FROM tbl_patient WHERE P_ID = $id";
    $con->query($sql);

    echo "<script>
            alert('User Deleted Successfully!');
          </script>";
          
          header("location: /DMS/dist/index.php");
          exit;



?>