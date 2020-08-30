<?php
	function saludo() {
		echo "hola mundo";
	}
	
	function perfilusuario($usuario) {
		$sql = "SELECT estado FROM perfil WHERE usuario='$usuario'";
		$res = mysql_query($sql);
		$tmp = "";
		while($reg = @mysql_fetch_array($res)) {
			$tmp .= $reg[0].";";
		}
		return $tmp;
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
   
    function conectalocal() {
		$servidor  = "localhost";

        /*
        $basedatos = "simecomc_basf";
		$usuario   = "simecomc_root";
		$clave     = "Melo241199..*";
		*/
       
		$basedatos = "basf";
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
			case "bitacora"        : $valor = "PROCESOS BASICOS :: KPI BITACORA";                 break;
			case "usuarios"        : $valor = "CONTROL DE USUARIOS";                              break;
			case "retenciones"     : $valor = "INFORMES :: RETENCIONES";                          break;
			case "ingresospropios" : $valor = "INFORMES :: INGRESOS PROPIOS";                     break;
			case "gastosterceros"  : $valor = "INFORMES :: GASTOS TERCEROS POR MES Y AÑO";        break;
			case "savingac"        : $valor = "INFORMES :: SAVING ACUERDOS COMERCIALES";          break;
			case "uap"             : $valor = "INFORMES :: UAP CONSOLIDADO";                      break;
			case "icompensaciones" : $valor = "INFORMES :: INFORME COMPENSACIONES IMPORTACION";   break;
			case "ecompensaciones" : $valor = "INFORMES :: INFORME COMPENSACIONES EXPORTACION";   break;
			case "flete"           : $valor = "INFORMES :: INFORME FLETE EM";                     break;
			case "kpitiempos"      : $valor = "INFORMES :: KPI TIEMPOS";                          break;
			case "infouap"         : $valor = "INFORMES :: INFORMA UAP";                          break;
			case "drop"            : $valor = "INFORMES :: DROP OFF";                             break;
			case "otros"           : $valor = "INFORMES :: OTROS INFORMES";                       break;
			case "cambiopwd"       : $valor = "GESTIONAR CONTRASEÑA";                             break;
			default: $valor = "";
		}
		return($valor);
	}

	function esp($texto, $longitud){
	 if($longitud==0) $longitud=strlen($texto);
	 $res = str_pad($texto,$longitud, " ", STR_PAD_RIGHT);
	 return $res;
	}	

	function rellena($valor, $longitud){
		$res = str_pad($valor, $longitud, '0', STR_PAD_LEFT);
	    return $res;
	}	
?>