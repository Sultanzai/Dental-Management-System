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


  $id ="";
  $name ="";
  $sname ="";
  $note = "";
  $treatment ="";
  $recevid = "";
  $total ="";
  $remming = "";

  $payment = "";
  $totalpay = "";
  
  $errormessage ="";
  $success="";

  if(empty($USERID) OR empty($USERNAME) OR empty($TYPE)){
      
    header("location: /DMS/dist/login.php");
    exit;
  }
  else{
    if($_SERVER['REQUEST_METHOD'] == 'GET'){
        
      if(!isset($_GET["id"])){
        Echo"ID IS NULL ";
      }

        $id = $_GET["id"];

            // SQL query to get Patient By ID 
            $sql = "SELECT * FROM `view_patient` WHERE `P_ID` = $id";
            $res = $con->query($sql);
            $row = $res->fetch_assoc();

            $name = $row['P_Name'];
            $sname = $row['P_SName'];
            $note = $row['P_Note'];
            $treatment = $row['PT_Name'];
            $recevid = $row['PB_Receive'];
            $total = $row['PB_Total'];
            // Remming of the total treatment 
            $remming = $row['PB_Total'] - $row['PB_Receive'];


        // SESSIONS Data and initilizaions 
        $userdata = array(
          "newid"=> $id, 
          "name"=> $row['P_Name'], 
          "sname"=> $row['P_SName'], 
          "phone"=> $row['P_Phone'],
          "address"=> $row['P_Address'],
          "treatment"=> $row['PT_Name'], 
          "note"=> $row['P_Note'], 
          "total"=> $row['PB_Total'], 
          "recived"=> $row['PB_Receive']
        );

      $_SESSION["userdata"] = $userdata;



        if(!$res){
          die("Invalid Query: " . $con->error);
        }
        else{
          $success = "Query pass successfuly ";
        }
            
        }
    else{
          do{
            
            $id = $_POST["id"];
            $recevid = $_POST["recevid"];
            $payment = $_POST["payment"];
            $total = $_POST["total"];
            
            $remming = intval($total) - intval($recevid);

            if(empty($payment)){
            $errormessage= "Payment field is empty";
            break;
            }

            //String conversion and sum of the recive payment 
            $totalpay = intval($payment) + intval($recevid);

            if( $totalpay > $total || 0 > $totalpay ){
              echo "<script>
              alert('Invalid Input please enter the valid amount!');
            </script>";
              break;
            }
            else{
            $newsql = "UPDATE tbl_patient_balance SET PB_Receive = $totalpay WHERE P_ID = $id";
             $newres = $con->query($newsql);
            }       
                
            if(!$newres){
              $errormessage = "invalid Query: ". $con->error;
              echo "Invalid Update Questy inolve";
              break;
            }
            else{
              header("location: /DMS/dist/index.php");
              exit;
            }

          }
           while(false);
            
        }
  }




?>

<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>DMS</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
  <link rel="stylesheet" type="text/css" href="style.css">
  <link rel="stylesheet" type="text/css" href="NewStyle.css">

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
      <h1 class="app-content-headerText">Patient Invoice</h1>
      <button class="mode-switch" title="Switch Theme">
          <defs></defs>
          <path d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z"></path>
        </svg>
      </button>
      <a href="Dashboard.php"><button class="app-content-headerButton">Back</button></a>
    </div>
    <section class="invoice" style=" margin-left: 30vh;
    max-width: 50%;
    min-height: 80vh;
    background-color: #1b2536;
    border-radius: 20px;
    color:#fff;
    border: solid 1px #fff;
    box-shadow: 0px 0px 20px 0px;">
    
      <div class="container">
        <br><br>
            <div class="row">
              <div class="col-md">
              <?php 
                echo "<h2> Name: ".$name."</h2>";
              ?>          
              </div>
            </div>
            
            <div class="row">
              <div class="col-md">
              <?php 
                echo "<h2> S/Name: ".$sname."</h2>";
              ?>          
              </div>
            </div>
            
            <div class="row">
              <div class="col-md">
              <?php 
                echo "<h2> Treatment: ".$treatment."</h2>";
              ?>          
              </div>
            </div>
            
            <div class="row">
              <div class="col-md">
              <?php 
                echo "<h2> Note: ".$note."</h2>";
              ?>
              </div>
            </div>

            <div class="row">
              <div class="col-md">
              <?php 
                echo "<h2> Total: ".$total."</h2>";
              ?>
              </div>
            </div>

            <div class="row">
              <div class="col-md">
              <?php 
                echo "<h2> Recived: ".$recevid."</h2>";
              ?>
              </div>
            </div>
            <div class="row">
              <div class="col-md">
              <?php 
                echo "<h2> Remming: ".$remming."</h2>";
              ?>
              </div>
            </div>
        <form method="POST">

            <div class="row">
              <div class="col-md-3">
                <h2> Pay: </h2>
              </div>
              <div class="col-md-9">
              <input type="hidden" name="id" value="<?php echo $id; ?>"> 
              <input type="hidden" name="total" value="<?php echo $total; ?>"> 
              <input type="hidden" name="recevid" value="<?php echo $recevid; ?>"> 


                <input type="text" name="payment" value="<?php echo $payment; ?>"> 
              </div>
            </div>
            <br> 
            <div class="row">
            <div class="col-md-3"></div>

              <div class="col-md">
              <a href="index.php">
                <button class="app-content-headerButton" type="button" id="btn5" role="button">Cancel</button>
              </a>
              </div>
              <div class="col-md">
                <a href="index.php">
                  <button class="app-content-headerButton" type="submit" id="btn4" role="button">Submit</button>
                </a>
              </div>
              <div class="col-md">
              <a href ="update.php">
                <button class="app-content-headerButton" type="button" id="btn5" role="button">Update</button>
              </a>
            </div>
            <div class="col-md">
            
              </div>

            </div>        
            <br>
            <div class="row">
              <div class="col-md-4"></div>
              <div class="col-md-2">
                &nbsp;&nbsp;  
                <a href="printInv.php">
                  <button class="app-content-headerButton" type="button" id="btn5" role="button">Print</button>
                </a>
              </div>              
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <div class="col-md-2">
                <a href="Delete.php">
                  <button class="app-content-headerButton" type="button" id="btn5" role="button"> Delete</button>
                </a>
              </div>
              <div class="col-md-3"></div>
            </div>  
          </div>
        </form>
      </div>
    </section>


    
  </div>
</div>
<!-- partial -->
  <script  src="./script.js"></script>
</body>
</html>