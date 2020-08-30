<?php
	include ("../config/funciones.php");
	conectalocal();
	$usuario   = $_POST['usuario'];
    $rol       = $_POST['rol'];
    $verporrol = $_POST['verxrol'];


    $vector = array();
    for($p=0; $p<=150; $p++) $vector[$p] = " ";

    $sq = "SELECT * FROM perfiles WHERE fk_usuario='$usuario'";
    $re = mysql_query($sq);
    $cont = 0;
    while($rg = @mysql_fetch_array($re)) {
    	$cont++;
    	$vector[$rg[2]] = "X";
    }

	$sql = "SELECT parametros.*
	        FROM   parametros 
	        ORDER BY parametros.nombre";

	$res = mysql_query($sql);
	$tmp = ""; 
	$nf = mysql_num_fields($res);
	$nr = mysql_num_rows($res);

	if($verporrol == "ROL") {
			$tmp .= ($nf+4)."|";
			while($reg = @mysql_fetch_array($res)) {
				for($j=0; $j<$nf; $j++) {
					$tmp .= $reg[$j]."|";
				}
				$tmp .= buscarolpar($reg[0],"ROOT")."|";
				$tmp .= buscarolpar($reg[0],"DIRECTIVO")."|";
				$tmp .= buscarolpar($reg[0],"OPERATIVO")."|";
				$tmp .= buscarolpar($reg[0],"CLIENTE")."|";
			}

	} else {
			$tmp .= ($nf+1)."|";
			while($reg = @mysql_fetch_array($res)) {
				for($j=0; $j<$nf; $j++) {
					$tmp .= $reg[$j]."|";
				}
				$tmp .= $vector[$reg[0]]."|";
			}
	}

	//}
	
	echo utf8_decode($tmp);

?>