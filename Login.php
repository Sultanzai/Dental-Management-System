<?php
    session_start(); 
    $servername = "localhost";
    $userName= "root";
    $password = "";
    $database = "dms";
    // Create Connection
    $con = new mysqli($servername, $userName, $password, $database);
    
    
    $Name ="";
    $pas = "";
    $userID = "";
    $type = "";

    $error = "";
    
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
      $Name = $_POST["username"];
      $pas = $_POST["password"];
    }


        #Daily patient 
        $sql ="SELECT * FROM `tbl_user` WHERE name ='$Name' AND Password = '$pas';";
        $run = mysqli_query($con,$sql);
        
        if(!$run){
          $error = "Fail to login";
          die("Invalid Query: " . $con->error);
        }
        else{
          
        if (mysqli_num_rows($run) > 0) {
          $row = mysqli_fetch_assoc($run);
          $Name = $row["Name"];
          $pas = $row["Password"];
          $userID = $row["UserId"];
          $type = $row["Type"];
          echo "<script>
            alert('Login Successfully');
          </script>";
        }
        
      }

    #SESSION TO GFT USER RECORD
    $_SESSION["Username"] =$Name;
    $_SESSION["Password"] =$pas; 
    $_SESSION["userid"] = $userID;

        
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>DMS</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="./Logincss.css">
</head>
<body>
  <div class="content">
    <form method="post" action="#" class="form-content">
      <span class="logo"><img src="imgs/logo.PNG"> </span>
        <div class="form-item">
            <input type="text" class="text" name="username" required="">
            <label class="move" for="username">User Name</label>
        </div>
        <div class="form-item">
            <input type="password" class="text" name="password" required="">
            <label class="move" for="password">password</label>
        </div>
        <div class="button">
            <button><span style="z-index: 99;">Login</span></button>
            <div class="button-ball"></div>
        </div>
    </form>
</div>


<script src="./script.js"> </script>
</body>
</html>