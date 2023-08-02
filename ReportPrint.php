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


    $totalpaitent ="0";
    $totalcash = "0";
    $CashPaid ="0";
    $totalRemaining = "0";

	$currentdate = date('Y-m-d');

    if(empty($USERID) OR empty($USERNAME) OR empty($TYPE)){
      
      header("location: /DMS/dist/login.php");
      exit;
    }
    else{
		$FROM = $_SESSION['from'];
		$TO = $_SESSION['to'];
    }
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Table with Multiple Rows and Pages</title>
	<style>
		body {
			font-family: Arial, sans-serif;
			margin: 0;
			padding: 0;
			background-color: #f2f2f2;
		}


        .header{
                padding: 20px;
                display: flex;
                justify-content: space-between;
                font-size: 16px;
            }
            img{
                margin-top: -60px;
                width: 250px;
                height: 250px;
            }
            .info{
                display: flex;
                justify-content: space-between;
                padding-left: 50px;
                padding-right:50px;
                padding-top: 0;
                margin-top: -80px;
                font-size: 14px;
            }


        .container {
			max-width: 794px; /* A4 paper size */
			margin: 0 auto;
			background-color: #fff;
			padding: 30px;
			box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
		}
		table {
			width: 100%;
			border-collapse: collapse;
			margin-bottom: 20px;
		}
		table th, table td {
			padding: 10px;
			text-align: left;
			border: 1px solid #ccc;
		}
		table th {
			background-color: #f2f2f2;
			font-weight: bold;
		}
		@media print {
			.container {
				margin: 0;
				padding: 0;
				box-shadow: none;
			}
		}
	</style>
</head>
<body>

	<div class="container">
        <div class="header">
            <div class="name">
                <h2>Azka Oral Dental Care</h2>
            </div>
            <div class="logo"> <img src="imgs/logo.PNG" alt="Logo"> </div>
            <div class="name">
                <h2 >مرکز تخصصی دندان ازکا </h2>
            </div>
        </div>
        <div class="info">
            <h4>Peinter By: <?php echo $USERNAME?></h4>
            <h4>Date: <?php echo $currentdate ?></h4>
        </div>
		<table>
			<thead>
				<tr>
					<th>No</th>
					<th>Patient ID</th>
					<th>Name</th>
					<th>F/Name</th>
					<th>Note</th>
					<th>Treatment</th>
					<th>Date</th>
					<th>Total</th>
					<th>Cash Recevid</th>
					<th>Remaining</th>
					<th>Added By</th>
				</tr>
			</thead>
			<tbody>
			<?php
			$sql = "SELECT * FROM view_report WHERE P_RegDate >= '$FROM' AND P_RegDate <= '$TO' ORDER BY P_ID DESC;";
			$resutl = $con->query($sql);

			if(!$resutl){
				die("Invalid Query: " . $con->error);
			  }  
  
			   // Total Reports 
          // patients
          $DPsql ="SELECT COUNT(P_ID) AS Patient FROM view_report WHERE P_RegDate BETWEEN '$from' AND '$to';";
          $DPrun = mysqli_query($con,$DPsql);
          if (mysqli_num_rows($DPrun) > 0) {
            $DProw = mysqli_fetch_assoc($DPrun);
            $totalpaitent = $DProw["Patient"];
          }
          
          // Total
          $Tsql ="SELECT SUM(PB_Total) AS Total FROM view_report WHERE P_RegDate BETWEEN '$from' AND '$to';";
          $Trun = mysqli_query($con,$Tsql);
          if (mysqli_num_rows($Trun) > 0) {
            $Trow = mysqli_fetch_assoc($Trun);
            $totalcash = $Trow["Total"];
          }

          // Receive
          $Rsql ="SELECT SUM(PB_Receive) AS Remm FROM view_report WHERE P_RegDate BETWEEN '$from' AND '$to';";
          $Rrun = mysqli_query($con,$Rsql);
          if (mysqli_num_rows($Rrun) > 0) {
            $Rrow = mysqli_fetch_assoc($Rrun);
            $CashPaid = $Rrow["Remm"];
          }

          //Remaining 
          $totalRemaining = $totalcash -$CashPaid;


			$x=0;
  			while($row = $resutl->fetch_assoc()){
				$x = $x+1;
			echo"
				<tr>
				<td>$x</td>
				<td>$row[P_ID]</td>
				<td>$row[P_Name]</td>
				<td>$row[P_SName]</td>
				<td>$row[P_Note]</td>
				<td>$row[PT_Name]</td>
				<td>$row[P_RegDate]</td>
				<td>$row[PB_Total]</td>
				<td>$row[PB_Receive]</td>
				<td>$remaining</td>
				<td>$row[Name]</td>
				</tr>
				";
			}		
			echo"
			<div class = products-row id = totals>
			  <table id = 'myDataTable'> 
				<div style=' display:flex; justify-content: flex-end; padding-right: 100px; background-color: #cdcdcd; border: solid black 2px; font-size: 22px;' class= product-cell stock ><span class= cell-label ></span>TOTAL :  $totalExpances </div>
			  </table> 
			</div>
		  ";
				?>
			</tbody>
		</table>
	</div>
</body>
	<script>
		window.print();	
	</script>
</html>