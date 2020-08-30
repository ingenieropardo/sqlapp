<?php
	include("../config/funciones.php");
	conectalocal();
    $filtro = $_POST['filtro'];
    $tmp = ""; 
    if($filtro==""){
        $sql = "SELECT * FROM usuarios ORDER BY nombre;";
        $res = mysql_query($sql);
        while($reg = mysql_fetch_array($res)) {
            for($f=0; $f<8; $f++)
                $tmp .= $reg[$f].";";
        }    
    } else {
        $sql = "SELECT * FROM usuarios WHERE $filtro ORDER BY nombre;";
        $res = mysql_query($sql);
        while($reg = mysql_fetch_array($res)) {
            for($f=0; $f<8; $f++)
                $tmp .= $reg[$f].";";
        }          
    }
	echo $tmp;
?>