<?php
	define( 'DB_NAME', 'hubemar_new_site' );
	define( 'DB_USER', 'hubemar_simecom' );
	define( 'DB_PASSWORD', '*john.2016*' );
	define( 'DB_HOST', 'nimbus01.superwebhost.com' );	
	$con = @mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
	mysql_select_db(DB_NAME);
	if(!$con) echo "Error de conexion<br>";

	$sql = "SELECT  wp.post_title as Titulo, wp.post_content as Contenido, wpm2.meta_value as Imagen_destacada, LEFT(wp.post_content,1)
			FROM wp_posts wp
			INNER JOIN wp_postmeta wpm  ON (wp.ID = wpm.post_id AND wpm.meta_key = '_thumbnail_id')
			INNER JOIN wp_postmeta wpm2 ON (wpm.meta_value = wpm2.post_id AND wpm2.meta_key = '_wp_attached_file')";

	$res = mysql_query($sql);
	echo "<div id='vistapc'><table> ";
	while($reg = @mysql_fetch_array($res)) {
		if($reg[3]!="[") {
			echo utf8_encode("<tr><td valign='top'><h3>$reg[0]</h3><br>$reg[1]</td><td><img class='inoticias' src='http://hubemar.com/wp-content/uploads/$reg[2]'></td></tr>");
		}
	}
?>