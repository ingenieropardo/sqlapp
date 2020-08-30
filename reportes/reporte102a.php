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

    if($numerodo=="" && $numeroped=="" && $ordencompra=="") {
        if($faperturai<>"") $param_fecha .="AND (ED.FECHA_APERTURA    >= '$faperturai 00:00:00' AND ED.FECHA_APERTURA   <= '$faperturaf 23:59:59') ";
        if($flevantei<>"")  $param_fecha .="AND (FD.FECHA_LEVANTE     >= '$flevantei 00:00:00'  AND FD.FECHA_LEVANTE    <= '$flevantef 23:59:59') ";
        if($faceptai<>"")   $param_fecha .="AND (FD.FECHA_ACEPTACION  >= '$faceptai 00:00:00'   AND FD.FECHA_ACEPTACION <= '$faceptaf 23:59:59') ";
        if($ffacturai<>"")  $param_fecha .="AND (ED.FECHA_FACTURA     >= '$ffacturai 00:00:00'  AND ED.FECHA_FACTURA    <= '$ffacturaf 23:59:59') ";
        $filtros =" WHERE ED.ANULADO='N' AND ED.TIPO_REGIMEN='I' $param_fecha ";
    } else {
        $filtros = " WHERE ED.NUMERO_DO='$numerodo' ";
    }

    if($importador!="0") $filtros .= " AND ED.ID_IMPORTADOR='$importador' ";
    if($sucursal  !="0") $filtros .= " AND ED.CODIGO_SUCURSAL_OP='$sucursal' ";

    include("../config/funciones.php");
    conectaremoto();

    // Clientes - Archivos Planos Merck [PCDEPT00]
    $sql = "SELECT FD.NUMERO_STICKER, DATE_FORMAT(FD.FECHA_PAGO, '%Y%m%d')  FECHA_PAGO, FD.NUMERO_ACEPTACION, 
                   DATE_FORMAT(FD.FECHA_ACEPTACION, '%Y%m%d')  FECHA_ACEPTACION, FD.NUMERO_LEVANTE, 
                   DATE_FORMAT(FD.FECHA_LEVANTE, '%Y%m%d')  FECHA_LEVANTE, IM.CODIGO_ADMINISTRACION,  IM.CODIGO_LUGAR_INGRESO,
                   IM.CODIGO_DEPOSITO, DT.NUMERO_DOC_TRANS, DATE_FORMAT(DT.FECHA_DOC_TRANS, '%Y%m%d')  FECHA_DOCTRAN, CF.NUMERO_FACTURA,
                   NULL EXPORTADOR, NULL NUMPROYECTO, '261' AGENTE_ADUANA, ED.TRM,
                   CF.FACTOR, FD.CODIGO_POSICION, FD.CODIGO_MODALIDAD, FD.CODIGO_TIPO_IMPORTACION, FD.PESO_BRUTO, FD.PESO_NETO,
                   PA.CODIGO_UNIDAD_CCIAL_DIAN,FD.CANTIDAD, FD.VALOR_TOTAL_FOB, FD.VALOR_FLETES, FD.VALOR_SEGUROS, FD.VALOR_OTROS_GASTOS,
                   FD.AJUSTE_VALOR, IF(FD.NUMERO_REG_LICENCIA ='','.', FD.NUMERO_REG_LICENCIA) LICENCIA,  IF(FD.NUMERO_REG_LICENCIA ='','0',FD.ANO_EXPEDICION) ANOEXPEDICION, FD.PORCENTAJE_ARANCEL, FD.TOTAL_ARANCEL,
                   IF(FD.PORCENTAJE_ARANCEL=0, 'S','N') INDARANCEL, FD.PORCENTAJE_IVA,
                   FD.TOTAL_IVA,  IF(FD.PORCENTAJE_IVA=0, 'S','N') INDIVA, FD.TOTAL_SANCIONES, FD.TOTAL_OTROS, FD.VALOR_PAGO_ANTERIORES, FD.TOTAL_PAGO, NULL, NULL, NULL, NULL, NULL, DT.DOCUMENTO_TRANSPORTE_MASTER, 
                   FD.VALOR_ADUANA, (FD.VALOR_ADUANA*ED.TRM) CIF_COP 
            FROM   FORMULARIOS_DIS FD
            LEFT OUTER JOIN CABEZA_FACTURAS CF ON CF.ID_CABEZA_FACTURA=FD.ID_CABEZA_FACTURA 
            LEFT OUTER JOIN EXPORTADORES EX ON EX.ID_EXPORTADOR=CF.ID_EXPORTADOR 
            LEFT OUTER JOIN ESTADOS_DO ED ON FD.NUMERO_DO=ED.NUMERO_DO 
            LEFT OUTER JOIN DOCUMENTOS_TRASPORTE DT ON ED.NUMERO_DO=DT.NUMERO_DO 
            LEFT OUTER JOIN POSICION_ARANCELARIA PA ON PA.CODIGO_POSICION=FD.CODIGO_POSICION 
            LEFT OUTER JOIN IMPORTACIONES IM ON ED.NUMERO_DO=IM.NUMERO_DO
            $filtros        
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
            $titulo = "Clientes - Archivos Planos Merck [PCDEPT00]";
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
            header("Content-Disposition: attachment; filename=PCDEPT00.xls");
            header("Pragma: no-cache");
            header("Expires: 0");
        case 'HTML':
            echo "<style> body { font-family: Arial; } </style>";
            echo "<center><h2>$titulo</h2>$registros</center>".$tabla;
            //echo "<script>window.open('reporte102c.php','_blank')</script>";
            break;
        case 'TXT':
            header('Content-type: application/msword');
            header('Content-Disposition: inline; filename=PCDEPT00.txt'); 
            echo utf8_encode($txt);
            break;
        case 'PDF':
            // INICIO DE PDF -------------------------------------------------------
            require('fpdf.php');
            $nr = mysql_num_rows($res);
            
            $grosor = 6*$nr+60;
            $pdf = new FPDF('L', 'mm', array(2300,$grosor));

            $pdf->AliasNbPages();            
            $pdf->SetY(-12);
            $pdf->SetFont('helvetica','',8);
            $pdf->Cell(0,10,' Pagina '.($pdf->PageNo()+1).' de {nb}',0,0,'C');
            $pdf->Image('../img/logo1.png',12,12,10);
            $pdf->Cell(15); $pdf->Cell(0,9,'HUBEMAR SAS',0,1,'');
            $pdf->SetFont('helvetica','B',9);
            $pdf->Cell(15); $pdf->Cell(0,0,'CLIENTES - ARCHIVOS PLANOS MERK [PCDEPT00]',0,1,'');
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

            $titulo = "CLIENTES - ARCHIVOS PLANOS MERK [PCDEPT00] ";
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