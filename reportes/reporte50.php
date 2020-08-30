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
    $titulo="DECLARACIONES SIRCOC";

    if($numerodo=="" && $numeroped=="" && $ordencompra=="" && $doctrans=="" ){

        $filtros = " WHERE ED.ANULADO='N' AND ED.TIPO_REGIMEN='I'";

        if($sucursal  !="0") $filtros .= " AND ED.CODIGO_SUCURSAL_OP='$sucursal' ";
        if($importador!="0") $filtros .= " AND ED.ID_IMPORTADOR='$importador' ";
        if($tercero!="0") $filtros  .= " AND ED.ID_TERCERO='$tercero' ";
        if($ejecutivo!="0") $filtros  .= " AND ED.ID_EMPLEADO_OP='$ejecutivo' ";
        

        if($faperturai<>"")   $param_fecha .="AND (ED.FECHA_APERTURA     >= '$faperturai 00:00:00'  AND  ED.FECHA_APERTURA    <= '$faperturaf 23:59:59') ";
        if($flevantei<>"")    $param_fecha .="AND (FD.FECHA_LEVANTE      >= '$flevantei 00:00:00'   AND  FD.FECHA_LEVANTE     <= '$flevantef 23:59:59') ";
        if($faceptai<>"")     $param_fecha .="AND (FD.FECHA_ACEPTACION   >= '$faceptai 00:00:00'    AND  FD.FECHA_ACEPTACION  <= '$faceptaf 23:59:59') ";
        if($fmercanciai<>"")  $param_fecha .="AND (IM.FECHA_LIBERACION   >= '$fmercanciai 00:00:00' AND  IM.FECHA_LIBERACION  <= '$fmercanciaf 23:59:59') ";
        if($fretiroi<>"")     $param_fecha .="AND (IM.FECHA_RETIRO_TOTAL >= '$fretiroi 00:00:00'    AND  IM.FECHA_LIBERACION  <= '$fretirof 23:59:59') ";
        if($fstickeri<>"")    $param_fecha .="AND (FD.FECHA_PAGO         >= '$fstickeri 00:00:00'   AND  FD.FECHA_PAGO        <= '$fstickerf 23:59:59') ";
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
    $sql  = "SELECT ED.NUMERO_DO 'NUMERO DO', ED.NUMERO_PEDIDO 'NUMERO PEDIDO', DT.NUMERO_DOC_TRANS 'NUMERO DOC TRANS', DT.FECHA_DOC_TRANS 'FECHA DOC TRANS', P.CODIGO_PRODUCTO 'CODIGO PRODUCTO', M.NOMBRE_COMERCIAL 'NOMBRE COMERCIAL', PS.NOMBRE_PAIS 'NOMBRE PAIS', E.NOMBRE_EXPORTADOR 'NOMBRE EXPORTADOR', M.CANTIDAD 'CANTIDAD', D.NUMERO_FACTURA 'NUMERO FACTURA', D.TOTAL_FACTURA_ACTUAL 'TOTAL FACTURA ACTUAL', M.VALOR_UNITARIO 'VALOR UNITARIO', D.FECHA_FACTURA 'FECHA FACTURA', (M.EXW_PRORRATEO+M.SUM_NETO_PRORRATEO+M.VALOR_FOB_PRORRATEO) 'FOB', M.SEGURO_PRORRATEO 'SEGURO PRORRATEO',M.FLETE_PRORRATEO 'FLETE PRORRATEO', M.DESCARGUE_PRORRATEO 'DESCARGUE PRORRATEO', (M.EXW_PRORRATEO+M.SUM_NETO_PRORRATEO+ M.VALOR_FOB_PRORRATEO+M.SEGURO_PRORRATEO+M.FLETE_PRORRATEO+M.DESCARGUE_PRORRATEO) 'TOTAL USD', FD.NUMERO_ACEPTACION 'NUMERO ACEPTACION', FD.FECHA_ACEPTACION 'FECHA ACEPTACION', TD.NOMBRE_TIPO_DECLARACION 'NOMBRE TIPO DECLARACION', FD.NUMERO_STICKER 'NUMERO STICKER', ED.TRM 'TRM', FD.PORCENTAJE_ARANCEL 'PORCENTAJE ARANCEL', FD.TOTAL_ARANCEL 'TOTAL ARANCEL', FD.PORCENTAJE_IVA 'PORCENTAJE IVA', FD.TOTAL_IVA 'TOTAL IVA', FD.TOTAL_LIQUIDADO 'TOTAL LIQUIDADO', FD.TOTAL_ARANCEL_USD 'TOTAL ARANCEL USD', FD.TOTAL_IVA_USD 'TOTAL IVA USD', M.PESO_BRUTO_PRORRATEO 'PESO BRUTO PRORRATEO', M.PESO_NETO_PRORRATEO 'PESO NETO PRORRATEO', 'Nacionalizado' ESTADO, LI.NOMBRE_LUGAR_INGRESO 'NOMBRE LUGAR INGRESO', IM.CODIGO_ADMINISTRACION 'CODIGO ADMINISTRACION', I.NOMBRE_IMPORTADOR 'NOMBRE IMPORTADOR', DP.NOMBRE_DEPOSITO 'NOMBRE DEPOSITO', DP.CODIGO_DEPOSITO 'CODIGO DEPOSITO', D.CODIGO_CONDICION_ENTREGA 'CODIGO CONDICION ENTREGA', NULL, MT.NOMBRE_MEDIO_TRANS 'NOMBRE MEDIO TRANS', T.NOMBRE_TRANSPORTADOR 'NOMBRE TRANSPORTADOR', D.CODIGO_MONEDA 'CODIGO MONEDA', DT.NUMERO_MANIFIESTO 'NUMERO MANIFIESTO', I.NOMBRE_IMPORTADOR 'NOMBRE IMPORTADOR', FD.NUMERO_LEVANTE 'NUMERO LEVANTE', FD.FECHA_LEVANTE 'FECHA LEVANTE', FD.CODIGO_POSICION 'CODIGO POSICION', FD.BULTOS 'BULTOS', LI.CODIGO_LUGAR_INGRESO 'CODIGO LUGAR INGRESO', FD.CODIGO_TIPO_DECLARACION 'CODIGO TIPO DECLARACION', PA.CODIGO_UNIDAD_CCIAL_DIAN 'CODIGO UNIDAD CCIAL DIAN', FD.CODIGO_MODALIDAD 'CODIGO MODALIDAD', PA.CODIGO_UNIDAD_CCIAL_DIAN 'CODIGO UNIDAD CCIAL DIAN', FD.VALOR_TOTAL_FOB 'VALOR TOTAL FOB'

    FROM FORMULARIOS_DIS     FD

    LEFT OUTER JOIN DETALLES_FACTURAS         M     ON FD.ID_FORMULARIO_DI        = M.ID_FORMULARIO_DI
    LEFT OUTER JOIN PRODUCTOS                 P     ON M.ID_PRODUCTO              = P.ID_PRODUCTO
    LEFT OUTER JOIN CABEZA_FACTURAS           D     ON M.ID_CABEZA_FACTURA= D.ID_CABEZA_FACTURA
    LEFT OUTER JOIN EXPORTADORES              E     ON E.ID_EXPORTADOR=D.ID_EXPORTADOR
    LEFT OUTER JOIN DOCUMENTOS_TRASPORTE      DT    ON FD.NUMERO_DO            = DT.NUMERO_DO
    LEFT OUTER JOIN IMPORTACIONES             IM    ON IM.NUMERO_DO            = FD.NUMERO_DO
    LEFT OUTER JOIN ESTADOS_DO                ED    ON ED.NUMERO_DO            = FD.NUMERO_DO
    LEFT OUTER JOIN IMPORTADORES              I     ON I.ID_IMPORTADOR            = ED.ID_IMPORTADOR
    LEFT OUTER JOIN SUCURSALES                S     ON S.CODIGO_SUCURSAL          = ED.CODIGO_SUCURSAL_OP
    LEFT OUTER JOIN tipos_declaracion         TD    ON TD.CODIGO_TIPO_DECLARACION=FD.CODIGO_TIPO_DECLARACION
    LEFT OUTER JOIN LUGARES_INGRESO           LI    ON LI.CODIGO_LUGAR_INGRESO=IM.CODIGO_LUGAR_INGRESO
    LEFT OUTER JOIN DEPOSITOS                 DP    ON DP.CODIGO_DEPOSITO=IM.CODIGO_DEPOSITO
    LEFT OUTER JOIN MEDIOS_TRASPORTE          MT    ON MT.CODIGO_MEDIO_TRANS=DT.CODIGO_MEDIO_TRANS
    LEFT OUTER JOIN TRASPORTADORES            T     ON T.CODIGO_TRANSPORTADOR=DT.CODIGO_TRANSPORTADOR
    LEFT OUTER JOIN PAISES                    PS    ON PS.CODIGO_PAIS=M.CODIGO_PAIS_ORIGEN
    LEFT OUTER JOIN POSICION_ARANCELARIA      PA    ON PA.CODIGO_POSICION=FD.CODIGO_POSICION

    $filtros  
    $param_fecha
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
                $fila .= "<th>".mysql_field_name($res, $j)."</th>";
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
                    $fila .= "<td>".utf8_encode($reg[$j])."</td>";
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
                    <title>$titulo</title>
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