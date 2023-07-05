<?php
  session_start(); 

  $servername = "localhost";
  $userName= "root";
  $password = "";
  $database = "dms";

  // Create Connection
  $con = new mysqli($servername, $userName, $password, $database);

    
    #User Data
    $USERNAME = $_SESSION['Username'];
    $USERID = $_SESSION['userid'];
    $TYPE = $_SESSION['type'];
  
    $Name ="";
    $ExType = "";
    $Amount ="";

    if($_SERVER['REQUEST_METHOD'] == 'GET'){
        
      if(!isset($_GET["id"])){
        Echo"ID IS NULL ";
      }

        $id = $_GET["id"];
      
          // Show Expances Data 
          $sql = "SELECT * FROM `tbl_expances` WHERE `Ex_ID` = $id";
          $res = $con->query($sql);
          $row = $res->fetch_assoc();

          $Name = $row['Ex_Name'];
          $ExType = $row['Ex_Type'];
          $Amount = $row['Ex_amount'];

      }

  $errormessage ="";
  $success="";
  
  if(empty($USERID) OR empty($USERNAME) OR empty($TYPE)){
      
    header("location: /DMS/dist/login.php");
    exit;
  }
  else{
  

    // Using POST server request method 
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
      $Name = $_POST["name"];
      $ExType = $_POST["type"];
      $Amount = $_POST["amount"];


        do {
          if(empty($Name) || empty($ExType) || empty($Amount) ){
            $errormessage="All the field are Required";
            break;
          }

          $sql2 = "UPDATE `tbl_expances` SET `Ex_Name`='$Name',`Ex_Type`='$ExType',`Ex_amount`='$Amount' WHERE `EX_ID`='$id'";
          $res2 = $con->query($sql2);
 
          if(!$res2){
            $errormessage = "invalid Query: ". $con->error;
            break;
          }
            $Name ="";
            $ExType ="";
            $Amount ="";

            $success = "patient Registed";

            header("location: /DMS/dist/ExpanceReport.php");

        } while (false);

      }
    }
?>


<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>DMS</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="NewStyle.css">

  <!-- Boots strap-->
  <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>
<!-- partial:index.partial.html -->
<div class="app-container">
  <div class="sidebar">
    <div class="sidebar-header">
      <div class="app-icon">
      <svg viewBox="0 0 512 512" xmlns="imgs/logo.PNG"><path fill="currentColor" /><img src ="imgs/logo.PNG"> </svg>
      </div>
    </div>

    <!-- Left Links -->


    <?php 

if($TYPE =="Admin"){
  echo"
  <!-- Left Links -->
  <ul class='sidebar-list'>
    <li class=sidebar-list-item active id ='Dashboard' >
      <a href=Dashboard.php>
        <svg xmlns=http://www.w3.org/2000/svg width='18' height='18' viewBox='0 0 24 24' fill=none stroke=currentColor stroke-width= 2  stroke-linecap= round  stroke-linejoin= round  class= feather feather-home ><path d= 'M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z' /><polyline points= '9 22 9 12 15 12 15 22/'></svg>
        <span>Dashboard</span>
      </a>
    </li>
    <li class= sidebar-list-item >
      <a href= index.php >
        <svg xmlns= 'http'://www.w3.org/2000/svg'  width= '18'  height= '18'  viewBox= '0 0 24 24'  fill= none  stroke= currentColor  stroke-width= 2  stroke-linecap= round  stroke-linejoin= round  class= feather feather-shopping-bag ><path d= 'M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z' /><line x1= '3'  y1= '6'  x2= '21'  y2= '6' /><path d= 'M16 10a4 4 0 0 1-8 0' /></svg>
        <span>Patients </span>
      </a>
    </li>
    <li class= sidebar-list-item >
      <a href= Report.php >
        <svg xmlns= http://www.w3.org/2000/svg  width= '18'  height= '18'  viewBox= '0 0 24 24'  fill= none  stroke= currentColor  stroke-width= 2  stroke-linecap= round  stroke-linejoin= round  class= feather feather-pie-chart ><path d= 'M21.21 15.89A10 10 0 1 1 8 2.83' /><path d= 'M22 12A10 10 0 0 0 12 2v10z' /></svg>
        <span>Report</span>
      </a>
    </li>
    <li class= sidebar-list-item >
      <a href= # >
        <svg xmlns= http://www.w3.org/2000/svg  width= '18'  height= '18'  viewBox= '0 0 24 24'  fill= none  stroke= currentColor  stroke-width= 2  stroke-linecap= round  stroke-linejoin= round  class= feather feather-inbox ><polyline points= '22 12 16 12 14 15 10 15 8 12 2 12' /><path d= 'M5.45 5.11L2 12v6a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-6l-3.45-6.89A2 2 0 0 0 16.76 4H7.24a2 2 0 0 0-1.79 1.11z' /></svg>
        <span>Print Receipt</span>
      </a>
    </li>

  </ul>
  ";  
}
else{
  echo"
  <!-- Left Links -->
  <ul class='sidebar-list'>
    <li class= sidebar-list-item >
      <a href= index.php >
        <svg xmlns= http://www.w3.org/2000/svg  width= '18'  height= '18'  viewBox= '0 0 24 24'  fill= none  stroke= currentColor  stroke-width= 2  stroke-linecap= round  stroke-linejoin= round  class= feather feather-shopping-bag ><path d= M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z /><line x1= 3  y1= 6  x2= 21  y2= 6 /><path d= M16 10a4 4 0 0 1-8 0 /></svg>
        <span>Patients </span>
      </a>
    </li>
    <li class= sidebar-list-item >
      <a href= # >
        <svg xmlns= http://www.w3.org/2000/svg  width= '18'  height= '18'  viewBox= '0 0 24 24'  fill= none  stroke= currentColor  stroke-width= 2  stroke-linecap= round  stroke-linejoin= round  class= feather feather-inbox ><polyline points= 22 12 16 12 14 15 10 15 8 12 2 12 /><path d= M5.45 5.11L2 12v6a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-6l-3.45-6.89A2 2 0 0 0 16.76 4H7.24a2 2 0 0 0-1.79 1.11z /></svg>
        <span>Print Receipt</span>
      </a>
    </li>

  </ul>
  "; 
}

