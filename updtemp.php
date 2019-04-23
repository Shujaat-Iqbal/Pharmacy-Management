
<head>

<title>Update Employee</title>
	<h1 style="text-align: center;color:#004080;font-size: 60px ">+  PHARMACY </h1>
</head>
<form action="updtemp.php" method="post">
<body>
	<link rel="stylesheet" href="updtem.css" >
	<center><h2>Update Employee Data</h2></center>
	<center><h4>Please Enter Employee Number #</h4><input type="number" id ="t1" name="eno" required /><br>
		<h4>Select The Value You Want To Update</h4>
		<select name="action" id="t1" required>
			<option>Name</option>
			<option>Date of Birth</option>
			<option>Phone #</option>
			<option>Address</option>
			<option>Salary #</option>
			<option>Duty</option>
			<option>Username</option>
			<option>Password</option>
			</select>
		<center><h4>Please Enter The value #</h4><input type="text" id ="t1" name="val" required /><br><br>
		<input name="submit" type="submit" id ="t1" value="Update"  />
	
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

$enum = (int)$_POST['eno'];
$action = $_POST['action'];
$val = $_POST['val'];

$sqlstm= "select eno from employee where eno = $enum";
	$res1 = oci_parse($conn,$sqlstm);   // parse the query through connection
	oci_define_by_name($res1, 'ENO', $enos);
	oci_execute($res1);
	oci_fetch($res1);
	if($enos==$enum){
		oci_free_statement($res1);
			if($action=="Name"){
				$linenew="update employee set ename ='$val' where eno=$enum";
				$res1 = oci_parse($conn,$linenew);  
				$resu=oci_execute($res1);
				if($resu){
					oci_commit() ;
					echo "<script type='text/javascript'> alert('Sucessfull !') </script>";
				}else{
					echo "<script type='text/javascript'> alert('Unsucessfull !') </script>";
				}
			}elseif($action=="Date of Birth"){
				$linenew="update employee set dob ='$val' where eno=$enum";
				$res1 = oci_parse($conn,$linenew);  
				$resu=oci_execute($res1);
				if($resu){
					oci_commit() ;
					echo "<script type='text/javascript'> alert('Sucessfull !') </script>";
				}else{
					echo "<script type='text/javascript'> alert('Unsucessfull !') </script>";
				}
			}elseif($action=="Phone #"){
				$vali=(int)$_POST['val'];
				$linenew="update employee set ephone ='$vali' where eno=$enum";
				$res1 = oci_parse($conn,$linenew);  
				$resu=oci_execute($res1);
				if($resu){
					oci_commit() ;
					echo "<script type='text/javascript'> alert('Sucessfull !') </script>";
				}else{
					echo "<script type='text/javascript'> alert('Unsucessfull !') </script>";
				}
			}elseif($action=="Address"){
				$linenew="update employee set eaddress ='$val' where eno=$enum";
				$res1 = oci_parse($conn,$linenew);  
				$resu=oci_execute($res1);
				if($resu){
					oci_commit() ;
					echo "<script type='text/javascript'> alert('Sucessfull !') </script>";
				}else{
					echo "<script type='text/javascript'> alert('Unsucessfull !') </script>";
				}
			}elseif($action=="Salary #"){
				$vali=(int)$_POST['val'];
				$linenew="update employee set esal ='$vali' where eno=$enum";
				$res1 = oci_parse($conn,$linenew);  
				$resu=oci_execute($res1);
				if($resu){
					oci_commit() ;
					echo "<script type='text/javascript'> alert('Sucessfull !') </script>";
				}else{
					echo "<script type='text/javascript'> alert('Unsucessfull !') </script>";
				}
			}elseif($action=="Duty"){
				$linenew="update employee set duty ='$val' where eno=$enum";
				$res1 = oci_parse($conn,$linenew);  
				$resu=oci_execute($res1);
				if($resu){
					oci_commit() ;
					echo "<script type='text/javascript'> alert('Sucessfull !') </script>";
				}else{
					echo "<script type='text/javascript'> alert('Unsucessfull !') </script>";
				}
			}elseif($action=="Username"){
				$linenew="update employee set username ='$val' where eno=$enum";
				$res1 = oci_parse($conn,$linenew);  
				$resu=oci_execute($res1);
				if($resu){
					oci_commit() ;
					echo "<script type='text/javascript'> alert('Sucessfull !') </script>";
				}else{
					echo "<script type='text/javascript'> alert('Unsucessfull !') </script>";
				}
			}elseif($action=="Password"){
				$linenew="update employee set pasword ='$val' where eno=$enum";
				$res1 = oci_parse($conn,$linenew);  
				$resu=oci_execute($res1);
				if($resu){
					oci_commit() ;
					echo "<script type='text/javascript'> alert('Sucessfull !') </script>";
				}else{
					echo "<script type='text/javascript'> alert('Unsucessfull !') </script>";
				}
			}



}
}

?>