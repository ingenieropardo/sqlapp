<?php

 	function saludo() {
		echo "Hola que mas";
	}

 	function usuarioparama($usuario, $parametro) {
 		conectalocal();
 	}

 	function buscarolpar($idrep, $rol) {
 		conectalocal();
 		$sql = "SELECT * FROM  rolpar WHERE fk_id=$idrep AND rol='$rol'";
 		$res = mysql_query($sql);
 		if($reg = @mysql_fetch_array($res))
 			$tmp = $reg[0];
 		else
 			$tmp = 0;
 		return $tmp;
 	}

 	/* Calcular digito de verificacion */
	function digitoverificacion($_rol) {
	    /* Bonus: remuevo los ceros del comienzo. */
	    while($_rol[0] == "0") {
	        $_rol = substr($_rol, 1);
	    }
	    
	    $factor = 2;
	    $suma = 0;
	    for($i = strlen($_rol) - 1; $i >= 0; $i--) {
	        $suma += $factor * $_rol[$i];
	        $factor = $factor % 7 == 0 ? 2 : $factor + 1;
	    }
	    $dv = 11 - $suma % 11;
	    
	    /* Por alguna razón me daba que 11 % 11 = 11. Esto lo resuelve. */
	    $dv = $dv == 11 ? 0 : ($dv == 10 ? "K" : $dv);
	    return $_rol . "-" . $dv;
	}

	function festvosdiaslab($fechainicial, $fechafinal, $findesemana){

		$fecha1 = strtotime($fechainicial);
		$fecha2 = strtotime($fechafinal);

		$festivosdialab= array('2014-1-1','2014-3-24','2014-4-17','2014-4-18','2014-5-1','2014-6-2','2014-6-23','2014-6-30','2014-8-7','2014-8-18','2014-10-13','2014-11-3','2014-11-17','2014-12-8','2014-12-25','2015-1-1','2015-1-12','2015-3-23','2015-4-2','2015-4-3','2015-5-1','2015-5-18','2015-6-8','2015-6-15','2015-6-29','2015-7-20','2015-8-7','2015-8-17','2015-10-12','2015-11-2','2015-11-16','2015-12-8','2015-12-25','2016-1-1','2016-1-11','2016-3-21','2016-3-24','2016-3-25','2016-5-9','2016-5-30','2016-6-6','2016-7-4','2016-7-20','2016-7-15','2016-10-17','2016-11-7','2016-11-14','2016-12-8','2016-12-25','2017-1-1','2017-1-9','2017-3-20','2017-4-13','2017-4-14','2017-5-1','2017-5-29','2017-6-19','2017-6-26','2017-7-3','2017-7-20','2017-8-7','2017-8-21','2017-10-16','2017-11-6','2017-11-13','2017-12-8','2017-12-25','2018-1-1','2018-8-1','2018-3-19','2018-3-29','2018-3-30','2018-5-1','2018-5-14','2018-6-4','2018-6-11','2018-7-2','2018-7-20','2018-8-7','2018-8-20','2018-10-15','2018-11-5','2018-11-12','2018-12-8','2018-12-25','2018-1-1','2019-1-7','2019-3-25','2019-4-18','2019-4-19','2019-5-1','2019-6-3','2019-6-24','2019-7-1','2019-7-20','2019-8-7','2019-8-19','2019-10-14','2019-11-4','2019-11-11','2019-12-25','2020-1-1','2020-1-6','2020-3-23','2020-4-9','2020-4-10','2020-5-1','2020-5-25','2020-6-15','2020-6-22','2020-6-29','2020-7-20','2020-8-7','2020-8-17','2020-10-12','2020-11-2','2020-11-16','2020-12-8','2020-12-25','2010-1-1','2010-1-11','2010-3-22','2010-4-1','2010-4-2','2010-5-1','2010-5-17','2010-6-7','2010-6-14','2010-7-5','2010-7-20','2010-8-7','2010-8-16','2010-10-18','2010-11-1','2010-11-15','2010-12-8','2010-8-25','2011-1-1','2011-1-10','2011-3-21','2011-3-21','2011-3-22','2011-5-6','2011-6-27','2011-7-4','2011-7-20','2011-8-15','2011-10-17','2011-11-7','2011-11-14','2011-12-8','2012-1-9','2012-3-19','2012-4-5','2012-4-6','2012-5-1','2012-5-21','2012-6-11','2012-6-18','2012-7-2','2012-7-20','2012-8-7','2012-8-20','2012-10-15','2012-11-5','2012-11-12','2012-12-8','2012-12-25','2013-1-1','2013-1-14','2013-3-25','2013-3-28','2013-3-28','2013-3-29','2013-5-1','2013-5-13','2013-6-3','2013-6-10','2013-7-1','2013-7-20','2013-8-7','2013-8-19','2013-10-14','2013-11-4','2013-11-11','2013-11-25');

		$contador = count($festivosdialab);

		$tiempo = 0;

		$solodomingo = 1;
		//$findesemana = 2;
		//$findesemana = 2;

		$diashabiles = 0;
		$diascalendario = 0;
		$diasfestivos = 0;
		$sabadofestivo = 0;
		
		for ($fecha1; $fecha1<=$fecha2 ; $fecha1=strtotime('+1 day'.date('Y-m-d',$fecha1))) { 
			$tiempo = $tiempo + 1;
			$diascalendario = $diascalendario + 1;
			//Validar si solo se descontaran los domingos
			if ($findesemana == $solodomingo) {
				if ((date("w", $fecha1)) == 0) {
					$tiempo = $tiempo - 1;
				}
			//Validar si se descontaran los sabados y domingos
			}/*elseif ($findesemana == $findesemana) {
				if (date("w", $fecha1) == 0 or date("w", $fecha1) == 6) {
					$tiempo = $tiempo - 1;
				}
			}*/
			//Validar días festivos con el array correspondiente a esos días
			for ($i=0; $i < $contador; $i++) { 
				if ($fecha1 == $festivosdialab[$i]) {
					if ($findesemana != 2) {
						//Contar los sabados festivos
						if (date("w", $fecha1) == 6) {
							$sabadofestivo = $sabadofestivo + 1;
						}
					}
					$diasfestivos = $diasfestivos + 1;
				} 
			}	
			$diashabiles = $tiempo;
		}

		return $tiempo;

	}

 	function diasentre($inicial, $final) {
 		$fini = date_create($inicial);
 		$ffin = date_create($final);

 		$resultado = $fini->diff($ffin);
 		$can = $resultado->format("%R%a");
 		return $can;
 	}

 	function festivos(){

 		$diafestivo = array('1/01/2014','24/03/2014','17/04/2014','18/04/2014','1/05/2014','2/06/2014','23/06/2014','30/06/2014','7/08/2014','18/08/2014','13/10/2014','3/11/2014','17/11/2014','8/12/2014','25/12/2014','1/01/2015','12/01/2015','23/03/2015','2/04/2015','3/04/2015','1/05/2015','18/05/2015','8/06/2015','15/06/2015','29/06/2015','20/07/2015','7/08/2015','17/08/2015','12/10/2015','2/11/2015','16/11/2015','8/12/2015','25/12/2015','1/01/2016','11/01/2016','21/03/2016','24/03/2016','25/03/2016','9/05/2016','30/05/2016','6/06/2016','4/07/2016','20/07/2016','15/07/2016','17/10/2016','7/11/2016','14/11/2016','8/12/2016','25/12/2016','1/01/2017','9/01/2017','20/03/2017','13/04/2017','14/04/2017','1/05/2017','29/05/2017','19/06/2017','26/06/2017','3/07/2017','20/07/2017','7/08/2017','21/08/2017','16/10/2017','6/11/2017','13/11/2017','8/12/2017','25/12/2017','1/01/2018','1/08/2018','19/03/2018','29/03/2018','30/03/2018','1/05/2018','14/05/2018','4/06/2018','11/06/2018','2/07/2018','20/07/2018','7/08/2018','20/08/2018','15/10/2018','5/11/2018','12/11/2018','8/12/2018','25/12/2018','1/01/2018','7/01/2019','25/03/2019','18/04/2019','19/04/2019','1/05/2019','3/06/2019','24/06/2019','1/07/2019','20/07/2019','7/08/2019','19/08/2019','14/10/2019','4/11/2019','11/11/2019','25/12/2019','1/01/2020','6/01/2020','23/03/2020','9/04/2020','10/04/2020','1/05/2020','25/05/2020','15/06/2020','22/06/2020','29/06/2020','20/07/2020','7/08/2020','17/08/2020','12/10/2020','2/11/2020','16/11/2020','8/12/2020','25/12/2020','1/01/2010','11/01/2010','22/03/2010','1/04/2010','2/04/2010','1/05/2010','17/05/2010','7/06/2010','14/06/2010','5/07/2010','20/07/2010','7/08/2010','16/08/2010','18/10/2010','1/11/2010','15/11/2010','8/12/2010','25/08/2010','1/01/2011','10/01/2011','21/03/2011','21/03/2011','22/03/2011','6/05/2011','27/06/2011','4/07/2011','20/07/2011','15/08/2011','17/10/2011','7/11/2011','14/11/2011','8/12/2011','9/01/2012','19/03/2012','5/04/2012','6/04/2012','1/05/2012','21/05/2012','11/06/2012','18/06/2012','2/07/2012','20/07/2012','7/08/2012','20/08/2012','15/10/2012','5/11/2012','12/11/2012','8/12/2012','25/12/2012','1/01/2013','14/01/2013','25/03/2013','28/03/2013','28/03/2013','29/03/2013','1/05/2013','13/05/2013','3/06/2013','10/06/2013','1/07/2013','20/07/2013','7/08/2013','19/08/2013','14/10/2013','4/11/2013','11/11/2013','25/11/2013');

 		return $diafestivo;

 	}
 	function listaimportadoresrem() {
 		conectaremoto();
		$sql = "SELECT id_importador, nombre_importador FROM hubemar.importadores ORDER BY nombre_importador";
		$res = mysql_query($sql);
		$lista = "";
		while($reg = @mysql_fetch_array($res)) {
			$lista = "$lista<option value='$reg[0]'>$reg[1]</option>";
		}
		return $lista;
 	}

 	// Crea el encabezado de las tablas de cada reporte en Excel
 	function cabeceraexcel($archivo,$objPHPExcel ){
 			require_once("../config/PHPExcel.php");

            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename=' .$archivo . '.xlsx');
            header('Cache-Control: max-age=0');
            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
            $objWriter->save('php://output');

            return;
 	}

 	//Color encabezado de las tablas de cada reporte en Excel
    function cellColor($cells,$color){
		require_once("../config/PHPExcel.php");

        global $objPHPExcel;
        $objPHPExcel->getActiveSheet()->getStyle($cells)->getFill()
        ->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID,
        'startcolor' => array('rgb' => $color)
    ));
        return;
    }

    function grafica (){
    	echo "<script>
                Excel.run(function (context) {
                var sheet = context.workbook.worksheets.getItem("."CUADRO DE CONTROL".");
                var dataRange = sheet.getRange("."A3:B5".");
                var chart = sheet.charts.add("."Line".", dataRange, "."auto".");

                chart.title.text = "."Sales Data".";
                chart.legend.position = "."right"."
                chart.legend.format.fill.setSolidColor("."white".");
                chart.dataLabels.format.font.size = 15;
                chart.dataLabels.format.font.color = "."black".";

                return context.sync();
            }).catch(errorHandlerFunction);
            </script>";
    }
 	
 	// Crea el encabezado de las tablas de cada reporte en vistas HTML
 	function cabecerahtml( $titulo, $fila, $registros){
			echo "  <link rel='stylesheet' href='../css/pushy.css'>
                <link rel='stylesheet' href='../css/bootstrap.css'>
                <link rel='stylesheet' href='../css/bootstrap.min.css'>
                <link rel='stylesheet' href='../css/bootstrap-responsive.css'>
                <link rel='stylesheet' href='../css/bootstrap-responsive.min.css'>
                <link rel='icon' type='image/jpg' href='../img/logo-hubemar.png' /> 
                <title>$titulo</title>
                <style> 
                    body { font-family: Arial; }

                    thead { background-color: #000099 !important; }
                    th { style='text-align:center; background-color: #000099;color:white; !important ;'}
                    
                    tr:hover { background-color: #E2E2E2; color: #684242;  }
                    #info {
                        width: 99%;
                        height: 82%;
                        overflow-y: scroll;
                        margin: 0px;
                        padding: 5px;
                        border-style: solid;
                        border-color: grey;
                    }
                </style>";
            echo   
                "<center><h3><img style='width: 60px;' src='../img/logo1.png'><br>$titulo</h3>".fechaactual(2)." - $registros</center>
                <div id='info' style='margin-left:15px'>
                    <table border='1' cellpadding='2' class='table table-bordered table-condensed' cellspacing='0'>$fila</table>
                </div>";  		
            return;
 	}

    function conectaremoto() {
		$servidor  = "ib.hubemar.com:3309";
		$basedatos = "hubemar";
		$usuario   = "hubemar18";
		$clave     = "Hube2018Mar.";

		@mysql_set_charset('utf8');

	    $conn = mysql_connect($servidor, $usuario, $clave);
	    mysql_select_db($basedatos) or die("Error de conexion Remota '$servidor'");    	
    }

    function idlog($usu) {
    	conectalocal();
    	$sql = "SELECT * FROM usuariosapp WHERE usuario='$usu'";
    	$tmp = "error";
    	$res = @mysql_query($sql);
    	if($reg = @mysql_fetch_array($res)) {
    		$tmp = $reg[8];
    	} 
    	return "$tmp";
    }
    
    // Elimina Caracteres especiales
    function utfHubemar($entra)
	{
	$traduce=array( 'á' => '&aacute;' , 'é' => '&eacute;' , 'í' => '&iacute;' , 'ó' => '&oacute;' , 'ú' => '&uacute;' , 'ñ' => '&ntilde;' , 'Ñ' => '&Ntilde;' , 'ä' => '&auml;' , 'ë' => '&euml;' , 'ï' => '&iuml;' , 'ö' => '&ouml;' , 'ü' => '&uuml;', '&reg;' => '®', '&copy;' => '©'  );
	$sale=strtr( $entra , $traduce );
	return $sale;
	}

    function conectalocal() {
		$servidor  = "localhost";       
		$basedatos = "bdapp";
		$usuario   = "root";
		$clave     = "";

		@mysql_set_charset('utf8');

	    mysql_connect($servidor, $usuario, $clave);
	    mysql_select_db($basedatos) or die("Error de conexion Local '$servidor'");    	
    }

    function horaAMPM($hora) {
    	$nueva = "";
    	$h = substr($hora,0,2);
    	$t = " AM";
    	if($h>12) { $h -= 12; $t=" PM"; }
    	$m = substr($hora, 2, 3);
    	$nueva = $h.$m.$t;
    	return $nueva;
    }

    function fechaactual($tipo) {
    	$fecha = "";
    	if($tipo==-1) $fecha = @date("Y-m-d","");
    	if($tipo==0) $fecha = @date("Y-m-d",(strtotime ("-6 Hours")));
    	if($tipo==1) $fecha = @date("H:m:s",(strtotime ("-6 Hours")));
    	if($tipo==2) $fecha = @date("Y-m-d H:m:s",(strtotime ("-6 Hours")));
    	if($tipo==3) $fecha = @date("m",(strtotime ("-6 Hours")));

    	return $fecha;
    }

    function creaalerta($usuario, $descripcion) {
    	$fecha = fechaactual(0);
    	$hora  = fechaactual(1);

    	$sql = "INSERT INTO notificaciones(fecha, hora, usuario, descripcion) VALUES ('$fecha','$hora','$usuario','$descripcion')";
    	mysql_query($sql);
    }

    function mensaje($texto, $telefono) {
		$mensaje  = $texto;
		$cel = "57".$telefono;

		$ch = curl_init();
		$url = "http://sistemasmasivos.com/itcloud/api/sendsms/send.php";

		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, "user=jgmo519@hotmail.com&password=-BjmS0OwjZ&SMSText=$mensaje &GSM=$cel");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$respuesta = curl_exec ($ch);    	
    }

	function titulo($opcion) {
		switch ($opcion) {
			case "informeskpi"    : $valor = "INFORMES :: GESTOR DE REPORTES Y KPI";     break;
			case "usuarios"    : $valor = "PARAMETROS :: CONTROL DE USUARIOS";     break;
			case "cambiopwd"    : $valor = "USUARIO :: CAMBIO DE CLAVE";     break;
			case "movil"    : $valor = "INFORMES :: ESTADO DE REGISTRO";     break;
			case "soporte"    : $valor = "SESION :: SOPORTE TECNICO";     break;
			case "noticias"    : $valor = "NOTICIAS :: HUBEMAR";     break;
			default: $valor = "";
		}
		return($valor);
	}

	function esp($texto, $longitud){
	 if($longitud==0) $longitud=strlen($texto);
	 $res = str_pad($texto,$longitud, " ", STR_PAD_RIGHT);
	 return $res;
	}	

	function ListaUsuarios($tipo="") {
		$sql = "";
		if($tipo=="") $sql = "SELECT * FROM usuario ORDER BY apellidos, nombres";
		$res = mysql_query($sql);
		$lista = "";
		while($reg = @mysql_fetch_array($res)) {
			$lista = "$lista<option value='$reg[9]'>$reg[4] $reg[3]</option>";
		}
		return $lista;
	}

	function Listareporte($id="") {
		$sql = "";
		if($tipo=="") $sql = "SELECT * FROM parametros ORDER BY nombre";
		$res = mysql_query($sql);
		$lista = "";
		while($reg = @mysql_fetch_array($res)) {
			$lista = "$lista<option value='$reg[1]'>$reg[2] $reg[3] $reg[4]</option>";
		}
		return $lista;
	}

	function Listaparametros($des="", $regimen="") {
		conectalocal();
		$sql = "";
		if($des!="" && $regimen != 'T') 
			$sql = "SELECT parametros.*, perfiles.* 
					FROM parametros, perfiles
					WHERE parametros.id=perfiles.fk_id 
					  AND perfiles.fk_usuario='$des' 
					  AND parametros.estado='A' 
					  AND parametros.tipo_regimen='$regimen'
					ORDER BY parametros.nombre";
		else 
			$sql = "SELECT * FROM parametros WHERE tipo_regimen='T' ORDER BY nombre ";


		$res = mysql_query($sql);
		$lista = "";
		while($reg = @mysql_fetch_array($res)) {
			$lista = "$lista<option value='$reg[0]'>".utf8_encode($reg[1])."</option>";
		}
		echo $des . " ". $regimen;
		return $lista;
	}

	function Listaimportadores($condicion="1") {
		$sql = "";
		if($des=="") $sql = "SELECT * FROM importadores ORDER BY nombre_importador";
		else $sql = "SELECT * FROM parametros WHERE $condicion ORDER BY nombre_importador";
		$res = mysql_query($sql);
		$lista = "";
		while($reg = @mysql_fetch_array($res)) {
			$lista = "$lista<option value='$reg[0]'>$reg[3]</option>";
		}
		return $lista;
	}

	function listar($poscod=0, $posvalor=1,$consulta,$objeto=0) {
		$res = mysql_query($consulta);
		$lista = "";
		while($reg = @mysql_fetch_array($res)) {
			if($objeto==0)
				$lista = "$lista<option value='$reg[$poscod]'>$reg[$posvalor]</option>";
			if($objeto==1)
				$lista = "$lista<option value='$reg[$poscod]'>$reg[$posvalor]</option>";

		}
		return $lista;	
	}
	
	function rellena($valor, $longitud){
		$res = str_pad($valor, $longitud, '0', STR_PAD_LEFT);
	    return $res;
	}	

 	//
 	function cabeceratxt($file, $txt){
     		header('Content-type: application/msword');
            header('Content-Disposition: inline; filename='. $file.'.txt'); 
            echo $txt;
            return;

 	}
?>