?>


    <!--User Profile -->
    <div class="account-info">

    <div class="account-info-name"><?php echo"Welcome  <span>". $USERNAME; ?></div>
      <button class="account-info-more">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal"><circle cx="12" cy="12" r="1"/><circle cx="19" cy="12" r="1"/><circle cx="5" cy="12" r="1"/></svg>
      </button>
    </div>


  </div>
  <div class="app-content">

    <!-- Header Product with add product-->
    <div class="app-content-header">
      <h1 class="app-content-headerText">Add Expances</h1>
      <button class="mode-switch" title="Switch Theme">
          <defs></defs>
          <path d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z"></path>
        </svg>
      </button>
      <a href="index.php"><button class="app-content-headerButton">Back</button></a>
    </div>
    <section class="Expances" style="
    background-color: #1b2536;
    border-radius: 20px;
    color:#fff;
    border: solid 1px #fff;
    box-shadow: 0px 0px 20px 0px;>
      <div class="container">
        <br> <br> 
      <form method="post" action="ExpancesUpdate.php">
        
        <div class="row">
          <div class="col-md">

          
            <div class="row">
              <div class="col-md-4">
                <h4> Types </h4>
              </div>
              
            <div class="col-md-8">
        
              <select name ="type">

              <?php 
              if($ExType =="Kitchen"){
                echo"<option value ='Kitchen' selected> Kitchen</option>";
              }
              if($ExType =="Stuffs"){
                echo"<option value ='Stuffs' selected> Stuffs</option>";
              } 
              if($ExType =="Cleaner"){
                echo"<option value ='Cleaner' selected> Cleaner</option>";
              }
              if($ExType =="Clinic"){
                echo"<option value ='Clinic' selected> Clinic</option>";
              }
              if($ExType =="Employes Salary"){
                echo"<option value ='Employes Salary' selected> Employes Salary</option>";
              }

?>
              
              <option value ="Kitchen"> Kitchen</option>
                <option value ="Stuffs"> Stuffs</option>
                <option value ="Cleaner"> Cleaner</option>
                <option value ="Employes Salary"> Employes Salary</option>
                <option value ="Clinic"> Clinic</option>
              </select>

            </div>
            </div>

            <div class="row">
              <div class="col-md-4">
                <h4> Info </h4>
              </div>
              <div class="col-md-8">
                <input type="text" name="name" value="<?php echo $Name?>">
              </div>
            </div>

            <div class="row">
              <div class="col-md-4">
                <h4>Amount </h4>
              </div>
              <div class="col-md-8">
                <input type="text" name = "amount" value="<?php echo $Amount; ?>">
              </div>
            </div>


          </div>


        </div>
     
        <div class="row">
          <div class="col-md-2"></div>
              <div class="col-md-3">
                <a href="ExpanceReport.php"><button class="app-content-headerButton" type="button" id="btn3" role="button">Back</button></a>
              </div>
              <div class="col-md-3">
                <button class="app-content-headerButton" type="submit" id="btn3" role="button">Update</button>
              </div>
              <div class="col-md-3">
                <button class="app-content-headerButton" type="button" id="btn2">Delete</button>
              </div>
            </div>


        </div>
      </div>
      </form>
    </section>


    
  </div> 
</div>
<!-- partial -->
  <script  src="./script.js"></script>

</body>
</html>
