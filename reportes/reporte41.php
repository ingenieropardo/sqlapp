<?php
    $tipo         = $_GET['p_tipo']; 
    $sucursal     = $_GET['p_sucursal']; 
    $importador   = $_GET['p_importador']; 
    $ejecutivo    = $_GET['p_ejecutivo'];
    $reporte      = $_GET['p_reporte'];
    $numerodo     = $_GET['p_numerodo'];
    $numeroped    = $_GET['p_numeroped']; 
    $ordencompra  = $_GET['p_ordencompra'];
    $numeroacep   = $_GET['p_numeroacep'];
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

    if($numerodo=="" && $numeroped=="" && $ordencompra=="") {
        if($faperturai<>"")   $param_fecha .="AND (ED.FECHA_APERTURA     >= '$faperturai 00:00:00'  AND  ED.FECHA_APERTURA    <= '$faperturaf 23:59:59') ";
        if($ffacturai<>"")    $param_fecha .="AND (ED.FECHA_FACTURA      >= '$ffacturai 00:00:00'   AND  ED.FECHA_FACTURA     <= '$ffacturaf 23:59:59') ";
        //if($ffacturai<>"")    $param_fecha .="AND (MD.FECHA_MOVIMIENTO      >= '$ffacturai 00:00:00'   AND  MD.FECHA_MOVIMIENTO     <= '$ffacturaf 23:59:59') ";
        $filtros =" WHERE ED.ANULADO='N' AND ED.TIPO_REGIMEN='I' $param_fecha ";
    } 

    if($importador!="0") $filtros .= " AND ED.ID_IMPORTADOR='$importador' ";

    include("../config/funciones.php");
    conectaremoto();

    // Contable - Reporte de conceptos facturados
    $sql = "(SELECT ED.NUMERO_DO, I.NOMBRE_IMPORTADOR, ED.NUMERO_PEDIDO, ED.TIPO_REGIMEN, DATE_FORMAT(ED.FECHA_FACTURA, '%Y') ANIO, 
            CASE DATE_FORMAT(ED.FECHA_FACTURA, '%m') WHEN '01' Then 'Enero'  WHEN '02' Then 'Febrero'  
            WHEN '03' Then 'Marzo' WHEN '04' Then 'Abril' WHEN '05' Then 'Mayo' WHEN '06' Then 'Junio'  
            WHEN '07' Then 'Julio' WHEN '08' Then 'Agosto' WHEN '09' Then 'Septiembre'  
            WHEN '10' Then 'Octubre' WHEN '11' Then 'Noviembre' WHEN '12' Then 'Diciembre' END AS MES, 
            ED.FECHA_FACTURA, ED.NUMERO_FACTURA,  C3.NOMBRE_CONCEPTO, E.NOMBRE_ENTE, MD.TIPO_DOCUMENTO_DES TIPODOC, SUM(MD.VALOR) VALOR, C3.CLASIFICACION_CONCEPTO 
            FROM ESTADOS_DO  ED 
            LEFT OUTER JOIN IMPORTADORES  I ON I.ID_IMPORTADOR=ED.ID_IMPORTADOR 
            LEFT OUTER JOIN MOVIMIENTOS_DOS MD ON MD.NUMERO_DO=ED.NUMERO_DO 
            LEFT OUTER JOIN CONCEPTOS_GTOS_INGS C3 ON C3.ID_CONCEPTO_GTO_ING =MD.ID_CONCEPTO_GTO_ING 
            LEFT OUTER JOIN ENTES E ON E.ID_ENTE =MD.ID_ENTE_PROVEEDOR 
            $filtros   
            GROUP BY 1,8,9,11) Union ALL 
            (SELECT ED.NUMERO_DO, I.NOMBRE_IMPORTADOR, ED.NUMERO_PEDIDO, ED.TIPO_REGIMEN, DATE_FORMAT(ED.FECHA_FACTURA, '%Y') ANIO, 
            CASE DATE_FORMAT(ED.FECHA_FACTURA, '%m') WHEN '01' Then 'Enero'  WHEN '02' Then 'Febrero' 
            WHEN '03' Then 'Marzo' WHEN '04' Then 'Abril' WHEN '05' Then 'Mayo' WHEN '06' Then 'Junio' 
            WHEN '07' Then 'Julio' WHEN '08' Then 'Agosto' WHEN '09' Then 'Septiembre' 
            WHEN '10' Then 'Octubre' WHEN '11' Then 'Noviembre' WHEN '12' Then 'Diciembre' END AS MES, 
            ED.FECHA_FACTURA, ED.NUMERO_FACTURA,    C8.NOMBRE_CONCEPTO, 'AGENCIA DE ADUANAS HUBEMAR' ENTE, NULL TIPODOC,  D.TOTAL, C8.CLASIFICACION_CONCEPTO 
            FROM ESTADOS_DO  ED 
            LEFT OUTER JOIN IMPORTADORES  I  ON I.ID_IMPORTADOR=ED.ID_IMPORTADOR 
            LEFT OUTER JOIN FACTURAS_DOS  FD ON ED.NUMERO_DO=FD.NUMERO_DO 
            LEFT OUTER JOIN FACTURAS_VENTAS FV ON FD.ID_FACTURA_VENTA=FV.ID_FACTURA_VENTA AND FV.VERIFICADO='S' AND FV.ANULADO='N' 
            LEFT OUTER JOIN DET_FACTURAS_VENTAS D ON FV.ID_FACTURA_VENTA=D.ID_FACTURA_VENTA 
            LEFT OUTER JOIN CONCEPTOS_GTOS_INGS C8   ON C8.ID_CONCEPTO_GTO_ING =D.ID_CONCEPTO_GTO_ING  
            $filtros 
            GROUP BY 1,8,9,11 )   
            ";   
    
    $tmp = ""; 
    $nr=0;
    $res =  mysql_query($sql);
    $fila = "<tr>";
    $txt = "";
    $titulo = "";
    $registros = "";

    if($tipo=="XLS" || $tipo=="TXT" || $tipo=="HTML") {
        if(!empty($res)) {
            $tmp = ""; 
            $nr = mysql_num_rows($res);
            $titulo = "Contables - Reporte de Conceptos Facturados";
            $registros = "(No. Registros $nr)";
            $nf = mysql_num_fields($res);
            for($j=0; $j<$nf; $j++) {
                $fila .= "<th>".mysql_field_name($res, $j)."</th>";
                $txt .= mysql_field_name($res, $j)." ";
            }
            $txt .=PHP_EOL;
            $fila .= "</tr>";
            $rawdata = array(); $i=0;
            while($reg = @mysql_fetch_array($res)) {
                $fila .= "<tr>";
                $rawdata[$i] = $reg;
                $i++;
                for($j=0; $j<$nf; $j++) {
                    $fila .= "<td>".$reg[$j]."</td>";
                }
                $txt  .= PHP_EOL;
                $fila .= "</tr>";
            }
        }  
        $tabla = "<table border='1' cellpadding='2' cellspacing='0'>$fila</table>";
    }
    

    switch ($tipo) {            
        case 'XLS':
            header('Content-type: application/vnd.ms-excel');
            header("Content-Disposition: attachment; filename=conceptosfact.xls");
            header("Pragma: no-cache");
            header("Expires: 0");
        case 'HTML':
            echo "<style> body { font-family: Arial; } </style>";
            echo "<center><h2>$titulo</h2>$registros</center>".$tabla;
            break;
        case 'TXT':
            header('Content-type: application/msword');
            header('Content-Disposition: inline; filename=conceptosfact.txt'); 
            echo utf8_encode($txt);
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
            $pdf->Cell(15); $pdf->Cell(0,0,'CONTABLES - REPORTE DE CONCEPTOS FACTURADOS'."(No.Registros $nr)",0,1,'');
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

            $titulo = "Contables - Reporte de Conceptos Facturados";
            $registros = "(No. Registros $nr)";

            $nf = mysql_num_fields($res);
            $pdf->Cell(5,6,"No.",1,0,"C",true);
            $c = array();
            
            // Predeterminando ancho de columnas
            for($x=0; $x<=70; $x++) $c[$x] = 50;
            // Personalizado
            $c[0] = 20; $c[1] = 55; $c[2] = 40; $c[3] = 20; $c[4] = 20; $c[5] = 20; $c[6] = 20; $c[7] = 20;  $c[8] = 80; 
            $c[9] = 90;  $c[10] = 20; $c[11] = 20; $c[12] = 20; 

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