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
    $titulo = "DTA - INFORME DAIMLER";
    $file="dtadaimler";

    if($faperturai<>"")   $param_fecha .="AND (ED.FECHA_APERTURA     >= '$faperturai 00:00:00'  AND  ED.FECHA_APERTURA    <= '$faperturaf 23:59:59') ";
    if($flevantei<>"")    $param_fecha .="AND (DTA.FECHA_DOCUMENTO_TRANSPORTE      >= '$flevantei 00:00:00'   AND  DTA.FECHA_DOCUMENTO_TRANSPORTE     <= '$flevantef 23:59:59') ";
    if($faceptai<>"")     $param_fecha .="AND (DTA.FECHA_MANIFIESTO_CARGO   >= '$faceptai 00:00:00'    AND  DTA.FECHA_MANIFIESTO_CARGO  <= '$faceptaf 23:59:59') ";
    if($ffacturai<>"")    $param_fecha .="AND (ED.FECHA_FACTURA      >= '$ffacturai 00:00:00'   AND  ED.FECHA_FACTURA     <= '$ffacturaf 23:59:59') ";

    include("../config/funciones.php");
    conectaremoto();

    // Dim - Reporte de Tributos por DIM
    $sql  = "  SELECT ED.NUMERO_DO, ED.NUMERO_PEDIDO, DTA.NUMERO_DOCUMENTO_TRANSPORTE, 
                      DTA.FECHA_DOCUMENTO_TRANSPORTE, DTA.FECHA_MANIFIESTO_CARGO, 
                      UC.TIPO_CARGA, UC.PESO_BRUTO, UC.CONTENEDORES, UC.C20, UC.C40 
                FROM dtas_forms DTA
                INNER JOIN ESTADOS_DO ED ON ED.NUMERO_DO=DTA.NUMERO_DO
                INNER JOIN IMPORTADORES I ON I.ID_IMPORTADOR=ED.ID_IMPORTADOR
                LEFT OUTER JOIN (SELECT NUMERO_DO, CASE CARGA_EN_CONTENEDOR WHEN '1' THEN 'CARGA SUELTA' WHEN '2' THEN 'CONTENEDORIZADA'   WHEN '3' THEN  'GRANEL' WHEN '4' THEN 'MIXTA' WHEN '5' THEN  'ISOTANQUE'  when '6' THEN 'FLEXITANQUE' END AS TIPO_CARGA, SUM(PESO_BRUTO) PESO_BRUTO, COUNT(NUMERO_ID_CONTENEDOR) CONTENEDORES, SUM(IF(TAMANO=1, 1, 0)) C20, 
                    SUM(IF(TAMANO=3, 1, 0)) C40 FROM UNIDADES_CARGA  GROUP BY 1) UC ON UC.NUMERO_DO=DTA.NUMERO_DO
        


            WHERE ED.ANULADO='N'  AND  ED.TIPO_REGIMEN='T'  AND ED.ID_IMPORTADOR='$importador'  
            $param_fecha   
            ORDER BY ED.NUMERO_PEDIDO
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
            header("Content-Disposition: attachment; filename=" .$file. ".xls");
            header("Pragma: no-cache");
            header("Expires: 0");
        case 'HTML':
            echo "
            <head>
                <meta charset='UTF-8'>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                <meta http-equiv='X-UA-Compatible' content='ie=edge'>
                <title> ". $titulo . "  </title>
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
            header('Content-Disposition: inline; filename=' .$file.'txt'); 
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
            $pdf->Cell(15); $pdf->Cell(0,0, $titulo ,0,1,'');
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