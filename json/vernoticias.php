<?php
    header('Access-Control-Allow-Origin: *');
	define( 'DB_NAME', 'hubemar_new_site' );
	define( 'DB_USER', 'hubemar_simecom' );
	define( 'DB_PASSWORD', '*john.2016*' );
	define( 'DB_HOST', 'nimbus01.superwebhost.com' );	
	$con = @mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
	mysql_select_db(DB_NAME);
	if(!$con) echo "Error de conexion<br>";

	$sql = "SELECT  wp.post_title as titulo, wp.post_content as contenido, CONCAT('http://hubemar.com/wp-content/uploads/',wpm2.meta_value) as imagen, 
			   LEFT(wp.post_content,1) as filtro
			FROM wp_posts wp
			INNER JOIN wp_postmeta wpm  ON (wp.ID = wpm.post_id AND wpm.meta_key = '_thumbnail_id')
			INNER JOIN wp_postmeta wpm2 ON (wpm.meta_value = wpm2.post_id AND wpm2.meta_key = '_wp_attached_file')";

	$res = mysql_query($sql);

	echo JSONObject($sql);

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
            
            if($reg[3]!="[") {
            	$json .= "{";
	            for($c=0; $c < count($reg)/2; $c++) {
	                $json .= "\"".$campo[$c]."\":\"".trim($reg[$c])."\"";
	                if(!($c==count($reg)/2-1)) $json .=",";
	            }
                $json .= "}";
	            $contador++;
	            if($contador != $respuesta) $json .=",";
            }
            //if($reg) $json .= "\"vacio\":\"\"}";

        }
        $json .= "],\"success\":\"1\",\"message\":\"success\"}";
       
        if($respuesta==0)
                return "{\"datos\":[],\"success\":\"0\",\"message\":\"success\"}";
            else
                return utf8_encode($json);          
    }
?>