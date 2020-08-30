<?php
	include("../config/funciones.php");
	conectalocal();
    $pusuario = $_POST['pusuario'];
    $tmp = "";
    if($pusuario==""){
        $sql = "SELECT * FROM ingpropios";
        $res = mysql_query($sql);
        while($reg = mysql_fetch_array($res)) {
            for($f=0; $f<7; $f++)
                $tmp .= $reg[$f].";";
        }    
    }
	echo $tmp;
?>