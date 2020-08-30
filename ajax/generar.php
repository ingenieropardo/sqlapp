<?php
	$tipo         = $_POST['p_tipo'];
	
	//  Parametros Basicos
	$sucursal     = $_POST['p_sucursal']; 
	$importador   = $_POST['p_importador']; 
	$ejecutivo    = $_POST['p_ejecutivo'];
	$reporte      = $_POST['p_reporte'];
	
	// Informacion Especifica
	$numerodo     = $_POST['p_numerodo'];
	$numeroped    = $_POST['p_numeroped'];
	$ordencompra  = $_POST['p_ordencompra'];
	$numeroacep   = $_POST['p_numeroacep'];
	
	// Modalidad Aduanera
	$modalidad    = $_POST['p_modalidad'];
	
	// Filtros para informe
	$faperturai   = $_POST['p_faperturai'];
	$faperturaf   = $_POST['p_faperturaf'];
	$flevantei    = $_POST['p_flevantei'];
	$flevantef    = $_POST['p_flevantef'];
	$faceptai     = $_POST['p_faceptai'];
	$faceptaf     = $_POST['p_faceptaf'];
	$fmercanciai  = $_POST['p_fmercanciai'];
	$fmercanciaf  = $_POST['p_fmercanciaf'];
	$fretiroi     = $_POST['p_fretiroi'];
	$fretirof     = $_POST['p_fretirof'];
	$fstickeri    = $_POST['p_fstickeri'];
	$fstickerf    = $_POST['p_fstickerf'];
	$ffacturai    = $_POST['p_ffacturai'];
	$ffacturaf    = $_POST['p_ffacturaf']; 

	$param_fecha="";

	// Filtros de Fecha
	if($faperturai<>"")   $param_fecha .="AND (ED.FECHA_APERTURA     >= '$faperturai 00:00:00'  AND  ED.FECHA_APERTURA    <= '$faperturaf 23:59:59') ";
	if($flevantei<>"")    $param_fecha .="AND (FD.FECHA_LEVANTE      >= '$flevantei 00:00:00'   AND  FD.FECHA_LEVANTE     <= '$flevantef 23:59:59') ";
	if($faceptai<>"")     $param_fecha .="AND (FD.FECHA_ACEPTACION   >= '$faceptai 00:00:00'    AND  FD.FECHA_ACEPTACION  <= '$faceptaf 23:59:59') ";
	if($fmercanciai<>"")  $param_fecha .="AND (IM.FECHA_LIBERACION   >= '$fmercanciai 00:00:00' AND  IM.FECHA_LIBERACION  <= '$fmercanciaf 23:59:59') ";
	if($fretiroi<>"")     $param_fecha .="AND (IM.FECHA_RETIRO_TOTAL >= '$fretiroi 00:00:00'    AND  IM.FECHA_LIBERACION  <= '$fretirof 23:59:59') ";
	if($fstickeri<>"")    $param_fecha .="AND (FD.FECHA_PAGO         >= '$fstickeri 00:00:00'   AND  FD.FECHA_PAGO        <= '$fstickerf 23:59:59') ";
	if($ffacturai<>"")    $param_fecha .="AND (ED.FECHA_FACTURA      >= '$ffacturai 00:00:00'   AND  ED.FECHA_FACTURA     <= '$ffacturaf 23:59:59') ";


	include("../config/funciones.php");
	conectaremoto();

	//echo "No. Reporte $reporte Tipo $tipo";
    $sql = "";
	switch ($reporte) {
		case "1":
			// Dim - Reporte de Tributos por DIM
       		$sql  = "SELECT 	DATE_FORMAT(FD.FECHA_ACEPTACION, '%Y') ANIO, DATE_FORMAT(FD.FECHA_ACEPTACION, '%m') MES, 
       				  			FD.NUMERO_FORMULARIO_DI, FD.FECHA_ACEPTACION, ED.NUMERO_DO, ED.NUMERO_PEDIDO, ED.FECHA_APERTURA, 
       				  			SC.NOMBRE_SEGMENTO, I.NUMERO_IDENTIFICACION, I.NOMBRE_IMPORTADOR, A.NOMBRE_ADMINISTRACION,  
								EM.NUMERO_IDENTIFICACION, EM.NOMBRE_PERSONA, CF.NUMERO_FACTURA FACTURA,CF.FECHA_FACTURA,
								CF.NUMERO_LISTA_EMPAQUE,  CF.CODIGO_CONDICION_ENTREGA, EX.NOMBRE_EXPORTADOR, FD.PESO_NETO, 
								FD.PESO_BRUTO,FD.VALOR_TOTAL_FOB, FD.VALOR_ADUANA VALOR_CIF, ED.TRM,  
									DT.FECHA_DOC_TRANS,DT.NUMERO_DOC_TRANS, DT.FECHA_MANIFIESTO, DT.NUMERO_MANIFIESTO, 
								FD.NUMERO_STICKER, FD.FECHA_PAGO, TD.NOMBRE_TIPO_DECLARACION DIM, FD.SELECTIVIDAD, FD.VALOR_TOTAL_FOB, 
								FD.VALOR_FLETES, FD.VALOR_SEGUROS, FD.VALOR_OTROS_GASTOS, FD.AJUSTE_VALOR, FD.VALOR_ADUANA ,
 								FD.PORCENTAJE_ARANCEL, FD.BASE_ARANCEL, FD.TOTAL_ARANCEL, FD.PORCENTAJE_IVA, FD.BASE_IVA, FD.TOTAL_IVA, FD.TOTAL_LIQUIDADO, 
								FD.NUMERO_LEVANTE, FD.FECHA_LEVANTE, IF(INSTR(FD.NUMERO_ACEPTACION,'M')=0,'SIGLO XXI','MANUAL') TRAMITE_REALIZADO_POR, I.CODIGO_UAP, 
								FD.NUMERO_ACEPTACION, FD.FORMULARIO_FISICO, FD.FECHA_ACEPTACION, IM.FECHA_RETIRO_TOTAL, FD.CODIGO_MODALIDAD, FD.CODIGO_POSICION, 
								CP.CODIGO_UNIDAD_CCIAL_DIAN, FD.CANTIDAD, FD.BULTOS, FD.NUMERO_REG_LICENCIA, FD.PROGRAMA_AUTORIZADO, FD.CIP,
								PA.NOMBRE_PAIS C46, PA1.NOMBRE_PAIS C47, FD.CODIGO_REG_LICENCIA C48, FD.NUMERO_REG_LICENCIA C49, FD.CODIGO_ACUERDO C50 , 
								NULL DESCRIPCION, IM.CODIGO_DEPOSITO, T.NOMBRE_TRANSPORTADOR
					FROM 		HUBEMAR.FORMULARIOS_DIS FD 
					LEFT OUTER JOIN HUBEMAR.POSICION_ARANCELARIA CP  ON CP.CODIGO_POSICION         = FD.CODIGO_POSICION 
				    LEFT OUTER JOIN HUBEMAR.ESTADOS_DO ED            ON ED.NUMERO_DO               = FD.NUMERO_DO   
				    LEFT OUTER JOIN HUBEMAR.IMPORTACIONES IM         ON IM.NUMERO_DO               = FD.NUMERO_DO   
				    LEFT OUTER JOIN HUBEMAR.ADMINISTRACIONES A       ON IM.CODIGO_ADMINISTRACION   = A.CODIGO_ADMINISTRACION   
				    LEFT OUTER JOIN HUBEMAR.CABEZA_FACTURAS CF       ON CF.ID_CABEZA_FACTURA       = FD.ID_CABEZA_FACTURA   
				    LEFT OUTER JOIN HUBEMAR.EXPORTADORES EX          ON EX.ID_EXPORTADOR           = CF.ID_EXPORTADOR   
				    LEFT OUTER JOIN HUBEMAR.IMPORTADORES I           ON ED.ID_IMPORTADOR           = I.ID_IMPORTADOR   
				    LEFT OUTER JOIN HUBEMAR.EMPLEADOS EM             ON EM.ID_EMPLEADO             = FD.ID_DECLARANTE   
				    LEFT OUTER JOIN HUBEMAR.SEGMENTOS_CLIENTES SC    ON ED.ID_SEGMENTO_CLIENTE     = SC.ID_SEGMENTO_CLIENTE   
				    LEFT OUTER JOIN HUBEMAR.DOCUMENTOS_TRASPORTE DT  ON FD.NUMERO_DO               = DT.NUMERO_DO   
				    LEFT OUTER JOIN HUBEMAR.TRASPORTADORES         T ON T.CODIGO_TRANSPORTADOR     = DT.CODIGO_TRANSPORTADOR   
				    LEFT OUTER JOIN HUBEMAR.TIPOS_DECLARACION TD     ON FD.CODIGO_TIPO_DECLARACION = TD.CODIGO_TIPO_DECLARACION   
					LEFT OUTER JOIN HUBEMAR.PAISES PA 	 			 ON PA.CODIGO_PAIS             = EX.CODIGO_PAIS   
					LEFT OUTER JOIN HUBEMAR.PAISES PA1 				 ON PA1.CODIGO_PAIS            = FD.CODIGO_PAIS_ORIGEN 
					WHERE ED.ANULADO='N'  AND  ED.TIPO_REGIMEN='I'  AND ED.ID_IMPORTADOR='$importador'  
					$param_fecha   
					ORDER BY ED.NUMERO_DO, FD.NUMERO_FORMULARIO_DI
				";    
			break;
		default:
	} // Fin switch

	$tmp = ""; 
    $nr=0;
		
	if($reporte!= 0) {
		$res =  mysql_query($sql);
		if(!empty($res)) {
			$tmp = ""; 
			$nr = mysql_num_rows($res);
			$nf = mysql_num_fields($res);
			for($j=0; $j<$nf; $j++) {
				$tmp .= mysql_field_name($res, $j)."|";
			}
			while($reg = @mysql_fetch_array($res)) {
				for($j=0; $j<$nf; $j++) {
					$tmp .= $reg[$j]."|";
				}
			}


		header('Content-type: application/vnd.ms-excel');
		header("Content-Disposition: attachment; filename=kpiexcel.xls");
		header("Pragma: no-cache");
		header("Expires: 0");
		$can   = $_GET['can'];
		$datos = $_GET['datos'];
		?>
		<table border="1" cellpadding="2" cellspacing="0">
		    <tr>
		        <td bgcolor="#D0D0D0">Datos111</td>
		        <td><?php echo $datos;?></td>
		        <td>Datos33</td>
		    </tr>
		    <tr>
		        <td>Datos</td>
		        <td>Datos</td>
		        <td>Datos</td>
		    </tr>
		    <tr>
		        <td>Datos</td>
		        <td>Datos</td>
		        <td>Datos</td>
		    </tr>
		</table> <?php

		}
		if($nr==0) $tmp = "0";
		echo $tmp;
	}	
?>

