<?php



$uname = $_POST['NAME'] ;
$pass =  $_POST['PASSWORD'];
$con=mysql_connect("localhost" , "root" , "");

mysql_select_db("major" , $con);

$tselect="select * from user WHERE username  LIKE '$uname';";
$dbpoint=mysql_query($tselect);
$data=(mysql_fetch_array($dbpoint));
$uname_db = $data['username'];
$pass_db = $data['password'];


//echo "$uname = $uname_db <p>";

//echo "$pass = $pass_db <p>";




if($uname == $uname_db  &&   $pass == $pass_db){
	echo "TRUE";
	header('location:index.php');
}
else{
	echo "FALSE";
}

?>
