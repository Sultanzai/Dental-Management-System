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

  $id = $userdata['newid'];
  $name =$userdata['name'];
  $sname = $userdata['sname'];
  $note = $userdata['note'];
  $treatmentName =$userdata['treatment'];
  $total =$userdata['total'];
  $recevid = $userdata['recived'];

  $appoinmnet = $_SESSION['Appoinment'];
  $time = $_SESSION['Time'];


  $rem = $total - $recevid;

  $current_date = date('Y-m-d');  
  
  ?>

<!DOCTYPE html>
<html>
<head>
    <style>
        @page {
            size: A5 landscape;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        header{
			margin-top:100px;
            display: flex;
            justify-content: space-between;
            padding: 0 10px;
            font-family:'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
            text-transform: uppercase;
            font-size: 14px;
        }
        .price{
            display:grid;
            justify-content: flex-end;
            padding: 0 20px 0 0;
            font-size: 16px;
            font-family:'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
        }
        h4{
            margin: 10px;
        }
        h5{
            display: flex;
            justify-content: right;
            padding-right: 10px;
            margin: 0;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
        }
        th {
            background-color: lightgray;
        }
    </style>
</head>
<body>
	<?php 
	echo "
	
	    <header>
            <h3>ID: $id</h3>
            <h3>Name: $name</h3>
            <h3>F/name: $sname</h3>
            <h3>Next Visit: $appoinmnet -- $time</h3>
        </header>
    <br>    
        <h5> DATE: $current_date</h5>
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
                <td>$treatmentName</td>
                <td>$note</td>
                <td>$total</td>
            </tr>
        </tbody>
    </table>
    <br>
    <div class=price>
        <h4>Total: $total</h4>
        <h4>Paid: $recevid</h4>
        <h4>Remaining: $rem</h4>
    </div>

	";
	?>

</body>
<script>
	window.print();
</script>
</html>