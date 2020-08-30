<?php
	include ("../config/funciones.php");
	conectaremoto();
	$filtro = $_POST['filtro'];
	$sql = "SELECT UPPER(EMP.NOMBRE_PERSONA), EMP.ID_EMPLEADO FROM USUARIOS U 
            LEFT OUTER JOIN EMPLEADOS EMP ON U.NUMERO_IDENTIFICACION=EMP.NUMERO_IDENTIFICACION
			WHERE  EMP.NOMBRE_PERSONA LIKE '%$filtro%' OR EMP.NOMBRE_PERSONA LIKE UPPER('%$filtro%') 
			ORDER BY EMP.NOMBRE_PERSONA";
	$res = mysql_query($sql);
	$tmp = "";
	while($reg = @mysql_fetch_array($res)) {
		$tmp .= "$reg[0] - $reg[1]\n";
	}

	echo "Resultado de busqueda...\n".$tmp;
?>