<?php



	$fsize = $_FILES["photo"]["size"] ;


	echo $fsize;


	$ssize= $fsize/2;



	echo "<p>".ceil($ssize);








?>
