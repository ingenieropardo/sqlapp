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
    $titulo="REPORTE DE TRIBUTOS POR DIM";
    
    // Nombre del archivo 
    $archivo="reportedetributos";


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

    // Estilo para vertical
    $estilovertical= array(
    'font' => array(
        'name'      => 'Verdana',
        'bold'      => true,
        'italic'    => false,
        'strike'    => false,
        'size' =>8,
        'color'     => array(
            'rgb' => '000000'
        )
    ),
    'fill' => array(
      'type'  => PHPExcel_Style_Fill::FILL_SOLID,
      'color' => array(
      'argb' => 'bfbfbf')
    ),
    'borders' => array(
        'left' => array(
        'style' => PHPExcel_Style_Border::BORDER_THIN ,
        'color' => array(
        'rgb' => '3a2a47'
            )
        )
    ),'borders' => array(
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
    ) 
    ,
    'alignment' =>  array(
        'vertical'  => PHPExcel_Style_Alignment::VERTICAL_CENTER, 
        'wrap'      => TRUE
    ) 

    );

// Estilo para totales
        $estilototales= array(
    'font' => array(
        'name'      => 'Arial',
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
      'argb' => '333333')
    ),
    'borders' => array(
        'left' => array(
        'style' => PHPExcel_Style_Border::BORDER_THIN ,
        'color' => array(
        'rgb' => '3a2a47'
            )
        )
    ),'borders' => array(
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
    ) 
    ,
    'alignment' =>  array(
        'vertical'  => PHPExcel_Style_Alignment::VERTICAL_CENTER, 
        'wrap'      => TRUE
    ) 

    );

    $columnas = array ( 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'AA', 'AB', 'AC', 'AD', 'AE', 'AF', 'AG', 'AH', 'AI', 'AJ', 'AK', 'AL', 'AM', 'AN', 'AO', 'AP', 'AQ', 'AR', 'AS', 'AT', 'AU', 'AV', 'AW', 'AX', 'AY', 'AZ', 'BA', 'BB', 'BC', 'BD', 'BE', 'BF', 'BG', 'BH', 'BI', 'BJ', 'BK', 'BL', 'BM', 'BN', 'BO', 'BP', 'BQ', 'BR', 'BS', 'BT', 'BU', 'BV', 'BW', 'BX', 'BY', 'BZ', 'CA', 'CB', 'CC', 'CD', 'CE', 'CF', 'CG', 'CH', 'CI', 'CJ', 'CK', 'CL', 'CM', 'CN', 'CO', 'CP', 'CQ', 'CR', 'CS', 'CT', 'CU', 'CV', 'CW', 'CX', 'CY', 'CZ', 'DA', 'DB', 'DC', 'DD', 'DE', 'DF', 'DG', 'DH', 'DI', 'DJ', 'DK', 'DL', 'DM', 'DN', 'DO', 'DP', 'DQ', 'DR', 'DS', 'DT', 'DU', 'DV', 'DW', 'DX', 'DY', 'DZ', 'EA', 'EB', 'EC', 'ED', 'EE', 'EF', 'EG', 'EH', 'EI', 'EJ', 'EK', 'EL', 'EM', 'EN', 'EO', 'EP', 'EQ', 'ER', 'ES', 'ET', 'EU', 'EV', 'EW', 'EX', 'EY', 'EZ', 'FA', 'FB', 'FC', 'FD', 'FE', 'FF', 'FG', 'FH', 'FI', 'FJ', 'FK', 'FL', 'FM', 'FN', 'FO', 'FP', 'FQ', 'FR', 'FS', 'FT', 'FU', 'FV', 'FW', 'FX', 'FY', 'FZ');

    $dimensionCol = array (7,  8.43,  12.29,  14.57,  14.57,  14.57,  14.57,  32,  19,  44.57,  14.57,  14.57,  36.14,  16.14,  15.57,  15.57,  15.57,  49.29,  14,  14,  16,  16,  16,  11.71,  18,  11.71,  18,  21.86,  12,  12.43,  12.43,  15.86,  15.86,  15.86,  15.86,  15.86,  15.86,  15.86,  15.86,  14.71,  14.71,  14.71,  14.71,  14.71,  19.43,  12,  15.14,  9.14,  19.43,  19.43,  12.57,  12.57,  12.57,  12.57,  12.57,  12.57,  12.57,  12.57,  12.57,  12.57,  18.57,  18.57,  15.86,  15.86,  15.86,  35.57,  14.71,  86);


    $tipodato= array('T','T','T','D','T','T','D','T','T','T','T','T','T','T','D','T','T','T','N','N','N','N','N','D','T','D','T','T','D','T','T','N','N','N','N','N','N','N','N','N','N','N','N','N','T','D','T','T','T','T','D','D','T','T','T','N','E','T','T','T','T','T','T','T','T','T','T','T');

    if($numerodo=="" && $numeroped=="" && $ordencompra=="" && $doctrans=="" ){

        $filtros = " WHERE ED.ANULADO='N' AND ED.TIPO_REGIMEN='I'";

        if($sucursal  !="0") $filtros .= " AND ED.CODIGO_SUCURSAL_OP='$sucursal' ";
        if($importador!="0") $filtros .= " AND ED.ID_IMPORTADOR='$importador' ";
        if($tercero!="0") $filtros  .= " AND ED.ID_TERCERO='$tercero' ";
        if($ejecutivo!="0") $filtros  .= " AND ED.ID_EMPLEADO_OP='$ejecutivo' ";

        if($faperturai<>"")   $param_fecha .="AND (ED.FECHA_APERTURA     >= '$faperturai 00:00:00'  
                                              AND  ED.FECHA_APERTURA     <= '$faperturaf 23:59:59') ";
        if($flevantei<>"")    $param_fecha .="AND (FD.FECHA_LEVANTE      >= '$flevantei 00:00:00'   
                                              AND  FD.FECHA_LEVANTE      <= '$flevantef 23:59:59') ";
        if($faceptai<>"")     $param_fecha .="AND (FD.FECHA_ACEPTACION   >= '$faceptai 00:00:00'    
                                              AND  FD.FECHA_ACEPTACION   <= '$faceptaf 23:59:59') ";
        if($fmercanciai<>"")  $param_fecha .="AND (IM.FECHA_LIBERACION   >= '$fmercanciai 00:00:00' 
                                              AND  IM.FECHA_LIBERACION   <= '$fmercanciaf 23:59:59') ";
        if($fretiroi<>"")     $param_fecha .="AND (IM.FECHA_RETIRO_TOTAL >= '$fretiroi 00:00:00'    
                                              AND  IM.FECHA_LIBERACION   <= '$fretirof 23:59:59') ";
        if($fstickeri<>"")    $param_fecha .="AND (FD.FECHA_PAGO         >= '$fstickeri 00:00:00'   
                                              AND  FD.FECHA_PAGO         <= '$fstickerf 23:59:59') ";
        if($ffacturai<>"")    $param_fecha .="AND (ED.FECHA_FACTURA      >= '$ffacturai 00:00:00'   
                                              AND  ED.FECHA_FACTURA      <= '$ffacturaf 23:59:59') ";
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
    $sql  = "SELECT  DATE_FORMAT(FD.FECHA_ACEPTACION, '%Y') 'AÑO', 
    
        CASE DATE_FORMAT(FD.FECHA_LEVANTE, '%m') WHEN '01' Then 'ENERO'  WHEN '02' Then 'FEBRERO'
        WHEN '03' Then 'MARZO' WHEN '04' Then 'ABRIL' WHEN '05' Then 'MAYO' WHEN '06' Then 'JUNIO'
        WHEN '07' Then 'JULIO' WHEN '08' Then 'AGOSTO' WHEN '09' Then 'SEPTIEMBRE'
        WHEN '10' Then 'OCTUBRE' WHEN '11' Then 'NOVIEMBRE' WHEN '12' Then 'DICIEMBRE' ELSE ' ' END AS MES,

        FD.NUMERO_FORMULARIO_DI 'NUMERO FORMULARIO DI', 
        DATE_FORMAT(FD.FECHA_ACEPTACION, '%d/%m/%Y') 'FECHA ACEPTACION', 
        ED.NUMERO_DO 'NUMERO DO', 
        ED.NUMERO_PEDIDO 'NUMERO PEDIDO', 
        DATE_FORMAT(ED.FECHA_APERTURA, '%d/%m/%Y') 'FECHA APERTURA', 
        SC.NOMBRE_SEGMENTO 'NOMBRE SEGMENTO', 
        I.NUMERO_IDENTIFICACION 'NUMERO IDENTIFICACION', 
        I.NOMBRE_IMPORTADOR 'NOMBRE IMPORTADOR', 
        A.NOMBRE_ADMINISTRACION 'NOMBRE ADMINISTRACION', 
        EM.NUMERO_IDENTIFICACION 'NUMERO IDENTIFICACION', 
        EM.NOMBRE_PERSONA 'DECLARANTE', 
        CF.NUMERO_FACTURA 'FACTURA', 
        DATE_FORMAT(CF.FECHA_FACTURA, '%d/%m/%Y') 'FECHA FACTURA',
        CF.NUMERO_LISTA_EMPAQUE 'LISTA EMPAQUE', 
        CF.CODIGO_CONDICION_ENTREGA'INCOTERM', 
        EX.NOMBRE_EXPORTADOR 'EXPORTADOR', 
        FD.PESO_NETO 'PESO NETO', 
        FD.PESO_BRUTO 'PESO BRUTO',
        FD.VALOR_TOTAL_FOB 'VALOR FOB', 
        FD.VALOR_ADUANA 'VALOR CIF', 
        ED.TRM 'TRM',
        DATE_FORMAT(DT.FECHA_DOC_TRANS, '%d/%m/%Y') 'FECHA DOC TRANS',
        DT.NUMERO_DOC_TRANS 'NUMERO DOC TRANS', 
        DATE_FORMAT(DT.FECHA_MANIFIESTO , '%d/%m/%Y')'FECHA MANIFIESTO', 
        DT.NUMERO_MANIFIESTO 'NUMERO MANIFIESTO', 
        FD.NUMERO_STICKER 'NUMERO STICKER', 
        DATE_FORMAT(FD.FECHA_PAGO, '%d/%m/%Y') 'FECHA PAGO', 
        TD.NOMBRE_TIPO_DECLARACION 'DIM', 
        FD.SELECTIVIDAD 'SELECTIVIDAD', 
        FD.VALOR_TOTAL_FOB 'VALOR TOTAL FOB', 
        FD.VALOR_FLETES 'VALOR FLETES', 
        FD.VALOR_SEGUROS 'VALOR SEGUROS', 
        FD.VALOR_OTROS_GASTOS 'VALOR OTROS GASTOS', 
        FD.AJUSTE_VALOR 'AJUSTE VALOR', 
        FD.VALOR_ADUANA 'VALOR ADUANA', 
        FD.PORCENTAJE_ARANCEL 'PORCENTAJE ARANCEL', 
        FD.BASE_ARANCEL 'BASE ARANCEL', 
        FD.TOTAL_ARANCEL 'TOTAL ARANCEL', 
        FD.PORCENTAJE_IVA 'PORCENTAJE IVA', 
        FD.BASE_IVA 'BASE IVA', 
        FD.TOTAL_IVA 'TOTAL IVA', 
        FD.TOTAL_LIQUIDADO 'TOTAL LIQUIDADO', 
        FD.NUMERO_LEVANTE 'NUMERO LEVANTE', 
        DATE_FORMAT(FD.FECHA_LEVANTE, '%d/%m/%Y') 'FECHA LEVANTE', 
        IF(INSTR(FD.NUMERO_ACEPTACION,'M')=0,'DECLARACION VIRTUAL','DECLACION MANUAL') 'TIPO TRANSMISION', 
        I.CODIGO_UAP 'CODIGO UAP', 
        FD.NUMERO_ACEPTACION 'NUMERO ACEPTACION', 
        FD.FORMULARIO_FISICO 'FORMULARIO FISICO', 
        DATE_FORMAT(FD.FECHA_ACEPTACION, '%d/%m/%Y') 'FECHA ACEPTACION', 
        DATE_FORMAT(IM.FECHA_RETIRO_TOTAL, '%d/%m/%Y') 'FECHA RETIRO TOTAL', 
        FD.CODIGO_MODALIDAD 'MODALIDAD', 
        FD.CODIGO_POSICION 'SUBPARTIDA', 
        CP.CODIGO_UNIDAD_CCIAL_DIAN 'UNIDAD CCIAL', 
        FD.CANTIDAD 'CANTIDAD', 
        FD.BULTOS 'BULTOS', 
        FD.NUMERO_REG_LICENCIA 'NUMERO REG LICENCIA', 
        FD.PROGRAMA_AUTORIZADO 'PROGRAMA AUTORIZADO', 
        FD.CIP 'CIP', 
        PA.NOMBRE_PAIS 'PAIS PROCEDENCIA', 
        PA1.NOMBRE_PAIS 'PAIS ORIGEN', 
        FD.CODIGO_REG_LICENCIA 'CODIGO REG', 
        FD.NUMERO_REG_LICENCIA 'NRO REGISTRO',
        FD.CODIGO_ACUERDO 'ACUERDO', 
        NULL DESCRIPCION, 
        IM.CODIGO_DEPOSITO 'CODIGO DEPOSITO', 
        T.NOMBRE_TRANSPORTADOR ' NOMBRE TRANSPORTADOR'

    FROM FORMULARIOS_DIS FD

        INNER JOIN POSICION_ARANCELARIA CP        ON CP.CODIGO_POSICION = FD.CODIGO_POSICION
        INNER JOIN ESTADOS_DO ED                  ON ED.NUMERO_DO = FD.NUMERO_DO
        INNER JOIN IMPORTACIONES IM               ON IM.NUMERO_DO = FD.NUMERO_DO
        INNER JOIN ADMINISTRACIONES A             ON IM.CODIGO_ADMINISTRACION = A.CODIGO_ADMINISTRACION
        INNER JOIN CABEZA_FACTURAS CF             ON CF.ID_CABEZA_FACTURA = FD.ID_CABEZA_FACTURA
        INNER JOIN EXPORTADORES EX                ON EX.ID_EXPORTADOR = CF.ID_EXPORTADOR
        INNER JOIN IMPORTADORES I                 ON ED.ID_IMPORTADOR = I.ID_IMPORTADOR
        INNER JOIN EMPLEADOS EM                   ON EM.ID_EMPLEADO = FD.ID_DECLARANTE
        INNER JOIN DOCUMENTOS_TRASPORTE DT        ON FD.NUMERO_DO = DT.NUMERO_DO
        INNER JOIN TRASPORTADORES T               ON T.CODIGO_TRANSPORTADOR=DT.CODIGO_TRANSPORTADOR
        INNER JOIN TIPOS_DECLARACION TD           ON FD.CODIGO_TIPO_DECLARACION = TD.CODIGO_TIPO_DECLARACION
        INNER JOIN PAISES PA                      ON PA.CODIGO_PAIS = EX.CODIGO_PAIS
        INNER JOIN PAISES PA1                     ON PA1.CODIGO_PAIS = FD.CODIGO_PAIS_ORIGEN
        LEFT OUTER JOIN SEGMENTOS_CLIENTES SC     ON ED.ID_SEGMENTO_CLIENTE = SC.ID_SEGMENTO_CLIENTE

    $filtros  
    $param_fecha
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
                    $objDrawing->setOffsetX(10);    
                    $objDrawing->setOffsetY(5);  
                    $objDrawing->setCoordinates('AH1');
                    $objDrawing->setHeight(100); 
                    $objDrawing->setWorksheet($objPHPExcel->setActiveSheetIndex(0));

        // Fijar titulo del informe y quitar lineas de division 
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue( "A2", $titulo)
                    ->setShowGridlines(false);

        // Ancho de la fila
        $objPHPExcel->getActiveSheet()->getRowDimension(1 )->setRowHeight( 80 );
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

                        // Calcular digito de verificacion de la aceptacion
                        if ($j==49){
                            $formulario=digitoverificacion($reg[$j-1]);
                            
                            $objPHPExcel->setActiveSheetIndex(0)
                             ->setCellValue( $columnas[$j] . $filaexcel, $formulario );

                        }
                    }

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
                        case 49:
                        {
                            $formulario=digitoverificacion($reg[$j-1]);
                             $fila .=  "<td align='center'>". $formulario ."</td>";
                         
                        }
                        default:
                        {  
                            $fila .= "<td>". utf8_decode($reg[$j])."</td>";
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