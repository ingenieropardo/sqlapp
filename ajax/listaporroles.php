<?php
	include ("../config/funciones.php");
	conectalocal();
    $rol       = $_POST['rol'];

	$sql = "SELECT parametros.*
		        FROM   parametros 
		        ORDER BY parametros.nombre";
	//}
	 
	$res = mysql_query($sql);
	$tmp = ""; 

	//if($res) {
	$nf = mysql_num_fields($res);
	$nr = mysql_num_rows($res);
	$tmp .= ($nf+1)."|";
	while($reg = @mysql_fetch_array($res)) {
		for($j=0; $j<$nf; $j++) {
			$tmp .= $reg[$j]."|";
		}
	}
	//}
	
	echo utf8_decode($tmp);

?>