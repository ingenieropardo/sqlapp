<?php
    $tipo = $_GET['p_tipo']; 
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
    $titulo = "Operaciones - Reporte Diario";
    
    if($faperturai<>"")   $param_fecha .="AND (ED.FECHA_APERTURA     >= '$faperturai 00:00:00'  AND  ED.FECHA_APERTURA    <= '$faperturaf 23:59:59') ";
    if($flevantei<>"")    $param_fecha .="AND (FD.FECHA_LEVANTE      >= '$flevantei 00:00:00'   AND  FD.FECHA_LEVANTE     <= '$flevantef 23:59:59') ";
    if($faceptai<>"")     $param_fecha .="AND (FD.FECHA_ACEPTACION   >= '$faceptai 00:00:00'    AND  FD.FECHA_ACEPTACION  <= '$faceptaf 23:59:59') ";
    if($fmercanciai<>"")  $param_fecha .="AND (IM.FECHA_LIBERACION   >= '$fmercanciai 00:00:00' AND  IM.FECHA_LIBERACION  <= '$fmercanciaf 23:59:59') ";
    if($fretiroi<>"")     $param_fecha .="AND (IM.FECHA_RETIRO_TOTAL >= '$fretiroi 00:00:00'    AND  IM.FECHA_LIBERACION  <= '$fretirof 23:59:59') ";
    if($fstickeri<>"")    $param_fecha .="AND (FD.FECHA_PAGO         >= '$fstickeri 00:00:00'   AND  FD.FECHA_PAGO        <= '$fstickerf 23:59:59') ";
    if($ffacturai<>"")    $param_fecha .="AND (ED.FECHA_FACTURA      >= '$ffacturai 00:00:00'   AND  ED.FECHA_FACTURA     <= '$ffacturaf 23:59:59') ";

    include("../config/funciones.php");
    conectaremoto();

    // 
    $sql  = "SELECT ED.NUMERO_DO, ED.NUMERO_PEDIDO, MR.NOMBRE_MODALIDAD,I.NOMBRE_IMPORTADOR, E.NOMBRE_ETAPA,
                    EE.NOMBRE_PERSONA EJECUTIVO,  EA.NOMBRE_PERSONA  ANALISTA, CF.NUMERO_FACTURA, 
                    TRIM(LEFT(ED.DESCRIPCION,254)) PRODUCTO,  ED.FECHA_APERTURA, ED.CODIGO_SUCURSAL_OP,  
                    If( IM.SELECTIVIDAD='A','Automatica', If( IM.SELECTIVIDAD='D','Documental', If(IM.SELECTIVIDAD='F', 'Fisica', ''))) SELECTIVIDAD,
                    IM.FECHA_ESTIMADA_ARRIBO, IM.FECHA_DOCUMENTOS_OK_CLIENTE,  IM.FECHA_LLEGADA_MCIA, NULL, 
                    NULL, IM.FECHA_MANIFIESTO, IM.FECHA_VENCIMIENTO_MCIA, DT.FECHA_DOC_TRANS, 
                    IM.FECHA_ARBOL_DOCUMENTOS, IM.FECHA_DOCS_OK,  IM.FECHA_LIBERACION, IM.FECHA_ACEPTACION,
                    IM.FECHA_LEVANTE, IM.FECHA_DOCS_TRANSPORTADOR, IM.FECHA_RETIRO_TOTAL, 
                    IM.FECHA_ENVIADO_FACTURAR, EV.FECHA, EV.COMENTARIO,  ED.FECHA_FACTURA 
            FROM ESTADOS_DO ED 
            LEFT OUTER JOIN IMPORTACIONES IM    ON IM.NUMERO_DO=ED.NUMERO_DO 
            LEFT OUTER JOIN CABEZA_FACTURAS CF ON CF.NUMERO_DO=ED.NUMERO_DO 
            LEFT OUTER JOIN DOCUMENTOS_TRASPORTE DT ON DT.NUMERO_DO=ED.NUMERO_DO 
            LEFT OUTER JOIN ETAPAS_DO     E    ON E.ID_ETAPA_DO=ED.ID_ETAPA_DO 
            LEFT OUTER JOIN SUCURSALES    S    ON S.CODIGO_SUCURSAL=ED.CODIGO_SUCURSAL_OP 
            LEFT OUTER JOIN IMPORTADORES  I    ON I.ID_IMPORTADOR=ED.ID_IMPORTADOR 
            LEFT OUTER JOIN EMPLEADOS     EE   ON EE.ID_EMPLEADO=ED.ID_EMPLEADO_OP 
            LEFT OUTER JOIN EMPLEADOS     EA   ON EA.ID_EMPLEADO=ED.ID_EMPLEADO_DIGITA 
            LEFT OUTER JOIN MODALIDADES_REGIMENES  MR ON MR.ID_MODALIDAD=ED.ID_MODALIDAD 
            LEFT OUTER JOIN  ( SELECT numero_do, fecha_registro fecha, TRIM(LEFT(COMENTARIO,2000)) COMENTARIO from eventos_do  ORDER BY FECHA_REGISTRO DESC ) EV ON EV.NUMERO_DO=ED.NUMERO_DO 
       

            WHERE ED.ANULADO='N'  AND ED.CERRADO_OPERATIVAMENTE='N' AND  ED.TIPO_REGIMEN='I'  AND ED.ID_IMPORTADOR='$importador'  
             GROUP BY ED.NUMERO_DO
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
                    switch ($j) {
                        case 2:  $txt .= esp($reg[$j],3)." ";  break;
                        case 5:  $txt .= esp($reg[$j],33)." ";  break;
                        default: $txt .= $reg[$j]." "; break;
                    }
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
            header("Content-Disposition: attachment; filename=reportediario.xls");
            header("Pragma: no-cache");
            header("Expires: 0");
        case 'HTML':
            echo "
            <head>
                <meta charset='UTF-8'>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                <meta http-equiv='X-UA-Compatible' content='ie=edge'>
                <title>REPORTE DIARIO</title>
                <link rel='icon' type='image/jpg' href='/img/logo-hubemar.png' /> 
            </head>
            <style> 
                body { font-family: Arial; } 
                body { font-family: century gothic; }
                td { border-bottom: solid; border-color: #DCDCDC; border-width:1px; padding: 4px; }
                tr:hover { background-color: #00FFFF; }
                td:hover { background-color: #00BFFF; } 
                #head { padding: 10px; margin-top: -10px; margin-left: -10px; text-align: center; background: #FDF6E7 }
                button { border-style: none; margin: 2px; border-radius: 5px; padding: 5px; } button:hover { background-color: #E9DF9B }
            </style>";
            echo "<center><h2>$titulo</h2>$registros</center>".$tabla;
            break;
        case 'TXT':
            header('Content-type: application/msword');
            header('Content-Disposition: inline; filename=reportediario.txt'); 
            echo "<style>body{font-family: consolas}</style>".utf8_encode($txt);
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
            $pdf->Cell(15); $pdf->Cell(0,0,'REPORTE DIARIO',0,1,'');
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