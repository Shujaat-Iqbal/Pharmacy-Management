<!DOCTYPE html>
<html>
    <head>
        <title>Sale</title>
		
        <meta charset="windows-1252">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
		
        <style type="text/css">
		.left{
		position: absolute;
		top:210px;
		left:700px;}
		
		</style>
        
        
		
		<style type="text/css">
		.right{
		position: absolute;
		left:100px;}
		
		</style>
		
        <style type="text/css">
            dummydeclaration { padding-left: 4em; } 
            tab1 { padding-left: 4em; }
            tab2 { padding-left: 6em; }
            tab3 { padding-left: 8em; }
 
        </style>
		<style type="text/css">
		.top{
		position: absolute;
		left:100px;
		top:300px}
		
		</style>
 
        
        <script>
			function calctotal()
			{
				var t1=document.getElementById('total').value;
				var t2=document.getElementById('disc').value;
				var t3=document.getElementById('cash').value;
				var t4=t2*t1/100;
				t4=t1-t4;
				 if (t3==null || t3==0 || t3<t4)
				  {
					  alert("Please insert amount or add more");
					  return false;
				  }
				t4=Math.round(t4);
				document.getElementById('net').value=t4;
				document.getElementById('bal').value=t3-t4;
			}
           
            
        </script>
        
    </head>
 
    <body>
       
<form action="sales.php" method="post">
        
       
      <!--  invoice#: <input type="number" name="invoice" value=0 id="invoice" />-->
        
        Customer Name: <input type="text" name="cname" id="cname" />
        
        <input type="submit" value="New Customer" name="newcust" ></input>
      <!--  Date: <input type="date" name="date" id="date" />-->
        
        <br/><br/>
        
        <br/><br/>
        
     <fieldset>
    	<legend>Medicines:</legend>
   
        
        Medicine Name:     <tab1> Madicine id: </tab1>
        
        <tab2> Quantity: </tab2>
        <tab3> Price: </tab3>
        <br>
        <input type="text" name="mname" id="mname" />
        <input type="text" name="mid" id="mid" />
        <input type="number" name="mquantity" id="mquantity" />
        <input type="number" name="mprice" id="mprice" /><br/><br/>
        <input type="submit"  value="search" name="sarch"></input>
        <tab3><input type="submit" value="Show All" name="all" ></input></tab3><br/><br/>
        <input type="submit" value="Add" name="addtotable" ></input><br/><br/>
 
	<div style="height:400px; width:450px; overflow-y: scroll;">
        
        </div>
        </fieldset>
        
      <fieldset>
    	<legend>Payment:</legend>
     
       <tab3><tab2><tab1> Total: <input type="number" name="total" id="total" value=0 /></tab1></tab2></tab3><br>
        
        
        Discount%: <input type="number" name="disc" id="disc" value=0 />
        
        Net Total: <input type="number" name="net" id="net" /><br>
        
        <tab3><tab2><tab1>cash: <input type="number" name="cash" id="cash" value=0 /></tab1></tab2></tab3><br>
        
        <tab3><tab2><tab1>Balance: <input type="number" name="bal" id="bal" /></tab1></tab2></tab3><br>
        
        <tab3><input type="button" value="Calculate" name='ordrsave' onclick="calctotal();"></input></tab3><br/><br/><br/>
		
       </fieldset>
    
	

		<input type="submit" value="print" name='receipt' ></input>
		</form>
    </body>
 
</html>
<?php
/**

 * Created by PhpStorm.
 * User: ahmad
 * Date: 4/6/2017
 * Time: 5:47 PM
 */
 //onclick="addRow();"
error_reporting(E_ERROR | E_PARSE );
 
 
 
$userName = "system";     //your localhost database username
$password = "Aeco2016";     //your localhost database password
$dtabasePort = "1521";
$serverName = "localhost";   //use localhost 
$databaseName = "Ebraheem";     // you can check the name of your database using this command  (select ora_database_name from dual;)
 
 
 
//for establishing the connection with oracle database 
 
$mname = $_POST['mname'];
 
$mid = (int)$_POST['mid'];
 
 
$mquantity = $_POST['mquantity'];
 
$mprice = $_POST['mprice'];
$invoice = $_POST['invoice'];
 
 
$date = $_POST['date'];
 
$cname = $_POST['cname'];
 
 
 
$total = (int)$_POST['total'];
 
$net = (int)$_POST['net'];
$disc = $_POST['disc'];
 
 
$cash = $_POST['cash'];
 
$bal = $_POST['bal'];
 
