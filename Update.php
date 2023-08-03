<?php
  
  $servername = "localhost";
  $userName= "root";
  $password = "";
  $database = "dms";

  
  // Create Connection
  $con = new mysqli($servername, $userName, $password, $database);

 // Accessing Data of a session
  session_start();
  
    #User Data
    $USERNAME = $_SESSION['Username'];
    $USERID = $_SESSION['userid'];
    $TYPE = $_SESSION['type'];



  $userdata = $_SESSION['userdata'];

  $clicked_value = "" ;

  $maxres ="";

  $id = $userdata['newid'];
  $name =$userdata['name'];
  $sname = $userdata['sname'];
  $phone = $userdata['phone'];
  $address = $userdata['address'];
  $note = $userdata['note'];
  $treatmentName =$userdata['treatment'];
  $total =$userdata['total'];
  $recevid = $userdata['recived'];
  
  $errormessage ="";
  $success="";
  #$currentDate = date('Y-m-d');
 
  if(empty($USERID) OR empty($USERNAME) OR empty($TYPE)){
      
    header("location: /DMS/dist/login.php");
    exit;
  }
  else{


  // Using POST server request method 
  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $name = $_POST["name"];
    $sname = $_POST["sname"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];
    $note = $_POST["note"];
    $recevid = $_POST["recevid"];    
    $total = $_POST["total"];
    $treatmentName = $_POST["tre"];

  

    
  // Check if a value has been clicked
  if($treatmentName == 'Implant'){
    $clicked_value = 1;
  }
  if($treatmentName == 'Orthodontic'){
    $clicked_value = 2;
  }
  if($treatmentName == 'RCT'){
    $clicked_value = 3;
  }
  if($treatmentName == 'Impacted surgery'){
    $clicked_value = 4;
  }
  if($treatmentName == 'Wisdome extraction'){
    $clicked_value = 5;
  }
  if($treatmentName == 'sample extraction'){
    $clicked_value = 6;
  }
  if($treatmentName == 'sample filling'){
    $clicked_value = 7;
  }
  if($treatmentName == 'Crown'){
    $clicked_value = 8;
  }
  if($treatmentName == 'Bridg'){
    $clicked_value = 9;
  }
  if($treatmentName == 'complete denture'){
    $clicked_value = 10;
  }
  if($treatmentName == 'bleeching'){
    $clicked_value = 11;
  }
  if($treatmentName == 'oral higien'){
    $clicked_value = 12;
  }
  if($treatmentName == 'maxillofacial surgery'){
    $clicked_value = 13;
  }
  if($treatmentName == 'laminate veneer'){
    $clicked_value = 14;
  }
  if($treatmentName == 'TMJ disorder'){
    $clicked_value = 15;
  }
  if($treatmentName == 'Space maintainer'){
    $clicked_value = 16;
  }
  if($treatmentName == 'oral pathology'){
    $clicked_value = 17;
  }
  if($treatmentName == 'consultation'){
    $clicked_value = 18;
  }


      do {
        if(empty($name) || empty($phone) || empty($address) ||empty($sname)){
          $errormessage="All the field are Required";
          break;
        }

        // Update Patient Table 
        $sql = "UPDATE `tbl_patient` SET `P_Name`='$name',`P_SName`='$sname',`P_Phone`='$phone',`P_Address`='$address',`P_Note`='$note', `PT_ID`='$clicked_value'
         WHERE `P_ID`='$id';";
        $res = $con->query($sql);

        //Update paitent balance
        $newsql = "UPDATE `tbl_patient_balance` SET `PB_Total`='$total',`PB_Receive`='$recevid',`U_ID`='$USERID' WHERE `P_ID`='$id'";
        $res2 = $con->query($newsql);

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
          echo "
          <script> 
            alert(Data Update Successfuly);
          </script>
            ";
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
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal"><circle cx="12" cy="12" r="1"/><circle cx="19" cy="12" r="1"/><circle cx="5" cy="12" r="1"/></svg>
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
      <a href="Dashboard.php"><button class="app-content-headerButton">Back</button></a>
    </div>
    <section class="Registarion" style="
    background-color: #1b2536;
    border-radius: 20px;
    color:#fff;
    border: solid 1px #fff;
    box-shadow: 0px 0px 20px 0px;">
      <div class="container">
        <br><br>
      <form method="post">
        
        <div class="row">
          <div class="col-md">

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
                <h4>S/Name </h4>
              </div>
              <div class="col-md-8">
                <input type="text" name="sname" value="<?php echo $sname?>">
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
                <h4>Treatment </h4>
              </div>
            <div class="col-md-8">

              <select name ="tre">
                <?php 

                if($treatmentName == "Implant"){
                  echo "<option value ='Implant' selected> Implant</option> "; 
                }
                if($treatmentName == "Orthodontic"){
                  echo "<option value ='Orthodontic' selected> Orthodontic</option> "; 
                }
                if($treatmentName == "RCT"){
                  echo "<option value ='RCT' selected> RCT</option> "; 
                }
                if($treatmentName == "Impacted surgery"){
                  echo "<option value ='Impacted surgery' selected> Impacted surgery</option> "; 
                }
                if($treatmentName == "Wisdome extraction"){
                  echo "<option value ='Wisdome extraction' selected> Wisdome extraction</option> "; 
                }
                if($treatmentName == "sample extraction"){
                  echo "<option value ='sample extraction' selected> sample extraction</option> "; 
                }
                if($treatmentName == "sample filling"){
                  echo "<option value ='sample filling' selected> sample filling</option> "; 
                }
                if($treatmentName == "Crown"){
                  echo "<option value ='Crown' selected> Crown</option> "; 
                }
                if($treatmentName == "Bridg"){
                  echo "<option value ='Bridg' selected> Bridg</option> "; 
                }
                if($treatmentName == "complete denture"){
                  echo "<option value ='complete denture' selected> complete denture</option> "; 
                }
                if($treatmentName == "bleeching"){
                  echo "<option value ='bleeching' selected> bleeching</option> "; 
                }
                if($treatmentName == "oral higien"){
                  echo "<option value ='oral higien' selected> oral higien</option> "; 
                }
                if($treatmentName == "maxillofacial surgery"){
                  echo "<option value ='maxillofacial surgery' selected> maxillofacial surgery</option> "; 
                }
                if($treatmentName == "laminate veneer"){
                  echo "<option value ='laminate veneer' selected> laminate veneer</option> "; 
                }
                if($treatmentName == "TMJ disorder"){
                  echo "<option value ='TMJ disorder' selected> TMJ disorder</option> "; 
                }
                if($treatmentName == "Space maintainer"){
                  echo "<option value ='Space maintainer' selected> Space maintainer</option> "; 
                }
                if($treatmentName == "oral pathology"){
                  echo "<option value ='oral pathology' selected> oral pathology</option> "; 
                }
                if($treatmentName == "consultation"){
                  echo "<option value ='consultation' selected> consultation</option> "; 
                } 
                
                ?>

                <option value ="Implant"> Implant</option>
                <option value ="Orthodontic"> Orthodontic</option>
                <option value ="RCT"> RCT</option>
                <option value ="Impacted surgery"> Impacted surgery</option>
                <option value ="Wisdome extraction"> Wisdome extraction</option>
                <option value ="sample extraction"> sample extraction</option>
                <option value ="sample filling"> sample filling</option>
                <option value ="Crown"> Crown</option>
                <option value ="Bridg"> Bridg</option>
                <option value ="complete denture"> complete denture</option>
                <option value ="bleeching"> bleeching</option>
                <option value ="Crown"> Crown</option>
                <option value ="Bridg"> Bridg</option>
                <option value ="complete denture"> complete denture</option>
                <option value ="bleeching"> bleeching</option>
                <option value ="oral higien"> oral higien</option>
                <option value ="maxillofacial surgery"> maxillofacial surgery</option>
                <option value ="laminate veneer"> laminate veneer</option>
                <option value ="TMJ disorder"> TMJ disorder</option>
                <option value ="Space maintainer"> Space maintainer</option>
                <option value ="oral pathology"> oral pathology</option>
                <option value ="consultation"> consultation</option>
              </select>

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
        </div>
     
        <div class="row">
          <div class="col-md-7">
            <div class="row">
              <?php 
              if(!empty($errormessage)){
                echo"
                <h2>$errormessage </h2>
                ";
              }
              ?>
            </div>
            <div class="row">
               <?php 
              if(!empty($success)){
                echo"
                <h2> $success </h2>
              </div>
                ";
              }
              ?>
            </div>
          </div>

            <div class="row">
              <div class="col-md">
                <h4> Total:</h4>
                <input style ="margin-left:215px; margin-top: -140px;" type="text" name="total" value="<?php echo"$total"; ?>"> 
              </div>
            </div>  

            <div class="row">
              <div class="col-md">  
                <h4> Recived:</h4> 
                <input style ="margin-left:215px; margin-top: -140px;"  type="text" name="recevid" value="<?php echo"$recevid"; ?>">
              </div>
            </div>
              
          <div class="row">

          <div class="col-md-4"></div>
              <div class="col-md-3">
                <a href="index.php"><button class="app-content-headerButton" type="button" id="btn3" role="button">Cancel</button></a>
              </div>
              <div class="col-md-3">
                <button class="app-content-headerButton" type="submit" id="btn2">Submit</button>
              </div>
              <div class="col-md-2"></div>
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