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
   
    $titulo = "FORMATO DE PEDIDOS DAIMLER";
    $file="formatopedidos";
    $registros="";

    $param_fecha="";

    if($faperturai<>"")   $param_fecha .="AND (ED.FECHA_APERTURA     >= '$faperturai 00:00:00'  AND  ED.FECHA_APERTURA    <= '$faperturaf 23:59:59') ";
    if($flevantei<>"")    $param_fecha .="AND (IM.FECHA_LEVANTE      >= '$flevantei 00:00:00'   AND  IM.FECHA_LEVANTE     <= '$flevantef 23:59:59') ";
    if($faceptai<>"")     $param_fecha .="AND (IM.FECHA_ACEPTACION   >= '$faceptai 00:00:00'    AND  IM.FECHA_ACEPTACION  <= '$faceptaf 23:59:59') ";
    if($fmercanciai<>"")  $param_fecha .="AND (IM.FECHA_LIBERACION   >= '$fmercanciai 00:00:00' AND  IM.FECHA_LIBERACION  <= '$fmercanciaf 23:59:59') ";
    if($fretiroi<>"")     $param_fecha .="AND (IM.FECHA_RETIRO_TOTAL >= '$fretiroi 00:00:00'    AND  IM.FECHA_LIBERACION  <= '$fretirof 23:59:59') ";
    if($fstickeri<>"")    $param_fecha .="AND (IM.FECHA_PAGO         >= '$fstickeri 00:00:00'   AND  IM.FECHA_PAGO        <= '$fstickerf 23:59:59') ";
    if($ffacturai<>"")    $param_fecha .="AND (ED.FECHA_FACTURA      >= '$ffacturai 00:00:00'   AND  ED.FECHA_FACTURA     <= '$ffacturaf 23:59:59') ";

    include("../config/funciones.php");
    conectaremoto();

    // 
    $sql = "SELECT ED.NUMERO_PEDIDO, ED.NUMERO_DO,MT.NOMBRE_MEDIO_TRANS, MR.NOMBRE_MODALIDAD, 
                   EX.NOMBRE_EXPORTADOR, IM.FECHA_INICIO_TRAMITE, CF.NUMERO_FACTURA, CF.FECHA_FACTURA, 
                   CF.CODIGO_MONEDA, CF.TOTAL_FACTURA, CD.CODIGO_EMBALAGE,  CF.SUMADOS_NETO,
                   /*if(TAMANO=1, COUNT(DISTINCT NUMERO_ID_CONTENEDOR), 0 ) C20, 
                   if(TAMANO=3, COUNT(DISTINCT NUMERO_ID_CONTENEDOR), 0 ) C40,*/ NULL, NULL, 
                   DT.NUMERO_BULTOS, DT.PESO, DT.VOLUMEN, DT.NUMERO_DOC_TRANS, DT.FECHA_DOC_TRANS,
                   IM.FECHA_LLEGADA_MCIA, IM.FECHA_DOCS_TRANSPORTADOR, IM.FECHA_TRASLADO_DEPOSITO,  
                   DT.FECHA_MANIFIESTO, IM.FECHA_ORIGINALES_O_INSTRUCCIONES,  IM.FECHA_DOCUMENTOS_OK_CLIENTE, 
                   'AGENCIA DE ADUANAS HUBEMAR SAS NIVEL 1', IM.FECHA_LEVANTE, ED.FECHA_FACTURA, 
                   IM.FECHA_LUZ_VERDE

            FROM IMPORTACIONES IM
            LEFT OUTER JOIN ESTADOS_DO            ED ON IM.NUMERO_DO=ED.NUMERO_DO
            LEFT OUTER JOIN DOCUMENTOS_TRASPORTE  DT ON DT.NUMERO_DO=IM.NUMERO_DO
            LEFT OUTER JOIN medios_trasporte      MT ON MT.CODIGO_MEDIO_TRANS=DT.CODIGO_MEDIO_TRANS
            LEFT OUTER JOIN MODALIDADES_REGIMENES MR ON MR.ID_MODALIDAD=ED.ID_MODALIDAD
            LEFT OUTER JOIN CABEZA_FACTURAS       CF ON CF.NUMERO_DO=ED.NUMERO_DO
            LEFT OUTER JOIN EXPORTADORES          EX ON EX.ID_EXPORTADOR=CF.ID_EXPORTADOR
            LEFT OUTER JOIN cabezas_dis           CD ON CD.NUMERO_DO=ED.NUMERO_DO
            /* LEFT OUTER JOIN UNIDADES_CARGA UC ON UC.NUMERO_DO=ED.NUMERO_DO */

 

            WHERE ED.ANULADO='N'  AND  ED.TIPO_REGIMEN='I'  AND ED.ID_IMPORTADOR='$importador'  
            $param_fecha   
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
            
            $registros = " Registros $nr";
            $nf = mysql_num_fields($res);
            for($j=0; $j<$nf; $j++) {
                $fila .= "<th>".mysql_field_name($res, $j)."</th>";
                $txt .= mysql_field_name($res, $j)." ";
            }
            $txt .=PHP_EOL;
            $fila .= "</tr>";
            $rawdata = array(); $i=0;
            $sw=0;
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