$conn = oci_connect($userName, $password, "(DESCRIPTION=(ADDRESS_LIST = (ADDRESS = (PROTOCOL = TCP)(HOST = $serverName)(PORT = $dtabasePort)))(CONNECT_DATA=(SID=$databaseName)))");
 
 
if (!$conn) {
    $e = oci_error();  //fr oci_connect errors pass no handle
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

if(isset($_POST['newcust']))
{
$sqlstm= "select max(orderno) as maxno from corder";
	$res1 = oci_parse($conn,$sqlstm);   // parse the query through connection
	oci_define_by_name($res1, 'MAXNO', $fnos);
	oci_execute($res1);
	oci_fetch($res1);
    $onum=(int)$fnos+1;
    $resc = oci_parse($conn, "insert into Employee values ($onum, 'n', 0)");   // parse the query through connection
    $resu1=oci_execute($resc);  // execute query

if($resu1){
	oci_commit() ;
    }
}
 
 
if(isset($_POST['sarch']))
{
 
// Display the  information from the medicine table
$res = oci_parse($conn, "SELECT * FROM medicine where mno=$mid or mname='$mname'");   // parse the query through connection
oci_execute($res);  // execute query
}
 
else if(isset($_POST['all']))
{
 
// Display the  information from the medicine table
$res = oci_parse($conn, "SELECT * FROM medicine");   // parse the query through connection
oci_execute($res);  // execute query
}
 
 
else if(isset($_POST['addtotable']))
{
    $sqlstm= "select max(orderno) as maxno from corder";
	$res7 = oci_parse($conn,$sqlstm);   // parse the query through connection
	oci_define_by_name($res7, 'MAXNO', $mmnos);
	oci_execute($res7);
	oci_fetch($res7);


 
$stid = oci_parse($conn, "INSERT INTO contains (sqty,sprice,ordrno,medno)
    values ($mquantity,$mprice,$mmnos,$mid)");
    oci_execute($stid);
 
}
 
else if(isset($_POST['ordrsave']))
{
    $slstm= "select max(orderno) as maxno from corder";
	$ress = oci_parse($conn,$slstm);   // parse the query through connection
	oci_define_by_name($ress, 'MAXNO', $lnos);
	oci_execute($ress);
	oci_fetch($ress);
    $linenew="update corder set status ='p',totalamount=$total where orderno=$lnos";
				$ordrs = oci_parse($conn,$linenew);  
				$resu22=oci_execute($ordrs);
				if($resu22){
					oci_commit() ;}
 
}
 
else if(isset($_POST['receipt']))
{
 
	print "</br>";
    echo "Customer Name: ".$cname;
	print "</br>";
	print "</br>";
    echo "Date: ".$date;
	print "</br>";
	print "</br>";
 
 
//$rec = oci_parse($conn, "SELECT m.mname,o.sqty as Qty,o.sprice,o.sqty*o.sprice as amount FROM medicine m,contains o where m.mno=o.medno and $invoice=o.ordrno ");
  //  oci_execute($rec);
	
	
	print "</br>";
	//print "</br>";
    echo "Total: ".$total;
	print "</br>";
    echo "Discount: ".$disc;
	print "</br>";
    echo "Cash: ".$cash;
	print "</br>";
	
 
}

$slstm= "select max(orderno) as maxno from corder";
	$ress = oci_parse($conn,$slstm);   // parse the query through connection
	oci_define_by_name($ress, 'MAXNO', $nos);
	oci_execute($ress);
	oci_fetch($ress);
$resm = oci_parse($conn, "select  medno,mname,sprice,sqty from contains e,medicine d where e.medno=d.mno and e.ordrno=$nos");   // parse the query through connection
oci_execute($resm);

echo "<table class=top border='1'>\n";
$row = oci_fetch_assoc($resm);  //fetch rows
echo "<tr>\n";
foreach($row as $title => $value)   //fetch heading and then display them in table
{
echo "    <th>" . ($title !== null ? htmlentities($title, ENT_QUOTES) : "&nbsp;") . "</th>\n"; }    // Display an appropriate message on either success or failure
 
echo "</tr>\n";
do //fetch each row of data one by one
	{
    echo "<tr>\n";
    foreach ($row as $item) {
        echo "    <td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
    }
    echo "</tr>\n";
}while ($row = oci_fetch_assoc($resm)) ;
echo "</table>\n";

 
 
echo "<table class=left border='1'>\n";
$row = oci_fetch_assoc($res);  //fetch rows
echo "<tr>\n";
foreach($row as $title => $value)   //fetch heading and then display them in table
{
echo "    <th>" . ($title !== null ? htmlentities($title, ENT_QUOTES) : "&nbsp;") . "</th>\n"; }    // Display an appropriate message on either success or failure
 
echo "</tr>\n";
do //fetch each row of data one by one
	{
    echo "<tr>\n";
    foreach ($row as $item) {
        echo "    <td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
    }
    echo "</tr>\n";
}while ($row = oci_fetch_assoc($res)) ;
echo "</table>\n";
 
 
 
 

echo "<table class=right >\n";
$row = oci_fetch_assoc($rec);  //fetch rows
echo "<tr>\n";
foreach($row as $title => $value)   //fetch heading and then display them in table
{
echo "    <th>" . ($title !== null ? htmlentities($title, ENT_QUOTES) : "&nbsp;") . "</th>\n"; }    // Display an appropriate message on either success or failure
 
echo "</tr>\n";
while ($row = oci_fetch_assoc($rec))  //fetch each row of data one by one
	{
    echo "<tr>\n";
    foreach ($row as $item) {
        echo "    <td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
    }
    echo "</tr>\n";
}
echo "</table>\n";
 
?>