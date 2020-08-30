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
    $titulo="CONTENEDORES TRAZABILIDAD";
    // Nombre del archivo 
    $archivo="CONTENEDORES_TRAZABILIDAD";
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

    $dimensionCol = array (17.71, 21.29, 20.43, 20.43, 33.71, 10.57, 15.86, 14.29, 48.29, 15.71, 15.71, 14.29, 14.29, 14.29, 14.29, 14.29, 14.29, 19, 14.29, 23, 23, 30.43, 14.14, 19, 14.14, 16.71,  14.14, 20.29, 19.86, 10.71, 14.14, 14.14, 24.14, 14.14, 14.14, 12.71, 12.71, 12.71, 10.71, 15, 16.57, 15.43, 15.43, 15.43, 15.43, 15.43, 15.43, 15.43, 15.43, 15.43, 14.14, 14.14, 16.71, 16.71, 10.71, 12.86, 12.86, 12.86, 12.86, 12.86);

    $dimensionc_contro = array(20, 11, 11, 11, 11, 11, 11, 11, 11, 14, 14, 14, 14, 14, 14);


    $tipodato= array('T','T','T','T','T','T','T','D','T','T','T','D','D','T','D','D','D','T','D','T','T','T','T','D','T','D','D','D','T','T','T','D','T','T','T','E','E','E','E','N','N','T','N','N','N','N','N','N','E','E','E','E','E','E','E','E','E','E','E','E');

    $calendario_festivo=festivos();

    if($numerodo=="" && $numeroped=="" && $ordencompra=="" && $doctrans=="" ){

        $filtros = " WHERE ED.TIPO_REGIMEN='I' AND ED.ANULADO='N' ";

        if($sucursal  !="0") $filtros   .= " AND ED.CODIGO_SUCURSAL_OP='$sucursal' ";
        if($importador!="0") $filtros   .= " AND ED.ID_IMPORTADOR='$importador' ";
        if($tercero!="0") $filtros      .= " AND ED.ID_TERCERO='$tercero' ";
        if($ejecutivo!="0") $filtros    .= " AND ED.ID_EMPLEADO_OP='$ejecutivo' ";

        if($faperturai<>"")   $param_fecha .="AND (ED.FECHA_APERTURA                    >= '$faperturai 00:00:00'  
                                              AND  ED.FECHA_APERTURA                    <= '$faperturaf 23:59:59') ";

        if($flevantei<>"")    $param_fecha .="AND (FD.FECHA_LEVANTE                     >= '$flevantei 00:00:00'   
                                              AND FD.FECHA_LEVANTE                      <= '$flevantef 23:59:59') ";

        if($faceptai<>"")     $param_fecha .="AND (FD.FECHA_ACEPTACION                  >= '$faceptai 00:00:00'    
                                              AND  FD.FECHA_ACEPTACION                  <= '$faceptaf 23:59:59') ";

        if($fmercanciai<>"")  $param_fecha .="AND (IM.IM.FECHA_MERCANCIA_EN_PLANTA      >= '$fmercanciai 00:00:00' 
                                              AND  IM.IM.FECHA_MERCANCIA_EN_PLANTA      <= '$fmercanciaf 23:59:59') ";

        if($fretiroi<>"")     $param_fecha .="AND (IM.FECHA_RETIRO_TOTAL                >= '$fretiroi 00:00:00'    
                                              AND  IM.FECHA_RETIRO_TOTAL                <= '$fretirof 23:59:59') ";

        if($fstickeri<>"")    $param_fecha .="AND (FD.FECHA_PAGO                        >= '$fstickeri 00:00:00'   
                                              AND  FD.FECHA_PAGO                        <= '$fstickerf 23:59:59') ";

        if($ffacturai<>"")    $param_fecha .="AND (ED.FECHA_FACTURA                     >= '$ffacturai 00:00:00'   
                                              AND  ED.FECHA_FACTURA                     <= '$ffacturaf 23:59:59') ";


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
    $calendario_festivo=festivos();

    
    $sql  = "SELECT ED.NUMERO_DO 'NUMERO DO',
                    ED.NUMERO_PEDIDO 'PEDIDO',
                    SC.NOMBRE_SEGMENTO 'SEGMENTO',
                    MR.NOMBRE_MODALIDAD 'MODALIDAD',
                    LEFT(ED.DESCRIPCION,250)  'PRODUCTO',
                    CF.CODIGO_CONDICION_ENTREGA 'INCOTERM',

                    CASE DATE_FORMAT(ED.FECHA_APERTURA, '%m') WHEN '01' Then 'ENERO'  WHEN '02' Then 'FEBRERO'
                    WHEN '03' Then 'MARZO' WHEN '04' Then 'ABRIL' WHEN '05' Then 'MAYO' WHEN '06' Then 'JUNIO'
                    WHEN '07' Then 'JULIO' WHEN '08' Then 'AGOSTO' WHEN '09' Then 'SEPTIEMBRE'
                    WHEN '10' Then 'OCTUBRE' WHEN '11' Then 'NOVIEMBRE' WHEN '12' Then 'DICIEMBRE' ELSE ' ' END AS 'MES APERTURA',

                    DATE_FORMAT(ED.FECHA_APERTURA, '%d/%m/%Y') 'FECHA APERTURA',
                    EX.NOMBRE_EXPORTADOR 'PROVEEDOR',
                    CF.NUMERO_FACTURA  'FACTURA IMPORTACION',
                    CF.NUMERO_LISTA_EMPAQUE 'ORDEN DE COMPRA',
                    DATE_FORMAT(IM.FECHA_DOCUMENTOS_OK_CLIENTE, '%d/%m/%Y') 'DOC OK CLIENTE',
                    DATE_FORMAT(IM.FECHA_DOCS_OK , '%d/%m/%Y') 'DOC OK',

                    CASE DATE_FORMAT(IM.FECHA_MANIFIESTO , '%m') WHEN '01' Then 'ENERO'  WHEN '02' Then 'FEBRERO'
                    WHEN '03' Then 'MARZO' WHEN '04' Then 'ABRIL' WHEN '05' Then 'MAYO' WHEN '06' Then 'JUNIO'
                    WHEN '07' Then 'JULIO' WHEN '08' Then 'AGOSTO' WHEN '09' Then 'SEPTIEMBRE'
                    WHEN '10' Then 'OCTUBRE' WHEN '11' Then 'NOVIEMBRE' WHEN '12' Then 'DICIEMBRE' ELSE ' ' END AS 'MES MANIFIESTO',


                    DATE_FORMAT(IM.FECHA_MANIFIESTO, '%d/%m/%Y') 'FECHA MANIFIESTO' ,
                    DATE_FORMAT(IM.FECHA_LLEGADA_MCIA, '%d/%m/%Y') 'LLEGADA DE MCIA',
                    DATE_FORMAT(IM.FECHA_LIBERACION, '%d/%m/%Y') 'FECHA LIBERACION',
                    DT.NUMERO_DOC_TRANS 'DOC TRANSPORTE',
                    DATE_FORMAT(DT.FECHA_DOC_TRANS, '%d/%m/%Y') 'FECHA DOC TRANSP',
                    PA.NOMBRE_PAIS 'PAIS PROCEDENCIA',
                    UCASE(DT.MOTONAVE) 'MOTONAVE',
                    UCASE(LE.NOMBRE_LUGAR_EMBAR_ARRIB_NAL) 'PUERTO DE ARRIBO',

                    DATE_FORMAT(IM.FECHA_ARBOL_DOCUMENTOS, '%d/%m/%Y') 'CONSULTA INVENTARIOS',
                    DATE_FORMAT(IM.FECHA_ACEPTACION, '%d/%m/%Y') 'FECHA ACEPTACION',

                    CASE DATE_FORMAT(IM.FECHA_LEVANTE, '%m') WHEN '01' Then 'ENERO'  WHEN '02' Then 'FEBRERO'
                    WHEN '03' Then 'MARZO' WHEN '04' Then 'ABRIL' WHEN '05' Then 'MAYO' WHEN '06' Then 'JUNIO'
                    WHEN '07' Then 'JULIO' WHEN '08' Then 'AGOSTO' WHEN '09' Then 'SEPTIEMBRE'
                    WHEN '10' Then 'OCTUBRE' WHEN '11' Then 'NOVIEMBRE' WHEN '12' Then 'DICIEMBRE' ELSE ' ' END AS 'MES LEVANTE',

                    DATE_FORMAT(IM.FECHA_LEVANTE , '%d/%m/%Y') 'FECHA LEVANTE',
                    DATE_FORMAT(IM.FECHA_DOCS_TRANSPORTADOR, '%d/%m/%Y') 'ENTREGA TRANSPORTADOR',
                    DATE_FORMAT(IM.FECHA_RETIRO_TOTAL, '%d/%m/%Y') 'FECHA DE RETIRO',
                    TR.NOMBRE_TRANSPORTADOR 'TRANSPORTADOR',
                    MT.NOMBRE_MEDIO_TRANS 'MEDIO TRANSP.',
                    ED.NUMERO_FACTURA 'NUMERO FACTURA',
                    DATE_FORMAT(ED.FECHA_FACTURA, '%d/%m/%Y') 'FECHA FACTURA',
                    A.NOMBRE_ADMINISTRACION 'ADUANA',

                    CASE UC.CARGA_EN_CONTENEDOR WHEN '1' THEN 'CARGA SUELTA' WHEN '2' THEN 'CONTENEDORIZADA'
                                                WHEN '3' THEN  'GRANEL' WHEN '4' THEN 'MIXTA' WHEN '5' THEN  'ISOTANQUE'
                                                WHEN '6' THEN 'FLEXITANQUE' ELSE 'CARGA SUELTA' END AS 'TIPO CARGA',


                    GROUP_CONCAT( DISTINCT CONCAT(UC.NUMERO_ID_CONTENEDOR, ' ' )) 'No. CONTENEDOR',


                    IF(UC.TAMANO=1, COUNT(DISTINCT UC.NUMERO_ID_CONTENEDOR), 0) 'CONT 20',
                    IF(UC.TAMANO=3, COUNT(DISTINCT UC.NUMERO_ID_CONTENEDOR), 0) 'CONT 40',
                    IF(UC.TAMANO=2, COUNT(DISTINCT UC.NUMERO_ID_CONTENEDOR), 0) 'HIGH CUBE',
                    IF(UC.TAMANO=5, COUNT(DISTINCT UC.NUMERO_ID_CONTENEDOR), 0) 'CONT 45',

                    DT.PESO_BRUTO 'PESO BRUTO',
                    DT.PESO  'PESO NETO',
                    IM.BODEGAJE_GESTION_COMERCIAL_VALOR 'ALMACENAJE',
                    IM.BODEGAJE_GESTION_LOGISTICA_VALOR 'DEMORAS' ,
                    SUM(FD.VALOR_TOTAL_FOB) 'FOB USD' ,
                    SUM(FD.VALOR_FLETES)   'FLETE USD' ,
                    SUM(FD.VALOR_SEGUROS)   'SEGUROS USD' ,
                    SUM(FD.VALOR_OTROS_GASTOS) 'OTROS USD' ,
                    SUM(FD.VALOR_ADUANA)    'VALOR ADUANA USD',
                    SUM(FD.TOTAL_ARANCEL)   'ARANCEL COP',
                    SUM(FD.TOTAL_IVA) 'IVA COP',
                    SUM(FD.TOTAL_LIQUIDADO) 'TOTAL LIQUIDADO COP',

                    NULL 'FECHA LLEGADA MCIA VS FECHA DOC OK CLIENTE',
                    NULL 'MANIFIESTO VS LEVANTE',
                    NULL 'LEVANTE VS ENTREGA TRANSPORTADOR',
                    NULL 'LEVANTE VS RETIRO',
                    NULL 'ETA VS LEVANTE',
                    NULL 'ETA VS LIBERACION DE BL',
                    NULL 'RECIBO DTOS VS ACEPTACION',
                    NULL 'CONSULTA VS LEVANTE',
                    NULL 'ETA VS RECIBO DTOS'

            FROM ESTADOS_DO ED
                    INNER JOIN IMPORTACIONES IM ON IM.NUMERO_DO=ED.NUMERO_DO
                    INNER JOIN ADMINISTRACIONES  A    ON A.CODIGO_ADMINISTRACION=IM.CODIGO_ADMINISTRACION
                    INNER JOIN DOCUMENTOS_TRASPORTE DT ON DT.NUMERO_DO=ED.NUMERO_DO
                    INNER JOIN MODALIDADES_REGIMENES MR ON MR.ID_MODALIDAD=ED.ID_MODALIDAD
                    INNER JOIN MEDIOS_TRASPORTE  MT ON MT.CODIGO_MEDIO_TRANS=DT.CODIGO_MEDIO_TRANS


                    LEFT OUTER JOIN SEGMENTOS_CLIENTES SC ON SC.ID_SEGMENTO_CLIENTE=ED.ID_SEGMENTO_CLIENTE
                    LEFT OUTER JOIN PAISES          PA   ON PA.CODIGO_PAIS        =DT.CODIGO_PAIS_PROCEDENCIA
                    LEFT OUTER JOIN ex_lugares_embar_arrib_nales  LE ON LE.CODIGO_LUGAR_EMBAR_ARRIB_NAL=DT.CODIGO_LUGAR_EMBAR_ARRIB_NAL
                    LEFT OUTER JOIN TRASPORTADORES TR ON DT.CODIGO_TRANSPORTADOR=TR.CODIGO_TRANSPORTADOR
                    LEFT OUTER JOIN FORMULARIOS_DIS FD ON FD.NUMERO_DO=ED.NUMERO_DO
                    LEFT OUTER JOIN UNIDADES_CARGA  UC ON UC.NUMERO_DO=ED.NUMERO_DO

                    LEFT OUTER JOIN CABEZA_FACTURAS CF ON CF.NUMERO_DO=ED.NUMERO_DO
                    INNER JOIN EXPORTADORES EX ON EX.ID_EXPORTADOR=CF.ID_EXPORTADOR

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

        //Crear nueva hoja
        $objWorksheet1 = $objPHPExcel->createSheet();
        $objWorksheet1->setTitle('CUADRO DE CONTROL');

        //Insertar imagen en archivo excel con PhpExcel
        $objDrawing = new PHPExcel_Worksheet_Drawing();
                    $objDrawing->setName('imgNotice');
                    $objDrawing->setDescription('Noticia');
                    $img = '../img/logo1.png'; 
                    $objDrawing->setPath($img);
                    $objDrawing->setOffsetX(30);    
                    $objDrawing->setOffsetY(5);  
                    $objDrawing->setCoordinates('Z1');
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
        $objPHPExcel->getActiveSheet()->getStyle("A2:I2" )->applyFromArray($estiloTituloColumnas);
        $objPHPExcel->getActiveSheet()->getStyle("A15:I15" )->applyFromArray($estiloTituloColumnas);

        // FORMATO DE CELDAS
        $objPHPExcel->getActiveSheet()->getStyle("A3:A14" )->applyFromArray($estiloInformacion);
        $objPHPExcel->getActiveSheet()->getStyle("A1:I1")->applyFromArray($estiloTituloReporte);
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

                        // Formulas de la hoja principal
                        switch($j){
                            // FECHA LLEGADA MCIA VS FECHA DOC OK CLIENTE
                            case 51:
                            {
          
                                     $objPHPExcel->setActiveSheetIndex(0)
                                    ->setCellValue( $columnas[$j] . $filaexcel, 
                                        '= IF( OR(P' . $filaexcel . '<=0,L' .$filaexcel . '<=0), "", NETWORKDAYS.INTL(L' . $filaexcel . ',P' .$filaexcel .',11, Festivos!$A$1:$A$1048576 )-1)');
                                  break;

                            }

                            //MANIFIESTO VS LEVANTE
                            case 52:
                            {
          
                                     $objPHPExcel->setActiveSheetIndex(0)
                                    ->setCellValue( $columnas[$j] . $filaexcel, 
                                        '= IF( OR(O' . $filaexcel . '<=0,Z' .$filaexcel . '<=0), "", NETWORKDAYS.INTL(O' . $filaexcel . ',Z' .$filaexcel .',11, Festivos!$A$1:$A$1048576 )-1)');
                                  break;

                            }

                            // LEVANTE VS ENTREGA TRANSPORTADOR
                            case 53:
                            {
          
                                     $objPHPExcel->setActiveSheetIndex(0)
                                    ->setCellValue( $columnas[$j] . $filaexcel, 
                                        '= IF( OR(Z' . $filaexcel . '<=0,AA' .$filaexcel . '<=0), "", NETWORKDAYS.INTL(Z' . $filaexcel . ',AA' .$filaexcel .',11, Festivos!$A$1:$A$1048576 )-1)');
                                  break;

                            }


                            //LEVANTE VS RETIRO
                            case 54:
                            {
          
                                     $objPHPExcel->setActiveSheetIndex(0)
                                    ->setCellValue( $columnas[$j] . $filaexcel, 
                                        '= IF( OR(Z' . $filaexcel . '<=0,AB' .$filaexcel . '<=0), "", NETWORKDAYS.INTL(Z' . $filaexcel . ',AB' .$filaexcel .',11, Festivos!$A$1:$A$1048576 )-1)');
                                  break;

                            }


                            // ETA VS LEVANTE
                            case 55:
                            {
          
                                     $objPHPExcel->setActiveSheetIndex(0)
                                    ->setCellValue( $columnas[$j] . $filaexcel, 
                                        '= IF( OR(P' . $filaexcel . '<=0,Z' .$filaexcel . '<=0), "", NETWORKDAYS.INTL(P' . $filaexcel . ',Z' .$filaexcel .',11, Festivos!$A$1:$A$1048576 )-1)');
                                  break;

                            }


                            // ETA VS LIBERACION DE BL
                            case 56:
                            {
          
                                     $objPHPExcel->setActiveSheetIndex(0)
                                    ->setCellValue( $columnas[$j] . $filaexcel, 
                                        '= IF( OR(P' . $filaexcel . '<=0,Q' .$filaexcel . '<=0), "", NETWORKDAYS.INTL(P' . $filaexcel . ',Q' .$filaexcel .',11, Festivos!$A$1:$A$1048576 )-1)');
                                  break;

                            }


                            // RECIBO DTOS VS ACEPTACION
                            case 57:
                            {
          
                                     $objPHPExcel->setActiveSheetIndex(0)
                                    ->setCellValue( $columnas[$j] . $filaexcel, 
                                        '= IF( OR(M' . $filaexcel . '<=0,Z' .$filaexcel . '<=0), "", NETWORKDAYS.INTL(M' . $filaexcel . ',Z' .$filaexcel .',11, Festivos!$A$1:$A$1048576 )-1)');
                                  break;

                            }

                            // CONSULTA VS LEVANTE
                            case 58:
                            {
          
                                     $objPHPExcel->setActiveSheetIndex(0)
                                    ->setCellValue( $columnas[$j] . $filaexcel, 
                                        '= IF( OR(W' . $filaexcel . '<=0,Z' .$filaexcel . '<=0), "", NETWORKDAYS.INTL(W' . $filaexcel . ',Z' .$filaexcel .',11, Festivos!$A$1:$A$1048576 )-1)');
                                  break;
                            }

                           // ETA VS RECIBO DTOS
                            case 59:
                            {
          
                                     $objPHPExcel->setActiveSheetIndex(0)
                                    ->setCellValue( $columnas[$j] . $filaexcel, 
                                        '= IF( OR(M' . $filaexcel . '<=0,P' .$filaexcel . '<=0), "", NETWORKDAYS.INTL(M' . $filaexcel . ',P' .$filaexcel .',11, Festivos!$A$1:$A$1048576 )-1)');
                                  break;

                            }                                                                          
                        }

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
                    } // Fin Else ($tipo=="XLS")
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
            
            $meses = array('ENERO', 'FEBRERO', 'MARZO', 'ABRIL', 'MAYO', 'JUNIO', 'JULIO', 'AGOSTO', 'SEPTIEMBRE', 'OCTUBRE', 'NOVIEMBRE', 'DICIEMBRE');
            $dimarray = count($meses);

            //Cabecera Tabla 1 
            $objPHPExcel->setActiveSheetIndex(2)->setCellValue("A2", "TIPO CARGA");
            $objPHPExcel->setActiveSheetIndex(2)->setCellValue("A3", "CONTENEDORIZADA");
            $objPHPExcel->setActiveSheetIndex(2)->setCellValue("A4", "CARGA SUELTA");
            $objPHPExcel->setActiveSheetIndex(2)->setCellValue("A5", "GRANEL");
            $objPHPExcel->setActiveSheetIndex(2)->setCellValue("A6", "TOTALES");
            
            //Cabecera Tabla 2
            $objPHPExcel->setActiveSheetIndex(2)->setCellValue("A9", "CONTENEDORES");
            $objPHPExcel->setActiveSheetIndex(2)->setCellValue("A10", "20 PIES");
            $objPHPExcel->setActiveSheetIndex(2)->setCellValue("A11", "40 PIES");
            $objPHPExcel->setActiveSheetIndex(2)->setCellValue("A12", "45 PIES");
            $objPHPExcel->setActiveSheetIndex(2)->setCellValue("A13", "HIGH CUBE");
            $objPHPExcel->setActiveSheetIndex(2)->setCellValue("A14", "TOTALES");
           
            //Cabecera Tabla 3
            $objPHPExcel->setActiveSheetIndex(2)->setCellValue("A17", "DIAS LEVANTE");
            $objPHPExcel->setActiveSheetIndex(2)->setCellValue("A18", "0 - 2 DIAS LEVANTE");
            $objPHPExcel->setActiveSheetIndex(2)->setCellValue("A19", "MAS DE 2  DIAS");
            $objPHPExcel->setActiveSheetIndex(2)->setCellValue("A20", "TOTALES");
            
            //Cabecera Tabla 4
            $objPHPExcel->setActiveSheetIndex(2)->setCellValue("A23", "ADUANAS");
            $objPHPExcel->setActiveSheetIndex(2)->setCellValue("A24", "BOGOTA");
            $objPHPExcel->setActiveSheetIndex(2)->setCellValue("A25", "CARTAGENA");
            $objPHPExcel->setActiveSheetIndex(2)->setCellValue("A26", "BARRANQUILLA");
            $objPHPExcel->setActiveSheetIndex(2)->setCellValue("A27", "BUENAVENTURA");
            $objPHPExcel->setActiveSheetIndex(2)->setCellValue("A28", "CALI");
            $objPHPExcel->setActiveSheetIndex(2)->setCellValue("A29", "MEDELLIN");
            $objPHPExcel->setActiveSheetIndex(2)->setCellValue("A30", "SANTA MARTA");
            $objPHPExcel->setActiveSheetIndex(2)->setCellValue("A31", "IPIALES");
            $objPHPExcel->setActiveSheetIndex(2)->setCellValue("A32", "TOTALES");

            for ($x=0; $x < 33; $x++) { 
                if ($x > 2 && $x <= 5) {
                    $objPHPExcel->getActiveSheet(2)->getStyle("A".$x)->applyFromArray($estilovertical);
                }
                if ($x > 9 && $x <= 13) {
                    $objPHPExcel->getActiveSheet(2)->getStyle("A".$x)->applyFromArray($estilovertical);
                }
                if ($x > 17 &&  $x <= 19) {
                    $objPHPExcel->getActiveSheet(2)->getStyle("A".$x)->applyFromArray($estilovertical);
                }
                if ($x > 23 &&  $x <= 31) {
                    $objPHPExcel->getActiveSheet(2)->getStyle("A".$x)->applyFromArray($estilovertical);
                }

                if ($x == 2) {
                    $objPHPExcel->getActiveSheet(2)->getStyle("A".$x)->applyFromArray($estilototales);
                }
                if ($x == 9) {
                    $objPHPExcel->getActiveSheet(2)->getStyle("A".$x)->applyFromArray($estilototales);
                }
                if ($x == 17) {
                    $objPHPExcel->getActiveSheet(2)->getStyle("A".$x)->applyFromArray($estilototales);
                }
                if ($x == 23) {
                    $objPHPExcel->getActiveSheet(2)->getStyle("A".$x)->applyFromArray($estilototales);
                }
            }

            $constante1 = 2;
            $constante2 = 9;
            $constante3 = 17;
            $constante4 = 23;

            for ($i=0; $i < $dimarray; $i++) { 
                //Asignar ancho a las celdas 
                $objPHPExcel->getActiveSheet(2)->getColumnDimension($columnas[$i])->setWidth($dimensionc_contro[$i]);
                //Colocar estilos a los meses
                $objPHPExcel->getActiveSheet()->getStyle($columnas[($i+1)].$constante1)->applyFromArray($estiloTituloColumnas);
                $objPHPExcel->getActiveSheet()->getStyle($columnas[($i+1)].$constante2)->applyFromArray($estiloTituloColumnas);
                $objPHPExcel->getActiveSheet()->getStyle($columnas[($i+1)].$constante3)->applyFromArray($estiloTituloColumnas);
                $objPHPExcel->getActiveSheet()->getStyle($columnas[($i+1)].$constante4)->applyFromArray($estiloTituloColumnas);
                
                //Imprimir los meses en cada celda
                $objPHPExcel->setActiveSheetIndex(2)->setCellValue($columnas[($i+1)].$constante1, $meses[$i]);
                $objPHPExcel->setActiveSheetIndex(2)->setCellValue($columnas[($i+1)].$constante2, $meses[$i]);
                $objPHPExcel->setActiveSheetIndex(2)->setCellValue($columnas[($i+1)].$constante3, $meses[$i]);
                $objPHPExcel->setActiveSheetIndex(2)->setCellValue($columnas[($i+1)].$constante4, $meses[$i]);

                //---------------------- Tabla 1 -------------------------
                $objPHPExcel->setActiveSheetIndex(2)->setCellValue($columnas[($i+1)].($constante1+1), "=COUNTIFS('CONTENEDORES TRAZABILIDAD'!AH:AH, 'CUADRO DE CONTROL'!A3, 'CONTENEDORES TRAZABILIDAD'!Y:Y, ".$columnas[($i+1)].$constante1.")");
                $objPHPExcel->getActiveSheet(2)->getStyle($columnas[($i+1)].($constante1+1))->applyFromArray($estiloInformacionD);

                $objPHPExcel->setActiveSheetIndex(2)->setCellValue($columnas[($i+1)].($constante1+2), "=COUNTIFS('CONTENEDORES TRAZABILIDAD'!AH:AH, 'CUADRO DE CONTROL'!A4, 'CONTENEDORES TRAZABILIDAD'!Y:Y, ".$columnas[($i+1)].$constante1.")");
                $objPHPExcel->getActiveSheet(2)->getStyle($columnas[($i+1)].($constante1+2))->applyFromArray($estiloInformacionD);

                $objPHPExcel->setActiveSheetIndex(2)->setCellValue($columnas[($i+1)].($constante1+3), "=COUNTIFS('CONTENEDORES TRAZABILIDAD'!AH:AH, 'CUADRO DE CONTROL'!A5, 'CONTENEDORES TRAZABILIDAD'!Y:Y, ".$columnas[($i+1)].$constante1.")");
                $objPHPExcel->getActiveSheet(2)->getStyle($columnas[($i+1)].($constante1+3))->applyFromArray($estiloInformacionD);

                $objPHPExcel->setActiveSheetIndex(2)->setCellValue($columnas[($i+1)].($constante1+4), "=SUM(".$columnas[($i+1)].($constante1+1).":".$columnas[($i+1)].($constante1+3).")");

                $objPHPExcel->getActiveSheet(2)->getStyle($columnas[($i)].($constante1+4))->applyFromArray($estilototales);

                //---------------------- Tabla 2 -------------------------
                $objPHPExcel->setActiveSheetIndex(2)->setCellValue($columnas[($i+1)].($constante2+1), "=SUMIFS('CONTENEDORES TRAZABILIDAD'!Aj:Aj, 'CONTENEDORES TRAZABILIDAD'!Y:Y, ".$columnas[($i+1)].$constante2.")");
                $objPHPExcel->getActiveSheet(2)->getStyle($columnas[($i+1)].($constante2+1))->applyFromArray($estiloInformacionD);

                $objPHPExcel->setActiveSheetIndex(2)->setCellValue($columnas[($i+1)].($constante2+2), "=SUMIFS('CONTENEDORES TRAZABILIDAD'!AK:AK, 'CONTENEDORES TRAZABILIDAD'!Y:Y, ".$columnas[($i+1)].$constante2.")");
                $objPHPExcel->getActiveSheet(2)->getStyle($columnas[($i+1)].($constante2+2))->applyFromArray($estiloInformacionD);

                $objPHPExcel->setActiveSheetIndex(2)->setCellValue($columnas[($i+1)].($constante2+3), "=SUMIFS('CONTENEDORES TRAZABILIDAD'!AM:AM, 'CONTENEDORES TRAZABILIDAD'!Y:Y, ".$columnas[($i+1)].$constante2.")");
                $objPHPExcel->getActiveSheet(2)->getStyle($columnas[($i+1)].($constante2+3))->applyFromArray($estiloInformacionD);

                $objPHPExcel->setActiveSheetIndex(2)->setCellValue($columnas[($i+1)].($constante2+4), "=SUMIFS('CONTENEDORES TRAZABILIDAD'!AL:AL, 'CONTENEDORES TRAZABILIDAD'!Y:Y, ".$columnas[($i+1)].$constante2.")");
                $objPHPExcel->getActiveSheet(2)->getStyle($columnas[($i+1)].($constante2+4))->applyFromArray($estiloInformacionD);

                $objPHPExcel->setActiveSheetIndex(2)->setCellValue($columnas[($i+1)].($constante2+5), "=SUM(".$columnas[($i+1)].($constante2+1).":".$columnas[($i+1)].($constante2+4).")");

                $objPHPExcel->getActiveSheet(2)->getStyle($columnas[($i)].($constante2+5))->applyFromArray($estilototales);

                //---------------------- Tabla 3 -------------------------
                $objPHPExcel->setActiveSheetIndex(2)->setCellValue($columnas[($i+1)].($constante3+1), "=COUNTIFS('CONTENEDORES TRAZABILIDAD'!Y:Y, ".$columnas[($i+1)].$constante3.", 'CONTENEDORES TRAZABILIDAD'!BA:BA, " . '"<3"' .")");
                $objPHPExcel->getActiveSheet(2)->getStyle($columnas[($i+1)].($constante3+1))->applyFromArray($estiloInformacionD);

                $objPHPExcel->setActiveSheetIndex(2)->setCellValue($columnas[($i+1)].($constante3+2), "=COUNTIFS('CONTENEDORES TRAZABILIDAD'!Y:Y,".$columnas[($i+1)].$constante3.", 'CONTENEDORES TRAZABILIDAD'!BA:BA, " . '">2"' .")");
                $objPHPExcel->getActiveSheet(2)->getStyle($columnas[($i+1)].($constante3+2))->applyFromArray($estiloInformacionD);

                $objPHPExcel->setActiveSheetIndex(2)->setCellValue($columnas[($i+1)].($constante3+3), "=SUM(".$columnas[($i+1)].($constante3+1).":".$columnas[($i+1)].($constante3+1).")");

                $objPHPExcel->getActiveSheet(2)->getStyle($columnas[($i)].($constante3+3))->applyFromArray($estilototales);

                //---------------------- Tabla 4 -------------------------
                for ($x=1; $x <= 8; $x++) { 

                    $objPHPExcel->setActiveSheetIndex(2)->setCellValue($columnas[($i+1)].($constante4+$x), "=COUNTIFS('CONTENEDORES TRAZABILIDAD'!Y:Y, ".$columnas[($i+1)].$constante4.", 'CONTENEDORES TRAZABILIDAD'!AG:AG, ".$columnas[(0)].($constante4+$x).")");
                    $objPHPExcel->getActiveSheet(2)->getStyle($columnas[($i+1)].($constante4+$x))->applyFromArray($estiloInformacionD);
                }

                $objPHPExcel->setActiveSheetIndex(2)->setCellValue($columnas[($i+1)].($constante4+9), "=SUM(".$columnas[($i+1)].($constante4+1).":".$columnas[($i+1)].($constante4+8).")");

                $objPHPExcel->getActiveSheet(2)->getStyle($columnas[($i)].($constante4+9))->applyFromArray($estilototales);
                
            }
            //Ultima Celda
            $objPHPExcel->getActiveSheet(2)->getColumnDimension($columnas[$i])->setWidth($dimensionc_contro[$i]);
            $objPHPExcel->getActiveSheet(2)->getStyle($columnas[($i)].($constante1+4))->applyFromArray($estilototales);
            $objPHPExcel->getActiveSheet(2)->getStyle($columnas[($i)].($constante2+5))->applyFromArray($estilototales);
            $objPHPExcel->getActiveSheet(2)->getStyle($columnas[($i)].($constante3+3))->applyFromArray($estilototales);
            $objPHPExcel->getActiveSheet(2)->getStyle($columnas[($i)].($constante4+9))->applyFromArray($estilototales);

            //Intento de insertar grafica a excel #1
            grafica();

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