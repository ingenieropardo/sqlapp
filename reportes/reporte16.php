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
   
    $titulo = "REPORTE DE TRIBUTOS POR FACTURAS E ITEMS";
    $file="reporporfacturaeitems";
    $registros="";
    $param_fecha="";

    $filtros = "  WHERE  ED.ANULADO='N' AND ED.TIPO_REGIMEN='I' ";

    if($importador!="0") $filtros .= " AND ED.ID_IMPORTADOR='$importador' ";
    if($sucursal  !="0") $filtros .= " AND ED.CODIGO_SUCURSAL_OP='$sucursal' ";
    if($ejecutivo!="0") $filtros  .= " AND ED.ID_EMPLEADO_OP='$ejecutivo' ";

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
    $sql = "SELECT IF(IM.FECHA_RETIRO_TOTAL IS NOT NULL, 'Con Retiro', IF(FD.FECHA_LEVANTE IS NOT NULL ,'Con Levante', IF(DT.FECHA_MANIFIESTO IS NOT NULL, 'Con Doc. Transp','En Proceso'))) ETAPA,
         DATE_FORMAT(ED.FECHA_APERTURA, '%Y-%m-%d')  C1, S.NOMBRE_SUCURSAL C2, ED.NUMERO_PEDIDO C3,  SC.NOMBRE_SEGMENTO C4, ED.NUMERO_DO,
         D.CODIGO_CONDICION_ENTREGA C8, D.NUMERO_FACTURA C9, DATE_FORMAT(D.FECHA_FACTURA, '%Y-%m-%d') C10,  TRIM(F.NOMBRE_EXPORTADOR)  C11,
         IM.FECHA_DOCS_OK , P.CODIGO_PRODUCTO , P.UNIDAD_NEGOCIO_HUBEMAR, M.NOMBRE_COMERCIAL,  LEFT(TRIM(M.DESCRIPCION),4000) DESCRIPCION, M.ORDEN_COMPRA,
         M.MARCA_COMERCIAL, COALESCE(M.CANTIDAD,0) C21, M.CODIGO_UNIDAD_CCIAL_DIAN C22,

         COALESCE(M.TOTAL_ITEM_USD,0) EX_WORKS_USD , COALESCE(M.FLETE_PRORRATEO,0) FREIGHT_USD, COALESCE(M.SEGURO_PRORRATEO,0) INSURANCE_USD,COALESCE( D.SUMADOS_NETO_US,0) HANDLING_USD,
         0 TOTAL_CIF_USD,  FD.CODIGO_POSICION C28, DATE_FORMAT(DT.FECHA_DOC_TRANS , '%Y-%m-%d') C29,

         DT.NUMERO_DOC_TRANS C30, COALESCE(DT.NUMERO_BULTOS,0) C31, MT.NOMBRE_MEDIO_TRANS C32, DATE_FORMAT(IM.FECHA_ESTIMADA_ARRIBO, '%Y-%m-%d') C33, IM.CODIGO_ADMINISTRACION C34, DATE_FORMAT(DT.FECHA_MANIFIESTO, '%Y-%m-%d') C35,
         DATE_FORMAT(IM.FECHA_TRASLADO_DEPOSITO, '%Y-%m-%d') C36,  IM.CODIGO_DEPOSITO C37, COALESCE(D.PESO_BRUTO_PRORRATEO,0) C38, NT.NOMBRE_TRANSPORTADOR C39, FD.CODIGO_TIPO_DECLARACION C40, TRIM(FD.DECLARACION_ANTERIOR) C41, DATE_FORMAT(FD.FECHA_DECLAR_ANTERIOR, '%Y-%m-%d') C42,
         FD.NUMERO_DEX C43, DATE_FORMAT(FD.FECHA_DEX, '%Y-%m-%d') C44, FD.CODIGO_MODALIDAD, PA.NOMBRE_PAIS C46, PA1.NOMBRE_PAIS C47, FD.CODIGO_REG_LICENCIA C48, FD.NUMERO_REG_LICENCIA C49, FD.CODIGO_ACUERDO C50,

         IF(INSTR(FD.NUMERO_ACEPTACION,'M')=0,'SIGLO XXI','MANUAL') C51, FD.CODIGO_EMBALAGE C52, COALESCE(ED.TRM,0) C53,
         COALESCE( (M.VALOR_FOB_PRORRATEO + M.SUM_NETO_PRORRATEO ),0) VALOR_FOB, COALESCE(FD.VALOR_FLETES,0) FLETES , COALESCE(FD.VALOR_SEGUROS,0) SEGUROS, COALESCE( FD.VALOR_OTROS_GASTOS, 0) GASTOS, 0 AJUSTES, COALESCE( (M.VALOR_FOB_PRORRATEO + FD.VALOR_FLETES + FD.VALOR_SEGUROS + FD.VALOR_OTROS_GASTOS + M.SUM_NETO_PRORRATEO  ),0) VLR_ADUANA,

         COALESCE( FD.PORCENTAJE_ARANCEL,0) C60, COALESCE(FD.TOTAL_ARANCEL,0) C61,
         COALESCE(FD.PORCENTAJE_IVA,0) C62, COALESCE(FD.TOTAL_IVA,0) C63,
         COALESCE(FD.PORCENTAJE_SALVAGUARDIA,0) C64, COALESCE(((FD.TOTAL_SALVAGUARDIA /(FD.VALOR_TOTAL_FOB))*M.TOTAL_ITEM), 0) C65,
         COALESCE(FD.PORCENTAJE_DER_COMP,0) C66, COALESCE(((FD.TOTAL_DER_COMP /(FD.VALOR_TOTAL_FOB))*M.TOTAL_ITEM), 0) C67,
         COALESCE(FD.PORCENTAJE_DER_ANTIDUM,0) C68, COALESCE(((FD.TOTAL_DER_ANTIDUM /(FD.VALOR_TOTAL_FOB))*M.TOTAL_ITEM), 0) C69,
         COALESCE(FD.TOTAL_SANCIONES,0) C70, COALESCE(FD.TOTAL_RESCATE,0) C71,  0 INTERESES,
         TRIM(FD.NUMERO_ACEPTACION) C72, DATE_FORMAT(FD.FECHA_ACEPTACION, '%Y-%m-%d') C73, TRIM(FD.NUMERO_STICKER) C74, DATE_FORMAT(FD.FECHA_PAGO, '%Y-%m-%d') C75,
         TRIM(FD.NUMERO_LEVANTE) C76, DATE_FORMAT(FD.FECHA_LEVANTE, '%Y-%m-%d') C77, DATE_FORMAT(IM.FECHA_RETIRO_TOTAL,'%Y-%m-%d') C78,

         DATE_FORMAT( IM.FECHA_DOCS_TRANSPORTADOR, '%Y-%m-%d') C79,

         FD.VALOR_TOTAL_ITEMS, FD.VALOR_GASTOS_DESPACHO, FD.VALOR_TOTAL_FOB

         FROM  ESTADOS_DO                     ED
            LEFT OUTER JOIN CABEZA_FACTURAS                D   ON D.NUMERO_DO                = ED.NUMERO_DO
            LEFT OUTER JOIN DETALLES_FACTURAS              M   ON D.ID_CABEZA_FACTURA        = M.ID_CABEZA_FACTURA
            LEFT OUTER JOIN FORMULARIOS_DIS                FD  ON M.ID_FORMULARIO_DI         = FD.ID_FORMULARIO_DI
            LEFT OUTER JOIN SEGMENTOS_CLIENTES             SC   ON ED.ID_SEGMENTO_CLIENTE      = SC.ID_SEGMENTO_CLIENTE
            LEFT OUTER JOIN IMPORTACIONES                  IM  ON IM.NUMERO_DO                = ED.NUMERO_DO
            LEFT OUTER JOIN PRODUCTOS                      P   ON M.ID_PRODUCTO              = P.ID_PRODUCTO
            LEFT OUTER JOIN DOCUMENTOS_TRASPORTE           DT  ON ED.NUMERO_DO               = DT.NUMERO_DO
            LEFT OUTER JOIN MEDIOS_TRASPORTE               MT  ON DT.CODIGO_MEDIO_TRANS = MT.CODIGO_MEDIO_TRANS
            LEFT OUTER JOIN TRASPORTADORES                 NT  ON DT.CODIGO_TRANSPORTADOR    = NT.CODIGO_TRANSPORTADOR
            LEFT OUTER JOIN EXPORTADORES                   F   ON D.ID_EXPORTADOR            = F.ID_EXPORTADOR
            LEFT OUTER JOIN PAISES                         PA  ON PA.CODIGO_PAIS             = F.CODIGO_PAIS
            LEFT OUTER JOIN PAISES                         PA1 ON PA1.CODIGO_PAIS            = FD.CODIGO_PAIS_ORIGEN
            LEFT OUTER JOIN SUCURSALES                     S   ON S.CODIGO_SUCURSAL          = ED.CODIGO_SUCURSAL_OP

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