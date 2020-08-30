<?php
    function JSONArray($consulta="") {
        $res = mysql_query($consulta);
        $respuesta =  mysql_num_rows($res);
        $json = "[[";

        $nf = mysql_num_fields($res);
        for($j=0; $j<$nf; $j++) {
            $json .= "\"".mysql_field_name($res, $j)."\"";
            if($j<$nf-1) $json .= ",";
        }
        $json .= "],";
        while($reg = @mysql_fetch_array($res)) {
            $c = mysql_num_fields($res);
            $json .= "[";
            for($c=0; $c < count($reg)/2; $c++) {
                $json .= "\"".trim($reg[$c])."\"";
                if(!($c==count($reg)/2-1)) $json .=",";
            }
            if($reg) $json .= "],";
        }
        $json .= "]";
        
        if($respuesta==0)
                return 0;
            else
                return utf8_encode($json);
    }


 function JSONObject($consulta="") {
        $res = mysql_query($consulta);
        $respuesta =  mysql_num_rows($res);
        $campo = [];

        $nf = mysql_num_fields($res);
        for($j=0; $j<$nf; $j++) {
            $campo[$j] = mysql_field_name($res, $j);
        }

        $json = "{\"login\":[";
        $contador = 0;
        while($reg = @mysql_fetch_array($res)) {
            $c = mysql_num_fields($res);
            $json .= "{";
            for($c=0; $c < count($reg)/2; $c++) {
                $json .= "\"".$campo[$c]."\":\"".trim($reg[$c])."\"";
                if(!($c==count($reg)/2-1)) $json .=",";
            }
            if($reg) $json .= "}";
            $contador++;
            if($contador != $respuesta) $json .=",";
        }
        $json .= "],\"success\":\"1\",\"message\":\"success\"}";
        
        if($respuesta==0)
                return "{\"login\":[],\"success\":\"0\",\"message\":\"success\"}";
            else
                return utf8_encode($json);
    }


    header('Access-Control-Allow-Origin: *');
    
    $usuario  = $_POST['usuario'];
    $clave    = md5($_POST['clave']);

    include_once("./config/funciones.php");
    conectalocal();
  
   $sql = "select * from usuariosapp where usuario='$usuario' and clave='$clave' and estado='A'";

   echo JSONObject($sql);

?>