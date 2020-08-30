<?php
    include_once("../config/funciones.php");
    conectaremoto();

    function JSONObject($consulta="") {
        $res = mysql_query($consulta);
        $respuesta =  mysql_num_rows($res);
        $campo = [];

        $nf = mysql_num_fields($res);
        for($j=0; $j<$nf; $j++) {
            $campo[$j] = mysql_field_name($res, $j);
        }

        $json = "{\"datos\":[";
        $contador = 0;
        while($reg = @mysql_fetch_array($res)) {
            $c = mysql_num_fields($res);
            $json .= "{";
            for($c=0; $c < count($reg)/2; $c++) {
                $json .= "\"".$campo[$c]."\":\"".trim($reg[$c])."\"";
                if(!($c==count($reg)/2-1)) $json .=",";
            }
            if($reg) $json .= "\"vacio\":\"\"}";
            $contador++;
            if($contador != $respuesta) $json .=",";
        }
        $json .= "],\"success\":\"1\",\"message\":\"success\"}";
       
        if($respuesta==0)
                return "{\"datos\":[],\"success\":\"0\",\"message\":\"success\"}";
            else
                return utf8_encode($json);          
    }

    if(isset($_POST['condicion'])) {
        $condicion = "WHERE nombre_importador LIKE '%$condicion%'";
    } else 
        $condicion = "";
    $sql = "SELECT id_importador, nombre_importador FROM importadores";

    echo JSONObject($sql);
 
?>