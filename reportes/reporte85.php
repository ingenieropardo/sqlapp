<?php

    include("../config/funciones.php");
    require_once("../config/PHPExcel.php");
    $tipo = $_GET['p_tipo']; 
    $sucursal     = $_GET['p_sucursal']; 
    $importador   = $_GET['p_importador']; 
    $tercero      = $_GET['p_tercero']; 
    $ejecutivo    = $_GET['p_ejecutivo'];
    $reporte      = $_GET['p_reporte'];
    $numerodo     = $_GET['p_numerodo'];
    $numeroped    = $_GET['p_numeroped']; 
    $ordencompra  = $_GET['p_ordencompra'];
    $doctrans     = $_GET['p_doctrans'];
    $modalidad    = $_GET['p_modalidad'];
    $faperturai   = $_GET['p_faperturai'];
    $faperturaf   = $_GET['p_faperturaf'];
    $flevantei    = $_GET['p_flevantei'];
    $flevantef    = $_GET['p_flevantef'];
    $faceptai     = $_GET['p_faceptai'];
    $faceptaf     = $_GET['p_faceptaf'];
    $fmercanciai  = $_GET['p_fmercanciai'];
    $fmercanciaf  = $_GET['p_fmercanciaf'];
    $fretiroi     = $_GET['p_fretiroi'];
    $fretirof     = $_GET['p_fretirof'];
    $fstickeri    = $_GET['p_fstickeri'];
    $fstickerf    = $_GET['p_fstickerf'];
    $ffacturai    = $_GET['p_ffacturai'];
    $ffacturaf    = $_GET['p_ffacturaf'];

    // Filtro de Fechas
    $param_fecha="";
    // Titulo del reporte
    $titulo="INDICADOR EXPORTACIONES";
    // Nombre del archivo 
    $archivo="INDICADOREXPO";
    $registros = "";

    // Estilo para titulos del repoorte en excel
    $estiloTituloReporte = array(
        'font' => array(
        'name'      => 'Verdana',
        'bold'      => true,
        'italic'    => false,
        'strike'    => false,
        'size' =>16,
        'color'     => array(
            'rgb' => 'FFFFFF'
        )
    ),
    'fill' => array(
      'type'  => PHPExcel_Style_Fill::FILL_SOLID,
      'color' => array(
            'rgb' => '000090')
    ),
    'borders' => array(
        'allborders' => array(
            'style' => PHPExcel_Style_Border::BORDER_NONE
        )
    ),
    'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
        'rotation' => 0,
        'wrap' => TRUE
    )
    );

    // Estilo para contenido de filas
    $estiloInformacion  = array(
    'font' => array(
        'name'  => 'Arial',
        'bold'  => false,
        'color' => array(
            'rgb' => '000000'
        )
    ),
    'borders' => array(
        'top' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN ,
            'color' => array(
                'rgb' => '000000'
            )
        ),
        'left' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN ,
            'color' => array(
                'rgb' => '000000'
            )
        ),
        'right' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN ,
            'color' => array(
                'rgb' => '000000'
            )
        ),
        'bottom' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN ,
            'color' => array(
                'rgb' => '000000'
            )
        )
    ) ,
    'alignment' =>  array(
        'wrap'      => TRUE
    ) 
    );

    // Estilo para contenido de filas
    $estiloInformacionC  = array(
    'font' => array(
        'name'  => 'Arial',
        'bold'  => false,
        'color' => array(
            'rgb' => '000000'
        )
    ),
    'borders' => array(
        'top' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN ,
            'color' => array(
                'rgb' => '000000'
            )
        ),
        'left' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN ,
            'color' => array(
                'rgb' => '000000'
            )
        ),
        'right' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN ,
            'color' => array(
                'rgb' => '000000'
            )
        ),
        'bottom' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN ,
            'color' => array(
                'rgb' => '000000'
            )
        )
    ) ,
    'alignment' =>  array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
    ) 
    );

    // Estilo para contenido de filas
    $estiloInformacionD  = array(
    'font' => array(
        'name'  => 'Arial',
        'bold'  => false,
        'color' => array(
            'rgb' => '000000'
        )
    ),
    'borders' => array(
        'top' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN ,
            'color' => array(
                'rgb' => '000000'
            )
        ),
        'left' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN ,
            'color' => array(
                'rgb' => '000000'
            )
        ),
        'right' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN ,
            'color' => array(
                'rgb' => '000000'
            )
        ),
        'bottom' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN ,
            'color' => array(
                'rgb' => '000000'
            )
        )
    ) ,
    'alignment' =>  array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT
    ) 
    );
  
    // Estilo para columnas
    $estiloTituloColumnas= array(
    'font' => array(
        'name'      => 'Verdana',
        'bold'      => true,
        'italic'    => false,
        'strike'    => false,
        'size' =>10,
        'color'     => array(
            'rgb' => 'FFFFFF'
        )
    ),
    'fill' => array(
      'type'  => PHPExcel_Style_Fill::FILL_SOLID,
      'color' => array(
      'argb' => '000090')
    ),
    'borders' => array(
        'left' => array(
        'style' => PHPExcel_Style_Border::BORDER_THIN ,
        'color' => array(
        'rgb' => '3a2a47'
            )
        )
    )
    ,
    'alignment' =>  array(
        'horizontal'=> PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        'vertical'  => PHPExcel_Style_Alignment::VERTICAL_CENTER, 
        'wrap'      => TRUE
    ) 
    );

    $columnas = array ( 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'AA', 'AB', 'AC', 'AD', 'AE', 'AF', 'AG', 'AH', 'AI', 'AJ', 'AK', 'AL', 'AM', 'AN', 'AO', 'AP', 'AQ', 'AR', 'AS', 'AT', 'AU', 'AV', 'AW', 'AX', 'AY', 'AZ', 'BA', 'BB', 'BC', 'BD', 'BE', 'BF', 'BG', 'BH', 'BI', 'BJ', 'BK', 'BL', 'BM', 'BN', 'BO', 'BP', 'BQ', 'BR', 'BS', 'BT', 'BU', 'BV', 'BW', 'BX', 'BY', 'BZ', 'CA', 'CB', 'CC', 'CD', 'CE', 'CF', 'CG', 'CH', 'CI', 'CJ', 'CK', 'CL', 'CM', 'CN', 'CO', 'CP', 'CQ', 'CR', 'CS', 'CT', 'CU', 'CV', 'CW', 'CX', 'CY', 'CZ', 'DA', 'DB', 'DC', 'DD', 'DE', 'DF', 'DG', 'DH', 'DI', 'DJ', 'DK', 'DL', 'DM', 'DN', 'DO', 'DP', 'DQ', 'DR', 'DS', 'DT', 'DU', 'DV', 'DW', 'DX', 'DY', 'DZ', 'EA', 'EB', 'EC', 'ED', 'EE', 'EF', 'EG', 'EH', 'EI', 'EJ', 'EK', 'EL', 'EM', 'EN', 'EO', 'EP', 'EQ', 'ER', 'ES', 'ET', 'EU', 'EV', 'EW', 'EX', 'EY', 'EZ', 'FA', 'FB', 'FC', 'FD', 'FE', 'FF', 'FG', 'FH', 'FI', 'FJ', 'FK', 'FL', 'FM', 'FN', 'FO', 'FP', 'FQ', 'FR', 'FS', 'FT', 'FU', 'FV', 'FW', 'FX', 'FY', 'FZ');

    $dimensionCol = array (14.57,  17,  37.71,  10.71,  10.71,  35.43,  52.29,  27.57,  10.71,  21.57,  10.71,  10.71,  13.86,  27.57,  16.43,  16.43,  14.57,  13.86,  13.86,  24.71,  13.86,  13.86,  13.86,  13.86,  27.57,  21.29,  21.29,  21.29,  10.71,  21.29,  21.29,  21.29,  10.71,  10.71,  21.29,  21.29,  21.29,  10.71,  27,  22.71,  13.29,  13.29,  13.29,  13.29,  15,  13.71,  10.71,  20.43,  20.43,  20.43,  20.43,  13.57,  13.57,  15.14,  10.71,  10.71,  10.71,  10.71,  10.71,  47.86);


    $tipodato= array('T','T','T','T','T','T','T','T','D','T','D','D','D','T','D','D','D','D','D','T','D','D','D','N','T','T','T','T','D','T','T','T','D','N','T','T','T','N','T','T','N','N','N','N','N','N','T','T','T','T','T','D','T','D','T','N','T','T','D','T');

    $calendario_festivo=festivos();

    if($numerodo=="" && $numeroped=="" && $ordencompra=="" && $doctrans=="" ){

        $filtros = " WHERE ED.ANULADO='N' AND ED.TIPO_REGIMEN='E'";

        if($sucursal  !="0") $filtros .= " AND ED.CODIGO_SUCURSAL_OP='$sucursal' ";
        if($importador!="0") $filtros .= " AND ED.ID_IMPORTADOR='$importador' ";
        if($tercero!="0") $filtros  .= " AND ED.ID_TERCERO='$tercero' ";
        if($ejecutivo!="0") $filtros  .= " AND ED.ID_EMPLEADO_OP='$ejecutivo' ";

        if($faperturai<>"")   $param_fecha .="AND (ED.FECHA_APERTURA     >= '$faperturai 00:00:00'  AND  ED.FECHA_APERTURA    <= '$faperturaf 23:59:59') ";

        if($flevantei<>"")    $param_fecha .="AND (E.FECHA_DEX        >= '$flevantei 00:00:00'   AND  E.FECHA_DEX     <= '$flevantef 23:59:59') ";
        if($faceptai<>"")     $param_fecha .="AND (E.FECHA_AUT_EMBARQUE   >= '$faceptai 00:00:00'    AND  E.FECHA_AUT_EMBARQUE  <= '$faceptaf 23:59:59') ";
        if($fmercanciai<>"")  $param_fecha .="AND (VM.FECHA_ETA   >= '$fmercanciai 00:00:00' AND  VM.FECHA_ETA  <= '$fmercanciaf 23:59:59') ";
        if($fretiroi<>"")     $param_fecha .="AND (DT.FECHA_CARGUE_EN_PLANTA >= '$fretiroi 00:00:00'    AND  DT.FECHA_CARGUE_EN_PLANTA  <= '$fretirof 23:59:59') ";
        if($fstickeri<>"")    $param_fecha .="AND (E.FECHA_ZARPE         >= '$fstickeri 00:00:00'   AND  E.FECHA_ZARPE        <= '$fstickerf 23:59:59') ";
        if($ffacturai<>"")    $param_fecha .="AND (ED.FECHA_FACTURA      >= '$ffacturai 00:00:00'   AND  ED.FECHA_FACTURA     <= '$ffacturaf 23:59:59') ";
    }    else {
        
        if($numerodo!=""){
            $filtros= " WHERE ED.NUMERO_DO='$numerodo'";
        } 

        if($$numeroped!=""){
            $filtros= " WHERE ED.NUMERO_PEDIDO='$numeroped'";
        } 

        if($ordencompra!=""){
            $filtros= " WHERE ED.NUMERO_ORDEN_COMPRA='$ordencompra'";
        } 

        if($doctrans!=""){
            $filtros= " WHERE DT.NUMERO_DOC_TRANS='$doctrans'";
        } 
    }
    
    conectaremoto();

    // Dim - Reporte de Tributos por DIM
    $sql  = "SELECT ED.NUMERO_DO,
                ED.NUMERO_PEDIDO,
                I.NOMBRE_IMPORTADOR 'IMPORTADOR',
                DT.CODIGO_CONDICION_ENTREGA 'INCOTERM',
                ED.CODIGO_SUCURSAL_OP 'SUCURSAL',
                EE.NOMBRE_PERSONA 'EJECUTIVO',
                UCASE(EX.NOMBRE_EXPORTADOR) 'EXPORTADOR',


                CASE DATE_FORMAT(ED.FECHA_APERTURA, '%m') WHEN '01' Then 'Enero'  WHEN '02' Then 'Febrero'
                 WHEN '03' Then 'Marzo' WHEN '04' Then 'Abril' WHEN '05' Then 'Mayo' WHEN '06' Then 'Junio'
                 WHEN '07' Then 'Julio' WHEN '08' Then 'Agosto' WHEN '09' Then 'Septiembre'
                 WHEN '10' Then 'Octubre' WHEN '11' Then 'Noviembre' WHEN '12' Then 'Diciembre' END AS 'MES APERTURA',

                DATE_FORMAT(ED.FECHA_APERTURA,'%d/%m/%Y') 'FECHA APERTURA' ,


                CASE DATE_FORMAT(VM.FECHA_ETA, '%m') WHEN '01' Then 'Enero'  WHEN '02' Then 'Febrero'
                 WHEN '03' Then 'Marzo' WHEN '04' Then 'Abril' WHEN '05' Then 'Mayo' WHEN '06' Then 'Junio'
                 WHEN '07' Then 'Julio' WHEN '08' Then 'Agosto' WHEN '09' Then 'Septiembre'
                 WHEN '10' Then 'Octubre' WHEN '11' Then 'Noviembre' WHEN '12' Then 'Diciembre' END AS 'MES ETA',

                VM.FECHA_ETA 'FECHA ETA',
                VM.CUT_OFF_FISICO 'CUT OFF FISICO' ,
                VM.CUT_OFF_DOCUMENTAL 'CUT OFF DOCUMENTAL',
                DT.NUMERO_DOCUMENTO_TRANSPORTE 'NRO BL',
                DATE_FORMAT(DT.FECHA_DOCUMENTO_TRANSPORTE, '%d/%m/%Y') 'FECHA BL',
                DATE_FORMAT(DT.FECHA_RECIBO_BL_AGENCIA, '%d/%m/%Y') 'FECHA RECIBO BL AA',
                DATE_FORMAT(DT.FECHA_ENVIO_BL_CLIENTE, '%d/%m/%Y') 'FECHA ENVIO BL CLIENTE',
                DATE_FORMAT(DT.FECHA_RECIBO_FACTURA, '%d/%m/%Y') 'FECHA RECIBO FACTURA',
                DATE_FORMAT(CO.FECHA_RADICACION, '%d/%m/%Y') 'FECHA RADICACION',
                CO.NUMERO_CERTIFICADO  'NRO CERTIFICADO',
                DATE_FORMAT(CO.FECHA_ELABORACION, '%d/%m/%Y') 'FECHA ELABORACION CO',
                DATE_FORMAT(CO.FECHA_APROBACION, '%d/%m/%Y')  'FECHA APORBACION CO',
                DATE_FORMAT(CO.FECHA_ENTREGA_CLIENTE, '%d/%m/%Y') 'FECHA ENTREGA CLIENTE',
                DATEDIFF( CO.FECHA_ENTREGA_CLIENTE, DT.FECHA_RECIBO_FACTURA) TIEMPO,
                UPPER(DT.BOOKING_NUMBER) 'NRO BOOKING',
                VM.NUMERO_VIAJE 'NRO VIAJE',
                VM.NOMBRE_VAPOR 'MOTONAVE',
                VM.UVI 'NRO UVI',
                DATE_FORMAT(E.FECHA_DEX, '%d/%m/%Y') 'FECHA DEX',
                GROUP_CONCAT(DISTINCT SAU.NUMERO_DEX) DEX,
                GROUP_CONCAT(DISTINCT SAU.ID_DOCUMENTO_MUISCA) SAE,


                CASE DATE_FORMAT(E.FECHA_ZARPE, '%m') WHEN '01' Then 'Enero'  WHEN '02' Then 'Febrero'
                 WHEN '03' Then 'Marzo' WHEN '04' Then 'Abril' WHEN '05' Then 'Mayo' WHEN '06' Then 'Junio'
                 WHEN '07' Then 'Julio' WHEN '08' Then 'Agosto' WHEN '09' Then 'Septiembre'
                 WHEN '10' Then 'Octubre' WHEN '11' Then 'Noviembre' WHEN '12' Then 'Diciembre' END AS 'MES ZARPE',

                DATE_FORMAT(E.FECHA_ZARPE, '%d/%m/%Y') 'FECHA ZARPE',
                DATEDIFF( DT.FECHA_ENVIO_BL_CLIENTE, E.FECHA_ZARPE) ZARPE_ENVIO_BL,
                DT.CODIGO_PAIS,
                UPPER(PA.NOMBRE_PAIS) PAIS,
                UPPER(AI.NOMBRE_LUGAR_EMBAR_ARRIB_INAL) 'LUGAR DE ARRIBO',
                DT.PESO_NETO 'PESO NETO',
                CASE UC.CARGA_EN_CONTENEDOR WHEN '1' THEN 'CARGA SUELTA' WHEN '2' THEN 'CONTENEDORIZADA'   WHEN '3' THEN  'GRANEL' WHEN '4' THEN 'MIXTA' WHEN '5' THEN  'ISOTANQUE'  when '6' THEN 'FLEXITANQUE' END AS 'TIPO CARGA',

                GROUP_CONCAT( DISTINCT CONCAT( UC.NUMERO_ID_CONTENEDOR, ' '))  'NRO CONTENEDORES',
                IF(UC.TAMANO=1, COUNT(DISTINCT UC.NUMERO_ID_CONTENEDOR), 0) C20,
                IF(UC.TAMANO=2, COUNT(DISTINCT UC.NUMERO_ID_CONTENEDOR), 0) HC,
                IF(UC.TAMANO=3, COUNT(DISTINCT UC.NUMERO_ID_CONTENEDOR), 0) C40,
                IF(UC.TAMANO=5, COUNT(DISTINCT UC.NUMERO_ID_CONTENEDOR), 0) C45,

                CR.CANTIDAD 'CANTIDAD CONTENEDORES',
                DT.VALOR_FACTURA_USD 'VALOR FACTURA',
                DT.PROGRAMAS_PLAN_VALLEJO 'PLAN VALLEJO',
                A.NOMBRE_ADMINISTRACION 'ADMINISTRACION',
                UPPER(LT.NOMBRE_LINEA_TRANSPORTADOR) 'LINEA',
                UPPER(T.NOMBRE_TRANSPORTADOR) 'TRANSPORTADOR',


                CASE DATE_FORMAT(RD.FECHA_ELABORACION_RESERVA, '%m') WHEN '01' Then 'Enero'  WHEN '02' Then 'Febrero'
                 WHEN '03' Then 'Marzo' WHEN '04' Then 'Abril' WHEN '05' Then 'Mayo' WHEN '06' Then 'Junio'
                 WHEN '07' Then 'Julio' WHEN '08' Then 'Agosto' WHEN '09' Then 'Septiembre'
                 WHEN '10' Then 'Octubre' WHEN '11' Then 'Noviembre' WHEN '12' Then 'Diciembre' END AS 'MES RESERVA',

                DATE_FORMAT(RD.FECHA_ELABORACION_RESERVA, '%d/%m/%Y') 'FECHA ELABORACION RESERVA',


                CASE DATE_FORMAT(RD.FECHA_RESERVA, '%m') WHEN '01' Then 'Enero'  WHEN '02' Then 'Febrero'
                 WHEN '03' Then 'Marzo' WHEN '04' Then 'Abril' WHEN '05' Then 'Mayo' WHEN '06' Then 'Junio'
                 WHEN '07' Then 'Julio' WHEN '08' Then 'Agosto' WHEN '09' Then 'Septiembre'
                 WHEN '10' Then 'Octubre' WHEN '11' Then 'Noviembre' WHEN '12' Then 'Diciembre' END AS 'MES APROBACION',

                DATE_FORMAT(RD.FECHA_RESERVA, '%d/%m/%Y') 'FECHA RESERVA',


                IF(E.FECHA_ZARPE IS NOT NULL, 'Si','No') Zarpo,
                DATEDIFF(RD.FECHA_RESERVA, RD.FECHA_ELABORACION_RESERVA) TIEMPO,
                DT.ES_CARGA_PELIGROSA 'IMO',
                ED.NUMERO_FACTURA 'FACTURA AA',
                DATE_FORMAT(ED.FECHA_FACTURA, '%d/%m/%Y') 'FECHA FACTURA AA',
                GROUP_CONCAT( DISTINCT CONCAT(CID.FECHA_MODIFICACION, ' -> RESPONSABLE: ', C.ENTIDAD, ' :', C.DESCRIPCION) ) CAUSAL

            FROM  EXPORTACIONES     E
                INNER JOIN ESTADOS_DO ED ON ED.NUMERO_DO=E.NUMERO_DO
                INNER JOIN IMPORTADORES                   I   ON I.ID_IMPORTADOR=ED.ID_IMPORTADOR
                INNER JOIN documentos_transportes_expos   DT  ON DT.NUMERO_DO=ED.NUMERO_DO

                LEFT OUTER JOIN EX_SOLICITUDES_AUT_EMBARQUES SAU ON SAU.NUMERO_DO=ED.NUMERO_DO

                LEFT OUTER JOIN facturas_exportaciones         CF  ON CF.NUMERO_DO=ED.NUMERO_DO
                LEFT OUTER JOIN reservas_contenedores_dos      RD  ON RD.NUMERO_DO=ED.NUMERO_DO  AND RD.ANULADO='N'

                LEFT OUTER JOIN EXPORTADORES                   EX  ON EX.ID_EXPORTADOR=DT.ID_EXPORTADOR
                LEFT OUTER JOIN VIAJES_MOTONAVES              VM ON VM.ID_VIAJE_MOTONAVE=DT.ID_VIAJE_MOTONAVE
                LEFT OUTER JOIN TRASPORTADORES                T  ON T.CODIGO_TRANSPORTADOR=VM.CODIGO_TRANSPORTADOR
                LEFT OUTER JOIN LINEAS_TRANSPORTADORES LT ON LT.ID_LINEA_TRANSPORTADOR=VM.ID_LINEA_TRANSPORTADOR
                LEFT OUTER JOIN ex_paises                         PA ON PA.CODIGO_PAIS=DT.CODIGO_PAIS
                LEFT OUTER JOIN EMPLEADOS     EE   ON EE.ID_EMPLEADO=ED.ID_EMPLEADO_OP
                LEFT OUTER JOIN ADMINISTRACIONES     A   ON DT.CODIGO_ADMINISTRACION=A.CODIGO_ADMINISTRACION
                LEFT OUTER JOIN CONTENEDORES_RESUMIDOS CR ON CR.NUMERO_DO=ED.NUMERO_DO AND CODIGO_TIPO_UNIDAD_CARGA='2'
                LEFT OUTER JOIN certificados_origen_expos CO ON CO.ID_DOCUMENTO_TRANSPORTE_EXPO=DT.ID_DOCUMENTO_TRANSPORTE_EXPO
                LEFT OUTER JOIN ex_lugares_embar_arrib_inales     AI  ON AI.CODIGO_LUGAR_EMBAR_ARRIB_INAL=DT.CODIGO_LUGAR_EMBAR_ARRIB_INAL

                RIGHT OUTER JOIN UNIDADES_CARGA UC ON UC.NUMERO_DO=ED.NUMERO_DO
                LEFT OUTER JOIN CAUSAL_INCUMPLIMIENTO_DO   CID   ON CID.NUMERO_DO=ED.NUMERO_DO
                LEFT OUTER JOIN CAUSAL_INCUMPLIMIENTO      C     ON C.ID_CAUSAL_INCUMPLIMIENTO=CID.ID_CAUSAL_INCUMPLIMIENTO

      $filtros  
      $param_fecha

      GROUP BY ED.NUMERO_DO 
      ORDER BY ED.NUMERO_DO, VM.FECHA_ETA
    ";      

    $tmp = ""; 
    $nr=0;
    $res =  mysql_query($sql);
    $fila = "<tr>";
    $txt = "";

    // Contruir archivo excel
    if($tipo=="XLS"){
        $objPHPExcel = new PHPExcel();

        // Establecer propiedades
        $objPHPExcel->getProperties()
        ->setCreator($archivo."XLS")
        ->setLastModifiedBy("HUBEMAR")
        ->setTitle($archivo);

        //Insertar imagen en archivo excel con PhpExcel
        $objDrawing = new PHPExcel_Worksheet_Drawing();
                    $objDrawing->setName('imgNotice');
                    $objDrawing->setDescription('Noticia');
                    $img = '../img/logo1.png'; 
                    $objDrawing->setPath($img);
                    $objDrawing->setOffsetX(70);    
                    $objDrawing->setOffsetY(5);  
                    $objDrawing->setCoordinates('U1');
                    $objDrawing->setHeight(100); 
                    $objDrawing->setWorksheet($objPHPExcel->setActiveSheetIndex(0));

        // Fijar titulo del informe y quitar lineas de division 
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue("A2", $titulo)
                    ->setShowGridlines(false)
                    ->setTitle($titulo);

        // Ancho de la fila
        $objPHPExcel->getActiveSheet()->getRowDimension(1)->setRowHeight( 80 );
        
        // Agregar nueva hoja a excel [festivos]
        $objPHPExcel->createSheet(1)
        ->setTitle('FESTIVOS');
      //Agregar matriz de fechas a celdas excel
        $contador = count($calendario_festivo);
        for ($i=0; $i < $contador; $i++) { 
            $objPHPExcel->setActiveSheetIndex(1)->setCellValue('A'.$i, $calendario_festivo[$i]) ;
        } 

        // Ocultar la hoja festivos
        $objPHPExcel->getSheetByName('FESTIVOS')->setSheetState(PHPExcel_Worksheet::SHEETSTATE_HIDDEN);
    }

    if($tipo=="XLS" || $tipo=="TXT" || $tipo=="HTML") {
        if(!empty($res)) {
            $tmp = ""; 
            $nr = mysql_num_rows($res);
            
            $registros = " Registros $nr";
            $nf = mysql_num_fields($res);

            //TITULOS DE CABECERA
            for($j=0; $j<$nf; $j++) {
                $fila .= "<th style='background-color: #000099;color:white;'>".mysql_field_name($res, $j)."</th>";
               
                "</th>";
                $txt .= mysql_field_name($res, $j)." ";
                $campo=mysql_field_name($res, $j);

               // Cabecera para archivos de excel
               if($tipo=="XLS"){
                    $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue( $columnas[$j]."3", $campo);

                    // Autoajuste
                    $objPHPExcel->getActiveSheet()->getColumnDimension($columnas[$j])->setWidth($dimensionCol[$j]); 
              
                    $objPHPExcel->getActiveSheet()->getStyle($columnas[$j] . '3' )->applyFromArray($estiloTituloColumnas);
               }
            }
            
            if($tipo=="XLS"){

                // Combinar celdas para titulo
                $objPHPExcel->setActiveSheetIndex(0)->mergeCells("A2:".$columnas[$j-1]."2");
                $objPHPExcel->getActiveSheet()->getStyle("A2:".$columnas[$nf-1]."2")->applyFromArray($estiloTituloReporte);
                // Marcar autofiltros en excel 
                $objPHPExcel->getActiveSheet()->setAutoFilter("A3:" . $columnas[$nf-1] . "3");
                // Inmovilizar paneles
                $objPHPExcel->getActiveSheet()->freezePane('A4');
            }

            $txt .=PHP_EOL;
            $fila .= "</tr>";
            $rawdata = array(); $i=0;
            $sw=0;

            //LECTURA QUERY Y FORMATEO DE CELDAS
            $filaexcel=4;
            while($reg = @mysql_fetch_array($res)) {
                $fila .= "<tr>";
                $rawdata[$i] = $reg;

                for($j=0; $j<$nf; $j++) {

                    // Escritura en excel    
                    if($tipo=="XLS"){

                        $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue( $columnas[$j] . $filaexcel, utf8_decode($reg[$j]));

                        // Dibujar bordes en excel
                        $objPHPExcel->getActiveSheet()->getStyle( $columnas[$j] .$filaexcel )->applyFromArray($estiloInformacion);

                        switch($tipodato[$j]) {
                            case "N":
                                {
                                    $objPHPExcel->getActiveSheet()->getStyle( $columnas[$j] .$filaexcel )->applyFromArray($estiloInformacionD);

                                    $objPHPExcel->getActiveSheet()->getStyle( $columnas[$j] .$filaexcel)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);                                 
                                    break;
                                }
                            case "D":
                                {
                                    $objPHPExcel->getActiveSheet()->getStyle( $columnas[$j] .$filaexcel )->applyFromArray($estiloInformacionC);

                                    $objPHPExcel->getActiveSheet()->getStyle($columnas[$j] .$filaexcel)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_YYYYMMDDSLASH);

                                }
                            case "T":
                                {
                                    $objPHPExcel->getActiveSheet()->getStyle( $columnas[$j] .$filaexcel )->applyFromArray($estiloInformacion);
                                     $objPHPExcel->getActiveSheet()->getStyle( $columnas[$j] .$filaexcel)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);

                                    break;
                                }
                            default:
                            {
                                    $objPHPExcel->getActiveSheet()->getStyle( $columnas[$j] .$filaexcel )->applyFromArray($estiloInformacion);
                                    $objPHPExcel->getActiveSheet()->getStyle( $columnas[$j] .$filaexcel)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);

                                    break;
                            }
                        }

                                           
                    } else {
                    
                      $txt .= $reg[$j]." ";
                      switch($tipodato[$j]) {
                          case "T":
                          {  
                              $fila .=  "<td style= mso-number-format:'@';>". utf8_decode($reg[$j])."</td>";
                               break;
                          }                        
                          case "N":
                          {  
                              $fila .=  "<td align='right'>". $reg[$j]."</td>";
                               break;
                          }    

                          case "D":
                          {  
                              $fila .=  "<td align='center'>". $reg[$j]."</td>";
                               break;
                          }    

                          default:
                          {  
                              $fila .= "<td align='left'>". utf8_decode($reg[$j])."</td>";
                               break;
                          }
                      }
                    } // Fin Else ($tipo=="XLS"
                }
                $filaexcel = $filaexcel + 1 ;
                $i+=1;
                $txt  .= PHP_EOL;
                $fila .= "</tr>";
            }
        }  

        $tabla = "<table border='1' cellpadding='2' cellspacing='0'>$fila</table>";
    }
    
    switch ($tipo) {   
        case 'TXT':
            cabeceratxt($archivo, $txt);
            break;         
        case 'XLS':
            cabeceraexcel($archivo, $objPHPExcel);

            break;
        case 'HTML':
            cabecerahtml($titulo, $fila, $registros);
    
            break;
        case 'PDF':
            // INICIO DE PDF -------------------------------------------------------
            require('fpdf.php');
            $nr = mysql_num_rows($res);
            
            $grosor = 6*$nr+60;
            $pdf = new FPDF('L', 'mm', array(3320,$grosor));

            $pdf->AliasNbPages();            
            $pdf->SetY(-12);
            $pdf->SetFont('helvetica','',8);
            $pdf->Cell(0,10,' Pagina '.($pdf->PageNo()+1).' de {nb}',0,0,'C');
            $pdf->Image('../img/logo1.png',12,12,10);
            $pdf->Cell(15); $pdf->Cell(0,9,'HUBEMAR SAS',0,1,'');
            $pdf->SetFont('helvetica','B',9);
            $pdf->Cell(15); $pdf->Cell(0,0,$titulo,0,1,'');
            $pdf->Ln(0);

            $pdf->SetFont('helvetica','',10);
            $pdf->Cell(1,1,'',0,1,'L');
            $pdf->SetTextColor(0,0,0);
            $pdf->SetFont('helvetica','',8); 
            $pdf->SetDrawColor(180,180,180);
            $pdf->Cell(3); 
            $pdf->Cell(1,5,"",0,1,'L');
            $pdf->Cell(3,6,"",0,0,"C");
            $pdf->SetFillColor(180,180,180); 
            $ancho = 6;
            $tmp = ""; 
            
            $registros = "(No. Registros $nr)";

            $nf = mysql_num_fields($res);
            $pdf->Cell(5,6,"No.",1,0,"C",true);
            $c = array();
            
            // Personalizado
            $c[0] = 50; $c[1] = 50; $c[2] = 30; $c[3] = 30; $c[4] = 100; $c[5] = 40;  $c[6] = 40; 
            $c[7] = 60;  $c[8] = 60; $c[9] = 30;

            for($j=0; $j<$nf; $j++) {
                $campo = mysql_field_name($res, $j)." ";
                $pdf->Cell($c[$j],6,$campo,1,0,"C",true);
            }
            $pdf->Ln(); $pdf->Cell(3,$ancho,"",0,0,"C"); 
            $i=0;
            while($reg = @mysql_fetch_array($res)) {
                $i++;
                $pdf->Cell(5,6,$i,1,0,"C",true);
                for($j=0; $j<$nf; $j++) {
                    $pdf->Cell($c[$j],$ancho,$reg[$j],1,0,'L');
                }
                $pdf->Ln(); $pdf->Cell(3,$ancho,"",0,0,"C"); 
            }  
            $pdf->Output();     
           // FIN PDF -------------------------------------------------------------
            break;
        default:
          break;
    }
?>