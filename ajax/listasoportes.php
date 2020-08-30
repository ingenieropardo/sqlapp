<?php
	include ("../config/funciones.php");
	conectalocal();
	$modo = $_POST['modo'];
	if(isset($_POST['estado'])) $estado = $_POST['estado'];
	else $estado = "TODOS";

    if($estado=="TODOS") $condicion = " 1 ";
    else $condicion = " estado='$estado'";

	$id = $_POST['id'];
	if($id != 0) $condicion .= " AND idsoporte=$id ";

    $sql = "SELECT * FROM soportes WHERE $condicion ";
    $res = mysql_query($sql);
    $tmp = "";
    $rsql = "";
	while($reg = @mysql_fetch_array($res)) {
		$color = "";
		if($reg[8]=="C") $color = " style='background: #DFF3D5' ";
		$tmp .= "<tr $color>";
		for($j=0; $j<9; $j++) {
			// Modo de Tabla
			if($modo=="Tabla") {
				if($j==0)
					$tmp .= "<td $color' ><button class='btn btn-warning' onclick='vereste($reg[0])'>Ver</button></td>";
				else
					$tmp .= "<td $color>".$reg[$j]."</td>";
			}

			// Modo consulta Query
			if($modo=="Sql") {
				$rsql .= "$reg[$j];";
			}
		}
		$tmp .= "</tr>";
	}	
	
	if($modo=="Tabla") echo utf8_decode($tmp); else echo utf8_decode($rsql);
?>