<?php

$root =NULL;
for($i=1; $i<6; $i++){


	$t=exec("ping -c 1 -W 5 192.168.100.$i",$output,$return_value);


	if($return_value == 0){

		$root .= "192.168.100.$i ";
		echo "$root \n";
	}
}



echo "final value of node ip is = $root \n";


?>
