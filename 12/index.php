<?php
	define('LIMITE',4);
	$temperaturas=array();
	$temperaturas['Caja_1']=array(1,1,2,3,2,1,2,3,3,3,2,1,3,4);
	$temperaturas['Caja_2']=array(0,0,3,2,4,3,2,0,1,2,3,4,2,1);
	$temperaturas['Caja_3']=array(3,1,2,3,5,2,2,0,1,2,3,4,2,1);
	$temperaturas['Caja_4']=array(2,2,2,3,5,2,3,2,0,1,2,3,0,1);
	$temperaturas['Caja_5']=array(0,3,2,3,5,2,3,2,0,1,2,3,0,1);

	echo 'Cajas donde la temperatura ha sido alguna vez mayor de '.LIMITE.'&deg;C y primera lectura en que se ha superado ese l&iacute;mite:<ul>';
	foreach($temperaturas as $caja => $registro) {
		foreach($temperaturas[$caja] as $lectura => $temp) {
			if($temp>LIMITE) {
				echo '<li>'.$caja.' (lectura '.$lectura.')</li>';
				continue 2;
			}
		}
	}
	echo '</ul>';
?>