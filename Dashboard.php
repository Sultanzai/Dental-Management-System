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


    $dailypaitent ="";
    $dailytotal ="";
    $dailyrecevid ="";
    
    $weeklypaitent ="";
    $weeklytotal ="";
    $weeklyrecevid ="";

    $montlypaitent ="";
    $montlytotal ="";
    $montlyrecevid ="";

    if(empty($USERID) OR empty($USERNAME) OR empty($TYPE)){
      
      header("location: /DMS/dist/login.php");
      exit;
    }
    else{
    #################### Daily #############################    
    #Daily patient 
    $DPsql ="SELECT COUNT(P_ID) AS Patient FROM tbl_patient WHERE P_RegDate = DATE(NOW());";
    $DPrun = mysqli_query($con,$DPsql);
    if (mysqli_num_rows($DPrun) > 0) {
      // Fetch the result as an associative array
      $DProw = mysqli_fetch_assoc($DPrun);
      // Print the total sum for today's date
      $dailypaitent = $DProw["Patient"];
    }
    
    #Daily Total 
    $DTsql ="SELECT SUM(PB_Total) AS total FROM tbl_patient_balance WHERE PB_ReceiveDate = DATE(NOW()); ";
    $DTrun = mysqli_query($con,$DTsql);
    if (mysqli_num_rows($DTrun) > 0) {
      $row = mysqli_fetch_assoc($DTrun);
      $dailytotal = $row["total"];
    }
    
    #Daily recevid 
    $DRsql ="SELECT SUM(PB_Receive) AS Recevid FROM tbl_patient_balance WHERE PB_ReceiveDate = DATE(NOW());";
    $DRrun = mysqli_query($con,$DRsql);
    if (mysqli_num_rows($DRrun) > 0) {
      $DRrow = mysqli_fetch_assoc($DRrun);
      $dailyrecevid = $DRrow["Recevid"];
    }

    #################### WEEkly #############################    
    #Weekly patient 
    $WPsql ="SELECT COUNT(P_ID) AS Patient from tbl_patient where week(P_RegDate)=week(now());";
    $WPrun = mysqli_query($con,$WPsql);
    if (mysqli_num_rows($WPrun) > 0) {
      // Fetch the result as an associative array
      $WProw = mysqli_fetch_assoc($WPrun);
      // Print the total sum for today's date
      $weeklypaitent = $WProw["Patient"];
    }
    
     #Weekly Total 
     $WTsql ="SELECT SUM(PB_Total) AS total from tbl_patient_balance where week(PB_ReceiveDate)=week(now());
     ";
     $WTrun = mysqli_query($con,$WTsql);
     if (mysqli_num_rows($WTrun) > 0) {
       $row = mysqli_fetch_assoc($WTrun);
       $weeklytotal = $row["total"];
     }

      #Weekly recevid 
      $WRsql ="SELECT SUM(PB_Receive) AS Recevid from tbl_patient_balance where week(PB_ReceiveDate)=week(now());";
      $WRrun = mysqli_query($con,$WRsql);
      if (mysqli_num_rows($WRrun) > 0) {
        $WRrow = mysqli_fetch_assoc($WRrun);
        $weeklyrecevid = $WRrow["Recevid"];
      }



          #################### Month #############################    
    #Monthly patient 
    $MPsql ="SELECT COUNT(P_ID) AS Patient from tbl_patient where month(P_RegDate)=month(now());";
    $MPrun = mysqli_query($con,$MPsql);
    if (mysqli_num_rows($MPrun) > 0) {
      // Fetch the result as an associative array
      $MProw = mysqli_fetch_assoc($MPrun);
      // Print the total sum for today's date
      $montlypaitent = $MProw["Patient"];
    }
    
     #Monthly Total 
     $MTsql ="SELECT SUM(PB_Total) AS total from tbl_patient_balance where month(PB_ReceiveDate)=month(now());
     ";
     $MTrun = mysqli_query($con,$MTsql);
     if (mysqli_num_rows($MTrun) > 0) {
       $row = mysqli_fetch_assoc($MTrun);
       $montlytotal = $row["total"];
     }

      #Montly recevid 
      $MRsql ="SELECT SUM(PB_Receive) AS Recevid from tbl_patient_balance where month(PB_ReceiveDate)=month(now());";
      $MRrun = mysqli_query($con,$MRsql);
      if (mysqli_num_rows($MRrun) > 0) {
        $MRrow = mysqli_fetch_assoc($MRrun);
        $montlyrecevid = $MRrow["Recevid"];
      }


      
  }
