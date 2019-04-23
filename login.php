
<head>
<title>login</title>
    <h1 style="text-align: center;font-size: 70px ">+  PHARMACY </h1>
</head>
<form action="login.php" method="post">
<body>
	 <link rel="stylesheet" href="log.css" >
	
	<center><img src="logpic.png" width="200" height="200" alt=""/> </center>
	<br>
	
	 <div style="text-align:center;"><input type="text" style="font-size:large" name="use" placeholder="username" required></div>
        <br> <br>
        <div style="text-align:center;"><input type="password" style="font-size:large" name="Pas" placeholder="password" required></div>
        <br> <br>
        <div style="text-align:center;"><input type="submit" style="font-size:large" value="Login" id = "submit" name="submit"></div><br><br>
	<footer> 
		  <center><h3 style="color: white"> &copy; 2017 Pharmacy.All rights reserved.</h3></center>
		</footer> 
		
</body>
</form>
<?php


if (isset($_POST['submit'])) {
	//echo "<script type='text/javascript'> alert('pp') </script>";
    $use = $_POST['use'];
    $pas = $_POST['Pas'];

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
//echo "<script type='text/javascript'> alert('ll') </script>";
$sqlstm= "select username from Employee where username = '$use'";
	$res1 = oci_parse($conn,$sqlstm);   // parse the query through connection
	oci_define_by_name($res1, 'USERNAME', $unos);
	oci_execute($res1);
	oci_fetch($res1);
if($unos==$use){
oci_free_statement($res1);
$sqlstm= "select pasword from Employee where pasword = '$pas'";
	$res1 = oci_parse($conn,$sqlstm);   // parse the query through connection
	oci_define_by_name($res1, 'PASWORD', $pswd);
	oci_execute($res1);
	oci_fetch($res1);
if($pswd==$pas){
	
 header("Location: main.html");
        exit;
}
}
echo "<script type='text/javascript'> alert('TRY AGAIN') </script>";
}

?>