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

    $userdata = $_SESSION['userdata'];

    $mainid=$userdata['mainid'];
    $id = $userdata['newid'];
    $name =$userdata['name'];
    $sname = $userdata['sname'];
    $phone = $userdata['phone'];
    $address = $userdata['address'];
    $note = $userdata['note'];
    $treatmentName =$userdata['treatment'];
    $total =$userdata['total'];
    $recevid = $userdata['recived'];
    $age= $userdata['age'];
    $gender = $userdata['gender'];
    

  
  $errormessage ="";
  $success="";
  
  if(empty($USERID) OR empty($USERNAME) OR empty($TYPE)){
      
    header("location: /DMS/dist/login.php");
    exit;
  }
  else{

    // Using POST server request method 
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
      $recevid = $_POST["recevid"];
      $total = $_POST["total"];
      
      $treatment = $_POST['Treatment'];
      $treatmentname = implode(", ", $treatment);
      

        do {
          if(empty($name) || empty($phone) || empty($treatmentName) ){
            $errormessage="All the field are Required";
            break;
          }

          $sql = "INSERT INTO `tbl_patient_balance`(`PB_Treatment`, `PB_Total`, `PB_Receive`, `U_ID`, `P_ID`) 
          VALUES ('$treatmentname','$total','$recevid','$USERID','$mainid');";
          $res = $con->query($sql);

          if(!$res){
            $errormessage = "invalid Query: ". $con->error;
            break;
          }
            $name ="";
            $sname ="";
            $gender ="";
            $age = "";
            $phone = "";
            $address = "";
            $note = "";
            $treatmentName ="";
            $total ="";
            $recevid = "";

            $success = "patient Registed";

            header("location: /DMS/dist/index.php");

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
<style>
  .checkboxs{
    display: flex;
    align-items: center;
    justify-content: center;
    height:80px;
    padding-top:270px;
  }
  .checkboxs input{
    align-items: center;
    justify-content: center;
    width:20px;
    height:20px;
    margin-top:2px;
  }
  </style>
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

    <!--User Profile -->
    <div class="account-info">

    <div class="account-info-name"><?php echo"Welcome  <span>". $USERNAME; ?></div>
      <button class="account-info-more">
      <a href="logout.php"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal"><circle cx="12" cy="12" r="1"/><circle cx="19" cy="12" r="1"/><circle cx="5" cy="12" r="1"/></svg> </a>
      </button>
    </div>


  </div>
  <div class="app-content">

    <!-- Header Product with add product-->
    <div class="app-content-header">
      <h1 class="app-content-headerText">Patient Registration</h1>
      <button class="mode-switch" title="Switch Theme">
          <defs></defs>
          <path d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z"></path>
        </svg>
      </button>
      <a href="index.php"><button class="app-content-headerButton">Back</button></a>
    </div>
    <section class="Registarion" style="
    background-color: #1b2536;
    border-radius: 20px;
    color:#fff;
    border: solid 1px #fff;
    box-shadow: 0px 0px 20px 0px;>
      <div class="container">
        <br>
      <form method="post">
        
        <div class="row">
          <div class="col-md-8">

            <div class="row">
              <div class="col-md-4">
                <h4>Name </h4>
              </div>
              <div class="col-md-8">
                <input type="text" name="name" value="<?php echo $name?>">
              </div>
            </div>

            <div class="row">
              <div class="col-md-4">
                <h4>F/Name </h4>
              </div>
              <div class="col-md-8">
                <input type="text" name="sname" value="<?php echo $sname?>">
              </div>
            </div>

            <div class="row">
              <div class="col-md-4">
                <h4>Gender </h4>
              </div>
              <div class="col-md-8">
                <input type="text" name = "gender" value="<?php echo $gender; ?>">
              </div>
            </div>

            <div class="row">
              <div class="col-md-4">
                <h4>Age </h4>
              </div>
              <div class="col-md-8">
                <input type="text" name ="age" value="<?php echo $age?>">
              </div>
            </div>

            <div class="row">
              <div class="col-md-4">
                <h4>Phone </h4>
              </div>
              <div class="col-md-8">
                <input type="text" name="phone" value="<?php echo $phone?>">
              </div>
            </div>

            <div class="row">
              <div class="col-md-4">
                <h4>Address </h4>
              </div>
              <div class="col-md-8">
                <input type="text" name="address" value="<?php echo $address?>">
              </div>
            </div>

            <div class="row">
              <div class="col-md-4">
                <h4>Note</h4>
              </div>
              <div class="col-md-8">
                <input type="text" name = "note" value="<?php echo $note?>">
              </div>
            </div>

          </div>
          <div class="col-md-4">
          <section class="checkboxs">
            <div id="checks">
                  <h3> Treatments</h3>
                  <input type="checkbox" name="Treatment[]" value="Implant"> Implant<br>
                  <input type="checkbox" name="Treatment[]" value="Orthodontic"> Orthodontic<br>
                  <input type="checkbox" name="Treatment[]" value="RCT"> RCT<br>
                  <input type="checkbox" name="Treatment[]" value="Impacted surgery"> Impacted surgery<br>
                  <input type="checkbox" name="Treatment[]" value="Wisdome extraction"> Wisdome extraction<br>
                  <input type="checkbox" name="Treatment[]" value="simple extraction"> simple extraction<br>
                  <input type="checkbox" name="Treatment[]" value="Simple filling"> Simple filling<br>
                  <input type="checkbox" name="Treatment[]" value="Crown"> Crown<br>
                  <input type="checkbox" name="Treatment[]" value="Bridg"> Bridg<br>
                  <input type="checkbox" name="Treatment[]" value="complete denture"> complete denture<br>
                  <input type="checkbox" name="Treatment[]" value="bleeching"> bleeching<br>
                  <input type="checkbox" name="Treatment[]" value="oral higien"> oral higien<br>
                  <input type="checkbox" name="Treatment[]" value="maxillofacial surgery"> maxillofacial surgery<br>
                  <input type="checkbox" name="Treatment[]" value="laminate veneer"> laminate veneer<br>
                  <input type="checkbox" name="Treatment[]" value="TMJ disorder"> TMJ disorder<br>
                  <input type="checkbox" name="Treatment[]" value="Space maintainer"> Space maintainer<br>
                  <input type="checkbox" name="Treatment[]" value="oral pathology"> oral pathology<br>
                  <input type="checkbox" name="Treatment[]" value="consultation"> consultation<br>
                </div>
          </section>
          </div>


        </div>
     
        <div class="row" style="margin-left: 130px;">
          <div class="col-md-6">
            <div class="row">
              <div class="col-md">
                <h5> Total:</h5><input type="text" name="total" value="0"> 
              </div>
          </div>
          <br>  
          <div class="row">
            <div class="col-md">
              <h5>Cash Recived:</h5><input type="text" name="recevid" value ="0"> 
            </div>
          </div>

            <div class="row">
              <div class="col-md-3">
                <a href="index.php"><button class="app-content-headerButton" type="button" id="btn3" role="button">Cancel</button></a>
              </div>
              <div class="col-md-3" style="margin-left:65px;">
                <button class="app-content-headerButton" type="submit" id="btn2">Submit</button>
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
