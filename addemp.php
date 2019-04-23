<head>
<meta charset="utf-8">
<title>Add Employee</title>
	<h1 style="text-align: center;color:#004080;font-size: 60px ">+  PHARMACY </h1>
</head>
<form action="addemp.php" method="post">
<body>
<link rel="stylesheet" href="addemp.css" >
	<center>
		<h4>Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input  type="text" id ="t1" name="nam" required /></h4>
		<h4>Date of Birth&nbsp;&nbsp;&nbsp;<input type="text" id ="t1" name="dob" placeholder="DD-MMM-YYYY" required/></h4>
		<h4>Phone #&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="number" id ="t1" name="pho"  required/></h4>
		<h4>Address&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;<input type="text" id ="t1" name="addres" required /></h4>
		<h4>Salary #&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="number" id ="t1" name="sal" required /></h4>
		<h4>Duty&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" id ="t1" name="dutyshift" required  /></h4>
		<h4>Username&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="text" id ="t1" name="usr" required /></h4>
		<h4>Password&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;<input type="password" id ="t1" name="pswd"  required /></h4>

	<input name="submit" type="submit" id ="Register" value="Register"  /><br>
		
	</center>
	
</body>
<center> <A HREF = "http://localhost/project/emp.html">Back</A>
<footer>
    <h3 style="font-size:200%;color: white"> &copy; 2017 Pharmacy.All rights reserved.</h3></center>
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

$sqlstm= "select max(eno) as maxno from employee";
	$res1 = oci_parse($conn,$sqlstm);   // parse the query through connection
	oci_define_by_name($res1, 'MAXNO', $fnos);
	oci_execute($res1);
	oci_fetch($res1);
    $empnum=(int)$fnos+1;

  $name = $_POST['nam'];
    $dateb = $_POST['dob'];
	$fone = (int)$_POST['pho'];
    $adres= $_POST['addres'];
	$salry = (int)$_POST['sal'];
    $ds = $_POST['dutyshift'];
	$use = $_POST['usr'];
    $pas = $_POST['pswd'];
	oci_free_statement($res1);
$res = oci_parse($conn, "insert into Employee values ($empnum, '$name', $salry, $fone, '$dateb', '$adres','$ds','$use','$pas')");   // parse the query through connection
$resu=oci_execute($res);  // execute query

if($resu){
	oci_commit() ;
	echo "<script type='text/javascript'> alert('Sucessfull !') </script>";
}else{
	echo "<script type='text/javascript'> alert('Unsucessfull !') </script>";
}

}

?>