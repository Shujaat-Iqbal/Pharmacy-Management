
<head>
<meta charset="utf-8">
<title>Remove Employee</title>
	<h1 style="text-align: center;color:#004080;font-size: 60px ">+  PHARMACY </h1>
</head>

<form action="removemp.php" method="post">

<body>
		<link rel="stylesheet" href="rmovem.css" >
	<center><h2>Remove Employee</h2></center>
	<center><h4>Please Enter Employee Number #</h4><input type="number" id ="t1" name="fno"  required/><br><br>
		<input name="submit" type="submit" id ="t2" value="Remove"  /><br><br>
		
		

</body>
<center>  <A HREF = "http://localhost/project/emp.html">Back</A><br><br><br><br><br><br><br><br><br>
		<footer>
    <center><h3 style="font-size:200%;color:#004080"> &copy; 2017 Pharmacy.All rights reserved.</h3></center>
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

$fnum =(int) $_POST['fno'];

$sqlstm= "select eno from employee where eno = $fnum";
	$res1 = oci_parse($conn,$sqlstm);   // parse the query through connection
	oci_define_by_name($res1, 'ENO', $enos);
	oci_execute($res1);
	oci_fetch($res1);
	if($enos==$fnum){
				$res = oci_parse($conn, "delete employee where eno=$fnum");
				$resu=oci_execute($res);
				if($resu){
					oci_commit() ;
					echo "<script type='text/javascript'> alert('Sucessfull !') </script>";
				}
	}else{
					echo "<script type='text/javascript'> alert('Unsucessfull !') </script>";
				}

}
?>
