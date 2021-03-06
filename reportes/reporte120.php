<?php
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
    $param_fecha="";
    $titulo="BITÁCORA DE OPERACIONES";
    $registros = "";

    if($numerodo=="" && $numeroped=="" && $ordencompra=="" && $doctrans=="" ){

        $filtros = " WHERE ED.ANULADO='N' AND ED.TIPO_REGIMEN='I'";

        if($sucursal  !="0") $filtros .= " AND ED.CODIGO_SUCURSAL_OP='$sucursal' ";
        if($importador!="0") $filtros .= " AND ED.ID_IMPORTADOR='$importador' ";
        if($tercero!="0") $filtros  .= " AND ED.ID_TERCERO='$tercero' ";
        if($ejecutivo!="0") $filtros  .= " AND ED.ID_EMPLEADO_OP='$ejecutivo' ";
        

        if($faperturai<>"")   $param_fecha .="AND (ED.FECHA_APERTURA     >= '$faperturai 00:00:00'  AND  ED.FECHA_APERTURA    <= '$faperturaf 23:59:59') ";
        if($flevantei<>"")    $param_fecha .="AND (I.FECHA_LEVANTE      >= '$flevantei 00:00:00'   AND  I.FECHA_LEVANTE     <= '$flevantef 23:59:59') ";
        if($faceptai<>"")     $param_fecha .="AND (I.FECHA_ACEPTACION   >= '$faceptai 00:00:00'    AND  I.FECHA_ACEPTACION  <= '$faceptaf 23:59:59') ";
        if($fmercanciai<>"")  $param_fecha .="AND (I.FECHA_LIBERACION   >= '$fmercanciai 00:00:00' AND  I.FECHA_LIBERACION  <= '$fmercanciaf 23:59:59') ";
        if($fretiroi<>"")     $param_fecha .="AND (I.FECHA_RETIRO_TOTAL >= '$fretiroi 00:00:00'    AND  I.FECHA_LIBERACION  <= '$fretirof 23:59:59') ";
        if($fstickeri<>"")    $param_fecha .="AND (I.FECHA_PAGO         >= '$fstickeri 00:00:00'   AND  I.FECHA_PAGO        <= '$fstickerf 23:59:59') ";
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
    include("../config/funciones.php");
    conectaremoto();

    // Dim - Reporte de Tributos por DIM
    $sql  = "SELECT
    CASE DATE_FORMAT(ED.FECHA_APERTURA, '%m') WHEN '01' Then 'Enero'  WHEN '02' Then 'Febrero'
    WHEN '03' Then 'Marzo' WHEN '04' Then 'Abril' WHEN '05' Then 'Mayo' WHEN '06' Then 'Junio'
    WHEN '07' Then 'Julio' WHEN '08' Then 'Agosto' WHEN '09' Then 'Septiembre'
    WHEN '10' Then 'Octubre' WHEN '11' Then 'Noviembre' WHEN '12' Then 'Diciembre' END AS MES,

    ED.NUMERO_PEDIDO PEDIDO, NULL ITM, CC.NOMBRE_CONTACTO CANAL, ED.NUMERO_DO, DT.NUMERO_DOC_TRANS BL,

    LE.NOMBRE_LUGAR_EMBAR_ARRIB_INAL 'PUERTO EMBARQUE', CF.TOTAL_FACTURA_ACTUAL_USD, CF.FLETE 'VALOR FLETES',
    CF.CODIGO_CONDICION_ENTREGA 'TERMINO NEGOCIACION',   I.CODIGO_LUGAR_INGRESO,

    P.CODIGO_PRODUCTO 'CODIGO MATERIAL', UCASE(COALESCE(P.NOMBRE_COMERCIAL_PROD, ''))  PRODUCTO, P.UNIDAD_NEGOCIO_HUBEMAR 'BU', P.UNIDAD_NEGOCIO_HUBEMAR 'SBU', I.FECHA_ESTIMADA_ARRIBO,
    I.FECHA_ESTIMADA_ARRIBO 'FECHA ESTIMADA ARRIBO' , I.FECHA_MANIFIESTO 'FECHA MANIFIESTO',
    I.FECHA_ESTIMADA_LEVANTE 'FECHA ESTIMADA LEVANTE',I.FECHA_ESTIMADA_BODEGA 'FECHA ESTIMADA BODEGA', I.FECHA_MERCANCIA_EN_PLANTA 'FECHA BODEGA',

    UCASE(COALESCE(I.BODEGA_DESTINO_CLIENTE, '') ) 'DESTINO', I.FECHA_LLEGADA_MCIA 'ETD',
    I.FECHA_DOCUMENTOS_OK_CLIENTE, I.FECHA_DOCS_OK, I.FECHA_ARBOL_DOCUMENTOS,
    I.FECHA_ESTIMADA_LEVANTE, I.FECHA_LEVANTE, I.FECHA_ESTIMADA_BODEGA, I.FECHA_MERCANCIA_EN_PLANTA EN_BODEGA, NULL COMENTARIOS,
    DF.CANTIDAD, DF.CODIGO_UNIDAD_CCIAL_DIAN, CF.NUMERO_FACTURA, CF.FECHA_FACTURA, CF.DIAS_PLAZO_HUBEMAR, EX.NOMBRE_EXPORTADOR,
    UCASE(COALESCE(PA.NOMBRE_PAIS, '')) PAIS, DT.MOTONAVE, DT.FECHA_DOC_TRANS, I.LUGAR_ENTREGA, UCASE(T.NOMBRE_TRANSPORTADOR) TRANSPORTADOR,

    I.FECHA_BL_ORIGINAL_OK, I.FECHA_FACTURAS_OK, I.FECHA_DOCS_OK, null 'ITM',
    I.FECHA_ACEPTACION, I.FECHA_PLANILLA, I.FECHA_DOCS_TRANSPORTADOR, E.NOMBRE_PERSONA EJECUTIVO  ,


    CASE UC.CARGA_EN_CONTENEDOR WHEN 1 THEN  'SUELTA'    WHEN 2 THEN 'CONTENEDORIZADA' WHEN 3 THEN 'GRANEL'
    WHEN 4 THEN 'MIXTA'           WHEN 5 THEN 'ISOTANQUE'    WHEN 6 THEN 'FLEXITANQUE' ELSE 'NO DEFINIDO' END AS BITACORA,
    GROUP_CONCAT(DISTINCT UC.NUMERO_ID_CONTENEDOR) EMBALAJE,    COUNT(DISTINCT UC.CARGA_EN_CONTENEDOR) CANTIDAD


    FROM ESTADOS_DO ED
    INNER JOIN IMPORTACIONES I ON I.NUMERO_DO=ED.NUMERO_DO
    INNER JOIN DOCUMENTOS_TRASPORTE DT ON DT.NUMERO_DO=ED.NUMERO_DO
    INNER JOIN TRASPORTADORES T ON T.CODIGO_TRANSPORTADOR=DT.CODIGO_TRANSPORTADOR

    LEFT OUTER JOIN ex_lugares_embar_arrib_inales     LE  ON LE.CODIGO_LUGAR_EMBAR_ARRIB_INAL=DT.CODIGO_LUGAR_EMBAR_ARRIB_INAL
    LEFT OUTER JOIN CABEZA_FACTURAS CF ON CF.NUMERO_DO=ED.NUMERO_DO
    INNER JOIN EXPORTADORES EX ON EX.ID_EXPORTADOR=CF.ID_EXPORTADOR
    INNER JOIN DETALLES_FACTURAS DF ON DF.ID_CABEZA_FACTURA=CF.ID_CABEZA_FACTURA
    INNER JOIN PRODUCTOS P ON P.ID_PRODUCTO=DF.ID_PRODUCTO
    INNER JOIN EMPLEADOS E ON E.ID_EMPLEADO=ED.ID_EMPLEADO_OP
    LEFT OUTER JOIN CONTACTOS_CLIENTES CC ON CC.ID_CONTACTO_CLIENTE=ED.ID_CONTACTO_CLIENTE
    LEFT OUTER JOIN PAISES PA ON PA.CODIGO_PAIS=CF.PAIS_COMPRA
    RIGHT OUTER JOIN UNIDADES_CARGA UC ON ED.NUMERO_DO=UC.NUMERO_DO

    
    $filtros  
    $param_fecha
    GROUP BY ED.NUMERO_DO, CF.NUMERO_FACTURA ORDER BY ED.FECHA_APERTURA, ED.NUMERO_DO

";    
 
    $tmp = ""; 

    $nr=0;
    $res =  mysql_query($sql);
    $fila = "<tr>";
    $txt = "";
    if($tipo=="XLS" || $tipo=="TXT" || $tipo=="HTML") {
        if(!empty($res)) {
            $tmp = ""; 
            $nr = mysql_num_rows($res);
            
            $registros = " Registros $nr";
            $nf = mysql_num_fields($res);

            //TITULOS DE CABECERA
            for($j=0; $j<$nf; $j++) {
                $fila .= "<th>". utfHubemar(mysql_field_name($res, $j)) ."</th>";
                $txt .= mysql_field_name($res, $j)." ";
            }

            $txt .=PHP_EOL;
            $fila .= "</tr>";
            $rawdata = array(); $i=0;
            $sw=0;

            //LECTURA QUERY
            while($reg = @mysql_fetch_array($res)) {
                $fila .= "<tr>";
                $rawdata[$i] = $reg;
                for($j=0; $j<$nf; $j++) {
                    $fila .= "<td>".$reg[$j]."</td>";
                    switch ($j) {
                        case 2:  $txt .= esp($reg[$j],3)." ";  break;
                        case 5:  $txt .= esp($reg[$j],33)." ";  break;
                        default: $txt .= $reg[$j]." "; break;
                    }
                }
                $i+=1;
                $txt  .= PHP_EOL;
                $fila .= "</tr>";
            }
        }  
        $tabla = "<table border='1' cellpadding='2' cellspacing='0'>$fila</table>";
    }
    

    switch ($tipo) {            
        case 'XLS':
            header('Content-type: application/vnd.ms-excel');
            header("Content-Disposition: attachment; filename=" .$titulo .".xls");
            header("Pragma: no-cache");
            header("Expires: 0");
        case 'HTML':
            echo "  <link rel='stylesheet' href='../css/pushy.css'>
                    <link rel='stylesheet' href='../css/bootstrap.css'>
                    <link rel='stylesheet' href='../css/bootstrap.min.css'>
                    <link rel='stylesheet' href='../css/bootstrap-responsive.css'>
                    <link rel='stylesheet' href='../css/bootstrap-responsive.min.css'>
                    <link rel='icon' type='image/jpg' href='../img/logo-hubemar.png' /> 
                    <head>
                        <meta charset='UTF-8'>
                        <title>
                            $titulo
                        </title>
                    </head>
                        <style> 
                            body { font-family: Arial; }
                            th { background-color: #575656; color: white;  }
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

            echo   "<center><h3><img style='width: 60px;' src='../img/logo1.png'><br>$titulo</h3>".fechaactual(2)." - $registros</center>
                    <div id='info' style='margin-left:15px'>
                        <table border='1' cellpadding='2' class='table table-bordered table-condensed' cellspacing='0'>$fila</table>
                    </div>";

            break;
        case 'TXT':
            header('Content-type: application/msword');
            header('Content-Disposition: inline; filename='.$file.'.txt'); 
            echo (utf8_encode($txt));
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
            
            // Predeterminando ancho de columnas
            for($x=0; $x<=70; $x++) $c[$x] = 50;
            // Personalizado
            $c[0] = 20; $c[1] = 15; $c[2] = 15; $c[3] = 30; $c[4] = 20; $c[5] = 60;  $c[9] = 80; 
            $c[12] = 80;  $c[18] = 25; $c[19] = 25; $c[20] = 30; $c[21] = 25; $c[22] = 25; $c[23] = 40; 
            $c[67]=140;

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