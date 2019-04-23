
<head>
<meta charset="utf-8">
<title>Add Medicine (NEW)</title>
	<h1 style="text-align: center;color:#004080;font-size: 60px ">+  PHARMACY </h1>
</head>
<form action="addmednew.php" method="post">
<body>
	
	<link rel="stylesheet" href="admed.css" >
	<center><h2>Update Medicine Status</h2>
	<h4>Medicine Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="text" id ="t1" name="mnam" required /></h4>	<h4>Medicine Formula &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" id ="t1" name="mform" required  /></h4>	<h4>Company Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="text" id ="t1" name="compnam" required /></h4>
		<h4>Unit&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" id ="t1" name="unit" required  /></h4>
		<h4>Batch No #&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="text" id ="t1" name="btch" required /></h4>
		<h4>Expiry Date&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="text" id ="t1" name="edate" placeholder="DD-MMM-YYYY" required /></h4>
	
	
	<input name="submit" type="submit" id ="Register" value="Register"  />
	
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

$sqlstm= "select max(mno) as maxno from medicine";
	$res1 = oci_parse($conn,$sqlstm);   // parse the query through connection
	oci_define_by_name($res1, 'MAXNO', $mnos);
	oci_execute($res1);
	oci_fetch($res1);
    $mednum=(int)$mnos+1;

	$mname = $_POST['mnam'];
    $mform = $_POST['mform'];
	$comp = $_POST['compnam'];
    $unit= $_POST['unit'];
	$batch = (int)$_POST['btch'];
    $exp = $_POST['edate'];

	$res = oci_parse($conn, "insert into medicine values ($mednum, '$mname','$mform', '$comp', '$unit', $batch,'$exp',0)");   // parse the query through connection
$resu=oci_execute($res);  // execute query

if($resu){
	oci_commit() ;
	echo "<script type='text/javascript'> alert('Sucessfull !') </script>";
}else{
	echo "<script type='text/javascript'> alert('Unsucessfull !') </script>";
}

}
?>