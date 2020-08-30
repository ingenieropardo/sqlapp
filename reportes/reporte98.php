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
    $titulo="MERCANCIA A EMBARCAR";
    // Nombre del archivo 
    $archivo="MERCANCIAEMBARCAR";
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

    $dimensionCol = array (12,  14.29,  17.29,  19.43,  15.43,  10.71,  10.71,  52,  30.86,  30.86,  30.86,  10.71,  10.71,  10.71,  10.71,  10.71,  38.71,  38.71,  38.71,  10.71,  10.71,  31.14,  10.71,  23.43,  10.71,  10.71,  10.71,  10.71,  10.71,  10.71,  10.71,  18.14,  17,  35,  37.43,  24.86,  11.57);


    $tipodato= array('T','T','T','T','T','D','T','T','T','T','T','N','N','T','E','E','T','T','T','D','D','T','T','T','D','N','D','T','T','T','N','T','T','T','T','T','D');

    $calendario_festivo=festivos();

    if($numerodo=="" && $numeroped=="" && $ordencompra=="" && $doctrans=="" ){

        $filtros = " WHERE DATE_FORMAT(VM.FECHA_ETS, '%H')='00' AND ED.TIPO_REGIMEN='E' AND ED.ANULADO='N' ";

        if($sucursal  !="0") $filtros .= " AND ED.CODIGO_SUCURSAL_OP='$sucursal' ";
        if($importador!="0") $filtros .= " AND ED.ID_IMPORTADOR='$importador' ";
        if($tercero!="0") $filtros  .= " AND ED.ID_TERCERO='$tercero' ";
        if($ejecutivo!="0") $filtros  .= " AND ED.ID_EMPLEADO_OP='$ejecutivo' ";

        if($faperturai<>"")   $param_fecha .="AND (ED.FECHA_APERTURA     >= '$faperturai 00:00:00'  AND  ED.FECHA_APERTURA    <= '$faperturaf 23:59:59') ";

        if($flevantei<>"")    $param_fecha .="AND (Ex.FECHA_DEX        >= '$flevantei 00:00:00'   AND  Ex.FECHA_DEX     <= '$flevantef 23:59:59') ";
        if($faceptai<>"")     $param_fecha .="AND (Ex.FECHA_AUT_EMBARQUE   >= '$faceptai 00:00:00'    AND  Ex.FECHA_AUT_EMBARQUE  <= '$faceptaf 23:59:59') ";
        if($fmercanciai<>"")  $param_fecha .="AND (VM.FECHA_ETA   >= '$fmercanciai 00:00:00' AND  VM.FECHA_ETA  <= '$fmercanciaf 23:59:59') ";
        if($fretiroi<>"")     $param_fecha .="AND (DT.FECHA_CARGUE_EN_PLANTA >= '$fretiroi 00:00:00'    AND  DT.FECHA_CARGUE_EN_PLANTA  <= '$fretirof 23:59:59') ";
        if($fstickeri<>"")    $param_fecha .="AND (Ex.FECHA_ZARPE         >= '$fstickeri 00:00:00'   AND  Ex.FECHA_ZARPE        <= '$fstickerf 23:59:59') ";
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

    
    $sql  = "SELECT VM.FECHA_ETA,
                    ED.NUMERO_DO,
                    ED.NUMERO_PEDIDO,


                    IF ( FE.TIPO_FACTURA='P', GROUP_CONCAT(DISTINCT FE.NUMERO_FACTURA), '') PROFORMA,
                    IF ( FE.TIPO_FACTURA='F', GROUP_CONCAT(DISTINCT FE.NUMERO_FACTURA), '') FACTURA,
                    IF ( FE.TIPO_FACTURA='F', GROUP_CONCAT(DISTINCT FE.FECHA_FACTURA), '')  'FECHA FACTURA',

                    CC.NOMBRE_CONTACTO 'PRODUCTO',
                    UCASE(TRIM(LEFT(ED.DESCRIPCION, 2000))) PRODUCTO,
                    UCASE(I.NOMBRE_EXPORTADOR) IMPORTADOR,
                    UPPER(C.NOMBRE_EXPORTADOR) CONSIGNATARIO,
                    UCASE( LI2.NOMBRE_LUGAR_EMBAR_ARRIB_INAL) DESTINO,
                    DT.PESO_BRUTO 'PESO BRUTO',
                    DT.PESO_NETO 'PESO NETO',

                    GROUP_CONCAT( DISTINCT CASE UC.TAMANO WHEN '1' THEN '20 PIES' WHEN '2' THEN 'HIGH CUBE'   WHEN '3' THEN  '40 PIES' WHEN '4' THEN '45 PIES' END)  'CLASE',

                    COUNT(DISTINCT UC.NUMERO_ID_CONTENEDOR) 'CANTIDAD', 

                    NULL PENDIENTE,
                    UCASE(LT.NOMBRE_LINEA_TRANSPORTADOR) LINEA ,
                    UPPER(TR.NOMBRE_TRANSPORTADOR) TRANSPORTADOR ,
                    NULL 'AGENTE_CARGA',
                    DATE_FORMAT(VM.CUT_OFF_FISICO, '%d/%m/%Y') 'CUT OFF FISICO' ,
                    DATE_FORMAT(VM.CUT_OFF_DOCUMENTAL, '%d/%m/%Y') 'CUT OFF DOCUMENTAL',
                    UCASE(VM.NOMBRE_VAPOR)  MOTONAVE,
                    VM.VIAJE_LINEA NRO_VIAJE,
                    DT.BOOKING_NUMBER,
                    DATE_FORMAT(EX.FECHA_DOCS_OK, '%d/%m/%Y') 'FEC DOC OK',
                    DATEDIFF(MD.FECHA_ETA, VM.FECHA_ETS ) TIEMPO_TRANSITO,
                    DATE_FORMAT(MD.FECHA_ETA, '%d/%m/%Y') 'FECHA ETA',
                    NULL REPRESENTANTE,
                    NULL NUMGUIA,
                    DT.CODIGO_CONDICION_ENTREGA,
                    DT.VALOR_FOB_USD,
                    UCASE(PA.NOMBRE_PAIS) PAIS_DESTINO,
                    UCASE(DT.LUGAR_RECIBO) LUGAR_RECIBO,
                    UCASE(LE.NOMBRE_LUGAR_EMBAR_ARRIB_NAL) LOCALIZACION,
                    UCASE(DP.NOMBRE_DEPOSITO) LUGAR_EMBARQUE,
                    EX.NUM_AUT_EMBARQUE,
                    DATE_FORMAT(EX.FECHA_AUT_EMBARQUE, '%d/%m/%Y') 'FECHA SAE'

            FROM EXPORTACIONES EX
                    INNER JOIN ESTADOS_DO ED ON EX.NUMERO_DO=ED.NUMERO_DO
                    INNER JOIN documentos_transportes_expos DT ON ED.NUMERO_DO =DT.NUMERO_DO
                    
                    LEFT OUTER JOIN CONTACTOS_CLIENTES CC ON CC.ID_CONTACTO_CLIENTE=ED.ID_CONTACTO_CLIENTE
                    LEFT OUTER JOIN EXPORTADORES  C ON C.ID_EXPORTADOR =DT.ID_EXPORTADOR
                    LEFT OUTER JOIN EXPORTADORES  I ON I.ID_EXPORTADOR =DT.ID_EXPORTADOR_IMPORTADOR

                    LEFT OUTER JOIN facturas_exportaciones  FE ON ED.NUMERO_DO =FE.NUMERO_DO
                    LEFT OUTER JOIN EX_PAISES PA ON DT.CODIGO_PAIS=PA.CODIGO_PAIS
                    LEFT OUTER JOIN viajes_motonaves VM  ON DT.ID_VIAJE_MOTONAVE=VM.ID_VIAJE_MOTONAVE
                    LEFT OUTER JOIN LINEAS_TRANSPORTADORES LT ON LT.ID_LINEA_TRANSPORTADOR=VM.ID_LINEA_TRANSPORTADOR
                    LEFT OUTER JOIN TRASPORTADORES TR ON TR.CODIGO_TRANSPORTADOR=VM.CODIGO_TRANSPORTADOR
                    LEFT OUTER JOIN motonaves_destinos MD ON MD.ID_VIAJE_MOTONAVE = VM.ID_VIAJE_MOTONAVE AND MD.CODIGO_LUGAR_EMBAR_ARRIB_INAL = DT.CODIGO_LUGAR_EMBAR_ARRIB_INAL
                    LEFT OUTER JOIN DEPOSITOS  DP ON DP.CODIGO_DEPOSITO=VM.CODIGO_DEPOSITO

                    LEFT OUTER JOIN ex_lugares_embar_arrib_Inales LI ON LI.CODIGO_LUGAR_EMBAR_ARRIB_INAL=MD.CODIGO_LUGAR_EMBAR_ARRIB_INAL
                    LEFT OUTER JOIN ex_lugares_embar_arrib_Inales LI2 ON LI2.CODIGO_LUGAR_EMBAR_ARRIB_INAL=DT.CODIGO_LUGAR_EMBAR_ARRIB_INAL
                    LEFT OUTER JOIN ex_lugares_embar_arrib_nales  LE ON LE.CODIGO_LUGAR_EMBAR_ARRIB_NAL=DT.CODIGO_LUGAR_EMBAR_ARRIB_NAL

                    LEFT OUTER JOIN UNIDADES_CARGA  UC ON UC.NUMERO_DO=ED.NUMERO_DO


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
                    $objDrawing->setCoordinates('I1');
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
                            case "E":
                                {
                                    $objPHPExcel->getActiveSheet()->getStyle( $columnas[$j] .$filaexcel )->applyFromArray($estiloInformacionD);

                                    $objPHPExcel->getActiveSheet()->getStyle( $columnas[$j] .$filaexcel)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER);                                 
                                    break;
                                }

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