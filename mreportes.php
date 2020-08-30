<?php
    include_once("./config/funciones.php");
    //conectalocal();
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

    header('Access-Control-Allow-Origin: *');
    
    $usuario      = $_POST['usuario'];
    $clave        = md5($_POST['clave']);
    $tipo         = $_POST['p_tipo']; // NUMERO DE REPORTE
    $sucursal     = $_POST['p_sucursal']; 
    $importador   = $_POST['p_importador']; 
    $ejecutivo    = $_POST['p_ejecutivo'];
    $reporte      = $_POST['p_reporte'];
    $numerodo     = $_POST['p_numerodo'];
    $numeroped    = $_POST['p_numeroped']; 
    $ordencompra  = $_POST['p_ordencompra'];
    $numeroacep   = $_POST['p_numeroacep'];
    $modalidad    = $_POST['p_modalidad'];
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
    
    // -------------------------------------------- REPORTE 1 -----------------------------------------------------------------------------------------------
	if($tipo==1) {
		if($faperturai<>"")   $param_fecha .="AND (ED.FECHA_APERTURA     >= '$faperturai 00:00:00'  AND  ED.FECHA_APERTURA    <= '$faperturaf 23:59:59') ";
        if($flevantei<>"")    $param_fecha .="AND (FD.FECHA_LEVANTE      >= '$flevantei 00:00:00'   AND  FD.FECHA_LEVANTE     <= '$flevantef 23:59:59') ";
        if($faceptai<>"")     $param_fecha .="AND (FD.FECHA_ACEPTACION   >= '$faceptai 00:00:00'    AND  FD.FECHA_ACEPTACION  <= '$faceptaf 23:59:59') ";
        if($fmercanciai<>"")  $param_fecha .="AND (IM.FECHA_LIBERACION   >= '$fmercanciai 00:00:00' AND  IM.FECHA_LIBERACION  <= '$fmercanciaf 23:59:59') ";
        if($fretiroi<>"")     $param_fecha .="AND (IM.FECHA_RETIRO_TOTAL >= '$fretiroi 00:00:00'    AND  IM.FECHA_LIBERACION  <= '$fretirof 23:59:59') ";
        if($fstickeri<>"")    $param_fecha .="AND (FD.FECHA_PAGO         >= '$fstickeri 00:00:00'   AND  FD.FECHA_PAGO        <= '$fstickerf 23:59:59') ";
        if($ffacturai<>"")    $param_fecha .="AND (ED.FECHA_FACTURA      >= '$ffacturai 00:00:00'   AND  ED.FECHA_FACTURA     <= '$ffacturaf 23:59:59') ";
        
        $sql  = "SELECT     DATE_FORMAT(FD.FECHA_ACEPTACION, '%Y') ANIO, DATE_FORMAT(FD.FECHA_ACEPTACION, '%m') MES, 
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
            FROM        HUBEMAR.FORMULARIOS_DIS FD 
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
            LEFT OUTER JOIN HUBEMAR.PAISES PA                ON PA.CODIGO_PAIS             = EX.CODIGO_PAIS   
            LEFT OUTER JOIN HUBEMAR.PAISES PA1               ON PA1.CODIGO_PAIS            = FD.CODIGO_PAIS_ORIGEN 
            WHERE ED.ANULADO='N'  AND  ED.TIPO_REGIMEN='I'  AND ED.ID_IMPORTADOR='$importador'  
            $param_fecha   
            ORDER BY ED.NUMERO_DO, FD.NUMERO_FORMULARIO_DI
        ";     
        
        echo JSONObject($sql);
    }
  
    // -------------------------------------------- REPORTE 2 -----------------------------------------------------------------------------------------------
	if($tipo==67) {
     if($numerodo=="" && $numeroped=="" && $ordencompra=="") {
        if($faperturai<>"")   $param_fecha .="AND (ED.FECHA_APERTURA     >= '$faperturai 00:00:00'  AND  ED.FECHA_APERTURA    <= '$faperturaf 23:59:59') ";
        if($flevantei<>"")    $param_fecha .="AND (FD.FECHA_LEVANTE      >= '$flevantei 00:00:00'   AND  FD.FECHA_LEVANTE     <= '$flevantef 23:59:59') ";
        if($faceptai<>"")     $param_fecha .="AND (FD.FECHA_ACEPTACION   >= '$faceptai 00:00:00'    AND  FD.FECHA_ACEPTACION  <= '$faceptaf 23:59:59') ";
        if($fmercanciai<>"")  $param_fecha .="AND (IM.FECHA_LIBERACION   >= '$fmercanciai 00:00:00' AND  IM.FECHA_LIBERACION  <= '$fmercanciaf 23:59:59') ";
        if($fretiroi<>"")     $param_fecha .="AND (IM.FECHA_RETIRO_TOTAL >= '$fretiroi 00:00:00'    AND  IM.FECHA_LIBERACION  <= '$fretirof 23:59:59') ";
        if($fstickeri<>"")    $param_fecha .="AND (FD.FECHA_PAGO         >= '$fstickeri 00:00:00'   AND  FD.FECHA_PAGO        <= '$fstickerf 23:59:59') ";
        if($ffacturai<>"")    $param_fecha .="AND (ED.FECHA_FACTURA      >= '$ffacturai 00:00:00'   AND  ED.FECHA_FACTURA     <= '$ffacturaf 23:59:59') ";
        $filtros =" WHERE ED.ANULADO='N' AND ED.TIPO_REGIMEN='I' $param_fecha ";
    } 

    if($importador!="0") $filtros .= " AND ED.ID_IMPORTADOR='$importador' ";

        $sql = "SELECT CD.PROFIT_CENTER NUMERO_VIN, LEFT(CD.INFO_ADICIONAL, 30) BANCO, FD.NUMERO_STICKER, DATE_FORMAT(FD.FECHA_PAGO,'%Y%m%d') FPAGO, CD.CENTRO_COSTO_GAMA CIUDAD, CD.CENTRO_COSTO_GAMA CIUDAD, 
        FD.NUMERO_ACEPTACION, DATE_FORMAT(FD.FECHA_ACEPTACION,'%Y%m%d') FACEPTACION, FD.NUMERO_LEVANTE, DATE_FORMAT(FD.FECHA_LEVANTE,'%Y%m%d') FLEVANTE, FD.NUMERO_REG_LICENCIA, DATE_FORMAT(FD.FECHA_REGISTRO_IMPO,'%Y%m%d') FAPROBACION,  
        M.LINEA_PRODUCCION , T.NOMBRE_TRANSPORTADOR, PS.NOMBRE_PAIS 
        FROM DETALLES_FACTURAS M 
        LEFT OUTER JOIN PAISES PS   ON PS.CODIGO_PAIS=M.CODIGO_PAIS_ORIGEN 
        LEFT OUTER JOIN FORMULARIOS_DIS FD ON M.ID_FORMULARIO_DI  = FD.ID_FORMULARIO_DI 
        LEFT OUTER JOIN complemento_detalle_factura cd ON M.ID_DETALLE_FACTURA  = CD.ID_DETALLE_FACTURA 
        LEFT OUTER JOIN ESTADOS_DO ED ON ED.NUMERO_DO = FD.NUMERO_DO 
        LEFT OUTER JOIN IMPORTACIONES IM ON IM.NUMERO_DO = FD.NUMERO_DO 
        LEFT OUTER JOIN DOCUMENTOS_TRASPORTE DT  ON DT.NUMERO_DO = ED.NUMERO_DO 
        LEFT OUTER JOIN TRASPORTADORES T   ON T.CODIGO_TRANSPORTADOR=DT.CODIGO_TRANSPORTADOR
        $filtros        
        "; 
        
        echo JSONObject($sql);
	}

?>