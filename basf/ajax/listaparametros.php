<?php
	include("../config/funciones.php");
	conectalocal();
    $pusuario = $_POST['pusuario'];
    $tmp = "";
    if($pusuario!=""){
        $sql = "SELECT * FROM bitacora";
        $res = mysql_query($sql);
        $nr = mysql_num_rows($res);
        $nf = mysql_num_fields($res);
        for($j=0; $j<$nf; $j++) {
            $tmp .= mysql_field_name($res, $j).";";
        } 
        
        $sql = "SELECT estado FROM perfil WHERE usuario='$pusuario'";
        $res = mysql_query($sql);
        while ($reg = @mysql_fetch_array($res)) {
            $tmp .= $reg[0].";";         
        }
        
    }
	echo $tmp;
?>