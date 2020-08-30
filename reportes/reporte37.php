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
    $titulo="CONTROL KPI";
    // Nombre del archivo 
    $archivo="CONTROL_KPI";
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

    $dimensionCol = array (15, 11, 15, 17, 40.29, 57, 41.29, 26.43, 64.57, 26.43, 33.43, 15,  15, 15, 15, 16.71,  16.71, 15, 15, 18, 18, 15, 19.29, 15, 36.29, 15, 15, 15, 15, 15, 15, 15, 15, 15, 15, 15, 15, 15, 15, 15, 15,  15, 15, 15, 15, 15, 14, 15, 11, 14, 15, 15, 15);


    $tipodato= array('T','T','T','T','T','T','T','T','T','T','T','D','D','N','N','D','D','D','D','N','N','T','N','D','T','N','N','D','N','N','N','D','N','N','D','N','D','N','N','N','N','N','N','N','N','N','T','N','D','D','N','T','N');

    $calendario_festivo=festivos();

    if($numerodo=="" && $numeroped=="" && $ordencompra=="" && $doctrans=="" ){

        $filtros = " WHERE ED.ANULADO='N' AND ED.TIPO_REGIMEN='I'";

        if($sucursal  !="0") $filtros .= " AND ED.CODIGO_SUCURSAL_OP='$sucursal' ";
        if($importador!="0") $filtros .= " AND ED.ID_IMPORTADOR='$importador' ";
        if($tercero!="0") $filtros  .= " AND ED.ID_TERCERO='$tercero' ";
        if($ejecutivo!="0") $filtros  .= " AND ED.ID_EMPLEADO_OP='$ejecutivo' ";

        if($faperturai<>"")   $param_fecha .="AND (ED.FECHA_APERTURA     >= '$faperturai 00:00:00'  AND  ED.FECHA_APERTURA    <= '$faperturaf 23:59:59') ";
        if($flevantei<>"")    $param_fecha .="AND (IM.FECHA_LEVANTE      >= '$flevantei 00:00:00'   AND  IM.FECHA_LEVANTE     <= '$flevantef 23:59:59') ";
        if($faceptai<>"")     $param_fecha .="AND (IM.FECHA_ACEPTACION   >= '$faceptai 00:00:00'    AND  IM.FECHA_ACEPTACION  <= '$faceptaf 23:59:59') ";
        if($fmercanciai<>"")  $param_fecha .="AND (IM.FECHA_LIBERACION   >= '$fmercanciai 00:00:00' AND  IM.FECHA_LIBERACION  <= '$fmercanciaf 23:59:59') ";
        if($fretiroi<>"")     $param_fecha .="AND (IM.FECHA_RETIRO_TOTAL >= '$fretiroi 00:00:00'    AND  IM.FECHA_RETIRO_TOTAL  <= '$fretirof 23:59:59') ";
        if($fstickeri<>"")    $param_fecha .="AND (IM.FECHA_PAGO         >= '$fstickeri 00:00:00'   AND  IM.FECHA_PAGO        <= '$fstickerf 23:59:59') ";
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
    $sql  = "SELECT ED.NUMERO_DO 'NUMERO DO',

      CASE DATE_FORMAT(IM.FECHA_LEVANTE, '%m') WHEN '01' Then 'Ene'  WHEN '02' Then 'Feb' WHEN '03' Then 'Mar' WHEN '04' Then 'Abr' WHEN '05' Then 'May' WHEN '06' Then 'Jun' WHEN '07' Then 'Jul' WHEN '08' Then 'Ago' WHEN '09' Then 'Sep' WHEN '10' Then 'Oct' WHEN '11' Then 'Nov' WHEN '12' Then 'Dic' END AS 'MES DE LEVANTE',

      ED.NUMERO_PEDIDO 'PEDIDO', 
      DATE_FORMAT(ED.FECHA_APERTURA,'%d/%m/%Y') 'FECHA APERTURA',
      I.NOMBRE_IMPORTADOR 'CLIENTE', 
      E.NOMBRE_PERSONA 'EJECUTIVO',
      EA.NOMBRE_PERSONA 'ANALISTA', 
      A.NOMBRE_SUCURSAL 'ADMINISTRACIÓN', 
      UCASE(LEFT(TRIM(ED.DESCRIPCION),250))  'PRODUCTO',
      MR.NOMBRE_MODALIDAD 'MODALIDAD', 
      ETD.NOMBRE_ETAPA 'ETAPA ACTUAL', 
      DATE_FORMAT(IM.FECHA_LLEGADA_MCIA,'%Y/%m/%d') 'FECHA LLEGADA', 
      DATE_FORMAT(IM.FECHA_DOCUMENTOS_OK_CLIENTE,'%Y/%m/%d') 'DOC OK CLIENTE', 
      NULL 'ETA VS DOC OK CLIENTE', 
      NULL 'CUMPLIDO CLIENTE', 
      DATE_FORMAT(IM.FECHA_MANIFIESTO,'%d/%m/%Y') 'FECHA MANIFIESTO', 
      DATE_FORMAT(IM.FECHA_ARBOL_DOCUMENTOS,'%d/%m/%Y') 'FECHA DOCUMENTOS', 
      DATE_FORMAT(IM.FECHA_DOCS_OK,'%d/%m/%Y') 'FECHA DOCS OK', 
      DATE_FORMAT(IM.FECHA_LEVANTE,'%d/%m/%Y') 'FECHA LEVANTE', 
      IF(A.NOMBRE_SUCURSAL='BOGOTA', I.NAL_BOG, I.NAL_PUERTOS) 'DIAS NAL', 
      NULL 'MANIFIESTO VS LEVANTE', 
      NULL 'DOC OK VS LEVANTE', 
      NULL 'CUMPLIDO NAL', 
      DATE_FORMAT(IM.FECHA_DOCS_TRANSPORTADOR,'%d/%m/%Y') 'DOCS TRANSPORTADOR', 
      IM.EMPRESA_TRANSPORTE 'EMPRESA TRANSPORTE', 
      NULL 'ENTREGA TRANS VS LEVANTE',
      NULL 'CUMPLIDO TRANS',
      DATE_FORMAT(IM.FECHA_RETIRO_TOTAL,'%d/%m/%Y') 'RETIRO TOTAL',  
      NULL 'ENTREAGA A TRANS VS RETIRO', 
      NULL 'CUMPLIDO RETIRO', 
      IF(ED.ID_MODALIDAD=32, 1, I.DIAS_ENVIO_FACTURAR)'DIAS FACTURAR', 
      DATE_FORMAT(IM.FECHA_ENVIADO_FACTURAR,'%d/%m/%Y') 'ENVIADO FACTURAR', 
      NULL 'RETIRO VS ENVIADO A FACTURAR', 
      NULL 'CUMPLIDO ENVIADO A FACTURAR', 
      DATE_FORMAT(IF(A.NOMBRE_SUCURSAL='CARTAGENA',IM.FECHA_RECEPCION_FACTURACION,IM.FECHA_ENVIADO_FACTURAR ), '%d/%m/%Y') 'ENVIADO FACTURAR REAL',
      NULL 'ENVIADO A FACTURAR VS RECEPCION FACTURA', 
      DATE_FORMAT(ED.FECHA_FACTURA,'%d/%m/%Y') 'FECHA FACTURA', 
      NULL 'FECHA RECEPCION FACTURAR VS FECHA FACTURAR', 
      NULL 'RETIRO VS FECHA FACTURA', 
      NULL 'CUMPLIDO FACTURACIÓN', 
      NULL 'ENVIADO FACTURAR VS FECHA FACTURA', 
      NULL 'CUMPLIDO CONTABILIDAD', 
      NULL 'TIEMPO TOTAL', 
      COUNT( DISTINCT FD.ID_FORMULARIO_DI) 'DECLARACIONES', 
      COUNT( DISTINCT FVA.ID_FORMULARIO_DVA) 'DEC VALOR', 
      COUNT( DISTINCT CF.ID_CABEZA_FACTURA) 'FACTURAS', 
      COUNT( DISTINCT DF.ID_DETALLE_FACTURA)  'ITEMS', 
      GROUP_CONCAT( DISTINCT CONCAT(CID.FECHA_MODIFICACION, ' -> RESPONSABLE: ', C.ENTIDAD, ' :', C.DESCRIPCION) ) CAUSAL,
      DATE_FORMAT(IM.FECHA_SOLICITUD_REGISTRO_IMPORTACION ,'%d/%m/%Y') 'SOLICITUD REGISTRO IMPORTACION', 
      DATE_FORMAT(IM.FECHA_RADICACION_REGISTRO_IMPORTACION,'%d/%m/%Y') 'RADICACION REGISTRO IMPORTACION', 
      ED.TRM 'TRM', 
      IF(ED.NUMERO_FACTURA<>'', 'S', 'N') 'NUMERO FACTURA', 
      NULL 'ENTREAGA TRANS VS LLEGADA MERCANCIA'

      FROM ESTADOS_DO    ED

      INNER JOIN IMPORTACIONES                  IM      ON IM.NUMERO_DO=ED.NUMERO_DO
      INNER JOIN IMPORTADORES                   I       ON I.ID_IMPORTADOR=ED.ID_IMPORTADOR
      INNER JOIN SUCURSALES                     A       ON A.CODIGO_SUCURSAL=ED.CODIGO_SUCURSAL_CO
      INNER JOIN EMPLEADOS                      E       ON E.ID_EMPLEADO=ED.ID_EMPLEADO_OP
      INNER JOIN EMPLEADOS                      EA      ON EA.ID_EMPLEADO=ED.ID_EMPLEADO_DIGITA
      INNER JOIN MODALIDADES_REGIMENES          MR      ON MR.ID_MODALIDAD=ED.ID_MODALIDAD
      INNER JOIN ETAPAS_DO                      ETD     ON ETD.ID_ETAPA_DO=ED.ID_ETAPA_DO

      LEFT OUTER JOIN FORMULARIOS_DIS           FD      ON FD.NUMERO_DO         = ED.NUMERO_DO
      LEFT OUTER JOIN DETALLES_FACTURAS         DF      ON DF.ID_FORMULARIO_DI=FD.ID_FORMULARIO_DI
      LEFT OUTER JOIN CABEZA_FACTURAS           CF      ON CF.NUMERO_DO         = ED.NUMERO_DO
      LEFT OUTER JOIN FORMULARIOS_DVA           FVA     ON FVA.NUMERO_DO= ED.NUMERO_DO
      LEFT OUTER JOIN CAUSAL_INCUMPLIMIENTO_DO  CID     ON CID.NUMERO_DO=ED.NUMERO_DO 
      LEFT OUTER JOIN CAUSAL_INCUMPLIMIENTO     C       ON C.ID_CAUSAL_INCUMPLIMIENTO=CID.ID_CAUSAL_INCUMPLIMIENTO 
      LEFT OUTER JOIN EVENTOS_DO                EV      ON EV.NUMERO_DO=ED.NUMERO_DO

      $filtros  
      $param_fecha

      GROUP BY ED.NUMERO_DO 
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

                        switch ($j){
          
                            case 13:
                                {
                                     $objPHPExcel->setActiveSheetIndex(0)
                                    ->setCellValue( $columnas[$j] . $filaexcel, 
                                        '= IF( OR(L' . $filaexcel . '<=0,M' .$filaexcel . '<=0), "", NETWORKDAYS.INTL(L' . $filaexcel . ',M' .$filaexcel .',11, Festivos!$A$1:$A$1048576 )-1)');

                                    break;
                                }
                            case 14:{
                                     $objPHPExcel->setActiveSheetIndex(0)
                                    ->setCellValue( $columnas[$j] . $filaexcel, 
                                       '=IF(N' .$filaexcel . '<=0' . ',"Cumplio","No Cumplio")');

                                    break;
                            }   
                            case 20:{
                                     $objPHPExcel->setActiveSheetIndex(0)
                                    ->setCellValue( $columnas[$j] . $filaexcel, 
                                        '= IF( OR(P' . $filaexcel . '<=0,S' .$filaexcel . '<=0), "", NETWORKDAYS.INTL(P' . $filaexcel . ',S' .$filaexcel .',11, Festivos!$A$1:$A$1048576 )-1)'); 

                                    break;
                            }
                            case 21:{

                              $objPHPExcel->getActiveSheet()->getStyle( $columnas[$j] .$filaexcel)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);    
                                    $l= $objPHPExcel->getActiveSheet()->getCell('L' . $filaexcel)->getValue(); 
                                    $p=$objPHPExcel->getActiveSheet()->getCell('P' . $filaexcel)->getValue(); 
                                    $q=$objPHPExcel->getActiveSheet()->getCell('Q' . $filaexcel)->getValue(); 
                                    $r=$objPHPExcel->getActiveSheet()->getCell('R' . $filaexcel)->getValue(); 

                                    if ( $l >= $p && $l >= $q && $l >= $r ){
                                         $objPHPExcel->setActiveSheetIndex(0)
                                         ->setCellValue( $columnas[$j] . $filaexcel, 
                                        '= IF( OR( L' . $filaexcel .'<=0, S'. $filaexcel . '<=0 ), "", NETWORKDAYS.INTL(L' . $filaexcel .',S'.$filaexcel .',11, Festivos!$A$1:$A$1048576 )-1)');
                                    } else {
                                            if ( $p >= $l && $p >= $q && $p >= $r ){
                                                 $objPHPExcel->setActiveSheetIndex(0)
                                                 ->setCellValue( $columnas[$j] . $filaexcel, 
                                                '= IF( OR( P' . $filaexcel .'<=0, S'. $filaexcel . '<=0 ), "", NETWORKDAYS.INTL(P' . $filaexcel .',S'.$filaexcel .',11, Festivos!$A$1:$A$1048576 )-1)');
                                            } else {
                                                    if ( $q >= $l && $q >= $p && $q >= $r ){
                                                         $objPHPExcel->setActiveSheetIndex(0)
                                                         ->setCellValue( $columnas[$j] . $filaexcel, 
                                                        '= IF( OR( Q' . $filaexcel .'<=0, S'. $filaexcel . '<=0 ), "", NETWORKDAYS.INTL(Q' . $filaexcel .',S'.$filaexcel .',11, Festivos!$A$1:$A$1048576 )-1)');
                                                    } else {
                                                        if ( $r >= $l && $r >= $p && $r >= $q ){
                                                             $objPHPExcel->setActiveSheetIndex(0)
                                                             ->setCellValue( $columnas[$j] . $filaexcel, 
                                                            '= IF( OR( R' . $filaexcel .'<=0, S'. $filaexcel . '<=0 ), "", NETWORKDAYS.INTL(R' . $filaexcel .',S'.$filaexcel .',11, Festivos!$A$1:$A$1048576 )-1)');
                                                        } else {
                                                             $objPHPExcel->setActiveSheetIndex(0)
                                                             ->setCellValue( $columnas[$j] . $filaexcel, "No hay fechas");
                                                        }
                                                    }  
                                               }   
                                    }        
                                    break;
                            }
                            case 22:{
                                     
                                     $objPHPExcel->setActiveSheetIndex(0)
                                    ->setCellValue( $columnas[$j] . $filaexcel, 
                                       '=IF(V' .$filaexcel . '<=T' .$filaexcel . ',"Cumplio","No Cumplio")');
                                    break;
                            } 
                            case 25:{
                                     $objPHPExcel->setActiveSheetIndex(0)
                                    ->setCellValue( $columnas[$j] . $filaexcel, 
                                        '= IF( OR(S' . $filaexcel . '<=0,X' .$filaexcel . '<=0), "", NETWORKDAYS.INTL(S' . $filaexcel . ',X' .$filaexcel .',11, Festivos!$A$1:$A$1048576 )-1)');         

                                    break;
                            }
                            case 26:{
                                     
                                     $objPHPExcel->setActiveSheetIndex(0)
                                    ->setCellValue( $columnas[$j] . $filaexcel, 
                                       '=IF(Z' .$filaexcel . '<=1' . ',"Cumplio","No Cumplio")');
                                    break;
                            } 
                            case 28:{
                                     $objPHPExcel->setActiveSheetIndex(0)
                                    ->setCellValue( $columnas[$j] . $filaexcel, 
                                        '= IF( OR(X' . $filaexcel . '<=0,AB' .$filaexcel . '<=0), "", NETWORKDAYS.INTL(X' . $filaexcel . ',AB' .$filaexcel .',11, Festivos!$A$1:$A$1048576 )-1)');         
                                    break;
                            }
                            case 29:{
                                     $objPHPExcel->setActiveSheetIndex(0)
                                    ->setCellValue( $columnas[$j] . $filaexcel, 
                                       '=IF(AC' .$filaexcel . '<=2' . ',"Cumplio","No Cumplio")');
                                    break;
                            }
                            case 32:{
                                     $objPHPExcel->setActiveSheetIndex(0)
                                    ->setCellValue( $columnas[$j] . $filaexcel, 
                                        '= IF( OR(AB' . $filaexcel . '<=0,AF' .$filaexcel . '<=0), "", NETWORKDAYS.INTL(AB' . $filaexcel . ',AF' .$filaexcel .',11, Festivos!$A$1:$A$1048576 )-1)');         
                                    break;
                            }
                            case 33:{
                                     $objPHPExcel->setActiveSheetIndex(0)
                                    ->setCellValue( $columnas[$j] . $filaexcel, 
                                       '=IF(AG' .$filaexcel . '<=AE' .$filaexcel . ',"Cumplio","No Cumplio")');
                                    break;
                            }
                            case 35:{
                                     $objPHPExcel->setActiveSheetIndex(0)
                                    ->setCellValue( $columnas[$j] . $filaexcel, 
                                        '= IF( OR(AF' . $filaexcel . '<=0,AI' .$filaexcel . '<=0), "", NETWORKDAYS.INTL(AF' . $filaexcel . ',AI' .$filaexcel .',11, Festivos!$A$1:$A$1048576 )-1)');         
                                    break;
                            }
                            case 37:{
                                     $objPHPExcel->setActiveSheetIndex(0)
                                    ->setCellValue( $columnas[$j] . $filaexcel, 
                                        '= IF( OR(AI' . $filaexcel . '<=0,AK' .$filaexcel . '<=0), "", NETWORKDAYS.INTL(AI' . $filaexcel . ',AK' .$filaexcel .',11, Festivos!$A$1:$A$1048576 )-1)');         
                                    break;
                            }
                            case 38:{
                                     $objPHPExcel->setActiveSheetIndex(0)
                                    ->setCellValue( $columnas[$j] . $filaexcel, 
                                        '= IF( OR(AB' . $filaexcel . '<=0,AK' .$filaexcel . '<=0), "", NETWORKDAYS.INTL(AB' . $filaexcel . ',AK' .$filaexcel .',11, Festivos!$A$1:$A$1048576 )-1)');         
                                    break;
                            }                            
                            case  39:{
                                     $objPHPExcel->setActiveSheetIndex(0)
                                    ->setCellValue( $columnas[$j] . $filaexcel, 
                                       '=IF(AM' .$filaexcel . '<=2' . ',"Cumplio","No Cumplio")');
                                    break;
                            }
                            case  40:{
                                     $objPHPExcel->setActiveSheetIndex(0)
                                    ->setCellValue( $columnas[$j] . $filaexcel, 
                                        '= IF( OR(AF' . $filaexcel . '<=0,AK' .$filaexcel . '<=0), "", NETWORKDAYS.INTL(AF' . $filaexcel . ',AK' .$filaexcel .',11, Festivos!$A$1:$A$1048576 )-1)');         
                                    break;
                            }
                            case  41:{
                                     $objPHPExcel->setActiveSheetIndex(0)
                                    ->setCellValue( $columnas[$j] . $filaexcel, 
                                       '=IF(AO' .$filaexcel . '>1' . ',"Cumplio","No Cumplio")');
                                    break;
                            }
                            case 42:{
                                     $objPHPExcel->setActiveSheetIndex(0)
                                    ->setCellValue( $columnas[$j] . $filaexcel, 
                                        '= IF( OR(L' . $filaexcel . '<=0,AB' .$filaexcel . '<=0), "", NETWORKDAYS.INTL(L' . $filaexcel . ',AB' .$filaexcel .',11, Festivos!$A$1:$A$1048576 )-1)');         
                                    break;
                            }                            

                            case 52:{
                                     $objPHPExcel->setActiveSheetIndex(0)
                                    ->setCellValue( $columnas[$j] . $filaexcel,
                                        '= IF( OR(L' . $filaexcel . '<=0,X' .$filaexcel . '<=0), "", NETWORKDAYS.INTL(L' . $filaexcel . ',X' .$filaexcel .',11, Festivos!$A$1:$A$1048576 )-1)');         
                                    break;
                            }
                            default:{
                                    if ( $reg[$j]==""){
                                        cellcolor($columnas[$j] .$filaexcel, "ff0000");
                                    }   
                            }
                        }                     
                    }
                    
                    //Escribir datos en vista HTML
                    $txt .= $reg[$j]." ";
                    switch($j) {

                        // Pasar de numero a texto
                        case 0:
                        case 1:
                        case 4:
                        case 5:
                        case 7:
                        {  
                            $fila .=  "<td style= mso-number-format:'@';>". utf8_decode($reg[$j])."</td>";
                             break;
                        }                        
                        
                        // Alinear celda a la derecha
                        case 2:
                        case 3:
                        {  
                            $fila .=  "<td align='right'>". utf8_decode($reg[$j])."</td>";
                             break;
                        }    

                        // Alinear celda al centro fechas
                        case 6:
                        {  
                            $fila .=  "<td align='center'>". utf8_decode($reg[$j])."</td>";
                             break;
                        }    
                        case 8:
                        {  
                            $fila .=  "<td align='center'>". utf8_decode($reg[$j])."</td>";
                             break;
                        }    
                        default:
                        {  
                          $fila .=  "<td align='left'>". utf8_decode($reg[$j])."</td>";
                            break;
                        }
                    }
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