<?php



session_start();



$uname=$_SESSION['user_name'];	
#################### Check Avalible Server #############################


$root =NULL;
for($i=1; $i<6; $i++){


	$t=exec("ping -c 1 -W 5 192.168.100.$i",$output,$return_value);


	if($return_value == 0){

		$root .= "192.168.100.$i ";
		echo "$root \n";
	}
}






################ MYSQL #########################

	if ( $con=mysql_connect("localhost" , "root" , "") ){
		print "connected :P" . "<br />\n";
	}
	else{
		print "Mysql not conected" . mysql_error() . "<br />\n";
	}

	if ( mysql_query("CREATE DATABASE major;" , $con) ){
		print "DB created"  . "<br />\n";
	}
	else{
		print "DB not created : "  . mysql_error()  . "<br />\n";
	}

	if ( mysql_select_db("major" , $con) ){
		print "DB selected :)"  . "<br />\n";
	}
	else{
		print "DB not Used" . mysql_error() . "<br />\n";
	}



	$tcreate="CREATE TABLE replicast(UserName varchar(30)  , FileName varchar(50) not null PRIMARY KEY ,Node_ip varchar(200) not null,Filename_server varchar(50) not null,Path varchar(50) not null);";
	if ( mysql_query($tcreate , $con) ){
		print "Table Created"  . "<br />\n";
	}
	else{
		print "Table not created : " . mysql_error() . "<br />\n";
	}


##############################################





	$ftype = $_FILES["photo"]["type"];
	$fsize = $_FILES["photo"]["size"] ;
	$fname = $_FILES["photo"]["name"] ;
	$ftmname =  $_FILES["photo"]["tmp_name"];

	$re=rand();
	$ra=rand();
	$j=$ra*$re;
	$target_path="replicast/";
	$target_path = $target_path.$j;

		


	if(move_uploaded_file($_FILES['photo']['tmp_name'], $target_path)) {

		echo "file Uploaded thnank you for uploading";

		###############################data into the table ##############
#UserName varchar(30)  , FileName varchar(50) not null PRIMARY KEY ,Node_ip varchar(200) not null,Filename_server varchar(50) not null,Path varchar(50) not null);
		$tinsert="INSERT INTO replicast(UserName,FileName,Node_ip,Filename_server,Path) VALUES ('$uname', '$fname','$root','$target_path','$target_path');";

		if ( mysql_query($tinsert , $con) ){

			print "Data Inserted"  . "<br />\n";
			//header('location: detail.html');

		}
		else{

			print "Data Not Inserted : " . mysql_error() . "<br />\n";

		}



	}
    				
	else{

		echo "There was an error uploading the file, please try again!";

	}





######################### Replicast of the File #########################

//list of the server is the


//echo "root server is the--> $root";


//echo "this is replicast session";

//echo "$root";


$po=explode(' ',$root,8);

//print "size is the" . sizeof($po);

$sizepo = sizeof($po);

echo "now i m trying to print the ip address using array";


//echo "node 1=" . $po[0];

//echo "node 2=" . $po[1];


for($i=0; $i<$sizepo-1; $i++){


	echo   $po[$i]."<p>";

	$src="/var/www/html/major/".$target_path;
	$dst="root@".$po[$i].":/var/www/html/major/".$target_path;



		echo "<p>source = $src";
		echo "<p>destination = $dst";



	exec("sudo scp $src $dst ",$output,$return_value);


	if($return_value == 0){

		echo "Print ho gya re :p";

	}

	else{

		echo "ja k apni bhaissss chara";


	}

	# now i  m make the directory in each node...

//	echo "<p> === $target_path";

	


}





#########################################################################






?>





