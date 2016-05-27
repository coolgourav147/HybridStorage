<?php

## now i m check the  session for the user is anuthonticated or not #############


session_start();



	$uname=$_SESSION['user_name'];	

#######	echo "this is testing that user is reach that page is successfully"; ########

############################### Now i m  check that how many server is avalible or not ###########################

	$root =NULL;
	for($i=1; $i<6; $i++){


		$t=exec("ping -c 1 -W 5 192.168.100.$i",$output,$return_value);


		if($return_value == 0){

			$root .= "192.168.100.$i ";
			echo "$root \n";
		}
	}




##################################################################################################################

########################Now connect the MY Sql ##############################################################


	if ( $con=mysql_connect("localhost" , "root" , "") ){
#		print "connected :P" . "<br />\n";
	}
	else{
		print "Mysql not conected" . mysql_error() . "<br />\n";
	}

	if ( mysql_query("CREATE DATABASE major;" , $con) ){
#		print "DB created"  . "<br />\n";
	}
	else{
#		print "DB not created : "  . mysql_error()  . "<br />\n";
	}

	if ( mysql_select_db("major" , $con) ){
#		print "DB selected :)"  . "<br />\n";
	}
	else{
#		print "DB not Used" . mysql_error() . "<br />\n";
	}



	$tcreate="CREATE TABLE split(UserName varchar(30)  , FileName varchar(50) not null PRIMARY KEY ,Node_ip varchar(200) not null,Filename_server varchar(50) not null,Path varchar(50) not null);";
	if ( mysql_query($tcreate , $con) ){
#		print "Table Created"  . "<br />\n";
	}
	else{
#		print "Table not created : " . mysql_error() . "<br />\n";
	}

########################################################################################################




# Now i m Trying to upload the file in the server....


	$ftype = $_FILES["photo"]["type"];
	$fsize = $_FILES["photo"]["size"];
	$fname = $_FILES["photo"]["name"];
	$ftmname =  $_FILES["photo"]["tmp_name"];


	$fsize = $_FILES["photo"]["size"] ;


	echo $fsize;


	$ssize= $fsize/2;

	$sptsize=ceil($ssize);

	echo "<p>". $sptsize;

	$re=rand();
	$ra=rand();
	$j=$ra*$re;
	exec("sudo mkdir -p /var/www/html/major/splitexe/$j ",$output,$return_value);


	if($return_value == 0){

		echo "<p>Folder bn gya re ";
		
		
			exec("sudo chmod 777 /var/www/html/major/splitexe/$j ",$output,$return_value);


			if($return_value == 0){

				echo "<p>permission de di gye ";

			}

			else{

				echo "<p>permission ni di..";


			}

	}

	else{

		echo "<p>Folder ni bna..";


	}

	$target_path="splitexe/$j/$j";

	


	echo "<p>".$target_path."<p>";

	if(move_uploaded_file($_FILES['photo']['tmp_name'], $target_path)) {

		echo "<p>file Uploaded thnank you for uploading";


		$tinsert="INSERT INTO split(UserName,FileName,Node_ip,Filename_server,Path) VALUES ('$uname', '$fname','$root','$target_path','$target_path');";

		if ( mysql_query($tinsert , $con) ){

#			print "<p>Data Inserted"  . "<br />\n";
			//header('location: detail.html');

		}
		else{

#			print "Data Not Inserted : " . mysql_error() . "<br />\n";

		}

	}

	else{


		echo "file not uploaded";

	}

###########################################################################################################


###################### Now i m trying to Split the file  #############################################


	//list of the server is the


	echo "root server is the--> $root";


	//echo "this is replicast session";
	
	//echo "$root";


	$splitser= array("aa","ab","ac","ad","ae");

	for($i=0; $i<6; $i++){


	echo "<p>".$splitser[$i];


	}


	$po=explode(' ',$root,8);

	print "<p> ---------- > > size is the" . sizeof($po);

	$sizepo = sizeof($po);

	echo "now i m trying to print the ip address using array";

	$no_of_node=$sizepo-1;

	echo	"<p> ------------ >> " . $no_of_node;

	echo "<p>=====================================</p>";
		
	echo	"<p>" . $no_of_node;
	echo "file size = $fsize";	
	$ssize= $fsize/$no_of_node;

	$sptsize=ceil($ssize);

	echo "<p> split size ".$sptsize;


	$cmdsplit="/var/www/html/major/$target_path";

	

	echo "this path is use in the split comnd   ----------- > $cmdsplit";


	$command = "sudo split -b"." ".$sptsize." ".$cmdsplit." "."/var/www/html/major/splitexe/$j/";
//	$command = "ls -l /";


	echo "<p>===============================";

	echo "<p>command is --- > $command";

	echo "<p>===============================";

	exec("$command",$output,$return_value);

	echo "========================================";
	if($return_value == 0){

		echo " <p>split ho gya re :p";

	}

	else{

		echo "split nhi hua...";


	}











#################################################################################


###################### Now i m trying to Distribute the file  #############################################


	
		
	for($i=0; $i<$sizepo-1; $i++){


		echo   "<p>".$po[$i];


		$src="/var/www/html/major/splitexe/$j/".$splitser[$i];

#echo"<p>===========================================================================================================";

#		echo "<p>===============================================================";
		echo "<p><b>source path is ---> $src</b>";
#		echo "<p>===============================================================";
		$dsto="/var/www/html/major/split/$j/"; 
		$dst="root@".$po[$i].":/var/www/html/major/split/$j/";

		

#		echo "<p>===============================================================";
		echo "<p><b>dest path is ---> $dst</b>";
#		echo "<p>===============================================================";

		if($po[$i] == "192.168.100.1"){

			
			echo "<p><b> this is block for master</b>";

			
			exec("sudo mkdir -m  777 -p  /var/www/html/major/split/$j/ ",$output,$return_value);


			if($return_value == 0){

				echo "directroy create ho gye....";

				exec("sudo cp $src /var/www/html/major/split/$j/",$output,$return_value);


				if($return_value == 0){
					echo "source = > $src";
					echo "<p>copy ho gya";

			
				}

				else{
					echo "source = > $src";
					echo "<p>copy nhi hue";

		
				}

			}

			else{
	
				echo "dir create nhi hue";

	
			}


		}
		
		else{

			echo "<p>this is run when the server is not master";
			$node_ip_cmnd= "sudo ssh root@".$po[$i]." mkdir -m 777 -p /var/www/html/major/split/$j/";
			echo "<h2>$node_ip_cmnd</h2>";

			exec("$node_ip_cmnd",$output,$return_value);


			if($return_value == 0){
				//echo "source = > $src";
				echo "<p>slave server  p dir bn gye";
				$split_cmndd="sudo scp $src $dst";
				exec("$split_cmndd",$output,$return_value);

				echo "<p>=====================================";

				echo "<p>souccde------------------ >>   $src";
				echo "<p>destination------------------ >>   $dst <p>";

				echo "command is $split_cmndd";

				echo "========================================";
				if($return_value == 0){
					//echo "source = > $src";
					echo "<p>slave server  p copy ho gya";

							
				}

				else{
					//echo "source = > $src";
					echo "<p>copy nhi hue";
		
				}				

			
			}

			else{
			//	echo "source = > $src";
				echo "<p>server p dir nhi bni..";
		
			}


			


		}



#echo "<p>==============================================================================================================";

		exec("sudo scp $src $dst ",$output,$return_value);


		if($return_value == 0){

			echo "Print ho gya re :p";

		}

		else{

			echo "ja k apni bhaissss chara";


		}



	}






?>