?>






<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>DMS</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
  <link rel="stylesheet" href="./style.css">
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
      <a href= ExpanceReport.php >
        <svg xmlns= http://www.w3.org/2000/svg  width= '18'  height= '18'  viewBox= '0 0 24 24'  fill= none  stroke= currentColor  stroke-width= 2  stroke-linecap= round  stroke-linejoin= round  class= feather feather-inbox ><polyline points= '22 12 16 12 14 15 10 15 8 12 2 12' /><path d= 'M5.45 5.11L2 12v6a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-6l-3.45-6.89A2 2 0 0 0 16.76 4H7.24a2 2 0 0 0-1.79 1.11z' /></svg>
        <span>Expances</span>
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
      <h1 class="app-content-headerText">Dashboard</h1>
      <button class="mode-switch" title="Switch Theme">
          <defs></defs>
          <path d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z"></path>
        </svg>
      </button>
      <a href="Registration.php"><button class="app-content-headerButton">Register Patient</button></a>
    </div>

    <section class="earningsec">
      <section class="repo">  
        <div class="container">
          <h1> Daily Report</h1>
          <div class="row">
            <div class="col-md">
              <div class="boxs">
                <div class="row"><h2> Patient Registed</h2></div><br>
                <div class="row"><h3> <?php echo $dailypaitent?> </h3></div>
              </div>
            </div>
            <div class="col-md">
              <div class="boxs">
                <div class="row"><h2> Total Amount </h2></div><br>
                <div class="row"><h3><?php echo $dailytotal?>  </h3></div>
              </div>
            </div>
            <div class="col-md">
              <div class="boxs">
                <div class="row"><h2> Recevid Amount</h2></div><br>
                <div class="row"><h2> <?php echo $dailyrecevid?> </h3></div>
              </div>
            </div>
          <!--
            <div class="col-md">
              <div class="boxs">
                <div class="row"><h1> No </h1></div><br>
                <div class="row"><h2> 7000 </h3></div>
              </div>
            </div>
          -->
          </div>
        </div>
      </section>

      <section class="repo">  
        <div class="container">
          <h1> Weekly Report</h1>
          <div class="row">
            <div class="col-md">
              <div class="boxs">
                <div class="row"><h2> Patient Registed</h2></div><br>
                <div class="row"><h2> <?php echo $weeklypaitent?> </h3></div>
              </div>
            </div>
            <div class="col-md">
              <div class="boxs">
                <div class="row"><h2> Total Amount </h2></div><br>
                <div class="row"><h2> <?php echo $weeklytotal?> </h3></div>
              </div>
            </div>
            <div class="col-md">
              <div class="boxs">
                <div class="row"><h2> Recevid Amount</h2></div><br>
                <div class="row"><h2> <?php echo $weeklyrecevid?> </h3></div>
              </div>
            </div>
          <!--
            <div class="col-md">
              <div class="boxs">
                <div class="row"><h1> No </h1></div><br>
                <div class="row"><h2> 7000 </h3></div>
              </div>
            </div>
          -->
          </div>
        </div>
      </section>

      <section class="repo">  
        <div class="container">
          <h1> Monthly Report</h1>
          <div class="row">
            <div class="col-md">
              <div class="boxs">
                <div class="row"><h2> Patient Registed</h2></div><br>
                <div class="row"><h2> <?php echo $montlypaitent ?> </h3></div>
              </div>
            </div>
            <div class="col-md">
              <div class="boxs">
                <div class="row"><h2> Total Amount </h2></div><br>
                <div class="row"><h2> <?php echo $montlytotal?> </h3></div>
              </div>
            </div>
            <div class="col-md">
              <div class="boxs">
                <div class="row"><h2> Recevid Amount</h2></div><br>
                <div class="row"><h2> <?php echo $montlyrecevid?> </h3></div>
              </div>
            </div>
          <!--
            <div class="col-md">
              <div class="boxs">
                <div class="row"><h1> No </h1></div><br>
                <div class="row"><h2> 7000 </h3></div>
              </div>
            </div>
          -->
          </div>
        </div>
      </section>
      <section>


    
  </div>
</div>
<!-- partial -->
  <script  src="./script.js"></script>

</body>
</html>
