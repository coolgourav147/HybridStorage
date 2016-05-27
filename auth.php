<?php
//$uname=$_POST['uname'];
//$pass=$_POST['pass'];
#######################################################################
if ( $con=mysql_connect("localhost" , "root" , "") ){
	print "connected :P" . "<br />\n";
}
else{
	print "Mysql not conected" . mysql_error() . "<br />\n";
}

######################################################################

######################################################################
if ( mysql_query("CREATE DATABASE major;" , $con) ){
	print "DB created"  . "<br />\n";
}
else{
	print "DB not created : "  . mysql_error()  . "<br />\n";
}

#####################################################################

#####################################################################
if ( mysql_select_db("major" , $con) ){
	print "DB selected :)"  . "<br />\n";
}
else{
	print "DB not Used" . mysql_error() . "<br />\n";
}

########################################################################


#########################################################################
#############################################################



###########################################################################
$tcreate="CREATE TABLE user(username varchar(30)  PRIMARY KEY, password varchar(50) not null);";
if ( mysql_query($tcreate , $con) ){
	print "Table Created"  . "<br />\n";
}
else{
	print "Table not created : " . mysql_error() . "<br />\n";
}

###########################################################################
##################################################################################


$tinsert="INSERT INTO user(username,password) VALUES ('anuj', 'anuj');";

		if ( mysql_query($tinsert , $con) ){

			print "Data Inserted"  . "<br />\n";
			//header('location: detail.html');

		}

		else{
			print "Data not Inserted : " . mysql_error() . "<br />\n";
		}





##################################################################################




###################################################################################
//echo "<img src='http://localhost/abhiSir/$target_path' width='150' height='100' />";
##################################################################################

















?>
