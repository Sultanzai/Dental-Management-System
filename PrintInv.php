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
  
$rem = $total - $recevid;

  $current_date = date('Y-m-d');  
  
  ?>


<!DOCTYPE html>
<html>
<head>
	<title>Invoice Form</title>
	<style>
		body {
			font-family: Arial, sans-serif;
			margin: 0;
			padding: 0;
		}
		.container {
			max-width: 800px;
			margin: 0 auto;
			padding: 20px;
		}
		.header {
			display: flex;
			justify-content: space-between;
			align-items: center;
			margin-bottom: 20px;
		}
		.header img {
			max-height: 200px;
		}
		.user-info {
			display: flex;
			justify-content: space-between;
			align-items: center;
			margin-bottom: 20px;
		}
		table {
			width: 100%;
			border-collapse: collapse;
			margin-bottom: 20px;
		}
		th, td {
			padding: 10px;
			border: 1px solid #ddd;
			text-align: center;
		}
		.total {
			display: flex;
			justify-content: space-between;
			align-items: center;
		}
		.display-field {
			display: flex;
			justify-content: space-between;
			align-items: center;
			margin-bottom: 20px;
		}
    h2{
      font-family:sans-serif;
      font-size: 24px;
    }
    h4{
      font-size: 20px;
      font-family:'Times New Roman', Times, serif;
      margin-top: -40px;
      padding-bottom: 20px;
      text-align: right;
    }
	</style>
</head>
<body>
	<div class="container">


    <div class="header">
			<div>
        <h2>Azka Oral Dental Care</h2>
      </div>
			<img src="imgs/logo.PNG" alt="Logo">
      <div>
        <h2 >مرکز تخصصی دندان ازکا </h2>
      </div>
    </div>
    <div class="header">
			<div>
        <h4> دکتور احمد حسن یوسفزی <br>متخصص جراحی وجه</h4>
      </div>
      <div>
        <h4>دكتور محمد ويس حضرتی<br> معالج امراض جوف دهن و دندان </h4>
      </div>
    </div>
    

		<div class="user-info">
			<div>
        <p>ID</p>
				<p>Name</p>
				<p>S/name</p>
			</div>
			<div>
				<p>Date: 20/06/2023</p>
			</div>
		</div>
		<table>
			<thead>
				<tr>
					<th>Treatment Name</th>
					<th>Description</th>
					<th>Price</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>CBCS</td>
					<td>400 Discount from Wais</td>
					<td>1200</td>
				</tr>
				
			</tbody>
		</table>
		<div class="total">
			<div>
			</div>
			<div>
				<p>Total: 1200</p>
				<p>Paid: 800</p>
				<p>Remming: 400</p>
			</div>
		</div>
		<div class="display-field">
			<div>
        <h3>Contact US </h3>
				<p>Address: Qala fatulla adsews of the clinic</p>
        <p> +93 77 451 4122</p>

        <p> +93 77 451 4122</p>

			</div>
			<div>
        <h3>Find Us in </h3>
				<p>azkaoraldentalcare</p>
				<p>azkaoraldentalcare@gmail.com</p>
			</div>
		</div>
	</div>

  <script>
    //window.print();
  </script>
</body>
</html>