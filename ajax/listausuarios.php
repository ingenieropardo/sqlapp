<?php
	include ("../config/funciones.php");
	conectalocal();
	if(isset($_POST['filtro']))   $filtro    = $_POST['filtro'];  else  $filtro = "" ;
    if(isset($_POST['rol']))      $rol       = $_POST['rol'];     else  $rol = "0";
    if (isset($_POST['usuario'])) $usuario   = $_POST['usuario']; else	$usuario = "";

    $sql = "";

    
    if($usuario=="") {
		if($filtro=="" && $rol=="0") 
			$sql = "SELECT * FROM usuariosapp ORDER BY nombre";

		if($filtro!="" && $rol =="0") {
			$condicion = "(nombre like '%$filtro%' || usuario like '%$filtro%')";
			$sql = "SELECT * FROM usuariosapp WHERE $condicion ORDER BY nombre";
		}
		if($filtro=="" && $rol !="0") {
			$condicion = "rol='$rol'";
			$sql = "SELECT * FROM usuariosapp WHERE $condicion ORDER BY nombre";
		}
		if($filtro!="" && $rol !="0") {
			$condicion = "(nombre like '%$filtro%' || usuario like '%$filtro%') AND rol='$rol'";
			$sql = "SELECT * FROM usuariosapp WHERE $condicion ORDER BY nombre";
		}

    } else {
    	$sql = "SELECT * FROM usuariosapp WHERE consec=$usuario";
    }

	
	$tmp = "";
	if($sql != "") {
		$res = mysql_query($sql);
		
		$tmp = ""; $nf = mysql_num_fields($res);
		$nr = mysql_num_rows($res);
		while($reg = @mysql_fetch_array($res)) {
			for($j=0; $j<$nf; $j++) {
				$tmp .= $reg[$j]."|";
			}
		}
	}
	echo utf8_encode($tmp);

?>