<?php


//$cmnd="sudo split -b 193117 /var/www/html/major/splitexe/284866243818703293/284866243818703293";


exec("split -b 868707 /var/www/html/major/splitexe/2912701084692670928/2912701084692670928 /var/www/html/major/splitexe/2912701084692670928/",$output,$return_value);


			if($return_value == 0){

				echo "permission de di gye ";

			}

			else{

				echo "permission ni di..";


			}




?>
