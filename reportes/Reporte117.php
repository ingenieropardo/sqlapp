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
    $titulo="CONFIRMACION LLEGADAS";
    // Nombre del archivo 
    $archivo="CONFIRMACIONLLEGADA";
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

    // Estilo para resultados - estiloresultados
$estiloresultados= array(
    'font' => array(
        'name'      => 'Verdana',
        'bold'      => true,
        'italic'    => false,
        'strike'    => false,
        'size' =>10,
        'color'     => array(
            'rgb' => '000000'
        )
    ),
    'fill' => array(
      'type'  => PHPExcel_Style_Fill::FILL_SOLID,
      'color' => array(
      'argb' => 'a6a6a6')
    ),
    'borders' => array(
        'left' => array(
        'style' => PHPExcel_Style_Border::BORDER_THIN ,
        'color' => array(
        'rgb' => 'bfbfbf'
            )
        )
    )
    ,
    'alignment' =>  array(
        'vertical'  => PHPExcel_Style_Alignment::VERTICAL_CENTER, 
        'wrap'      => TRUE
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

    $dimensionCol = array (17, 22, 22, 14, 18, 23, 14, 14, 14, 14, 14, 12, 12, 12, 14, 12, 12, 12,12, 22, 22, 22, 14, 14);

    $tipodato= array('T','T','T','T','T','T','D','T','T','D','D','N','T','T','D','D','N','N','N','N');

    $dimensionResumenStatus = array(20, 15, 16, 16 ,10, 10, 10, 16, 13, 13, 13, 13);

    $calendario_festivo=festivos();

    if($numerodo=="" && $numeroped=="" && $ordencompra=="" && $doctrans=="" ){

        $filtros = " WHERE ED.ANULADO='N' AND ED.TIPO_REGIMEN='E'";

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

    
    $sql  = "SELECT ED.NUMERO_DO, 
                    UPPER(VM.NOMBRE_VAPOR ) 'BUQUE',  
                    DT.BOOKING_NUMBER 'BOOKING', 
                    VM.NUMERO_VIAJE 'NRO VIAJE',   
                    VM.VIAJE_LINEA 'VIAJE LINEA',
                    DT.NUMERO_DOCUMENTO_TRANSPORTE 'NRO BL',  
                    DATE_FORMAT(DT.FECHA_DOCUMENTO_TRANSPORTE, '%d/%m/%Y') 'FECHA BL', 
                    UPPER(LT.NOMBRE_LINEA_TRANSPORTADOR) 'LINEA',  
                    ED.NUMERO_PEDIDO 'PEDIDO', 
                    DATE_FORMAT(VM.FECHA_ETS, '%d/%m/%Y') 'FECHA ETD', 
                    DATE_FORMAT(DT.FECHA_LLEGADA_DESTINO, '%d/%m/%Y')  'FECHA ESTIMADA LLEGADA',
                    DATEDIFF(DT.FECHA_LLEGADA_DESTINO, VM.FECHA_ETS ) 'TIEMPO ESTIMADO', 
                    UPPER( LI.NOMBRE_LUGAR_EMBAR_ARRIB_INAL) 'PTO DESTINO', 
                    UCASE(PA.NOMBRE_PAIS) 'PAIS DESTINO',
                    DATE_FORMAT(VM.FECHA_ETS, '%d/%m/%Y') 'FECHA ZARPE REAL', 
                    DATE_FORMAT(MD.FECHA_RTAD, '%d/%m/%Y') 'FEC LLEGADA REAL', 
                    DATEDIFF(MD.FECHA_RTAD, VM.FECHA_ETS ) 'TIEMPO REAL',  
                    DATEDIFF(DT.FECHA_LLEGADA_DESTINO, VM.FECHA_ETS ) - DATEDIFF(MD.FECHA_RTAD, VM.FECHA_ETS ) 'DIF TT', 
                    DT.NUMERO_SHIPMENT 'CAMBIO ETA',  
                    LEFT(TRIM(UCASE(RD.OBSERVACIONES)),4700) 'ROLL OVER'


            FROM EXPORTACIONES EX
                    INNER JOIN ESTADOS_DO ED ON EX.NUMERO_DO=ED.NUMERO_DO
                    INNER JOIN documentos_transportes_expos DT ON ED.NUMERO_DO =DT.NUMERO_DO

                    LEFT OUTER JOIN EX_PAISES PA ON DT.CODIGO_PAIS=PA.CODIGO_PAIS
                    LEFT OUTER JOIN viajes_motonaves VM  ON DT.ID_VIAJE_MOTONAVE=VM.ID_VIAJE_MOTONAVE
                    LEFT OUTER JOIN motonaves_destinos     MD ON MD.ID_VIAJE_MOTONAVE = VM.ID_VIAJE_MOTONAVE AND MD.CODIGO_LUGAR_EMBAR_ARRIB_INAL = DT.CODIGO_LUGAR_EMBAR_ARRIB_INAL
                    LEFT OUTER JOIN ex_lugares_embar_arrib_Inales LI ON LI.CODIGO_LUGAR_EMBAR_ARRIB_INAL=MD.CODIGO_LUGAR_EMBAR_ARRIB_INAL
                    LEFT OUTER JOIN LINEAS_TRANSPORTADORES LT ON LT.ID_LINEA_TRANSPORTADOR=VM.ID_LINEA_TRANSPORTADOR 
                    LEFT OUTER JOIN reservas_contenedores_dos      RD  ON RD.NUMERO_DO=ED.NUMERO_DO  AND RD.ANULADO='N'

      $filtros  
      $param_fecha

      ORDER BY ED.NUMERO_DO
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

        //Crear nueva hoja
        $objWorksheet1 = $objPHPExcel->createSheet();
        $objWorksheet1->setTitle('ESTADISTICA');

        //Insertar imagen en archivo excel con PhpExcel
        $objDrawing = new PHPExcel_Worksheet_Drawing();
                    $objDrawing->setName('imgNotice');
                    $objDrawing->setDescription('Noticia');
                    $img = '../img/logo1.png'; 
                    $objDrawing->setPath($img);
                    $objDrawing->setOffsetX(20);    
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

        // FORMATO DE CELDAS
        //$objPHPExcel->getActiveSheet()->getStyle("A3:A14" )->applyFromArray($estiloInformacion);
        //$objPHPExcel->getActiveSheet()->getStyle("A1:I1")->applyFromArray($estiloTituloReporte);
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
            $navieras= array ("");

            while($reg = @mysql_fetch_array($res)) {
                $fila .= "<tr>";
                $rawdata[$i] = $reg;

                for($j=0; $j<$nf; $j++) {

                    // Validar las navieras
                    if ($j==7){
                        $naviera=$reg[$j];

                        $sw=0;
                        for ($x=0; $x < sizeof($navieras); $x++){

                            if ($navieras[$x]== $naviera){
                                $sw=1;
                            }
                        }

                        if ($sw==0){
                            array_unshift($navieras, $naviera);
                        } 
                    }
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

            //Tamaño del arreglo
            $contadorarray = count($navieras) -1;
            $filaest=4;
            for ($x=0; $x < $contadorarray; $x++){
                $objPHPExcel->setActiveSheetIndex(2)->setCellValue("A". $filaest, $navieras[$x]);
                $filaest=$filaest + 1;
            }
            $cont = 1;
            //lLENAR INFORMACIÓN DE LA TABLA 1
            $filaexceltb = 0;
            for ($i=0; $i <$contadorarray ; $i++) { 

                $objPHPExcel->getActiveSheet(2)->getColumnDimension($columnas[$i])->setWidth($dimensionResumenStatus[$i]); 
                $objPHPExcel->setActiveSheetIndex(2)->setCellValue("B".($i+4) , "=COUNTIFS('CONFIRMACION LLEGADAS'!H:H,ESTADISTICA!A".($i+4) .")");
                $objPHPExcel->setActiveSheetIndex(2)->setCellValue("C".($i+4) , "=COUNTIFS('CONFIRMACION LLEGADAS'!H:H,ESTADISTICA!A".($i+4) .", 'CONFIRMACION LLEGADAS'!R:R," . '"<0"' . ")");
                // % CON FORMULA SI.ERROR - IFERROR
                $objPHPExcel->setActiveSheetIndex(2)->setCellValue("D".($i+4) , "=IFERROR(C".($i+4)."/B".($i+4).",0)");
                $objPHPExcel->setActiveSheetIndex(2)->setCellValue("F".($i+4) , "=IFERROR(E".($i+4)."/B".($i+4).",0)");
                $objPHPExcel->setActiveSheetIndex(2)->setCellValue("H".($i+4) , "=IFERROR(G".($i+4)."/B".($i+4).",0)");
                //Llegadas tardias
                $objPHPExcel->setActiveSheetIndex(2)->setCellValue("E".($i+4) , "=COUNTIFS('CONFIRMACION LLEGADAS'!H:H,ESTADISTICA!A".($i+4) .", 'CONFIRMACION LLEGADAS'!R:R," . '">0"' . ")");
                //Cumplimiento
                $objPHPExcel->setActiveSheetIndex(2)->setCellValue("G".($i+4) , "=COUNTIFS('CONFIRMACION LLEGADAS'!H:H,ESTADISTICA!A".($i+4) .", 'CONFIRMACION LLEGADAS'!R:R," . '"=0"' . ")");
                //Sin Confirmacion de llegada =B7-C7-E7-G7
                $objPHPExcel->setActiveSheetIndex(2)->setCellValue("I".($i+4),"=B".($i+4)."-C".($i+4)."-E".($i+4)."-G".($i+4) );
                
                for ($x=0; $x<=$contadorarray; $x++) { 
                    if ($filaexceltb < 9) {
                        $objPHPExcel->getActiveSheet()->getStyle($columnas[$filaexceltb].($x+3))->applyFromArray($estiloInformacionD); 
                    }
                    if ($filaexceltb < 5 AND $x < 1) {
                        $objPHPExcel->getActiveSheet()->getStyle($columnas[$filaexceltb].($x+20))->applyFromArray($estiloInformacionD); 
                    } 
                    if ($filaexceltb < 3 AND $x < 4) {
                        $objPHPExcel->getActiveSheet()->getStyle($columnas[$filaexceltb].($x+23))->applyFromArray($estiloInformacionD); 
                    } 
                    if ($filaexceltb < 3 AND $x < 5) {
                        $objPHPExcel->getActiveSheet()->getStyle($columnas[$filaexceltb].($x+29))->applyFromArray($estiloInformacionD); 
                    } 
                }
                $filaexceltb = $filaexceltb + 1;
                $cont = $cont +1;
            }
                //iNFORMACIÓN TABLA 2
                $objPHPExcel->setActiveSheetIndex(2)->setCellValue("A".($cont+7) , "=COUNTA('CONFIRMACION LLEGADAS'!A:A)-2");
                $objPHPExcel->setActiveSheetIndex(2)->setCellValue("B".($cont+7), "=COUNTIFS('CONFIRMACION LLEGADAS'!R:R,".'"<0"'.")"); 
                $objPHPExcel->setActiveSheetIndex(2)->setCellValue("C".($cont+7), "=COUNTIFS('CONFIRMACION LLEGADAS'!R:R,".'">0"'.")");
                $objPHPExcel->setActiveSheetIndex(2)->setCellValue("D".($cont+7), "=IF(A13=0,0,COUNTIFS('CONFIRMACION LLEGADAS'!R:R,".'"=0"'."))");
                $objPHPExcel->setActiveSheetIndex(2)->setCellValue("E".($cont+7), "=A".($cont+7)."-SUM(B".($cont+7).":D".($cont+7).")");

                $objPHPExcel->setActiveSheetIndex(2)->setCellValue("B".($cont+8), "=IFERROR(B".($cont+7)."/A".($cont+7).",0)");
                $objPHPExcel->setActiveSheetIndex(2)->setCellValue("C".($cont+8), "=IFERROR(C".($cont+7)."/A".($cont+7).",0)");
                $objPHPExcel->setActiveSheetIndex(2)->setCellValue("D".($cont+8), "=IFERROR(D".($cont+7)."/A".($cont+7).",0)");
                $objPHPExcel->setActiveSheetIndex(2)->setCellValue("E".($cont+8), "=IFERROR(E".($cont+7)."/A".($cont+7).",0)");
                $objPHPExcel->getActiveSheet()->getStyle( "A" .($cont+7) .":E" . ($cont+7))->applyFromArray($estiloInformacionD);
                $objPHPExcel->getActiveSheet()->getStyle( "B" .($cont+8) .":E" . ($cont+8))->applyFromArray($estiloresultados);

                //FORMUAS DE LA TABLA 1
                $objPHPExcel->setActiveSheetIndex(2)->setCellValue("B".($cont+3), "=SUM(B4:B".($cont+2).")");
                $objPHPExcel->setActiveSheetIndex(2)->setCellValue("C".($cont+3), "=SUM(C4:C".($cont+2).")");
                $objPHPExcel->setActiveSheetIndex(2)->setCellValue("D".($cont+3), "=IFERROR(C".($cont+3)."/B".($cont+3).",0)");
                $objPHPExcel->setActiveSheetIndex(2)->setCellValue("E".($cont+3), "=SUM(E4:E".($cont+2).")");
                $objPHPExcel->setActiveSheetIndex(2)->setCellValue("F".($cont+3), "=IFERROR(E".($cont+3)."/B".($cont+3).",0)");
                $objPHPExcel->setActiveSheetIndex(2)->setCellValue("G".($cont+3), "=SUM(G4:G".($cont+2).")");
                $objPHPExcel->setActiveSheetIndex(2)->setCellValue("H".($cont+3), "=IFERROR(G".($cont+3)."/B".($cont+3).",0)");
                $objPHPExcel->setActiveSheetIndex(2)->setCellValue("I".($cont+3), "=SUM(I4:I".($cont+2).")");
                $objPHPExcel->getActiveSheet()->getStyle( "A" .($cont+3) .":I" . ($cont+3))->applyFromArray($estiloresultados);
                //FORMATO TABLA 1
                $objPHPExcel->getActiveSheet(2)->getStyle("D4:D".($cont+3))->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE);
                $objPHPExcel->getActiveSheet(2)->getStyle("F4:F".($cont+3))->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE);
                $objPHPExcel->getActiveSheet(2)->getStyle("H4:H".($cont+3))->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE);
                $objPHPExcel->getActiveSheet(2)->getStyle("B".($cont+8).":E".($cont+8))->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE);
                $objPHPExcel->getActiveSheet(2)->getStyle("C".($cont+11).":C".($cont+14))->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE);
                $objPHPExcel->getActiveSheet(2)->getStyle("C".($cont+17).":C".($cont+21))->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE);


                //FORMATO TABLA 3
                $objPHPExcel->setActiveSheetIndex(2)->setCellValue("B".($cont+11), "=COUNTIFS('CONFIRMACION LLEGADAS'!R:R,".'">-5"'.",'CONFIRMACION LLEGADAS'!R:R,".'"<0"'.")");
                $objPHPExcel->setActiveSheetIndex(2)->setCellValue("B".($cont+12), "=COUNTIFS('CONFIRMACION LLEGADAS'!R:R,".'"<-4"'.")");

                $objPHPExcel->setActiveSheetIndex(2)->setCellValue("C".($cont+11), "=IFERROR(B".($cont+11)."/B".($cont+14).",0)");
                $objPHPExcel->setActiveSheetIndex(2)->setCellValue("C".($cont+12), "=IFERROR(B".($cont+12)."/B".($cont+14).",0)");
                $objPHPExcel->setActiveSheetIndex(2)->setCellValue("C".($cont+13), "=IFERROR(B".($cont+13)."/B".($cont+14).",0)");

                $objPHPExcel->setActiveSheetIndex(2)->setCellValue("B".($cont+14), "=SUM(B".($cont+11).":B".($cont+13).")");
                $objPHPExcel->setActiveSheetIndex(2)->setCellValue("C".($cont+14), "=SUM(C".($cont+11).":C".($cont+13).")");

                $objPHPExcel->getActiveSheet()->getStyle( "A" .($cont+11) .":C" . ($cont+11))->applyFromArray($estiloInformacionD);
                $objPHPExcel->getActiveSheet()->getStyle( "A" .($cont+12) .":C" . ($cont+12))->applyFromArray($estiloInformacionD);
                $objPHPExcel->getActiveSheet()->getStyle( "A" .($cont+13) .":C" . ($cont+13))->applyFromArray($estiloInformacionD);
                $objPHPExcel->getActiveSheet()->getStyle( "B" .($cont+14) .":C" . ($cont+14))->applyFromArray($estiloresultados);


                //FORMATO TABLA 4
                $objPHPExcel->setActiveSheetIndex(2)->setCellValue("B".($cont+17), "=COUNTIFS('CONFIRMACION LLEGADAS'!R:R,".'">3"'.",'CONFIRMACION LLEGADAS'!R:R,".'"<10"'.")");
                $objPHPExcel->setActiveSheetIndex(2)->setCellValue("B".($cont+18), "=COUNTIFS('CONFIRMACION LLEGADAS'!R:R,".'">10"'.")");

                $objPHPExcel->setActiveSheetIndex(2)->setCellValue("C".($cont+17), "=IFERROR(B".($cont+17)."/B".($cont+21).",0)");
                $objPHPExcel->setActiveSheetIndex(2)->setCellValue("C".($cont+18), "=IFERROR(B".($cont+18)."/B".($cont+21).",0)");
                $objPHPExcel->setActiveSheetIndex(2)->setCellValue("C".($cont+19), "=IFERROR(B".($cont+19)."/B".($cont+21).",0)");
                $objPHPExcel->setActiveSheetIndex(2)->setCellValue("C".($cont+20), "=IFERROR(B".($cont+20)."/B".($cont+21).",0)");

                 $objPHPExcel->setActiveSheetIndex(2)->setCellValue("B".($cont+21), "=SUM(B".($cont+17).":B".($cont+20).")");
                $objPHPExcel->setActiveSheetIndex(2)->setCellValue("C".($cont+21), "=SUM(C".($cont+17).":C".($cont+20).")");

                $objPHPExcel->getActiveSheet()->getStyle( "A" .($cont+17) .":C" . ($cont+17))->applyFromArray($estiloInformacionD);
                $objPHPExcel->getActiveSheet()->getStyle( "A" .($cont+18) .":C" . ($cont+18))->applyFromArray($estiloInformacionD);
                $objPHPExcel->getActiveSheet()->getStyle( "A" .($cont+19) .":C" . ($cont+19))->applyFromArray($estiloInformacionD);
                $objPHPExcel->getActiveSheet()->getStyle( "A" .($cont+20) .":C" . ($cont+20))->applyFromArray($estiloInformacionD);
                $objPHPExcel->getActiveSheet()->getStyle( "B" .($cont+21) .":C" . ($cont+21))->applyFromArray($estiloresultados);

                $objPHPExcel->setActiveSheetIndex(2)->setCellValue("A".($i+4), "TOTALES");

                // Fijar titulo del informe y quitar lineas de division 
        $objPHPExcel->setActiveSheetIndex(2)
                    ->setCellValue("A1", "INFORME TIEMPOS DE TRANSITO REAL POR NAVIERA")
                    ->setCellValue("A2", "PEDIDOS CON ETA POD")
                    ->setShowGridlines(false)
                    ->setCellValue("A3", "Linea")
                    ->setCellValue("B3", "No. Cargas")
                    ->setCellValue("C3", "Llegadas anticipadas")
                    ->setCellValue("D3", "% Anticipadas")
                    ->setCellValue("E3", "Llegadas tardias")
                    ->setCellValue("F3", "% Tardias")
                    ->setCellValue("G3", "Cumplimiento")
                    ->setCellValue("H3", "% Optimo")
                    ->setCellValue("I3", "Sin Confirmar de Llegada")

                    //-----------------------------------------------------------
                    ->setCellValue("A".($cont+6), "Total No. Ped")
                    ->setCellValue("B".($cont+6), "Llegadas anticipadas")
                    ->setCellValue("C".($cont+6), "Llegadas tardias")
                    ->setCellValue("D".($cont+6), "Llegadas en tiempo estimado")
                    ->setCellValue("E".($cont+6), "Sin Confirmar de Llegada")

                    //-----------------------------------------------------------
                    ->setCellValue("A".($cont+10), "Llegadas anticipadas")
                    ->setCellValue("B".($cont+10), "No. Pedidos")
                    ->setCellValue("C".($cont+10), "% de Operaciones")

                    ->setCellValue("A".($cont+11), "4 Días")
                    ->setCellValue("A".($cont+12), "5 o mas Días")

                    //-----------------------------------------------------------
                    ->setCellValue("A".($cont+16), "Llegadas tardias")
                    ->setCellValue("B".($cont+16), "No. Pedidos")
                    ->setCellValue("C".($cont+16), "% de Operaciones")

                    ->setCellValue("A".($cont+17), "4 a 9 Días")
                    ->setCellValue("A".($cont+18), "10 o mas Días");


        // FORMATO DE CELDAS
        $objPHPExcel->getActiveSheet()->getStyle("A1:I1")->applyFromArray($estiloTituloColumnas);
        $objPHPExcel->getActiveSheet()->getStyle("A2:I2")->applyFromArray($estiloTituloColumnas);          
        $objPHPExcel->getActiveSheet()->getStyle("A3:I3")->applyFromArray($estiloTituloColumnas);
        $objPHPExcel->getActiveSheet()->getStyle("A".($cont+6).":E".($cont+6))->applyFromArray($estiloTituloColumnas);
        $objPHPExcel->getActiveSheet()->getStyle("A".($cont+10).":C".($cont+10))->applyFromArray($estiloTituloColumnas);
        $objPHPExcel->getActiveSheet()->getStyle("A".($cont+16).":C".($cont+16))->applyFromArray($estiloTituloColumnas);
        $objPHPExcel->setActiveSheetIndex(2)->mergeCells("A1:I1");
        $objPHPExcel->setActiveSheetIndex(2)->mergeCells("A2:I2");

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