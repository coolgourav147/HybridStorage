<?php



session_start();

$_SESSION['user_login']=NULL;
$_SESSION['user_name']=NULL;	
$_SESSION['user_pass']=NULL;



header('location:main.html');



?>
