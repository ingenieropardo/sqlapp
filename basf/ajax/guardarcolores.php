<?php
	include ("../config/funciones.php");
	conectalocal();

	$iniFila  = $_POST['Fila1'];
	$finFila  = $_POST['Fila2'];
	$iniColu  = $_POST['Colu1'];
	$finColu  = $_POST['Colu2'];
	$color    = $_POST['colorcel']; 
	$tmp = "";

	if($color != "") {
		// Convirtiendo a HEX
		if(substr($color, 0,1)=="#") { $colorh = $color; }
	    else {
	    	$c = substr($color, 4, trim(strlen($color)));
			 $rgbarr = explode(",",$c,3);
			 $colorh = sprintf("#%02x%02x%02x", $rgbarr[0], $rgbarr[1], $rgbarr[2]);
	    }		

	    // Actualizando tabla de colores
	    for($fila=$iniFila; $fila<= $finFila; $fila++) {
			for($columna = $iniColu; $columna <= $finColu; $columna++) {
				$colucolor = "c$columna";
				$sql = "UPDATE coloreshex SET $colucolor='$colorh' WHERE c0=$fila";
				$tmp .= "$sql ;";
				mysql_query($sql);
			}
		}
		//mysql_query($tmp);
	}

	echo "$tmp";
?>