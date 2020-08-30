<style>	
      @media (min-width:50px) and (max-width: 700px)  {
        .inoticias { width: 100%; }
        #vistapc { display: none;  }
        #vistamv { display:  ; }
        #pagina { 
        	margin-left: -60px;
        	margin-right: -60px;
        	margin-top: -60px;

        }
      }
      @media (min-width: 701px) and (max-width: 2400px) {
        .inoticias { width: 400px; }
        #vistapc { display: ;  }
        #vistamv { display: none;  }
        #pagina { 
        	margin: -20px;
        }
      }
     .item   { padding: 10px; text-align: justify; }
	table    { padding: 50px; text-align: justify; }
	table td { padding: 15px }
	img      { border-radius: 5px }
	tr:hover { background: #EEF8FC; box-shadow: 0px 4px #0085ff; 	}
	h3 { color: #0085ff; }
	#pagina {
	    overflow-y: scroll;
	    overflow: hidden;
	    padding: 5px;
	    color: black;
	  } 

	body { font-family: "Arial" }
</style>
<div id="pagina" >
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
	// VISTA PARA COMPUTADORES
	echo "<div id='vistapc'><table> ";
	while($reg = @mysql_fetch_array($res)) {
		if($reg[3]!="[") {
			echo utf8_encode("<tr><td valign='top'><h3>$reg[0]</h3><br>$reg[1]</td><td><img class='inoticias' src='http://hubemar.com/wp-content/uploads/$reg[2]'></td></tr>");
		}
	}
	echo "</table><br></div>";

	$res = mysql_query($sql);

	// VISTA PARA MOVILES Y TABLETAS
	echo "<div id='vistamv'><div class='item'> ";
	while($reg = @mysql_fetch_array($res)) {
		if($reg[3]!="[") {
			echo utf8_encode("<h3>$reg[0]</h3>$reg[1]<br><img class='inoticias' src='http://hubemar.com/wp-content/uploads/$reg[2]'><br><br><br>");
		}
	}
	echo "</div></div>";
	
	echo "<hr>";
?>
</div>