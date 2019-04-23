
<head>
<meta charset="utf-8">
<title>Add Medicine</title>
	<h1 style="text-align: center;color:#004080;font-size: 60px ">+  PHARMACY </h1>
</head>
<form action="addmed.php" method="post">
<body>
	
	<link rel="stylesheet" href="admed.css" >
	<center><h2>Update Medicine Status</h2>
	<h4>Medicine Number #&nbsp;&nbsp; <input type="number" id ="t1" name="mnum" required /></h4>	<h4>Quantity&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="number" id ="t1" name="qty" required  /></h4>	<h4>price&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="number" id ="t1" name="pris" required /></h4>
		<h4>Supplier ID&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="number" id ="t1" name="supid"  required /></h4>
		<h4>Invoice No #&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="number" id ="t1" name="invno" required /></h4>
	
	
	<input name="submit" type="submit" id ="Register" value="Register"  />
		
	</center>
	
</body>
   <center> <A HREF = "http://localhost/project/Inventory.html">Back</A>
<footer>
    <h3 style="font-size:200%;color: Black"> &copy; 2017 Pharmacy.All rights reserved.</h3></center>
	</footer>
</form>
<?php


if (isset($_POST['submit'])) {
	//echo "<script type='text/javascript'> alert('pp') </script>";

	error_reporting(E_ERROR | E_PARSE );

$userName = "system";     //your localhost database username
$password = "Aeco2016";     //your localhost database password
$dtabasePort = "1521";
$serverName = "localhost";   //use localhost 
$databaseName = "EBRAHEEM";     // you can check the name of your database using this command  (select ora_database_name from dual;)

//echo "<script type='text/javascript'> alert('oo') </script>";
$conn = oci_connect($userName, $password, "(DESCRIPTION=(ADDRESS_LIST = (ADDRESS = (PROTOCOL = TCP)(HOST = $serverName)(PORT = $dtabasePort)))(CONNECT_DATA=(SID=$databaseName)))");

if (!$conn) {
    $e = oci_error();  //fr oci_connect errors pass no handle
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}
$mnum =(int) $_POST['mnum'];
$pris =(int) $_POST['pris'];
$supid =(int) $_POST['supid'];
$qty =(int) $_POST['qty'];
$invno =(int) $_POST['invno'];

$sqlstm= "select mno from medicine where mno = $mnum";
	$res1 = oci_parse($conn,$sqlstm);   // parse the query through connection
	oci_define_by_name($res1, 'MNO', $mnos);
	oci_execute($res1);
	oci_fetch($res1);
	if($mnos==$mnum){
		oci_free_statement($res1);
		$sqlstm= "select s_id from supplier where s_id = $supid";
		$res1 = oci_parse($conn,$sqlstm);   // parse the query through connection
		oci_define_by_name($res1, 'S_ID', $ssid);
		oci_execute($res1);
		oci_fetch($res1);
		if($ssid==$supid){
				oci_free_statement($res1);
				$sqlstm= "select invno from sinvoice where invno = $invno";
				$res1 = oci_parse($conn,$sqlstm);   // parse the query through connection
				oci_define_by_name($res1, 'INVNO', $ivno);
				oci_execute($res1);
				oci_fetch($res1);
				if($ivno==$invno){
					oci_free_statement($res1);
					$res = oci_parse($conn, "insert into distribute values ($qty, $pris, $supid, $invno, $mnum)");   // parse the query through connection
					$resu=oci_execute($res);  // execute query
					$sqlstm= "select qty from medicine where mno = $mnum";
					$res2 = oci_parse($conn,$sqlstm);   // parse the query through connection
					oci_define_by_name($res2, 'QTY', $mqty);
					oci_execute($res2);
					oci_fetch($res2);
					$mqty=$mqty+$qty;
					$linenew="update medicine set qty ='$mqty' where mno=$mnum";
					$res3 = oci_parse($conn,$linenew);  
					$resu1=oci_execute($res3);
					if($resu&&$resu1){
						oci_commit() ;
						echo "<script type='text/javascript'> alert('Sucessfull !') </script>";
					}else{
						echo "<script type='text/javascript'> alert('Unsucessfull !') </script>";
					}
				}else{
					echo "<script type='text/javascript'> alert('Unsucessfull !') </script>";
				}
		}else{
					echo "<script type='text/javascript'> alert('Unsucessfull !') </script>";
				}

	}else{
					echo "<script type='text/javascript'> alert('Unsucessfull !') </script>";
				}



}
?>