<?php
    header('Access-Control-Allow-Origin: *');
    
    $usuario  = $_POST['usuario'];
    $clave    = md5($_POST['clave']);
    $tipopet  = $_POST['tipopet']; // Movil PC

    include_once("./config/funciones.php");
    conectalocal();
  
   $sql = "select * from usuariosapp where usuario='$usuario' and clave='$clave' and estado='A'";
//   $sql = "select * from usuariosapp where estado='A'";
    $res = mysql_query($sql);
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
        $json .= "],";
    }
    $json .= "]";
    
    if($respuesta==0)
            echo 0;
        else
            echo utf8_encode($json);

?>